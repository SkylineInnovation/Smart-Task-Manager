<div>
    {{-- In work, do what you enjoy. --}}

    <div class="card">
        <div class="card-body">
            <div class="row">
                @include('inputs.show.input', [
                    'label' => 'task.manager',
                    'val' => $task->manager->name(),
                    'lg' => 12,
                    'md' => 12,
                    'sm' => 12,
                ])

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

                <div class="col-lg-6 col-md-6 col-sm-12">
                    <div class="form-group">
                        <label for="priority_level">{{ __('task.priority_level') }}</label>
                        <select wire:model="priority_level" name="priority_level" id="priority_level" class="form-control">
                            <option value="low">{{ __('task.low') }}</option>
                            <option value="medium">{{ __('task.medium') }}</option>
                            <option value="high">{{ __('task.high') }}</option>
                        </select>
                    </div>
                </div>

                <div class="col-lg-4 col-md-4 col-sm-10">
                    <div class="form-group">
                        <label for="status">{{ __('task.status') }}</label>
                        <select wire:model="status" name="status" id="status" class="form-control">
                            <option value="pending">{{ __('task.pending') }}</option>
                            <option value="active">{{ __('task.active') }}</option>
                            <option value="auto-finished">{{ __('task.auto-finished') }}</option>
                            <option value="manual-finished">{{ __('task.manual-finished') }}</option>
                            <option value="draft">{{ __('task.draft') }}</option>
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


</div>
