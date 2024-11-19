<!-- Mobile Header -->
{{-- <div class="mobile-header">
    <div class="container-fluid">
        <div class="d-flex">
            <a onclick="sidenavToggledApi()" aria-label="Hide Sidebar" class="app-sidebar__toggle" data-toggle="sidebar"
                href=javascript:;></a>

            <a class="header-brand" href="{{ route('dashboard') }}"></a>


            <div class="d-flex order-lg-2 ml-auto header-right-icons">

                <div class="dropdown profile-1 mx-1">
                    <a href=javascript:; data-toggle="dropdown" class="nav-link leading-none d-flex py-4">
                        <span
                            class="flag-icon flag-icon-{{ Config::get('languages')[App::getLocale()]['flag-icon'] }}"></span>
                        <h5 class="text-dark mb-0"> {{ Config::get('languages')[App::getLocale()]['display'] }} </h5>
                    </a>
                    <div class="dropdown-menu dropdown-menu-right dropdown-menu-arrow"
                        aria-labelledby="navbarDropdownMenuLink">
                        @foreach (Config::get('languages') as $lang => $language)
                            @if ($lang != App::getLocale())
                                <a class="dropdown-item" href="{{ route('lang.switch', $lang) }}">
                                    <span class="flag-icon flag-icon-{{ $language['flag-icon'] }}"></span>
                                    {{ $language['display'] }}
                                </a>
                            @endif
                        @endforeach
                    </div>
                </div>

                <div class="dropdown profile-1">
                    <a href=javascript:; data-toggle="dropdown" class="nav-link pr-2 leading-none d-flex">
                        <span>
                            <img src="{{ URL::asset('assets/images/users/10.jpg') }}" alt="profile-user"
                                class="avatar  profile-user brround cover-image">
                        </span>
                    </a>
                    <div class="dropdown-menu dropdown-menu-right dropdown-menu-arrow">
                        <div class="drop-heading">
                            <div class="text-center">
                                @auth
                                    <h5 class="text-dark mb-0">{{ auth()->user()->name() }}</h5>
                                    <div class="text-muted text-sm">
                                        {{ auth()->user()->rolesSideBySide() }}
                                    </div>
                                @endauth
                            </div>
                        </div>

                        <a class="dropdown-item" href="{{ route('dashboard') }}">
                            <i class="dropdown-icon mdi mdi-home-outline"></i>
                            {{ __('global.home') }}
                        </a>

                        <a class="dropdown-item" href="{{ route('edit.profile') }}">
                            <i class="dropdown-icon mdi mdi-account-outline"></i>
                            {{ __('global.edit-profile') }}
                        </a>
                        <div class="dropdown-divider m-0"></div>


                        <a class="dropdown-item" href="{{ route('logout') }}"
                            onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                            <i class="dropdown-icon mdi  mdi-logout-variant"></i> Sign out
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div> --}}


