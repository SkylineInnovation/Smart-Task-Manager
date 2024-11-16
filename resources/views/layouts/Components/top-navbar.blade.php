<nav class="horizontalMenu clearfix bg-white p-1">
    <ul class="horizontalMenu-list">

        <li aria-haspopup="true">
            <a href="#" class="sub-icon"><i class="fa fa-dashboard"></i>
                {{ __('global.dashboard') }}
                <i class="fa fa-angle-down horizontal-icon"></i>
            </a>

            <ul class="sub-menu">

                <li aria-haspopup="true">
                    <a href="{{ route('dashboard') }}">
                        {{ __('global.dashboard') }}
                    </a>
                </li>

                @php
                    $company = \App\Models\Company::latest()->first();
                @endphp
                @if ($company)
                    <li aria-haspopup="true">
                        <a href="{{ route('company.show', $company) }}">
                            {{ __('global.company') }}
                        </a>
                    </li>
                @endif

                <li aria-haspopup="true">
                    <a href="{{ route('area.index') }}">
                        {{ __('global.areas') }}
                    </a>
                </li>

                <li aria-haspopup="true">
                    <a href="{{ route('branch.index') }}">
                        {{ __('global.branches') }}
                    </a>
                </li>
            </ul>
        </li>

        {{-- @role('owner|manager|employee') --}}
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
                @permission('index-dailytask')
                    <li aria-haspopup="true">
                        <a href="{{ route('dailytask.index') }}">
                            {{ __('global.dailytasks') }}
                        </a>
                    </li>
                @endpermission

                @permission('index-task')
                    <li aria-haspopup="true">
                        <a href="{{ route('task.index') }}">
                            {{ __('global.tasks') }}
                        </a>
                    </li>
                @endpermission
            </ul>
        </li>
        {{-- @endrole --}}

        @role('owner|manager')
            <li aria-haspopup="true">
                <a href="#" class="sub-icon">
                    <i class="fa fa-flag"></i>
                    {{ __('global.reports') }}
                    <i class="fa fa-angle-down horizontal-icon"></i>
                </a>

                <ul class="sub-menu">
                    @permission('index-user')
                        <li aria-haspopup="true">
                            <a href="{{ route('user.index') }}">
                                {{ __('global.users') }}
                            </a>
                        </li>
                    @endpermission

                    @permission('index-department')
                        <li aria-haspopup="true">
                            <a href="{{ route('department.index') }}">
                                {{ __('global.departments') }}
                            </a>
                        </li>
                    @endpermission
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
