<!-- Modal p1-r1 -->

<div class="modal fade" id="repo-p1-r1" tabindex="-1" role="dialog" aria-labelledby="repo-p1-r1Label" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <form action="{{ route('p1-r1-table') }}" method="get" target="_blank">
            <div class="modal-content">
                <div class="modal-header text-white" style="background:#1B579B ">
                    <h5 class="modal-title" id="repo-p1-r1Label">
                        {{ __('global.repo-p1-r1') }}</h5>
                    <button type="button" class="close text-white" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body ">
                    <div class="col-6">
                        <div class="form-group">
                            <label for="tasksId">{{ __('discount.user') }}</label>
                            <select id="tasksId" name="tasksId[]" multiple class="form-control">
                                @foreach ($tasksP1R1 as $taskP1)
                                    <option value="{{ $taskP1->id }}"
                                        @if (is_array(old('tasksId', $tasksId ?? [])) && in_array($taskP1->id, old('tasksId', $tasksId ?? []))) selected @endif>
                                        {{ $taskP1->title }}
                                    </option>
                                @endforeach
                            </select>
                            @error('tasksId')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>
                    <script>
                        document.addEventListener('DOMContentLoaded', function() {
                            new TomSelect('#tasksId', {
                                plugins: ['remove_button', 'dropdown_input'],
                                placeholder: 'Select tasks...'
                            });
                        });
                    </script>
                </div>

                <div class="modal-footer d-flex justify-content-between">
                    <button type="button" class="btn btn-secondary"
                        data-dismiss="modal">{{ __('global.Close') }}</button>
                    <button type="submit" class="btn btn-primary fs-16 px-4">
                        <i class="fa fa-print"></i>
                    </button>
                </div>
            </div>
        </form>
    </div>
</div>

<!-- Modal p2-r1 -->
<div class="modal fade" id="repo-p2-r1" tabindex="-1" role="dialog" aria-labelledby="repo-p2-r1Label"
    aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <form action="{{ route('p2-r1-table') }}" method="get" target="_blank">
            <div class="modal-content">
                <div class="modal-header text-white" style="background:#1B579B ">
                    <h5 class="modal-title" id="repo-p2-r1Label">
                        {{ __('global.repo-p2-r1') }}</h5>
                    <button type="button" class="close text-white" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>

                <div class="modal-body ">
                    {{-- <table class="table table-bordered">
                        <thead>
                            <tr>
                                <th scope="col">{{ __('global.task-id') }}</th>
                                <th scope="col">{{ __('global.task-name') }}</th>
                                <th scope="col">{{ __('global.select') }}</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($tasksP2R1 as $taskP2R1)
                                <tr>
                                    <th scope="row">
                                        <label for="taskP2R1-{{ $taskP2R1->id }}">
                                            {{ $taskP2R1->id }}
                                        </label>
                                    </th>
                                    <td>
                                        <label for="taskP2R1-{{ $taskP2R1->id }}">
                                            {{ $taskP2R1->title }}
                                        </label>
                                    </td>
                                    <td>
                                        <div class="form-check">
                                            <input class="form-check-input" type="radio" name="taskIdr2p1"
                                                value="{{ $taskP2R1->id }}" id="taskP2R1-{{ $taskP2R1->id }}">
                                        </div>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table> --}}

                    <div class="col-12">
                        <label for="taskIdr2p1">{{ __('global.select-task') }}</label>
                        <select id="taskIdr2p1" name="taskIdr2p1" class="form-control">

                            @foreach ($tasksP2R1 as $taskP2R1)
                                <option value="{{ $taskP2R1->id }}" @if (old('taskIdr2p1') == $taskP2R1->id) selected @endif>
                                    {{ $taskP2R1->title }}
                                </option>
                            @endforeach
                        </select>
                        @error('taskIdr2p1')
                            <span class="text-danger">{{ $message }}</span>
                        @enderror

                        <script>
                            document.addEventListener('DOMContentLoaded', function() {
                                new TomSelect('#taskIdr2p1', {
                                    create: false,
                                    allowEmptyOption: true,
                                    placeholder: 'Search and select a task...'
                                });
                            });
                        </script>
                    </div>

                    <div class="col-12 w-100 m-0">
                        <div class="col-md-12 px-1">
                            <div class="text-end"><label for="">{{ __('global.from_date') }}</label>
                            </div>
                            <div class="input-group mb-3">
                                <div class="input-group-prepend">
                                </div>

                                <input type="date" id="" name="fromDate" class="form-control"
                                    aria-label="Default" aria-describedby="inputGroup-sizing-default">
                            </div>
                        </div>

                        <div class="col-md-12 px-1">
                            <div class="text-end">
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

                <div class="modal-footer d-flex justify-content-between">
                    <button type="button" class="btn btn-secondary"
                        data-dismiss="modal">{{ __('global.Close') }}</button>
                    <button type="submit" class="btn btn-primary fs-16 px-4">
                        <i class="fa fa-print"></i>
                    </button>
                </div>
            </div>
        </form>
    </div>
