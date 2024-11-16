<div>

    @include('livewire.area.area-top')

    @if (session()->has('message'))
        <div class="alert alert-success" style="margin-top:30px;">
            {{ session('message') }}
        </div>
    @endif

    @php
        $number = ($areas->currentPage() - 1) * $perPage;
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
                        <td>{{ __('area.name') }}</td>
                    @endif

                    @if ($showColumn['location'])
                        <td>{{ __('area.location') }}</td>
                    @endif

                    @if ($showColumn['manager_id'])
                        <td>{{ __('area.manager') }}</td>
                    @endif


                    @if ($showColumn['date'])
                        <td>{{ __('global.date') }}</td>
                    @endif
                    @if ($showColumn['time'])
                        <td>{{ __('global.time') }}</td>
                    @endif

                    @permission('edit-area|delete-area|restore-area')
                        <td style="width: 150px">
                            {{ __('global.action') }}
                        </td>
                    @endpermission

                </tr>
            </thead>
            <tbody>
                @foreach ($areas as $area)
                    <tr>
                        <td>{{ ++$number }}</td>

                        {{-- 
                            @if ($admin_view_status != 'deleted')
                                <td>
                                    <div class="form-check">
                                        <input wire:model.defer="selectedAreas.{{ $area->id }}" class="form-check-input"
                                            type="checkbox" value="{{ $area->id }}" id="area-{{ $area->id }}">
                                    </div>
                                </td>
                            @endif
                        --}}

                        @if ($showColumn['id'])
                            <td> {{ $area->id }} </td>
                        @endif

                        @if ($showColumn['slug'])
                            <td> {{ $area->slug }} </td>
                        @endif


                        @if ($showColumn['name'])
                            <td> {{ $area->name }} </td>
                        @endif

                        @if ($showColumn['location'])
                            <td> {{ $area->location }} </td>
                        @endif

                        @if ($showColumn['manager_id'])
                            <td>
                                @if ($area->manager)
                                    {{ $area->manager->crud_name() }}
                                @endif
                            </td>
                        @endif


                        @if ($showColumn['date'])
                            <td> {{ date('d/m/Y', strtotime($area->created_at)) }} </td>
                        @endif
                        @if ($showColumn['time'])
                            <td> {{ date('h:i A', strtotime($area->created_at)) }} </td>
                        @endif

                        @permission('edit-area|delete-area|restore-area')
                            <td>
                                @if ($admin_view_status != 'deleted')
                                    @permission('edit-area')
                                        <button data-toggle="modal" data-target="#update-area-modal"
                                            wire:click="edit({{ $area->id }})" class="btn btn-primary">
                                            <i class="ti-pencil text-white"></i>
                                        </button>
                                    @endpermission

                                    @permission('delete-area')
                                        <button class="btn btn-danger" type="button" data-toggle="modal"
                                            data-target="#delete-area-{{ $area->id }}">
                                            <i class="ti-trash text-white"></i>
                                        </button>

                                        <div id="delete-area-{{ $area->id }}" class="modal fade" tabindex="-1"
                                            role="dialog" aria-labelledby="delete-area-{{ $area->id }}-title"
                                            aria-hidden="true">
                                            <div class="modal-dialog" role="document">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <h5 class="modal-title" id="delete-area-{{ $area->id }}-title">
                                                            {{ $area->crud_name() }}
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

                                                        <button wire:click="delete({{ $area->id }})" class="btn btn-danger"
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
                                    @permission('restore-area')
                                        <button class="btn btn-danger" type="button" data-toggle="modal"
                                            data-target="#restore-area-{{ $area->id }}">
                                            <i class="ti-reload text-white"></i>
                                        </button>

                                        <div wire:ignore.self id="restore-area-{{ $area->id }}"
                                            aria-labelledby="restore-area-{{ $area->id }}-title" class="modal fade"
                                            tabindex="-1" role="dialog" aria-hidden="true">
                                            <div class="modal-dialog" role="document">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <h5 class="modal-title" id="restore-area-{{ $area->id }}-title">
                                                            {{ $area->crud_name() }}
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

                                                        <button wire:click="restore({{ $area->id }})"
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

        {{ $areas->links() }}
    </div>
</div>
