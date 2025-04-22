<div>
    {{-- Knowing others is intelligence; knowing yourself is true wisdom. --}}
    <!-- Tom Select CSS -->
    <link href="https://cdn.jsdelivr.net/npm/tom-select@2.2.2/dist/css/tom-select.css" rel="stylesheet">

    <!-- Tom Select JS -->
    <script src="https://cdn.jsdelivr.net/npm/tom-select@2.2.2/dist/js/tom-select.complete.min.js"></script>



    <button type="button" class="btn btn-success" data-toggle="modal" data-target="#create-new-task">
        <i class="ti-plus text-white"></i>
    </button>

    <div wire:ignore.self class="modal fade" id="create-new-task" tabindex="-1" role="dialog"
        aria-labelledby="create-new-task-label" aria-hidden="true" data-backdrop="static" data-keyboard="false">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">{{ __('global.creat_task') }}</h5>
                    <button wire:click="cancel()" type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="row w-100 m-0">

                        @role('owner|manager')
                            {{--  --}}
                            <div class='form-group col-lg-6 col-md-6 col-sm-12'>
                                <label for='branch-select'>{{ __('task.branchs') }}</label>
                                <select id='branch-select' class='form-control' wire:model='select_branch'>
                                    <option value="0">{{ __('global.select-branchs') }}</option>
                                    @foreach ($branchs as $branch)
                                        <option value='{{ $branch->id }}'>{{ $branch->crud_name() }}</option>
                                    @endforeach
                                </select>

                                @foreach ($branchs as $branch)
                                    @if (in_array($branch->id, $selectedBranchs))
                                        <div class='form-check form-check-inline'>
                                            <input wire:model='selectedBranchs' class='form-check-input' type='checkbox'
                                                value='{{ $branch->id }}' id='filter-branchs-id-{{ $branch->id }}'>
                                            <label class='form-check-label' for='filter-branchs-id-{{ $branch->id }}'>
                                                {{ $branch->crud_name() }}
                                            </label>
                                        </div>
                                    @endif
                                @endforeach
                            </div>

                            <div class='form-group col-lg-6 col-md-6 col-sm-12'>
                                <label for='department-select'>{{ __('task.departments') }}</label>
                                <select id='department-select' class='form-control' wire:model='select_department'>
                                    <option value="0">{{ __('global.select-departments') }}</option>
                                    @foreach ($departments as $department)
                                        <option value='{{ $department->id }}'>{{ $department->crud_name() }}</option>
                                    @endforeach
                                </select>

                                @foreach ($departments as $department)
                                    @if (in_array($department->id, $selectedDepartments))
                                        <div class='form-check form-check-inline'>
                                            <input wire:model='selectedDepartments' class='form-check-input' type='checkbox'
                                                value='{{ $department->id }}'
                                                id='filter-departments-id-{{ $department->id }}'>
                                            <label class='form-check-label'
                                                for='filter-departments-id-{{ $department->id }}'>
                                                {{ $department->crud_name() }}
                                            </label>
                                        </div>
                                    @endif
                                @endforeach
                            </div>
                        @endrole


                        {{-- <div class='form-group col-lg-6 col-md-6 col-sm-12'>
                            <label for='employee-select'>{{ __('task.employees') }}</label>
                            <select id='employee-select' class='form-control' wire:model='select_emp'>
                                <option>{{ __('global.select-employees') }}</option>
                                @foreach ($employees as $employee)
                                    <option value='{{ $employee->id }}'>{{ $employee->crud_name() }}</option>
                                @endforeach
                            </select>

                            @foreach ($employees as $employee)
                                @if (in_array($employee->id, $selectedEmployees))
                                    <div class='form-check form-check-inline'>
                                        <input wire:model='selectedEmployees' class='form-check-input' type='checkbox'
                                            value='{{ $employee->id }}' id='filter-employees-id-{{ $employee->id }}'>
                                        <label class='form-check-label' for='filter-employees-id-{{ $employee->id }}'>
                                            {{ $employee->crud_name() }}
                                        </label>
                                    </div>
                                @endif
                            @endforeach
                        </div> --}}

                        {{--  --}}
                        {{--  --}}
                        {{--  --}}



                        <div class="form-group col-lg-6 col-md-6 col-sm-12" wire:ignore>
                            <label for="employee-select">{{ __('task.employees') }}</label>

                            <select id="employee-select" multiple class="">
                                @foreach ($employees as $employee)
                                    <option value="{{ $employee->id }}"
                                        @if (in_array($employee->id, $selectedEmployees)) selected @endif>
                                        {{ $employee->crud_name() }}
                                    </option>
                                @endforeach
                            </select>
                        </div>



                        <div class="input-group mb-3 col-lg-8 col-md-8 col-sm-12">
                            <div class="input-group-prepend ">
                                <span class="input-group-text btn-secondary text-white"
                                    id="inputGroup-sizing-default">{{ __('task.title') }}</span>
                            </div>
                            <input wire:model.defer="title" type="text" multiple class="form-control"
                                aria-label="Default" aria-describedby="inputGroup-sizing-default">
                        </div>

                        <div class="input-group mb-3 col-lg-4 col-md-4 col-sm-12">
                            <div class="input-group-prepend ">
                                <span class="input-group-text btn-secondary text-white"
                                    id="inputGroup-sizing-default">{{ __('task.discount') }}</span>
                            </div>
                            <input wire:model.defer="discount" type="number" class="form-control" aria-label="Default"
                                aria-describedby="inputGroup-sizing-default">
                        </div>

                        <div class="input-group mb-3 col-lg-6 col-md-6 col-sm-12">
                            <div class="input-group-prepend ">
                                <span class="input-group-text btn-secondary text-white"
                                    id="inputGroup-sizing-default">{{ __('task.start_time') }}</span>
                            </div>
                            <input wire:model="start_time" type="datetime-local" class="form-control"
                                min="{{ date('Y-m-d\TH:i') }}" aria-label="Default"
                                aria-describedby="inputGroup-sizing-default">
                        </div>

                        <div class="input-group mb-3 col-lg-6 col-md-6 col-sm-12">
                            <div class="input-group-prepend ">
                                <span class="input-group-text btn-secondary text-white"
                                    id="inputGroup-sizing-default">{{ __('task.end_time') }}</span>
                            </div>
                            <input wire:model.defer="end_time" type="datetime-local" class="form-control"
                                min="{{ date('Y-m-d\TH:i', strtotime($start_time . '+1 Hours')) }}"
                                aria-label="Default" aria-label="Default"
                                aria-describedby="inputGroup-sizing-default">
                        </div>

                        @include('inputs.textarea', [
                            'label' => 'task.desc',
                            'livewire' => 'desc',
                        ])
                        {{-- <div wire:ignore.self class="col-md-12"> --}}
                        {{-- <div wire:ignore.self id="summer_desc"></div> --}}
                        {{-- <textarea name='desc' id='desc' rows="4" class='form-control'
                                placeholder='{{ __('global.enter') }} {{ __('task.desc') }}' wire:model.defer="desc"></textarea> --}}
                        {{-- </div> --}}
                    </div>

                    {{--  --}}

                    <div class="form-group">
                        @foreach ($errors->all() as $error)
                            <span class='alert alert-danger btn'>{{ $error }}</span>
                        @endforeach
                    </div>
                </div>
                <div class="modal-footer">
                    <button wire:click="cancel()" type="button" class="btn btn-secondary" data-dismiss="modal">
                        {{ __('global.close') }}
                    </button>

                    <button wire:click="store()" type="submit" class="btn btn-primary">
                        {{ __('global.save-changes') }}
                    </button>
                </div>
            </div>
        </div>
    </div>
</div>



<script>
    document.addEventListener('livewire:load', function() {
        let selectInstance = new TomSelect('#employee-select', {
            plugins: ['remove_button', 'dropdown_input'],
            persist: false,
            create: false,
            closeAfterSelect: true,
            onChange: function(values) {
                @this.set('selectedEmployees', values);
            },
            maxItems: 200, // Limit the number of selected items
            items: {!! json_encode($selectedEmployees) !!}, // Preselect existing values
            placeholder: "{{ __('global.select-employees') }}",
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
        document.getElementById('employee-select').addEventListener('change', function(e) {
            @this.set('selectedEmployees', [...this.selectedOptions].map(o => o.value));
        });
    });
</script>
