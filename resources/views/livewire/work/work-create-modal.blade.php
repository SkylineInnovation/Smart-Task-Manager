@permission('create-work')
    <link href="https://cdn.jsdelivr.net/npm/tom-select@2.2.2/dist/css/tom-select.css" rel="stylesheet">

    <!-- Tom Select JS -->
    <script src="https://cdn.jsdelivr.net/npm/tom-select@2.2.2/dist/js/tom-select.complete.min.js"></script>
    <!-- Modal -->
    <div wire:ignore.self class="modal fade" id="create-new-work-modal" data-backdrop="static" data-keyboard="false"
        tabindex="-1" role="dialog" aria-labelledby="create-new-work-modal-label" aria-hidden="true">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="create-new-work-modal-label">
                        {{ __('global.create-work') }}
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
                                    'label' => 'work.slug',
                                    'name' => 'work.slug',
                                    'livewire' => 'slug',
                                    'type' => 'text', // 'step' => 0.1,
                                    // 'required' => 'required',
                                    'lg' => 12,
                                    'md' => 12,
                                    'sm' => 12,
                                ]) --}}


                                {{-- @include('inputs.create.select', [
                                    'label' => 'work.manager',
                                    'name' => 'work.manager_id',
                                    'arr' => $managers,
                                    'livewire' => 'manager_id',
                                    // 'required' => 'required', // 'type' => 'number', // 'step' => 1,
                                    'lg' => 12,
                                    'md' => 12,
                                    'sm' => 12,
                                ]) --}}

                                {{--  --}}
                                <div wire:ignore class="form-group col-6">
                                    <label for="manager_id">{{ __('Assign Manager') }}</label>
                                    <select id="manager_id" multiple class="">
                                        @foreach ($managers as $man)
                                            <option value="{{ $man->id }}"
                                                @if (in_array($man->id, $selectedManager)) selected @endif>
                                                {{ $man->first_name }}
                                            </option>
                                        @endforeach
                                    </select>
                                    @error('selectedManager')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                                {{--  --}}

                                @include('inputs.create.select', [
                                    'label' => 'global.branch',
                                    'name' => 'global.branch_id',
                                    'arr' => $branchs,
                                    'livewire' => 'branch_id',
                                    // 'required' => 'required', // 'type' => 'number', // 'step' => 1,
                                    // 'lg' => 6, 'md' => 6, 'sm' => 12,
                                ])
                                @include('inputs.create.select', [
                                    'label' => 'work.department',
                                    'name' => 'work.department_id',
                                    'arr' => $departments,
                                    'livewire' => 'department_id',
                                    // 'required' => 'required', // 'type' => 'number', // 'step' => 1,
                                    // 'lg' => 6, 'md' => 6, 'sm' => 12,
                                ])

                                {{-- @include('inputs.create.select', [
                                    'label' => 'work.user',
                                    'name' => 'work.user_id',
                                    'arr' => $users,
                                    'livewire' => 'user_id',
                                    // 'required' => 'required', // 'type' => 'number', // 'step' => 1,
                                    // 'lg' => 6, 'md' => 6, 'sm' => 12,
                                ]) --}}

                                <div wire:ignore class="form-group col-6">
                                    <label for="user_id">{{ __('work.user') }}</label>
                                    <select id="user_id" multiple class="">
                                        @foreach ($users as $user)
                                            <option value="{{ $user->id }}"
                                                @if (in_array($user->id, $selectedUsers)) selected @endif>
                                                {{ $user->first_name }}
                                            </option>
                                        @endforeach
                                    </select>
                                    @error('selectedUsers')
                                        <span class="text-danger">{{ $message2 }}</span>
                                    @enderror
                                </div>



                                @include('inputs.create.input', [
                                    'label' => 'work.job_title',
                                    'name' => 'work.job_title',
                                    'livewire' => 'job_title',
                                    'type' => 'text', // 'step' => 1,
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

    <script>
        document.addEventListener('livewire:load', function() {
            let selectInstance = new TomSelect('#user_id', {
                plugins: ['remove_button', 'dropdown_input'],
                persist: false,
                create: false,
                closeAfterSelect: true,
                onChange: function(values) {
                    @this.set('selectedUsers', values);
                },
                maxItems: 1, // Limit the number of selected items
                items: {!! json_encode($selectedUsers) !!}, // Preselect existing values
                placeholder: "{{ __('work.user') }}",
                allowEmptyOption: true,
                dropdownConveyor: true,
                render: {
                    item: function(data, escape) {
                        return `<div class="custom-option">${escape(data.text)}</div>`;
                    },
                    option: function(data, escape) {
                        return `<div class="custom-option">${escape(data.text)}</div>`;
                    }
                }
            });




            // Sync back to Livewire on change
            document.getElementById('user_id').addEventListener('change', function(e) {
                @this.set('selectedUsers', [...this.selectedOptions].map(o => o.value));
            });

        });
        document.addEventListener('livewire:load', function() {
            let selectInstance = new TomSelect('#manager_id', {
                plugins: ['remove_button', 'dropdown_input'],
                persist: false,
                create: false,
                closeAfterSelect: true,
                onChange: function(values) {
                    @this.set('selectedManager', values);
                },
                maxItems: 1, // Limit the number of selected items
                items: {!! json_encode($selectedManager) !!}, // Preselect existing values
                placeholder: "{{ __('work.user') }}",
                allowEmptyOption: true,
                dropdownConveyor: true,
                render: {
                    item: function(data, escape) {
                        return `<div class="custom-option">${escape(data.text)}</div>`;
                    },
                    option: function(data, escape) {
                        return `<div class="custom-option">${escape(data.text)}</div>`;
                    }
                }
            });


            document.getElementById('manager_id').addEventListener('change', function(e) {
                @this.set('selectedManager', [...this.selectedOptions].map(o => o.value));
            });
        });
    </script>
@endpermission



@permission('edit-work')
    <div wire:ignore.self data-backdrop="static" data-keyboard="true" class="modal fade" id="update-work-modal"
        tabindex="-1" role="dialog" aria-labelledby="update-work-modal-label" aria-hidden="true">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="update-work-modal-label">{{ $work->crud_name() }}</h5>
                    <button wire:click.prevent="cancel()" type="button" class="close" data-dismiss="modal"
                        aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>

                @if ($updateMode)
                    <form enctype="multipart/form-data" method="post" accept-charset="utf-8" class="form-horizontal">
                        <div class="modal-body">
                            <input type="hidden" wire:model="work_id">
                            @csrf

                            <div class="row">

                                {{-- @include('inputs.edit.input', [
                                    'label' => 'work.slug',
                                    'name' => 'work.slug',
                                    'livewire' => 'slug',
                                    'type' => 'text', // 'step' => 0.1,
                                    // 'required' => 'required',
                                    'lg' => 12,
                                    'md' => 12,
                                    'sm' => 12,
                                ]) --}}


                                @include('inputs.edit.select', [
                                    'label' => 'work.manager',
                                    'name' => 'work.manager_id',
                                    'arr' => $managers,
                                    'livewire' => 'manager_id',
                                    'val' => $work->manager_id,
                                    // 'required' => 'required', // 'type' => 'number', // 'step' => 1,
                                    'lg' => 12,
                                    'md' => 12,
                                    'sm' => 12,
                                ])

                                @include('inputs.edit.select', [
                                    'label' => 'global.branch',
                                    'name' => 'global.branch_id',
                                    'arr' => $branchs,
                                    'livewire' => 'branch_id',
                                    'val' => $work->branch_id,
                                    // 'required' => 'required', // 'type' => 'number', // 'step' => 1,
                                    // 'lg' => 6, 'md' => 6, 'sm' => 12,
                                ])

                                @include('inputs.edit.select', [
                                    'label' => 'work.department',
                                    'name' => 'work.department_id',
                                    'arr' => $departments,
                                    'livewire' => 'department_id',
                                    'val' => $work->department_id,
                                    // 'required' => 'required', // 'type' => 'number', // 'step' => 1,
                                    // 'lg' => 6, 'md' => 6, 'sm' => 12,
                                ])

                                @include('inputs.edit.select', [
                                    'label' => 'work.user',
                                    'name' => 'work.user_id',
                                    'arr' => $users,
                                    'livewire' => 'user_id',
                                    'val' => $work->user_id,
                                    // 'required' => 'required', // 'type' => 'number', // 'step' => 1,
                                    // 'lg' => 6, 'md' => 6, 'sm' => 12,
                                ])
                                @include('inputs.edit.input', [
                                    'label' => 'work.job_title',
                                    'name' => 'work.job_title',
                                    'val' => $work->job_title,
                                    'livewire' => 'job_title',
                                    'type' => 'text', // 'step' => 1,
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
