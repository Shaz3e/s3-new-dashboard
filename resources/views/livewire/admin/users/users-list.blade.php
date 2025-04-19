<div>
    <div class="row mb-3">
        <div class="col-md-12">
            <div class="text-end">
                <x-action-link text="{{ __('Create New') }}" :route="route('admin.users.create')" permission="users.create" />
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
                <option value="">{{ __('Show All') }}</option>
                <option value="0">{{ __('Inactive Users') }}</option>
                <option value="1">{{ __('Active Users') }}</option>
            </select>
        </div>
        {{-- .col --}}
        <div class="col-md-2 col-sm-12 mb-2">
            <select wire:model.live="filterSuspended" class="form-control form-control-sm form-control-border">
                <option value="">{{ __('Show All') }}</option>
                <option value="1">{{ __('Suspended Users') }}</option>
                <option value="0">{{ __('Unsuspended Users') }}</option>
            </select>
        </div>
        {{-- .col --}}
        <div class="col-md-2 col-sm-12 mb-2">
            <select wire:model.live="showDeleted" class="form-control form-control-sm form-control-border">
                <option value="">{{ __('Show All') }}</option>
                <option value="true">{{ __('Show Deleted Only') }}</option>
            </select>
        </div>
        {{-- .col --}}
    </div>
    {{-- /.row --}}

    <div wire:poll.visible>
        <x-table :headers="['#', __('Name'), __('Email Status'), __('Active'), __('Suspended'), __('Roles')]" :records="$records">
            @php
                // Get pagination details
                $currentPage = $records->currentPage(); // Current page number
                $perPage = $records->perPage(); // Records per page

                // Calculate starting serial for the current page
                $startingSerial = ($currentPage - 1) * $perPage + 1;

                // Filter records dynamically based on the user's role
                $filteredRecords =
                    auth()->check() && auth()->user()->hasRole('developer')
                        ? $records
                        : $records->whereNotIn('id', [1, 2, 3]);

                // Total visible records after filtering
                $totalVisibleRecords = $filteredRecords->count();
            @endphp

            @foreach ($filteredRecords as $user)
                @if ($user->id !== auth()->user()->id)
                    <tr wire:key="{{ $user->id }}">
                        <td>{{ $startingSerial++ }}</td>
                        <td>
                            <div class="row">
                                <div class="col-auto pe-0">
                                    <x-user-avatar :user="$user" class="wid-40 rounded-circle" />
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
                        <td>
                            <div class="d-flex flex-wrap gap-2">
                                @foreach ($user->roles as $role)
                                    <span class="badge text-bg-primary">{{ $role->name }}</span>
                                @endforeach
                            </div>
                        </td>
                        <td class="text-end">
                            @if ($showDeleted)
                                <x-icon-button wire:click="confirmRestore({{ $user->id }})"
                                    icon="ti ti-arrow-back-up" permission="users.restore" />
                                <x-icon-button wire:click="confirmForceDelete({{ $user->id }})"
                                    icon="ti ti-trash-off" permission="users.force.delete" />
                            @else
                                <x-icon-link icon="ti ti-eye" :route="route('admin.users.show', $user->id)" permission="users.read" />
                                <x-icon-link icon="ti ti-edit" :route="route('admin.users.edit', $user->id)" permission="users.update" />
                                <x-icon-button wire:click="confirmDelete({{ $user->id }})" icon="ti ti-trash"
                                    permission="users.delete" />
                            @endif
                        </td>
                    </tr>
                @endif
            @endforeach
        </x-table>
    </div>
    {{ $records->links() }}

</div>
