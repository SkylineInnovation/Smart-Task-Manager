<!-- teaskModelReport -->
<div class="modal fade" {{ App::getLocale() == 'en' ? 'dir="ltr"' : 'dir="rtl"' }} id="teaskModelReport" tabindex="-1"
    role="dialog" aria-labelledby="teaskModelReportLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content border-0">
            <form action="{{ route('task.commintes.report') }}" method="post">
                @csrf
                <div class="modal-header bg-dark text-white">
                    <h5 class="modal-title" id="teaskModelReportLabel">{{ __('global.task-omments-report') }}</h5>
                    <button type="button" class="close text-light" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="text-end"><label for="">{{ __('global.from date') }}</label></div>
                    <div class="input-group mb-3">

                        <div class="input-group-prepend">
                            <span class="input-group-text"
                                id="inputGroup-sizing-default">{{ __('global.Gregorian') }}</span>
                        </div>
                        <input type="date" id="" name="fromDate" class="form-control" aria-label="Default"
                            aria-describedby="inputGroup-sizing-default">
                    </div>
                    <div class="text-end"><label for="">{{ __('global.to date') }}</label></div>
                    <div class="input-group mb-3">
                        <div class="input-group-prepend">
                            <span class="input-group-text"
                                id="inputGroup-sizing-default">{{ __('global.Gregorian') }}</span>
                        </div>
                        <input type="date" class="form-control" name="toDate" aria-label="Default"
                            aria-describedby="inputGroup-sizing-default">
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary"
                        data-dismiss="modal">{{ __('global.Close') }}</button>
                    <button type="submit" class="btn btn-primary fs-25">
                        <i class="fa fa-print"></i>
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>
{{-- end teask Model Report --}}


<!-- Closed task soon ModelReport -->

