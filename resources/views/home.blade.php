@extends('layouts.livewire-app')

<style>
    .mouseHover:hover {
        box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2), 0 6px 20px rgba(0, 0, 0, 0.19);
    }

    .iconsIffict:hover {
        filter: drop-shadow(0 0 0.75rem rgb(209, 209, 209));
    }

    .borderColorGreen {
        border-top: #1EAE9A solid 5px
    }

    .borderColorRed {
        border-top: #E04B4A solid 5px
    }

    .bgHover {
        background-color: white;
        color: black;
    }

    .bgHover:hover {
        background-color: gainsboro !important;
        color: black !important;
    }

    li>a.active {
        background-color: rgb(20, 20, 20) !important;
        color: white !important;

    }

    li>a.border-bottom {
        color: black
    }

    li>a.border-bottom:hover {
        color: black
    }
</style>

@section('content')
    <div class="container-fluid p-0">
        <div class="row w-100 m-0 ">



            <div class="col-lg-6 p{{ App::getLocale() == 'en' ? 's' : 's' }}-0 col-xl-6 col-md-6 col-sm-12 col-12">
                <div class="col-md-12 p-0">

                    <div class="card ">
                        <div class="card-header bg-dark text-light borderColorGreen">
                            <div class="col-md-12 ">
                                <h4 >
                                    {{ __('global.quick_actions') }}
                                </h4>

                                <small>
                                    {{ __('global.quick links to access operations for various data') }}
                                </small>
                            </div>
                        </div>
                        <div class="card-body">
                            <div class="row w-100 m-0">

                                {{-- // DONE --}}
                                <livewire:dashboard.dashboard-add-region />
                                {{-- // DONE --}}
                                <livewire:dashboard.dashboard-add-branch />
                                {{-- // DONE --}}
                                <livewire:dashboard.dashboard-add-department />
                                {{-- // DONE --}}
                                <livewire:dashboard.dashboard-add-user />
                                {{--  --}}
                                <livewire:dashboard.dashboard-add-work />
                                {{-- // DONE --}}
                                <livewire:dashboard.dashboard-add-task />
                                {{-- // DONE --}}
                                <livewire:dashboard.dashboard-add-leave />

                                @foreach ($actionBtns as $actionBtn)
                                    @include('Web.components.quick-btn', [
                                        'text' => $actionBtn['text'],
                                    ])
                                @endforeach

                            </div>
                        </div>

                    </div>
                </div>

                <div class="col-md-12 p-0">

                    <div class="card">
                        <div class="card-header bg-dark text-light borderColorGreen">
                            <div class="col-md-12">
                                <h4>
                                    {{ __('global.task-management') }}
                                </h4>

                                <small>
                                    {{ __('global.quick links to access operations for various data') }}
                                </small>
                            </div>
                        </div>
                        <div class="card-body">
                            <div class="row w-100 m-0">
                                @foreach ($tasksBtns as $taskBtn)
                                    @include('Web.components.task-managment-btn', [
                                        'text' => $taskBtn['text'],
                                        'image' => $taskBtn['image'],
                                        'link' => $taskBtn['link'],
                                    ])
                                @endforeach

                            </div>
                        </div>

                    </div>
                </div>

                <div class="col-md-12 p-0">
                    <div class="card ">
                        <div class="card-header bg-dark text-light borderColorRed">

                            <div class="col-md-10 ">
                                <h4 class="text-{{ App::getLocale() == 'en' ? 'start' : 'end' }}">
                                    {{ __('global.Incoming tasks about to close') }}
                                </h4>

                                <small>
                                    {{ __('global.Show tasks that will be closed after three days') }}
                                </small>

                            </div>
                        </div>
                        <div class="card-body px-0">
                            @foreach ($income_tasks_almost_close as $t)
                                <div class="row w-100 m-0 bgHover py-3">
                                    <div class="col-md-2 col-2 d-flex justify-content-center align-items-center">
                                        <img src="{{ asset('assets/dashboard/task.png') }}" width="60px" height="60px"
                                            alt="">
                                    </div>

                                    <div class="col-md-10 col-9">
                                        <h3 class="mb-3">{{ $t->title }}</h3>
                                        <p class="pb-0 mb-0">{{ __('global.task-number') }} : {{ $t->id }}</p>
                                        <p class="pb-0 mb-0">{{ __('global.task-manager') }} : {{ $t->manager->name() }}
                                        </p>
                                        <div class="row w-100 m-0 p-0">
                                            <div class="col-auto p-0">{{ __('global.employees') }}:</div>
                                            @foreach ($t->employees as $tp)
                                                <div class="col-3 text-{{ App::getLocale() == 'en' ? 'start' : 'end' }}">
                                                    {{ $tp->name() }}
                                                </div>
                                            @endforeach
                                        </div>

                                    </div>


                                </div>
                            @endforeach
                        </div>

                    </div>
                </div>

                <div class="col-md-12 p-0">
                    <div class="card ">
                        <div class="card-header bg-dark text-light borderColorRed">
                            <div class="col-md-12 ">
                                <h4 class="text-{{ App::getLocale() == 'en' ? 'start' : 'end' }}">
                                    {{ __('global.Outgoing tasks about to close') }}
                                </h4>

                                <small>
                                    {{ __('global.Show tasks that will be closed after three days') }}
                                </small>
                            </div>


                        </div>
                        <div class="card-body  px-0">
                            @foreach ($outcome_tasks_almost_close as $t)
                                <div class="row w-100 m-0 bgHover py-3">
                                    <div class="col-md-2 col-2 d-flex justify-content-center align-items-center">
                                        <img src="{{ asset('assets/dashboard/task.png') }}" width="60px" height="60px"
                                            alt="">
                                    </div>

                                    <div class="col-md-10 col-9">
                                        <h3 class="mb-3">{{ $t->title }}</h3>
                                        <p class="pb-0 mb-0">{{ __('global.task-number') }} : {{ $t->id }}</p>
                                        <p class="pb-0 mb-0">{{ __('global.task-manager') }} : {{ $t->manager->name() }}
                                        </p>
                                        <div class="row w-100 m-0 p-0">
                                            <div class="col-auto p-0">{{ __('global.employees') }}:</div>
                                            @foreach ($t->employees as $tp)
                                                <div class="col-3 text-{{ App::getLocale() == 'en' ? 'start' : 'end' }}">
                                                    {{ $tp->name() }}
                                                </div>
                                            @endforeach
                                        </div>

                                    </div>


                                </div>
                            @endforeach
                        </div>

                    </div>
                </div>

                <div class="col-md-12 p-0">
                    <div class="card">
                        <div class="card-header bg-dark text-light borderColorGreen">
                            <div class="col-md-12">
                                <h4>
                                    {{ __('global.Recent Operations') }}
                                </h4>

                                <small>
                                    {{ __('global.All movements on the program that took place during the last 24 hours') }}
                                </small>
                            </div>
                        </div>
                        <div class="card-body px-0">
                            @foreach ($all_history as $history)
                                <div class="row w-100 m-0 bgHover py-3">
                                    <div class="col-12 text-end ">
                                        <h4>
                                            {{ $history->the_preaf() }}
                                        </h4>

                                    </div>
                                    <div class="col-12 text-end mt-3">
                                        <label class="bg-success text-white p-2"
                                            for="">{{ $history->created_at }}</label>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-6 p{{ App::getLocale() == 'en' ? 'e' : 's' }}-0  col-xl-6 col-md-6 col-sm-12 col-12">
                <div class="col-md-12 p-0">
                    <div class="card ">
                        <div class="card-header bg-dark text-light borderColorGreen">
                            <div class="col-md-12 ">
                                <h4 >
                                    {{ __('global.management and control') }}
                                </h4>

                                <small>
                                    {{ __('global.system management screens') }}
                                </small>
                            </div>


                        </div>
                        <div class="card-body">
                            <div class="row w-100 m-0">
                                @foreach ($mainBtns as $Mbtn)
                                    @include('Web.components.main-btn', [
                                        'image' => $Mbtn['image'],
                                        'text' => $Mbtn['text'],
                                        'link' => $Mbtn['link'] ?? '',
                                    ])
                                @endforeach


                            </div>
                        </div>

                    </div>
                </div>

                <div class="col-md-12 p-0">
                    <div class="card ">
                        <div class="card-header bg-dark text-light borderColorGreen">
                            <div class="col-md-12 ">
                                <h4 class="text-{{ App::getLocale() == 'en' ? 'start' : 'end' }}">
                                    {{ __('global.Incoming tasks not commented on today') }}
                                </h4>

                                <small>
                                    {{ __('global.Show all tasks that do not have comments from all parties.') }}
                                </small>
                            </div>


                        </div>
                        <div class="card-body px-0">
                            @foreach ($income_tasks_not_commented as $t)
                                <a href="">
                                    <div class="row w-100 m-0 bgHover py-3">
                                        <div class="col-md-2 col-2 d-flex justify-content-center align-items-center">
                                            <img src="{{ asset('assets/dashboard/task.png') }}" width="60px"
                                                height="60px" alt="">
                                        </div>

                                        <div class="col-md-10 col-9">
                                            <h3 class="mb-3">{{ $t->title }}</h3>
                                            <p class="pb-0 mb-0">{{ __('global.task-number') }} : {{ $t->id }}</p>
                                            <p class="pb-0 mb-0">{{ __('global.task-manager') }} :
                                                {{ $t->manager->name() }}
                                            </p>
                                            <div class="row w-100 m-0 p-0">
                                                <div class="col-auto p-0">{{ __('global.employees') }}:</div>
                                                @foreach ($t->employees as $tp)
                                                    <div
                                                        class="col-3 text-{{ App::getLocale() == 'en' ? 'start' : 'end' }}">
                                                        {{ $tp->name() }}
                                                    </div>
                                                @endforeach
                                            </div>

                                        </div>


                                    </div>
                                </a>
                            @endforeach
                        </div>

                    </div>
                </div>

                <div class="col-md-12 p-0">
                    <div class="card ">
                        <div class="card-header bg-dark text-light borderColorGreen">
                            <div class="col-md-12 ">
                                <h4 class="text-{{ App::getLocale() == 'en' ? 'start' : 'end' }}">
                                    {{ __('global.Outgoing tasks not commented on today') }}
                                </h4>

                                <small>
                                    {{ __('global.Show all tasks that do not have comments from all parties.') }}
                                </small>
                            </div>


                        </div>

                        <div class="card-body px-0">
                            @foreach ($outcome_tasks_not_commented as $t)
                                <livewire:dashboard.task-detail :task="$t" />
                            @endforeach
                        </div>

                    </div>
                </div>


            </div>
        </div>
    </div>
@endsection


<!-- Modal -->


@section('js')
    <script type="text/javascript">
        $(function() {
            // 
        });
    </script>
@endsection

@section('livewire-js')
    <script type="text/javascript">
        $(document).ready(function() {
            window.livewire.on('close-model', () => {
                $('#create-new-area-modal').modal('hide');

                $('#create-new-branch-modal').modal('hide');

                $('#create-new-department-modal').modal('hide');

                $('#create-new-user-modal').modal('hide');

                $('#create-submit-task').modal('hide');

                $('#create-new-leave-modal').modal('hide');

                $('#create-new-job-modal').modal('hide');
            });

            // 
        });
    </script>
@endsection
