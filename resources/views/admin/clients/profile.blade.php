<div class="tab-pane show active" id="profile" role="tabpanel" aria-labelledby="profile-tab-1">
    <div class="row">
        <div class="col-lg-4 col-xxl-3">
            <div class="card">
                <div class="card-body position-relative">
                    <div class="text-center mt-3">
                        {{-- <hr class="my-3 border border-secondary-subtle" /> --}}
                        <div class="d-inline-flex align-items-center justify-content-start w-100 mb-3">
                            <i class="ti ti-mail me-2"></i>
                            <p class="mb-0">{{ $client->email }}</p>
                        </div>
                        @if ($client->profile->phone)
                            <div class="d-inline-flex align-items-center justify-content-start w-100 mb-3">
                                <i class="ti ti-phone me-2"></i>
                                <p class="mb-0">{{ $client->profile->phone }}</p>
                            </div>
                        @endif
                        @if ($client->profile->country)
                            <div class="d-inline-flex align-items-center justify-content-start w-100 mb-3">
                                <i class="ti ti-map-pin me-2"></i>
                                <p class="mb-0">{{ $client->profile->country }}</p>
                            </div>
                        @endif
                    </div>
                </div>
                {{-- /.card-body --}}
            </div>
            {{-- /.card --}}

            <div class="card">
                <div class="card-body">
                    <div class="d-grid gap-2 mt-2">
                        <x-action-link text="Login As Client" class="btn btn-outline-success" :route="route('admin.login.as.client', $client->id)" />
                    </div>
                    <div class="d-grid gap-2 mt-2">
                        @if ($client->email_verified_at)
                            <x-action-link text="Mark Email As Not Verified" class="btn btn-outline-danger"
                                :route="route('admin.clients.show', ['client' => $client, 'verified' => 0])" permission="clients.update" />
                        @else
                            <x-action-link text="Mark Email As Verified" class="btn btn-outline-success"
                                :route="route('admin.clients.show', ['client' => $client, 'verified' => 1])" permission="clients.update" />
                        @endif
                    </div>
                    <div class="d-grid gap-2 mt-2">
                        @if ($client->is_suspended)
                            <x-action-link text="Unsuspend Client" class="btn btn-outline-success" :route="route('admin.clients.show', ['client' => $client, 'suspended' => 0])"
                                permission="clients.update" />
                        @else
                            <x-action-link text="Suspend Client" class="btn btn-outline-danger" :route="route('admin.clients.show', ['client' => $client, 'suspended' => 1])"
                                permission="clients.update" />
                        @endif
                    </div>
                </div>
                {{-- /.card-body --}}
            </div>
            {{-- /.card --}}
        </div>
        {{-- /.col --}}

        <div class="col-lg-8 col-xxl-9">
            {{-- Personal Information --}}
            <div class="card">
                <div class="card-header">
                    <h5>Personal Details</h5>
                </div>
                <div class="card-body">
                    <ul class="list-group list-group-flush">
                        <li class="list-group-item px-0 pt-0">
                            <div class="row">
                                <div class="col-md-6">
                                    <p class="mb-1 text-muted">First Name</p>
                                    <p class="mb-0">{{ $client->first_name }}</p>
                                </div>
                                <div class="col-md-6">
                                    <p class="mb-1 text-muted">Last Name</p>
                                    <p class="mb-0">{{ $client->last_name }}</p>
                                </div>
                            </div>
                        </li>
                        <li class="list-group-item px-0">
                            <div class="row">
                                <div class="col-md-6">
                                    <p class="mb-1 text-muted">Gender</p>
                                    <p class="mb-0">{{ $client->profile->gender }}</p>
                                </div>
                                <div class="col-md-6">
                                    <p class="mb-1 text-muted">Date of Birth</p>
                                    <p class="mb-0">
                                        {{ $client->profile->dob ? $client->profile->dob->format('d M Y') : 'N/A' }}</p>
                                </div>
                            </div>
                        </li>
                    </ul>
                </div>
                {{-- /.card-body --}}
            </div>
            {{-- /.card --}}

            {{-- Contact Information --}}
            <div class="card">
                <div class="card-header">
                    <h5>Contact Details</h5>
                </div>
                <div class="card-body">
                    <ul class="list-group list-group-flush">
                        <li class="list-group-item px-0 pt-0">
                            <div class="row">
                                <div class="col-md-6">
                                    <p class="mb-1 text-muted">Country</p>
                                    <p class="mb-0">{{ $client->profile->country }}</p>
                                </div>
                                <div class="col-md-6">
                                    <p class="mb-1 text-muted">State</p>
                                    <p class="mb-0">{{ $client->profile->state }}</p>
                                </div>
                            </div>
                        </li>
                        <li class="list-group-item px-0">
                            <div class="row">
                                <div class="col-md-6">
                                    <p class="mb-1 text-muted">City</p>
                                    <p class="mb-0">{{ $client->profile->city }}</p>
                                </div>
                                <div class="col-md-6">
                                    <p class="mb-1 text-muted">Zip Code</p>
                                    <p class="mb-0">{{ $client->profile->zipcode }}</p>
                                </div>
                            </div>
                        </li>
                        <li class="list-group-item px-0">
                            <div class="row">
                                <div class="col-md-12">
                                    <p class="mb-1 text-muted">Address</p>
                                    <p class="mb-0">{{ $client->profile->address }}</p>
                                </div>
                            </div>
                        </li>
                    </ul>
                </div>
                {{-- /.card-body --}}
            </div>
            {{-- /.card --}}
        </div>
        {{-- /.col-md-6 --}}
    </div>
    {{-- /.row --}}
</div>
{{-- /.tab-pane --}}
