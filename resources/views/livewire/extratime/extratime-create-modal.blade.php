@permission('create-extratime')

    <!-- Modal -->
    <div wire:ignore.self class="modal fade" id="create-new-extratime-modal" data-backdrop="static" data-keyboard="false"
        tabindex="-1" role="dialog" aria-labelledby="create-new-extratime-modal-label" aria-hidden="true">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="create-new-extratime-modal-label">
                        {{ __('global.create-extratime') }}
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
                                    'label' => 'extratime.slug',
                                    'name' => 'extratime.slug',
                                    'livewire' => 'slug',
                                    'type' => 'text', // 'step' => 0.1,
                                    // 'required' => 'required',
                                    'lg' => 12,
                                    'md' => 12,
                                    'sm' => 12,
                                ]) --}}


                                @include('inputs.create.select', [
                                    'label' => 'extratime.task',
                                    'name' => 'extratime.task_id',
                                    'arr' => $tasks,
                                    'is_select' => false,
                                    'livewire' => 'task_id',
                                    // 'required' => 'required', // 'type' => 'number', // 'step' => 1,
                                    // 'lg' => 6, 'md' => 6, 'sm' => 12,
                                ])

                                @include('inputs.create.select', [
                                    'label' => 'extratime.user',
                                    'name' => 'extratime.user_id',
                                    'arr' => $users,
                                    'is_select' => false,
                                    'livewire' => 'user_id',
                                    // 'required' => 'required', // 'type' => 'number', // 'step' => 1,
                                    // 'lg' => 6, 'md' => 6, 'sm' => 12,
                                ])

                                @include('inputs.create.input', [
                                    'label' => 'extratime.reason',
                                    'name' => 'extratime.reason',
                                    'livewire' => 'reason',
                                    'type' => 'text', // 'step' => 1,
                                    // 'required' => 'required',
                                    // 'lg' => 6, 'md' => 6, 'sm' => 12,
                                ])
                                @include('inputs.create.input', [
                                    'label' => 'extratime.result',
                                    'name' => 'extratime.result',
                                    'livewire' => 'result',
                                    'type' => 'text', // 'step' => 1,
                                    // 'required' => 'required',
                                    // 'lg' => 6, 'md' => 6, 'sm' => 12,
                                ])

                                @include('inputs.create.input', [
                                    'label' => 'extratime.request_time',
                                    'name' => 'extratime.request_time',
                                    'livewire' => 'request_time',
                                    'type' => 'datetime-local', // 'step' => 1,
                                    'min' => date('Y-m-d\TH:i'),
                                    // 'lg' => 6, 'md' => 6, 'sm' => 12,
                                ])
                                @include('inputs.create.input', [
                                    'label' => 'extratime.from_time',
                                    'name' => 'extratime.from_time',
                                    'livewire' => 'from_time',
                                    'type' => 'datetime-local', // 'step' => 1,
                                    'min' => date('Y-m-d\TH:i'),
                                    // 'lg' => 6, 'md' => 6, 'sm' => 12,
                                ])
                                @include('inputs.create.input', [
                                    'label' => 'extratime.to_time',
                                    'name' => 'extratime.to_time',
                                    'livewire' => 'to_time',
                                    'type' => 'datetime-local', // 'step' => 1,
                                    'min' => date('Y-m-d\TH:i'),
                                    // 'lg' => 6, 'md' => 6, 'sm' => 12,
                                ])
                                @include('inputs.create.input', [
                                    'label' => 'extratime.response_time',
                                    'name' => 'extratime.response_time',
                                    'livewire' => 'response_time',
                                    'type' => 'datetime-local', // 'step' => 1,
                                    'min' => date('Y-m-d\TH:i'),
                                    // 'lg' => 6, 'md' => 6, 'sm' => 12,
                                ])
                                {{-- @include('inputs.create.input', [
                                    'label' => 'extratime.status',
                                    'name' => 'extratime.status',
                                    'livewire' => 'status',
                                    'type' => 'text', // 'step' => 1,
                                    // 'required' => 'required',
                                    // 'lg' => 6, 'md' => 6, 'sm' => 12,
                                ]) --}}

                                <div class="col-lg-6 col-md-6 col-sm-12">
                                    <div class="form-group">
                                        <label for="status">{{ __('extratime.status') }}</label>
                                        <select wire:model="status" name="status" id="status" class="form-control">
                                            <option value="pending">{{ __('extratime.pending') }}</option>
                                            <option value="accepted">{{ __('extratime.accepted') }}</option>
                                            <option value="rejected">{{ __('extratime.rejected') }}</option>
                                        </select>
                                    </div>
                                </div>

                                @include('inputs.create.input', [
                                    'label' => 'extratime.duration',
                                    'name' => 'extratime.duration',
                                    'livewire' => 'duration',
                                    'type' => 'number', // 'step' => 1,
                                    // 'required' => 'required',
                                    // 'lg' => 6, 'md' => 6, 'sm' => 12,
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



@permission('edit-extratime')
    <div wire:ignore.self data-backdrop="static" data-keyboard="true" class="modal fade" id="update-extratime-modal"
        tabindex="-1" role="dialog" aria-labelledby="update-extratime-modal-label" aria-hidden="true">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="update-extratime-modal-label">{{ $extratime->crud_name() }}</h5>
                    <button wire:click.prevent="cancel()" type="button" class="close" data-dismiss="modal"
                        aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>

                @if ($updateMode)
                    <form enctype="multipart/form-data" method="post" accept-charset="utf-8" class="form-horizontal">
                        <div class="modal-body">
                            <input type="hidden" wire:model="extratime_id">
                            @csrf

                            <div class="row">

                                {{-- @include('inputs.edit.input', [
                                    'label' => 'extratime.slug',
                                    'name' => 'extratime.slug',
                                    'livewire' => 'slug',
                                    'type' => 'text', // 'step' => 0.1,
                                    // 'required' => 'required',
                                    'lg' => 12,
                                    'md' => 12,
                                    'sm' => 12,
                                ]) --}}


                                @include('inputs.edit.select', [
                                    'label' => 'extratime.task',
                                    'name' => 'extratime.task_id',
                                    'arr' => $tasks,
                                    'livewire' => 'task_id',
                                    'val' => $extratime->task_id,
                                    'is_select' => false,
                                    'value' => $extratime->task->crud_name(),
                                    // 'required' => 'required', // 'type' => 'number', // 'step' => 1,
                                    // 'lg' => 6, 'md' => 6, 'sm' => 12,
                                ])

                                @include('inputs.edit.select', [
                                    'label' => 'extratime.user',
                                    'name' => 'extratime.user_id',
                                    'arr' => $users,
                                    'livewire' => 'user_id',
                                    'val' => $extratime->user_id,
                                    'is_select' => false,
                                    'value' => $extratime->user->crud_name(),
                                    // 'required' => 'required', // 'type' => 'number', // 'step' => 1,
                                    // 'lg' => 6, 'md' => 6, 'sm' => 12,
                                ])

                                @include('inputs.edit.input', [
                                    'label' => 'extratime.reason',
                                    'name' => 'extratime.reason',
                                    'val' => $extratime->reason,
                                    'livewire' => 'reason',
                                    'type' => 'text', // 'step' => 1,
                                    // 'required' => 'required',
                                    // 'lg' => 6, 'md' => 6, 'sm' => 12,
                                ])
                                @include('inputs.edit.input', [
                                    'label' => 'extratime.result',
                                    'name' => 'extratime.result',
                                    'val' => $extratime->result,
                                    'livewire' => 'result',
                                    'type' => 'text', // 'step' => 1,
                                    // 'required' => 'required',
                                    // 'lg' => 6, 'md' => 6, 'sm' => 12,
                                ])
                                @include('inputs.edit.input', [
                                    'label' => 'extratime.request_time',
                                    'name' => 'extratime.request_time',
                                    'val' => $extratime->request_time,
                                    'livewire' => 'request_time',
                                    'type' => 'datetime-local', // 'step' => 1,
                                    'min' => date('Y-m-d\TH:i'),
                                    // 'lg' => 6, 'md' => 6, 'sm' => 12,
                                ])
                                @include('inputs.edit.input', [
                                    'label' => 'extratime.from_time',
                                    'name' => 'extratime.from_time',
                                    'val' => $extratime->from_time,
                                    'livewire' => 'from_time',
                                    'type' => 'datetime-local', // 'step' => 1,
                                    'min' => date('Y-m-d\TH:i'),
                                    // 'lg' => 6, 'md' => 6, 'sm' => 12,
                                ])
                                @include('inputs.edit.input', [
                                    'label' => 'extratime.to_time',
                                    'name' => 'extratime.to_time',
                                    'val' => $extratime->to_time,
                                    'livewire' => 'to_time',
                                    'type' => 'datetime-local', // 'step' => 1,
                                    'min' => date('Y-m-d\TH:i'),
                                    // 'lg' => 6, 'md' => 6, 'sm' => 12,
                                ])

                                @include('inputs.edit.input', [
                                    'label' => 'extratime.response_time',
                                    'name' => 'extratime.response_time',
                                    'val' => $extratime->response_time,
                                    'livewire' => 'response_time',
                                    'type' => 'datetime-local', // 'step' => 1,
                                    'min' => date('Y-m-d\TH:i'),
                                    // 'lg' => 6, 'md' => 6, 'sm' => 12,
                                ])

                                <div class="col-lg-6 col-md-6 col-sm-12">
                                    <div class="form-group">
                                        <label for="status">{{ __('extratime.status') }}</label>
                                        <select wire:model="status" name="status" id="status" class="form-control">
                                            <option value="pending">{{ __('extratime.pending') }}</option>
                                            <option value="accepted">{{ __('extratime.accepted') }}</option>
                                            <option value="rejected">{{ __('extratime.rejected') }}</option>
                                        </select>
                                    </div>
                                </div>

                                @include('inputs.edit.input', [
                                    'label' => 'extratime.duration',
                                    'name' => 'extratime.duration',
                                    'val' => $extratime->duration,
                                    'livewire' => 'duration',
                                    'type' => 'number', // 'step' => 1,
                                    // 'required' => 'required',
                                    // 'lg' => 6, 'md' => 6, 'sm' => 12,
                                ])

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


{{-- reject-extratime-modal --}}


<div wire:ignore.self class="modal fade" id="accept-extratime-modal" data-backdrop="static" data-keyboard="false"
    tabindex="-1" role="dialog" aria-labelledby="accept-extratime-modal-label" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="accept-extratime-modal-label">
                    {{ __('global.accept-extratime') }}
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
                                'label' => 'extratime.task',
                                'val' => $extratime->task->crud_name(),
                            ])

                            @include('inputs.show.input', [
                                'label' => 'extratime.user',
                                'val' => $extratime->user->name(),
                            ])

                            @include('inputs.show.input', [
                                'label' => 'extratime.reason',
                                'val' => $reason,
                                'lg' => 8,
                                'md' => 8,
                                'sm' => 8,
                            ])

                            {{-- @include('inputs.create.input', [
                                'label' => 'extratime.result',
                                'name' => 'extratime.result',
                                'livewire' => 'result',
                                'type' => 'text', // 'step' => 1,
                                // 'required' => 'required',
                                // 'lg' => 6, 'md' => 6, 'sm' => 12,
                            ]) --}}

                            @include('inputs.show.input', [
                                'label' => 'extratime.request_time',
                                'val' => $request_time,
                                // 'type' => 'datetime-local', // 'step' => 1,
                                'min' => date('Y-m-d\TH:i'),
                                'lg' => 4,
                                'md' => 4,
                                'sm' => 4,
                            ])

                            @include('inputs.create.input', [
                                'label' => 'extratime.from_time',
                                'name' => 'extratime.from_time',
                                'livewire' => 'from_time',
                                'type' => 'datetime-local', // 'step' => 1,
                                'min' => date('Y-m-d\TH:i'),
                                // 'lg' => 6, 'md' => 6, 'sm' => 12,
                            ])

                            @include('inputs.create.input', [
                                'label' => 'extratime.to_time',
                                'name' => 'extratime.to_time',
                                'livewire' => 'to_time',
                                'type' => 'datetime-local', // 'step' => 1,
                                'min' => date('Y-m-d\TH:i'),
                                // 'lg' => 6, 'md' => 6, 'sm' => 12,
                            ])

                            @include('inputs.show.input', [
                                'label' => 'extratime.duration',
                                'val' => $duration,
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
                        <button type="submit" wire:click.prevent="acceptExtraTime()" class="btn btn-success">
                            {{ __('global.save-changes') }}
                        </button>
                    </div>
                </form>
            @endif

        </div>
    </div>
</div>