</div>


<!-- Modal p2-r2 -->
<div class="modal fade" id="repo-p2-r2" tabindex="-1" role="dialog" aria-labelledby="repo-p2-r2Label"
    aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <form action="{{ route('p2-r2-table') }}" method="get" target="_blank">
            <div class="modal-content">
                <div class="modal-header text-white" style="background:#1B579B ">
                    <h5 class="modal-title" id="repo-p2-r2Label">
                        {{ __('global.repo-p2-r2') }}</h5>
                    <button type="button" class="close text-white" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body ">
                    {{-- <table class="table table-bordered">
                        <thead>
                            <tr>
                                <th scope="col">{{ __('global.task-id') }}</th>
                                <th scope="col">{{ __('global.task-name') }}</th>
                                <th scope="col">{{ __('global.select') }}</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($tasksP2R2 as $task)
                                <tr>
                                    <th scope="row">
                                        <label for="task-{{ $task->id }}">
                                            {{ $task->id }}
                                        </label>
                                    </th>
                                    <td>
                                        <label for="task-{{ $task->id }}">
                                            {{ $task->crud_name() }}
                                        </label>
                                    </td>
                                    <td>
                                        <div class="form-check">
                                            <input name="taskIds[]" class="form-check-input" type="checkbox"
                                                value="{{ $task->id }}" id="task-{{ $task->id }}">
                                        </div>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table> --}}

                    <div class="col-12">
                        <div class="form-group">
                            <label for="taskIds">{{ __('global.select-tasks') }}</label>
                            <select id="taskIds" name="taskIds[]" multiple class="form-control">
                                @foreach ($tasksP2R2 as $task)
                                    <option value="{{ $task->id }}"
                                        @if (is_array(old('taskIds', $taskIds ?? [])) && in_array($task->id, old('taskIds', $taskIds ?? []))) selected @endif>
                                        [{{ $task->id }}] {{ $task->crud_name() }}
                                    </option>
                                @endforeach
                            </select>
                            @error('taskIds')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>

                    <script>
                        document.addEventListener('DOMContentLoaded', function() {
                            new TomSelect('#taskIds', {
                                plugins: ['remove_button'],
                                placeholder: 'Search and select tasks...',
                            });
                        });
                    </script>

                    <div class="col-12 w-100 m-0">
                        <div class="col-md-12 px-1">
                            <div class="text-end"><label for="">{{ __('global.from_date') }}</label>
                            </div>
                            <div class="input-group mb-3">
                                <div class="input-group-prepend">
                                </div>
                                <input type="date" id="" name="fromDate" class="form-control"
                                    aria-label="Default" aria-describedby="inputGroup-sizing-default">
                            </div>

                        </div>
                        <div class="col-md-12 px-1">
                            <div class="text-end">
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
                <div class="modal-footer d-flex justify-content-between">
                    <button type="button" class="btn btn-secondary"
                        data-dismiss="modal">{{ __('global.Close') }}</button>
                    <button type="submit" class="btn btn-primary fs-16 px-4">
                        <i class="fa fa-print"></i>
                    </button>
                </div>
            </div>
        </form>
    </div>
</div>

