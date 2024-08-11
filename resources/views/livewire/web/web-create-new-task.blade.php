<div>
    {{-- Knowing others is intelligence; knowing yourself is true wisdom. --}}

    <button type="button" class="btn btn-success" data-toggle="modal" data-target="#create-new-task">
        <i class="ti-plus text-white"></i>
    </button>

    <div wire:ignore.self class="modal fade" id="create-new-task" tabindex="-1" role="dialog"
        aria-labelledby="create-new-task-label" aria-hidden="true">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">{{ __('global.creat task') }}</h5>
                    <button wire:click="cancel()" type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="row w-100 m-0">
                        <div class='form-group col-6'>
                            <label for='employee-select'>{{ __('task.employees') }}</label>
                            <select id='employee-select' class='form-control' wire:model='select_emp'>
                                <option>Select employees</option>
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
                        </div>

                        <div class="form-group col-md-6">
                            <label for="exampleFormControlSelect1">proearty</label>
                            <select wire:model.defer="priority_level" class="form-control">
                                <option value="low">low</option>
                                <option value="medum">medum</option>
                                <option value="high">high</option>
                            </select>
                        </div>

                        <div class="input-group mb-3 col-md-8">
                            <div class="input-group-prepend ">
                                <span class="input-group-text btn-secondary text-white"
                                    id="inputGroup-sizing-default">{{ __('task.title') }}</span>
                            </div>
                            <input wire:model.defer="title" type="text" multiple class="form-control"
                                aria-label="Default" aria-describedby="inputGroup-sizing-default">
                        </div>
                        <div class="input-group mb-3 col-md-4">
                            <div class="input-group-prepend ">
                                <span class="input-group-text btn-secondary text-white"
                                    id="inputGroup-sizing-default">{{ __('task.discount') }}</span>
                            </div>
                            <input wire:model.defer="discount" type="number" class="form-control" aria-label="Default"
                                aria-describedby="inputGroup-sizing-default">
                        </div>



                        <div class="input-group mb-3  col-md-6">
                            <div class="input-group-prepend ">
                                <span class="input-group-text btn-secondary text-white"
                                    id="inputGroup-sizing-default">{{ __('task.start_time') }}</span>
                            </div>
                            <input wire:model.defer="start_time" type="datetime-local" class="form-control"
                                aria-label="Default" aria-describedby="inputGroup-sizing-default">
                        </div>

                        <div class="input-group mb-3  col-md-6">
                            <div class="input-group-prepend ">
                                <span class="input-group-text btn-secondary text-white"
                                    id="inputGroup-sizing-default">{{ __('task.end_time') }}</span>
                            </div>
                            <input wire:model.defer="end_time" type="datetime-local" class="form-control"
                                aria-label="Default" aria-describedby="inputGroup-sizing-default">
                        </div>


                        <div wire:ignore.self class="col-md-12">
                            {{-- <div wire:ignore.self id="summer_desc"></div> --}}

                            <textarea name='desc' id='desc' rows="4" class='form-control'
                                placeholder='{{ __('global.enter') }} {{ __('task.desc') }}' wire:model="desc"></textarea>
                        </div>

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
                        Close
                    </button>

                    <button wire:click="store()" type="submit" class="btn btn-primary">
                        Save Changes
                    </button>
                </div>
            </div>
        </div>
    </div>
</div>
