@permission('create-dailytask')

    <!-- Modal -->
    <div wire:ignore.self class="modal fade" id="create-new-dailytask-modal" data-backdrop="static" data-keyboard="false"
        tabindex="-1" role="dialog" aria-labelledby="create-new-dailytask-modal-label" aria-hidden="true">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="create-new-dailytask-modal-label">
                        {{ __('global.create-dailytask') }}
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
                                    'label' => 'dailytask.slug',
                                    'name' => 'dailytask.slug',
                                    'livewire' => 'slug',
                                    'type' => 'text', // 'step' => 0.1,
                                    // 'required' => 'required',
                                    'lg' => 12,
                                    'md' => 12,
                                    'sm' => 12,
                                ]) --}}


                                {{-- @include('inputs.create.select', [
                                    'label' => 'dailytask.manager',
                                    'name' => 'dailytask.manager_id',
                                    'arr' => $managers,
                                    'livewire' => 'manager_id',
                                    // 'required' => 'required', // 'type' => 'number', // 'step' => 1,
                                    // 'lg' => 6, 'md' => 6, 'sm' => 12,
                                ]) --}}

                                @include('inputs.create.input', [
                                    'label' => 'dailytask.title',
                                    'name' => 'dailytask.title',
                                    'livewire' => 'title',
                                    'type' => 'text', // 'step' => 1,
                                    // 'required' => 'required',
                                    'lg' => 8,
                                    'md' => 8,
                                    'sm' => 8,
                                ])

                                @include('inputs.create.input', [
                                    'label' => 'dailytask.discount',
                                    'name' => 'dailytask.discount',
                                    'livewire' => 'discount',
                                    'type' => 'number',
                                    'step' => 1,
                                    // 'required' => 'required',
                                    'lg' => 4,
                                    'md' => 4,
                                    'sm' => 12,
                                ])


                                @include('inputs.textarea', [
                                    'label' => 'dailytask.description',
                                    'livewire' => 'description',
                                ])
                                {{-- @include('inputs.create.input', [
                                    'label' => 'dailytask.description',
                                    'name' => 'dailytask.description',
                                    'livewire' => 'description',
                                    'type' => 'text', // 'step' => 1,
                                    // 'required' => 'required',
                                    'lg' => 12,
                                    'md' => 12,
                                    'sm' => 12,
                                ]) --}}


                                {{-- @include('inputs.create.input', [
                                    'label' => 'dailytask.proearty',
                                    'name' => 'dailytask.proearty',
                                    'livewire' => 'proearty',
                                    'type' => 'text', // 'step' => 1,
                                    // 'required' => 'required',
                                    // 'lg' => 6, 'md' => 6, 'sm' => 12,
                                ]) --}}



                                @include('inputs.create.input', [
                                    'label' => 'dailytask.start_time',
                                    'name' => 'dailytask.start_time',
                                    'livewire' => 'start_time',
                                    'type' => 'datetime-local', // 'step' => 1,
                                    'min' => date('Y-m-d\TH:i'),
                                    'lg' => 4,
                                    'md' => 4,
                                    'sm' => 12,
                                ])
                                @include('inputs.create.input', [
                                    'label' => 'dailytask.end_time',
                                    'name' => 'dailytask.end_time',
                                    'livewire' => 'end_time',
                                    'type' => 'datetime-local', // 'step' => 1,
                                    'min' => date('Y-m-d\TH:i', strtotime($start_time . '+1 Hours')),
                                    'lg' => 4,
                                    'md' => 4,
                                    'sm' => 12,
                                ])

                                {{-- @include('inputs.create.input', [
                                    'label' => 'dailytask.status',
                                    'name' => 'dailytask.status',
                                    'livewire' => 'status',
                                    'type' => 'text', // 'step' => 1,
                                    // 'required' => 'required',
                                    // 'lg' => 6, 'md' => 6, 'sm' => 12,
                                ]) --}}


                                @include('inputs.create.input', [
                                    'label' => 'dailytask.repeat_time',
                                    'name' => 'dailytask.repeat_time',
                                    'livewire' => 'repeat_time',
                                    'type' => 'time', // 'step' => 1,
                                    // 'required' => 'required',
                                    'lg' => 4,
                                    'md' => 4,
                                    'sm' => 12,
                                ])
                                {{-- @include('inputs.create.input', [
                                    'label' => 'dailytask.repeat_evrey',
                                    'name' => 'dailytask.repeat_evrey',
                                    'livewire' => 'repeat_evrey',
                                    'type' => 'time', // 'step' => 1,
                                    // 'required' => 'required',
                                    // 'lg' => 6, 'md' => 6, 'sm' => 12,
                                ]) --}}

                                <div class="col-lg-6 col-md-6 col-sm-12">
                                    <div class="form-group">
                                        <label for="proearty">{{ __('dailytask.proearty') }}</label>
                                        <select wire:model="proearty" name="proearty" id="proearty" class="form-control">
                                            <option value="urgent">{{ __('dailytask.urgent') }}</option>
                                            <option value="high">{{ __('dailytask.high') }}</option>
                                            <option value="medium">{{ __('dailytask.medium') }}</option>
                                            <option value="low">{{ __('dailytask.low') }}</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-lg-6 col-md-6 col-sm-12">
                                    <div class="form-group">
                                        <label for="status">{{ __('dailytask.status') }}</label>
                                        <select wire:model="status" name="status" id="status" class="form-control">
                                            <option value="active">{{ __('dailytask.active') }}</option>
                                            <option value="disabled">{{ __('dailytask.disabled') }}</option>
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
                                                    <input wire:model='selectedEmployees' class="form-check-input"
                                                        type="checkbox" value="{{ $employee->id }}"
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



