<div class="main-sidebar sidebar-style-2">
    <aside id="sidebar-wrapper">
        <div class="sidebar-brand">
            <a href="index.html"> <img alt="image" src="{{ asset('assets/img/logo.png') }}" class="header-logo"/> <span
                    class="logo-name">Otika</span>
            </a>
        </div>
        <ul class="sidebar-menu">
            <li class="menu-header">Main</li>
            <li class="dropdown active">
                <a href="{{ url('/') }}" class="nav-link"><i data-feather="monitor"></i><span>Dashboard</span></a>
            </li>

            @can('user-list')
                <li class="dropdown">
                    <a href="#" class="menu-toggle nav-link has-dropdown"><i
                            data-feather="briefcase"></i><span>User Management</span></a>
                    <ul class="dropdown-menu">
                        <li><a class="nav-link" href="{{ route('users.index') }}">Users</a></li>
                        <li><a class="nav-link" href="{{ route('roles.index') }}">Roles</a></li>
                    </ul>
                </li>
            @endcan

            @can('referral-list')
                <li class="dropdown">
                    <a href="#" class="menu-toggle nav-link has-dropdown"><i
                            data-feather="briefcase"></i><span>Referrals</span></a>
                    <ul class="dropdown-menu">
                        <li><a class="nav-link" href="{{ route('referrals.all') }}">Referrals</a></li>
                        <li><a class="nav-link" href="{{ route('referrals.index') }}">My Referrals</a></li>
                    </ul>
                </li>
            @endcan

            @can('NHR-list')
                <li class="dropdown">
                    <a href="#" class="menu-toggle nav-link has-dropdown"><i
                            data-feather="briefcase"></i><span>NHR</span></a>
                    <ul class="dropdown-menu">
                        <li><a class="nav-link" href="{{ route('nhr.all') }}">NHR</a></li>
                        <li><a class="nav-link" href="{{ route('nhr.index') }}">My NHR</a></li>
                    </ul>
                </li>
            @endcan

            @can('settings-list')
                <li class="dropdown">
                    <a href="#" class="menu-toggle nav-link has-dropdown"><i
                            data-feather="briefcase"></i><span>Setting</span></a>
                    <ul class="dropdown-menu">
                        <li><a class="nav-link" href="{{ route('teams.index') }}">Teams</a></li>
                        <li><a class="nav-link" href="{{ route('positions.index') }}">Positions</a></li>
                        <li><a class="nav-link" href="{{ route('skills.index') }}">Skill Sets</a></li>
                    </ul>
                </li>
            @endcan

            <li class="dropdown active">
                <a href="{{ route('candidates.index') }}" class="nav-link"><i data-feather="monitor"></i><span>Candidates</span></a>
            </li>
        </ul>
    </aside>
</div>
