<div>

    @include('livewire.leave.leave-top')

    @if (session()->has('message'))
        <div class="alert alert-success" style="margin-top:30px;">
            {{ session('message') }}
        </div>
    @endif

    @php
        $number = ($leaves->currentPage() - 1) * $perPage;
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


                    @if ($showColumn['task_id'])
                        <td>{{ __('leave.task') }}</td>
                    @endif

                    @if ($showColumn['user_id'])
                        <td>{{ __('leave.user') }}</td>
                    @endif

                    @if ($showColumn['type'])
                        <td>{{ __('leave.type') }}</td>
                    @endif

                    @if ($showColumn['time_out'])
                        <td>{{ __('leave.time_out') }}</td>
                    @endif

                    @if ($showColumn['time_in'])
                        <td>{{ __('leave.time_in') }}</td>
                    @endif

                    @if ($showColumn['reason'])
                        <td>{{ __('leave.reason') }}</td>
                    @endif

                    @if ($showColumn['result'])
                        <td>{{ __('leave.result') }}</td>
                    @endif

                    @if ($showColumn['status'])
                        <td>{{ __('leave.status') }}</td>
                    @endif

                    @if ($showColumn['accepted_by_user_id'])
                        <td>{{ __('leave.accepted_by_user') }}</td>
                    @endif

                    @if ($showColumn['accepted_time'])
                        <td>{{ __('leave.accepted_time') }}</td>
                    @endif


                    @if ($showColumn['date'])
                        <td>{{ __('global.date') }}</td>
                    @endif
                    @if ($showColumn['time'])
                        <td>{{ __('global.time') }}</td>
                    @endif

                    @permission('edit-leave|delete-leave|restore-leave')
                        <td style="width: 150px">
                            {{ __('global.action') }}
                        </td>
                    @endpermission

                </tr>
            </thead>
            <tbody>
                @foreach ($leaves as $leave)
                    <tr>
                        <td>{{ ++$number }}</td>

                        {{-- 
                            @if ($admin_view_status != 'deleted')
                                <td>
                                    <div class="form-check">
                                        <input wire:model.defer="selectedLeaves.{{ $leave->id }}" class="form-check-input"
                                            type="checkbox" value="{{ $leave->id }}" id="leave-{{ $leave->id }}">
                                    </div>
                                </td>
                            @endif
                        --}}

                        @if ($showColumn['id'])
                            <td> {{ $leave->id }} </td>
                        @endif

                        @if ($showColumn['slug'])
                            <td> {{ $leave->slug }} </td>
                        @endif


                        @if ($showColumn['task_id'])
                            <td>
                                @if ($leave->task)
                                    {{ $leave->task->crud_name() }}
                                @endif
                            </td>
                        @endif

                        @if ($showColumn['user_id'])
                            <td>
                                @if ($leave->user)
                                    {{ $leave->user->crud_name() }}
                                @endif
                            </td>
                        @endif

                        @if ($showColumn['type'])
                            <td> {{ $leave->the_type() }} </td>
                        @endif

                        @if ($showColumn['time_out'])
                            {{-- <td> {{ date('Y-m-d h:i A', strtotime($leave->time_out)) }} </td> --}}
                            <td> {{ $leave->time_out }} </td>
                        @endif

                        @if ($showColumn['time_in'])
                            {{-- <td> {{ date('Y-m-d h:i A', strtotime($leave->time_in)) }} </td> --}}
                            <td> {{ $leave->time_in }} </td>
                        @endif

                        @if ($showColumn['reason'])
                            <td> {{ $leave->reason }} </td>
                        @endif

                        @if ($showColumn['result'])
                            <td> {{ $leave->result }} </td>
                        @endif

                        @if ($showColumn['status'])
                            <td> {{ $leave->the_status() }} </td>
                        @endif

                        @if ($showColumn['accepted_by_user_id'])
                            <td>
                                @if ($leave->accepted_by_user)
                                    {{ $leave->accepted_by_user->crud_name() }}
                                @endif
                            </td>
                        @endif

                        @if ($showColumn['accepted_time'])
                            <td> {{ $leave->accepted_time }} </td>
                        @endif


                        @if ($showColumn['date'])
                            <td> {{ date('d/m/Y', strtotime($leave->created_at)) }} </td>
                        @endif
                        @if ($showColumn['time'])
                            <td> {{ date('h:i A', strtotime($leave->created_at)) }} </td>
                        @endif

                        @permission('edit-leave|delete-leave|restore-leave')
                            <td>
                                @if ($admin_view_status != 'deleted')
                                    @permission('edit-leave')
                                        <button data-toggle="modal" data-target="#update-leave-modal"
                                            wire:click="edit({{ $leave->id }})" class="btn btn-primary">
                                            <i class="ti-pencil text-white"></i>
                                        </button>
                                    @endpermission

                                    @permission('delete-leave')
                                        <button class="btn btn-danger" type="button" data-toggle="modal"
                                            data-target="#delete-leave-{{ $leave->id }}">
                                            <i class="ti-trash text-white"></i>
                                        </button>

                                        <div id="delete-leave-{{ $leave->id }}" class="modal fade" tabindex="-1"
                                            role="dialog" aria-labelledby="delete-leave-{{ $leave->id }}-title"
                                            aria-hidden="true">
                                            <div class="modal-dialog" role="document">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <h5 class="modal-title" id="delete-leave-{{ $leave->id }}-title">
                                                            {{ $leave->crud_name() }}
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

                                                        <button wire:click="delete({{ $leave->id }})" class="btn btn-danger"
                                                            data-dismiss="modal">
                                                            {{ __('global.delete') }}
                                                        </button>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    @endpermission
                                @endif

                                @if ($admin_view_status == 'deleted')
                                    @permission('restore-leave')
                                        <button class="btn btn-danger" type="button" data-toggle="modal"
                                            data-target="#restore-leave-{{ $leave->id }}">
                                            <i class="ti-reload text-white"></i>
                                        </button>

                                        <div wire:ignore.self id="restore-leave-{{ $leave->id }}"
                                            aria-labelledby="restore-leave-{{ $leave->id }}-title" class="modal fade"
                                            tabindex="-1" role="dialog" aria-hidden="true">
                                            <div class="modal-dialog" role="document">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <h5 class="modal-title" id="restore-leave-{{ $leave->id }}-title">
                                                            {{ $leave->crud_name() }}
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

                                                        <button wire:click="restore({{ $leave->id }})"
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
    </div>

    {{ $leaves->links() }}
</div>
