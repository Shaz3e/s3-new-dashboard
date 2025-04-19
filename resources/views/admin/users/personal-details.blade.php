<div class="tab-pane" id="personal_details" role="tabpanel" aria-labelledby="profile-tab-2">


    <div class="row">
        {{-- Personal Information --}}
        <div class="col-lg-6">
            <div class="card">
                <form action="{{ route('admin.users.update', $user->id) }}" method="POST" data-validate>
                    @csrf
                    @method('PUT')
                    <input type="hidden" name="personalInformation" value="1">
                    <div class="card-header">
                        <h5>Personal Information</h5>
                    </div>
                    <div class="card-body">
                        <div class="row">
                            <div class="col-sm-6">
                                <div class="mb-3">
                                    <x-input type="text" name="first_name" label="First Name"
                                        placeholder="{{ $user->first_name }}" value="{{ $user->first_name }}"
                                        :required="true" />
                                </div>
                            </div>
                            {{-- /.col --}}
                            <div class="col-sm-6">
                                <div class="mb-3">
                                    <x-input type="text" name="last_name" label="Last Name"
                                        placeholder="{{ $user->last_name }}" value="{{ $user->last_name }}"
                                        :required="true" />
                                </div>
                            </div>
                            {{-- /.col --}}
                            <div class="col-sm-6">
                                <div class="mb-3">
                                    <x-input type="email" name="email" label="Email"
                                        placeholder="{{ $user->email }}" value="{{ $user->email }}"
                                        :required="true" />
                                </div>
                            </div>
                            {{-- /.col --}}
                            <div class="col-sm-6">
                                <div class="mb-3">
                                    <x-input type="date" name="dob" label="Date of Birth"
                                        value="{{ $user->profile->dob ? $user->profile->dob->format('Y-m-d') : '' }}" />
                                </div>
                            </div>
                            {{-- /.col --}}
                        </div>
                        {{-- /.row --}}
                    </div>
                    {{-- /.card-body --}}
                    <div class="card-footer text-end">
                        <x-button text="Save" />
                    </div>
                </form>
            </div>
            {{-- /.card --}}
        </div>
        {{-- /.col --}}

        {{-- Contact Information --}}
        <div class="col-lg-6">
            <div class="card">
                <form action="{{ route('admin.users.update', $user->id) }}" method="POST" enctype="multipart/form-data"
                    data-validate>
                    @csrf
                    @method('PUT')
                    <input type="hidden" name="contactInformation" value="1">
                    <div class="card-header">
                        <h5>Contact Information</h5>
                    </div>
                    <div class="card-body">
                        <div class="row">
                            <div class="col-sm-6">
                                <div class="mb-3">
                                    <x-input type="text" name="phone" label="Contact Phone"
                                        placeholder="+99 9999 999 999" value="{{ $user->profile->phone ?? '' }}" />
                                </div>
                            </div>
                            {{-- /.col --}}
                            <div class="col-sm-6">
                                <div class="mb-3">
                                    <x-input type="text" name="country" label="Country"
                                        value="{{ $user->profile->country ?? '' }}" />
                                </div>
                            </div>
                            {{-- /.col --}}
                            <div class="col-sm-4">
                                <div class="mb-3">
                                    <x-input type="text" name="state" label="State"
                                        value="{{ $user->profile->state ?? '' }}" />
                                </div>
                            </div>
                            {{-- /.col --}}
                            <div class="col-sm-4">
                                <div class="mb-3">
                                    <x-input type="text" name="city" label="City"
                                        value="{{ $user->profile->city ?? '' }}" />
                                </div>
                            </div>
                            {{-- /.col --}}
                            <div class="col-sm-4">
                                <div class="mb-3">
                                    <x-input type="text" name="zipcode" label="Zip Code"
                                        value="{{ $user->profile->zipcode ?? '' }}" />
                                </div>
                            </div>
                            {{-- /.col --}}
                            <div class="col-sm-12">
                                <div class="mb-3">
                                    <x-textarea name="address" label="Address"
                                        value="{{ $user->profile->address ?? '' }}" />
                                </div>
                            </div>
                            {{-- /.col --}}
                        </div>
                        {{-- /.row --}}
                    </div>
                    {{-- /.card-body --}}
                    <div class="card-footer text-end">
                        <x-button text="Save" />
                    </div>
                </form>
            </div>
            {{-- /.card --}}
        </div>
        {{-- /.col --}}
    </div>
    {{-- /.row --}}

    {{-- Avatar --}}
    <div class="row">
        <div class="col-lg-12">
            <div class="card">
                <form action="{{ route('admin.users.update', $user->id) }}" method="POST"
                    enctype="multipart/form-data" data-validate>
                    @csrf
                    @method('PUT')
                    <input type="hidden" name="updateAvatar" value="1">
                    <input type="hidden" name="selected_avatar" id="selected_avatar" value="">
                    <div class="card-header">
                        <h5>Profile Picture</h5>
                    </div>
                    <div class="card-body">
                        <div class="row">
                            @foreach (range(1, 15) as $i)
                                <div class="col-md-2 mb-3">
                                    <img class="rounded-circle img-fluid wid-70 avatar-image"
                                        src="{{ asset('avatars/avatar' . $i . '.jpg') }}"
                                        onclick="setAvatar('{{ asset('avatars/avatar' . $i . '.jpg') }}')">
                                </div>
                            @endforeach
                            <div class="col-md-12 mt-5">
                                <x-file-upload name="avatar"
                                    help_text="{{ __('Only JPG, PNG with max 2MB file size allowed. Best image size 512px x 512px') }}" />
                            </div>
                        </div>
                        {{-- /.row --}}
                    </div>
                    {{-- /.card-body --}}
                    <div class="card-footer text-end">
                        <x-button text="Update Profile Picture" />
                    </div>
                    {{-- /.card-footer --}}
                </form>
            </div>
            {{-- /.card --}}
        </div>
        {{-- /.col --}}
    </div>
    {{-- /.row --}}

</div>
@push('styles')
    <style>
        .selected-avatar {
            border: 3px solid #007bff;
            /* Blue border for highlighting */
            padding: 2px;
        }
    </style>
@endpush
@push('scripts')
    <script>
        function setAvatar(avatarPath) {
            var avatarInput = document.getElementById('selected_avatar');
            avatarInput.value = avatarPath;

            // Remove the highlight class from any previously selected avatar
            document.querySelectorAll('.avatar-image').forEach(function(img) {
                img.classList.remove('selected-avatar');
            });

            // Add the highlight class to the clicked avatar
            var selectedImage = document.querySelector(`img[src="${avatarPath}"]`);
            if (selectedImage) {
                selectedImage.classList.add('selected-avatar');
            }

            // Update the label text to display the selected file name
            var fileName = avatarPath.split('/').pop();
            var label = document.querySelector('#avatar');
            label.innerText = fileName;
            $('#allowUploadAvatar').show();
        }
    </script>
@endpush
