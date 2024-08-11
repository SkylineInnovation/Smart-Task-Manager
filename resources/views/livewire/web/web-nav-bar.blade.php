<div class="d-flex">
    {{-- In work, do what you enjoy. --}}

    @if ((auth()->user()->hasRole('owner') && count($users) > 0) || session()->has('admin_user'))
        <div class="dropdown profile-1">
            <a href=javascript:; data-toggle="dropdown" class="nav-link leading-none d-flex py-4">
                <h5 class="text-dark mb-0"> {{ __('global.users') }} </h5>
            </a>
            <div class="dropdown-menu dropdown-menu-right dropdown-menu-arrow" aria-labelledby="navbarDropdownMenuLink">

                @if (session()->has('admin_user'))
                    <a class="dropdown-item" href="{{ route('set-session', 0) }}">
                        {{ __('global.all') }}
                    </a>
                @endif

                @foreach ($users as $use)
                    <a class="dropdown-item" href="{{ route('set-session', $use->id) }}">
                        {{ $use->name() }}
                    </a>
                @endforeach

            </div>
        </div>
    @endif
</div>
