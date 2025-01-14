<!-- OutgoingTaskDiscounts ModelReport -->
{{-- الخصومات المهام الصادرة --}}
<div class="modal fade" id="OutgoingTaskDiscounts" tabindex="-1" role="dialog" aria-labelledby="OutgoingTaskDiscountsLabel"
    aria-hidden="true">
    <div class="modal-dialog" role="document">
        <form class="form-inline" method="post" action="">
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
</div>
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
                <h5 class="modal-title" id="important-commentsLabel">{{ __('global.important-comments') }}</h5>
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
                            <th>{{__('global.Name')}}</th>
                            <th>{{__('global.Email')}}</th>
                            <th>{{__('global.status')}}</th>
                            <th>{{__('global.employee')}}</th>
                            <th>{{__('global.view')}}</th>
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
                <button type="button" class="btn btn-secondary"
                    data-dismiss="modal">{{ __('global.Close') }}</button>
                {{-- <button type="submit" class="btn btn-primary fs-25">
                    <i class="fa fa-print"></i>
                </button> --}}
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
                                <th>{{__('golbal.Name')}}</th>
                                <th>{{__('golbal.Email')}}</th>
                                <th>{{__('golbal.status')}}</th>
                                <th>{{__('golbal.employee')}}</th>
                                <th>{{__('golbal.view')}}</th>
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
                    {{-- <button type="submit" class="btn btn-primary fs-25">
                        <i class="fa fa-eye"></i>
                    </button> --}}
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
                            <th>{{__('global.Name')}}</th>
                            <th>{{__('global.Email')}}</th>
                            <th>{{__('global.status')}}</th>

                            <th>{{__('global.view')}}</th>
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


<!-- tasks-Short-Desc-->
{{-- المهام-الوصف القصير --}}
<div class="modal fade" {{ App::getLocale() == 'en' ? 'dir="ltr"' : 'dir="rtl"' }} id="tasks-Short-Desc"
    tabindex="-1" role="dialog" aria-labelledby="tasks-Short-DescLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <form action="{{ route('tasks.short.desc') }}" method="get">
            @csrf

            <div class="modal-content border-0">

                <div class="modal-header bg-dark text-white">
                    <h5 class="modal-title" id="tasks-Short-DescLabel">
                        {{ __('global.tasks-Short-Desc') }}
                    </h5>
                    <button type="button" class="close text-light" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">

                    <label class="my-1" for="inlineFormCustomSelectPref">{{ __('global.user account') }}</label>
                    <select id="selectBankList" class="custom-select w-100" id="inlineFormCustomSelectPref"
                        name="user">
                        <option value="">{{ __('global.Choose') }}</option>

                        @foreach ($userManager as $user)
                            <option value="{{ $user->id }}">{{ $user->name() }}</option>
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

                    {{-- <button type="submit" class="btn btn-primary fs-25">
                        <i class="fa fa-print"></i>
                    </button> --}}

                </div>

            </div>
        </form>
    </div>
</div>
{{-- المهام-الوصف القصير --}}


<!-- tasks-Short-Desc-->
{{-- المهام-الوصف القصير --}}
<div class="modal fade" {{ App::getLocale() == 'en' ? 'dir="ltr"' : 'dir="rtl"' }} id="employeeFollowUp"
    tabindex="-1" role="dialog" aria-labelledby="employeeFollowUpLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">


        <div class="modal-content border-0">

            <div class="modal-header bg-dark text-white">
                <h5 class="modal-title" id="employeeFollowUpLabel">
                    {{ __('global.employeeFollowUp') }}
                </h5>
                <button type="button" class="close text-light" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">

                <div class="modal-body">
                    <div class="form-group">
                        <input type="text" id="searchInput4" class="form-control"
                            placeholder="Search for names, emails, etc." onkeyup="filterTable4()">
                    </div>
                    <!-- Table -->

                    <table class="table table-bordered table-hover table-responsive">
                        <thead class="thead-dark">
                            <tr>
                                <th>#</th>
                                <th>{{__('global.Name')}}</th>
                                <th>{{__('global.Email')}}</th>
                                <th>{{__('global.status')}}</th>

                                <th>{{__('global.view')}}</th>
                            </tr>
                        </thead>
                        <tbody id="tableBody4">
                            @foreach ($users as $user)
                                <tr>
                                    <td>{{ $loop->index + 1 }}</td>
                                    <td>{{ $user->email }}</td>
                                    <td>{{ $user->name() }}</td>
                                    <td>{{ $user->status }}</td>


                                    <td>
                                        <a href="{{ route('employee.follow.up', $user->id) }}"
                                            class="btn btn-primary">
                                            <i class="fa fa-eye"></i>
                                        </a>
                                    </td>

                                </tr>
                            @endforeach
                            {{-- {{ $tasks->links() }} --}}
                        </tbody>
                    </table>


                    @foreach ($userManager as $user)
                        <option value="{{ $user->id }}">{{ $user->name() }}</option>
                    @endforeach


                </div>
            </div>


            <div class="modal-footer">
                <button type="button" class="btn btn-secondary"
                    data-dismiss="modal">{{ __('global.Close') }}</button>

                {{-- <button type="submit" class="btn btn-primary fs-25">
                    <i class="fa fa-print"></i>
                </button> --}}

            </div>

        </div>

    </div>
