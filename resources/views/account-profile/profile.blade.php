<div class="card">
    <div class="card-body position-relative">
        <div class="position-absolute end-0 top-0 p-3">
            <span class="badge bg-primary">Pro</span>
        </div>
        <div class="text-center mt-3">
            <div class="chat-avtar d-inline-flex mx-auto">
                {{-- <img class="rounded-circle img-fluid wid-70" src="../assets/images/user/avatar-5.jpg" alt="User image" /> --}}
                <x-user-avatar class="rounded-circle img-fluid wid-70" />
            </div>
            <h5 class="mb-0">{{ $user->name }}</h5>
            <p class="text-muted text-sm">{{ $user->username }}</p>
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
                <p class="mb-0">{{ $user->profile->city }}</p>
            </div>
        </div>
    </div>
</div>
