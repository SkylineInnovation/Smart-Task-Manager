@permission('create-leave')

    <!-- Modal -->
    <div wire:ignore.self class="modal fade" id="create-new-leave-modal" data-backdrop="static" data-keyboard="false"
        tabindex="-1" role="dialog" aria-labelledby="create-new-leave-modal-label" aria-hidden="true">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="create-new-leave-modal-label">
                        {{ __('global.create-leave') }}
                    </h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>

                @if (!$updateMode)
                    <form enctype="multipart/form-data" method="post" accept-charset="utf-8" class="form-horizontal">
                        <div class="modal-body">
                            @csrf

                            <div class="row">

                                {{-- @include('inputs.create.input', [
                                    'label' => 'leave.slug',
                                    'name' => 'leave.slug',
                                    'livewire' => 'slug',
                                    'type' => 'text', // 'step' => 0.1,
                                    // 'required' => 'required',
                                    'lg' => 12,
                                    'md' => 12,
                                    'sm' => 12,
                                ]) --}}


                                @include('inputs.create.select', [
                                    'label' => 'leave.task',
                                    'name' => 'leave.task_id',
                                    'arr' => $tasks,
                                    'is_select' => false,
                                    'livewire' => 'task_id',
                                    // 'required' => 'required', // 'type' => 'number', // 'step' => 1,
                                    // 'lg' => 6, 'md' => 6, 'sm' => 12,
                                ])

                                @include('inputs.create.select', [
                                    'label' => 'leave.user',
                                    'name' => 'leave.user_id',
                                    'arr' => $users,
                                    'is_select' => false,
                                    'livewire' => 'user_id',
                                    // 'required' => 'required', // 'type' => 'number', // 'step' => 1,
                                    // 'lg' => 6, 'md' => 6, 'sm' => 12,
                                ])

                                {{-- @include('inputs.create.input', [
                                    'label' => 'leave.type',
                                    'name' => 'leave.type',
                                    'livewire' => 'type',
                                    'type' => 'text', // 'step' => 1,
                                    // 'required' => 'required',
                                    // 'lg' => 6, 'md' => 6, 'sm' => 12,
                                ]) --}}

                                <div class="col-lg-9 col-md-9 col-sm-12">
                                    <div class="form-group">
                                        <label for="type">{{ __('leave.type') }}</label>
                                        <select wire:model="type" name="type" id="type" class="form-control">
                                            <option value="leave">{{ __('leave.leave') }}</option>
                                            <option value="part_of_task">{{ __('leave.part_of_task') }}</option>
                                        </select>
                                    </div>
                                </div>

                                {{-- <div class="col-lg-3 col-md-3 col-sm-12">
                                    <div class="form-group">
                                        <label for="status">{{ __('leave.status') }}</label>
                                        <select wire:model="status" name="status" id="status" class="form-control">
                                            <option value="pending">{{ __('leave.pending') }}</option>
                                            <option value="accepted">{{ __('leave.accepted') }}</option>
                                            <option value="rejected">{{ __('leave.rejected') }}</option>
                                        </select>
                                    </div>
                                </div> --}}

                                @include('inputs.create.input', [
                                    'label' => 'leave.time_out',
                                    'name' => 'leave.time_out',
                                    'livewire' => 'time_out',
                                    'type' => 'datetime-local', // 'step' => 1,
                                    'min' => date('Y-m-d\TH:i'),
                                    'lg' => 5,
                                    'md' => 5,
                                    'sm' => 12,
                                ])

                                @include('inputs.create.input', [
                                    'label' => 'leave.time_in',
                                    'name' => 'leave.time_in',
                                    'livewire' => 'time_in',
                                    'type' => 'datetime-local', // 'step' => 1,
                                    'min' => date('Y-m-d\TH:i'),
                                    'lg' => 5,
                                    'md' => 5,
                                    'sm' => 12,
                                ])


                                <div class="col-lg-2 col-md-2 col-sm-12">
                                    <div class="form-group">
                                        <label for="effect_on_time">{{ __('leave.effect_on_time') }}</label>
                                        <select wire:model="effect_on_time" name="effect_on_time" id="effect_on_time"
                                            class="form-control">
                                            <option value="1">{{ __('global.yes') }}</option>
                                            <option value="0">{{ __('global.no') }}</option>
                                        </select>
                                    </div>
                                </div>

                                @include('inputs.create.input', [
                                    'label' => 'leave.reason',
                                    'name' => 'leave.reason',
                                    'livewire' => 'reason',
                                    'type' => 'text', // 'step' => 1,
                                    // 'required' => 'required',
                                    // 'lg' => 6, 'md' => 6, 'sm' => 12,
                                ])

                                @include('inputs.create.input', [
                                    'label' => 'leave.result',
                                    'name' => 'leave.result',
                                    'livewire' => 'result',
                                    'type' => 'text', // 'step' => 1,
                                    // 'required' => 'required',
                                    // 'lg' => 6, 'md' => 6, 'sm' => 12,
                                ])

                                {{-- @include('inputs.create.select', [
                                    'label' => 'leave.accepted_by_user',
                                    'name' => 'leave.accepted_by_user_id',
                                    'arr' => $accepted_by_users,
                                    'livewire' => 'accepted_by_user_id',
                                    // 'required' => 'required', // 'type' => 'number', // 'step' => 1,
                                    // 'lg' => 6, 'md' => 6, 'sm' => 12,
                                ]) --}}

                                {{-- @include('inputs.create.input', [
                                    'label' => 'leave.accepted_time',
                                    'name' => 'leave.accepted_time',
                                    'livewire' => 'accepted_time',
                                    'type' => 'text', // 'step' => 1,
                                    // 'required' => 'required',
                                    // 'lg' => 6, 'md' => 6, 'sm' => 12,
                                ]) --}}

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
                            <button type="submit" wire:click.prevent="store()" class="btn btn-success">
                                {{ __('global.save-changes') }}
                            </button>
                        </div>
                    </form>
                @endif

            </div>
        </div>
    </div>