<!-- Modal p4-r1 -->
<div class="modal fade" id="repo-p4-r1" tabindex="-1" role="dialog" aria-labelledby="repo-p4-r1Label"
    aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <form action="{{ route('p4-r1-table') }}" method="get" target="_blank">
            <div class="modal-content">
                <div class="modal-header text-white" style="background:#1B579B ">
                    <h5 class="modal-title" id="repo-p4-r1Label">
                        {{ __('global.repo-p4-r1') }}</h5>
                    <button type="button" class="close text-white" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body ">
                    <table class="table table-bordered">
                        <thead>
                            <tr>
                                <th scope="col">{{ __('global.task-id') }}</th>
                                <th scope="col">{{ __('global.task-name') }}</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($tasksP4R1 as $task)
                                <tr>
                                    <th scope="row">{{ $task->id }}</th>
                                    <td>{{ $task->title }}</td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                    <div class="col-12 w-100 m-0">
                        <div class="col-md-12 px-1">
                            <div class="text-end"><label for="">{{ __('global.from_date') }}</label>
                            </div>
                            <div class="input-group mb-3">
                                <div class="input-group-prepend">
                                </div>

                                <input type="date" id="" name="fromDate" class="form-control"
                                    aria-label="Default" aria-describedby="inputGroup-sizing-default">
                            </div>
                        </div>
                        <div class="col-md-12 px-1">
                            <div class="text-end">
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

                <div class="modal-footer d-flex justify-content-between">
                    <button type="button" class="btn btn-secondary"
                        data-dismiss="modal">{{ __('global.Close') }}</button>
                    <button type="submit" class="btn btn-primary fs-16 px-4">
                        <i class="fa fa-print"></i>
                    </button>
                </div>
            </div>
        </form>
    </div>
</div>


<!-- Modal p4-r2 -->
<div class="modal fade" id="repo-p4-r2" tabindex="-1" role="dialog" aria-labelledby="repo-p4-r2Label"
    aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <form action="{{ route('p4-r2-table') }}" method="get" target="_blank">
            <div class="modal-content">
                <div class="modal-header text-white" style="background:#1B579B ">
                    <h5 class="modal-title" id="repo-p4-r2Label">
                        {{ __('global.repo-p4-r2') }}</h5>
                    <button type="button" class="close text-white" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body ">
                    <div class="col-12 w-100 m-0">
                        <div class="col-md-12 px-1">
                            <div class="text-end"><label for="">{{ __('global.from_date') }}</label>
                            </div>
                            <div class="input-group mb-3">
                                <div class="input-group-prepend">
                                </div>
                                <input type="date" id="" name="fromDate" class="form-control"
                                    aria-label="Default" aria-describedby="inputGroup-sizing-default">
                            </div>
                        </div>
                        <div class="col-md-12 px-1">
                            <div class="text-end">
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

                <div class="modal-footer d-flex justify-content-between">
                    <button type="button" class="btn btn-secondary"
                        data-dismiss="modal">{{ __('global.Close') }}</button>
                    <button type="submit" class="btn btn-primary fs-16 px-4">
                        <i class="fa fa-print"></i>
                    </button>
                </div>
            </div>
        </form>
    </div>
</div>


<!-- Modal p6-r1 -->
<div class="modal fade" id="repo-p6-r1" tabindex="-1" role="dialog" aria-labelledby="repo-p6-r1Label"
    aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <form action="{{ route('p6-r1-table') }}" method="get" target="_blank">
            <div class="modal-content">
                <div class="modal-header text-white" style="background:#1B579B ">
                    <h5 class="modal-title" id="repo-p6-r1Label">
                        {{ __('global.repo-p6-r1') }}</h5>
                    <button type="button" class="close text-white" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body ">
                    <div class="form-group">
                        <label for="emp_id">{{ __('global.by_employee') }}</label>
                        <input class="form-control" list="customerOptions" id="customer_id"
                            placeholder="{{ __('global.type-to-search-employee') }}..." type="text"
                            name="customer_name" onchange="onChangeSearch(event, 'customerOptions', 'emp_id')">
                        <input type="hidden" id="emp_id" name="emp_id">
                        <datalist id="customerOptions">
                            @foreach ($employees as $emp)
                                <option value="{{ $emp->crud_name() }}" data-value="{{ $emp->id }}">
                                    {{ $emp->crud_name() }}
                                </option>
                            @endforeach
                        </datalist>
                    </div>
                </div>

                <div class="modal-footer d-flex justify-content-between">
                    <button type="button" class="btn btn-secondary"
                        data-dismiss="modal">{{ __('global.Close') }}</button>
                    <button type="submit" class="btn btn-primary fs-16 px-4">
                        <i class="fa fa-print"></i>
                    </button>
                </div>
            </div>
        </form>
    </div>
