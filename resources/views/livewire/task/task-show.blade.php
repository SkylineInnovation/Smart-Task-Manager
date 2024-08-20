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

                <div class="col-lg-6 col-md-6 col-sm-12">
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
            </div>
        </div>

        <div class="card-footer">
            <button type="button" wire:click.prevent="updateTask()" class="btn btn-success">
                {{ __('global.save-changes') }}
            </button>
        </div>

    </div>


</div>
