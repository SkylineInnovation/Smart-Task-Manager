<div>

    @include('livewire.userdetail.userdetail-top')

    @if (session()->has('message'))
        <div class="alert alert-success" style="margin-top:30px;">
            {{ session('message') }}
        </div>
    @endif

    @php
        $number = ($userdetails->currentPage() - 1) * $perPage;
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
                        <td>{{ __('userdetail.user') }}</td>
                    @endif

                    @if ($showColumn['title'])
                        <td>{{ __('userdetail.title') }}</td>
                    @endif

                    @if ($showColumn['nationality'])
                        <td>{{ __('userdetail.nationality') }}</td>
                    @endif

                    @if ($showColumn['id_number'])
                        <td>{{ __('userdetail.id_number') }}</td>
                    @endif

                    @if ($showColumn['address'])
                        <td>{{ __('userdetail.address') }}</td>
                    @endif

                    @if ($showColumn['qualification'])
                        <td>{{ __('userdetail.qualification') }}</td>
                    @endif

                    @if ($showColumn['salary'])
                        <td>{{ __('userdetail.salary') }}</td>
                    @endif

                    @if ($showColumn['home'])
                        <td>{{ __('userdetail.home') }}</td>
                    @endif

                    @if ($showColumn['transport'])
                        <td>{{ __('userdetail.transport') }}</td>
                    @endif

                    @if ($showColumn['branch_id'])
                        <td>{{ __('userdetail.branch') }}</td>
                    @endif


                    @if ($showColumn['date'])
                        <td>{{ __('global.date') }}</td>
                    @endif
                    @if ($showColumn['time'])
                        <td>{{ __('global.time') }}</td>
                    @endif

                    @permission('edit-userdetail|delete-userdetail|restore-userdetail')
                        <td style="width: 150px">
                            {{ __('global.action') }}
                        </td>
                    @endpermission

                </tr>
            </thead>
            <tbody>
                @foreach ($userdetails as $userdetail)
                    <tr>
                        <td>{{ ++$number }}</td>

                        {{-- 
                            @if ($admin_view_status != 'deleted')
                                <td>
                                    <div class="form-check">
                                        <input wire:model.defer="selectedUserdetails.{{ $userdetail->id }}" class="form-check-input"
                                            type="checkbox" value="{{ $userdetail->id }}" id="userdetail-{{ $userdetail->id }}">
                                    </div>
                                </td>
                            @endif
                        --}}

                        @if ($showColumn['id'])
                            <td> {{ $userdetail->id }} </td>
                        @endif

                        @if ($showColumn['slug'])
                            <td> {{ $userdetail->slug }} </td>
                        @endif


                        @if ($showColumn['user_id'])
                            <td>
                                @if ($userdetail->user)
                                    {{ $userdetail->user->crud_name() }}
                                @endif
                            </td>
                        @endif

                        @if ($showColumn['title'])
                            <td> {{ $userdetail->title }} </td>
                        @endif

                        @if ($showColumn['nationality'])
                            <td> {{ $userdetail->nationality }} </td>
                        @endif

                        @if ($showColumn['id_number'])
                            <td> {{ $userdetail->id_number }} </td>
                        @endif

                        @if ($showColumn['address'])
                            <td> {{ $userdetail->address }} </td>
                        @endif

                        @if ($showColumn['qualification'])
                            <td> {{ $userdetail->qualification }} </td>
                        @endif

                        @if ($showColumn['salary'])
                            <td> {{ $userdetail->salary }} </td>
                        @endif

                        @if ($showColumn['home'])
                            <td> {{ $userdetail->home }} </td>
                        @endif

                        @if ($showColumn['transport'])
                            <td> {{ $userdetail->transport }} </td>
                        @endif

                        @if ($showColumn['branch_id'])
                            <td>
                                @if ($userdetail->branch)
                                    {{ $userdetail->branch->crud_name() }}
                                @endif
                            </td>
                        @endif


                        @if ($showColumn['date'])
                            <td> {{ date('d/m/Y', strtotime($userdetail->created_at)) }} </td>
                        @endif
                        @if ($showColumn['time'])
                            <td> {{ date('h:i A', strtotime($userdetail->created_at)) }} </td>
                        @endif

                        @permission('edit-userdetail|delete-userdetail|restore-userdetail')
                            <td>
                                @if ($admin_view_status != 'deleted')
                                    @permission('edit-userdetail')
                                        <button data-toggle="modal" data-target="#update-userdetail-modal"
                                            wire:click="edit({{ $userdetail->id }})" class="btn btn-primary">
                                            <i class="ti-pencil text-white"></i>
                                        </button>
                                    @endpermission

                                    @permission('delete-userdetail')
                                        <button class="btn btn-danger" type="button" data-toggle="modal"
                                            data-target="#delete-userdetail-{{ $userdetail->id }}">
                                            <i class="ti-trash text-white"></i>
                                        </button>

                                        <div id="delete-userdetail-{{ $userdetail->id }}" class="modal fade" tabindex="-1"
                                            role="dialog" aria-labelledby="delete-userdetail-{{ $userdetail->id }}-title"
                                            aria-hidden="true">
                                            <div class="modal-dialog" role="document">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <h5 class="modal-title"
                                                            id="delete-userdetail-{{ $userdetail->id }}-title">
                                                            {{ $userdetail->crud_name() }}
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

                                                        <button wire:click="delete({{ $userdetail->id }})"
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
                                    @permission('restore-userdetail')
                                        <button class="btn btn-danger" type="button" data-toggle="modal"
                                            data-target="#restore-userdetail-{{ $userdetail->id }}">
                                            <i class="ti-reload text-white"></i>
                                        </button>

                                        <div wire:ignore.self id="restore-userdetail-{{ $userdetail->id }}"
                                            aria-labelledby="restore-userdetail-{{ $userdetail->id }}-title" class="modal fade"
                                            tabindex="-1" role="dialog" aria-hidden="true">
                                            <div class="modal-dialog" role="document">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <h5 class="modal-title"
                                                            id="restore-userdetail-{{ $userdetail->id }}-title">
                                                            {{ $userdetail->crud_name() }}
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

                                                        <button wire:click="restore({{ $userdetail->id }})"
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

        {{ $userdetails->links() }}
    </div>
</div>