</div>


<!-- Modal p6-r2 -->
<div class="modal fade" id="repo-p6-r2" tabindex="-1" role="dialog" aria-labelledby="repo-p6-r2Label"
    aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <form action="{{ route('p6-r2-table') }}" method="get" target="_blank">
            <div class="modal-content">
                <div class="modal-header text-white" style="background:#1B579B ">
                    <h5 class="modal-title" id="repo-p6-r2Label">
                        {{ __('global.repo-p6-r2') }}</h5>
                    <button type="button" class="close text-white" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body ">
                    <div class="form-group">
                        <label for="browser">{{ __('global.by_manager') }}</label>
                        <input class="form-control" list="managerOptions" id="manager_id"
                            placeholder="{{ __('global.type-to-search') }}..." type="text" name="manager_name"
                            onchange="onChangeSearch(event, 'managerOptions', 'man_id')">
                        <input type="hidden" id="man_id" name="man_id">

                        <datalist id="managerOptions">
                            @foreach ($managers as $manager)
                                <option value="{{ $manager->crud_name() }}" data-value="{{ $manager->id }}">
                                    {{ $manager->crud_name() }}
                                </option>
                            @endforeach
                        </datalist>
                    </div>

                    <div class="mb-3">
                        <label for="disabledTextInput" class="form-label">{{ __('global.report_title') }}</label>
                        <input type="text" disabled id="disabledTextInput" class="form-control"
                            placeholder="{{ __('global.task_out_comments') }}">
                    </div>
                </div>

                <div class="modal-footer d-flex justify-content-between">
                    <button type="button" class="btn btn-secondary"
                        data-dismiss="modal">{{ __('global.Close') }}</button>
                    <button type="submit" class="btn btn-primary fs-16 px-4">
                        <i class="fa fa-print"></i>
                    </button>
                </div>
            </div>
        </form>
    </div>
</div>


<!-- Modal p8-r1 -->
<div class="modal fade" id="repo-p8-r1" tabindex="-1" role="dialog" aria-labelledby="repo-p8-r1Label"
    aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <form action="{{ route('p8-r1-table') }}" method="get" target="_blank">
            <div class="modal-content">
                <div class="modal-header text-white" style="background:#1B579B ">
                    <h5 class="modal-title" id="repo-p8-r1Label">
                        {{ __('global.repo-p8-r1') }}</h5>
                    <button type="button" class="close text-white" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body ">
                    <div class="form-group">
                        <label for="browser">{{ __('global.by_employee') }} </label>
                        <input class="form-control" list="employeesP8R1Options" id="browser"
                            placeholder="{{ __('global.type-to-search-employee') }}..." type="text"
                            name="employeesP8R1_name"
                            onchange="onChangeSearch(event, 'employeesP8R1Options', 'employeesP8R1_id')">
                        <input type="hidden" id="employeesP8R1_id" name="employeesP8R1_id">
                        <datalist id="employeesP8R1Options">
                            @foreach ($employeesP8R1 as $emp)
                                <option value="{{ $emp->crud_name() }}" data-value="{{ $emp->id }}">
                                    {{ $emp->crud_name() }}
                                </option>
                            @endforeach
                        </datalist>
                    </div>
                    <div class="mb-3">
                        <label for="disabledTextInput" class="form-label">{{ __('global.report_title') }}</label>
                        <input type="text" disabled id="disabledTextInput" class="form-control"
                            placeholder="{{ __('global.task_in_comments') }}">
                    </div>
                </div>

                <div class="modal-footer d-flex justify-content-between">
                    <button type="button" class="btn btn-secondary"
                        data-dismiss="modal">{{ __('global.Close') }}</button>
                    <button type="submit" class="btn btn-primary fs-16 px-4">
                        <i class="fa fa-print"></i>
                    </button>
                </div>
            </div>
        </form>
    </div>
