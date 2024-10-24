<div>

    @include('livewire.devicetokenlist.devicetokenlist-top')

    @if (session()->has('message'))
        <div class="alert alert-success" style="margin-top:30px;">
            {{ session('message') }}
        </div>
    @endif

    @php
        $number = ($devicetokenlists->currentPage() - 1) * $perPage;
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
                        <td>{{ __('devicetokenlist.user') }}</td>
                    @endif

                    @if ($showColumn['device_info'])
                        <td>{{ __('devicetokenlist.device_info') }}</td>
                    @endif

                    @if ($showColumn['device_type'])
                        <td>{{ __('devicetokenlist.device_type') }}</td>
                    @endif

                    @if ($showColumn['application'])
                        <td>{{ __('devicetokenlist.application') }}</td>
                    @endif

                    @if ($showColumn['device_token'])
                        <td>{{ __('devicetokenlist.device_token') }}</td>
                    @endif


                    @if ($showColumn['date'])
                        <td>{{ __('global.date') }}</td>
                    @endif
                    @if ($showColumn['time'])
                        <td>{{ __('global.time') }}</td>
                    @endif

                    @permission('edit-devicetokenlist|delete-devicetokenlist|restore-devicetokenlist')
                        <td style="width: 150px">
                            {{ __('global.action') }}
                        </td>
                    @endpermission

                </tr>
            </thead>
            <tbody>
                @foreach ($devicetokenlists as $devicetokenlist)
                    <tr>
                        <td>{{ ++$number }}</td>

                        {{-- 
                            @if ($admin_view_status != 'deleted')
                                <td>
                                    <div class="form-check">
                                        <input wire:model.defer="selectedDevicetokenlists.{{ $devicetokenlist->id }}" class="form-check-input"
                                            type="checkbox" value="{{ $devicetokenlist->id }}" id="devicetokenlist-{{ $devicetokenlist->id }}">
                                    </div>
                                </td>
                            @endif
                        --}}

                        @if ($showColumn['id'])
                            <td> {{ $devicetokenlist->id }} </td>
                        @endif

                        @if ($showColumn['slug'])
                            <td> {{ $devicetokenlist->slug }} </td>
                        @endif


                        @if ($showColumn['user_id'])
                            <td>
                                @if ($devicetokenlist->user)
                                    {{ $devicetokenlist->user->crud_name() }}
                                @endif
                            </td>
                        @endif

                        @if ($showColumn['device_info'])
                            <td> {{ $devicetokenlist->device_info }} </td>
                        @endif

                        @if ($showColumn['device_type'])
                            <td> {{ $devicetokenlist->device_type }} </td>
                        @endif

                        @if ($showColumn['application'])
                            <td> {{ $devicetokenlist->application }} </td>
                        @endif

                        @if ($showColumn['device_token'])
                            <td> {{ $devicetokenlist->device_token }} </td>
                        @endif


                        @if ($showColumn['date'])
                            <td> {{ date('d/m/Y', strtotime($devicetokenlist->created_at)) }} </td>
                        @endif
                        @if ($showColumn['time'])
                            <td> {{ date('h:i A', strtotime($devicetokenlist->created_at)) }} </td>
                        @endif

                        @permission('edit-devicetokenlist|delete-devicetokenlist|restore-devicetokenlist')
                            <td>
                                @if ($admin_view_status != 'deleted')
                                    @permission('edit-devicetokenlist')
                                        <button data-toggle="modal" data-target="#update-devicetokenlist-modal"
                                            wire:click="edit({{ $devicetokenlist->id }})" class="btn btn-primary">
                                            <i class="ti-pencil text-white"></i>
                                        </button>
                                    @endpermission

                                    @permission('delete-devicetokenlist')
                                        <button class="btn btn-danger" type="button" data-toggle="modal"
                                            data-target="#delete-devicetokenlist-{{ $devicetokenlist->id }}">
                                            <i class="ti-trash text-white"></i>
                                        </button>

                                        <div id="delete-devicetokenlist-{{ $devicetokenlist->id }}" class="modal fade"
                                            tabindex="-1" role="dialog"
                                            aria-labelledby="delete-devicetokenlist-{{ $devicetokenlist->id }}-title"
                                            aria-hidden="true">
                                            <div class="modal-dialog" role="document">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <h5 class="modal-title"
                                                            id="delete-devicetokenlist-{{ $devicetokenlist->id }}-title">
                                                            {{ $devicetokenlist->crud_name() }}
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

                                                        <button wire:click="delete({{ $devicetokenlist->id }})"
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
                                    @permission('restore-devicetokenlist')
                                        <button class="btn btn-danger" type="button" data-toggle="modal"
                                            data-target="#restore-devicetokenlist-{{ $devicetokenlist->id }}">
                                            <i class="ti-reload text-white"></i>
                                        </button>

                                        <div wire:ignore.self id="restore-devicetokenlist-{{ $devicetokenlist->id }}"
                                            aria-labelledby="restore-devicetokenlist-{{ $devicetokenlist->id }}-title"
                                            class="modal fade" tabindex="-1" role="dialog" aria-hidden="true">
                                            <div class="modal-dialog" role="document">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <h5 class="modal-title"
                                                            id="restore-devicetokenlist-{{ $devicetokenlist->id }}-title">
                                                            {{ $devicetokenlist->crud_name() }}
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

                                                        <button wire:click="restore({{ $devicetokenlist->id }})"
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

        {{ $devicetokenlists->links() }}
    </div>
</div>
