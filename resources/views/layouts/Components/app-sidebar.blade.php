<div class="app-sidebar__overlay" data-toggle="sidebar"></div>
<aside class="app-sidebar">
    <div class="side-header">
        <a class="header-brand1" href="{{ route('dashboard') }}">
            {{-- <img src="{{ asset('assets/images/brand/logo.png') }}" class="header-brand-img desktop-logo" alt="logo">
            <img src="{{ asset('assets/images/brand/logo-1.png') }}" class="header-brand-img toggle-logo" alt="logo">
            <img src="{{ asset('assets/images/brand/logo-2.png') }}" class="header-brand-img light-logo" alt="logo">
            <img src="{{ asset('assets/images/brand/logo-3.png') }}" class="header-brand-img light-logo1" alt="logo"> --}}
        </a>

        <a onclick="sidenavToggledApi()" aria-label="Hide Sidebar" class="app-sidebar__toggle ml-auto" data-toggle="sidebar"
            href="javascript:;"></a>
        {{-- sidebar-toggle --}}
    </div>
    <div class="app-sidebar__user">
        <div class="dropdown text-center">
            <div class="user-info">
                @auth
                    <h6 class=" mb-0 text-dark">{{ auth()->user()->name() }}</h6>
                    <div class="text-muted text-sm">
                        {{ auth()->user()->rolesSideBySide() }}
                    </div>
                @endauth
            </div>
        </div>
    </div>

    {{-- <div class="sidebar-navs">
        <ul class="nav  nav-pills-circle">
            <li class="nav-item" data-toggle="tooltip" data-placement="top" title="Settings">
                <a class="nav-link text-center m-2">
                    <i class="fe fe-settings"></i>
                </a>
            </li>
            <li class="nav-item" data-toggle="tooltip" data-placement="top" title="Chat">
                <a class="nav-link text-center m-2">
                    <i class="fe fe-mail"></i>
                </a>
            </li>
            <li class="nav-item" data-toggle="tooltip" data-placement="top" title="Followers">
                <a class="nav-link text-center m-2">
                    <i class="fe fe-user"></i>
                </a>
            </li>
            <li class="nav-item" data-toggle="tooltip" data-placement="top" title="Logout">
                <a class="nav-link text-center m-2">
                    <i class="fe fe-power"></i>
                </a>
            </li>
        </ul>
    </div> --}}

    <ul class="side-menu">
        <li>
            <h3>{{ __('global.main') }}</h3>
        </li>
        <li class="slide">
            <a class="side-menu__item" data-toggle="slide" href="javascript:;">
                <i class="side-menu__icon ti-dashboard"></i>
                <span class="side-menu__label">{{ __('global.dashboard') }}</span>
                <i class="angle fa fa-angle-right"></i>
            </a>
            <ul class="slide-menu">
                <li>
                    <a class="slide-item" href="{{ route('dashboard') }}">
                        <span>{{ __('global.home-page') }}</span>
                    </a>
                </li>

                @permission('index-user')
                    <li>
                        <a class="slide-item" href="{{ route('user.index') }}">
                            <span>{{ __('global.users') }}</span>
                        </a>
                    </li>
                @endpermission

                @role('dev')
                    <li>
                        <a class="slide-item" href="role">
                            <span>{{ __('global.roles') }}</span>
                        </a>
                    </li>
                @endrole


                {{-- <li><a class="slide-item" href="{{ route('banner.index') }}"><span>{{ __('global.Banner') }}</span></a></li> --}}
            </ul>
        </li>


        <li class="slide">
            <a class="side-menu__item" data-toggle="slide" href='{{ route('task-board') }}'>
                <i class="side-menu__icon ti-blackboard"></i>
                <span class="side-menu__label">{{ __('global.task-board') }}</span>
                <i class="angle fa fa-angle-right"></i>
            </a>

        </li>


        <li class="slide">
            <a class="side-menu__item" data-toggle="slide" href=javascript:;>
                <i class="side-menu__icon fa fa-tasks"></i>
                <span class="side-menu__label">{{ __('global.tasks') }}</span>
                <i class="angle fa fa-angle-right"></i>
            </a>
            <ul class="slide-menu">
                @permission('index-task')
                    <li>
                        <a class='slide-item' href='{{ route('task.index') }}'>
                            <span>{{ __('global.tasks') }}</span>
                        </a>
                    </li>
                @endpermission



                @permission('index-dailytask')
                    <li>
                        <a class='slide-item' href='{{ route('dailytask.index') }}'>
                            <span>{{ __('global.dailytasks') }}</span>
                        </a>
                    </li>
                @endpermission

                @permission('index-completepercentage')
                    <li>
                        <a class='slide-item' href='{{ route('completepercentage.index') }}'>
                            <span>{{ __('global.completepercentages') }}</span>
                        </a>
                    </li>
                @endpermission



                {{-- <li><a class="slide-item" href="{{ route('banner.index') }}"><span>{{ __('global.Banner') }}</span></a></li> --}}
            </ul>
        </li>


        {{-- <li class="slide ">
            <a class="side-menu__item" data-toggle="slide" href=javascript:;><i
                    class="side-menu__icon ti-layout-grid2"></i><span class="side-menu__label">Submenus</span><i
                    class="angle fa fa-angle-right"></i></a>
            <ul class="slide-menu">
                <li class="sub-slide">
                    <a class="sub-side-menu__item" data-toggle="sub-slide" href=javascript:;><span
                            class="sub-side-menu__label">Level 1</span><i class="sub-angle fa fa-angle-right"></i></a>
                    <ul class="sub-slide-menu">
                        <li><a class="sub-slide-item" href=javascript:;>Level 1.0</a></li>
                        <li><a class="sub-slide-item" href=javascript:;>Level 1.1</a></li>
                        <li class="sub-slide2">
                            <a class="sub-side-menu__item" href=javascript:; data-toggle="sub-slide2"><span
                                    class="sub-side-menu__label2">Level 1.2</span><i
                                    class="sub-angle2 fa fa-angle-right"></i></a>
                            <ul class="sub-slide-menu2">
                                <li><a href=javascript:; class="sub-slide-item2">Level 1.2.1</a></li>
                                <li><a href=javascript:; class="sub-slide-item2">Level 1.2.2</a></li>
                                <li><a href=javascript:; class="sub-slide-item2">Level 1.2.3</a></li>
                            </ul>
                        </li>
                    </ul>
                </li>
                <li><a class="slide-item" href=javascript:;>Level 2</a></li>
                <li><a class="slide-item" href=javascript:;>Level 3</a></li>
            </ul>
        </li> --}}



        @role('dev')
            <li class="slide">
                <a class="side-menu__item" data-toggle="slide" href=javascript:;>
                    <i class="side-menu__icon ti-home"></i>
                    <span class="side-menu__label">{{ __('global.crud') }}</span>
                    <i class="angle fa fa-angle-right"></i></a>
                <ul class="slide-menu">
                    @include('layouts.side')
                </ul>
            </li>
        @endrole

        @role('dev')
            <li class="slide">
                <a class="side-menu__item" data-toggle="slide" href=javascript:;>
                    <i class="side-menu__icon ti-trash"></i>
                    <span class="side-menu__label">{{ __('global.trash') }}</span>
                    <i class="angle fa fa-angle-right"></i></a>
                <ul class="slide-menu">
                    @include('layouts.deleted-side')
                </ul>
            </li>
        @endrole

    </ul>
</aside>