</div>

<!-- Modal p8-r2 -->
<div class="modal fade" id="repo-p8-r2" tabindex="-1" role="dialog" aria-labelledby="repo-p8-r2Label"
    aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <form action="{{ route('p8-r2-table') }}" method="get" target="_blank">
            <div class="modal-content">
                <div class="modal-header text-white" style="background:#1B579B ">
                    <h5 class="modal-title" id="repo-p8-r2Label">
                        {{ __('global.p8-r2') }}</h5>
                    <button type="button" class="close text-white" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body ">
                    <div class="form-group">
                        <label for="browser">{{ __('global.by_manager') }}</label>

                        <input class="form-control" list="managersP8R2Options" id="browser"
                            placeholder="{{ __('global.type-to-search-employee') }}..." type="text"
                            name="managersP8R2_name"
                            onchange="onChangeSearch(event, 'managersP8R2Options', 'managersP8R2_id')">
                        <input type="hidden" id="managersP8R2_id" name="managersP8R2_id">
                        <datalist id="managersP8R2Options">
                            @foreach ($managersP8R2 as $emp)
                                <option value="{{ $emp->crud_name() }}" data-value="{{ $emp->id }}">
                                    {{ $emp->crud_name() }}
                                </option>
                            @endforeach
                        </datalist>
                    </div>
                    <select class="form-select" name="taskStatus" aria-label="Default select example">
                        <option value="1">{{ __('global.active_task') }}</option>
                        <option value="2">{{ __('global.closed_task') }}</option>
                        <option value="3">{{ __('global.draft_task') }}</option>
                        <option value="4">{{ __('global.all') }}</option>
                    </select>

                    <div class="row w-100 m-0 mt-4">
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
                    <div class="mb-3">
                        <label for="disabledTextInput" class="form-label">{{ __('global.report_title') }}</label>
                        <input type="text" disabled id="disabledTextInput" class="form-control"
                            placeholder="{{ __('global.outgoing-task-discounts') }}">
                    </div>
                </div>

                <div class="modal-footer d-flex justify-content-between">
                    <button type="button" class="btn btn-secondary"
                        data-dismiss="modal">{{ __('global.Close') }}</button>
                    <button type="submit" class="btn btn-primary fs-16 px-4">
                        <i class="fa fa-print"></i>
                    </button>
                </div>
            </div>
        </form>
    </div>
</div>