@endpermission



@permission('edit-leave')
    <div wire:ignore.self data-backdrop="static" data-keyboard="true" class="modal fade" id="update-leave-modal"
        tabindex="-1" role="dialog" aria-labelledby="update-leave-modal-label" aria-hidden="true">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="update-leave-modal-label">{{ $leave->crud_name() }}</h5>
                    <button wire:click.prevent="cancel()" type="button" class="close" data-dismiss="modal"
                        aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>

                @if ($updateMode)
                    <form enctype="multipart/form-data" method="post" accept-charset="utf-8" class="form-horizontal">
                        <div class="modal-body">
                            <input type="hidden" wire:model="leave_id">
                            @csrf

                            <div class="row">

                                {{-- @include('inputs.edit.input', [
                                    'label' => 'leave.slug',
                                    'name' => 'leave.slug',
                                    'livewire' => 'slug',
                                    'type' => 'text', // 'step' => 0.1,
                                    // 'required' => 'required',
                                    'lg' => 12,
                                    'md' => 12,
                                    'sm' => 12,
                                ]) --}}


                                @include('inputs.edit.select', [
                                    'label' => 'leave.task',
                                    'name' => 'leave.task_id',
                                    'arr' => $tasks,
                                    'livewire' => 'task_id',
                                    'val' => $leave->task_id,
                                    'is_select' => false,
                                    'value' => $leave->task->crud_name(),
                                    // 'required' => 'required', // 'type' => 'number', // 'step' => 1,
                                    // 'lg' => 6, 'md' => 6, 'sm' => 12,
                                ])

                                @include('inputs.edit.select', [
                                    'label' => 'leave.user',
                                    'name' => 'leave.user_id',
                                    'arr' => $users,
                                    'livewire' => 'user_id',
                                    'val' => $leave->user_id,
                                    'is_select' => false,
                                    'value' => $leave->user->crud_name(),
                                    // 'required' => 'required', // 'type' => 'number', // 'step' => 1,
                                    // 'lg' => 6, 'md' => 6, 'sm' => 12,
                                ])

                                <div class="col-lg-9 col-md-9 col-sm-12">
                                    <div class="form-group">
                                        <label for="type">{{ __('leave.type') }}</label>
                                        <select wire:model="type" name="type" id="type" class="form-control">
                                            <option value="leave">{{ __('leave.leave') }}</option>
                                            <option value="part_of_task">{{ __('leave.part_of_task') }}</option>
                                        </select>
                                    </div>
                                </div>

                                <div class="col-lg-3 col-md-3 col-sm-12">
                                    <div class="form-group">
                                        <label for="status">{{ __('leave.status') }}</label>
                                        <select wire:model="status" name="status" id="status" class="form-control">
                                            <option value="pending">{{ __('leave.pending') }}</option>
                                            <option value="accepted">{{ __('leave.accepted') }}</option>
                                            <option value="rejected">{{ __('leave.rejected') }}</option>
                                        </select>
                                    </div>
                                </div>

                                @include('inputs.edit.input', [
                                    'label' => 'leave.time_out',
                                    'name' => 'leave.time_out',
                                    'val' => $leave->time_out,
                                    'livewire' => 'time_out',
                                    'type' => 'datetime-local', // 'step' => 1,
                                    'min' => date('Y-m-d\TH:i'),
                                    'lg' => 5,
                                    'md' => 5,
                                    'sm' => 6,
                                ])
                                @include('inputs.edit.input', [
                                    'label' => 'leave.time_in',
                                    'name' => 'leave.time_in',
                                    'val' => $leave->time_in,
                                    'livewire' => 'time_in',
                                    'type' => 'datetime-local', // 'step' => 1,
                                    'min' => date('Y-m-d\TH:i'),
                                    'lg' => 5,
                                    'md' => 5,
                                    'sm' => 6,
                                ])

                                <div class="col-lg-2 col-md-2 col-sm-12">
                                    <div class="form-group">
                                        <label for="effect_on_time">{{ __('leave.effect_on_time') }}</label>
                                        <select wire:model="effect_on_time" name="effect_on_time" id="effect_on_time"
                                            class="form-control">
                                            <option value="1">{{ __('global.yes') }}</option>
                                            <option value="0">{{ __('global.no') }}</option>
                                        </select>
                                    </div>
                                </div>

                                @include('inputs.edit.input', [
                                    'label' => 'leave.reason',
                                    'name' => 'leave.reason',
                                    'val' => $leave->reason,
                                    'livewire' => 'reason',
                                    'type' => 'text', // 'step' => 1,
                                    // 'required' => 'required',
                                    // 'lg' => 6, 'md' => 6, 'sm' => 12,
                                ])
                                @include('inputs.edit.input', [
                                    'label' => 'leave.result',
                                    'name' => 'leave.result',
                                    'val' => $leave->result,
                                    'livewire' => 'result',
                                    'type' => 'text', // 'step' => 1,
                                    // 'required' => 'required',
                                    // 'lg' => 6, 'md' => 6, 'sm' => 12,
                                ])

                                {{-- @include('inputs.edit.select', [
                                    'label' => 'leave.accepted_by_user',
                                    'name' => 'leave.accepted_by_user_id',
                                    'arr' => $accepted_by_users,
                                    'livewire' => 'accepted_by_user_id',
                                    'val' => $leave->accepted_by_user_id,
                                    // 'required' => 'required', // 'type' => 'number', // 'step' => 1,
                                    // 'lg' => 6, 'md' => 6, 'sm' => 12,
                                ]) --}}

                                {{-- @include('inputs.edit.input', [
                                    'label' => 'leave.accepted_time',
                                    'name' => 'leave.accepted_time',
                                    'val' => $leave->accepted_time,
                                    'livewire' => 'accepted_time',
                                    'type' => 'text', // 'step' => 1,
                                    // 'required' => 'required',
                                    // 'lg' => 6, 'md' => 6, 'sm' => 12,
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
                        </div>
                    </form>
                @endif

            </div>
        </div>
    </div>
@endpermission


<div wire:ignore.self class="modal fade" id="accept-leave-modal" data-backdrop="static" data-keyboard="false"
    tabindex="-1" role="dialog" aria-labelledby="accept-leave-modal-label" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="accept-leave-modal-label">
                    {{ __('global.accept-leave') }}
                </h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>

            @if ($show)
                <form enctype="multipart/form-data" method="post" accept-charset="utf-8" class="form-horizontal">
                    <div class="modal-body">
                        @csrf

                        <div class="row">
                            @include('inputs.show.input', [
                                'label' => 'leave.task',
                                'val' => $leave->task ? $leave->task->crud_name() : __('global.no-task'),
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
                                    <select wire:model="type" name="type" id="type" class="form-control">
                                        <option value="leave">{{ __('leave.leave') }}</option>
                                        <option value="part_of_task">{{ __('leave.part_of_task') }}</option>
                                    </select>
                                </div>
                            </div>

                            @include('inputs.edit.input', [
                                'label' => 'leave.time_out',
                                'name' => 'leave.time_out',
                                'val' => $leave->time_out,
                                'livewire' => 'time_out',
                                'type' => 'datetime-local', // 'step' => 1,
                                'min' => date('Y-m-d\TH:i'),
                                'lg' => 5,
                                'md' => 5,
                                'sm' => 12,
                            ])

                            @include('inputs.edit.input', [
                                'label' => 'leave.time_in',
                                'name' => 'leave.time_in',
                                'val' => $leave->time_in,
                                'livewire' => 'time_in',
                                'type' => 'datetime-local', // 'step' => 1,
                                'min' => date('Y-m-d\TH:i'),
                                'lg' => 5,
                                'md' => 5,
                                'sm' => 12,
                            ])

                            <div class="col-lg-2 col-md-2 col-sm-12">
                                <div class="form-group">
                                    <label for="effect_on_time">{{ __('leave.effect_on_time') }}</label>
                                    <select wire:model="effect_on_time" name="effect_on_time" id="effect_on_time"
                                        class="form-control">
                                        <option value="1">{{ __('global.yes') }}</option>
                                        <option value="0">{{ __('global.no') }}</option>
                                    </select>
                                </div>
                            </div>


                            @include('inputs.edit.input', [
                                'label' => 'leave.reason',
                                'name' => 'leave.reason',
                                'val' => $leave->reason,
                                'livewire' => 'reason',
                                'type' => 'text', // 'step' => 1,
                                // 'required' => 'required',
                                'lg' => 12,
                                'md' => 12,
                                'sm' => 12,
                            ])

                            @include('inputs.edit.input', [
                                'label' => 'leave.result',
                                'name' => 'leave.result',
                                'val' => $leave->result,
                                'livewire' => 'result',
                                'type' => 'text', // 'step' => 1,
                                // 'required' => 'required',
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
