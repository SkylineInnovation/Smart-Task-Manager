<!-- OutgoingTaskDiscounts ModelReport -->
{{-- الخصومات المهام الصادرة --}}
{{-- <div class="modal fade" id="OutgoingTaskDiscounts" tabindex="-1" role="dialog" aria-labelledby="OutgoingTaskDiscountsLabel"
    aria-hidden="true">
    <div class="modal-dialog" role="document">
        <form class="form-inline" method="post" action="{{ route('discounts-Outgoing-Task-request.emp') }}">
            @csrf
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="OutgoingTaskDiscountsLabel">
                        {{ __('global.outgoing-task-discounts') }}</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body ">
                    <div id="wrapper">
                        <label class="my-1" for="inlineFormCustomSelectPref">{{ __('global.user account') }}</label>
                        <select id="selectBankList" class="custom-select w-100" id="inlineFormCustomSelectPref"
                            name="user">
                            <option value="">{{ __('global.Choose') }}</option>

                            @foreach ($users as $user)
                                <option value="{{ $user->id }}">{{ $user->name() }}</option>
                            @endforeach


                        </select>
                    </div>

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
</div> --}}
{{-- end OutgoingTaskDiscounts Model Report --}}


{{-- commints in all tasks --}}
{{-- تعليقات كل المهام --}}
<div class="modal fade" id="commintsInAllTasks" tabindex="-1" role="dialog" aria-labelledby="commintsInAllTasksLabel"
    aria-hidden="true">
    <div class="modal-dialog" role="document">
        <form class="form-inline" method="post" action="{{ route('comments.all.tasks') }}">
            @csrf
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="commintsInAllTasksLabel">
                        {{ __('global.commints-in-all-tasks') }}</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body ">
                    <div id="wrapper">
                        <label class="my-1" for="inlineFormCustomSelectPref">{{ __('global.user account') }}</label>
                        <select id="selectBankList" class="custom-select w-100" id="inlineFormCustomSelectPref"
                            name="user">
                            <option value="">{{ __('global.Choose') }}</option>

                            @foreach ($userManager as $user)
                                <option value="{{ $user->id }}">{{ $user->name() }}</option>
                            @endforeach


                        </select>
                    </div>




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
{{-- end commints in all tasks --}}

<!-- teaskModelReport -->
{{-- تعليقات مهمة --}}
<div class="modal fade" {{ App::getLocale() == 'en' ? 'dir="ltr"' : 'dir="rtl"' }} id="important-comments"
    tabindex="-1" role="dialog" aria-labelledby="important-commentsLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content border-0">

            <div class="modal-header bg-dark text-white">
                <h5 class="modal-title" id="important-commentsLabel">{{ __('global.important-commentst') }}</h5>
                <button type="button" class="close text-light" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="form-group">
                    <input type="text" id="searchInput" class="form-control"
                        placeholder="Search for names, emails, etc." onkeyup="filterTable()">
                </div>
                <!-- Table -->

                <table class="table table-bordered table-hover table-responsive">
                    <thead class="thead-dark">
                        <tr>
                            <th>#</th>
                            <th>Name</th>
                            <th>Email</th>
                            <th>status</th>
                            <th>employee</th>
                            <th>view</th>
                        </tr>
                    </thead>
                    <tbody id="tableBody">
                        @foreach ($tasks as $task)
                            <tr>
                                <td>{{ $loop->index + 1 }}</td>
                                <td>{{ $task->crud_name() }}</td>
                                <td>{{ $task->manager->name() }}</td>
                                <td>{{ $task->status }}</td>
                                <td>
                                    @foreach ($task->employees as $taskEmp)
                                        {{ $taskEmp->name() }} ,
                                    @endforeach
                                </td>

                                <td>
                                    <a href="{{ route('one.task.comments', $task) }}"
                                        class="btn btn-info fa fa-eye "></a>
                                </td>

                            </tr>
                        @endforeach
                        {{-- {{ $tasks->links() }} --}}
                    </tbody>
                </table>


            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">{{ __('global.Close') }}</button>
                <button type="submit" class="btn btn-primary fs-25">
                    <i class="fa fa-print"></i>
                </button>
            </div>

        </div>
    </div>
</div>
{{-- end teask Model Report --}}