<!-- Modal p10-r1 -->
<div class="modal fade" id="repo-p10-r1" tabindex="-1" role="dialog" aria-labelledby="repo-p10-r1Label"
    aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <form action="{{ route('p10-r1-table') }}" method="get" target="_blank">
            <div class="modal-content">
                <div class="modal-header text-white" style="background:#1B579B ">
                    <h5 class="modal-title" id="repo-p10-r1Label">
                        {{ __('global.p10-r1') }}</h5>
                    <button type="button" class="close text-white" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body ">

                    {{-- <table class="table table-bordered">
                        <thead>
                            <tr>
                                <th scope="col">{{ __('global.employee-name') }}</th>
                                <th scope="col">{{ __('global.select') }}</th>
                            </tr>
                        </thead>
                        <tbody>

                            @foreach ($employeesP10R1 as $emp)
                                <tr>
                                    <td>
                                        <label for="employeesP10R1-{{ $emp->id }}">
                                            {{ $emp->crud_name() }}
                                        </label>
                                    </td>
                                    <td>
                                        <div class="form-check">
                                            <input class="form-check-input" name="emp_id"
                                                value="{{ $emp->id }}" type="radio" name="employeesP10R1"
                                                id="employeesP10R1-{{ $emp->id }}">
                                        </div>
                                    </td>
                                </tr>
                            @endforeach

                        </tbody>
                    </table> --}}


                    <div class="form-group">
                        <label for="emp_id2">{{ __('global.select') }}</label>
                        <select id="emp_id2" name="emp_id" class="form-control">

                            @foreach ($employeesP10R1 as $emp)
                                <option value="{{ $emp->id }}" @if (old('emp_id', $emp_id ?? '') == $emp->id) selected @endif>
                                    {{ $emp->crud_name() }}
                                </option>
                            @endforeach
                        </select>
                        @error('emp_id')
                            <span class="text-danger">{{ $message }}</span>
                        @enderror

                        <script>
                            document.addEventListener('DOMContentLoaded', function() {
                                new TomSelect('#emp_id2', {
                                    placeholder: 'Search and select an employee...',
                                    allowEmptyOption: true
                                });
                            });
                        </script>
                    </div>


                    <select class="form-select" name="taskStatus" aria-label="Default select example">
                        <option value="1">{{ __('global.active_task') }}</option>
                        <option value="2">{{ __('global.closed_task') }}</option>
                        <option value="3">{{ __('global.draft_task') }}</option>
                        <option value="4">{{ __('global.all') }}</option>
                    </select>



                    <div class="row w-100 m-0 mt-4">
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

                    <div class="mb-3">
                        <label for="disabledTextInput" class="form-label">{{ __('global.report_title') }}</label>
                        <input type="text" disabled id="disabledTextInput" class="form-control"
                            placeholder="{{ __('global.incoming-task-discounts') }}">
                    </div>
                </div>

                <div class="modal-footer d-flex justify-content-between">
                    <button type="button" class="btn btn-secondary"
                        data-dismiss="modal">{{ __('global.Close') }}</button>
                    <button type="submit" class="btn btn-primary fs-16 px-4">
                        <i class="fa fa-print"></i>
                    </button>
                </div>
            </div>

        </form>

    </div>
</div>


<!-- Modal p11 -->
<div class="modal fade" id="repo-p11" tabindex="-1" role="dialog" aria-labelledby="repo-p11Label"
    aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <form action="{{ route('p11-table') }}" method="get" target="_blank">
            <div class="modal-content">
                <div class="modal-header text-white" style="background:#1B579B ">
                    <h5 class="modal-title" id="repo-p11Label">
                        {{ __('global.p11') }}</h5>
                    <button type="button" class="close text-white" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body ">

                    <div class="form-group">
                        <label for="browser">{{ __('global.by_employee') }}</label>
                        <input class="form-control" list="EmployeesP11ptions" id="browser"
                            placeholder="{{ __('global.type-to-search-employee') }}..." type="text"
                            name="employees11_name"
                            onchange="onChangeSearch(event, 'EmployeesP11ptions', 'employees11_id')">

                        <input type="hidden" id="employees11_id" name="employees11_id">

                        <datalist id="EmployeesP11ptions">
                            @foreach ($employeesP11 as $emp)
                                <option value="{{ $emp->crud_name() }}" data-value="{{ $emp->id }}">
                                    {{ $emp->crud_name() }}
                                </option>
                            @endforeach
                        </datalist>
                    </div>

                    <div class="col-12 w-100 m-0 mt-4">
                        <div class="col-md-12 px-1">
                            <div class="text-end"><label for="">{{ __('global.from_date') }}</label>
                            </div>
                            <div class="input-group mb-3">

                                <div class="input-group-prepend">

                                </div>
                                <input type="date" id="" name="fromDate" class="form-control"
                                    aria-label="Default" aria-describedby="inputGroup-sizing-default">
                            </div>
                        </div>
                        <div class="col-md-12 px-1">
                            <div class="text-end">
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
                <div class="modal-footer d-flex justify-content-between">
                    <button type="button" class="btn btn-secondary"
                        data-dismiss="modal">{{ __('global.Close') }}</button>
                    <button type="submit" class="btn btn-primary fs-16 px-4">
                        <i class="fa fa-print"></i>
                    </button>
                </div>
            </div>

        </form>

    </div>
</div>


