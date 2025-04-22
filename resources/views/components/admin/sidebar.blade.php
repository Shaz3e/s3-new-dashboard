<!-- [ Sidebar Menu ] start -->
<nav class="pc-sidebar">
    <div class="navbar-wrapper">
        <div class="m-header">
            <a href="{{ route('admin.dashboard') }}" class="b-brand text-primary">
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
                            <small data-i18n="Administrator">Administrator</small>
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
                            <a href="{{ route('admin.profile') }}">
                                <i class="ti ti-user"></i>
                                <span data-i18n="My Account">My Account</span>
                            </a>
                            <a href="#!">
                                <i class="ti ti-settings"></i>
                                <span data-i18n="Settings">Settings</span>
                            </a>
                            <a href="{{ route('locked') }}">
                                <i class="ti ti-lock"></i>
                                <span data-i18n="Lock My Account">Lock My Account</span>
                            </a>
                            @hasanyrole('superadmin|developer|tester')
                                <a href="/pulse" target="_blank">
                                    <svg class="pc-icon text-muted me-2">
                                        <use xlink:href="#custom-presentation-chart"></use>
                                    </svg>
                                    <span data-i18n="App Pulse">App Pulse</span>
                                </a>
                                <a href="/log-viewer" target="_blank">
                                    <svg class="pc-icon text-muted me-2">
                                        <use xlink:href="#custom-layer"></use>
                                    </svg>
                                    <span data-i18n="Dev Logs">Dev Logs</span>
                                </a>
                                <a href="{{ route('admin.app-backup.index') }}">
                                    <svg class="pc-icon text-muted me-2">
                                        <use xlink:href="#custom-direct-inbox"></use>
                                    </svg>
                                    <span data-i18n="App Backup">App Backup</span>
                                </a>
                                @if (app()->environment('local'))
                                    <a href="/telescope" target="_blank">
                                        <svg class="pc-icon text-muted me-2">
                                            <use xlink:href="#custom-text-block"></use>
                                        </svg>
                                        <span data-i18n="App TeleScope">App TeleScope</span>
                                    </a>
                                @endif
                            @endhasanyrole
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

                @can('clients.list')
                    <li class="pc-item">
                        <a href="{{ route('admin.clients.index') }}" class="pc-link">
                            <span class="pc-micon">
                                <svg class="pc-icon">
                                    <use xlink:href="#custom-user"></use>
                                </svg>
                            </span>
                            <span class="pc-mtext" data-i18n="Clients">Clients</span>
                        </a>
                    </li>
                @endcan

                @can('users.list')
                    <li class="pc-item pc-caption">
                        <label data-i18n="Manage users & Roles">Manage User & Roles</label>
                    </li>
                    <li
                        class="pc-item pc-hasmenu {{ request()->routeIs('admin.users.*') || request()->routeIs('admin.roles.*') ? 'active' : '' }}">
                        <a href="#!" class="pc-link">
                            <span class="pc-micon">
                                <svg class="pc-icon">
                                    <use xlink:href="#custom-user-square"></use>
                                </svg>
                            </span>
                            <span class="pc-mtext" data-i18n="Manage User">Manage User</span>
                            <span class="pc-arrow"><i data-feather="chevron-right"></i></span>
                        </a>
                        <ul class="pc-submenu"
                            {{ request()->routeIs('admin.users.*') || request()->routeIs('admin.roles.*') ? 'style=display:block' : '' }}>
                            @can('users.list')
                                <li class="pc-item {{ Route::currentRouteName() == 'admin.users.index' ? 'active' : '' }}">
                                    <a class="pc-link" href="{{ route('admin.users.index') }}" data-i18n="User List">
                                        User List
                                    </a>
                                </li>
                            @endcan
                            @can('users.create')
                                <li class="pc-item {{ Route::currentRouteName() == 'admin.users.create' ? 'active' : '' }}">
                                    <a class="pc-link" href="{{ route('admin.users.create') }}" data-i18n="Create New User">
                                        Create New User
                                    </a>
                                </li>
                            @endcan
                            @can('roles.create')
                                <li class="pc-item {{ request()->routeIs('admin.roles.*') ? 'active' : '' }}">
                                    <a class="pc-link" href="{{ route('admin.roles.index') }}" data-i18n="Manage Roles">
                                        Roles
                                    </a>
                                </li>
                            @endcan
                        </ul>
                    </li>
                @endcan
            </ul>
        </div>
    </div>
</nav>
<!-- [ Sidebar Menu ] end -->
