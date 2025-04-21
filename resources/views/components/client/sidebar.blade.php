<!-- [ Sidebar Menu ] start -->
<nav class="pc-sidebar">
    <div class="navbar-wrapper">
        <div class="m-header">
            <a href="{{ route('client.dashboard') }}" class="b-brand text-primary">
                <!-- ========   Change your logo from here   ============ -->
                <img src="../assets/images/logo-dark.svg" class="img-fluid logo-lg" alt="logo" />
                <span class="badge bg-light-success rounded-pill ms-2 theme-version">v9.5.1</span>
            </a>
        </div>
        <div class="navbar-content">
            <div class="card pc-user-card">
                <div class="card-body">
                    <div class="d-flex align-items-center">
                        <div class="flex-shrink-0">
                            <x-user-avatar class="user-avtar wid-45 rounded-circle" />
                        </div>
                        <div class="flex-grow-1 ms-3 me-2">
                            <h6 class="mb-0" data-i18n="{{ auth()->user()->name }}">{{ auth()->user()->name }}</h6>
                            <small data-i18n="My Dashboard">My Dashboard</small>
                        </div>
                        <a class="btn btn-icon btn-link-secondary avtar" data-bs-toggle="collapse"
                            href="#pc_sidebar_userlink">
                            <svg class="pc-icon">
                                <use xlink:href="#custom-sort-outline"></use>
                            </svg>
                        </a>
                    </div>
                    <div class="collapse pc-user-links" id="pc_sidebar_userlink">
                        <div class="pt-3">
                            <a href="{{ route('client.profile') }}">
                                <i class="ti ti-user"></i>
                                <span data-i18n="My Account">My Account</span>
                            </a>
                            <a href="#!">
                                <i class="ti ti-settings"></i>
                                <span data-i18n="Settings">Settings</span>
                            </a>
                            <a href="{{ route('locked') }}">
                                <i class="ti ti-lock"></i>
                                <span data-i18n="Lock Screen">Lock Screen</span>
                            </a>
                            <a href="javascript:void(0)" class="dropdown-item"
                                onclick="document.getElementById('logout-form').submit();">
                                <i class="ti ti-power"></i>
                                <span>Logout</span>
                            </a>
                        </div>
                    </div>
                </div>
            </div>

            <ul class="pc-navbar">
                @if (session()->has('impersonate'))
                    <li class="pc-item">
                        <a href="{{ route('admin.stop.impersonation') }}" class="pc-link">
                            <span class="pc-micon">
                                <svg class="pc-icon">
                                    <use xlink:href="#custom-status-up"></use>
                                </svg>
                            </span>
                            <span class="pc-mtext" data-i18n="Login Back As Staff">Login Back As Staff</span>
                        </a>
                    </li>
                @endif
                <li class="pc-item pc-caption">
                    <label data-i18n="Navigation">Navigation</label>
                </li>
                <li class="pc-item pc-hasmenu">
                    <a href="#!" class="pc-link">
                        <span class="pc-micon">
                            <svg class="pc-icon">
                                <use xlink:href="#custom-status-up"></use>
                            </svg>
                        </span>
                        <span class="pc-mtext" data-i18n="Dashboard">Dashboard</span>
                        <span class="pc-arrow"><i data-feather="chevron-right"></i></span>
                        <span class="pc-badge">2</span>
                    </a>
                    <ul class="pc-submenu">
                        <li class="pc-item"><a class="pc-link" href="../dashboard/index.html"
                                data-i18n="Default">Default</a></li>
                        <li class="pc-item"><a class="pc-link" href="../dashboard/analytics.html"
                                data-i18n="Analytics">Analytics</a></li>
                        <li class="pc-item"><a class="pc-link" href="../dashboard/finance.html"
                                data-i18n="Finance">Finance</a></li>
                    </ul>
                </li>
            </ul>
        </div>
    </div>
</nav>
<!-- [ Sidebar Menu ] end -->
