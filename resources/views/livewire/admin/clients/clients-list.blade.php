<div>
    <div class="row mb-3">
        <div class="col-md-12">
            <div class="text-end">
                <x-action-link text="{{ __('Create New') }}" :route="route('admin.clients.create')" permission="clients.create" />
                <x-button class="btn-sm" wire:click="export" wire:loading.attr="disabled" text="{{ __('Export') }}" />
                <div wire:target="export" wire:loading>
                    Exporting...
                </div>
                <x-button class="btn-sm" wire:click="resetFilters" text="{{ __('Reset Filters') }}" />
            </div>
        </div>
    </div>
    {{-- /.row --}}
    <div class="row mb-3">
        <div class="col-md-1 col-sm-12 mb-2">
            <select wire:model.live="perPage" class="form-control form-control-sm form-control-border">
                <option value="5">5</option>
                <option value="10">10</option>
                <option value="50">50</option>
                <option value="100">100</option>
            </select>
        </div>
        {{-- /.col --}}
        <div class="col-md-11 col-sm-12 mb-2">
            <input type="search" wire:model.live="search" class="form-control form-control-sm"
                placeholder="{{ __('Search') }}">
        </div>
        {{-- .col --}}
    </div>
    <div class="row mb-3">
        <div class="col-md-2 col-sm-12 mb-2">
            <select wire:model.live="filterActive" class="form-control form-control-sm form-control-border">
                <option value="">{{ __('Filter Active/Inactive') }}</option>
                <option value="0">{{ __('Inactive Clients') }}</option>
                <option value="1">{{ __('Active Clients') }}</option>
            </select>
        </div>
        {{-- .col --}}
        <div class="col-md-2 col-sm-12 mb-2">
            <select wire:model.live="filterSuspended" class="form-control form-control-sm form-control-border">
                <option value="">{{ __('Filter Status') }}</option>
                <option value="1">{{ __('Suspended Clients') }}</option>
                <option value="0">{{ __('Unsuspended Clients') }}</option>
            </select>
        </div>
        {{-- .col --}}
        <div class="col-md-2 col-sm-12 mb-2">
            <select wire:model.live="filterEmailVerificationStatus"
                class="form-control form-control-sm form-control-border">
                <option value="">{{ __('Filter Email') }}</option>
                <option value="1">{{ __('Verified') }}</option>
                <option value="0">{{ __('Unverified') }}</option>
            </select>
        </div>
        {{-- .col --}}

        <div class="col-md-2 col-sm-12 mb-2">
            <input type="date" wire:model.live="filterFromDate" class="form-control form-control-sm"
                placeholder="{{ __('From Date') }}">
        </div>
        {{-- .col --}}

        <div class="col-md-2 col-sm-12 mb-2">
            <input type="date" wire:model.live="filterToDate" class="form-control form-control-sm"
                placeholder="{{ __('To Date') }}">
        </div>
        {{-- .col --}}

        <div class="col-md-2 col-sm-12 mb-2">
            <select wire:model.live="showDeleted" class="form-control form-control-sm form-control-border">
                <option value="">{{ __('Filter Deleted') }}</option>
                <option value="true">{{ __('Show Deleted Only') }}</option>
            </select>
        </div>
        {{-- .col --}}
    </div>
    {{-- /.row --}}

    <div wire:poll.visible>
        <x-table :headers="['#', __('Name'), __('Email Verified'), __('Active'), __('Suspended')]" :records="$records">
            @php
                $totalRecords = $records->total();
                $currentPage = $records->currentPage();
                $perPage = $records->perPage();
                $startNumber = $totalRecords - ($currentPage - 1) * $perPage;
            @endphp
            @foreach ($records as $user)
                <tr wire:key="{{ $user->id }}">
                    <td>{{ $startNumber-- }}</td>
                    <td>
                        <div class="row">
                            <div class="col-auto pe-0">
                                <a href="{{ route('admin.clients.show', $user->id) }}">
                                    <x-user-avatar :user="$user" class="wid-40 rounded-circle" />
                                </a>
                            </div>
                            <div class="col">
                                <h5 class="mb-0">{{ ucwords($user->name) }}</h5>
                                <p class="text-muted f-12 mb-0">{{ $user->email }}</p>
                            </div>
                        </div>
                    </td>
                    <td>
                        @if ($user->email_verified_at)
                            <span class="badge bg-success">Verified</span>
                        @else
                            <span class="badge bg-danger">Not Verified</span>
                        @endif
                    </td>
                    <td>
                        @can('users.update')
                            <x-toggle-checkbox :record="$user" field="is_active" />
                        @else
                            <span
                                class="badge text-{{ $user->is_active ? 'success' : 'danger' }}">{{ $user->is_active ? 'Active' : 'Inactive' }}</span>
                        @endcan
                    </td>
                    <td>
                        @can('users.update')
                            <x-toggle-checkbox :record="$user" field="is_suspended" />
                        @else
                            <span class="badge text-{{ $user->is_suspended ? 'danger' : 'success' }}">
                                {{ $user->is_suspended ? 'Suspended' : 'Unsuspended' }}
                            </span>
                        @endcan
                    </td>
                    <td class="text-end">
                        @if ($showDeleted)
                            <x-icon-button wire:click="confirmRestore({{ $user->id }})" icon="ti ti-arrow-back-up"
                                permission="clients.restore" />
                            <x-icon-button wire:click="confirmForceDelete({{ $user->id }})" icon="ti ti-trash-off"
                                permission="clients.force.delete" />
                        @else
                            <x-icon-link icon="ti ti-user" :route="route('admin.login.as.client', $user->id)" permission="clients.update" />
                            <x-icon-link icon="ti ti-edit" :route="route('admin.clients.edit', $user->id)" permission="clients.update" />
                            <x-icon-button wire:click="confirmDelete({{ $user->id }})" icon="ti ti-trash"
                                permission="clients.delete" />
                        @endif
                    </td>
                </tr>
            @endforeach
        </x-table>
    </div>
    {{ $records->links() }}

</div>
