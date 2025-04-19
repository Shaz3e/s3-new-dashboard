<div class="tab-pane show active" id="profile" role="tabpanel" aria-labelledby="profile-tab-1">
    <div class="row">
        <div class="col-lg-4 col-xxl-3">
            <div class="card">
                <div class="card-body position-relative">
                    <div class="text-center mt-3">
                        <div class="chat-avtar d-inline-flex mx-auto">
                            <x-user-avatar :user="$user" class="rounded-circle img-fluid wid-70" />
                        </div>
                        <h5 class="mb-0">{{ $user->name }}</h5>
                        <hr class="my-3 border border-secondary-subtle" />
                        <div class="row g-3">
                            <div class="col-4">
                                <h5 class="mb-0">86</h5>
                                <small class="text-muted">Post</small>
                            </div>
                            <div class="col-4 border border-top-0 border-bottom-0">
                                <h5 class="mb-0">40</h5>
                                <small class="text-muted">Project</small>
                            </div>
                            <div class="col-4">
                                <h5 class="mb-0">4.5K</h5>
                                <small class="text-muted">Members</small>
                            </div>
                        </div>
                        <hr class="my-3 border border-secondary-subtle" />
                        <div class="d-inline-flex align-items-center justify-content-start w-100 mb-3">
                            <i class="ti ti-mail me-2"></i>
                            <p class="mb-0">{{ $user->email }}</p>
                        </div>
                        <div class="d-inline-flex align-items-center justify-content-start w-100 mb-3">
                            <i class="ti ti-phone me-2"></i>
                            <p class="mb-0">{{ $user->profile->phone }}</p>
                        </div>
                        <div class="d-inline-flex align-items-center justify-content-start w-100 mb-3">
                            <i class="ti ti-map-pin me-2"></i>
                            <p class="mb-0">{{ $user->profile->country }}</p>
                        </div>
                    </div>
                </div>
                {{-- /.card-body --}}
            </div>
            {{-- /.card --}}
        </div>
        {{-- /.col --}}

        <div class="col-lg-8 col-xxl-9">
            <div class="card">
                <div class="card-header">
                    <h5>Personal Details</h5>
                </div>
                <div class="card-body">
                    <ul class="list-group list-group-flush">
                        <li class="list-group-item px-0 pt-0">
                            <div class="row">
                                <div class="col-md-6">
                                    <p class="mb-1 text-muted">Full Name</p>
                                    <p class="mb-0">{{ $user->name }}</p>
                                </div>
                                <div class="col-md-6">
                                    <p class="mb-1 text-muted">Phone</p>
                                    <p class="mb-0">{{ $user->profile->phone }}</p>
                                </div>
                            </div>
                        </li>
                        <li class="list-group-item px-0">
                            <div class="row">
                                <div class="col-md-6">
                                    <p class="mb-1 text-muted">Country</p>
                                    <p class="mb-0">{{ $user->profile->country }}</p>
                                </div>
                                <div class="col-md-6">
                                    <p class="mb-1 text-muted">State</p>
                                    <p class="mb-0">{{ $user->profile->country }}</p>
                                </div>
                            </div>
                        </li>
                        <li class="list-group-item px-0">
                            <div class="row">
                                <div class="col-md-6">
                                    <p class="mb-1 text-muted">City</p>
                                    <p class="mb-0">{{ $user->profile->country }}</p>
                                </div>
                                <div class="col-md-6">
                                    <p class="mb-1 text-muted">Zip Code</p>
                                    <p class="mb-0">{{ $user->profile->zipcode }}</p>
                                </div>
                            </div>
                        </li>
                        <li class="list-group-item px-0 pb-0">
                            <p class="mb-1 text-muted">Address</p>
                            <p class="mb-0">{{ $user->profile->address }}</p>
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
