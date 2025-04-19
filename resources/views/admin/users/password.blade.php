<div class="tab-pane" id="password" role="tabpanel" aria-labelledby="profile-tab-3">
    <div class="card">
        <form action="{{ route('admin.users.update', $user->id) }}" method="POST" data-validate>
            @csrf
            @method('PUT')
            {{-- @method('put') --}}
            <input type="hidden" name="updatePassword" value="1">

            <div class="card-header">
                <h5>Change Password</h5>
            </div>
            <div class="card-body">
                <div class="row">
                    <div class="col-sm-6">
                        <div class="mb-3">
                            <x-input type="password" name="password" label="New Password"
                                pattern="(?=.*\d)(?=.*[a-z])(?=.*[A-Z])(?=.*[\W_]).{8,}"
                                validation_message="Please choose a password that includes at least 1 uppercase character, 1 lowercase character, and 1 number and 1 special character."
                                required />
                        </div>
                    </div>
                    {{-- /.col --}}
                    <div class="col-sm-6">
                        <h5>New password must contain:</h5>
                        <ul class="list-group list-group-flush">
                            <li class="list-group-item">
                                <i class="ti ti-circle-check text-success f-16 me-2"></i> At least 8 characters
                            </li>
                            <li class="list-group-item">
                                <i class="ti ti-circle-check text-success f-16 me-2"></i> At least 1 lower letter (a-z)
                            </li>
                            <li class="list-group-item">
                                <i class="ti ti-circle-check text-success f-16 me-2"></i> At least 1 uppercase
                                letter(A-Z)
                            </li>
                            <li class="list-group-item">
                                <i class="ti ti-circle-check text-success f-16 me-2"></i> At least 1 number (0-9)
                            </li>
                            <li class="list-group-item">
                                <i class="ti ti-circle-check text-success f-16 me-2"></i> At least 1 special characters
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
        </form>
    </div>
    {{-- /.card --}}
</div>
