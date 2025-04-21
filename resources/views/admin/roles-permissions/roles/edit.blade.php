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
                            <table class="table table-hover table-bordered" id="permissionsTable">
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
                                        @php $rowId = strtolower($modelName); @endphp
                                        <tr data-row="{{ $rowId }}">
                                            <td>{{ str_replace('-', ' ', strtoupper($modelName)) }}</td>
                                            <td class="text-center">
                                                <input type="checkbox" class="check-all" data-row="{{ $rowId }}">
                                            </td>
                                            @foreach (['list', 'create', 'read', 'update', 'delete', 'restore', 'force.delete'] as $action)
                                                @php
                                                    $permission = $modelPermissions->first(function ($p) use ($action) {
                                                        return str_contains($p->name, $action);
                                                    });
                                                @endphp
                                                <td class="text-center">
                                                    @if ($permission)
                                                        <input type="checkbox" name="permissions[]"
                                                            class="form-checkbox-input action-checkbox"
                                                            data-action="{{ $action }}"
                                                            data-row="{{ $rowId }}"
                                                            id="checkPermission-{{ $permission->id }}"
                                                            value="{{ $permission->name }}"
                                                            {{ in_array($permission->id, $rolePermissions) ? 'checked' : '' }} />
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
        document.addEventListener("DOMContentLoaded", function() {
            const table = document.getElementById('permissionsTable');

            // Toggle all checkboxes in a row
            table.querySelectorAll(".check-all").forEach(allCheckbox => {
                allCheckbox.addEventListener("change", function() {
                    const row = this.dataset.row;
                    table.querySelectorAll(`input.action-checkbox[data-row="${row}"]`).forEach(
                        cb => {
                            cb.checked = this.checked;
                        });
                });
            });

            // Handle dependency of restore/force.delete on delete
            table.querySelectorAll(`input.action-checkbox[data-action="delete"]`).forEach(deleteCheckbox => {
                deleteCheckbox.addEventListener("change", function() {
                    const row = this.dataset.row;
                    if (!this.checked) {
                        table.querySelectorAll([
                            `input.action-checkbox[data-row="${row}"][data-action="restore"]`,
                            `input.action-checkbox[data-row="${row}"][data-action="force.delete"]`
                        ].join(',')).forEach(cb => {
                            cb.checked = false;
                        });
                    }
                });
            });
        });
    </script>
@endpush
