<div>
    {{-- In work, do what you enjoy. --}}

    <div class="card">
        <div class="card-body">
            <div class="row">
                @include('inputs.show.input', [
                    'label' => 'task.manager',
                    'val' => $task->manager->name(),
                    'lg' => 10,
                    'md' => 10,
                    'sm' => 10,
                ])

                @if ($task->reopen_from_task)
                    <div class="col-lg-2 col-md-2 col-sm-2">
                        <label for="draft">{{ __('task.open_history') }}</label>

                        <a href="{{ route('task.show', $task->reopen_from_task) }}" class="btn btn-info w-100">
                            {{ __('task.history') }}
                        </a>
                    </div>
                @endif

                @include('inputs.edit.input', [
                    'label' => 'task.title',
                    'name' => 'task.title',
                    'val' => $task->title,
                    'livewire' => 'title',
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
                    'livewire' => 'discount',
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
                    'livewire' => 'desc',
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
                    'livewire' => 'start_time',
                    'type' => 'datetime-local', // 'step' => 1,
                    // 'required' => 'required',
                    // 'lg' => 6, 'md' => 6, 'sm' => 12,
                ])

                @include('inputs.edit.input', [
                    'label' => 'task.end_time',
                    'name' => 'task.end_time',
                    'val' => $task->end_time,
                    'livewire' => 'end_time',
                    'type' => 'datetime-local', // 'step' => 1,
                    // 'required' => 'required',
                    // 'lg' => 6, 'md' => 6, 'sm' => 12,
                ])

                <div class="col-lg-4 col-md-4 col-sm-10">
                    <div class="form-group">
                        <label for="priority_level">{{ __('task.priority_level') }}</label>
                        <select wire:model="priority_level" name="priority_level" id="priority_level"
                            class="form-control">
                            <option value="urgent">{{ __('task.urgent') }}</option>
                            <option value="high">{{ __('task.high') }}</option>
                            <option value="medium">{{ __('task.medium') }}</option>
                            <option value="low">{{ __('task.low') }}</option>
                        </select>
                    </div>
                </div>

                <div class="col-lg-2 col-md-2 col-sm-2">
                    <label for="draft">{{ __('task.move_draft') }}?</label>

                    <button wire:click="moveDraft()"
                        class="btn {{ $task->slug == 'draft' ? 'btn-info' : 'btn-danger' }} w-100">
                        {{-- {{ $task->slug == 'draft' ? __('task.Return') : __('task.Move') }} --}}
                        @if ($task->slug == 'draft')
                            {{ __('task.Return') }}
                        @else
                            {{ __('task.Move') }}
                        @endif
                    </button>
                </div>

                <div class="col-lg-4 col-md-4 col-sm-10">
                    <div class="form-group">
                        <label for="status">{{ __('task.status') }}</label>
                        <select wire:model="status" name="status" id="status" class="form-control">
                            <option value="pending">{{ __('task.pending') }}</option>
                            <option value="active">{{ __('task.active') }}</option>
                            <option value="auto-finished">{{ __('task.auto-finished') }}</option>
                            <option value="manual-finished">{{ __('task.manual-finished') }}</option>
                            {{-- <option value="draft">{{ __('task.draft') }}</option> --}}
                        </select>
                    </div>
                </div>

                @include('inputs.show.input', [
                    'label' => 'task.in_draft',
                    'val' => $task->slug == 'draft' ? __('global.yes') : __('global.no'),
                    'lg' => 2,
                    'md' => 2,
                    'sm' => 2,
                ])

            </div>

            @role('owner')
                <div>
                    <p>{{ __('global.employees') }}</p>
                    <div class="row">
                        @foreach ($employees as $employee)
                            <div class="col-4">
                                <div class="form-check form-check-inline">
                                    <input wire:model='selectedEmployees' class="form-check-input" type="checkbox"
                                        value="{{ $employee->id }}" id="selected-employee-{{ $employee->id }}">
                                    <label class="form-check-label" for="selected-employee-{{ $employee->id }}">
                                        {{ $employee->name() }}
                                    </label>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
            @endrole

            <div class="form-group">
                @foreach ($errors->all() as $error)
                    <span class='alert alert-danger btn'>{{ $error }}</span>
                @endforeach
            </div>
        </div>

        @if (session()->has('message'))
            <div class="alert alert-success" style="margin-top:30px;">
                {{ session('message') }}
            </div>
        @endif

        <div class="card-footer">
            <button type="button" wire:click.prevent="updateTask()" class="btn btn-success">
                {{ __('global.save-changes') }}
            </button>
        </div>
    </div>
    {{--  --}}

    {{-- <div class="card-footer">
        Footer
    </div> --}}

    <div class="card">
        <div class="card-header">
            <ul class="nav nav-tabs" id="myTab" role="tablist">
                {{-- 1 TAB START --}}
                <li class="nav-item px-1">
                    <a class="nav-link py-3 rounded-pill {{ $tab == 1 ? 'active' : '' }}" id="user-tab"
                        data-toggle="tab" wire:click="changeTab(1)" href="#user" role="tab" aria-controls="user"
                        aria-selected="{{ $tab == 1 }}">{{ __('task.employees') }}</a>
                </li>
                {{-- 1 TAB END --}}

                {{-- 2 TAB START --}}
                <li class="nav-item px-1">
                    <a class="nav-link py-3 rounded-pill {{ $tab == 2 ? 'active' : '' }}" id="attatchment-tab"
                        data-toggle="tab" wire:click="changeTab(2)" href="#attatchment" role="tab"
                        aria-controls="attatchment"
                        aria-selected="{{ $tab == 2 }}">{{ __('task.Attachments') }}</a>
                </li>
                {{-- 2 TAB END --}}

                {{-- 3 TAB START --}}
                <li class="nav-item px-1">
                    <a class="nav-link py-3 rounded-pill {{ $tab == 3 ? 'active' : '' }}" id="comment-tab"
                        data-toggle="tab" wire:click="changeTab(3)" href="#comment" role="tab"
                        aria-controls="comment" aria-selected="{{ $tab == 3 }}">{{ __('task.Comments') }}</a>
                </li>
                {{-- 3 TAB END --}}

                {{-- 4 TAB START --}}
                <li class="nav-item px-1">
                    <a class="nav-link py-3 rounded-pill {{ $tab == 4 ? 'active' : '' }}" id="subTask-tab"
                        data-toggle="tab" wire:click="changeTab(4)" href="#subTask" role="tab"
                        aria-controls="subTask" aria-selected="{{ $tab == 4 }}">{{ __('task.Sub_Tasks') }}</a>
                </li>
                {{-- 4 TAB END --}}

                {{-- 5 TAB START --}}
                <li class="nav-item px-1">
                    <a class="nav-link py-3 rounded-pill {{ $tab == 5 ? 'active' : '' }}" id="extra-tab"
                        data-toggle="tab" wire:click="changeTab(5)" href="#extra" role="tab" aria-controls="extra"
                        aria-selected="{{ $tab == 5 }}">{{ __('task.Extra_Time') }}</a>
                </li>
                {{-- 5 TAB END --}}

                {{-- 6 TAB START --}}
                <li class="nav-item px-1">
                    <a class="nav-link py-3 rounded-pill {{ $tab == 6 ? 'active' : '' }}" id="leave-tab"
                        data-toggle="tab" wire:click="changeTab(6)" href="#leave" role="tab"
                        aria-controls="leave" aria-selected="{{ $tab == 6 }}">{{ __('task.leave') }}</a>
                </li>
                {{-- 6 TAB END --}}

                @role('owner|manager')
                    {{-- 7 TAB START --}}
                    <li class="nav-item px-1">
                        <a class="nav-link py-3 rounded-pill {{ $tab == 7 ? 'active' : '' }}" id="discount-tab"
                            data-toggle="tab" wire:click="changeTab(7)" href="#discount" role="tab"
                            aria-controls="discount" aria-selected="{{ $tab == 7 }}">{{ __('task.discount') }}</a>
                    </li>
                    {{-- 7 TAB END --}}
                @endrole
            </ul>
        </div>

        <div class="card-body">
            <div class="tab-content pt-2" id="myTabContent">
                {{-- 1 TAB START --}}
                <div class="tab-pane fade {{ $tab == 1 ? 'show active' : '' }}" id="user" role="tabpanel"
                    aria-labelledby="user-tab">

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
                                                        <a href="{{ route('user.show', $employee) }}">
                                                            {{ $employee->name() }}
                                                        </a>

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
                <div class="tab-pane fade {{ $tab == 2 ? 'show active' : '' }}" id="attatchment" role="tabpanel"
                    aria-labelledby="attatchment-tab">

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
                                    placeholder='{{ __('global.enter') }} {{ __('attachment.desc') }}' wire:model.defer="attatchment_desc"></textarea>
                            </div>

                            <button wire:click="addAttatchment()" type="button" class="w-100 btn btn-success">
                                {{ __('task.Upload') }}
                            </button>

                        </div>

                        <div class="container py-3">
                            @foreach ($task->attachments as $attatch)
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

                                        <a class="btn btn-success" href="{{ asset($attatch->file) }}" download>
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
                    {{-- <input wire:ignore.self wire:model="attatchment_file" type="file" class="dropify" data-height="150" /> --}}
                </div>
                {{-- 2 TAB END --}}

                {{-- 3 TAB START --}}
                <div class="tab-pane fade {{ $tab == 3 ? 'show active' : '' }}" id="comment" role="tabpanel"
                    aria-labelledby="comment-tab">

                    <div class="text-start">
                        <div>
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

                            <button wire:click="addComment()" type="button" class="w-100 btn btn-success">
                                {{ __('task.Comment') }}
                            </button>
                        </div>

                        <div class="container py-3">
                            @foreach ($task->comments as $comment)
                                <div class="media">
                                    <img class="mr-3" src="{{ asset('assets/images/users/10.jpg') }}"
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

                                <div wire:ignore.self class="modal fade" id="replay-modal-{{ $task->id }}"
                                    tabindex="-1" role="dialog"
                                    aria-labelledby="replay-modal-{{ $task->id }}-Label" aria-hidden="true"
                                    data-backdrop="static" data-keyboard="false">
                                    <div class="modal-dialog modal-lg" role="document">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title" id="replay-modal-{{ $task->id }}-Label">
                                                    {{ __('task.Replay') }}
                                                </h5>
                                                <button type="button" class="close" data-dismiss="modal"
                                                    aria-label="Close">
                                                    <span aria-hidden="true">&times;</span>
                                                </button>
                                            </div>
                                            <div class="modal-body">
                                                <div class="input-group mb-1">
                                                    <div class="input-group-prepend">
                                                        <span class="input-group-text btn-secondary text-white"
                                                            id="inputGroup-sizing-default">{{ __('attachment.title') }}</span>
                                                    </div>
                                                    <input wire:model.defer="replay_comment_title" type="text"
                                                        class="form-control" aria-label="Default"
                                                        aria-describedby="inputGroup-sizing-default">
                                                </div>

                                                <div wire:ignore.self class="mb-1">
                                                    {{-- <div wire:ignore.self id="summer_desc"></div> --}}
                                                    <textarea name='desc' id='desc' rows="3" class='form-control'
                                                        placeholder='{{ __('global.enter') }} {{ __('attachment.desc') }}' wire:model.defer="replay_comment_desc"></textarea>
                                                </div>


                                            </div>
                                            <div class="modal-footer">
                                                <button type="button" class="btn btn-secondary"
                                                    data-dismiss="modal">{{ __('task.Close') }}</button>

                                                <button wire:click="replayComment()" type="button"
                                                    class="btn btn-success">
                                                    {{ __('task.Comment') }}
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
                <div class="tab-pane fade {{ $tab == 4 ? 'show active' : '' }}" id="subTask" role="tabpanel"
                    aria-labelledby="subTask-tab">
                    <div class="text-start">
                        @role('owner|manager')
                            <div>
                                <div class="row">

                                    <div class="input-group mb-1 col-8">
                                        <div class="input-group-prepend ">
                                            <span class="input-group-text btn-secondary text-white"
                                                id="inputGroup-sizing-default">{{ __('task.Title') }}</span>
                                        </div>

                                        <input wire:model.defer="sub_task_title" type="text" class="form-control"
                                            aria-label="Default" aria-describedby="inputGroup-sizing-default">
                                    </div>

                                    <div class="form-group mb-1 col-4">
                                        <select wire:model.defer="sub_task_priority_level" class="form-control">
                                            <option value="urgent">{{ __('task.urgent') }}</option>
                                            <option value="high">{{ __('task.high') }}</option>
                                            <option value="medium">{{ __('task.medium') }}</option>
                                            <option value="low">{{ __('task.low') }}</option>
                                        </select>
                                    </div>

                                    <div class="input-group mb-1  col-md-6">
                                        <div class="input-group-prepend ">
                                            <span class="input-group-text btn-secondary text-white"
                                                id="inputGroup-sizing-default">{{ __('task.start_time') }}</span>
                                        </div>
                                        <input wire:model.defer="sub_task_start_time" type="datetime-local"
                                            class="form-control" aria-label="Default"
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
                                            placeholder='{{ __('global.enter') }} {{ __('task.desc') }}' wire:model.defer="sub_task_desc"></textarea>
                                    </div>

                                </div>

                                <div class="form-group">
                                    @foreach ($errors->all() as $error)
                                        <span class='alert alert-danger btn'>{{ $error }}</span>
                                    @endforeach
                                </div>

                                <button wire:click="addSubTask()" type="button" class="w-100 btn btn-success">
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
                                                    {{ __('task.priority_level') }}:
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
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    </div>
                </div>
                {{-- 4 TAB END --}}

                {{-- 5 TAB START --}}
                <div class="tab-pane fade {{ $tab == 5 ? 'show active' : '' }}" id="extra" role="tabpanel"
                    aria-labelledby="extra-tab">
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
                                                            data-toggle="dropdown" aria-haspopup="true"
                                                            aria-expanded="false">
                                                            {{ $extra_time->the_status() }}
                                                        </button>
                                                        @role('owner|manager')
                                                            <div class="dropdown-menu"
                                                                aria-labelledby="dropdownMenuButton">
                                                                <button class="dropdown-item" data-toggle="modal"
                                                                    data-target="#accept-extratime-modal-{{ $task->id }}"
                                                                    wire:click="setExtraTime({{ $extra_time->id }})">
                                                                    <i class="ti-check text-success"></i>
                                                                    {{ __('task.Accept') }}
                                                                </button>
                                                                <button class="dropdown-item" data-toggle="modal"
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
                <div class="tab-pane fade {{ $tab == 6 ? 'show active' : '' }}" id="leave" role="tabpanel"
                    aria-labelledby="leave-tab">
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
                                                            data-toggle="dropdown" aria-haspopup="true"
                                                            aria-expanded="false">
                                                            {{ $leave->the_status() }}
                                                        </button>
                                                        @role('owner|manager')
                                                            <div class="dropdown-menu"
                                                                aria-labelledby="dropdownMenuButton">
                                                                <button class="dropdown-item" data-toggle="modal"
                                                                    data-target="#accept-leave-modal-{{ $task->id }}"
                                                                    wire:click="setLeave({{ $leave->id }})">
                                                                    <i class="ti-check text-success"></i>
                                                                    {{ __('task.Accept') }}
                                                                </button>
                                                                <button class="dropdown-item" data-toggle="modal"
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

                @role('owner|manager')
                    {{-- 7 TAB START --}}
                    <div class="tab-pane fade {{ $tab == 7 ? 'show active' : '' }}" id="leave" role="tabpanel"
                        aria-labelledby="leave-tab">
                        <div class="table-responsive text-start">
                            <table class="table">
                                <thead>
                                    <tr>
                                        <th>{{ __('discount.user') }}</th>
                                        <th>{{ __('discount.amount') }}</th>
                                        <th>{{ __('discount.reason') }}</th>
                                    </tr>
                                </thead>
                                <tbody class="fs-6">
                                    @foreach ($task->discounts as $discount)
                                        <tr>
                                            <td>
                                                <div class="row w-100 m-0 ">
                                                    <div class="col-3">
                                                        <img src="{{ asset($discount->user->image) }}"
                                                            style="border-radius: 40%; width: 50px;">
                                                    </div>
                                                    <div class="col">
                                                        <div class="col-12">
                                                            <a href="{{ route('user.show', $discount->user) }}">
                                                                {{ $discount->user->name() }}
                                                            </a>
                                                            <div>
                                                                <small>{{ $discount->user->email }}</small>
                                                            </div>
                                                            <div>
                                                                <small>{{ $discount->user->phone }}</small>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </td>
                                            <td class="align-content-center">
                                                {{ $discount->amount }}
                                            </td>
                                            <td class="align-content-center">
                                                {{ $discount->the_reason() }}
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                    {{-- 7 TAB END --}}
                @endrole

            </div>
        </div>
    </div>


</div>
