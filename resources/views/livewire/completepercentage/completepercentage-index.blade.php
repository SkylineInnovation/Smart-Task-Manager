<div>

    @include('livewire.completepercentage.completepercentage-top')

    @if (session()->has('message'))
        <div class="alert alert-success" style="margin-top:30px;">
            {{ session('message') }}
        </div>
    @endif

    @php
        $number = ($completepercentages->currentPage() - 1) * $perPage;
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
                        <td>{{ __('completepercentage.task') }}</td>
                    @endif

                    @if ($showColumn['user_id'])
                        <td>{{ __('completepercentage.user') }}</td>
                    @endif

                    @if ($showColumn['percentage'])
                        <td>{{ __('completepercentage.percentage') }}</td>
                    @endif

                    @if ($showColumn['rate_text'])
                        <td>{{ __('completepercentage.rate_text') }}</td>
                    @endif

                    @if ($showColumn['rate_val'])
                        <td>{{ __('completepercentage.rate_val') }}</td>
                    @endif


                    @if ($showColumn['date'])
                        <td>{{ __('global.date') }}</td>
                    @endif
                    @if ($showColumn['time'])
                        <td>{{ __('global.time') }}</td>
                    @endif

                    @permission('edit-completepercentage|delete-completepercentage|restore-completepercentage')
                        <td style="width: 150px">
                            {{ __('global.action') }}
                        </td>
                    @endpermission

                </tr>
            </thead>
            <tbody>
                @foreach ($completepercentages as $completepercentage)
                    <tr>
                        <td>{{ ++$number }}</td>

                        {{-- 
                            @if ($admin_view_status != 'deleted')
                                <td>
                                    <div class="form-check">
                                        <input wire:model.defer="selectedCompletepercentages.{{ $completepercentage->id }}" class="form-check-input"
                                            type="checkbox" value="{{ $completepercentage->id }}" id="completepercentage-{{ $completepercentage->id }}">
                                    </div>
                                </td>
                            @endif
                        --}}

                        @if ($showColumn['id'])
                            <td> {{ $completepercentage->id }} </td>
                        @endif

                        @if ($showColumn['slug'])
                            <td> {{ $completepercentage->slug }} </td>
                        @endif


                        @if ($showColumn['task_id'])
                            <td>
                                @if ($completepercentage->task)
                                    {{ $completepercentage->task->crud_name() }}
                                @endif
                            </td>
                        @endif

                        @if ($showColumn['user_id'])
                            <td>
                                @if ($completepercentage->user)
                                    {{ $completepercentage->user->crud_name() }}
                                @endif
                            </td>
                        @endif

                        @if ($showColumn['percentage'])
                            <td> {{ $completepercentage->percentage }} </td>
                        @endif

                        @if ($showColumn['rate_text'])
                            <td> {{ $completepercentage->rate_text }} </td>
                        @endif

                        @if ($showColumn['rate_val'])
                            <td> {{ $completepercentage->rate_val }} </td>
                        @endif


                        @if ($showColumn['date'])
                            <td> {{ date('d/m/Y', strtotime($completepercentage->created_at)) }} </td>
                        @endif
                        @if ($showColumn['time'])
                            <td> {{ date('h:i A', strtotime($completepercentage->created_at)) }} </td>
                        @endif

                        @permission('edit-completepercentage|delete-completepercentage|restore-completepercentage')
                            <td>
                                @if ($admin_view_status != 'deleted')
                                    @permission('edit-completepercentage')
                                        <button data-toggle="modal" data-target="#update-completepercentage-modal"
                                            wire:click="edit({{ $completepercentage->id }})" class="btn btn-primary">
                                            <i class="ti-pencil text-white"></i>
                                        </button>
                                    @endpermission

                                    @permission('delete-completepercentage')
                                        <button class="btn btn-danger" type="button" data-toggle="modal"
                                            data-target="#delete-completepercentage-{{ $completepercentage->id }}">
                                            <i class="ti-trash text-white"></i>
                                        </button>

                                        <div id="delete-completepercentage-{{ $completepercentage->id }}" class="modal fade"
                                            tabindex="-1" role="dialog"
                                            aria-labelledby="delete-completepercentage-{{ $completepercentage->id }}-title"
                                            aria-hidden="true">
                                            <div class="modal-dialog" role="document">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <h5 class="modal-title"
                                                            id="delete-completepercentage-{{ $completepercentage->id }}-title">
                                                            {{ $completepercentage->crud_name() }}
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

                                                        <button wire:click="delete({{ $completepercentage->id }})"
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
                                    @permission('restore-completepercentage')
                                        <button class="btn btn-danger" type="button" data-toggle="modal"
                                            data-target="#restore-completepercentage-{{ $completepercentage->id }}">
                                            <i class="ti-reload text-white"></i>
                                        </button>

                                        <div wire:ignore.self id="restore-completepercentage-{{ $completepercentage->id }}"
                                            aria-labelledby="restore-completepercentage-{{ $completepercentage->id }}-title"
                                            class="modal fade" tabindex="-1" role="dialog" aria-hidden="true">
                                            <div class="modal-dialog" role="document">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <h5 class="modal-title"
                                                            id="restore-completepercentage-{{ $completepercentage->id }}-title">
                                                            {{ $completepercentage->crud_name() }}
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

                                                        <button wire:click="restore({{ $completepercentage->id }})"
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

        {{ $completepercentages->links() }}
    </div>
</div>
