<div>
    <div class="row mb-3">
        <div class="col-md-12">
            <div class="text-end">
                <x-action-link text="{{ __('Create New') }}" :route="route('admin.roles.create')" permission="roles.create" />
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
        <div class="col-md-9 col-sm-12 mb-2">
            <input type="search" wire:model.live="search" class="form-control form-control-sm"
                placeholder="{{ __('Search') }}">
        </div>
        {{-- .col --}}
        <div class="col-md-2 col-sm-12 mb-2">
            <select wire:model.live="showDeleted" class="form-control form-control-sm form-control-border">
                <option value="">{{ __('Show All') }}</option>
                <option value="true">{{ __('Show Deleted') }}</option>
            </select>
        </div>
        {{-- .col --}}
    </div>
    {{-- /.row --}}

    <div wire:poll.visible>
        <x-table :headers="['#', __('Role Name'), __('Status')]" :records="$records">
            @php
                $totalRecords = $records->total();
                $currentPage = $records->currentPage();
                $perPage = $records->perPage();
                $id = $totalRecords - ($currentPage - 1) * $perPage;
            @endphp
            @foreach ($records as $role)
                <tr wire:key="{{ $role->id }}">
                    <td>{{ $id-- }}</td>
                    <td>{{ ucwords($role->name) }}</td>
                    <td>
                        <x-toggle-checkbox :record="$role" field="active" />
                    </td>
                    <td class="text-end">
                        @if ($showDeleted)
                            <x-icon-button wire:click="confirmRestore({{ $role->id }})" icon="ti ti-arrow-back-up"
                                permission="roles.restore" />
                            <x-icon-button wire:click="confirmForceDelete({{ $role->id }})" icon="ti ti-trash-off"
                                permission="roles.force.delete" />
                        @else
                            <x-icon-link text="{{ __('button.edit') }}" icon="ti ti-edit" :route="route('admin.roles.edit', $role->id)"
                                permission="roles.update" />
                            <x-icon-button wire:click="confirmDelete({{ $role->id }})" icon="ti ti-trash"
                                permission="roles.delete" />
                        @endif
                    </td>
                </tr>
            @endforeach
        </x-table>
    </div>
    {{ $records->links() }}

</div>