<div class="modal fade" id="closedTaskComingSoonReport" tabindex="-1" role="dialog"
    aria-labelledby="closedTaskComingSoonReportLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <form class="form-inline" method="post" action="{{ route('closed.task.soon.report') }}">
            @csrf
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="closedTaskComingSoonReportLabel">
                        {{ __('global.closed-tasks-coming-soon') }}</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <label class="my-1 mr-2" for="inlineFormCustomSelectPref">{{ __('global.user account') }}</label>
                    <select class="custom-select w-100" id="inlineFormCustomSelectPref" name="users">
                        <option selected>{{ __('global.Choose') }}</option>

                        @foreach ($users as $user)
                            <option value="{{ $user->id }}">{{ $user->name() }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary"
                        data-dismiss="modal">{{ __('global.Close') }}</button>
                    <button type="submit" class="btn btn-primary fs-25">
                        <i class="fa fa-print"></i>
                    </button>
                </div>
            </div>
        </form>
    </div>
</div>
{{-- end closed  task soon Model Report --}}


<!-- OutgoingTaskMovements ModelReport -->
<div class="modal fade" id="OutgoingTaskMovements" tabindex="-1" role="dialog"
    aria-labelledby="OutgoingTaskMovementsLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <form action="{{ route('Outgoing.Task.Movements') }}" method="post">
            @csrf
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="OutgoingTaskMovementsLabel">{{ __('global.outgoing-task-movements') }}
                    </h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body text-end">
                    <label class="my-1 mr-2 "
                        for="inlineFormCustomSelectPref">{{ __('global.user account') }}</label>
                    <select class="custom-select w-100" id="inlineFormCustomSelectPref" name="users">
                        <option selected>{{ __('global.Choose') }}</option>

                        @foreach ($users as $user)
                            <option value="{{ $user->id }}">{{ $user->name() }}</option>
                        @endforeach
                    </select>

                    <div class="w-100">
                        <label for="exampleFormControlInput1"
                            class="form-label">{{ __('global.report-title') }}</label>
                        <input type="text" class="form-control" id="exampleFormControlInput1"
                            placeholder="{{ __('global.report-title') }}">
                    </div>

                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary"
                        data-dismiss="modal">{{ __('global.Close') }}</button>
                    <button type="submit" class="btn btn-primary fs-25">
                        <i class="fa fa-print"></i>
                    </button>
                </div>
            </div>
        </form>
    </div>
</div>
{{-- end OutgoingTaskMovements Model Report --}}


<!-- Incoming Task Movements ModelReport -->
<div class="modal fade" id="IncomingTaskMovements" tabindex="-1" role="dialog"
    aria-labelledby="IncomingTaskMovementsLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <form action="{{ route('Incoming.Task.Movements') }}" method="post">
            @csrf
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="IncomingTaskMovementsLabel">
                        {{ __('global.incoming-task-movements') }}
                    </h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="modal-body text-end">
                        <label class="my-1 mr-2"
                            for="inlineFormCustomSelectPref">{{ __('global.user account') }}</label>
                        <select class="custom-select w-100" id="inlineFormCustomSelectPref" name="users">
                            <option selected>{{ __('global.Choose') }}</option>

                            @foreach ($users as $user)
                                <option value="{{ $user->id }}">{{ $user->name() }}</option>
                            @endforeach
                        </select>


                        <div class="w-100">
                            <label for="exampleFormControlInput1"
                                class="form-label">{{ __('global.report-title') }}</label>
                            <input type="text" class="form-control" id="exampleFormControlInput1"
                                placeholder="{{ __('global.report-title') }}">
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary"
                        data-dismiss="modal">{{ __('global.Close') }}</button>
                    <button type="submit" class="btn btn-primary fs-25">
                        <i class="fa fa-print"></i>
                    </button>
                </div>
            </div>
        </form>
    </div>
</div>
{{-- Incoming Task Movements Model Report --}}


<!-- OutgoingTaskDiscounts ModelReport -->
<div class="modal fade" id="OutgoingTaskDiscounts" tabindex="-1" role="dialog"
    aria-labelledby="OutgoingTaskDiscountsLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <form class="form-inline" method="post" action="{{ route('outgoing.task.discounts') }}">
            @csrf
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="OutgoingTaskDiscountsLabel">
                        {{ __('global.outgoing-task-discounts') }}</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">

                    <label class="my-1 mr-2" for="inlineFormCustomSelectPref">{{ __('global.user account') }}</label>
                    <select class="custom-select w-100" id="inlineFormCustomSelectPref" name="user">
                        <option selected>{{ __('global.Choose') }}</option>

                        @foreach ($users as $user)
                            <option value="{{ $user->id }}">{{ $user->name() }}</option>
                        @endforeach


                    </select>

                    <label class="my-1 mr-2" for="inlineFormCustomSelectPref">{{ __('task.status') }}</label>
                    <select class="custom-select w-100" id="inlineFormCustomSelectPref" name="users">
                        <option selected>{{ __('global.Choose') }}</option>

                        @foreach ($tasks_status as $task_status)
                            <option value="{{ $task_status->id }}">{{ $task_status->status }}</option>
                        @endforeach
                    </select>


                    <div class="col-md-12 p-0">
                        <div class="row w-100 m-0">
                            <div class="col-md-6 px-1">
                                <div class="text-end"><label for="">{{ __('global.from_date') }}</label>
                                </div>
                                <div class="input-group mb-3">

                                    <div class="input-group-prepend">

                                    </div>
                                    <input type="date" id="" name="fromDate" class="form-control"
                                        aria-label="Default" aria-describedby="inputGroup-sizing-default">
                                </div>


                            </div>
                            <div class="col-md-6 px-1">
                                <div class="text-end">
                                    <label for="">{{ __('to date') }}</label>
                                </div>
                                <div class="input-group mb-3">
                                    <div class="input-group-prepend">

                                    </div>
                                    <input type="date" class="form-control" name="toDate" aria-label="Default"
                                        aria-describedby="inputGroup-sizing-default">
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary"
                        data-dismiss="modal">{{ __('global.Close') }}</button>
                    <button type="submit" class="btn btn-primary fs-25">
                        <i class="fa fa-print"></i>
                    </button>
                </div>
            </div>
        </form>
    </div>
</div>
{{-- end OutgoingTaskDiscounts Model Report --}}


<!-- IncomingTaskDiscounts ModelReport -->
<div class="modal fade" id="IncomingTaskDiscounts" tabindex="-1" role="dialog"
    aria-labelledby="IncomingTaskDiscountsLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <form action="{{ route('incoming.task.discounts') }}" method="POST">
            @csrf
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="IncomingTaskDiscountsLabel">
                        {{ __('global.incoming-task-discounts') }}</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="form-group">
                        <label>{{ __('global.Select Filter') }}</label>
                        <select multiple="multiple" name="users[]" class="filter-multi">
                            @foreach ($users as $user)
                                <option value="{{ $user->id }}">{{ $user->name() }}</option>
                            @endforeach

                        </select>
                    </div>

                    <label class="my-1 mr-2" for="inlineFormCustomSelectPref">{{ __('task.status') }}</label>
                    <select class="custom-select w-100" id="inlineFormCustomSelectPref" name="users">
                        <option selected>{{ __('global.Choose') }}</option>

                        @foreach ($tasks_status as $task_status)
                            <option value="{{ $task_status->id }}">{{ $task_status->status }}</option>
                        @endforeach
                    </select>

                    <div class="col-md-12 p-0">
                        <div class="row w-100 m-0">
                            <div class="col-md-6 px-1">
                                <div class="text-end"><label for="">{{ __('global.from_date') }}</label>
                                </div>
                                <div class="input-group mb-3">

                                    <div class="input-group-prepend">

                                    </div>
                                    <input type="date" id="" name="fromDate" class="form-control"
                                        aria-label="Default" aria-describedby="inputGroup-sizing-default">
                                </div>


                            </div>
                            <div class="col-md-6 px-1">
                                <div class="text-end">
                                    <label for="">{{ __('to date') }}</label>
                                </div>
                                <div class="input-group mb-3">
                                    <div class="input-group-prepend">

                                    </div>
                                    <input type="date" class="form-control" name="toDate" aria-label="Default"
                                        aria-describedby="inputGroup-sizing-default">
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary"
                        data-dismiss="modal">{{ __('global.Close') }}</button>
                    <button type="submit" class="btn btn-primary fs-25">
                        <i class="fa fa-print"></i>
                    </button>
                </div>
            </div>
        </form>
    </div>
</div>
{{-- end IncomingTaskDiscounts Model Report --}}


<!-- FollowUpEmployeeTasks ModelReport -->
<div class="modal fade" id="FollowUpEmployeeTasks" tabindex="-1" role="dialog"
    aria-labelledby="FollowUpEmployeeTasksLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <form action="{{ route('Follow.Up.Employee.Tasks') }}" method="post">
            @csrf
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="FollowUpEmployeeTasksLabel">
                        {{ __('global.follow-up-employee-tasks') }}
                    </h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    {{ __('global.Follow Up Employee Tasks') }}
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary"
                        data-dismiss="modal">{{ __('global.Close') }}</button>
                    <button type="submit" class="btn btn-primary fs-25">
                        <i class="fa fa-print"></i>
                    </button>
                </div>
            </div>
        </form>
    </div>
</div>
{{-- end FollowUpEmployeeTasks Model Report --}}
