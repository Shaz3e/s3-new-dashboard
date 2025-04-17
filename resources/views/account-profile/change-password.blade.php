<div class="tab-pane" id="password" role="tabpanel" aria-labelledby="profile-tab-4">
    <div class="card">
        <x-form route="profile.update">
            <input type="hidden" name="updatePassword" value="1">

            <div class="card-header">
                <h5>Change Password</h5>
            </div>
            <div class="card-body">
                <div class="row">
                    <div class="col-sm-6">
                        <div class="mb-3">
                            <x-input type="password" name="current_password" label="Current Password" required />
                        </div>
                        <div class="mb-3">
                            <x-input type="password" name="password" label="New Password"
                                pattern="(?=.*\d)(?=.*[a-z])(?=.*[A-Z])(?=.*[\W_]).{8,65}"
                                validation_message="Please choose a password that includes at least 1 uppercase character, 1 lowercase character, and 1 number and 1 special character."
                                required />
                        </div>
                        <div class="mb-3">
                            <x-input type="password" name="confirm_password" label="Confirm Password"
                                data-bouncer-match="#password"
                                data-bouncer-mismatch-message="Your passwords do not match." required />
                        </div>
                    </div>
                    {{-- /.col --}}
                    <div class="col-sm-6">
                        <h5>New password must contain:</h5>
                        <ul class="list-group list-group-flush" id="password-requirements">
                            <li class="list-group-item" id="require-length">
                                <i class="ti ti-minus text-danger f-16 me-2"></i> At least 8 characters
                            </li>
                            <li class="list-group-item" id="require-lower">
                                <i class="ti ti-minus text-danger f-16 me-2"></i> At least 1 lowercase letter (a-z)
                            </li>
                            <li class="list-group-item" id="require-upper">
                                <i class="ti ti-minus text-danger f-16 me-2"></i> At least 1 uppercase letter (A-Z)
                            </li>
                            <li class="list-group-item" id="require-number">
                                <i class="ti ti-minus text-danger f-16 me-2"></i> At least 1 number (0-9)
                            </li>
                            <li class="list-group-item" id="require-special">
                                <i class="ti ti-minus text-danger f-16 me-2"></i> At least 1 special character
                            </li>
                        </ul>
                    </div>
                    {{-- /.col --}}
                </div>
                {{-- /.row --}}
            </div>
            {{-- /.card-body --}}
            <div class="card-footer text-end btn-page">
                <x-button text="Change Password" />
            </div>
        </x-form>
    </div>
    {{-- /.card --}}
</div>

@push('js')
    <script>
        document.addEventListener('DOMContentLoaded', () => {
            const passwordField = document.getElementById('password');
            const requirements = {
                length: document.getElementById('require-length'),
                lower: document.getElementById('require-lower'),
                upper: document.getElementById('require-upper'),
                number: document.getElementById('require-number'),
                special: document.getElementById('require-special'),
            };

            passwordField.addEventListener('input', (e) => {
                const value = e.target.value;

                // Check each requirement
                const checks = {
                    length: value.length >= 8 && value.length <= 65,
                    lower: /[a-z]/.test(value),
                    upper: /[A-Z]/.test(value),
                    number: /[0-9]/.test(value),
                    special: /[\W_]/.test(value),
                };

                // Update icons dynamically
                for (const [key, isValid] of Object.entries(checks)) {
                    const requirement = requirements[key];
                    const icon = requirement.querySelector('i');
                    if (isValid) {
                        icon.className = 'ti ti-circle-check text-success f-16 me-2';
                    } else {
                        icon.className = 'ti ti-minus text-danger f-16 me-2';
                    }
                }
            });
        });
    </script>
@endpush