<nav class="navbar navbar-expand-lg navbar-light bg-light d-sm-block d-md-none">
    <!--tips: to change the nav placement use .fixed-top,.fixed-bottom,.sticky-top-->
    <a class="navbar-brand" href="#">
        @auth
            <h5 class="text-dark mb-0">{{ auth()->user()->name() }}</h5>
        @endauth

        @guest
            <h5 class="text-dark mb-0">{{ __('user.guest') }}</h5>
        @endguest

    </a>

    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarContent"
        aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
        {{-- <span class="navbar-toggler-icon"></span> --}}
        <span class="fa fa-navicon"></span>
    </button>

    <div class="collapse navbar-collapse" id="navbarContent">








        <ul class="mr-auto">
            <a aria-haspopup="true" href="{{ route('dashboard') }}" class="dropdown-item ps-4">

                <i class="fa fa-dashboard text-gray align-self-center pe-1" style="size: 13px"></i>
                <label class="text-dark ">
                    {{ __('global.dashboard') }}
                </label>

            </a>

            @php
                $company = \App\Models\Company::latest()->first();
            @endphp
            @if ($company)
                <a aria-haspopup="true" href="" class="dropdown-item ps-4 ">

                    <div class="row w-100 m-0">
                        <div class="col-auto p-0">
                            <img src="{{ asset('assets/dashboard/company.png') }}" width="16" height="13"
                                alt="" srcset="">

                        </div>
                        <div class="col-auto p-0 ms-1">
                            <label class='text-dark'>
                                {{ __('global.company') }}
                            </label>

                        </div>
                    </div>
                </a>
            @endif

            <a aria-haspopup="true" href="{{ route('area.index') }}" class="dropdown-item ps-4 ">

                <div class="row w-100 m-0">
                    <div class="col-auto p-0"><img src="{{ asset('assets/dashboard/region.png') }}" width="16"
                            height="13" alt="" srcset="">
                    </div>
                    <div class="col-auto p-0 ms-1">
                        <label class='text-dark'>
                            {{ __('global.region') }}
                        </label>
                    </div>
                </div>

            </a>

            <a aria-haspopup="true" href="{{ route('branch.index') }}" class="dropdown-item ps-4 ">

                <div class="row w-100 m-0">
                    <div class="col-auto p-0">
                        <img src="{{ asset('assets/dashboard/branch.png') }}" width="16" height="13"
                            alt="" srcset="">
                    </div>
                    <div class="col-auto px-0 ms-1">
                        <label class='text-dark'>
                            {{ __('global.branches') }}
                        </label>
                    </div>
                </div>

            </a>

            <a aria-haspopup="true" href="{{ route('department.index') }}" class="dropdown-item ps-4 ">

                <div class="row w-100 m-0">
                    <div class="col-auto p-0">
                        <img src="{{ asset('assets/dashboard/department.png') }}" class="me-1" width="16"
                            height="13" alt="" srcset="">

                    </div>
                    <div class="col-auto p-0 ms-1">
                        <label class='text-dark'>
                            {{ __('global.departments') }}
                        </label>
                    </div>
                </div>

            </a>
            <a aria-haspopup="true" href="{{ route('user.index') }}" class="dropdown-item ps-4 ">

                <div class="row w-100 m-0">
                    <div class="col-auto p-0">
                        <img src="{{ asset('assets/dashboard/person.png') }}" class="me-1" width="16"
                            height="13" alt="" srcset="">
                    </div>

                    <div class="col-auto p-0 ms-1">
                        <label class='text-dark'>
                            {{ __('global.users') }}
                        </label>
                    </div>
                </div>

            </a>
            <a aria-haspopup="true" href="{{ route('permission.page') }}" class="dropdown-item ps-4 ">

                <div class="row w-100 m-0">
                    <div class="col-auto p-0">
                        <img src="{{ asset('assets/dashboard/team.png') }}" class="me-1" width="16"
                            height="13" alt="" srcset="">
                    </div>
                    <div class="col-auto p-0 ms-1">
                        <label class="text-dark">
                            {{ __('global.permissions') }}
                        </label>
                    </div>
                </div>

            </a>

            <a aria-haspopup="true" href="{{ route('view-reports') }}" class="dropdown-item ps-4 ">
                <div class="row w-100 m-0">
                    <div class="col-auto p-0">
                        <img src="{{ asset('assets/dashboard/report.png') }}" class="me-1" width="16"
                            height="13" alt="" srcset="">


                    </div>
                    <div class="col-auto p-0 ms-1">
                        <label class="text-dark">
                            {{ __('global.reports') }}
                        </label>
                    </div>
                </div>
            </a>
            <a aria-haspopup="true" href="{{ route('edit.profile') }}" class="dropdown-item ps-4 ">

                <div class="row w-100 m-0">
                    <div class="col-auto p-0">
                        <img src="{{ asset('assets/dashboard/profile.png') }}" class="me-1" width="16"
                            height="13" alt="" srcset="">

                    </div>
                    <div class="col-auto p-0 ms-1">
                        <label class='text-dark'>
                            {{ __('global.profile') }}
                        </label>
                    </div>
                </div>

            </a>
            {{--  --}}{{--  --}}
            <a class="dropdown-item" href="{{ route('task-board') }}">
                <i class="fa fa-tasks"></i>
                {{ __('global.task-board') }}
            </a>

            @permission('index-dailytask')
                <a class="dropdown-item" href="{{ route('dailytask.index') }}">
                    <i class=" mdi mdi-view-day"></i>
                    {{ __('global.dailytasks') }}
                </a>
            @endpermission

            @permission('index-task')
                <a class="dropdown-item" href="{{ route('task.index') }}">
                    <i class="fa fa-paper-plane"></i>
                    {{ __('global.tasks') }}
                </a>
            @endpermission
            @permission('index-user')
                <a class="dropdown-item" href="{{ route('user.index') }}">
                    <i class="fa fa-flag"></i>
                    {{ __('global.users') }}
                </a>
            @endpermission
            @permission('index-department')
                <a class="dropdown-item" href="{{ route('department.index') }}">
                    <i class=" mdi mdi-diamond"></i>
                    {{ __('global.departments') }}
                </a>
            @endpermission
            {{--  --}}{{--  --}}

            {{--  --}}{{--  --}}{{--  --}}


            {{-- <a class="dropdown-item" href="{{ route('dashboard') }}">
                <i class="dropdown-icon mdi mdi-home-outline"></i>
                {{ __('global.home') }}
            </a> --}}

            <a class="dropdown-item" href="{{ route('edit.profile') }}">
                <i class="dropdown-icon mdi mdi-account-outline"></i>
                {{ __('global.edit-profile') }}
            </a>
            <div class="dropdown-divider m-0"></div>


            {{-- <a class="dropdown-item" href="{{ route('logout') }}"
                onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                <i class="dropdown-icon mdi  mdi-logout-variant"></i> Sign out
            </a> --}}

            @auth
                <a class="dropdown-item" href="{{ route('logout') }}"
                    onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                    <i class="dropdown-icon mdi  mdi-logout-variant"></i>
                    {{ __('global.sign-out') }}
                </a>
                <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                    @csrf
                </form>
            @endauth

            @guest
                <a class="dropdown-item" href="{{ route('login') }}">
                    <i class="dropdown-icon mdi  mdi-login-variant"></i>
                    {{ __('global.sign-in') }}
                </a>
            @endguest
            {{--  --}}{{--  --}}{{--  --}}

    </div>
</nav>
