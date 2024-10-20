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
                            'label' => 'user.first_name',
                            'name' => 'user.first_name',
                            'livewire' => 'first_name',
                        ])

                        @include('inputs.create.input', [
                            'label' => 'user.last_name',
                            'name' => 'last_name',
                            'livewire' => 'last_name',
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

                        {{-- <div class="col-lg-6 col-md-6 col-sm-12">
                            <div class="form-group">
                                <label for="gender">{{ __('user.gender') }}</label>
                                <select name="gender" id="gender"
                                    class="form-control @error('gender') is-invalid @enderror">
                                    <option value="male">Male</option>
                                    <option value="female">Female</option>
                                </select>

                                @error('gender')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div> --}}

                        {{-- @include('inputs.create.input', [
                            'label' => 'user.birth_day',
                            'name' => 'birth_day',
                            'livewire' => 'birth_day',
                            'type' => 'date',
                            'min' => date('Y-m-d\TH:i'),
                        ]) --}}
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

                    @role('owner')
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

                        @error('first_name')
                            <span class='alert alert-danger btn'>{{ $message }}</span>
                        @enderror

                        @error('user_name')
                            <span class='alert alert-danger btn'>{{ $message }}</span>
                        @enderror

                        @error('email')
                            <span class='alert alert-danger btn'>{{ $message }}</span>
                        @enderror

                        @error('phone')
                            <span class='alert alert-danger btn'>{{ $message }}</span>
                        @enderror

                        @error('password')
                            <span class='alert alert-danger btn'>{{ $message }}</span>
                        @enderror

                        @error('selectedShopBranchs')
                            <span class='alert alert-danger btn'>{{ $message }}</span>
                        @enderror
                        @error('selectedRoles')
                            <span class='alert alert-danger btn'>{{ $message }}</span>
                        @enderror

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
                            'label' => 'user.first_name',
                            'name' => 'user.first_name',
                            'livewire' => 'first_name',
                            'val' => $first_name,
                        ])

                        @include('inputs.edit.input', [
                            'label' => 'user.last_name',
                            'name' => 'last_name',
                            'livewire' => 'last_name',
                            'val' => $last_name,
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

                        {{-- <div class="col-lg-6 col-md-6 col-sm-12">
                            <div class="form-group">
                                <label for="gender">{{ __('user.gender') }}</label>
                                <select name="gender" id="gender"
                                    class="form-control @error('gender') is-invalid @enderror">
                                    <option @if ($gender == 'male') selected @endif value="male">Male</option>
                                    <option @if ($gender == 'female') selected @endif value="female">Female</option>
                                </select>

                                @error('gender')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div> --}}

                        {{-- @include('inputs.create.input', [
                            'label' => 'user.birth_day',
                            'name' => 'birth_day',
                            'livewire' => 'birth_day',
                            'val' => $birth_day,
                            'type' => 'date',
                            'min' => date('Y-m-d\TH:i'),
                        ]) --}}
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

                    @role('owner')
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
                    @endrole

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

                        @error('first_name')
                            <span class='alert alert-danger btn'>{{ $message }}</span>
                        @enderror

                        @error('user_name')
                            <span class='alert alert-danger btn'>{{ $message }}</span>
                        @enderror

                        @error('email')
                            <span class='alert alert-danger btn'>{{ $message }}</span>
                        @enderror

                        @error('phone')
                            <span class='alert alert-danger btn'>{{ $message }}</span>
                        @enderror

                        @error('password')
                            <span class='alert alert-danger btn'>{{ $message }}</span>
                        @enderror

                        @error('selectedShopBranchs')
                            <span class='alert alert-danger btn'>{{ $message }}</span>
                        @enderror
                        @error('selectedRoles')
                            <span class='alert alert-danger btn'>{{ $message }}</span>
                        @enderror

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
