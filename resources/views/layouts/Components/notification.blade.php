<div class="d-flex ml-auto header-right-icons header-search-icon">

    <livewire:web.web-nav-bar />

    {{-- <div class="dropdown d-md-flex">
        <a class="nav-link icon full-screen-link nav-link-bg">
            <i class="fe fe-maximize fullscreen-button"></i>
        </a>
    </div> --}}

    <div class="dropdown profile-1">
        <a href=javascript:; data-toggle="dropdown" class="nav-link leading-none d-flex py-4">
            <span class="flag-icon flag-icon-{{ Config::get('languages')[App::getLocale()]['flag-icon'] }}"></span>
            <h5 class="text-dark mb-0"> {{ Config::get('languages')[App::getLocale()]['display'] }} </h5>
        </a>
        <div class="dropdown-menu dropdown-menu-right dropdown-menu-arrow" aria-labelledby="navbarDropdownMenuLink">
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
        <a href=javascript:; data-toggle="dropdown" class="nav-link leading-none d-flex py-4">
            <span>
                @auth
                    <h5 class="text-dark mb-0">{{ auth()->user()->name() }}</h5>
                @endauth
                @guest
                    <h5 class="text-dark mb-0">{{ __('user.guest') }}</h5>
                @endguest
            </span>
        </a>
        <div class="dropdown-menu dropdown-menu-right dropdown-menu-arrow">

            <a class="dropdown-item" href="{{ route('dashboard') }}">
                <i class="dropdown-icon mdi mdi-home-outline"></i>
                {{ __('global.home') }}
            </a>

            <a class="dropdown-item" href="{{ route('edit.profile') }}">
                <i class="dropdown-icon mdi mdi-account-outline"></i>
                {{ __('global.edit-profile') }}
            </a>
            <div class="dropdown-divider m-0"></div>

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

        </div>
    </div>
</div>
