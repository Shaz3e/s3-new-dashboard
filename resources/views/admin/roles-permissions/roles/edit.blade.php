@extends('components.layouts.app')

@section('content')
    <x-page-title title="{{ 'Roles' }}" :breadcrumbs="[
        ['url' => '/', 'label' => __('Dashboard')],
        ['url' => route('admin.roles.index'), 'label' => __('Roles')],
        ['label' => __('Edit Role')],
    ]" />

    <form action="{{ route('admin.roles.update', $role->id) }}" method="POST" data-validate>
        @csrf
        @method('PUT')
        <div class="row mb-2">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-4">
                                <div class="form-group">
                                    <x-input type="text" name="name" label="Role Name" value="{{ $role->name }}"
                                        required />
                                </div>
                            </div>
                            {{-- /.col --}}
                        </div>
                        {{-- /.row --}}
                    </div>
                    {{-- /.card-body --}}
                    <div class="card-footer">
                        <x-button />
                    </div>
                    {{-- /.card-footer --}}
                </div>
                {{-- /.card --}}
            </div>
            {{-- /.col --}}
        </div>
        {{-- /.row --}}
    </form>

    <form action="{{ route('admin.roles.update', $role->id) }}" method="POST" data-validate>
        @csrf
        @method('PUT')
        <input type="hidden" name="syncPermissions" value="1">
        <div class="row mb-2">
            <div class="col-md-12">
                <div class="card table-card">
                    <div class="card-body">
                        <div class="table-responsive mb-0">
                            <table class="table table-hover table-bordered">
                                <thead>
                                    <tr>
                                        <th>{{ __('Permissions') }}</th>
                                        <th class="text-center">{{ __('All') }}</th>
                                        <th class="text-center">{{ __('List') }}</th>
                                        <th class="text-center">{{ __('Create') }}</th>
                                        <th class="text-center">{{ __('Read') }}</th>
                                        <th class="text-center">{{ __('Update') }}</th>
                                        <th class="text-center">{{ __('Delete') }}</th>
                                        <th class="text-center">{{ __('Restore') }}</th>
                                        <th class="text-center">{{ __('Force Delete') }}</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($permissions->groupBy(function ($permission) {
            return explode('.', $permission->name)[0];
        }) as $modelName => $modelPermissions)
                                        <tr>
                                            <td>
                                                {{ str_replace('-', ' ', strtoupper($modelName)) }}
                                            </td>
                                            <td class="text-center"><input type="checkbox"></td>
                                            @foreach (['list', 'create', 'read', 'update', 'delete', 'restore', 'force.delete'] as $action)
                                                <td class="text-center">
                                                    @if (
                                                        $modelPermissions->contains(function ($permission) use ($action) {
                                                            return str_contains($permission->name, $action);
                                                        }))
                                                        <input type="checkbox" name="permissions[]"
                                                            class="form-checkbox-input"
                                                            id="checkPermission-{{ $modelPermissions->first(function ($permission) use ($action) {
                                                                return str_contains($permission->name, $action);
                                                            })->id }}"
                                                            value="{{ $modelPermissions->first(function ($permission) use ($action) {
                                                                return str_contains($permission->name, $action);
                                                            })->name }}"
                                                            {{ in_array(
                                                                $modelPermissions->first(function ($permission) use ($action) {
                                                                    return str_contains($permission->name, $action);
                                                                })->id,
                                                                $rolePermissions,
                                                            )
                                                                ? 'checked'
                                                                : '' }} />
                                                    @endif
                                                </td>
                                            @endforeach
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                        {{-- /.table-responsive --}}
                    </div>
                    {{-- /.card-body --}}
                    <div class="card-footer">
                        <x-button text="Add/Remove Permissions" />
                    </div>
                    {{-- /.card-footer --}}
                </div>
                {{-- /.card --}}
            </div>
            {{-- /.col --}}
        </div>
        {{-- /.row --}}
    </form>
@endsection

@push('styles')
@endpush
@push('scripts')
    <script>
        // Select all checkboxes in a row when "All" is clicked
        $('tbody tr td:nth-child(2) input[type="checkbox"]').on('click', function() {
            var row = $(this).closest('tr');
            row.find('td input[type="checkbox"]').prop('checked', $(this).is(':checked'));
        });

        // Check "Delete" and "Restore" when "Force Delete" is clicked
        $('tbody tr td:nth-child(9) input[type="checkbox"]').on('click', function() {
            var row = $(this).closest('tr');
            if ($(this).is(':checked')) {
                // If "Force Delete" is checked, check "Delete" and "Restore"
                row.find('td:nth-child(7) input[type="checkbox"]').prop('checked', true);
                row.find('td:nth-child(8) input[type="checkbox"]').prop('checked', true);
            } else {
                // If "Force Delete" is unchecked, also uncheck "Delete" and "Restore"
                row.find('td:nth-child(7) input[type="checkbox"]').prop('checked', false);
                row.find('td:nth-child(8) input[type="checkbox"]').prop('checked', false);
            }
        });

        // Uncheck "Restore" and "Force Delete" when "Delete" is unchecked
        $('tbody tr td:nth-child(7) input[type="checkbox"]').on('click', function() {
            var row = $(this).closest('tr');
            if (!$(this).is(':checked')) {
                // If "Delete" is unchecked, uncheck "Restore" and "Force Delete"
                row.find('td:nth-child(8) input[type="checkbox"]').prop('checked', false);
                row.find('td:nth-child(9) input[type="checkbox"]').prop('checked', false);
            }
        });
    </script>
@endpush
