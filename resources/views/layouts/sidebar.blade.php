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

            @if(Auth::user()->hasRole(['BBA','Recruiter','TL']))
                <li class="dropdown">
                    <a href="#" class="menu-toggle nav-link has-dropdown"><i
                            data-feather="briefcase"></i><span>Employee Management</span></a>
                    <ul class="dropdown-menu">
                        <li><a class="nav-link" href="{{ route('users.index') }}">Employees</a></li>
                        @if(Auth::user()->hasRole('BBA'))
                            <li><a class="nav-link" href="{{ route('roles.index') }}">Roles</a></li>
                        @endif
                    </ul>
                </li>
            @endif

            <li class="dropdown">
                <a href="#" class="menu-toggle nav-link has-dropdown"><i
                        data-feather="briefcase"></i><span>Referrals</span></a>
                <ul class="dropdown-menu">
                    @if(Auth::user()->hasRole(['Recruiter','BBA']))
                    <li><a class="nav-link" href="{{ route('referrals.all') }}">Referrals</a></li>
                    @endif
                    <li><a class="nav-link" href="{{ route('referrals.index') }}">My Referrals</a></li>
                </ul>
            </li>

            @if(Auth::user()->hasRole(['BBA','Recruiter','TL','Interviewer']))
                <li class="dropdown">
                    <a href="#" class="menu-toggle nav-link has-dropdown"><i
                            data-feather="briefcase"></i><span>NHR</span></a>
                    <ul class="dropdown-menu">
                        @if(Auth::user()->hasRole(['BBA','Recruiter','Interviewer']))
                            <li><a class="nav-link" href="{{ route('nhr.all') }}">NHR</a></li>
                        @endif
                        @if(Auth::user()->hasRole('TL'))
                            <li><a class="nav-link" href="{{ route('nhr.index') }}">My NHR</a></li>
                        @endif
                    </ul>
                </li>
            @endif

            @if(Auth::user()->hasRole('BBA'))
                <li class="dropdown">
                    <a href="#" class="menu-toggle nav-link has-dropdown"><i
                            data-feather="briefcase"></i><span>Setting</span></a>
                    <ul class="dropdown-menu">
                        <li><a class="nav-link" href="{{ route('teams.index') }}">Teams</a></li>
                        <li><a class="nav-link" href="{{ route('positions.index') }}">Positions</a></li>
                        <li><a class="nav-link" href="{{ route('skills.index') }}">Skill Sets</a></li>
                        <li><a class="nav-link" href="{{ route('checklist.index') }}">Employee Checklists</a></li>
                    </ul>
                </li>
            @endif
            @if(Auth::user()->hasRole('Recruiter'))
                <li class="dropdown active">
                    <a href="{{ route('candidates.index') }}" class="nav-link"><i data-feather="monitor"></i><span>Candidates</span></a>
                </li>
            @endif
        </ul>
    </aside>
</div>