<!-- Task-specific-comments -->
{{-- تعليقات المهام المحددة --}}
<div class="modal fade" {{ App::getLocale() == 'en' ? 'dir="ltr"' : 'dir="rtl"' }} id="Task-specific-comments"
    tabindex="-1" role="dialog" aria-labelledby="Task-specific-commentsLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content border-0">
            <form action="{{ route('task.specific.comments.page') }}" method="post">
                @csrf
                <div class="modal-header bg-dark text-white">
                    <h5 class="modal-title" id="Task-specific-commentsLabel">
                        {{ __('global.Task-specific-comments') }}
                    </h5>
                    <button type="button" class="close text-light" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="form-group">
                        <input type="text" id="searchInput2" class="form-control"
                            placeholder="Search for names, emails, etc." onkeyup="filterTable2()">
                    </div>
                    <!-- Table -->

                    <table class="table table-bordered table-hover table-responsive">
                        <thead class="thead-dark">
                            <tr>
                                <th>#</th>
                                <th>Name</th>
                                <th>Email</th>
                                <th>status</th>
                                <th>employee</th>
                                <th>view</th>
                            </tr>
                        </thead>
                        <tbody id="tableBody2">
                            @foreach ($tasks as $task)
                                <tr>
                                    <td>{{ $loop->index + 1 }}</td>
                                    <td>{{ $task->crud_name() }}</td>
                                    <td>{{ $task->manager->name() }}</td>
                                    <td>{{ $task->status }}</td>
                                    <td>
                                        @foreach ($task->employees as $taskEmp)
                                            {{ $taskEmp->name() }} ,
                                        @endforeach
                                    </td>

                                    <td>
                                        <div class="form-check d-flex justify-content-center">
                                            <input class="form-check-input" type="checkbox" name="taskCheck[]"
                                                id="" value="{{ $task->id }}">
                                        </div>
                                    </td>

                                </tr>
                            @endforeach
                            {{-- {{ $tasks->links() }} --}}
                        </tbody>
                    </table>


                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary"
                        data-dismiss="modal">{{ __('global.Close') }}</button>
                    <button type="submit" class="btn btn-primary fs-25">
                        <i class="fa fa-eye"></i>
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>
{{-- end teask Model Report --}}


<!-- TIncoming Discounts Report -->
{{-- تقرير الخصومات الواردة   --}}
<div class="modal fade" {{ App::getLocale() == 'en' ? 'dir="ltr"' : 'dir="rtl"' }} id="Incoming-Discounts-Report"
    tabindex="-1" role="dialog" aria-labelledby="Incoming-Discounts-ReportLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content border-0">

            <div class="modal-header bg-dark text-white">
                <h5 class="modal-title" id="Incoming-Discounts-ReportLabel">
                    {{ __('global.Incoming-Discounts-Report') }}
                </h5>
                <button type="button" class="close text-light" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="form-group">
                    <input type="text" id="searchInput3" class="form-control"
                        placeholder="Search for names, emails, etc." onkeyup="filterTable3()">
                </div>
                <!-- Table -->

                <table class="table table-bordered table-hover table-responsive-sm">
                    <thead class="thead-dark">
                        <tr>
                            <th>#</th>
                            <th>Name</th>
                            <th>Email</th>
                            <th>status</th>

                            <th>view</th>
                        </tr>
                    </thead>
                    <tbody id="tableBody3">
                        @foreach ($employees as $emp)
                            <tr>
                                <td>{{ $emp->id }}</td>
                                <td>{{ $emp->crud_name() }}</td>
                                <td>{{ $emp->email }}</td>
                                <td>{{ $emp->status }}</td>
                                <td>
                                    <a href="{{ route('incoming.discount.rseport', $emp->id) }}"
                                        class="btn btn-primary">
                                        <i class="fa fa-eye"></i>
                                    </a>
                                </td>
                            </tr>
                        @endforeach


                    </tbody>
                </table>


            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary"
                    data-dismiss="modal">{{ __('global.Close') }}</button>

            </div>

        </div>
    </div>
</div>
{{-- end teask Model Report --}}




















<!-- Closed task soon ModelReport -->

{{-- <div class="modal fade" id="closedTaskComingSoonReport" tabindex="-1" role="dialog"
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
</div> --}}
{{-- end closed  task soon Model Report --}}


<!-- OutgoingTaskMovements ModelReport -->
{{-- <div class="modal fade" id="OutgoingTaskMovements" tabindex="-1" role="dialog"
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
                <div class="modal-body {{ App::getlocale() == 'en' ? 'text-start' : 'text-end' }}">
                    <label class=" "
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
</div> --}}
{{-- end OutgoingTaskMovements Model Report --}}


<!-- Incoming Task Movements ModelReport -->
{{-- <div class="modal fade" id="IncomingTaskMovements" tabindex="-1" role="dialog"
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
                    <div class="modal-body ">
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
</div> --}}
{{-- Incoming Task Movements Model Report --}}





<!-- IncomingTaskDiscounts ModelReport -->
{{-- <div class="modal fade" id="IncomingTaskDiscounts" tabindex="-1" role="dialog"
    aria-labelledby="IncomingTaskDiscountsLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <form action="{{ route('incoming.task.discounts') }}" method="POST">
            @csrf
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="IncomingTaskDiscountsLabel">
                        {{ __('global.Deductions') }}</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="form-group">
                        <label>{{ __('global.select-employees') }}</label>
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
                                <div class=""><label for="">{{ __('global.from_date') }}</label>
                                </div>
                                <div class="input-group mb-3">

                                    <div class="input-group-prepend">

                                    </div>
                                    <input type="date" id="" name="fromDate" class="form-control"
                                        aria-label="Default" aria-describedby="inputGroup-sizing-default">
                                </div>


                            </div>
                            <div class="col-md-6 px-1">
                                <div class="">
                                    <label for="">{{ __('global.to date') }}</label>
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
</div> --}}
{{-- end IncomingTaskDiscounts Model Report --}}


<!-- FollowUpEmployeeTasks ModelReport -->
{{-- <div class="modal fade" id="FollowUpEmployeeTasks" tabindex="-1" role="dialog"
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
</div> --}}
{{-- end FollowUpEmployeeTasks Model Report --}}
