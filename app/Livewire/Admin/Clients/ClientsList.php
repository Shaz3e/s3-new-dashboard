<?php

namespace App\Livewire\Admin\Clients;

use App\Exports\Admin\ClientExport;
use App\Livewire\BaseComponent;
use App\Models\User;
use App\Services\EmailService;
use Carbon\Carbon;
use Livewire\Attributes\Url;
use Maatwebsite\Excel\Facades\Excel;

class ClientsList extends BaseComponent
{
    #[Url()]
    public $filterActive;

    #[Url()]
    public $filterSuspended;

    #[Url()]
    public $filterEmailVerificationStatus;

    #[Url()]
    public $filterFromDate;

    #[Url()]
    public $filterToDate;

    protected function getModelClass()
    {
        return User::class;
    }

    protected function getViewName()
    {
        return 'livewire.admin.clients.clients-list';
    }

    public function mount()
    {
        $this->filters = [
            'is_active' => $this->filterActive,
            'is_suspended' => $this->filterSuspended,
            'email_verified_at' => $this->filterEmailVerificationStatus,
        ];
    }

    protected function applyAdditionalConstraints($query)
    {
        // Apply is_admin = 1 filter
        $query->where('is_admin', false);

        if (isset($this->filters['is_active']) && $this->filters['is_active'] !== '') {
            // Apply the filter only if it's not an empty value
            $query->where('is_active', $this->filters['is_active']);
        }
        if (isset($this->filters['is_suspended']) && $this->filters['is_suspended'] !== '') {
            // Apply the filter only if it's not an empty value
            $query->where('is_suspended', $this->filters['is_suspended']);
        }
        if (isset($this->filterEmailVerificationStatus)) {
            if ($this->filterEmailVerificationStatus == '1') {
                // Filter for verified emails (not null)
                $query->whereNotNull('email_verified_at');
            } elseif ($this->filterEmailVerificationStatus == '0') {
                // Filter for unverified emails (null)
                $query->whereNull('email_verified_at');
            }
        }

        if ($this->filterFromDate) {
            $query->where('created_at', '>=', Carbon::parse($this->filterFromDate)->startOfDay());
        }

        if ($this->filterToDate) {
            $query->where('created_at', '<=', Carbon::parse($this->filterToDate)->endOfDay());
        }
    }

    public function updatingFilterActive($value)
    {
        $this->filters['is_active'] = $value;
        $this->resetPage();
    }

    public function updatingFilterSuspended($value)
    {
        $this->filters['is_suspended'] = $value;
        $this->resetPage();
    }

    public function resetFilters()
    {
        $this->search = '';
        $this->filterActive = '';
        $this->filterSuspended = '';
        $this->filterEmailVerificationStatus = '';
        $this->filterFromDate = '';
        $this->filterToDate = '';
        $this->filters = [];
        $this->showDeleted = false;
        $this->resetPage();
    }

    /**
     * export
     *
     * @return void
     */
    // public function export()
    // {
    //     $filters = [
    //         'is_active' => $this->filterActive,
    //         'is_suspended' => $this->filterSuspended,
    //         'email_verified_at' => $this->filterEmailVerificationStatus,
    //         'from_date' => $this->filterFromDate,
    //         'to_date' => $this->filterToDate,
    //     ];

    //     // Generate the Excel file
    //     $fileName = 'clients-'.now()->format('Y-m-d-His').'.xlsx';

    //     // Ensure the directory exists
    //     if (! file_exists(storage_path('app/exports'))) {
    //         mkdir(storage_path('app/exports'), 0755, true);
    //     }

    //     // Store the file
    //     Excel::store(new ClientExport($filters), 'exports/'.$fileName, 'public');

    //     // Generate a public download link
    //     $download_link = asset('storage/exports/'.$fileName);

    //     // Notify Admin
    //     $user = auth()->user();
    //     $notification_email = config('mail.notification_email');

    //     $emailService = new EmailService();

    //     $emailService->sendEmailByKey('client_export_notification', $notification_email, [
    //         'user_name' => $user->name,
    //         'user_email' => $user->email,
    //         'notification_email' => $notification_email,
    //         'download_link' => $download_link,
    //         'app_name' => config('app.name'),
    //     ]);

    //     return Excel::download(new ClientExport($filters), 'clients.xlsx');
    // }
}
