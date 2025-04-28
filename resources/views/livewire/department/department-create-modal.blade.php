@permission('create-department')

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
                                    {{-- // TODO search --}}
                                    @include('inputs.create.select', [
                                        'label' => 'department.manager',
                                        'name' => 'department.manager_id',
                                        'arr' => $managers,
                                        'livewire' => 'manager_id',
                                        // 'required' => 'required', // 'type' => 'number', // 'step' => 1,
                                        // 'lg' => 6, 'md' => 6, 'sm' => 12,
                                    ])

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
