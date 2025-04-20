@extends('components.layouts.app')

@section('content')
    <x-page-title title="{{ 'Roles' }}" :breadcrumbs="[
        ['url' => '/', 'label' => __('Dashboard')],
        ['url' => route('admin.roles.index'), 'label' => __('Roles')],
        ['label' => __('Create New Role')],
    ]" />

    <form action="{{ route('admin.roles.store') }}" method="POST" data-validate>
        @csrf
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-4">
                                <div class="form-group">
                                    <x-input type="text" name="name" label="Role Name" required />
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
@endsection

@push('styles')
@endpush
@push('scripts')
@endpush
