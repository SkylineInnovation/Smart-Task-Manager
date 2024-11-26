<!-- Modal -->
<div wire:ignore.self class="modal fade" id="create-new-user-modal" data-backdrop="static" data-keyboard="false"
    tabindex="-1" role="dialog" aria-labelledby="create-new-user-modal-label" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="create-new-user-modal-label">
                    {{ __('global.create-user') }}
                </h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>

            <form enctype="multipart/form-data" method="post" accept-charset="utf-8" class="form-horizontal">
                <div class="modal-body">
                    @csrf

                    <div class="row">

                        @include('inputs.create.input', [
                            'label' => 'userdetail.title',
                            'name' => 'userdetail.title',
                            'livewire' => 'title',
                            'type' => 'text', // 'step' => 1,
                            // 'required' => 'required',
                            'lg' => 4,
                            'md' => 4,
                            'sm' => 12,
                        ])

                        @include('inputs.create.input', [
                            'label' => 'user.first_name',
                            'name' => 'user.first_name',
                            'livewire' => 'first_name',
                            'lg' => 4,
                            'md' => 4,
                            'sm' => 6,
                        ])

                        @include('inputs.create.input', [
                            'label' => 'user.last_name',
                            'name' => 'last_name',
                            'livewire' => 'last_name',
                            'lg' => 4,
                            'md' => 4,
                            'sm' => 6,
                        ])

                        {{-- @include('inputs.create.input', [
                            'label' => 'user.user_name',
                            'name' => 'user_name',
                            'livewire' => 'user_name',
                            'lg' => 12, 'md' => 12, 'sm' => 12,
                        ]) --}}

                        @include('inputs.create.input', [
                            'label' => 'user.email',
                            'name' => 'email',
                            'livewire' => 'email',
                            'type' => 'email',
                        ])

                        @include('inputs.create.input', [
                            'label' => 'user.phone',
                            'name' => 'phone',
                            'livewire' => 'phone',
                            'type' => 'tel',
                        ])

                        @include('inputs.create.input', [
                            'label' => 'user.password',
                            'name' => 'password',
                            'livewire' => 'password',
                            // 'type' => 'password',
                            'lg' => 12,
                            'md' => 12,
                        ])

                        @include('inputs.create.input', [
                            'label' => 'userdetail.nationality',
                            'name' => 'userdetail.nationality',
                            'livewire' => 'nationality',
                            'type' => 'text', // 'step' => 1,
                            // 'required' => 'required',
                            'lg' => 3,
                            'md' => 3,
                            'sm' => 6,
                        ])
                        @include('inputs.create.input', [
                            'label' => 'userdetail.id_number',
                            'name' => 'userdetail.id_number',
                            'livewire' => 'id_number',
                            'type' => 'text', // 'step' => 1,
                            // 'required' => 'required',
                            'lg' => 3,
                            'md' => 3,
                            'sm' => 6,
                        ])
                        @include('inputs.create.input', [
                            'label' => 'userdetail.address',
                            'name' => 'userdetail.address',
                            'livewire' => 'address',
                            'type' => 'text', // 'step' => 1,
                            // 'required' => 'required',
                            'lg' => 3,
                            'md' => 3,
                            'sm' => 6,
                        ])
                        @include('inputs.create.input', [
                            'label' => 'userdetail.qualification',
                            'name' => 'userdetail.qualification',
                            'livewire' => 'qualification',
                            'type' => 'text', // 'step' => 1,
                            // 'required' => 'required',
                            'lg' => 3,
                            'md' => 3,
                            'sm' => 6,
                        ])

                        {{--  --}}

                        @include('inputs.create.input', [
                            'label' => 'userdetail.salary',
                            'name' => 'userdetail.salary',
                            'livewire' => 'salary',
                            'type' => 'number',
                            'step' => 1,
                            // 'required' => 'required',
                            'lg' => 4,
                            'md' => 4,
                            'sm' => 12,
                        ])

                        @include('inputs.create.input', [
                            'label' => 'userdetail.home',
                            'name' => 'userdetail.home',
                            'livewire' => 'home',
                            'type' => 'number',
                            'step' => 1,
                            // 'required' => 'required',
                            'lg' => 4,
                            'md' => 4,
                            'sm' => 12,
                        ])

                        @include('inputs.create.input', [
                            'label' => 'userdetail.transport',
                            'name' => 'userdetail.transport',
                            'livewire' => 'transport',
                            'type' => 'number',
                            'step' => 1,
                            // 'required' => 'required',
                            'lg' => 4,
                            'md' => 4,
                            'sm' => 12,
                        ])

                        @include('inputs.create.select', [
                            'label' => 'userdetail.branch',
                            'name' => 'userdetail.branch_id',
                            'arr' => $branches,
                            'livewire' => 'branch_id',
                            // 'required' => 'required', // 'type' => 'number', // 'step' => 1,
                            'lg' => 12,
                            'md' => 12,
                            'sm' => 12,
                        ])
                    </div>

                    @role('owner')
                        <div>
                            <p>{{ __('global.roles') }}</p>
                            <div class="row">
                                @foreach ($roles as $role)
                                    <div class="col-4">
                                        <div class="form-check form-check-inline">
                                            <input wire:model='selectedRoles' class="form-check-input" type="checkbox"
                                                value="{{ $role->id }}" id="selected-role-{{ $role->id }}">
                                            <label class="form-check-label" for="selected-role-{{ $role->id }}">
                                                {{ $role->display_name }}
                                            </label>
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                        </div>
                    @endrole

                    @role('owner|manager')
                        <div>
                            <p>{{ __('global.departments') }}</p>
                            <div class="row">
                                @foreach ($departments as $department)
                                    <div class="col-4">
                                        <div class="form-check form-check-inline">
                                            <input wire:model='selectedDepartments' class="form-check-input" type="checkbox"
                                                value="{{ $department->id }}"
                                                id="selected-department-{{ $department->id }}">
                                            <label class="form-check-label" for="selected-department-{{ $department->id }}">
                                                {{ $department->name }}
                                            </label>
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                        </div>
                    @endrole

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

                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary close-btn" data-dismiss="modal">
                        {{ __('global.close') }}
                    </button>
                    <button type="submit" wire:click.prevent="store()" class="btn btn-success close-modal">
                        {{ __('global.save-changes') }}
                    </button>
                </div>
            </form>

        </div>
    </div>