@permission('edit-dailytask')
    <div wire:ignore.self data-backdrop="static" data-keyboard="true" class="modal fade" id="update-dailytask-modal"
        tabindex="-1" role="dialog" aria-labelledby="update-dailytask-modal-label" aria-hidden="true">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="update-dailytask-modal-label">{{ $dailytask->crud_name() }}</h5>
                    <button wire:click.prevent="cancel()" type="button" class="close" data-dismiss="modal"
                        aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>

                @if ($updateMode)
                    <form enctype="multipart/form-data" method="post" accept-charset="utf-8" class="form-horizontal">
                        <div class="modal-body">
                            <input type="hidden" wire:model="dailytask_id">
                            @csrf

                            <div class="row">

                                {{-- @include('inputs.edit.input', [
                                    'label' => 'dailytask.slug',
                                    'name' => 'dailytask.slug',
                                    'livewire' => 'slug',
                                    'type' => 'text', // 'step' => 0.1,
                                    // 'required' => 'required',
                                    'lg' => 12,
                                    'md' => 12,
                                    'sm' => 12,
                                ]) --}}


                                {{-- @include('inputs.edit.select', [
                                    'label' => 'dailytask.manager',
                                    'name' => 'dailytask.manager_id',
                                    'arr' => $managers,
                                    'livewire' => 'manager_id',
                                    'val' => $dailytask->manager_id,
                                    // 'required' => 'required', // 'type' => 'number', // 'step' => 1,
                                    // 'lg' => 6, 'md' => 6, 'sm' => 12,
                                ]) --}}
                                @include('inputs.edit.input', [
                                    'label' => 'dailytask.title',
                                    'name' => 'dailytask.title',
                                    'val' => $dailytask->title,
                                    'livewire' => 'title',
                                    'type' => 'text', // 'step' => 1,
                                    // 'required' => 'required',
                                    'lg' => 8,
                                    'md' => 8,
                                    'sm' => 8,
                                ])

                                @include('inputs.edit.input', [
                                    'label' => 'dailytask.discount',
                                    'name' => 'dailytask.discount',
                                    'livewire' => 'discount',
                                    'val' => $dailytask->discount(),
                                    'type' => 'number',
                                    'step' => 1,
                                    // 'required' => 'required',
                                    'lg' => 4,
                                    'md' => 4,
                                    'sm' => 4,
                                ])


                                @include('inputs.textarea', [
                                    'label' => 'dailytask.description',
                                    'livewire' => 'description',
                                ])
                                {{-- @include('inputs.edit.input', [
                                    'label' => 'dailytask.description',
                                    'name' => 'dailytask.description',
                                    'val' => $dailytask->description,
                                    'livewire' => 'description',
                                    'type' => 'text', // 'step' => 1,
                                    // 'required' => 'required',
                                    'lg' => 12,
                                    'md' => 1,
                                    'sm' => 12,
                                ]) --}}



                                @include('inputs.edit.input', [
                                    'label' => 'dailytask.start_time',
                                    'name' => 'dailytask.start_time',
                                    'val' => $dailytask->start_time,
                                    'livewire' => 'start_time',
                                    'type' => 'datetime-local', // 'step' => 1,
                                    'min' => date('Y-m-d\TH:i'),
                                    'lg' => 4,
                                    'md' => 4,
                                    'sm' => 12,
                                ])


                                @include('inputs.edit.input', [
                                    'label' => 'dailytask.end_time',
                                    'name' => 'dailytask.end_time',
                                    'val' => $dailytask->end_time,
                                    'livewire' => 'end_time',
                                    'type' => 'datetime-local', // 'step' => 1,
                                    'min' => date('Y-m-d\TH:i', strtotime($start_time . '+1 Hours')),
                                    'lg' => 4,
                                    'md' => 4,
                                    'sm' => 12,
                                ])
                                {{-- @include('inputs.edit.input', [
                                    'label' => 'dailytask.proearty',
                                    'name' => 'dailytask.proearty',
                                    'val' => $dailytask->proearty,
                                    'livewire' => 'proearty',
                                    'type' => 'text', // 'step' => 1,
                                    // 'required' => 'required',
                                    // 'lg' => 4, 'md' => 4, 'sm' => 12,
                                ]) --}}


                                {{-- @include('inputs.edit.input', [
                                    'label' => 'dailytask.status',
                                    'name' => 'dailytask.status',
                                    'val' => $dailytask->status,
                                    'livewire' => 'status',
                                    'type' => 'text', // 'step' => 1,
                                    // 'required' => 'required',
                                    // 'lg' => 4, 'md' => 4, 'sm' => 12,
                                ]) --}}


                                @include('inputs.edit.input', [
                                    'label' => 'dailytask.repeat_time',
                                    'name' => 'dailytask.repeat_time',
                                    'val' => $dailytask->repeat_time,
                                    'livewire' => 'repeat_time',
                                    'type' => 'time', // 'step' => 1,
                                    // 'required' => 'required',
                                    'lg' => 4,
                                    'md' => 4,
                                    'sm' => 12,
                                ])

                                <div class="col-lg-6 col-md-6 col-sm-12">
                                    <div class="form-group">
                                        <label for="proearty">{{ __('dailytask.proearty') }}</label>
                                        <select wire:model="proearty" name="proearty" id="proearty" class="form-control">
                                            <option value="urgent">{{ __('dailytask.urgent') }}</option>
                                            <option value="high">{{ __('dailytask.high') }}</option>
                                            <option value="medium">{{ __('dailytask.medium') }}</option>
                                            <option value="low">{{ __('dailytask.low') }}</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-lg-6 col-md-6 col-sm-12">
                                    <div class="form-group">
                                        <label for="status">{{ __('dailytask.status') }}</label>
                                        <select wire:model="status" name="status" id="status" class="form-control">
                                            <option value="active">{{ __('dailytask.active') }}</option>
                                            <option value="disabled">{{ __('dailytask.disabled') }}</option>
                                            {{-- <option value="auto-finished">{{ __('dailytask.auto-finished') }}</option>
                                            <option value="manual-finished">{{ __('dailytask.manual-finished') }}</option> --}}
                                            {{-- <option value="draft">{{ __('dailytask.draft') }}</option> --}}
                                        </select>
                                    </div>
                                </div>


                                {{-- @include('inputs.edit.input', [
                                    'label' => 'dailytask.repeat_evrey',
                                    'name' => 'dailytask.repeat_evrey',
                                    'val' => $dailytask->repeat_evrey,
                                    'livewire' => 'repeat_evrey',
                                    'type' => 'time', // 'step' => 1,
                                    // 'required' => 'required',
                                    // 'lg' => 6, 'md' => 6, 'sm' => 12,
                                ]) --}}

                            </div>

                            @role('owner')
                                <div>
                                    <p>{{ __('global.employees') }}</p>
                                    <div class="row">
                                        @foreach ($employees as $employee)
                                            <div class="col-4">
                                                <div class="form-check form-check-inline">
                                                    <input wire:model='selectedEmployees' class="form-check-input"
                                                        type="checkbox" value="{{ $employee->id }}"
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
