<div>

    @include('livewire.department.department-top')

    @if (session()->has('message'))
        <div class="alert alert-success" style="margin-top:30px;">
            {{ session('message') }}
        </div>
    @endif

    @php
        $number = ($departments->currentPage() - 1) * $perPage;
    @endphp

    <div class="table-responsive">
        <table class="table table-bordered">
            <thead>
                <tr>
                    <td>#</td>

                    {{-- 
                        @if ($admin_view_status != 'deleted')
                            <td style="width: 75px"> {{ __('global.select') }} </td>
                        @endif
                    --}}

                    @if ($showColumn['id'])
                        <td>{{ __('global.id') }}</td>
                    @endif

                    @if ($showColumn['slug'])
                        <td>{{ __('global.slug') }}</td>
                    @endif

                    @if ($showColumn['name'])
                        <td>{{ __('department.name') }}</td>
                    @endif

                    @if ($showColumn['branch_id'])
                        <td>{{ __('department.branch') }}</td>
                    @endif

                    @if ($showColumn['area_id'])
                        <td>{{ __('department.area') }}</td>
                    @endif

                    @if ($showColumn['manager_id'])
                        <td>{{ __('department.manager') }}</td>
                    @endif

                    @if ($showColumn['main_department_id'])
                        <td>{{ __('department.main_department') }}</td>
                    @endif

                    @if ($showColumn['employee'])
                        <td>{{ __('department.employee') }}</td>
                    @endif


                    @if ($showColumn['date'])
                        <td>{{ __('global.date') }}</td>
                    @endif
                    @if ($showColumn['time'])
                        <td>{{ __('global.time') }}</td>
                    @endif

                    @permission('edit-department|delete-department|restore-department')
                        <td style="width: 150px">
                            {{ __('global.action') }}
                        </td>
                    @endpermission

                </tr>
            </thead>
            <tbody>
                @foreach ($departments as $department)
                    <tr>
                        <td>{{ ++$number }}</td>

                        {{-- 
                            @if ($admin_view_status != 'deleted')
                                <td>
                                    <div class="form-check">
                                        <input wire:model.defer="selectedDepartments.{{ $department->id }}" class="form-check-input"
                                            type="checkbox" value="{{ $department->id }}" id="department-{{ $department->id }}">
                                    </div>
                                </td>
                            @endif
                        --}}

                        @if ($showColumn['id'])
                            <td> {{ $department->id }} </td>
                        @endif

                        @if ($showColumn['slug'])
                            <td> {{ $department->slug }} </td>
                        @endif

                        @if ($showColumn['name'])
                            <td> {{ $department->name }} </td>
                        @endif


                        @if ($showColumn['branch_id'])
                            <td>
                                @if ($department->branch)
                                    {{ $department->branch->crud_name() }}
                                @endif
                            </td>
                        @endif
                        @if ($showColumn['area_id'])
                            <td>
                                @if ($department->branch && $department->branch->area)
                                    {{ $department->branch->area->crud_name() }}
                                @endif
                            </td>
                        @endif

                        @if ($showColumn['manager_id'])
                            <td>
                                @if ($department->manager)
                                    {{ $department->manager->crud_name() }}
                                @endif
                            </td>
                        @endif

                        @if ($showColumn['main_department_id'])
                            <td>
                                @if ($department->main_department)
                                    {{ $department->main_department->crud_name() }}
                                @endif
                            </td>
                        @endif

                        @if ($showColumn['employee'])
                            <td>
                                {{ $department->employees->count() }}
                            </td>
                        @endif


                        @if ($showColumn['date'])
                            <td> {{ date('d/m/Y', strtotime($department->created_at)) }} </td>
                        @endif
                        @if ($showColumn['time'])
                            <td> {{ date('h:i A', strtotime($department->created_at)) }} </td>
                        @endif

                        @permission('edit-department|delete-department|restore-department')
                            <td>
                                @if ($admin_view_status != 'deleted')
                                    @permission('edit-department')
                                        <button data-toggle="modal" data-target="#update-department-modal"
                                            wire:click="edit({{ $department->id }})" class="btn btn-primary">
                                            <i class="ti-pencil text-white"></i>
                                        </button>
                                    @endpermission

                                    @permission('delete-department')
                                        <button class="btn btn-danger" type="button" data-toggle="modal"
                                            data-target="#delete-department-{{ $department->id }}">
                                            <i class="ti-trash text-white"></i>
                                        </button>

                                        <div id="delete-department-{{ $department->id }}" class="modal fade" tabindex="-1"
                                            role="dialog" aria-labelledby="delete-department-{{ $department->id }}-title"
                                            aria-hidden="true">
                                            <div class="modal-dialog" role="document">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <h5 class="modal-title"
                                                            id="delete-department-{{ $department->id }}-title">
                                                            {{ $department->crud_name() }}
                                                        </h5>
                                                        <button class="close" data-dismiss="modal" aria-label="Close">
                                                            <span aria-hidden="true">&times;</span>
                                                        </button>
                                                    </div>
                                                    <div class="modal-body">
                                                        <h2>{{ __('global.confirm-delete') }} ?</h2>
                                                    </div>
                                                    <div class="modal-footer">

                                                        <button type="button" class="btn btn-secondary close-btn"
                                                            data-dismiss="modal">
                                                            {{ __('global.close') }}
                                                        </button>

                                                        <button wire:click="delete({{ $department->id }})"
                                                            class="btn btn-danger" data-dismiss="modal">
                                                            {{ __('global.delete') }}
                                                        </button>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    @endpermission
                                @endif

                                @if ($admin_view_status == 'deleted')
                                    @permission('restore-department')
                                        <button class="btn btn-danger" type="button" data-toggle="modal"
                                            data-target="#restore-department-{{ $department->id }}">
                                            <i class="ti-reload text-white"></i>
                                        </button>

                                        <div wire:ignore.self id="restore-department-{{ $department->id }}"
                                            aria-labelledby="restore-department-{{ $department->id }}-title" class="modal fade"
                                            tabindex="-1" role="dialog" aria-hidden="true">
                                            <div class="modal-dialog" role="document">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <h5 class="modal-title"
                                                            id="restore-department-{{ $department->id }}-title">
                                                            {{ $department->crud_name() }}
                                                        </h5>
                                                        <button class="close" data-dismiss="modal" aria-label="Close">
                                                            <span aria-hidden="true">&times;</span>
                                                        </button>
                                                    </div>
                                                    <div class="modal-body">
                                                        <h2>{{ __('global.confirm-restore') }} ?</h2>
                                                    </div>
                                                    <div class="modal-footer">

                                                        <button type="button" class="btn btn-secondary close-btn"
                                                            data-dismiss="modal">
                                                            {{ __('global.close') }}
                                                        </button>

                                                        <button wire:click="restore({{ $department->id }})"
                                                            class="btn btn-danger" data-dismiss="modal">
                                                            {{ __('global.restore') }}
                                                        </button>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    @endpermission
                                @endif

                            </td>
                        @endpermission
                    </tr>
                @endforeach
            </tbody>

        </table>

        {{ $departments->links() }}
    </div>
</div>
