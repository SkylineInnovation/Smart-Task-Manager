<style>
    .mega-menubg li a:before,
    .sub-menu li a:before {
        content: unset;
        margin-right: 8px;
        position: relative;
        font-family: feather !important;
        color: #68798b;
    }
</style>

<nav class="horizontalMenu clearfix bg-white p-1">
    <ul class="horizontalMenu-list ">

        <li aria-haspopup="true" class="">
            <a href="#" class="sub-icon">
                <i class="fa fa-dashboard"></i>
                {{ __('global.dashboard') }}
                <i class="fa fa-angle-down horizontal-icon"></i>
            </a>


            <ul class="sub-menu" class="">

                <li aria-haspopup="true">
                    <div class="col-md-12 d-flex justify-content-between pb-3">
                        <i class="fa fa-dashboard text-gray fs-20"></i>
                        <a class="text-dark" href="{{ route('dashboard') }}">
                            {{ __('global.dashboard') }}
                        </a>
                    </div>
                </li>

                @php
                    $company = \App\Models\Company::latest()->first();
                @endphp
                @if ($company)
                    <li aria-haspopup="true">
                        <div class="col-md-12 d-flex justify-content-between pb-4">
                            <img src="{{ asset('assets/dashboard/company.png') }}" width="20" height="20"
                                alt="" srcset="">
                            <a class='text-dark' href="{{ route('company.show', $company) }}">
                                {{ __('global.company') }}
                            </a>
                        </div>
                    </li>
                @endif

                <li aria-haspopup="true">
                    <div class="col-md-12 d-flex justify-content-between pb-4">
                        <img src="{{ asset('assets/dashboard/region.png') }}" width="20" height="20"
                            alt="" srcset="">
                        <a class='text-dark' href="{{ route('area.index') }}">
                            {{ __('global.region') }}
                        </a>
                    </div>
                </li>

                <li aria-haspopup="true">
                    <div class="col-md-12 d-flex justify-content-between pb-4">
                        <img src="{{ asset('assets/dashboard/branch.png') }}" width="20" height="20"
                            alt="" srcset="">
                        <a class='text-dark' href="{{ route('branch.index') }}">
                            {{ __('global.branches') }}
                        </a>
                    </div>
                </li>

                <li aria-haspopup="true">
                    <div class="col-md-12 d-flex justify-content-between pb-4">
                        <img src="{{ asset('assets/dashboard/department.png') }}" width="20" height="20"
                            alt="" srcset="">
                        <a class='text-dark' href="{{ route('department.index') }}">
                            {{ __('global.departments') }}
                        </a>
                    </div>
                </li>
                <li aria-haspopup="true">
                    <div class="col-md-12 d-flex justify-content-between pb-4">
                        <img src="{{ asset('assets/dashboard/person.png') }}" width="20" height="20"
                            alt="" srcset="">
                        <a class='text-dark' href="{{ route('user.index') }}">
                            {{ __('global.users') }}
                        </a>
                    </div>
                </li>
                <li aria-haspopup="true">
                    <div class="col-md-12 d-flex justify-content-between pb-4">
                        <img src="{{ asset('assets/dashboard/team.png') }}" width="20" height="20"
                            alt="" srcset="">
                        <a href="#" class="text-dark">
                            {{ __('global.permissions') }}
                        </a>
                    </div>
                </li>
                <li aria-haspopup="true">
                    <div class="col-md-12 d-flex justify-content-between pb-4">
                        <img src="{{ asset('assets/dashboard/report.png') }}" width="20" height="20"
                            alt="" srcset="">
                        <a href="#" class="text-dark">
                            {{ __('global.reports') }}
                        </a>
                    </div>
                </li>
                <li aria-haspopup="true">
                    <div class="col-md-12 d-flex justify-content-between pb-4">
                        <img src="{{ asset('assets/dashboard/profile.png') }}" width="20" height="20"
                            alt="" srcset="">
                        <a class='text-dark' href="{{ route('edit.profile') }}">
                            {{ __('global.profile') }}
                        </a>
                    </div>
                </li>
                <li aria-haspopup="true">
                    <div class="col-md-12 d-flex justify-content-between pb-4">
                        <img src="{{ asset('assets/dashboard/about.png') }}" width="20" height="20"
                            alt="" srcset="">
                        <a href="" class="text-dark">
                            {{ __('global.about') }}
                        </a>
                    </div>
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
