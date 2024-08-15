<nav class="horizontalMenu clearfix bg-white p-1">
    <ul class="horizontalMenu-list">
        <li aria-haspopup="true">
            <a href="{{ route('task-board') }}" class="sub-icon"><i class="ti-home"></i>
                Task Board
                <i class="fa fa-angle-down horizontal-icon"></i>
            </a>
        </li>

        {{--  --}}

        <li aria-haspopup="true">
            <a href="#" class="sub-icon">
                <i class="ti-home"></i>
                Reports
                <i class="fa fa-angle-down horizontal-icon"></i>
            </a>

            <ul class="sub-menu">
                <li aria-haspopup="true">
                    <a href="{{ route('user.index') }}">
                        Users
                    </a>
                </li>
            </ul>
        </li>
    </ul>
</nav>
