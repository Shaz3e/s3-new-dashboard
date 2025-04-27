<div>
    <div class="row mb-3">
        <div class="col-md-12">
            <div class="text-end">
                <x-action-link text="{{ __('Create New') }}" :route="route('admin.email-templates.create')" permission="email-templates.create" />
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

        @php
            $totalRecords = $records->total();
            $currentPage = $records->currentPage();
            $perPage = $records->perPage();
            $id = $totalRecords - ($currentPage - 1) * $perPage;
        @endphp
        <div class="row">

            @foreach ($records as $record)
                <div class="col-md-4 col-sm-12" wire:key="{{ $record->id }}">
                    <div class="card">
                        <div class="card-body">
                            <div class="row">
                                <div class="col-md-12 mb-5">
                                    <small>Subject</small>
                                    <h6>{{ $record->subject }}</h6>
                                    <strong class="badge bg-success">{{ $record->name }}</strong>
                                </div>

                                @if ($record->header_image)
                                    <div class="col-md-12 mb-2 text-center">
                                        <img src="{{ asset($record->header_image) }}" class="img-fluid"
                                            alt="img" />
                                    </div>
                                    {{-- /.col --}}
                                @endif

                                @if ($record->header_text)
                                    <div class="col-md-12">
                                        <div
                                            style="color: {{ $record->header_text_color }}; background-color: {{ $record->header_background_color }}">
                                            {!! $record->header_text !!}
                                        </div>
                                    </div>
                                    {{-- /.col --}}
                                @endif

                                <div class="col-md-12 mb-2">
                                    {!! $record->body !!}
                                </div>
                                {{-- /.col --}}

                                @if ($record->footer_image)
                                    <div class="col-md-12 text-center mb-3">
                                        <img src="{{ asset($record->footer_image) }}" class="img-fluid"
                                            alt="img" />
                                    </div>
                                    {{-- /.col --}}
                                @endif

                                @if ($record->footer_text)
                                    <div class="col-md-12 mb-3">
                                        <div
                                            style="color: {{ $record->footer_text_color }}; background-color: {{ $record->footer_background_color }}">
                                            {!! $record->footer_text !!}
                                        </div>
                                    </div>
                                    {{-- /.col --}}
                                @endif

                                @if ($record->footer_bottom_image)
                                    <div class="col-md-12 text-center mb-3">
                                        <img src="{{ asset($record->footer_bottom_image) }}" class="img-fluid"
                                            alt="img" />
                                    </div>
                                    {{-- /.col --}}
                                @endif
                            </div>
                            {{-- /.row --}}
                        </div>
                        {{-- /.card-body --}}
                        <div class="card-footer">

                            @if ($showDeleted)
                                <x-icon-button wire:click="confirmRestore({{ $record->id }})"
                                    icon="ti ti-arrow-back-up" permission="email-templates.restore" />
                                <x-icon-button wire:click="confirmForceDelete({{ $record->id }})"
                                    icon="ti ti-trash-off" permission="email-templates.force.delete" />
                            @else
                                <x-icon-link icon="ti ti-eye" :route="route('admin.email-templates.show', $record->id)" permission="email-templates.read" />
                                <x-icon-link icon="ti ti-edit" :route="route('admin.email-templates.edit', $record->id)" permission="email-templates.update" />
                                <x-icon-button wire:click="confirmDelete({{ $record->id }})" icon="ti ti-trash"
                                    permission="email-templates.delete" />
                            @endif
                        </div>
                        {{-- /.card-footer --}}
                    </div>
                    {{-- /.card --}}
                </div>
                {{-- /.col --}}
            @endforeach
        </div>
        {{-- /.row --}}
    </div>
    {{ $records->links() }}

</div>
