<div>
    <div class="card">
        <div class="card-body">
            <form enctype="multipart/form-data" method="post" accept-charset="utf-8" class="form-horizontal">
                <div class="modal-body">
                    <input type="hidden" wire:model="dailytask_id">
                    @csrf

                    <div class="row">

                        @include('inputs.show.input', [
                            'label' => 'dailytask.manager',
                            'val' => $dailytask->manager->name(),
                            'lg' => 12,
                            'md' => 12,
                            'sm' => 12,
                        ])
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
                            'label' => 'task.discount',
                            'name' => 'task.discount',
                            'livewire' => 'discount',
                            'val' => $dailytask->discount(),
                            'type' => 'number',
                            'step' => 1,
                            // 'required' => 'required',
                            'lg' => 4,
                            'md' => 4,
                            'sm' => 4,
                        ])


                        @include('inputs.edit.input', [
                            'label' => 'dailytask.description',
                            'name' => 'dailytask.description',
                            'val' => $dailytask->description,
                            'livewire' => 'description',
                            'type' => 'text', // 'step' => 1,
                            // 'required' => 'required',
                            'lg' => 12,
                            'md' => 1,
                            'sm' => 12,
                        ])

                        @include('inputs.edit.input', [
                            'label' => 'dailytask.start_time',
                            'name' => 'dailytask.start_time',
                            'val' => $dailytask->start_time,
                            'livewire' => 'start_time',
                            'type' => 'datetime-local', // 'step' => 1,
                            // 'required' => 'required',
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
                            // 'required' => 'required',
                            'lg' => 4,
                            'md' => 4,
                            'sm' => 12,
                        ])

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
                                    <option value="low">{{ __('dailytask.low') }}</option>
                                    <option value="medium">{{ __('dailytask.medium') }}</option>
                                    <option value="high">{{ __('dailytask.high') }}</option>
                                </select>
                            </div>
                        </div>
                        <div class="col-lg-6 col-md-6 col-sm-12">
                            <div class="form-group">
                                <label for="status">{{ __('task.status') }}</label>
                                <select wire:model="status" name="status" id="status" class="form-control">
                                    <option value="pending">{{ __('task.pending') }}</option>
                                    <option value="active">{{ __('task.active') }}</option>
                                    {{-- <option value="auto-finished">{{ __('dailytask.auto-finished') }}</option>
                                    <option value="manual-finished">{{ __('dailytask.manual-finished') }}</option> --}}
                                    {{-- <option value="draft">{{ __('task.draft') }}</option> --}}
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
        </div>
    </div>
</div>
