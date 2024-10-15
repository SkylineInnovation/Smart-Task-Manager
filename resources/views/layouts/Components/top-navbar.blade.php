<nav class="horizontalMenu clearfix bg-white p-1">
    <ul class="horizontalMenu-list">

        @role('owner|manager|employee')
            <li aria-haspopup="true">
                <a href="#" class="sub-icon"><i class="fa fa-tasks"></i>
                    {{ __('global.task-board') }}
                    <i class="fa fa-angle-down horizontal-icon"></i>
                </a>

                <ul class="sub-menu">
                    <li aria-haspopup="true">
                        <a href="{{ route('task-board') }}">
                            {{ __('global.task-board') }}
                        </a>
                    </li>

                    <li aria-haspopup="true">
                        <a href="{{ route('dailytask.index') }}">
                            {{ __('global.dailytasks') }}
                        </a>
                    </li>

                    <li aria-haspopup="true">
                        <a href="{{ route('task.index') }}">
                            {{ __('global.tasks') }}
                        </a>
                    </li>
                </ul>
            </li>
        @endrole

        @role('owner|manager')
            <li aria-haspopup="true">
                <a href="#" class="sub-icon">
                    <i class="fa fa-flag"></i>
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

        {{-- @role('owner|manager')
            <li aria-haspopup="true">
                <a href="#" class="sub-icon">
                    <i class="fa fa-flag"></i>
                    {{ __('global.reports') }}
                    <i class="fa fa-angle-down horizontal-icon"></i>
                </a>

                <ul class="sub-menu">
                    @permission('index-loghistory')
                        <li aria-haspopup="true">
                            <a href="{{ route('loghistory.index') }}">
                                {{ __('global.loghistories') }}
                            </a>
                        </li>
                    @endpermission
                </ul>
            </li>
        @endrole --}}
    </ul>
</nav>
