<div>

    @include('livewire.extratime.extratime-top')

    @if (session()->has('message'))
        <div class="alert alert-success" style="margin-top:30px;">
            {{ session('message') }}
        </div>
    @endif

    @php
        $number = ($extratimes->currentPage() - 1) * $perPage;
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
                        <td>{{ __('extratime.task') }}</td>
                    @endif

                    @if ($showColumn['user_id'])
                        <td>{{ __('extratime.user') }}</td>
                    @endif

                    @if ($showColumn['accepted_by_user_id'])
                        <td>{{ __('extratime.accepted_by_user') }}</td>
                    @endif

                    @if ($showColumn['reason'])
                        <td>{{ __('extratime.reason') }}</td>
                    @endif

                    @if ($showColumn['result'])
                        <td>{{ __('extratime.result') }}</td>
                    @endif

                    @if ($showColumn['request_time'])
                        <td>{{ __('extratime.request_time') }}</td>
                    @endif

                    @if ($showColumn['from_time'])
                        <td>{{ __('extratime.from_time') }}</td>
                    @endif

                    @if ($showColumn['to_time'])
                        <td>{{ __('extratime.to_time') }}</td>
                    @endif

                    @if ($showColumn['response_time'])
                        <td>{{ __('extratime.response_time') }}</td>
                    @endif

                    @if ($showColumn['status'])
                        <td>{{ __('extratime.status') }}</td>
                    @endif

                    @if ($showColumn['duration'])
                        <td>{{ __('extratime.duration') }}</td>
                    @endif


                    @if ($showColumn['date'])
                        <td>{{ __('global.date') }}</td>
                    @endif
                    @if ($showColumn['time'])
                        <td>{{ __('global.time') }}</td>
                    @endif

                    <td>
                        Action
                    </td>

                    @permission('edit-extratime|delete-extratime|restore-extratime')
                        <td style="width: 150px">
                            {{ __('global.action') }}
                        </td>
                    @endpermission

                </tr>
            </thead>
            <tbody>
                @foreach ($extratimes as $extratime)
                    <tr>
                        <td>{{ ++$number }}</td>

                        {{-- 
                            @if ($admin_view_status != 'deleted')
                                <td>
                                    <div class="form-check">
                                        <input wire:model.defer="selectedExtratimes.{{ $extratime->id }}" class="form-check-input"
                                            type="checkbox" value="{{ $extratime->id }}" id="extratime-{{ $extratime->id }}">
                                    </div>
                                </td>
                            @endif
                        --}}

                        @if ($showColumn['id'])
                            <td> {{ $extratime->id }} </td>
                        @endif

                        @if ($showColumn['slug'])
                            <td> {{ $extratime->slug }} </td>
                        @endif


                        @if ($showColumn['task_id'])
                            <td>
                                @if ($extratime->task)
                                    {{ $extratime->task->crud_name() }}
                                @endif
                            </td>
                        @endif

                        @if ($showColumn['user_id'])
                            <td>
                                @if ($extratime->user)
                                    {{ $extratime->user->crud_name() }}
                                @endif
                            </td>
                        @endif

                        @if ($showColumn['accepted_by_user_id'])
                            <td>
                                @if ($extratime->accepted_by_user)
                                    {{ $extratime->accepted_by_user->crud_name() }}
                                @endif
                            </td>
                        @endif

                        @if ($showColumn['reason'])
                            <td> {{ $extratime->reason }} </td>
                        @endif

                        @if ($showColumn['result'])
                            <td> {{ $extratime->result }} </td>
                        @endif

                        @if ($showColumn['request_time'])
                            <td> {{ $extratime->request_time }} </td>
                        @endif

                        @if ($showColumn['from_time'])
                            <td> {{ $extratime->format_date($extratime->from_time) }} </td>
                        @endif
                        @if ($showColumn['to_time'])
                            <td> {{ $extratime->format_date($extratime->to_time) }} </td>
                        @endif

                        @if ($showColumn['response_time'])
                            <td> {{ $extratime->format_date($extratime->response_time) }} </td>
                        @endif

                        @if ($showColumn['status'])
                            <td> {{ $extratime->the_status() }} </td>
                        @endif

                        @if ($showColumn['duration'])
                            <td> {{ $extratime->duration }} </td>
                        @endif


                        @if ($showColumn['date'])
                            <td> {{ date('d/m/Y', strtotime($extratime->created_at)) }} </td>
                        @endif
                        @if ($showColumn['time'])
                            <td> {{ date('h:i A', strtotime($extratime->created_at)) }} </td>
                        @endif

                        <td>
                            @if ($extratime->status == 'pending')
                                <button data-toggle="modal" data-target="#accept-extratime-modal"
                                    wire:click="edit({{ $extratime->id }})" class="btn btn-success">
                                    <i class="ti-check text-white"></i>
                                </button>

                                <button data-toggle="modal" data-target="#reject-extratime-modal"
                                    wire:click="edit({{ $extratime->id }})" class="btn btn-danger">
                                    <i class="ti-close text-white"></i>
                                </button>
                            @endif
                        </td>

                        @permission('edit-extratime|delete-extratime|restore-extratime')
                            <td>
                                @if ($admin_view_status != 'deleted')
                                    @permission('edit-extratime')
                                        <button data-toggle="modal" data-target="#update-extratime-modal"
                                            wire:click="edit({{ $extratime->id }})" class="btn btn-primary">
                                            <i class="ti-pencil text-white"></i>
                                        </button>
                                    @endpermission

                                    @permission('delete-extratime')
                                        <button class="btn btn-danger" type="button" data-toggle="modal"
                                            data-target="#delete-extratime-{{ $extratime->id }}">
                                            <i class="ti-trash text-white"></i>
                                        </button>

                                        <div id="delete-extratime-{{ $extratime->id }}" class="modal fade" tabindex="-1"
                                            role="dialog" aria-labelledby="delete-extratime-{{ $extratime->id }}-title"
                                            aria-hidden="true">
                                            <div class="modal-dialog" role="document">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <h5 class="modal-title"
                                                            id="delete-extratime-{{ $extratime->id }}-title">
                                                            {{ $extratime->crud_name() }}
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

                                                        <button wire:click="delete({{ $extratime->id }})"
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
                                    @permission('restore-extratime')
                                        <button class="btn btn-danger" type="button" data-toggle="modal"
                                            data-target="#restore-extratime-{{ $extratime->id }}">
                                            <i class="ti-reload text-white"></i>
                                        </button>

                                        <div wire:ignore.self id="restore-extratime-{{ $extratime->id }}"
                                            aria-labelledby="restore-extratime-{{ $extratime->id }}-title" class="modal fade"
                                            tabindex="-1" role="dialog" aria-hidden="true">
                                            <div class="modal-dialog" role="document">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <h5 class="modal-title"
                                                            id="restore-extratime-{{ $extratime->id }}-title">
                                                            {{ $extratime->crud_name() }}
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

                                                        <button wire:click="restore({{ $extratime->id }})"
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

    {{ $extratimes->links() }}
</div>
