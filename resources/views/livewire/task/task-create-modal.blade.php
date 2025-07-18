@permission('create-task')

    <!-- Modal -->
    <div wire:ignore.self class="modal fade" id="create-new-task-modal" data-backdrop="static" data-keyboard="false"
        tabindex="-1" role="dialog" aria-labelledby="create-new-task-modal-label" aria-hidden="true">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="create-new-task-modal-label">
                        @if ($reopen_from_task_id > 0)
                            {{ __('global.open-task') }}
                        @else
                            {{ __('global.create-task') }}
                        @endif
                    </h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close" wire:click="cancel">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>

                @if (!$updateMode)
                    <form enctype="multipart/form-data" method="post" accept-charset="utf-8" class="form-horizontal">
                        <div class="modal-body">
                            @csrf

                            <div class="row">

                                {{-- @include('inputs.create.input', [
                                    'label' => 'task.slug',
                                    'name' => 'task.slug',
                                    'livewire' => 'slug',
                                    'type' => 'text', // 'step' => 0.1,
                                    // 'required' => 'required',
                                    'lg' => 12,
                                    'md' => 12,
                                    'sm' => 12,
                                ]) --}}


                                {{-- @include('inputs.create.select', [
                                    'label' => 'task.manager',
                                    'name' => 'task.manager_id',
                                    'arr' => $managers,
                                    'livewire' => 'manager_id',
                                    // 'required' => 'required', // 'type' => 'number', // 'step' => 1,
                                    // 'lg' => 6, 'md' => 6, 'sm' => 12,
                                ]) --}}

                                @include('inputs.create.input', [
                                    'label' => 'task.title',
                                    'name' => 'task.title',
                                    'livewire' => 'title',
                                    'type' => 'text', // 'step' => 1,
                                    // 'required' => 'required',
                                    'lg' => 9,
                                    'md' => 9,
                                    'sm' => 9,
                                ])

                                @include('inputs.create.input', [
                                    'label' => 'task.discount',
                                    'name' => 'task.discount',
                                    'livewire' => 'discount',
                                    'type' => 'number',
                                    'step' => 0.1,
                                    // 'required' => 'required',
                                    'lg' => 3,
                                    'md' => 3,
                                    'sm' => 3,
                                ])

                                <div class='col-12 p-0'>
                                    {{-- <div class="row"> --}}
                                    {{-- // TODO add the search --}}
                                    @include('inputs.create.select', [
                                        'label' => 'global.employees',
                                        'name' => 'user.employee_id',
                                        'arr' => $employees,
                                        'livewire' => 'select_emp',
                                        'is_select' => false,
                                        // 'required' => 'required', // 'type' => 'number', // 'step' => 1,
                                        'lg' => 12,
                                        'md' => 12,
                                        'sm' => 12,
                                    ])

                                    @foreach ($employees as $employee)
                                        @if (in_array($employee->id, $selectedEmployees))
                                            <div class='form-check form-check-inline'>
                                                <input wire:model='selectedEmployees' class='form-check-input'
                                                    type='checkbox' value='{{ $employee->id }}'
                                                    id='filter-employees-id-{{ $employee->id }}'>
                                                <label class='form-check-label'
                                                    for='filter-employees-id-{{ $employee->id }}'>
                                                    {{ $employee->crud_name() }}
                                                </label>
                                            </div>
                                        @endif
                                    @endforeach
                                    {{-- </div> --}}
                                </div>


                                {{--  --}}
                                <div class="form-group col-lg-6 col-md-6 col-sm-12">
                                    <label for="exampleFormControlSelect1">{{ __('task.comment_type') }}</label>
                                    <select wire:model.defer="comment_type" class="form-control">
                                        <option value="daily">{{ __('task.daily') }}</option>
                                        <option value="weekly">{{ __('task.weekly') }}</option>
                                        <option value="monthly">{{ __('task.monthly') }}</option>
                                    </select>
                                </div>
                                {{--  --}}
                                <div class="form-group col-lg-6 col-md-6 col-sm-12">
                                    <label for="exampleFormControlSelect1">{{ __('task.is_separate_task') }}</label>
                                    <select wire:model.defer="is_separate_task" class="form-control">
                                        <option value="1">{{ __('task.single') }}</option>
                                        <option value="0">{{ __('task.shared') }}</option>
                                    </select>
                                </div>


                                @include('inputs.create.input', [
                                    'label' => 'task.short_max_worning_count',
                                    'name' => 'task.short_max_worning_count',
                                    'livewire' => 'max_worning_count',
                                    'type' => 'number',
                                    'step' => 1,
                                    // 'lg' => 4, 'md' => 4, 'sm' => 6,
                                ])
                                {{-- @include('inputs.create.input', [
                                    'label' => 'task.sent_warnings',
                                    'name' => 'task.sent_warnings',
                                    'livewire' => 'sent_warnings',
                                    'type' => 'number',
                                    'step' => 1,
                                    // 'lg' => 4, 'md' => 4, 'sm' => 6,
                                ]) --}}
                                {{-- @include('inputs.create.input', [
                                    'label' => 'task.close_attempt',
                                    'name' => 'task.close_attempt',
                                    'livewire' => 'close_attempt',
                                    'type' => 'number',
                                    'step' => 1,
                                    // 'lg' => 4, 'md' => 4, 'sm' => 6,
                                ]) --}}

                                @include('inputs.create.input', [
                                    'label' => 'task.short_max_worning_discount',
                                    'name' => 'task.short_max_worning_discount',
                                    'livewire' => 'max_worning_discount',
                                    'type' => 'number',
                                    'step' => 1,
                                    // 'lg' => 4, 'md' => 4, 'sm' => 6,
                                ])

                                @include('inputs.textarea', [
                                    'label' => 'task.desc',
                                    'livewire' => 'desc',
                                ])

                                {{-- @include('inputs.create.input', [
                                    'label' => 'task.desc',
                                    'name' => 'task.desc',
                                    'livewire' => 'desc',
                                    'type' => 'text', // 'step' => 1,
                                    // 'required' => 'required',
                                    'lg' => 12,
                                    'md' => 12,
                                    'sm' => 12,
                                ]) --}}

                                @include('inputs.create.input', [
                                    'label' => 'task.start_time',
                                    'name' => 'task.start_time',
                                    'livewire' => 'start_time',
                                    'type' => 'datetime-local', // 'step' => 1,
                                    'min' => date('Y-m-d\TH:i'),
                                    // 'lg' => 6, 'md' => 6, 'sm' => 12,
                                ])

                                @include('inputs.create.input', [
                                    'label' => 'task.end_time',
                                    'name' => 'task.end_time',
                                    'livewire' => 'end_time',
                                    'type' => 'datetime-local', // 'step' => 1,
                                    'min' => date('Y-m-d\TH:i', strtotime($start_time . '+1 Hours')),
                                    // 'lg' => 6, 'md' => 6, 'sm' => 12,
                                ])

                                <div class="col-lg-6 col-md-6 col-sm-12">
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

                                <div class="col-lg-6 col-md-6 col-sm-12">
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

                                {{-- @include('inputs.create.select', [
                                    'label' => 'task.main_task',
                                    'name' => 'task.main_task_id',
                                    'arr' => $main_tasks,
                                    'livewire' => 'main_task_id',
                                    // 'required' => 'required', // 'type' => 'number', // 'step' => 1,
                                    'lg' => 12,
                                    'md' => 12,
                                    'sm' => 12,
                                ]) --}}

                            </div>

                        </div>

                        <div class="form-group">
                            @foreach ($errors->all() as $error)
                                <span class='alert alert-danger btn'>{{ $error }}</span>
                            @endforeach
                        </div>

                        <div class="modal-footer">
                            <button type="button" data-bs-toggle="tooltip" data-bs-placement="top" wire:click="cancel"
                                title=" {{ __('global.close') }}" class="btn btn-secondary close-btn" data-dismiss="modal">
                                {{ __('global.close') }}
                            </button>
                            <button type="submit" data-bs-toggle="tooltip" data-bs-placement="top"
                                title="{{ __('global.save-changes') }}" wire:click.prevent="store()"
                                class="btn btn-success">
                                {{ __('global.save-changes') }}
                            </button>
                            <button type="submit" data-bs-toggle="tooltip" data-bs-placement="top"
                                title="{{ __('global.archive') }}" wire:click.prevent="store(true)"
                                class="btn btn-success">
                                {{ __('global.archive') }}
                            </button>
                        </div>
                    </form>
                @endif

            </div>
        </div>
    </div>

@endpermission



@permission('edit-task')
    <div wire:ignore.self data-backdrop="static" data-keyboard="true" class="modal fade" id="update-task-modal"
        tabindex="-1" role="dialog" aria-labelledby="update-task-modal-label" aria-hidden="true">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="update-task-modal-label">{{ $task->crud_name() }}</h5>
                    <button wire:click.prevent="cancel()" type="button" class="close" data-dismiss="modal"
                        aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>

                @if ($updateMode)
                    <form enctype="multipart/form-data" method="post" accept-charset="utf-8" class="form-horizontal">
                        <div class="modal-body">
                            <input type="hidden" wire:model="task_id">
                            @csrf

                            <div class="row">

                                {{-- @include('inputs.edit.input', [
                                    'label' => 'task.slug',
                                    'name' => 'task.slug',
                                    'livewire' => 'slug',
                                    'type' => 'text', // 'step' => 0.1,
                                    // 'required' => 'required',
                                    'lg' => 12,
                                    'md' => 12,
                                    'sm' => 12,
                                ]) --}}


                                {{-- @include('inputs.edit.select', [
                                    'label' => 'task.manager',
                                    'name' => 'task.manager_id',
                                    'arr' => $managers,
                                    'livewire' => 'manager_id',
                                    'val' => $task->manager_id,
                                    // 'required' => 'required', // 'type' => 'number', // 'step' => 1,
                                    // 'lg' => 6, 'md' => 6, 'sm' => 12,
                                ]) --}}
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

                                <div class='col-12 p-0'>
                                    {{-- <div class="row"> --}}
                                    {{-- // TODO add the search --}}
                                    @include('inputs.create.select', [
                                        'label' => 'global.employees',
                                        'name' => 'user.employee_id',
                                        'arr' => $employees,
                                        'livewire' => 'select_emp',
                                        'is_select' => false,
                                        // 'required' => 'required', // 'type' => 'number', // 'step' => 1,
                                        'lg' => 12,
                                        'md' => 12,
                                        'sm' => 12,
                                    ])

                                    @foreach ($employees as $employee)
                                        @if (in_array($employee->id, $selectedEmployees))
                                            <div class='form-check form-check-inline'>
                                                <input wire:model='selectedEmployees' class='form-check-input'
                                                    type='checkbox' value='{{ $employee->id }}'
                                                    id='filter-employees-id-{{ $employee->id }}'>
                                                <label class='form-check-label'
                                                    for='filter-employees-id-{{ $employee->id }}'>
                                                    {{ $employee->crud_name() }}
                                                </label>
                                            </div>
                                        @endif
                                    @endforeach
                                    {{-- </div> --}}
                                </div>

                                <div class="form-group col-lg-6 col-md-6 col-sm-12">
                                    <label for="exampleFormControlSelect1">{{ __('task.comment_type') }}</label>
                                    <select wire:model.defer="comment_type" class="form-control">
                                        <option value="daily">{{ __('task.daily') }}</option>
                                        <option value="weekly">{{ __('task.weekly') }}</option>
                                        <option value="monthly">{{ __('task.monthly') }}</option>
                                    </select>
                                </div>

                                <div class="form-group col-lg-6 col-md-6 col-sm-12">
                                    <label for="exampleFormControlSelect1">{{ __('task.is_separate_task') }}</label>
                                    <select wire:model.defer="is_separate_task" class="form-control">
                                        <option value="1">{{ __('task.single') }}</option>
                                        <option value="0">{{ __('task.shared') }}</option>
                                    </select>
                                </div>


                                @include('inputs.edit.input', [
                                    'label' => 'task.short_max_worning_count',
                                    'name' => 'task.short_max_worning_count',
                                    'val' => $task->max_worning_count,
                                    'livewire' => 'max_worning_count',
                                    'type' => 'number',
                                    'step' => 1,
                                    // 'lg' => 4, 'md' => 4, 'sm' => 6,
                                ])
                                {{-- @include('inputs.edit.input', [
                                    'label' => 'task.sent_warnings',
                                    'name' => 'task.sent_warnings',
                                    'val' => $task->sent_warnings,
                                    'livewire' => 'sent_warnings',
                                    'type' => 'number',
                                    'step' => 1,
                                    // 'lg' => 4, 'md' => 4, 'sm' => 6,
                                ]) --}}
                                {{-- @include('inputs.edit.input', [
                                    'label' => 'task.close_attempt',
                                    'name' => 'task.close_attempt',
                                    'val' => $task->close_attempt,
                                    'livewire' => 'close_attempt',
                                    'type' => 'number',
                                    'step' => 1,
                                    // 'lg' => 4, 'md' => 4, 'sm' => 6,
                                ]) --}}
                                @include('inputs.edit.input', [
                                    'label' => 'task.short_max_worning_discount',
                                    'name' => 'task.short_max_worning_discount',
                                    'val' => $task->max_worning_discount(),
                                    'livewire' => 'max_worning_discount',
                                    'type' => 'number',
                                    'step' => 1,
                                    // 'lg' => 4, 'md' => 4, 'sm' => 6,
                                ])

                                @include('inputs.textarea', [
                                    'label' => 'task.desc',
                                    'livewire' => 'desc',
                                ])

                                {{-- @include('inputs.edit.input', [
                                    'label' => 'task.desc',
                                    'name' => 'task.desc',
                                    'val' => $task->desc,
                                    'livewire' => 'desc',
                                    'type' => 'text', // 'step' => 1,
                                    // 'required' => 'required',
                                    'lg' => 12,
                                    'md' => 12,
                                    'sm' => 12,
                                ]) --}}

                                @include('inputs.edit.input', [
                                    'label' => 'task.start_time',
                                    'name' => 'task.start_time',
                                    'val' => $task->start_time,
                                    'livewire' => 'start_time',
                                    'type' => 'datetime-local', // 'step' => 1,
                                    'min' => date('Y-m-d\TH:i'),
                                    // 'lg' => 6, 'md' => 6, 'sm' => 12,
                                ])
                                @include('inputs.edit.input', [
                                    'label' => 'task.end_time',
                                    'name' => 'task.end_time',
                                    'val' => $task->end_time,
                                    'livewire' => 'end_time',
                                    'type' => 'datetime-local', // 'step' => 1,
                                    'min' => date('Y-m-d\TH:i', strtotime($start_time . '+1 Hours')),
                                    // 'lg' => 6, 'md' => 6, 'sm' => 12,
                                ])

                                <div class="col-lg-6 col-md-6 col-sm-12">
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

                                <div class="col-lg-6 col-md-6 col-sm-12">
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

                                {{-- @include('inputs.edit.select', [
                                    'label' => 'task.main_task',
                                    'name' => 'task.main_task_id',
                                    'arr' => $main_tasks,
                                    'livewire' => 'main_task_id',
                                    'val' => $task->main_task_id,
                                    // 'required' => 'required', // 'type' => 'number', // 'step' => 1,
                                    'lg' => 12,
                                    'md' => 12,
                                    'sm' => 12,
                                ]) --}}
                            </div>

                        </div>

                        <div class="form-group">

                            @foreach ($errors->all() as $error)
                                <span class='alert alert-danger btn'>{{ $error }}</span>
                            @endforeach

                        </div>

                        <div class="modal-footer">
                            <button type="button" wire:click.prevent="cancel()" class="btn btn-secondary close-btn"
                                data-dismiss="modal">{{ __('global.close') }}</button>
                            <button type="button" wire:click.prevent="update()" class="btn btn-success">
                                {{ __('global.save-changes') }}
                            </button>
                            @if ($task->slug == 'archive')
                                <button type="button" wire:click.prevent="update(true)" class="btn btn-success">
                                    {{ __('global.activate') }}
                                </button>
                            @endif
                        </div>
                    </form>
                @endif

            </div>
        </div>
    </div>


@endpermission
