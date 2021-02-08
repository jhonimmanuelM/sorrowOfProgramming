<div class="main-sidebar sidebar-style-2">
    <aside id="sidebar-wrapper">
        <div class="sidebar-brand">
            <a href="{{ url('/') }}"> <img alt="image" src="{{ asset('assets/img/logo.png') }}" class="header-logo"/>
                <span
                    class="logo-name">Otika</span>
            </a>
        </div>
        <ul class="sidebar-menu">
        <!-- <li class="menu-header">Main</li>
            <li class="dropdown active">
                <a href="{{ url('/') }}" class="nav-link"><i data-feather="monitor"></i><span>Dashboard</span></a>
            </li> -->

            @if(Auth::user()->hasRole(['BBA','Recruiter','TL']))
                <li class="dropdown {{ Request::segment(1) === 'roles' ? 'active' : null }} {{ Request::segment(1) === 'users' ? 'active' : null }}">
                    <a href="#" class="menu-toggle nav-link has-dropdown">
                        <i class="fas fa-users"></i>
                        <span>User</span></a>
                    <ul class="dropdown-menu">
                        <li class="{{ Request::segment(1) === 'users' ? 'active' : null }}"><a class="nav-link"
                                                                                               href="{{ route('users.index') }}">Employees</a>
                        </li>
                        @if(Auth::user()->hasRole('BBA'))
                            <li class="{{ Request::segment(1) === 'roles' ? 'active' : null }}"><a class="nav-link"
                                                                                                   href="{{ route('roles.index') }}">Roles</a>
                            </li>
                        @endif
                    </ul>
                </li>
            @endif

            <li class="dropdown {{ Request::segment(1) === 'referrals' ? 'active' : null }}">
                <a href="#" class="menu-toggle nav-link has-dropdown"><i
                        data-feather="briefcase"></i><span>Referrals</span></a>
                <ul class="dropdown-menu">
                    @if(Auth::user()->hasRole(['Recruiter','BBA']))
                        <li class="{{ Request::segment(2) === 'all' ? 'active' : null }}"><a class="nav-link"
                                                                                             href="{{ route('referrals.all') }}">Referrals</a>
                        </li>
                    @endif
                    <li class="{{ Request::segment(1) === 'referrals' && Request::segment(2) !== 'all' ? 'active' : null }}">
                        <a class="nav-link" href="{{ route('referrals.index') }}">My Referrals</a></li>
                </ul>
            </li>

            @if(Auth::user()->hasRole(['BBA','Recruiter','TL','Interviewer']))
                <li class="dropdown {{ Request::segment(1) === 'nhr' ? 'active' : null }}">
                    <a href="#" class="menu-toggle nav-link has-dropdown">
                        <i class="fas fa-user-plus"></i>
                        <span>NHR</span></a>
                    <ul class="dropdown-menu">
                        @if(Auth::user()->hasRole(['BBA','Recruiter','Interviewer']))
                            <li class="{{ Request::segment(2) === 'all' ? 'active' : null }}"><a class="nav-link"
                                                                                                 href="{{ route('nhr.all') }}">NHR</a>
                            </li>
                        @endif
                        @if(Auth::user()->hasRole('TL'))
                            <li class="{{ Request::segment(1) === 'nhr' && Request::segment(2) !== 'all' ? 'active' : null }}">
                                <a class="nav-link" href="{{ route('nhr.index') }}">My NHR</a></li>
                        @endif
                    </ul>
                </li>
            @endif

            @if(Auth::user()->hasRole('BBA'))
                <li class="dropdown {{ Request::segment(1) === 'skills' ? 'active' : null }} {{ Request::segment(1) === 'positions' ? 'active' : null }} {{ Request::segment(1) === 'teams' ? 'active' : null }} {{ Request::segment(1) === 'checklist' ? 'active' : null }}">
                    <a href="#" class="menu-toggle nav-link has-dropdown">
                        <i class="fas fa-tools"></i>
                        <span>Settings</span></a>
                    <ul class="dropdown-menu">
                        <li class="{{ Request::segment(1) === 'teams' ? 'active' : null }}"><a class="nav-link"
                                                                                               href="{{ route('teams.index') }}">Teams</a>
                        </li>
                        <li class="{{ Request::segment(1) === 'positions' ? 'active' : null }}"><a class="nav-link"
                                                                                                   href="{{ route('positions.index') }}">Positions</a>
                        </li>
                        <li class="{{ Request::segment(1) === 'skills' ? 'active' : null }}"><a class="nav-link"
                                                                                                href="{{ route('skills.index') }}">Skill
                                Sets</a></li>
                        <li class="{{ Request::segment(1) === 'checklist' ? 'active' : null }}"><a class="nav-link"
                                                                                                   href="{{ route('checklist.index') }}">Employee
                                Checklists</a></li>
                    </ul>
                </li>
            @endif
            @if(Auth::user()->hasRole('Recruiter'))
                <li class="dropdown {{ Request::segment(1) === 'candidates' ? 'active' : null }}">
                    <a href="{{ route('candidates.index') }}" class="nav-link"><i data-feather="monitor"></i><span>Candidates</span></a>
                </li>
            @endif
        </ul>
    </aside>
</div>
