<div>
    @foreach ($tasks as $task)
        <div class="card p-0 text-start" wire:key='{{ $task->id }}'>
            <div class="card-body p-0">
                <div class="row w-100 m-0">
                    <div class="col-md-8 col-7 p-0 ">
                        <div class="col-md-12 pt-4">
                            <h4 class="px-4 text-bold">
                                {{ $task->title }}
                            </h4>
                        </div>
                        <div class="col-md-12">
                            <h6 class="text-gray px-4">
                                {{ $task->manager->name() }}
                            </h6>
                        </div>
                        <div class="col-md-12">
                            <h6 class="text-gray px-4">
                                {{ __('task.Sub-Task') }}: {{ $task->sub_tasks->count() }}
                            </h6>
                        </div>
                    </div>

                    <div class="col-md-4 col-5 d-flex align-items-center p-0">
                        <div class="row w-100 m-0 justify-content-md-around">
                            <div class="col-3 d-flex justify-content-center fs-4 dropdown show">
                                <a class="fa fa-cog text-secondarye" href="javascript:;" role="button"
                                    id="dropdownMenuLink" data-toggle="dropdown" aria-haspopup="true"
                                    aria-expanded="false">
                                </a>

                                <div class="dropdown-menu" aria-labelledby="dropdownMenuLink">
                                    @role('employee')
                                        @if ($task->status == 'pending')
                                            <a class="dropdown-item" href="javascript:;"
                                                wire:click="startWithTask({{ $task->id }})">
                                                <i class="fa fa-hourglass-end text-info" aria-hidden="true"></i>
                                                &nbsp; {{ __('task.Start') }}
                                            </a>
                                        @endif

                                        @if ($task->status == 'active')
                                            <a class="dropdown-item" href="javascript:;"
                                                wire:click="finishWithTask({{ $task->id }})">
                                                <i class="fa fa-check-square text-success" aria-hidden="true"></i>
                                                &nbsp; {{ __('task.Finsh') }}
                                            </a>
                                        @endif
                                    @endrole


                                    @role('owner|manager')
                                        {{-- @if (in_array($task->status, ['auto-finished', 'manual-finished'])) --}}
                                        <a class="dropdown-item" href="javascript:;"
                                            wire:click="draftTask({{ $task->id }})">
                                            <i class="fa fa-warning text-danger" aria-hidden="true"></i>
                                            &nbsp; {{ __('task.draft') }}
                                        </a>
                                        {{-- @endif --}}

                                        <a class="dropdown-item" href="javascript:;" data-toggle="modal"
                                            wire:click="editTask({{ $task->id }})"
                                            data-target="#update-task-{{ $task->id }}">
                                            <i class="fa fa-pencil-square-o text-secondarye" aria-hidden="true"></i>
                                            &nbsp; {{ __('task.Edit') }}
                                        </a>

                                        <a class="dropdown-item" href="javascript:;"
                                            wire:click='deleteTask({{ $task->id }})'>
                                            <i class="fa fa-trash-o text-danger" aria-hidden="true"></i>
                                            &nbsp; {{ __('task.Delete') }}
                                        </a>
                                    @endrole

                                    @role('employee')
                                        <a class="dropdown-item" href="javascript:;" data-toggle="modal"
                                            data-target="#request-leave-modal-{{ $task->id }}"
                                            wire:click="setTask({{ $task->id }})">
                                            <i class="fa fa-sign-out text-info" aria-hidden="true"></i>
                                            &nbsp; {{ __('task.Request_Leave') }}
                                        </a>

                                        <a class="dropdown-item" data-toggle="modal"
                                            data-target="#extra-time-modal-{{ $task->id }}" href=javascript:;
                                            wire:click="setTask({{ $task->id }})">
                                            <i class="fa fa-clock-o text-warning" aria-hidden="true"></i>
                                            &nbsp; {{ __('task.Extra_Time') }}
                                        </a>
                                    @endrole

                                </div>
                            </div>

                            <div class="col-3 d-flex justify-content-center fs-4">
                                <button type="button" class="fa fa-exclamation-circle text-azure" data-toggle="modal"
                                    data-target="#show-task-modal-{{ $task->id }}"
                                    wire:click="setTask({{ $task->id }})">
                                </button>
                            </div>

                            <div class="col-3 d-flex justify-content-center fs-4">
                                <button type="button" class="fa fa-commenting-o text-info" data-toggle="modal"
                                    data-target="#show-task-modal-{{ $task->id }}"
                                    wire:click="openCommentTask({{ $task->id }})">
                                </button>
                            </div>

                            <div class="col-3 d-flex justify-content-center fs-4">
                                <a type="button" class="ti-eye text-success" href="{{ route('task.show', $task) }}"
                                    target="_blank">
                                </a>
                            </div>

                            <div class="col-12 py-3">
                                <div class="rounded-pill text-white text-center py-1"
                                    style="background-color: {{ $task->the_priority_color() }}">
                                    {{ $task->the_priority_level() }}
                                </div>
                            </div>
                        </div>
                    </div>


                    <div class="col-md-12 pt-2">
                        <h4 class="px-4 text-gray-400">
                            {{ __('task.employees') }}
                        </h4>

                        <div class="row w-100 m-0 py-3">
                            @foreach ($task->employees as $employee)
                                <div class="col-4" data-container="body" data-toggle="tooltip"
                                    data-popover-color="default" data-placement="top" title="{{ $employee->name() }}">
                                    <img src="{{ asset($employee->image) }}"
                                        style="width: 40px !important; border-radius: 100px;"
                                        alt="{{ $employee->name() }}">
                                    {{ $employee->name() }}
                                </div>
                            @endforeach
                        </div>
                    </div>

                    <div class="col-md-12">
                        <div class="row w-100 m-0 ">
                            <div class="col-md-12 px-4 fs-6 text-gray-400">
                                {{ __('task.start_at') }}: {{ $task->format_date($task->start_time) }}
                            </div>
                            <div class="col-md-12 px-4 fs-6 text-gray-400">
                                {{ __('task.end_at') }}: {{ $task->format_date($task->end_time) }}
                            </div>


                            {{-- <small class="col-md-12 px-4 text-muted pt-3">{{ __('task.remain') }}:
                                <span class="timer-outputpattern-{{ $task->id }}"></span>
                            </small> --}}

                            <small class="col-md-12 px-4 text-muted pb-3">{{ __('task.assigend') }}:
                                {{ date('Y/m/d h:i A', strtotime($task->created_at)) }}
                                ({{ $task->created_ago($task->created_at) }})</small>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        {{-- --}}{{-- --}}{{-- --}}{{-- --}}
        <div wire:ignore.self class="modal fade" id="show-task-modal-{{ $task->id }}" tabindex="-1"
            role="dialog" aria-labelledby="show-task-modal-{{ $task->id }}Label" aria-hidden="true"
            data-backdrop="static" data-keyboard="false">
            <div class="modal-dialog modal-lg" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        {{-- <div> --}}
                        {{-- <h5 class="modal-title" id="show-task-modal-{{ $task->id }}Label">
                                <span class="me-5">Task Details</span>
                            </h5> --}}
                        {{-- </div> --}}
                        <div class="rounded-pill text-white text-center px-4 py-1"
                            style="background-color: {{ $task->the_priority_color() }}">
                            {{ $task->the_priority_level() }}
                        </div>

                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>

                    <div class="modal-body">
                        <div class="row">
                            <div class="col-8 text-start">
                                <div>
                                    <h4>{{ __('task.Title') }}: {{ $task->title }}</h4>
                                </div>

                                <div>
                                    <h5>{{ __('task.Discription') }}:</h5>
                                    <small class="fs-5 text-gray">{!! $task->desc !!}</small>
                                </div>
                            </div>

                            <div class="col-4">
                                <div class="row text-start">
                                    <div class="col-12">
                                        {{ __('task.From') }}:
                                        {{ date('Y-m-d h:i A', strtotime($task->start_time)) }}
                                    </div>

                                    <div class="col-12">
                                        {{ __('task.To') }}:
                                        {{ date('Y-m-d h:i A', strtotime($task->end_time)) }}
                                    </div>

                                    {{-- <div class="col-12">
                                        {{ __('task.remain') }}:
                                        <span class="timer-outputpattern-{{ $task->id }}"></span>
                                    </div> --}}
                                </div>
                            </div>
                        </div>

                        <div class="col-md-12 pt-5">
                            <ul class="nav nav-tabs" id="myTab" role="tablist">
                                {{-- 1 TAB START --}}
                                <li class="nav-item px-1">
                                    <a class="nav-link py-3 rounded-pill {{ $tab == 1 ? 'active' : '' }}"
                                        id="user-tab" data-toggle="tab" wire:click="changeTab(1)" href="#user"
                                        role="tab" aria-controls="user"
                                        aria-selected="{{ $tab == 1 }}">{{ __('task.employees') }}</a>
                                </li>
                                {{-- 1 TAB END --}}

                                {{-- 2 TAB START --}}
                                <li class="nav-item px-1">
                                    <a class="nav-link py-3 rounded-pill {{ $tab == 2 ? 'active' : '' }}"
                                        id="attatchment-tab" data-toggle="tab" wire:click="changeTab(2)"
                                        href="#attatchment" role="tab" aria-controls="attatchment"
                                        aria-selected="{{ $tab == 2 }}">{{ __('task.Attatchments') }}</a>
                                </li>
                                {{-- 2 TAB END --}}

                                {{-- 3 TAB START --}}
                                <li class="nav-item px-1">
                                    <a class="nav-link py-3 rounded-pill {{ $tab == 3 ? 'active' : '' }}"
                                        id="comment-tab" data-toggle="tab" wire:click="changeTab(3)" href="#comment"
                                        role="tab" aria-controls="comment"
                                        aria-selected="{{ $tab == 3 }}">{{ __('task.Comments') }}</a>
                                </li>
                                {{-- 3 TAB END --}}

                                {{-- 4 TAB START --}}
                                <li class="nav-item px-1">
                                    <a class="nav-link py-3 rounded-pill {{ $tab == 4 ? 'active' : '' }}"
                                        id="subTask-tab" data-toggle="tab" wire:click="changeTab(4)" href="#subTask"
                                        role="tab" aria-controls="subTask"
                                        aria-selected="{{ $tab == 4 }}">{{ __('task.Sub_Tasks') }}</a>
                                </li>
                                {{-- 4 TAB END --}}

                                {{-- 5 TAB START --}}
                                <li class="nav-item px-1">
                                    <a class="nav-link py-3 rounded-pill {{ $tab == 5 ? 'active' : '' }}"
                                        id="extra-tab" data-toggle="tab" wire:click="changeTab(5)" href="#extra"
                                        role="tab" aria-controls="extra"
                                        aria-selected="{{ $tab == 5 }}">{{ __('task.Extra_Time') }}</a>
                                </li>
                                {{-- 5 TAB END --}}

                                {{-- 6 TAB START --}}
                                <li class="nav-item px-1">
                                    <a class="nav-link py-3 rounded-pill {{ $tab == 6 ? 'active' : '' }}"
                                        id="leave-tab" data-toggle="tab" wire:click="changeTab(6)" href="#leave"
                                        role="tab" aria-controls="leave"
                                        aria-selected="{{ $tab == 6 }}">{{ __('task.leave') }}</a>
                                </li>
                                {{-- 6 TAB END --}}


                                {{-- 7 TAB START --}}
                                <li class="nav-item px-1">
                                    <a class="nav-link py-3 rounded-pill {{ $tab == 7 ? 'active' : '' }}"
                                        id="emp_task-tab" data-toggle="tab" wire:click="changeTab(7)"
                                        href="#emp_task" role="tab" aria-controls="emp_task"
                                        aria-selected="{{ $tab == 7 }}">{{ __('task.addEmpTask') }}</a>
                                </li>
                                {{-- 7 TAB END --}}
                            </ul>

                            <div class="tab-content pt-2" id="myTabContent">
                                {{-- 1 TAB START --}}
                                <div class="tab-pane fade {{ $tab == 1 ? 'show active' : '' }}" id="user"
                                    role="tabpanel" aria-labelledby="user-tab">

                                    <div class="table-responsive text-start">
                                        <table class="table">
                                            <thead>
                                                <tr>
                                                    <th scope="col-8">{{ __('task.Users') }}</th>
                                                    <th scope="col">{{ __('task.Role') }}</th>
                                                </tr>
                                            </thead>
                                            <tbody class="fs-6">
                                                @foreach ($task->employees as $employee)
                                                    <tr>
                                                        <td>
                                                            <div class="row w-100 m-0 ">
                                                                <div class="col-3">
                                                                    <img src="{{ asset($employee->image) }}"
                                                                        style="border-radius: 40%; width: 50px;">
                                                                </div>
                                                                <div class="col">
                                                                    <div class="col-12">
                                                                        {{ $employee->name() }}

                                                                        <div>
                                                                            <small>{{ $employee->email }}</small>
                                                                        </div>
                                                                        <div>
                                                                            <small>{{ $employee->phone }}</small>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </td>
                                                        <td class="align-content-center">
                                                            {{ $employee->rolesSideBySide() }}
                                                        </td>
                                                    </tr>
                                                @endforeach
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                                {{-- 1 TAB END --}}

                                {{-- 2 TAB START --}}
                                <div class="tab-pane fade {{ $tab == 2 ? 'show active' : '' }}" id="attatchment"
                                    role="tabpanel" aria-labelledby="attatchment-tab">

                                    <div class="text-start">
                                        <div>
                                            <div class="row">
                                                <div class="col">
                                                    <div class="input-group mb-1">
                                                        <div class="input-group-prepend">
                                                            <span class="input-group-text btn-secondary text-white"
                                                                id="inputGroup-sizing-default">{{ __('attachment.title') }}</span>
                                                        </div>
                                                        <input wire:model.defer="attatchment_title" type="text"
                                                            class="form-control" aria-label="Default"
                                                            aria-describedby="inputGroup-sizing-default">
                                                    </div>
                                                </div>

                                                <div class="col">
                                                    <div class="input-group mb-1">
                                                        {{-- <div class="input-group-prepend">
                                                        <span class="input-group-text btn-secondary text-white"
                                                            id="inputGroup-sizing-default">{{ __('attachment.file') }}</span>
                                                    </div> --}}
                                                        <input wire:model.defer="attatchment_file" type="file"
                                                            class="form-control" aria-label="Default"
                                                            aria-describedby="inputGroup-sizing-default">
                                                    </div>
                                                    <div wire:loading wire:target="attatchment_file">
                                                        {{ __('task.Uploading...') }}</div>
                                                </div>
                                            </div>

                                            <div wire:ignore.self class="mb-1">
                                                {{-- <div wire:ignore.self id="summer_desc"></div> --}}
                                                <textarea name='desc' id='desc' rows="3" class='form-control'
                                                    placeholder='{{ __(' global.enter') }} {{ __('attachment.desc') }}' wire:model.defer="attatchment_desc"></textarea>
                                            </div>

                                            <button wire:click="addAttatchment()" type="button"
                                                class="w-100 btn btn-success">
                                                {{ __('task.Upload') }}
                                            </button>

                                        </div>

                                        <div class="container py-3">
                                            @foreach ($task->attatchments as $attatch)
                                                <div class="row w-100 m-0 border">
                                                    <div class="col-md-3">
                                                        {{-- @if ($attatch->is_image())
                                                            <img src="{{ asset($attatch->file) }}" alt=""
                                                                style="width: 100px ; height: 100px;" srcset="">
                                                        @else
                                                            <a href="{{ asset($attatch->file) }}" download>
                                                                {{ $attatch->file }}
                                                                {{ $attatch->is_image() ? 'Y' : 'N' }}
                                                            </a>
                                                        @endif --}}

                                                    </div>
                                                    <div class="col-md-6">
                                                        <h4>{{ $attatch->title }}</h4>


                                                        <p>
                                                            {{ $attatch->desc }}
                                                        </p>


                                                    </div>
                                                    <div
                                                        class="col-md-3 d-flex justify-content-center align-items-center">

                                                        <a class="btn btn-success" href="{{ asset($attatch->file) }}"
                                                            download>
                                                            <i class="fa fa-download text-white"></i>
                                                        </a>
                                                        @role('owner|manager')
                                                            <a class="btn btn-danger"
                                                                wire:click='deleteAttatchment({{ $attatch->id }})'>
                                                                <i class="fa fa-trash text-white"></i>
                                                            </a>
                                                        @endrole
                                                    </div>
                                                </div>
                                            @endforeach
                                        </div>

                                    </div>
                                    {{-- <input wire:ignore.self wire:model="attatchment_file" type="file" class="dropify"
                                    data-height="150" /> --}}
                                </div>
                                {{-- 2 TAB END --}}

                                {{-- 3 TAB START --}}
                                <div class="tab-pane fade {{ $tab == 3 ? 'show active' : '' }}" id="comment"
                                    role="tabpanel" aria-labelledby="comment-tab">

                                    <div class="text-start">
                                        <div>
                                            <div class="input-group mb-1">
                                                <div class="input-group-prepend">
                                                    <span class="input-group-text btn-secondary text-white"
                                                        id="inputGroup-sizing-default">{{ __('attachment.title') }}</span>
                                                </div>
                                                <input wire:model.defer="comment_title" type="text"
                                                    class="form-control" aria-label="Default"
                                                    aria-describedby="inputGroup-sizing-default">
                                            </div>

                                            <div wire:ignore.self class="mb-1">
                                                {{-- <div wire:ignore.self id="summer_desc"></div> --}}
                                                <textarea name='desc' id='desc' rows="3" class='form-control'
                                                    placeholder='{{ __('global.enter') }} {{ __('attachment.desc') }}' wire:model.defer="comment_desc"></textarea>
                                            </div>

                                            <button wire:click="addComment()" type="button"
                                                class="w-100 btn btn-success">
                                                {{ __('task.Commet') }}
                                            </button>
                                        </div>

                                        <div class="container py-3">
                                            @foreach ($task->comments as $comment)
                                                <div class="media">
                                                    <img class="mr-3"
                                                        src="{{ asset('assets/images/users/10.jpg') }}"
                                                        alt="Generic placeholder image">
                                                    <div class="media-body">
                                                        <h5 class="mt-0">{{ $comment->user->name() }},
                                                            {{ $comment->title }}</h5>
                                                        <p>{{ $comment->desc }}</p>
                                                        <div class="col-12 d-flex justify-content-end">

                                                            <a class="btn btn-primary-gradient" data-toggle="modal"
                                                                wire:click="setCommentId({{ $comment->id }})"
                                                                data-target="#replay-modal-{{ $task->id }}">
                                                                <i class="fa fa-comment text-white"></i>
                                                            </a>
                                                            &nbsp;

                                                            @role('owner|manager')
                                                                <a class="btn btn-danger"
                                                                    wire:click='deleteComents({{ $comment->id }})'>
                                                                    <i class="fa fa-trash text-white"></i>
                                                                </a>
                                                            @endrole
                                                        </div>

                                                        @foreach ($comment->subs as $subCom)
                                                            <div class="media mt-3">
                                                                <a class="pr-3" href="#">
                                                                    <img src="{{ asset('assets/images/users/10.jpg') }}"
                                                                        alt="Generic placeholder image">
                                                                </a>
                                                                <div class="media-body">
                                                                    <h5 class="mt-0">{{ $subCom->user->name() }},
                                                                        {{ $subCom->title }}</h5>
                                                                    <p>{{ $subCom->desc }}</p>
                                                                </div>
                                                            </div>
                                                        @endforeach
                                                    </div>
                                                </div>

                                                <div wire:ignore.self class="modal fade"
                                                    id="replay-modal-{{ $task->id }}" tabindex="-1"
                                                    role="dialog"
                                                    aria-labelledby="replay-modal-{{ $task->id }}-Label"
                                                    aria-hidden="true" data-backdrop="static" data-keyboard="false">
                                                    <div class="modal-dialog modal-lg" role="document">
                                                        <div class="modal-content">
                                                            <div class="modal-header">
                                                                <h5 class="modal-title"
                                                                    id="replay-modal-{{ $task->id }}-Label">
                                                                    {{ __('task.Replay') }}
                                                                </h5>
                                                                <button type="button" class="close"
                                                                    data-dismiss="modal" aria-label="Close">
                                                                    <span aria-hidden="true">&times;</span>
                                                                </button>
                                                            </div>
                                                            <div class="modal-body">
                                                                <div class="input-group mb-1">
                                                                    <div class="input-group-prepend">
                                                                        <span
                                                                            class="input-group-text btn-secondary text-white"
                                                                            id="inputGroup-sizing-default">{{ __('attachment.title') }}</span>
                                                                    </div>
                                                                    <input wire:model.defer="replay_comment_title"
                                                                        type="text" class="form-control"
                                                                        aria-label="Default"
                                                                        aria-describedby="inputGroup-sizing-default">
                                                                </div>

                                                                <div wire:ignore.self class="mb-1">
                                                                    {{-- <div wire:ignore.self id="summer_desc"></div> --}}
                                                                    <textarea name='desc' id='desc' rows="3" class='form-control'
                                                                        placeholder='{{ __(' global.enter') }} {{ __('attachment.desc') }}' wire:model.defer="replay_comment_desc"></textarea>
                                                                </div>


                                                            </div>
                                                            <div class="modal-footer">
                                                                <button type="button" class="btn btn-secondary"
                                                                    data-dismiss="modal">{{ __('task.Close') }}</button>

                                                                <button wire:click="replayComment()" type="button"
                                                                    class="btn btn-success">
                                                                    {{ __('task.Commet') }}
                                                                </button>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            @endforeach
                                        </div>
                                    </div>

                                </div>
                                {{-- 3 TAB END --}}

                                {{-- 4 TAB START --}}
                                <div class="tab-pane fade {{ $tab == 4 ? 'show active' : '' }}" id="subTask"
                                    role="tabpanel" aria-labelledby="subTask-tab">
                                    <div class="text-start">
                                        @role('owner|manager')
                                            <div>
                                                <div class="row">

                                                    <div class="input-group mb-1 col-8">
                                                        <div class="input-group-prepend ">
                                                            <span class="input-group-text btn-secondary text-white"
                                                                id="inputGroup-sizing-default">{{ __('task.Title') }}</span>
                                                        </div>

                                                        <input wire:model.defer="sub_task_title" type="text"
                                                            class="form-control" aria-label="Default"
                                                            aria-describedby="inputGroup-sizing-default">
                                                    </div>

                                                    <div class="form-group mb-1 col-4">
                                                        <select wire:model.defer="sub_task_priority_level"
                                                            class="form-control">
                                                            <option value="low">{{ __('task.low') }}</option>
                                                            <option value="medium">{{ __('task.medium') }}</option>
                                                            <option value="high">{{ __('task.high') }}</option>
                                                        </select>
                                                    </div>

                                                    <div class="input-group mb-1  col-md-6">
                                                        <div class="input-group-prepend ">
                                                            <span class="input-group-text btn-secondary text-white"
                                                                id="inputGroup-sizing-default">{{ __('task.start_time') }}</span>
                                                        </div>
                                                        <input wire:model.defer="sub_task_start_time"
                                                            type="datetime-local" class="form-control"
                                                            aria-label="Default"
                                                            aria-describedby="inputGroup-sizing-default">
                                                    </div>

                                                    <div class="input-group mb-1  col-md-6">
                                                        <div class="input-group-prepend ">
                                                            <span class="input-group-text btn-secondary text-white"
                                                                id="inputGroup-sizing-default">{{ __('task.end_time') }}</span>
                                                        </div>
                                                        <input wire:model.defer="sub_task_end_time" type="datetime-local"
                                                            class="form-control" aria-label="Default"
                                                            aria-describedby="inputGroup-sizing-default">
                                                    </div>

                                                    <div wire:ignore.self class="col-md-12">
                                                        {{-- <div wire:ignore.self id="summer_desc"></div> --}}
                                                        <textarea name='desc' id='desc' rows="4" class='form-control'
                                                            placeholder='{{ __(' global.enter') }} {{ __('task.desc') }}' wire:model.defer="sub_task_desc"></textarea>
                                                    </div>

                                                </div>

                                                <div class="form-group">
                                                    @foreach ($errors->all() as $error)
                                                        <span class='alert alert-danger btn'>{{ $error }}</span>
                                                    @endforeach
                                                </div>

                                                <button wire:click="addSubTask()" type="button"
                                                    class="w-100 btn btn-success">
                                                    {{ __('task.Add_Sub_Task') }}
                                                </button>
                                            </div>
                                        @endrole

                                        <div class="py-4">
                                            @foreach ($task->sub_tasks as $sub)
                                                <div class="row w-100 m-0 border shadow text-start">

                                                    <div class="col-md-6 ">
                                                        <div class="col-md-12">
                                                            <div class="row">
                                                                <div class="col-md-6">
                                                                    {{ __('task.Title') }}:
                                                                </div>

                                                                <div class="col-md-6">
                                                                    {{ $sub->title }}
                                                                </div>
                                                            </div>
                                                        </div>

                                                        <div class="col-md-12">
                                                            <div class="row">
                                                                <div class="col-md-6">
                                                                    {{ __('task.Description') }}:
                                                                </div>

                                                                <div class="col-md-6">
                                                                    {{ $sub->desc }}
                                                                </div>
                                                            </div>
                                                        </div>

                                                        <div class="col-md-12">
                                                            <div class="row">
                                                                <div class="col-md-6">
                                                                    {{ __('task.Employee') }}:
                                                                </div>
                                                                @foreach ($sub->employees as $subEm)
                                                                    <div class="col-md-6">
                                                                        {{ $subEm->name() }}
                                                                    </div>
                                                                @endforeach
                                                            </div>
                                                        </div>
                                                    </div>

                                                    <div class="col-md-6">
                                                        <div class="col-md-12">
                                                            <div class="row">
                                                                <div class="col-md-6">
                                                                    {{ __('task.Priority') }}:
                                                                </div>

                                                                <div class="col-md-6">
                                                                    {{ $sub->the_priority_level() }}
                                                                </div>
                                                            </div>
                                                        </div>

                                                        <div class="col-md-12">
                                                            <div class="row">
                                                                <div class="col-md-6">
                                                                    {{ __('task.From') }}:
                                                                    <br>
                                                                    {{ date('Y-m-d h:i A', strtotime($sub->start_time)) }}
                                                                </div>

                                                                <div class="col-md-6">
                                                                    {{ __('task.To') }}:
                                                                    <br>
                                                                    {{ date('Y-m-d h:i A', strtotime($sub->end_time)) }}
                                                                </div>
                                                            </div>
                                                        </div>

                                                        <div class="row">
                                                            <div class="col-md-6">
                                                                {{ __('task.status') }}:
                                                            </div>

                                                            <div class="col-md-6">
                                                                {{ $sub->the_status() }}
                                                            </div>

                                                            @if ($sub->status == 'pending')
                                                                <div class="col-md-12">
                                                                    <button class="btn btn-info"
                                                                        wire:click="startSubTask({{ $sub->id }})">
                                                                        start
                                                                    </button>
                                                                </div>
                                                            @elseif($sub->status == 'active')
                                                                <div class="col-md-12">
                                                                    <button class="btn btn-success"
                                                                        wire:click="completeSubTask({{ $sub->id }})">
                                                                        complete
                                                                    </button>
                                                                </div>
                                                            @endif

                                                        </div>
                                                    </div>
                                                </div>
                                            @endforeach
                                        </div>
                                    </div>
                                </div>
                                {{-- 4 TAB END --}}

                                {{-- 5 TAB START --}}
                                <div class="tab-pane fade {{ $tab == 5 ? 'show active' : '' }}" id="extra"
                                    role="tabpanel" aria-labelledby="extra-tab">
                                    <div class="text-start py-4">
                                        @foreach ($task->extra_times as $extra_time)
                                            <div class="row w-100 m-0 border shadow ">

                                                <div class="col-md-6 ">
                                                    <div class="col-md-12">
                                                        <div class="row">
                                                            <div class="col-md-6">
                                                                {{ __('task.Title') }}:
                                                            </div>

                                                            <div class="col-md-6">
                                                                {{ $extra_time->reason }}
                                                            </div>
                                                        </div>
                                                    </div>

                                                    <div class="col-md-12">
                                                        <div class="row">
                                                            <div class="col-md-6">
                                                                {{ __('task.Employee') }}:
                                                            </div>

                                                            <div class="col-md-6">
                                                                {{ $extra_time->user->name() }}
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>

                                                <div class="col-md-6">
                                                    <div class="col-md-12 mb-3">
                                                        <div class="row">
                                                            <div class="col-md-6">
                                                                {{ __('task.status') }}:
                                                            </div>

                                                            <div class="col-md-6">
                                                                @if ($extra_time->status == 'pending')
                                                                    <div class="dropdown">
                                                                        <button
                                                                            class="btn {{ $extra_time->the_extra_color() }} dropdown-toggle p-1"
                                                                            type="button" id="dropdownMenuButton"
                                                                            data-toggle="dropdown"
                                                                            aria-haspopup="true"
                                                                            aria-expanded="false">
                                                                            {{ $extra_time->the_status() }}
                                                                        </button>
                                                                        @role('owner|manager')
                                                                            <div class="dropdown-menu"
                                                                                aria-labelledby="dropdownMenuButton">
                                                                                <button class="dropdown-item"
                                                                                    data-toggle="modal"
                                                                                    data-target="#accept-extratime-modal-{{ $task->id }}"
                                                                                    wire:click="setExtraTime({{ $extra_time->id }})">
                                                                                    <i class="ti-check text-success"></i>
                                                                                    {{ __('task.Accept') }}
                                                                                </button>
                                                                                <button class="dropdown-item"
                                                                                    data-toggle="modal"
                                                                                    data-target="#reject-extratime-modal-{{ $task->id }}"
                                                                                    wire:click="rejectExtraTime({{ $extra_time->id }})">
                                                                                    <i class="ti-close text-danger"></i>
                                                                                    {{ __('task.Reject') }}
                                                                                </button>
                                                                            </div>
                                                                        @endrole
                                                                    </div>
                                                                @else
                                                                    {{ $extra_time->the_status() }}
                                                                @endif
                                                            </div>
                                                        </div>
                                                    </div>

                                                    <div class="col-md-12">
                                                        <div class="row">
                                                            <div class="col-md-6">
                                                                {{ __('task.From') }}:
                                                                <br>
                                                                {{ date('Y-m-d h:i A', strtotime($extra_time->from_time)) }}
                                                            </div>

                                                            <div class="col-md-6">
                                                                {{ __('task.To') }}:
                                                                <br>
                                                                {{ date('Y-m-d h:i A', strtotime($extra_time->to_time)) }}
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>

                                            </div>
                                        @endforeach
                                    </div>
                                </div>
                                {{-- 5 TAB END --}}

                                {{-- 6 TAB START --}}
                                <div class="tab-pane fade {{ $tab == 6 ? 'show active' : '' }}" id="leave"
                                    role="tabpanel" aria-labelledby="leave-tab">
                                    <div class="text-start py-4">
                                        @foreach ($task->leaves_times as $leave)
                                            <div class="row w-100 m-0 border shadow ">

                                                <div class="col-md-6 ">
                                                    <div class="col-md-12">
                                                        <div class="row">
                                                            <div class="col-md-6">
                                                                {{ __('task.Title') }}:
                                                            </div>

                                                            <div class="col-md-6">
                                                                {{ $leave->reason }}
                                                            </div>
                                                        </div>
                                                    </div>

                                                    <div class="col-md-12">
                                                        <div class="row">
                                                            <div class="col-md-6">
                                                                {{ __('task.Employee') }}:
                                                            </div>

                                                            <div class="col-md-6">
                                                                {{ $leave->user->name() }}
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>

                                                <div class="col-md-6">
                                                    <div class="col-md-12 mb-3">
                                                        <div class="row">
                                                            <div class="col-md-6">
                                                                {{ __('task.status') }}:
                                                            </div>

                                                            <div class="col-md-6">
                                                                @if ($leave->status == 'pending')
                                                                    <div class="dropdown">
                                                                        <button
                                                                            class="btn {{ $leave->the_leave_color() }} dropdown-toggle p-1"
                                                                            type="button" id="dropdownMenuButton"
                                                                            data-toggle="dropdown"
                                                                            aria-haspopup="true"
                                                                            aria-expanded="false">
                                                                            {{ $leave->the_status() }}
                                                                        </button>
                                                                        @role('owner|manager')
                                                                            <div class="dropdown-menu"
                                                                                aria-labelledby="dropdownMenuButton">
                                                                                <button class="dropdown-item"
                                                                                    data-toggle="modal"
                                                                                    data-target="#accept-leave-modal-{{ $task->id }}"
                                                                                    wire:click="setLeave({{ $leave->id }})">
                                                                                    <i class="ti-check text-success"></i>
                                                                                    {{ __('task.Accept') }}
                                                                                </button>
                                                                                <button class="dropdown-item"
                                                                                    data-toggle="modal"
                                                                                    data-target="#reject-leave-modal"
                                                                                    wire:click="rejectLeave({{ $leave->id }})">
                                                                                    <i class="ti-close text-danger"></i>
                                                                                    {{ __('task.Reject') }}
                                                                                </button>
                                                                            </div>
                                                                        @endrole
                                                                    </div>
                                                                @else
                                                                    {{ $leave->the_status() }}
                                                                @endif
                                                            </div>
                                                        </div>
                                                    </div>

                                                    <div class="col-md-12">
                                                        <div class="row">
                                                            <div class="col-md-6">
                                                                {{ __('task.From') }}:
                                                                <br>
                                                                {{ date('Y-m-d h:i A', strtotime($leave->time_out)) }}
                                                            </div>

                                                            <div class="col-md-6">
                                                                {{ __('task.To') }}:
                                                                <br>
                                                                {{ date('Y-m-d h:i A', strtotime($leave->time_in)) }}
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>

                                            </div>
                                        @endforeach
                                    </div>
                                </div>
                                {{-- 6 TAB END --}}

                                {{-- 7 TAB START --}}
                                <div class="tab-pane fade {{ $tab == 7 ? 'show active' : '' }}" id="emp_task"
                                    role="tabpanel" aria-labelledby="emp_task-tab">
                                    <div class="text-start py-4">

                                        <div class="mb-5">
                                            <div class="row">

                                                <div class="input-group mb-1 col-9">
                                                    <div class="input-group-prepend ">
                                                        <span class="input-group-text btn-secondary text-white"
                                                            id="inputGroup-sizing-default">{{ __('task.Title') }}</span>
                                                    </div>

                                                    <input wire:model.defer="sub_task_title" type="text"
                                                        class="form-control" aria-label="Default"
                                                        aria-describedby="inputGroup-sizing-default">
                                                </div>

                                                <div class="form-group mb-1 col-3">
                                                    <select wire:model.defer="sub_task_priority_level"
                                                        class="form-control">
                                                        <option value="low">{{ __('task.low') }}</option>
                                                        <option value="medium">{{ __('task.medium') }}</option>
                                                        <option value="high">{{ __('task.high') }}</option>
                                                    </select>
                                                </div>

                                                <div class="col-12 mb-3">
                                                    <p>{{ __('task.employees') }}</p>
                                                    <div class="row">
                                                        @foreach ($task->employees as $sub_employee)
                                                            <div class="col-4">
                                                                <div class="form-check form-check-inline">
                                                                    <input wire:model='selected_employe_task'
                                                                        class="form-check-input" type="checkbox"
                                                                        value="{{ $sub_employee->id }}"
                                                                        id="selected-sub_employee-{{ $sub_employee->id }}">
                                                                    <label class="form-check-label"
                                                                        for="selected-sub_employee-{{ $sub_employee->id }}">
                                                                        {{ $sub_employee->name() }}
                                                                    </label>
                                                                </div>
                                                            </div>
                                                        @endforeach
                                                    </div>
                                                </div>

                                                <div class="input-group mb-1  col-md-6">
                                                    <div class="input-group-prepend ">
                                                        <span class="input-group-text btn-secondary text-white"
                                                            id="inputGroup-sizing-default">{{ __('task.start_time') }}</span>
                                                    </div>
                                                    <input wire:model.defer="sub_task_start_time"
                                                        type="datetime-local" class="form-control"
                                                        aria-label="Default"
                                                        aria-describedby="inputGroup-sizing-default">
                                                </div>

                                                <div class="input-group mb-1  col-md-6">
                                                    <div class="input-group-prepend ">
                                                        <span class="input-group-text btn-secondary text-white"
                                                            id="inputGroup-sizing-default">{{ __('task.end_time') }}</span>
                                                    </div>
                                                    <input wire:model.defer="sub_task_end_time" type="datetime-local"
                                                        class="form-control" aria-label="Default"
                                                        aria-describedby="inputGroup-sizing-default">
                                                </div>


                                                <div wire:ignore.self class="col-md-12">
                                                    {{-- <div wire:ignore.self id="summer_desc"></div> --}}
                                                    <textarea name='desc' id='desc' rows="4" class='form-control'
                                                        placeholder='{{ __(' global.enter') }} {{ __('task.desc') }}' wire:model.defer="sub_task_desc"></textarea>
                                                </div>

                                            </div>

                                            <div class="form-group">
                                                @foreach ($errors->all() as $error)
                                                    <span class='alert alert-danger btn'>{{ $error }}</span>
                                                @endforeach
                                            </div>

                                            <button wire:click="employeeCreatTask()" type="button"
                                                class="w-100 btn btn-success">
                                                {{ __('task.Add_Emp_Sub_Task') }}
                                            </button>
                                        </div>


                                        <table class="table table-striped">
                                            <thead>
                                                <tr>
                                                    <th scope="col">{{__('task.from')}}</th>
                                                    <th scope="col">{{__('task.to')}}</th>
                                                    <th scope="col">{{__('task.title')}}</th>
                                                    <th scope="col">{{__('task.start')}}</th>
                                                    <th scope="col">{{__('task.end')}}</th>
                                                    <th scope="col">{{__('task.view')}}</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @foreach ($task->emp_sub_tasks as $empTask)
                                                    <tr>
                                                        <td>{{ $empTask->manager->crud_name() }}</td>

                                                        <td>
                                                            @foreach ($empTask->employees as $empTo)
                                                                {{ $empTo->name() }}
                                                            @endforeach
                                                        </td>
                                                        <td>
                                                            {{ $empTask->title }}
                                                        </td>
                                                        <td>
                                                            {{ $empTask->start_time }}
                                                        </td>
                                                        <td>
                                                            {{ $empTask->end_time }}
                                                        </td>
                                                        <td>
                                                            <a href="{{ route('task.show', $empTask->id) }}"
                                                                class="btn btn-warning ti ti-eye"></a>
                                                        </td>
                                                    </tr>
                                                @endforeach

                                            </tbody>
                                        </table>


                                    </div>
                                </div>
                                {{-- 7 TAB END --}}
                            </div>
                        </div>
                    </div>

                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary"
                            data-dismiss="modal">{{ __('task.Close') }}</button>
                    </div>
                </div>
            </div>
        </div>
        {{-- --}}{{-- --}}{{-- --}}{{-- --}}

        <div wire:ignore.self id="request-leave-modal-{{ $task->id }}" class="modal fade" tabindex="-1"
            role="dialog" aria-labelledby="request-leave-modal-{{ $task->id }}-title" aria-hidden="true"
            data-backdrop="static" data-keyboard="false">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="request-leave-modal-{{ $task->id }}-title">
                            {{ __('task.Request_Leave') }}
                        </h5>
                        <button class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        {{-- --}}
                        <div class="row">
                            <div class="col-lg-4 col-md-4 col-sm-12">
                                <div class="form-group">
                                    <label for="type">{{ __('leave.type') }}</label>
                                    <select wire:model="leave_type" name="type" id="type"
                                        class="form-control">
                                        <option value="leave">{{ __('leave.leave') }}</option>
                                        <option value="part_of_task">{{ __('leave.part_of_task') }}</option>
                                    </select>
                                </div>
                            </div>

                            @include('inputs.create.input', [
                                'label' => 'leave.time_out',
                                'name' => 'leave.time_out',
                                'livewire' => 'leave_time_out',
                                'type' => 'datetime-local', // 'step' => 1,
                                // 'required' => 'required',
                                'lg' => 4,
                                'md' => 4,
                                'sm' => 6,
                            ])

                            @include('inputs.create.input', [
                                'label' => 'leave.time_in',
                                'name' => 'leave.time_in',
                                'livewire' => 'leave_time_in',
                                'type' => 'datetime-local', // 'step' => 1,
                                // 'required' => 'required',
                                'lg' => 4,
                                'md' => 4,
                                'sm' => 6,
                            ])

                            <div class="col-12">
                                <textarea name='reason' id='reason' rows="3" class='form-control'
                                    placeholder='{{ __('global.enter') }} {{ __('leave.reason') }}' wire:model.defer="leave_reason"></textarea>
                            </div>
                        </div>
                        {{-- --}}
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary close-btn"
                            data-dismiss="modal">{{ __('global.close') }}</button>
                        <button type="button" wire:click.prevent="addLeaveRequest()" class="btn btn-success">
                            {{ __('task.request') }}
                        </button>
                    </div>
                </div>
            </div>
        </div>



        <div wire:ignore.self id="extra-time-modal-{{ $task->id }}" class="modal fade" tabindex="-1"
            role="dialog" aria-labelledby="extra-time-modal-{{ $task->id }}-title" aria-hidden="true"
            data-backdrop="static" data-keyboard="false">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="extra-time-modal-{{ $task->id }}-title">
                            {{ __('task.Request_Leave') }}</h5>
                        <button class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        {{-- --}}
                        {{-- --}}{{-- --}}{{-- --}}


                        <div class="row">
                            @include('inputs.create.input', [
                                'label' => 'extratime.from_time',
                                'name' => 'extratime.from_time',
                                'livewire' => 'extratime_from_time',
                                'type' => 'datetime-local', // 'step' => 1,
                                // 'required' => 'required',
                                // 'lg' => 6, 'md' => 6, 'sm' => 12,
                            ])

                            @include('inputs.create.input', [
                                'label' => 'extratime.to_time',
                                'name' => 'extratime.to_time',
                                'livewire' => 'extratime_to_time',
                                'type' => 'datetime-local', // 'step' => 1,
                                // 'required' => 'required',
                                // 'lg' => 6, 'md' => 6, 'sm' => 12,
                            ])

                            <div class="col-12">
                                <textarea name='reason' id='reason' rows="3" class='form-control'
                                    placeholder='{{ __('global.enter') }} {{ __('extratime.reason') }}' wire:model.defer="extratime_reason"></textarea>
                            </div>

                        </div>
                        {{-- --}}{{-- --}}{{-- --}}
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary close-btn"
                            data-dismiss="modal">{{ __('global.close') }}</button>
                        <button type="button" wire:click.prevent="addExtraTime()" class="btn btn-success">
                            {{ __('task.Request') }}
                        </button>
                    </div>
                </div>
            </div>
        </div>

        @role('owner|manager')
            {{--  --}}{{--  --}}{{--  --}}

            <div wire:ignore.self data-backdrop="static" data-keyboard="true" class="modal fade"
                id="update-task-{{ $task->id }}" tabindex="-1" role="dialog"
                aria-labelledby="update-task-{{ $task->id }}-label" aria-hidden="true" data-backdrop="static"
                data-keyboard="false">
                <div class="modal-dialog modal-lg text-start" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="update-task-{{ $task->id }}-label">
                                {{ $task->crud_name() }}</h5>
                            <button wire:click.prevent="cancelTask()" type="button" class="close" data-dismiss="modal"
                                aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>

                        @if ($updateMode)
                            <form enctype="multipart/form-data" method="post" accept-charset="utf-8"
                                class="form-horizontal">
                                <div class="modal-body">
                                    <input type="hidden" wire:model="task_id">
                                    @csrf

                                    <div class="row">
                                        @include('inputs.edit.input', [
                                            'label' => 'task.title',
                                            'name' => 'task.title',
                                            'val' => $task->title,
                                            'livewire' => 'edit_task_title',
                                            'type' => 'text', // 'step' => 1,
                                            // 'required' => 'required',
                                            'lg' => 9,
                                            'md' => 9,
                                            'sm' => 9,
                                        ])

                                        @include('inputs.edit.input', [
                                            'label' => 'task.discount',
                                            'name' => 'task.discount',
                                            'val' => $task->discount(),
                                            'livewire' => 'edit_task_discount',
                                            'type' => 'number',
                                            'step' => 1,
                                            // 'required' => 'required',
                                            'lg' => 3,
                                            'md' => 3,
                                            'sm' => 3,
                                        ])

                                        @include('inputs.edit.input', [
                                            'label' => 'task.desc',
                                            'name' => 'task.desc',
                                            'val' => $task->desc,
                                            'livewire' => 'edit_task_desc',
                                            'type' => 'text', // 'step' => 1,
                                            // 'required' => 'required',
                                            'lg' => 12,
                                            'md' => 12,
                                            'sm' => 12,
                                        ])

                                        @include('inputs.edit.input', [
                                            'label' => 'task.start_time',
                                            'name' => 'task.start_time',
                                            'val' => $task->start_time,
                                            'livewire' => 'edit_task_start_time',
                                            'type' => 'datetime-local', // 'step' => 1,
                                            // 'required' => 'required',
                                            // 'lg' => 6, 'md' => 6, 'sm' => 12,
                                        ])

                                        @include('inputs.edit.input', [
                                            'label' => 'task.end_time',
                                            'name' => 'task.end_time',
                                            'val' => $task->end_time,
                                            'livewire' => 'edit_task_end_time',
                                            'type' => 'datetime-local', // 'step' => 1,
                                            // 'required' => 'required',
                                            // 'lg' => 6, 'md' => 6, 'sm' => 12,
                                        ])

                                        <div class="col-lg-6 col-md-6 col-sm-12">
                                            <div class="form-group">
                                                <label for="priority_level">{{ __('task.priority_level') }}</label>
                                                <select wire:model="edit_task_priority_level" name="priority_level"
                                                    id="priority_level" class="form-control">
                                                    <option value="low">{{ __('task.low') }}</option>
                                                    <option value="medium">{{ __('task.medium') }}</option>
                                                    <option value="high">{{ __('task.high') }}</option>
                                                </select>
                                            </div>
                                        </div>

                                        <div class="col-lg-6 col-md-6 col-sm-12">
                                            <div class="form-group">
                                                <label for="status">{{ __('task.status') }}</label>
                                                <select wire:model="edit_task_status" name="status" id="status"
                                                    class="form-control">
                                                    <option value="pending">{{ __('task.pending') }}</option>
                                                    <option value="active">{{ __('task.active') }}</option>
                                                    <option value="auto-finished">{{ __('task.auto-finished') }}</option>
                                                    <option value="manual-finished">{{ __('task.manual-finished') }}
                                                    </option>
                                                </select>
                                            </div>
                                        </div>
                                    </div>

                                    @role('owner')
                                        <div>
                                            <p>{{ __('global.employees') }}</p>
                                            <div class="row">
                                                @foreach ($employees as $employee)
                                                    <div class="col-4">
                                                        <div class="form-check form-check-inline">
                                                            <input wire:model='edit_task_selectedEmployees'
                                                                class="form-check-input" type="checkbox"
                                                                value="{{ $employee->id }}"
                                                                id="selected-employee-{{ $employee->id }}">
                                                            <label class="form-check-label"
                                                                for="selected-employee-{{ $employee->id }}">
                                                                {{ $employee->name() }}
                                                            </label>
                                                        </div>
                                                    </div>
                                                @endforeach
                                            </div>
                                        </div>
                                    @endrole

                                </div>

                                <div class="form-group">

                                    @foreach ($errors->all() as $error)
                                        <span class='alert alert-danger btn'>{{ $error }}</span>
                                    @endforeach

                                </div>

                                <div class="modal-footer">
                                    <button type="button" wire:click.prevent="cancelTask()"
                                        class="btn btn-secondary close-btn"
                                        data-dismiss="modal">{{ __('global.close') }}</button>
                                    <button type="button" wire:click.prevent="updateTask()" class="btn btn-success">
                                        {{ __('global.save-changes') }}
                                    </button>
                                </div>
                            </form>
                        @endif

                    </div>
                </div>
            </div>

            {{--  --}}{{--  --}}{{--  --}}

            <div wire:ignore.self class="modal fade" id="accept-extratime-modal-{{ $task->id }}"
                data-backdrop="static" data-keyboard="false" tabindex="-1" role="dialog"
                aria-labelledby="accept-extratime-modal-{{ $task->id }}-label" aria-hidden="true"
                data-backdrop="static" data-keyboard="false">
                <div class="modal-dialog modal-lg" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="accept-extratime-modal-{{ $task->id }}-label">
                                {{ __('global.accept-extratime') }}
                            </h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>

                        @if ($show_extratime)
                            <form enctype="multipart/form-data" method="post" accept-charset="utf-8"
                                class="form-horizontal">
                                <div class="modal-body">
                                    @csrf

                                    <div class="row">

                                        @include('inputs.show.input', [
                                            'label' => 'extratime.task',
                                            'val' => $extratime->task->crud_name(),
                                        ])

                                        @include('inputs.show.input', [
                                            'label' => 'extratime.user',
                                            'val' => $extratime->user->name(),
                                        ])

                                        @include('inputs.show.input', [
                                            'label' => 'extratime.reason',
                                            'val' => $extratime_reason,
                                            'lg' => 8,
                                            'md' => 8,
                                            'sm' => 8,
                                        ])

                                        @include('inputs.show.input', [
                                            'label' => 'extratime.request_time',
                                            'val' => $extratime->request_time,
                                            // 'type' => 'datetime-local', // 'step' => 1,
                                            // 'required' => 'required',
                                            'lg' => 4,
                                            'md' => 4,
                                            'sm' => 4,
                                        ])

                                        @include('inputs.create.input', [
                                            'label' => 'extratime.from_time',
                                            'name' => 'extratime.from_time',
                                            'livewire' => 'extratime_from_time',
                                            'type' => 'datetime-local', // 'step' => 1,
                                            // 'required' => 'required',
                                            // 'lg' => 6, 'md' => 6, 'sm' => 12,
                                        ])

                                        @include('inputs.create.input', [
                                            'label' => 'extratime.to_time',
                                            'name' => 'extratime.to_time',
                                            'livewire' => 'extratime_to_time',
                                            'type' => 'datetime-local', // 'step' => 1,
                                            // 'required' => 'required',
                                            // 'lg' => 6, 'md' => 6, 'sm' => 12,
                                        ])

                                        @include('inputs.show.input', [
                                            'label' => 'extratime.duration',
                                            'val' => $extratime_duration,
                                            'lg' => 12,
                                            'md' => 12,
                                            'sm' => 12,
                                        ])

                                    </div>

                                </div>

                                <div class="form-group">
                                    @foreach ($errors->all() as $error)
                                        <span class='alert alert-danger btn'>{{ $error }}</span>
                                    @endforeach
                                </div>

                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary close-btn" data-dismiss="modal">
                                        {{ __('global.close') }}
                                    </button>
                                    <button type="submit" wire:click.prevent="acceptExtraTime()"
                                        class="btn btn-success">
                                        {{ __('global.save-changes') }}
                                    </button>
                                </div>
                            </form>
                        @endif

                    </div>
                </div>
            </div>
            {{--  --}}
            <div wire:ignore.self class="modal fade" id="accept-leave-modal-{{ $task->id }}" data-backdrop="static"
                data-keyboard="false" tabindex="-1" role="dialog"
                aria-labelledby="accept-leave-modal-{{ $task->id }}-label" aria-hidden="true"
                data-backdrop="static" data-keyboard="false">
                <div class="modal-dialog modal-lg" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="accept-leave-modal-{{ $task->id }}-label">
                                {{ __('global.accept-leave') }}
                            </h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>

                        @if ($show_leave)
                            <form enctype="multipart/form-data" method="post" accept-charset="utf-8"
                                class="form-horizontal">
                                <div class="modal-body">
                                    @csrf

                                    <div class="row">
                                        @include('inputs.show.input', [
                                            'label' => 'leave.task',
                                            'val' => $leave->task->crud_name(),
                                            'lg' => 4,
                                            'md' => 4,
                                            'sm' => 12,
                                        ])

                                        @include('inputs.show.input', [
                                            'label' => 'leave.user',
                                            'val' => $leave->user->name(),
                                            'lg' => 4,
                                            'md' => 4,
                                            'sm' => 12,
                                        ])

                                        <div class="col-lg-4 col-md-4 col-sm-12">
                                            <div class="form-group">
                                                <label for="type">{{ __('leave.type') }}</label>
                                                <select wire:model="leave_type" name="type" id="type"
                                                    class="form-control">
                                                    <option value="leave">{{ __('leave.leave') }}</option>
                                                    <option value="part_of_task">{{ __('leave.part_of_task') }}</option>
                                                </select>
                                            </div>
                                        </div>

                                        @include('inputs.edit.input', [
                                            'label' => 'leave.time_out',
                                            'name' => 'leave.time_out',
                                            'val' => $leave->time_out,
                                            'livewire' => 'leave_time_out',
                                            'type' => 'datetime-local', // 'step' => 1,
                                            // 'required' => 'required',
                                            'lg' => 4,
                                            'md' => 4,
                                            'sm' => 12,
                                        ])

                                        @include('inputs.edit.input', [
                                            'label' => 'leave.time_in',
                                            'name' => 'leave.time_in',
                                            'val' => $leave->time_in,
                                            'livewire' => 'leave_time_in',
                                            'type' => 'datetime-local', // 'step' => 1,
                                            // 'required' => 'required',
                                            'lg' => 4,
                                            'md' => 5,
                                            'sm' => 12,
                                        ])

                                        <div class="col-lg-4 col-md-4 col-sm-12">
                                            <div class="form-group">
                                                <label for="effect_on_time">{{ __('leave.effect_on_time') }}</label>
                                                <select wire:model="leave_effect_on_time" name="effect_on_time"
                                                    id="effect_on_time" class="form-control">
                                                    <option value="1">{{ __('global.yes') }}</option>
                                                    <option value="0">{{ __('global.no') }}</option>
                                                </select>
                                            </div>
                                        </div>

                                        @include('inputs.show.input', [
                                            'label' => 'leave.reason',
                                            'val' => $leave->reason,
                                            'lg' => 12,
                                            'md' => 12,
                                            'sm' => 12,
                                        ])
                                    </div>
                                </div>

                                <div class="form-group">
                                    @foreach ($errors->all() as $error)
                                        <span class='alert alert-danger btn'>{{ $error }}</span>
                                    @endforeach
                                </div>

                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary close-btn" data-dismiss="modal">
                                        {{ __('global.close') }}
                                    </button>

                                    <button type="submit" wire:click.prevent="acceptLeave()" class="btn btn-success">
                                        {{ __('global.save-changes') }}
                                    </button>
                                </div>
                            </form>
                        @endif

                    </div>
                </div>
            </div>
        @endrole

        {{-- @push('scripts')
            <script>
                $(document).ready(function() {
                    $('.timer-outputpattern-{{ $task->id }}').countdown({
                        outputPattern: '$day Day $hour Hour $minute Minutes $second Seconds',
                        from: {{ $task->remaining_time }},
                        timerEnd: undefined,
                    });
                });
            </script>
        @endpush --}}

        {{--  --}}
    @endforeach
</div>
