<div>

    @include('livewire.exchangepermission.exchangepermission-top')

    @if (session()->has('message'))
        <div class="alert alert-success" style="margin-top:30px;">
            {{ session('message') }}
        </div>
    @endif

    @php
        $number = ($exchangepermissions->currentPage() - 1) * $perPage;
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
                        <td>{{ __('exchangepermission.user') }}</td>
                    @endif

                    @if ($showColumn['content'])
                        <td>{{ __('exchangepermission.content') }}</td>
                    @endif

                    @if ($showColumn['amount'])
                        <td>{{ __('exchangepermission.amount') }}</td>
                    @endif

                    @if ($showColumn['attachment'])
                        <td>{{ __('exchangepermission.attachment') }}</td>
                    @endif

                    @if ($showColumn['request_date'])
                        <td>{{ __('exchangepermission.request_date') }}</td>
                    @endif

                    @if ($showColumn['financial_director_id'])
                        <td>{{ __('exchangepermission.financial_director') }}</td>
                    @endif

                    @if ($showColumn['financial_director_response'])
                        <td>{{ __('exchangepermission.financial_director_response') }}</td>
                    @endif

                    @if ($showColumn['financial_director_time'])
                        <td>{{ __('exchangepermission.financial_director_time') }}</td>
                    @endif

                    @if ($showColumn['technical_director_id'])
                        <td>{{ __('exchangepermission.technical_director') }}</td>
                    @endif

                    @if ($showColumn['technical_director_response'])
                        <td>{{ __('exchangepermission.technical_director_response') }}</td>
                    @endif

                    @if ($showColumn['technical_director_time'])
                        <td>{{ __('exchangepermission.technical_director_time') }}</td>
                    @endif

                    @if ($showColumn['status'])
                        <td>{{ __('exchangepermission.status') }}</td>
                    @endif


                    @if ($showColumn['date'])
                        <td>{{ __('global.date') }}</td>
                    @endif
                    @if ($showColumn['time'])
                        <td>{{ __('global.time') }}</td>
                    @endif

                    @permission('edit-exchangepermission|delete-exchangepermission|restore-exchangepermission')
                        <td style="width: 150px">
                            {{ __('global.action') }}
                        </td>
                    @endpermission

                </tr>
            </thead>
            <tbody>
                @foreach ($exchangepermissions as $exchangepermission)
                    <tr>
                        <td>{{ ++$number }}</td>

                        {{-- 
                            @if ($admin_view_status != 'deleted')
                                <td>
                                    <div class="form-check">
                                        <input wire:model.defer="selectedExchangepermissions.{{ $exchangepermission->id }}" class="form-check-input"
                                            type="checkbox" value="{{ $exchangepermission->id }}" id="exchangepermission-{{ $exchangepermission->id }}">
                                    </div>
                                </td>
                            @endif
                        --}}

                        @if ($showColumn['id'])
                            <td> {{ $exchangepermission->id }} </td>
                        @endif

                        @if ($showColumn['slug'])
                            <td> {{ $exchangepermission->slug }} </td>
                        @endif


                        @if ($showColumn['user_id'])
                            <td>
                                @if ($exchangepermission->user)
                                    {{ $exchangepermission->user->crud_name() }}
                                @endif
                            </td>
                        @endif

                        @if ($showColumn['content'])
                            <td> {{ $exchangepermission->content }} </td>
                        @endif

                        @if ($showColumn['amount'])
                            <td> {{ $exchangepermission->amount }} </td>
                        @endif

                        @if ($showColumn['attachment'])
                            <td>
                                @if ($exchangepermission->attachment)
                                    <a href="{{ asset($exchangepermission->attachment) }}" download>download</a>
                                    {{-- <img src='{{ asset($exchangepermission->attachment) }}' width='75px' height='75px'> --}}
                                @else
                                    <p>{{ __('exchangepermission.attachment') }}</p>
                                @endif
                            </td>
                        @endif

                        @if ($showColumn['request_date'])
                            <td> {{ $exchangepermission->request_date }} </td>
                        @endif

                        @if ($showColumn['financial_director_id'])
                            <td>
                                @if ($exchangepermission->financial_director)
                                    {{ $exchangepermission->financial_director->crud_name() }}
                                @endif
                            </td>
                        @endif

                        @if ($showColumn['financial_director_response'])
                            <td> {{ $exchangepermission->financial_director_response }} </td>
                        @endif

                        @if ($showColumn['financial_director_time'])
                            <td> {{ $exchangepermission->financial_director_time }} </td>
                        @endif

                        @if ($showColumn['technical_director_id'])
                            <td>
                                @if ($exchangepermission->technical_director)
                                    {{ $exchangepermission->technical_director->crud_name() }}
                                @endif
                            </td>
                        @endif

                        @if ($showColumn['technical_director_response'])
                            <td> {{ $exchangepermission->technical_director_response }} </td>
                        @endif

                        @if ($showColumn['technical_director_time'])
                            <td> {{ $exchangepermission->technical_director_time }} </td>
                        @endif

                        @if ($showColumn['status'])
                            <td> {{ $exchangepermission->status }} </td>
                        @endif


                        @if ($showColumn['date'])
                            <td> {{ date('d/m/Y', strtotime($exchangepermission->created_at)) }} </td>
                        @endif
                        @if ($showColumn['time'])
                            <td> {{ date('h:i A', strtotime($exchangepermission->created_at)) }} </td>
                        @endif

                        @permission('edit-exchangepermission|delete-exchangepermission|restore-exchangepermission')
                            <td>
                                @if ($admin_view_status != 'deleted')
                                    @permission('edit-exchangepermission')
                                        <button data-toggle="modal" data-target="#update-exchangepermission-modal"
                                            wire:click="edit({{ $exchangepermission->id }})" class="btn btn-primary">
                                            <i class="ti-pencil text-white"></i>
                                        </button>
                                    @endpermission

                                    @permission('delete-exchangepermission')
                                        <button class="btn btn-danger" type="button" data-toggle="modal"
                                            data-target="#delete-exchangepermission-{{ $exchangepermission->id }}">
                                            <i class="ti-trash text-white"></i>
                                        </button>

                                        <div id="delete-exchangepermission-{{ $exchangepermission->id }}" class="modal fade"
                                            tabindex="-1" role="dialog"
                                            aria-labelledby="delete-exchangepermission-{{ $exchangepermission->id }}-title"
                                            aria-hidden="true">
                                            <div class="modal-dialog" role="document">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <h5 class="modal-title"
                                                            id="delete-exchangepermission-{{ $exchangepermission->id }}-title">
                                                            {{ $exchangepermission->crud_name() }}
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

                                                        <button wire:click="delete({{ $exchangepermission->id }})"
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
                                    @permission('restore-exchangepermission')
                                        <button class="btn btn-danger" type="button" data-toggle="modal"
                                            data-target="#restore-exchangepermission-{{ $exchangepermission->id }}">
                                            <i class="ti-reload text-white"></i>
                                        </button>

                                        <div wire:ignore.self id="restore-exchangepermission-{{ $exchangepermission->id }}"
                                            aria-labelledby="restore-exchangepermission-{{ $exchangepermission->id }}-title"
                                            class="modal fade" tabindex="-1" role="dialog" aria-hidden="true">
                                            <div class="modal-dialog" role="document">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <h5 class="modal-title"
                                                            id="restore-exchangepermission-{{ $exchangepermission->id }}-title">
                                                            {{ $exchangepermission->crud_name() }}
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

                                                        <button wire:click="restore({{ $exchangepermission->id }})"
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

        {{ $exchangepermissions->links() }}
    </div>
</div>
