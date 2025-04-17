<x-form route="profile.update" enctype="true">
    <input type="hidden" name="updateProfile" value="1">
    <div class="row">
        <div class="col-lg-6">
            <div class="card">
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
                        <div class="col-sm-6">
                            <div class="mb-3">
                                <x-input type="text" name="last_name" label="Last Name"
                                    placeholder="{{ $user->last_name }}" value="{{ $user->last_name }}"
                                    :required="true" />
                            </div>
                        </div>
                        <div class="col-sm-6">
                            <div class="mb-3">
                                <x-input type="text" name="username" label="Username"
                                    placeholder="{{ $user->username }}" value="{{ $user->username }}"
                                    :required="true" />
                            </div>
                        </div>
                        <div class="col-sm-6">
                            <div class="mb-3">
                                <x-input type="date" name="dob" label="Date of Birth"
                                    value="{{ $user->profile->dob ? $user->profile->dob->format('Y-m-d') : '' }}" />
                            </div>
                        </div>
                        <div class="col-sm-6">
                            <div class="mb-3">
                                <x-select name="gender" label="{{ __('Select Gender') }}" :options="\App\Models\Profile::getGenderTypes()"
                                    :selected="old('gender', $user->profile->gender ?? '')" required="true" />
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-lg-6">
            <div class="card">
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
                        <div class="col-sm-6">
                            <div class="mb-3">
                                <x-input name="email" label="Email" value="{{ $user->email ?? '' }}" />
                            </div>
                        </div>
                        <div class="col-sm-6">
                            <div class="mb-3">
                                <x-input type="text" name="city" label="City"
                                    value="{{ $user->profile->city ?? '' }}" />
                            </div>
                        </div>
                        <div class="col-sm-6">
                            <div class="mb-3">
                                <x-input type="text" name="state" label="State"
                                    value="{{ $user->profile->state ?? '' }}" />
                            </div>
                        </div>
                        <div class="col-sm-6">
                            <div class="mb-3">
                                <x-input type="text" name="country" label="Country"
                                    value="{{ $user->profile->country ?? '' }}" />
                            </div>
                        </div>
                        <div class="col-sm-6">
                            <div class="mb-3">
                                <x-input type="text" name="zipcode" label="Zip Code"
                                    value="{{ $user->profile->zipcode ?? '' }}" />
                            </div>
                        </div>
                        <div class="col-sm-12">
                            <div class="mb-3">
                                <x-textarea name="address" label="Address"
                                    value="{{ $user->profile->address ?? '' }}" />
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-12 text-end btn-page">
            <x-button text="Update Profile" class="btn btn-primary" />
        </div>
    </div>
</x-form>
@include('account-profile.avatar')