</div>

{{--  --}}
{{--  --}}
{{--  --}}
{{--  --}}
{{--  --}}
{{--  --}}

<div wire:ignore.self data-backdrop="static" data-keyboard="true" class="modal fade" id="update-user-modal"
    tabindex="-1" role="dialog" aria-labelledby="update-user-modal-label" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="update-user-modal-label">{{ $first_name }} {{ $last_name }}</h5>
                <button wire:click.prevent="cancel()" type="button" class="close" data-dismiss="modal"
                    aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form enctype="multipart/form-data" method="post" accept-charset="utf-8" class="form-horizontal">
                <div class="modal-body">
                    <input type="hidden" wire:model="user_id">
                    @csrf

                    <div class="row">

                        @include('inputs.edit.input', [
                            'label' => 'userdetail.title',
                            'name' => 'userdetail.title',
                            'livewire' => 'title',
                            'val' => $title,
                            'lg' => 4,
                            'md' => 4,
                            'sm' => 12,
                        ])

                        @include('inputs.edit.input', [
                            'label' => 'user.first_name',
                            'name' => 'user.first_name',
                            'livewire' => 'first_name',
                            'val' => $first_name,
                            'lg' => 4,
                            'md' => 4,
                            'sm' => 6,
                        ])

                        @include('inputs.edit.input', [
                            'label' => 'user.last_name',
                            'name' => 'last_name',
                            'livewire' => 'last_name',
                            'val' => $last_name,
                            'lg' => 4,
                            'md' => 4,
                            'sm' => 6,
                        ])

                        {{-- @include('inputs.edit.input', [
                            'label' => 'user.user_name',
                            'name' => 'user_name',
                            'livewire' => 'user_name',
                            'val' => $user_name,
                            'lg' => 12, 'md' => 12, 'sm' => 12,
                        ]) --}}

                        @include('inputs.edit.input', [
                            'label' => 'user.email',
                            'name' => 'email',
                            'livewire' => 'email',
                            'type' => 'email',
                            'val' => $email,
                        ])

                        @include('inputs.edit.input', [
                            'label' => 'user.phone',
                            'name' => 'phone',
                            'livewire' => 'phone',
                            'type' => 'tel',
                            'val' => $phone,
                        ])

                        @include('inputs.edit.input', [
                            'label' => 'user.password',
                            'name' => 'password',
                            'livewire' => 'password',
                            // 'type' => 'password',
                            'val' => $password,
                            'lg' => 12,
                            'md' => 12,
                        ])

                        @include('inputs.edit.input', [
                            'label' => 'userdetail.nationality',
                            'name' => 'nationality',
                            'livewire' => 'nationality',
                            'val' => $nationality,
                            'lg' => 3,
                            'md' => 3,
                            'sm' => 6,
                        ])
                        @include('inputs.edit.input', [
                            'label' => 'userdetail.id_number',
                            'name' => 'id_number',
                            'livewire' => 'id_number',
                            'val' => $id_number,
                            'lg' => 3,
                            'md' => 3,
                            'sm' => 6,
                        ])
                        @include('inputs.edit.input', [
                            'label' => 'userdetail.address',
                            'name' => 'address',
                            'livewire' => 'address',
                            'val' => $address,
                            'lg' => 3,
                            'md' => 3,
                            'sm' => 6,
                        ])
                        @include('inputs.edit.input', [
                            'label' => 'userdetail.qualification',
                            'name' => 'qualification',
                            'livewire' => 'qualification',
                            'val' => $qualification,
                            'lg' => 3,
                            'md' => 3,
                            'sm' => 6,
                        ])

                        {{--  --}}
                        @include('inputs.edit.input', [
                            'label' => 'userdetail.salary',
                            'name' => 'salary',
                            'livewire' => 'salary',
                            'val' => $salary,
                            'lg' => 4,
                            'md' => 4,
                            'sm' => 12,
                        ])
                        @include('inputs.edit.input', [
                            'label' => 'userdetail.home',
                            'name' => 'home',
                            'livewire' => 'home',
                            'val' => $home,
                            'lg' => 4,
                            'md' => 4,
                            'sm' => 12,
                        ])
                        @include('inputs.edit.input', [
                            'label' => 'userdetail.transport',
                            'name' => 'transport',
                            'livewire' => 'transport',
                            'val' => $transport,
                            'lg' => 4,
                            'md' => 4,
                            'sm' => 12,
                        ])

                        {{--  --}}

                        @include('inputs.edit.select', [
                            'label' => 'userdetail.branch',
                            'name' => 'userdetail.branch_id',
                            'arr' => $branches,
                            'livewire' => 'branch_id',
                            'val' => $branch_id,
                            // 'required' => 'required', // 'type' => 'number', // 'step' => 1,
                            'lg' => 12,
                            'md' => 12,
                            'sm' => 12,
                        ])

                    </div>

                    @role('owner')
                        <div>
                            <p>{{ __('global.roles') }}</p>
                            <div class="row">
                                @foreach ($roles as $role)
                                    <div class="col-4">
                                        <div class="form-check form-check-inline">
                                            <input wire:model='selectedRoles' class="form-check-input" type="checkbox"
                                                value="{{ $role->id }}" id="selected-role-{{ $role->id }}">
                                            <label class="form-check-label" for="selected-role-{{ $role->id }}">
                                                {{ $role->display_name }}
                                            </label>
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                        </div>
                    @endrole

                    @role('owner|manager')
                        @if ($edit_user && ($edit_user->hasRole('manager') || $edit_user->hasRole('owner')))
                            <div>
                                <p>{{ __('global.departments') }}</p>
                                <div class="row">
                                    @foreach ($departments as $department)
                                        <div class="col-4">
                                            <div class="form-check form-check-inline">
                                                <input wire:model='selectedDepartments' class="form-check-input"
                                                    type="checkbox" value="{{ $department->id }}"
                                                    id="selected-department-{{ $department->id }}">
                                                <label class="form-check-label"
                                                    for="selected-department-{{ $department->id }}">
                                                    {{ $department->name }}
                                                </label>
                                            </div>
                                        </div>
                                    @endforeach
                                </div>
                            </div>
                        @endif
                    @endrole

                    @role('owner')
                        @if ($edit_user && ($edit_user->hasRole('manager') || $edit_user->hasRole('owner')))
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
                        @endif
                    @endrole

                    <div class="form-group">

                        @foreach ($errors->all() as $error)
                            <span class='alert alert-danger btn'>{{ $error }}</span>
                        @endforeach

                    </div>

                </div>
                {{--  --}}
                <div class="modal-footer">
                    <button type="button" wire:click.prevent="cancel()" class="btn btn-secondary close-btn"
                        data-dismiss="modal">{{ __('global.close') }}</button>
                    <button type="button" wire:click.prevent="update()" class="btn btn-success close-modal"
                        data-dismiss="modal">
                        {{ __('global.save-changes') }}
                    </button>
                </div>
                {{--  --}}
            </form>

        </div>
    </div>
</div>
