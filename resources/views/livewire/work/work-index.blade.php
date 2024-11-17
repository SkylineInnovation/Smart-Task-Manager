<div>

    @include('livewire.work.work-top')

    @if (session()->has('message'))
        <div class="alert alert-success" style="margin-top:30px;">
            {{ session('message') }}
        </div>
    @endif

    @php
        $number = ($works->currentPage() - 1) * $perPage;
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
                        <td>{{ __('work.manager') }}</td>
                    @endif

                    @if ($showColumn['department_id'])
                        <td>{{ __('work.department') }}</td>
                    @endif

                    @if ($showColumn['user_id'])
                        <td>{{ __('work.user') }}</td>
                    @endif

                    @if ($showColumn['job_title'])
                        <td>{{ __('work.job_title') }}</td>
                    @endif


                    @if ($showColumn['date'])
                        <td>{{ __('global.date') }}</td>
                    @endif
                    @if ($showColumn['time'])
                        <td>{{ __('global.time') }}</td>
                    @endif

                    @permission('edit-work|delete-work|restore-work')
                        <td style="width: 150px">
                            {{ __('global.action') }}
                        </td>
                    @endpermission

                </tr>
            </thead>
            <tbody>
                @foreach ($works as $work)
                    <tr>
                        <td>{{ ++$number }}</td>

                        {{-- 
                            @if ($admin_view_status != 'deleted')
                                <td>
                                    <div class="form-check">
                                        <input wire:model.defer="selectedWorks.{{ $work->id }}" class="form-check-input"
                                            type="checkbox" value="{{ $work->id }}" id="work-{{ $work->id }}">
                                    </div>
                                </td>
                            @endif
                        --}}

                        @if ($showColumn['id'])
                            <td> {{ $work->id }} </td>
                        @endif

                        @if ($showColumn['slug'])
                            <td> {{ $work->slug }} </td>
                        @endif


                        @if ($showColumn['manager_id'])
                            <td>
                                @if ($work->manager)
                                    {{ $work->manager->crud_name() }}
                                @endif
                            </td>
                        @endif

                        @if ($showColumn['department_id'])
                            <td>
                                @if ($work->department)
                                    {{ $work->department->crud_name() }}
                                @endif
                            </td>
                        @endif

                        @if ($showColumn['user_id'])
                            <td>
                                @if ($work->user)
                                    {{ $work->user->crud_name() }}
                                @endif
                            </td>
                        @endif

                        @if ($showColumn['job_title'])
                            <td> {{ $work->job_title }} </td>
                        @endif


                        @if ($showColumn['date'])
                            <td> {{ date('d/m/Y', strtotime($work->created_at)) }} </td>
                        @endif
                        @if ($showColumn['time'])
                            <td> {{ date('h:i A', strtotime($work->created_at)) }} </td>
                        @endif

                        @permission('edit-work|delete-work|restore-work')
                            <td>
                                @if ($admin_view_status != 'deleted')
                                    @permission('edit-work')
                                        <button data-toggle="modal" data-target="#update-work-modal"
                                            wire:click="edit({{ $work->id }})" class="btn btn-primary">
                                            <i class="ti-pencil text-white"></i>
                                        </button>
                                    @endpermission

                                    @permission('delete-work')
                                        <button class="btn btn-danger" type="button" data-toggle="modal"
                                            data-target="#delete-work-{{ $work->id }}">
                                            <i class="ti-trash text-white"></i>
                                        </button>

                                        <div id="delete-work-{{ $work->id }}" class="modal fade" tabindex="-1"
                                            role="dialog" aria-labelledby="delete-work-{{ $work->id }}-title"
                                            aria-hidden="true">
                                            <div class="modal-dialog" role="document">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <h5 class="modal-title" id="delete-work-{{ $work->id }}-title">
                                                            {{ $work->crud_name() }}
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

                                                        <button wire:click="delete({{ $work->id }})" class="btn btn-danger"
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
                                    @permission('restore-work')
                                        <button class="btn btn-danger" type="button" data-toggle="modal"
                                            data-target="#restore-work-{{ $work->id }}">
                                            <i class="ti-reload text-white"></i>
                                        </button>

                                        <div wire:ignore.self id="restore-work-{{ $work->id }}"
                                            aria-labelledby="restore-work-{{ $work->id }}-title" class="modal fade"
                                            tabindex="-1" role="dialog" aria-hidden="true">
                                            <div class="modal-dialog" role="document">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <h5 class="modal-title" id="restore-work-{{ $work->id }}-title">
                                                            {{ $work->crud_name() }}
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

                                                        <button wire:click="restore({{ $work->id }})"
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

        {{ $works->links() }}
    </div>
</div>
