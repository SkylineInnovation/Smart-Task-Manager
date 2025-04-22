@extends('layouts.livewire-app')

<link href="https://cdn.jsdelivr.net/npm/tom-select@2.2.2/dist/css/tom-select.css" rel="stylesheet">
<script src="https://cdn.jsdelivr.net/npm/tom-select@2.2.2/dist/js/tom-select.complete.min.js"></script>
@section('css')
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

        .scrollable-container {
            max-height: 400px;
            /* Adjust height as needed */
            overflow-y: auto;
            border: 1px solid #ddd;
            /* Optional: to highlight the scrollable area */
            padding: 10px;
            border-radius: 5px;
        }
    </style>
@endsection

@section('content')
    <div class="container-fluid p-0">
        <div class="row w-100 m-0 ">



            <div class="col-lg-6 p{{ App::getLocale() == 'en' ? 's' : 's' }}-0 col-xl-6 col-md-6 col-sm-12 col-12">
                <div class="col-md-12 p-0">

                    <div class="card ">
                        <div class="card-header bg-dark text-light borderColorGreen">
                            <div class="col-md-12 ">
                                <h4>
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
                                {{-- // DONE --}}
                                <livewire:dashboard.dashboard-add-exchange-permission />





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
                                    @include('web.components.task-managment-btn', [
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
                        <div class="card-body px-0 scrollable-container">
                            @foreach ($income_tasks_almost_close as $t)
                                <livewire:dashboard.task-detail :task="$t" />
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
                        <div class="card-body  px-0 scrollable-container">
                            @foreach ($outcome_tasks_almost_close as $t)
                                <livewire:dashboard.task-detail :task="$t" />
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
                        <div class="card-body px-0 scrollable-container">
                            @foreach ($all_history as $history)
                                <div class="row w-100 m-0 bgHover py-3">
                                    <div class="col-12 text-{{ App::getLocale() == 'en' ? 'start' : 'end' }}">
                                        <h4>
                                            {{ $history->the_preaf() }}
                                        </h4>

                                    </div>
                                    <div class="col-12 mt-3 text-{{ App::getLocale() == 'en' ? 'start' : 'end' }}">
                                        <label class="bg-success text-white p-2">
                                            {{ $history->created_at }}
                                        </label>
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
                                <h4>
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
                                    @include('web.components.main-btn', [
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
                        <div class="card-body px-0 scrollable-container">
                            @foreach ($income_tasks_not_commented as $t)
                                <livewire:dashboard.task-detail :task="$t" />
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

                        <div class="card-body px-0 scrollable-container">
                            @foreach ($outcome_tasks_not_commented as $t)
                                <livewire:dashboard.task-detail :task="$t" />
                            @endforeach
                        </div>
                    </div>
                </div>
                {{--  --}}
                <div class="col-md-12 p-0">
                    <div class="card ">
                        <div class="card-header bg-dark text-light borderColorGreen">
                            <div class="col-md-12 ">
                                <h4 class="text-{{ App::getLocale() == 'en' ? 'start' : 'end' }}">
                                    {{ __('global.tasks-under-review-title') }}
                                </h4>

                                <small>
                                    {{ __('global.tasks-under-review-desc') }}
                                </small>
                            </div>
                        </div>

                        <div class="card-body px-0 scrollable-container">
                            @foreach ($under_review_tasks as $task)
                                <livewire:dashboard.task-detail :task="$task" />
                            @endforeach
                        </div>
                    </div>
                </div>


            </div>
        </div>
    </div>
@endsection


<!-- Modal -->

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

                $('#create-new-exchange-permission-modal').modal('hide');
            });

            // 
        });
    </script>
   
@endsection
