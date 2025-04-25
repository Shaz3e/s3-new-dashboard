<div>
    <div class="row mb-3">
        <div class="col-md-12">
            <div class="text-end">
                <x-action-link text="{{ __('Create New') }}" :route="route('admin.global-email-templates.create')"
                    permission="global-email-templates.create" />
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
        <x-table :headers="['#', __('Header'), __('Default Header'), __('Footer'), __('Default Footer')]" :records="$records">
            @php
                $totalRecords = $records->total();
                $currentPage = $records->currentPage();
                $perPage = $records->perPage();
                $id = $totalRecords - ($currentPage - 1) * $perPage;
            @endphp
            @foreach ($records as $record)
                <tr wire:key="{{ $record->id }}">
                    <td>{{ $id-- }}</td>
                    <td>
                        @if ($record->header)
                            <span class="badge bg-success">Yes</span>
                        @else
                            <span class="badge bg-danger">No</span>
                        @endif
                    </td>
                    <td>
                        @if ($record->default_header)
                            <span class="badge bg-success">Yes</span>
                        @else
                            <span class="badge bg-danger">No</span>
                        @endif
                    </td>
                    <td>
                        @if ($record->footer)
                            <span class="badge bg-success">Yes</span>
                        @else
                            <span class="badge bg-danger">No</span>
                        @endif
                    </td>
                    <td>
                        @if ($record->default_footer)
                            <span class="badge bg-success">Yes</span>
                        @else
                            <span class="badge bg-danger">No</span>
                        @endif
                    </td>
                    <td class="text-end">
                        @if ($showDeleted)
                            <x-icon-button wire:click="confirmRestore({{ $record->id }})" icon="ti ti-arrow-back-up"
                                permission="global-email-templates.restore" />
                            <x-icon-button wire:click="confirmForceDelete({{ $record->id }})" icon="ti ti-trash-off"
                                permission="global-email-templates.force.delete" />
                        @else
                            <x-icon-link icon="ti ti-eye" :route="route('admin.global-email-templates.show', $record->id)" permission="global-email-templates.read" />
                            <x-icon-link icon="ti ti-edit" :route="route('admin.global-email-templates.edit', $record->id)"
                                permission="global-email-templates.update" />
                            <x-icon-button wire:click="confirmDelete({{ $record->id }})" icon="ti ti-trash"
                                permission="global-email-templates.delete" />
                        @endif
                    </td>
                </tr>
            @endforeach
        </x-table>
    </div>
    {{ $records->links() }}

</div>