</div>
{{-- المهام-الوصف القصير --}}



<!-- Incoming Task Movements ModelReport -->
{{-- حركات المهام الواردة --}}
<div class="modal fade" id="IncomingTaskMovements" tabindex="-1" role="dialog"
    aria-labelledby="IncomingTaskMovementsLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">

        <div class="modal-content ">
            <div class="modal-header">
                <h5 class="modal-title" id="IncomingTaskMovementsLabel">
                    {{ __('global.IncomingTaskMovements') }}
                </h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="modal-body ">

                    <div class="form-group">
                        <input type="text" id="searchInput5" class="form-control"
                            placeholder="Search for names, emails, etc." onkeyup="filterTable5()">
                    </div>

                    <table class="table table-bordered table-hover table-responsive-sm" style="height: 200px">
                        <thead class="thead-dark">
                            <tr>
                                <th>#</th>
                                <th>{{__('global.Name')}}</th>
                                <th>{{__('global.Email')}}</th>
                                <th>{{__('global.status')}}</th>

                                <th>{{__('global.view')}}</th>
                            </tr>
                        </thead>
                        <tbody id="tableBody5">
                            @foreach ($employees as $user)
                                <tr>
                                    <td>{{ $loop->index + 1 }}</td>
                                    <td>{{ $user->email }}</td>
                                    <td>{{ $user->name() }}</td>
                                    <td>{{ $user->status }}</td>


                                    <td>
                                        <a href="{{ route('incoming.task.movements.emp', $user->id) }}"
                                            class="btn btn-primary fs-25">
                                            <i class="fa fa-eye"></i>
                                        </a>
                                    </td>



                                </tr>
                            @endforeach
                            {{-- {{ $tasks->links() }} --}}
                        </tbody>
                    </table>



                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary"
                    data-dismiss="modal">{{ __('global.Close') }}</button>
                {{-- <button type="submit" class="btn btn-primary fs-25">
                    <i class="fa fa-print"></i>
                </button> --}}
            </div>
        </div>

    </div>
</div>
{{-- Incoming Task Movements Model Report --}}


<!-- Outgoing Task Movements ModelReport -->
{{-- حركات المهام الصادرة --}}
<div class="modal fade" id="OutgoingTaskMovements" tabindex="-1" role="dialog"
    aria-labelledby="OutgoingTaskMovementsLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">

        <div class="modal-content ">
            <div class="modal-header">
                <h5 class="modal-title" id="OutgoingTaskMovementsLabel">
                    {{ __('global.OutgoingTaskMovements') }}
                </h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="modal-body ">

                    <div class="form-group">
                        <input type="text" id="searchInput6" class="form-control"
                            placeholder="Search for names, emails, etc." onkeyup="filterTable6()">
                    </div>

                    <table class="table table-bordered table-hover table-responsive-sm" style="height: 200px">
                        <thead class="thead-dark">
                            <tr>
                                <th>#</th>
                                <th>{{__('global.Name')}}</th>
                                <th>{{__('global.Email')}}</th>
                                <th>{{__('global.status')}}</th>

                                <th>{{__('global.view')}}</th>
                            </tr>
                        </thead>
                        <tbody id="tableBody5">
                            @foreach ($userManager as $user)
                                <tr>
                                    <td>{{ $loop->index + 1 }}</td>
                                    <td>{{ $user->email }}</td>
                                    <td>{{ $user->name() }}</td>
                                    <td>{{ $user->status }}</td>


                                    <td>
                                        <a href="{{ route('outgoing.task.movements.manager', $user->id) }}"
                                            class="btn btn-primary fs-25">
                                            <i class="fa fa-eye"></i>
                                        </a>
                                    </td>



                                </tr>
                            @endforeach
                            {{-- {{ $tasks->links() }} --}}
                        </tbody>
                    </table>



                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary"
                    data-dismiss="modal">{{ __('global.Close') }}</button>
                {{-- <button type="submit" class="btn btn-primary fs-25">
                    <i class="fa fa-print"></i>
                </button> --}}
            </div>
        </div>

    </div>
</div>
{{-- Incoming Task Movements Model Report --}}
