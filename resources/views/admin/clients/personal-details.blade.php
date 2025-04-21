<div class="tab-pane" id="personal_details" role="tabpanel" aria-labelledby="profile-tab-2">


    <div class="row">
        {{-- Personal Information --}}
        <div class="col-lg-6">
            <div class="card">
                <form action="{{ route('admin.clients.update', $client->id) }}" method="POST" data-validate>
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
                                        placeholder="{{ $client->first_name }}" value="{{ $client->first_name }}"
                                        :required="true" />
                                </div>
                            </div>
                            {{-- /.col --}}
                            <div class="col-sm-6">
                                <div class="mb-3">
                                    <x-input type="text" name="last_name" label="Last Name"
                                        placeholder="{{ $client->last_name }}" value="{{ $client->last_name }}"
                                        :required="true" />
                                </div>
                            </div>
                            {{-- /.col --}}
                            <div class="col-sm-6">
                                <div class="mb-3">
                                    <x-input type="text" name="username" label="Username"
                                        placeholder="{{ $client->username }}" value="{{ $client->username }}"
                                        :required="true" />
                                </div>
                            </div>
                            {{-- /.col --}}
                            <div class="col-sm-6">
                                <div class="mb-3">
                                    <x-input type="email" name="email" label="Email"
                                        placeholder="{{ $client->email }}" value="{{ $client->email }}"
                                        :required="true" />
                                </div>
                            </div>
                            {{-- /.col --}}
                            <div class="col-sm-6">
                                <div class="mb-3">
                                    <x-select name="gender" label="{{ __('Select Gender') }}" :options="\App\Models\Profile::getGenderTypes()"
                                        :selected="old('gender', $client->profile->gender ?? '')" required="true" />
                                </div>
                            </div>
                            {{-- /.col --}}
                            <div class="col-sm-6">
                                <div class="mb-3">
                                    <x-input type="date" name="dob" label="Date of Birth"
                                        value="{{ $client->profile->dob ? $client->profile->dob->format('Y-m-d') : '' }}" />
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
                <form action="{{ route('admin.clients.update', $client->id) }}" method="POST"
                    enctype="multipart/form-data" data-validate>
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
                                        placeholder="+99 9999 999 999" value="{{ $client->profile->phone ?? '' }}" />
                                </div>
                            </div>
                            {{-- /.col --}}
                            <div class="col-sm-6">
                                <div class="mb-3">
                                    <x-input type="text" name="country" label="Country"
                                        value="{{ $client->profile->country ?? '' }}" />
                                </div>
                            </div>
                            {{-- /.col --}}
                            <div class="col-sm-4">
                                <div class="mb-3">
                                    <x-input type="text" name="state" label="State"
                                        value="{{ $client->profile->state ?? '' }}" />
                                </div>
                            </div>
                            {{-- /.col --}}
                            <div class="col-sm-4">
                                <div class="mb-3">
                                    <x-input type="text" name="city" label="City"
                                        value="{{ $client->profile->city ?? '' }}" />
                                </div>
                            </div>
                            {{-- /.col --}}
                            <div class="col-sm-4">
                                <div class="mb-3">
                                    <x-input type="text" name="zipcode" label="Zip Code"
                                        value="{{ $client->profile->zipcode ?? '' }}" />
                                </div>
                            </div>
                            {{-- /.col --}}
                            <div class="col-sm-12">
                                <div class="mb-3">
                                    <x-textarea name="address" label="Address"
                                        value="{{ $client->profile->address ?? '' }}" />
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

    @include('admin.clients.avatar')

</div>
@push('styles')
@endpush
@push('scripts')
@endpush