<!-- Modal p12 -->
<div class="modal fade" id="repo-p12" tabindex="-1" role="dialog" aria-labelledby="repo-121Label"
    aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <form action="{{ route('p12-table') }}" method="get" target="_blank">
            <div class="modal-content">
                <div class="modal-header text-white" style="background:#1B579B ">
                    <h5 class="modal-title" id="repo-p12Label">
                        {{ __('global.p12') }}</h5>
                    <button type="button" class="close text-white" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body ">

                    <div class="form-group">
                        <label for="browser">{{ __('global.by_employee') }}</label>
                        <input class="form-control" list="EmployeesP12ptions" id="browser"
                            placeholder="{{ __('global.type-to-search-employee') }}..." type="text"
                            name="employees12_name"
                            onchange="onChangeSearch(event, 'EmployeesP12ptions', 'employees12_id')">

                        <input type="hidden" id="employees12_id" name="employees12_id">

                        <datalist id="EmployeesP12ptions">
                            @foreach ($employeesP12 as $emp)
                                <option value="{{ $emp->crud_name() }}" data-value="{{ $emp->id }}">
                                    {{ $emp->crud_name() }}
                                </option>
                            @endforeach
                        </datalist>
                    </div>

                    <div class="col-12 w-100 m-0 mt-4">
                        <div class="col-md-12 px-1">
                            <div class="text-end"><label for="">{{ __('global.from_date') }}</label>
                            </div>
                            <div class="input-group mb-3">

                                <div class="input-group-prepend">

                                </div>
                                <input type="date" id="" name="fromDate" class="form-control"
                                    aria-label="Default" aria-describedby="inputGroup-sizing-default">
                            </div>
                        </div>
                        <div class="col-md-12 px-1">
                            <div class="text-end">
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

                <div class="modal-footer d-flex justify-content-between">
                    <button type="button" class="btn btn-secondary"
                        data-dismiss="modal">{{ __('global.Close') }}</button>
                    <button type="submit" class="btn btn-primary fs-16 px-4">
                        <i class="fa fa-print"></i>
                    </button>
                </div>
            </div>

        </form>

    </div>
</div>


<!-- Modal p13 -->
<div class="modal fade" id="repo-p13" tabindex="-1" role="dialog" aria-labelledby="repo-121Label"
    aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <form action="{{ route('p13-table') }}" method="get" target="_blank">
            <div class="modal-content">
                <div class="modal-header text-white" style="background:#1B579B ">
                    <h5 class="modal-title" id="repo-p13Label">
                        {{ __('global.p13') }}</h5>
                    <button type="button" class="close text-white" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>

                <div class="modal-body ">
                    <div class="form-group">
                        <label for="browser">{{ __('global.by_employee') }}</label>
                        <input class="form-control" list="EmployeesP13ptions" id="browser"
                            placeholder="{{ __('global.type-to-search-employee') }}..." type="text"
                            name="employees12_name"
                            onchange="onChangeSearch(event, 'EmployeesP13ptions', 'employees13_id')">

                        <input type="hidden" id="employees13_id" name="employees13_id">

                        <datalist id="EmployeesP13ptions">
                            @foreach ($employeesP12 as $emp)
                                <option value="{{ $emp->crud_name() }}" data-value="{{ $emp->id }}">
                                    {{ $emp->crud_name() }}
                                </option>
                            @endforeach
                        </datalist>
                    </div>

                    <div class="col-12 w-100 m-0 mt-4">
                        <div class="col-md-12 px-1">
                            <div class="text-end"><label for="">{{ __('global.from_date') }}</label>
                            </div>
                            <div class="input-group mb-3">

                                <div class="input-group-prepend">

                                </div>
                                <input type="date" id="" name="fromDate" class="form-control"
                                    aria-label="Default" aria-describedby="inputGroup-sizing-default">
                            </div>
                        </div>
                        <div class="col-md-12 px-1">
                            <div class="text-end">
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

                <div class="modal-footer d-flex justify-content-between">
                    <button type="button" class="btn btn-secondary"
                        data-dismiss="modal">{{ __('global.Close') }}</button>
                    <button type="submit" class="btn btn-primary fs-16 px-4">
                        <i class="fa fa-print"></i>
                    </button>
                </div>
            </div>

        </form>

    </div>
</div>
