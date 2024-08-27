<div>

    @include('livewire.dailytask.dailytask-top')

    @if (session()->has('message'))
        <div class="alert alert-success" style="margin-top:30px;">
            {{ session('message') }}
        </div>
    @endif

    @php
        $number = ($dailytasks->currentPage() - 1) * $perPage;
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
                    
                    
                            @if ($showColumn['manager_id'])
                                <td>{{ __('dailytask.manager') }}</td>
                            @endif

                            @if ($showColumn['title'])
                                <td>{{ __('dailytask.title') }}</td>
                            @endif

                            @if ($showColumn['description'])
                                <td>{{ __('dailytask.description') }}</td>
                            @endif

                            @if ($showColumn['start_time'])
                                <td>{{ __('dailytask.start_time') }}</td>
                            @endif

                            @if ($showColumn['end_time'])
                                <td>{{ __('dailytask.end_time') }}</td>
                            @endif

                            @if ($showColumn['proearty'])
                                <td>{{ __('dailytask.proearty') }}</td>
                            @endif

                            @if ($showColumn['status'])
                                <td>{{ __('dailytask.status') }}</td>
                            @endif

                            @if ($showColumn['repeat_time'])
                                <td>{{ __('dailytask.repeat_time') }}</td>
                            @endif

                            @if ($showColumn['repeat_evrey'])
                                <td>{{ __('dailytask.repeat_evrey') }}</td>
                            @endif

                    
                    @if ($showColumn['date'])
                        <td>{{ __('global.date') }}</td>
                    @endif
                    @if ($showColumn['time'])
                        <td>{{ __('global.time') }}</td>
                    @endif

                    @permission('edit-dailytask|delete-dailytask|restore-dailytask')
                        <td style="width: 150px">
                            {{ __('global.action') }}
                        </td>
                    @endpermission

                </tr>
            </thead>
            <tbody>
                @foreach ($dailytasks as $dailytask)
                    <tr>
                        <td>{{ ++$number }}</td>

                        {{-- 
                            @if ($admin_view_status != 'deleted')
                                <td>
                                    <div class="form-check">
                                        <input wire:model.defer="selectedDailytasks.{{ $dailytask->id }}" class="form-check-input"
                                            type="checkbox" value="{{ $dailytask->id }}" id="dailytask-{{ $dailytask->id }}">
                                    </div>
                                </td>
                            @endif
                        --}}

                        @if ($showColumn['id'])
                            <td> {{ $dailytask->id }} </td>
                        @endif
                        
                        @if ($showColumn['slug'])
                            <td> {{ $dailytask->slug }} </td>
                        @endif
                        
                        
                        @if ($showColumn['manager_id'])
                            <td>
                                @if ($dailytask->manager)
                                    {{ $dailytask->manager->crud_name() }}
                                @endif
                            </td>
                        @endif

                        @if ($showColumn['title'])
                            <td> {{ $dailytask->title }} </td>
                        @endif

                        @if ($showColumn['description'])
                            <td> {{ $dailytask->description }} </td>
                        @endif

                        @if ($showColumn['start_time'])
                            <td> {{ $dailytask->start_time }} </td>
                        @endif

                        @if ($showColumn['end_time'])
                            <td> {{ $dailytask->end_time }} </td>
                        @endif

                        @if ($showColumn['proearty'])
                            <td> {{ $dailytask->proearty }} </td>
                        @endif

                        @if ($showColumn['status'])
                            <td> {{ $dailytask->status }} </td>
                        @endif

                        @if ($showColumn['repeat_time'])
                            <td> {{ $dailytask->repeat_time }} </td>
                        @endif

                        @if ($showColumn['repeat_evrey'])
                            <td> {{ $dailytask->repeat_evrey }} </td>
                        @endif

                        
                        @if ($showColumn['date'])
                            <td> {{ date('d/m/Y', strtotime($dailytask->created_at)) }} </td>
                        @endif
                        @if ($showColumn['time'])
                            <td> {{ date('h:i A', strtotime($dailytask->created_at)) }} </td>
                        @endif
                        
                        @permission('edit-dailytask|delete-dailytask|restore-dailytask')
                            <td>
                                @if ($admin_view_status != 'deleted')
                                    @permission('edit-dailytask')
                                        <button data-toggle="modal" data-target="#update-dailytask-modal"
                                            wire:click="edit({{ $dailytask->id }})"
                                            class="btn btn-primary">
                                            <i class="ti-pencil text-white"></i>
                                        </button>
                                    @endpermission
                                
                                    @permission('delete-dailytask')
                                        <button class="btn btn-danger" type="button" data-toggle="modal"
                                                data-target="#delete-dailytask-{{ $dailytask->id }}">
                                            <i class="ti-trash text-white"></i>
                                        </button>

                                        <div id="delete-dailytask-{{ $dailytask->id }}" class="modal fade" tabindex="-1" role="dialog"
                                            aria-labelledby="delete-dailytask-{{ $dailytask->id }}-title" aria-hidden="true">
                                            <div class="modal-dialog" role="document">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <h5 class="modal-title" id="delete-dailytask-{{ $dailytask->id }}-title">
                                                            {{ $dailytask->crud_name() }}
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

                                                        <button wire:click="delete({{ $dailytask->id }})" class="btn btn-danger"
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
                                    @permission('restore-dailytask')
                                        <button class="btn btn-danger" type="button" data-toggle="modal"
                                            data-target="#restore-dailytask-{{ $dailytask->id }}">
                                            <i class="ti-reload text-white"></i>
                                        </button>

                                        <div wire:ignore.self id="restore-dailytask-{{ $dailytask->id }}"
                                            aria-labelledby="restore-dailytask-{{ $dailytask->id }}-title"
                                            class="modal fade" tabindex="-1" role="dialog"
                                            aria-hidden="true">
                                            <div class="modal-dialog" role="document">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <h5 class="modal-title"
                                                            id="restore-dailytask-{{ $dailytask->id }}-title">
                                                            {{ $dailytask->crud_name() }}
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

                                                        <button wire:click="restore({{ $dailytask->id }})"
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

    {{ $dailytasks->links() }}
</div>
