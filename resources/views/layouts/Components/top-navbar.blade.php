<nav class="horizontalMenu clearfix bg-white p-1">
    <ul class="horizontalMenu-list">

        @role('owner|manager|employee')
            <li aria-haspopup="true">
                <a href="{{ route('task-board') }}" class="sub-icon"><i class="ti-home"></i>
                    {{ __('global.task-board') }}
                    <i class="fa fa-angle-down horizontal-icon"></i>
                </a>
            </li>
        @endrole

        @role('owner|manager')
            <li aria-haspopup="true">
                <a href="#" class="sub-icon">
                    <i class="ti-home"></i>
                    {{ __('global.reports') }}
                    <i class="fa fa-angle-down horizontal-icon"></i>
                </a>

                <ul class="sub-menu">
                    <li aria-haspopup="true">
                        <a href="{{ route('user.index') }}">
                            {{ __('global.users') }}
                        </a>
                    </li>
                </ul>
            </li>
        @endrole
    </ul>
</nav>
