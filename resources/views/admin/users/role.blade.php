<div class="tab-pane" id="role" role="tabpanel" aria-labelledby="profile-tab-4">
    <div class="card">
        <form action="{{ route('admin.users.update', $user->id) }}" method="POST" data-validate>
            @csrf
            @method('PUT')
            {{-- @method('put') --}}
            <input type="hidden" name="updateRoles" value="1">

            <div class="card-header">
                <h5>User's Role(s)</h5>
            </div>
            <div class="card-body">
                <div class="row">
                    <div class="col-sm-12">
                        <div class="mb-3">
                            <select class="form-control" data-trigger name="roles[]" id="roles" multiple required>
                                @foreach ($roles as $role)
                                    <option value="{{ $role }}"
                                        {{ in_array($role, $userRoles) ? 'selected' : '' }}>
                                        {{ $role }}
                                    </option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    {{-- /.col --}}
                </div>
                {{-- /.row --}}
            </div>
            {{-- /.card-body --}}
            <div class="card-footer text-end btn-page">
                <x-button text="Update Role(s)" />
            </div>
        </form>
    </div>
    {{-- /.card --}}
</div>
@push('styles')
@endpush
@push('scripts')
    <script src="{{ asset('assets/js/plugins/choices.min.js') }}"></script>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            // Initialize Choices.js with the remove button
            var genericExamples = document.querySelectorAll('[data-trigger]');
            for (let i = 0; i < genericExamples.length; ++i) {
                var element = genericExamples[i];
                new Choices(element, {
                    removeItemButton: true, // Add remove button
                    placeholderValue: 'Select your roles',
                    searchPlaceholderValue: 'Search roles'
                });
            }
        });
    </script>
@endpush
