<div>
    @foreach ($tasks as $task)
        <div class="card p-0 text-start" wire:key='{{ $task->id }}'>
            <div class="card-body p-0">
                <div class="row w-100 m-0">
                    <div class="col-md-8 col-7 p-0 ">
                        <div class="col-md-12 pt-4">
                            <h4 class="px-4 text-bold">
                                {{ $task->title }}
                                <span id="timer-outputpattern" class="h3 text-info"></span>
                            </h4>
                        </div>
                        <div class="col-md-12">
                            <h6 class="text-gray px-4">
                                {{ $task->manager->name() }}
                            </h6>
                        </div>
                    </div>

                    <div class="col-md-4 col-5 d-flex align-items-center p-0">
                        <div class="row w-100 m-0 justify-content-md-around">
                            <div class="col-md-3 col-4 d-flex justify-content-center fs-4 dropdown show">
                                <a class="fa fa-cog text-secondarye" href="javascript:;" role="button"
                                    id="dropdownMenuLink" data-toggle="dropdown" aria-haspopup="true"
                                    aria-expanded="false">
                                </a>

                                <div class="dropdown-menu" aria-labelledby="dropdownMenuLink">
                                    @if ($task->status == 'pending')
                                        <a class="dropdown-item" href="javascript:;"
                                            wire:click="startWithTask({{ $task->id }})">
                                            <i class="fa fa-hourglass-end text-info" aria-hidden="true"></i>
                                            &nbsp; Start
                                        </a>
                                    @endif

                                    @if ($task->status == 'active')
                                        <a class="dropdown-item" href="javascript:;"
                                            wire:click="finishWithTask({{ $task->id }})">
                                            <i class="fa fa-check-square text-success" aria-hidden="true"></i>
                                            &nbsp; Finsh
                                        </a>
                                    @endif

                                    @role('owner|manager')
                                        @if (in_array($task->status, ['auto-finished', 'manual-finished']))
                                            <a class="dropdown-item" href="javascript:;"
                                                wire:click="draftTask({{ $task->id }})">
                                                <i class="fa fa-check-square text-success" aria-hidden="true"></i>
                                                &nbsp; Draft
                                            </a>
                                        @endif

                                        <a class="dropdown-item" href="javascript:;" data-toggle="modal"
                                            data-target="#update">
                                            <i class="fa fa-pencil-square-o text-secondarye" aria-hidden="true"></i>
                                            &nbsp; Edit
                                        </a>

                                        <a class="dropdown-item" href="javascript:;"
                                            wire:click='deleteTask({{ $task->id }})'>
                                            <i class="fa fa-trash-o text-danger" aria-hidden="true"></i>
                                            &nbsp; Delete
                                        </a>
                                    @endrole


                                    <a class="dropdown-item" href="javascript:;" data-toggle="modal"
                                        data-target="#leave">
                                        <i class="fa fa-sign-out text-info" aria-hidden="true"></i>
                                        &nbsp; Request Leave
                                    </a>

                                    <a class="dropdown-item" data-toggle="modal" data-target="#extraTime"
                                        href=javascript:;>
                                        <i class="fa fa-clock-o text-warning" aria-hidden="true"></i>
                                        &nbsp; Extra Time
                                    </a>
                                </div>
                            </div>

                            <div class="col-md-3 col-4 d-flex justify-content-center fs-4">
                                <button type="button" class="fa fa-exclamation-circle text-azure" data-toggle="modal"
                                    data-target="#show-task-modal-{{ $task->id }}"
                                    wire:click="setTask({{ $task->id }})">
                                </button>
                            </div>

                            <div class="col-md-3 col-4 d-flex justify-content-center fs-4">
                                <i class="fa fa-commenting-o text-danger"></i>
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
                            Employees
                        </h4>

                        <div class="row w-100 m-0 py-3">
                            @foreach ($task->employees as $employee)
                                <div class="col-2" data-container="body" data-toggle="tooltip"
                                    data-popover-color="default" data-placement="top" title="{{ $employee->name() }}">
                                    <img src="{{ asset($employee->image) }}"
                                        style="width: 40px !important; border-radius: 100px;"
                                        alt="{{ $employee->name() }}">
                                </div>
                            @endforeach
                        </div>
                    </div>

                    <div class="col-md-12">
                        <div class="row w-100 m-0 ">
                            <div class="col-md-12 px-4 fs-6 text-gray-400">
                                start at: {{ $task->format_date($task->start_time) }}
                            </div>
                            <div class="col-md-12 px-4 fs-6 text-gray-400">
                                end at: {{ $task->format_date($task->end_time) }}
                            </div>
                            <small class="col-md-12 px-4 text-muted py-3">assigend:
                                {{ date('Y/m/d H:i A', strtotime($task->created_at)) }}
                                ({{ $task->created_ago($task->created_at) }})</small>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        {{--  --}}{{--  --}}{{--  --}}{{--  --}}
        <div wire:ignore.self class="modal fade" id="show-task-modal-{{ $task->id }}" tabindex="-1" role="dialog"
            aria-labelledby="show-task-modal-{{ $task->id }}Label" aria-hidden="true">
            <div class="modal-dialog modal-lg" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="show-task-modal-{{ $task->id }}Label">
                            Task Details
                        </h5>

                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>

                    <div class="modal-body">
                        <div class="row">
                            <div class="col-12">
                                <div>
                                    <strong>Discription:</strong>
                                </div>
                                <div>
                                    <small class="fs-6 text-gray">{!! $task->desc !!}</small>
                                    {{-- {!! $task->desc !!} --}}
                                </div>
                            </div>
                        </div>

                        <div class="col-md-12 pt-5">
                            <ul class="nav nav-tabs" id="myTab" role="tablist">
                                <li class="nav-item px-3 ">
                                    <a class="nav-link py-3 rounded-pill {{ $tab == 1 ? 'active' : '' }}"
                                        id="user-tab" data-toggle="tab" wire:click="changeTab(1)" href="#user"
                                        role="tab" aria-controls="user"
                                        aria-selected="{{ $tab == 1 }}">Users</a>
                                </li>
                                <li class="nav-item px-3 ">
                                    <a class="nav-link py-3 rounded-pill {{ $tab == 2 ? 'active' : '' }}"
                                        id="attatchment-tab" data-toggle="tab" wire:click="changeTab(2)"
                                        href="#attatchment" role="tab" aria-controls="attatchment"
                                        aria-selected="{{ $tab == 2 }}">Attatchments</a>
                                </li>
                                <li class="nav-item px-3 ">
                                    <a class="nav-link py-3 rounded-pill {{ $tab == 3 ? 'active' : '' }}"
                                        id="comment-tab" data-toggle="tab" wire:click="changeTab(3)" href="#comment"
                                        role="tab" aria-controls="comment"
                                        aria-selected="{{ $tab == 3 }}">Comments</a>
                                </li>

                                <li class="nav-item px-3 ">
                                    <a class="nav-link py-3 rounded-pill {{ $tab == 4 ? 'active' : '' }}"
                                        id="subTask-tab" data-toggle="tab" wire:click="changeTab(4)" href="#subTask"
                                        role="tab" aria-controls="subTask"
                                        aria-selected="{{ $tab == 4 }}">Sub Tasks</a>
                                </li>
                            </ul>

                            <div class="tab-content pt-2" id="myTabContent">
                                <div class="tab-pane fade {{ $tab == 1 ? 'show active' : '' }}" id="user"
                                    role="tabpanel" aria-labelledby="user-tab">

                                    <div class="table-responsive">
                                        <table class="table">
                                            <thead>
                                                <tr>
                                                    <th scope="col-8">Users</th>
                                                    <th scope="col">Role</th>
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

                                <div class="tab-pane fade {{ $tab == 2 ? 'show active' : '' }}" id="attatchment"
                                    role="tabpanel" aria-labelledby="attatchment-tab">
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
                                        </div>
                                    </div>

                                    <div wire:ignore.self class="mb-1">
                                        {{-- <div wire:ignore.self id="summer_desc"></div> --}}
                                        <textarea name='desc' id='desc' rows="3" class='form-control'
                                            placeholder='{{ __('global.enter') }} {{ __('attachment.desc') }}' wire:model.defer="attatchment_desc"></textarea>
                                    </div>




                                    <button wire:click="addAttatchment()" type="button" class="btn btn-success">
                                        Upload
                                    </button>


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
                                                <div class="col-md-3 d-flex justify-content-center align-items-center">

                                                    <a class="btn btn-success" href="{{ asset($attatch->file) }}"
                                                        download>
                                                        <i class="fa fa-download text-white"></i>
                                                    </a>
                                                    <a class="btn btn-danger"
                                                        wire:click='deleteAttatchment({{ $attatch->id }})'>
                                                        <i class="fa fa-trash text-white"></i>
                                                    </a>
                                                </div>
                                            </div>
                                        @endforeach
                                    </div>

                                    {{-- <input wire:ignore.self wire:model="attatchment_file" type="file"
                                            class="dropify" data-height="150" /> --}}
                                </div>

                                <div class="tab-pane fade {{ $tab == 3 ? 'show active' : '' }}" id="comment"
                                    role="tabpanel" aria-labelledby="comment-tab">

                                    <div class="input-group mb-1">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text btn-secondary text-white"
                                                id="inputGroup-sizing-default">{{ __('attachment.title') }}</span>
                                        </div>
                                        <input wire:model.defer="comment_title" type="text" class="form-control"
                                            aria-label="Default" aria-describedby="inputGroup-sizing-default">
                                    </div>

                                    <div wire:ignore.self class="mb-1">
                                        {{-- <div wire:ignore.self id="summer_desc"></div> --}}
                                        <textarea name='desc' id='desc' rows="3" class='form-control'
                                            placeholder='{{ __('global.enter') }} {{ __('attachment.desc') }}' wire:model.defer="comment_desc"></textarea>
                                    </div>

                                    <button wire:click="addComment()" type="button" class="btn btn-success">
                                        Commet
                                    </button>

                                    <div class="container py-3">
                                        @foreach ($task->comments as $comment)
                                            <div class="media">
                                                <img class="mr-3" src="{{ asset('assets/images/users/10.jpg') }}"
                                                    alt="Generic placeholder image">
                                                <div class="media-body">
                                                    <h5 class="mt-0">{{ $comment->user->name() }}</h5>
                                                    {{ $comment->desc }}


                                                    <div class="col-12 d-flex justify-content-end">

                                                        <a class="btn btn-primary-gradient" data-toggle="modal"
                                                            wire:click="setCommentId({{ $comment->id }})"
                                                            data-target="#replay">
                                                            <i class="fa fa-comment text-white"></i>
                                                        </a>
                                                        &nbsp;
                                                        <a class="btn btn-danger"
                                                            wire:click='deleteComents({{ $comment->id }})'>
                                                            <i class="fa fa-trash text-white"></i>
                                                        </a>
                                                    </div>




                                                    @foreach ($comment->subs as $subCom)
                                                        <div class="media mt-3">
                                                            <a class="pr-3" href="#">
                                                                <img src="{{ asset('assets/images/users/10.jpg') }}"
                                                                    alt="Generic placeholder image">
                                                            </a>
                                                            <div class="media-body">
                                                                <h5 class="mt-0">{{ $subCom->user->name() }}</h5>
                                                                {{ $subCom->desc }}
                                                            </div>
                                                        </div>
                                                    @endforeach
                                                </div>
                                            </div>




                                            <div class="modal fade" id="replay" tabindex="-1" role="dialog"
                                                aria-labelledby="exampleModalLabel" aria-hidden="true">
                                                <div class="modal-dialog modal-lg" role="document">
                                                    <div class="modal-content">
                                                        <div class="modal-header">
                                                            <h5 class="modal-title" id="exampleModalLabel">Modal
                                                                replay
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
                                                                    placeholder='{{ __('global.enter') }} {{ __('attachment.desc') }}' wire:model.defer="replay_comment_desc"></textarea>
                                                            </div>

                                                            <button wire:click="replayComment()" type="button"
                                                                class="btn btn-success">
                                                                Commet
                                                            </button>
                                                        </div>
                                                        <div class="modal-footer">
                                                            <button type="button" class="btn btn-secondary"
                                                                data-dismiss="modal">Close</button>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        @endforeach
                                    </div>


                                </div>

                                <div class="tab-pane fade {{ $tab == 4 ? 'show active' : '' }}" id="subTask"
                                    role="tabpanel" aria-labelledby="subTask-tab">
                                    {{--  --}}{{--  --}}{{--  --}}{{--  --}}
                                    <div class="row">

                                        <div class="input-group mb-3 col-8">
                                            <div class="input-group-prepend ">
                                                <span class="input-group-text btn-secondary text-white"
                                                    id="inputGroup-sizing-default">{{ __('task.title') }}</span>
                                            </div>

                                            <input wire:model.defer="sub_task_title" type="text"
                                                class="form-control" aria-label="Default"
                                                aria-describedby="inputGroup-sizing-default">
                                        </div>

                                        <div class="form-group mb-3 col-4">
                                            <select wire:model.defer="sub_task_priority_level" class="form-control">
                                                <option value="low">low</option>
                                                <option value="medum">medum</option>
                                                <option value="high">high</option>
                                            </select>
                                        </div>

                                        {{-- <div class="input-group mb-3 col-md-8">
                                            <div class="input-group-prepend ">
                                                <span class="input-group-text btn-secondary text-white"
                                                    id="inputGroup-sizing-default">{{ __('task.title') }}</span>
                                            </div>
                                            <input wire:model.defer="sub_task_title" type="text" multiple
                                                class="form-control" aria-label="Default"
                                                aria-describedby="inputGroup-sizing-default">
                                        </div> --}}

                                        {{-- <div class="input-group mb-3 col-md-4">
                                            <div class="input-group-prepend ">
                                                <span class="input-group-text btn-secondary text-white"
                                                    id="inputGroup-sizing-default">{{ __('task.discount') }}</span>
                                            </div>
                                            <input wire:model.defer="sub_task_discount" type="number"
                                                class="form-control" aria-label="Default"
                                                aria-describedby="inputGroup-sizing-default">
                                        </div> --}}

                                        <div class="input-group mb-3  col-md-6">
                                            <div class="input-group-prepend ">
                                                <span class="input-group-text btn-secondary text-white"
                                                    id="inputGroup-sizing-default">{{ __('task.start_time') }}</span>
                                            </div>
                                            <input wire:model.defer="sub_task_start_time" type="datetime-local"
                                                class="form-control" aria-label="Default"
                                                aria-describedby="inputGroup-sizing-default">
                                        </div>

                                        <div class="input-group mb-3  col-md-6">
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
                                                placeholder='{{ __('global.enter') }} {{ __('task.desc') }}' wire:model.defer="sub_task_desc"></textarea>
                                        </div>

                                    </div>

                                    <div class="form-group">
                                        @foreach ($errors->all() as $error)
                                            <span class='alert alert-danger btn'>{{ $error }}</span>
                                        @endforeach
                                    </div>

                                    <button wire:click="addSubTask()" type="button" class="btn btn-success">
                                        Add Sub Task
                                    </button>
                                    {{--  --}}{{--  --}}{{--  --}}{{--  --}}
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                        {{-- <button type="button" class="btn btn-primary">
                            Save Changes
                        </button> --}}
                    </div>
                </div>
            </div>
        </div>
        {{--  --}}{{--  --}}{{--  --}}{{--  --}}

        {{-- <script>
            $(function() {
                // changed output patterns
                $('#timer-outputpattern').countdown({
                    outputPattern: '$day Days $hour Hours $minute Minutes $second Seconds',
                    from: 60 * 60 * 24 * 3
                });
            });
        </script> --}}
    @endforeach
</div>
