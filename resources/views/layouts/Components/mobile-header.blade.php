<!-- Mobile Header -->
<div class="mobile-header">
    <div class="container-fluid">
        <div class="d-flex">
            <a onclick="sidenavToggledApi()" aria-label="Hide Sidebar" class="app-sidebar__toggle" data-toggle="sidebar"
                href=javascript:;></a>
            <!-- sidebar-toggle-->
            <a class="header-brand" href="{{ route('dashboard') }}">
                {{-- <img src="{{ asset('assets/images/brand/logo.png') }}" class="header-brand-img desktop-logo" alt="logo">
                <img src="{{ asset('assets/images/brand/logo-3.png') }}" class="header-brand-img desktop-logo mobile-light" alt="logo"> --}}
            </a>


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
</div>
