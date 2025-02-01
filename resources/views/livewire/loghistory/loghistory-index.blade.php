<div>

    @include('livewire.loghistory.loghistory-top')

    @if (session()->has('message'))
        <div class="alert alert-success" style="margin-top:30px;">
            {{ session('message') }}
        </div>
    @endif

    @php
        $number = ($loghistories->currentPage() - 1) * $perPage;
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


                    @if ($showColumn['user_id'])
                        <td>{{ __('loghistory.user') }}</td>
                    @endif

                    @if ($showColumn['action'])
                        <td>{{ __('loghistory.action') }}</td>
                    @endif

                    @if ($showColumn['by_model_name'])
                        <td>{{ __('loghistory.by_model_name') }}</td>
                    @endif

                    @if ($showColumn['by_model_id'])
                        <td>{{ __('loghistory.by_model_id') }}</td>
                    @endif

                    @if ($showColumn['on_model_name'])
                        <td>{{ __('loghistory.on_model_name') }}</td>
                    @endif

                    @if ($showColumn['on_model_id'])
                        <td>{{ __('loghistory.on_model_id') }}</td>
                    @endif

                    @if ($showColumn['from_data'])
                        <td>{{ __('loghistory.from_data') }}</td>
                    @endif

                    @if ($showColumn['to_data'])
                        <td>{{ __('loghistory.to_data') }}</td>
                    @endif

                    @if ($showColumn['preaf'])
                        <td>{{ __('loghistory.preaf') }}</td>
                    @endif

                    @if ($showColumn['desc'])
                        <td>{{ __('loghistory.desc') }}</td>
                    @endif

                    @if ($showColumn['color'])
                        <td>{{ __('loghistory.color') }}</td>
                    @endif


                    @if ($showColumn['date'])
                        <td>{{ __('global.date') }}</td>
                    @endif
                    @if ($showColumn['time'])
                        <td>{{ __('global.time') }}</td>
                    @endif

                    @permission('edit-loghistory|delete-loghistory|restore-loghistory')
                        <td style="width: 150px">
                            {{ __('global.action') }}
                        </td>
                    @endpermission

                </tr>
            </thead>
            <tbody>
                @foreach ($loghistories as $loghistory)
                    <tr>
                        <td>{{ ++$number }}</td>

                        {{--
                            @if ($admin_view_status != 'deleted')
                                <td>
                                    <div class="form-check">
                                        <input wire:model.defer="selectedLoghistories.{{ $loghistory->id }}" class="form-check-input"
                                            type="checkbox" value="{{ $loghistory->id }}" id="loghistory-{{ $loghistory->id }}">
                                    </div>
                                </td>
                            @endif
                        --}}

                        @if ($showColumn['id'])
                            <td> {{ $loghistory->id }} </td>
                        @endif

                        @if ($showColumn['slug'])
                            <td> {{ $loghistory->slug }} </td>
                        @endif


                        @if ($showColumn['user_id'])
                            <td>
                                @if ($loghistory->user)
                                    {{ $loghistory->user->crud_name() }}
                                @endif
                            </td>
                        @endif

                        @if ($showColumn['action'])
                            <td> {{ $loghistory->action }} </td>
                        @endif

                        @if ($showColumn['by_model_name'])
                            <td> {{ $loghistory->by_model_name }} </td>
                        @endif

                        @if ($showColumn['by_model_id'])
                            <td> {{ $loghistory->by_model_id }} </td>
                        @endif

                        @if ($showColumn['on_model_name'])
                            <td> {{ $loghistory->on_model_name }} </td>
                        @endif

                        @if ($showColumn['on_model_id'])
                            <td> {{ $loghistory->on_model_id }} </td>
                        @endif

                        @if ($showColumn['from_data'])
                            <td> {!! $loghistory->from_readable() !!} </td>
                        @endif

                        @if ($showColumn['to_data'])
                            <td> {!! $loghistory->to_readable() !!} </td>
                        @endif

                        @if ($showColumn['preaf'])
                            <td> {{ $loghistory->the_preaf() }} </td>
                        @endif

                        @if ($showColumn['desc'])
                            <td> {{ $loghistory->the_desc() }} </td>
                        @endif

                        @if ($showColumn['color'])
                            <td>

                                {!! $loghistory->colors() !!}
                            </td>
                        @endif


                        @if ($showColumn['date'])
                            <td> {{ date('d/m/Y', strtotime($loghistory->created_at)) }} </td>
                        @endif
                        @if ($showColumn['time'])
                            <td> {{ date('h:i A', strtotime($loghistory->created_at)) }} </td>
                        @endif

                        @permission('edit-loghistory|delete-loghistory|restore-loghistory')
                            <td>
                                @if ($admin_view_status != 'deleted')
                                    @permission('edit-loghistory')
                                        <button data-toggle="modal" data-target="#update-loghistory-modal"
                                            wire:click="edit({{ $loghistory->id }})" class="btn btn-primary">
                                            <i class="ti-pencil text-white"></i>
                                        </button>
                                    @endpermission

                                    @permission('delete-loghistory')
                                        <button class="btn btn-danger" type="button" data-toggle="modal"
                                            data-target="#delete-loghistory-{{ $loghistory->id }}">
                                            <i class="ti-trash text-white"></i>
                                        </button>

                                        <div id="delete-loghistory-{{ $loghistory->id }}" class="modal fade" tabindex="-1"
                                            role="dialog" aria-labelledby="delete-loghistory-{{ $loghistory->id }}-title"
                                            aria-hidden="true">
                                            <div class="modal-dialog" role="document">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <h5 class="modal-title"
                                                            id="delete-loghistory-{{ $loghistory->id }}-title">
                                                            {{ $loghistory->crud_name() }}
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

                                                        <button wire:click="delete({{ $loghistory->id }})"
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
                                    @permission('restore-loghistory')
                                        <button class="btn btn-danger" type="button" data-toggle="modal"
                                            data-target="#restore-loghistory-{{ $loghistory->id }}">
                                            <i class="ti-reload text-white"></i>
                                        </button>

                                        <div wire:ignore.self id="restore-loghistory-{{ $loghistory->id }}"
                                            aria-labelledby="restore-loghistory-{{ $loghistory->id }}-title" class="modal fade"
                                            tabindex="-1" role="dialog" aria-hidden="true">
                                            <div class="modal-dialog" role="document">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <h5 class="modal-title"
                                                            id="restore-loghistory-{{ $loghistory->id }}-title">
                                                            {{ $loghistory->crud_name() }}
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

                                                        <button wire:click="restore({{ $loghistory->id }})"
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

        {{ $loghistories->links() }}
    </div>
</div>
