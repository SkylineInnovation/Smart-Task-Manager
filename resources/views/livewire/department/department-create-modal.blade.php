@permission('create-department')
<link href="https://cdn.jsdelivr.net/npm/tom-select@2.2.2/dist/css/tom-select.css" rel="stylesheet">

<!-- Tom Select JS -->
<script src="https://cdn.jsdelivr.net/npm/tom-select@2.2.2/dist/js/tom-select.complete.min.js"></script>
    <!-- Modal -->
    <div wire:ignore.self class="modal fade" id="create-new-department-modal" data-backdrop="static" data-keyboard="false"
        tabindex="-1" role="dialog" aria-labelledby="create-new-department-modal-label" aria-hidden="true">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="create-new-department-modal-label">
                        {{ __('global.create-department') }}
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
                                    'label' => 'department.slug',
                                    'name' => 'department.slug',
                                    'livewire' => 'slug',
                                    'type' => 'text', // 'step' => 0.1,
                                    // 'required' => 'required',
                                    'lg' => 12,
                                    'md' => 12,
                                    'sm' => 12,
                                ]) --}}


                                @if (!$the_branch)
                                    @include('inputs.create.select', [
                                        'label' => 'department.branch',
                                        'name' => 'department.branch_id',
                                        'arr' => $branches,
                                        'livewire' => 'branch_id',
                                        // 'required' => 'required', // 'type' => 'number', // 'step' => 1,
                                        'lg' => 12,
                                        'md' => 12,
                                        'sm' => 12,
                                    ])
                                @endif

                                @if (!$the_manager)
                                    {{-- @include('inputs.create.select', [
                                        'label' => 'department.manager',
                                        'name' => 'department.manager_id',
                                        'arr' => $managers,
                                        'livewire' => 'manager_id',
                                        // 'required' => 'required', // 'type' => 'number', // 'step' => 1,
                                        // 'lg' => 6, 'md' => 6, 'sm' => 12,
                                    ]) --}}

                                    {{--  --}}
                                    <div wire:ignore class="form-group col-6">
                                        <label for="manager_id">{{ __('department.manager') }}</label>
                                        <select id="manager_id" multiple class="">
                                            @foreach ($managers as $man)
                                                <option value="{{ $man->id }}"
                                                    @if (in_array($man->id, $selectedManagerD)) selected @endif>
                                                    {{ $man->first_name }}
                                                </option>
                                            @endforeach
                                        </select>
                                        @error('selectedManagerD')
                                            <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>
                                    {{--  --}}


                                    @include('inputs.create.input', [
                                        'label' => 'department.name',
                                        'name' => 'department.name',
                                        'livewire' => 'name',
                                        'type' => 'text', // 'step' => 1,
                                        // 'required' => 'required',
                                        // 'lg' => 6, 'md' => 6, 'sm' => 12,
                                    ])
                                @else
                                    @include('inputs.create.input', [
                                        'label' => 'department.name',
                                        'name' => 'department.name',
                                        'livewire' => 'name',
                                        'type' => 'text', // 'step' => 1,
                                        // 'required' => 'required',
                                        'lg' => 12,
                                        'md' => 12,
                                        'sm' => 12,
                                    ])
                                @endif

                                @include('inputs.create.select', [
                                    'label' => 'department.main_department',
                                    'name' => 'department.main_department_id',
                                    'arr' => $main_departments,
                                    'livewire' => 'main_department_id',
                                    // 'required' => 'required', // 'type' => 'number', // 'step' => 1,
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
            let selectInstance = new TomSelect('#manager_id', {
                plugins: ['remove_button', 'dropdown_input'],
                persist: false,
                create: false,
                closeAfterSelect: true,
                onChange: function(values) {
                    @this.set('selectedManagerD', values);
                },
                maxItems: 200, // Limit the number of selected items
                items: {!! json_encode($selectedManagerD) !!}, // Preselect existing values
                placeholder: "{{ __('department.manager') }}",
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
            document.getElementById('manager_id').addEventListener('change', function(e) {
                @this.set('selectedManagerD', [...this.selectedOptions].map(o => o.value));
            });
        });
    </script>
@endpermission



@permission('edit-department')
    <div wire:ignore.self data-backdrop="static" data-keyboard="true" class="modal fade" id="update-department-modal"
        tabindex="-1" role="dialog" aria-labelledby="update-department-modal-label" aria-hidden="true">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="update-department-modal-label">{{ $department->crud_name() }}</h5>
                    <button wire:click.prevent="cancel()" type="button" class="close" data-dismiss="modal"
                        aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>

                @if ($updateMode)
                    <form enctype="multipart/form-data" method="post" accept-charset="utf-8" class="form-horizontal">
                        <div class="modal-body">
                            <input type="hidden" wire:model="department_id">
                            @csrf

                            <div class="row">

                                {{-- @include('inputs.edit.input', [
                                    'label' => 'department.slug',
                                    'name' => 'department.slug',
                                    'livewire' => 'slug',
                                    'type' => 'text', // 'step' => 0.1,
                                    // 'required' => 'required',
                                    'lg' => 12,
                                    'md' => 12,
                                    'sm' => 12,
                                ]) --}}

                                @if (!$the_branch)
                                    @include('inputs.edit.select', [
                                        'label' => 'department.branch',
                                        'name' => 'department.branch_id',
                                        'arr' => $branches,
                                        'livewire' => 'branch_id',
                                        'val' => $department->branch_id,
                                        // 'required' => 'required', // 'type' => 'number', // 'step' => 1,
                                        'lg' => 12,
                                        'md' => 12,
                                        'sm' => 12,
                                    ])
                                @endif

                                @if (!$the_manager)
                                    @include('inputs.edit.select', [
                                        'label' => 'department.manager',
                                        'name' => 'department.manager_id',
                                        'arr' => $managers,
                                        'livewire' => 'manager_id',
                                        'val' => $department->manager_id,
                                        // 'required' => 'required', // 'type' => 'number', // 'step' => 1,
                                        // 'lg' => 6, 'md' => 6, 'sm' => 12,
                                    ])
                                    @include('inputs.edit.input', [
                                        'label' => 'department.name',
                                        'name' => 'department.name',
                                        'val' => $department->name,
                                        'livewire' => 'name',
                                        'type' => 'text', // 'step' => 1,
                                        // 'required' => 'required',
                                        // 'lg' => 6, 'md' => 6, 'sm' => 12,
                                    ])
                                @else
                                    @include('inputs.edit.input', [
                                        'label' => 'department.name',
                                        'name' => 'department.name',
                                        'val' => $department->name,
                                        'livewire' => 'name',
                                        'type' => 'text', // 'step' => 1,
                                        // 'required' => 'required',
                                        'lg' => 12,
                                        'md' => 12,
                                        'sm' => 12,
                                    ])
                                @endif

                                @include('inputs.edit.select', [
                                    'label' => 'department.main_department',
                                    'name' => 'department.main_department_id',
                                    'arr' => $main_departments,
                                    'livewire' => 'main_department_id',
                                    'val' => $department->main_department_id,
                                    // 'required' => 'required', // 'type' => 'number', // 'step' => 1,
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
