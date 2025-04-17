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
                        <p class="mb-0">{{ $user->first_name }}</p>
                    </div>
                    <div class="col-md-6">
                        <p class="mb-1 text-muted">Last Name</p>
                        <p class="mb-0">{{ $user->last_name }}</p>
                    </div>
                </div>
            </li>
            <li class="list-group-item px-0">
                <div class="row">
                    <div class="col-md-6">
                        <p class="mb-1 text-muted">Phone</p>
                        <p class="mb-0">{{ $user->profile->phone }}</p>
                    </div>
                    <div class="col-md-6">
                        <p class="mb-1 text-muted">Country</p>
                        <p class="mb-0">{{ $user->profile->country }}</p>
                    </div>
                </div>
            </li>
            <li class="list-group-item px-0">
                <div class="row">
                    <div class="col-md-6">
                        <p class="mb-1 text-muted">Email</p>
                        <p class="mb-0">{{ $user->email }}</p>
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
</div>
