<div>

    @include('livewire.branch.branch-top')

    @if (session()->has('message'))
        <div class="alert alert-success" style="margin-top:30px;">
            {{ session('message') }}
        </div>
    @endif

    @php
        $number = ($branches->currentPage() - 1) * $perPage;
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
                        <td>{{ __('branch.name') }}</td>
                    @endif

                    @if ($showColumn['location'])
                        <td>{{ __('branch.location') }}</td>
                    @endif


                    @if ($showColumn['date'])
                        <td>{{ __('global.date') }}</td>
                    @endif
                    @if ($showColumn['time'])
                        <td>{{ __('global.time') }}</td>
                    @endif

                    @permission('edit-branch|delete-branch|restore-branch')
                        <td style="width: 150px">
                            {{ __('global.action') }}
                        </td>
                    @endpermission

                </tr>
            </thead>
            <tbody>
                @foreach ($branches as $branch)
                    <tr>
                        <td>{{ ++$number }}</td>

                        {{-- 
                            @if ($admin_view_status != 'deleted')
                                <td>
                                    <div class="form-check">
                                        <input wire:model.defer="selectedBranches.{{ $branch->id }}" class="form-check-input"
                                            type="checkbox" value="{{ $branch->id }}" id="branch-{{ $branch->id }}">
                                    </div>
                                </td>
                            @endif
                        --}}

                        @if ($showColumn['id'])
                            <td> {{ $branch->id }} </td>
                        @endif

                        @if ($showColumn['slug'])
                            <td> {{ $branch->slug }} </td>
                        @endif


                        @if ($showColumn['name'])
                            <td> {{ $branch->name }} </td>
                        @endif

                        @if ($showColumn['location'])
                            <td> {{ $branch->location }} </td>
                        @endif


                        @if ($showColumn['date'])
                            <td> {{ date('d/m/Y', strtotime($branch->created_at)) }} </td>
                        @endif
                        @if ($showColumn['time'])
                            <td> {{ date('h:i A', strtotime($branch->created_at)) }} </td>
                        @endif

                        @permission('edit-branch|delete-branch|restore-branch')
                            <td>
                                @if ($admin_view_status != 'deleted')
                                    @permission('show-branch')
                                        <a href="{{ route('branch.show', $branch) }}" target="_blank" class="btn btn-info">
                                            <i class="ti-eye text-white"></i>
                                        </a>
                                    @endpermission

                                    @permission('edit-branch')
                                        <button data-toggle="modal" data-target="#update-branch-modal"
                                            wire:click="edit({{ $branch->id }})" class="btn btn-primary">
                                            <i class="ti-pencil text-white"></i>
                                        </button>
                                    @endpermission

                                    @permission('delete-branch')
                                        <button class="btn btn-danger" type="button" data-toggle="modal"
                                            data-target="#delete-branch-{{ $branch->id }}">
                                            <i class="ti-trash text-white"></i>
                                        </button>

                                        <div id="delete-branch-{{ $branch->id }}" class="modal fade" tabindex="-1"
                                            role="dialog" aria-labelledby="delete-branch-{{ $branch->id }}-title"
                                            aria-hidden="true">
                                            <div class="modal-dialog" role="document">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <h5 class="modal-title" id="delete-branch-{{ $branch->id }}-title">
                                                            {{ $branch->crud_name() }}
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

                                                        <button wire:click="delete({{ $branch->id }})" class="btn btn-danger"
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
                                    @permission('restore-branch')
                                        <button class="btn btn-danger" type="button" data-toggle="modal"
                                            data-target="#restore-branch-{{ $branch->id }}">
                                            <i class="ti-reload text-white"></i>
                                        </button>

                                        <div wire:ignore.self id="restore-branch-{{ $branch->id }}"
                                            aria-labelledby="restore-branch-{{ $branch->id }}-title" class="modal fade"
                                            tabindex="-1" role="dialog" aria-hidden="true">
                                            <div class="modal-dialog" role="document">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <h5 class="modal-title" id="restore-branch-{{ $branch->id }}-title">
                                                            {{ $branch->crud_name() }}
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

                                                        <button wire:click="restore({{ $branch->id }})"
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

        {{ $branches->links() }}
    </div>
</div>
