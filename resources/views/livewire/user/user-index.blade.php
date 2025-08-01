<div>

    @include('livewire.user.user-top')

    @if (session()->has('message'))
        <div class="alert alert-success" style="margin-top:30px;">
            {{ session('message') }}
        </div>
    @endif

    <div class="table-responsive">
        <table class="table table-bordered">
            <thead>
                <tr>
                    {{-- <td> {{ __('global.select') }} </td> --}}

                    {{-- @if ($showColumn['id'])
                        <td>{{ __('global.id') }}</td>
                    @endif --}}

                    @if ($showColumn['name'])
                        <td>{{ __('user.name') }}</td>
                    @endif

                    @if ($showColumn['first_name'])
                        <td>{{ __('user.first_name') }}</td>
                    @endif

                    @if ($showColumn['last_name'])
                        <td>{{ __('user.last_name') }}</td>
                    @endif

                    @if ($showColumn['user_name'])
                        <td>{{ __('user.user_name') }}</td>
                    @endif

                    @if ($showColumn['email'])
                        <td>{{ __('user.email') }}</td>
                    @endif

                    @if ($showColumn['phone'])
                        <td>{{ __('user.phone') }}</td>
                    @endif

                    @if ($showColumn['gender'])
                        <td>{{ __('user.gender') }}</td>
                    @endif

                    @if ($showColumn['birth_day'])
                        <td>{{ __('user.birth_day') }}</td>
                    @endif

                    @if ($showColumn['status'])
                        <td>{{ __('user.status') }}</td>
                    @endif

                    @if ($showColumn['created_at'])
                        <td>{{ __('global.created_at') }}</td>
                    @endif

                    <td>{{ __('global.roles') }}</td>

                    @role('owner')
                        <td>{{ __('user.managers') }}</td>

                        <td>{{ __('user.departments') }}</td>
                    @endrole

                    <td style="width: 150px">
                        {{ __('global.action') }}
                    </td>

                </tr>
            </thead>
            <tbody>
                @foreach ($users as $user)
                    <tr>
                        {{-- <td>
                            <div class="form-check">
                                <input wire:model="selectedUsers.{{ $user->id }}" class="form-check-input"
                                    type="checkbox" value="{{ $user->id }}" id="user-{{ $user->id }}">
                            </div>
                        </td> --}}

                        {{-- @if ($showColumn['id'])
                            <td> {{ $user->id }} </td>
                        @endif --}}

                        @if ($showColumn['name'])
                            <td>
                                <a href="{{ route('user.show', $user->id) }}">
                                    {{ $user->crud_name() }}
                                </a>
                            </td>
                        @endif

                        @if ($showColumn['first_name'])
                            <td> {{ $user->first_name }} </td>
                        @endif

                        @if ($showColumn['last_name'])
                            <td> {{ $user->last_name }} </td>
                        @endif

                        @if ($showColumn['user_name'])
                            <td> {{ $user->user_name }} </td>
                        @endif

                        @if ($showColumn['email'])
                            <td> {{ $user->email }} </td>
                        @endif

                        @if ($showColumn['phone'])
                            <td> {{ $user->phone }} </td>
                        @endif

                        @if ($showColumn['gender'])
                            <td> {{ $user->gender }} </td>
                        @endif

                        @if ($showColumn['birth_day'])
                            <td> {{ $user->birth_day }} </td>
                        @endif

                        @if ($showColumn['status'])
                            <td> {{ $user->status }} </td>
                        @endif

                        @if ($showColumn['created_at'])
                            <td> {{ $user->created_at }} </td>
                        @endif

                        <td> {{ $user->rolesSideBySide() }} </td>

                        @role('owner')
                            <td>{!! $user->manager_names() !!}</td>
                            <td>{!! $user->department_names() !!}</td>
                        @endrole

                        <td>
                            @role('owner')
                                @if ($user->status != 'active')
                                    <button wire:click="activateUser({{ $user->id }})" class="btn btn-success">
                                        <i class="ti-unlock text-white"></i>
                                    </button>
                                @endif

                                @if ($user->status == 'active')
                                    <button wire:click="blockUser({{ $user->id }})" class="btn btn-danger">
                                        <i class="ti-lock text-white"></i>
                                    </button>
                                @endif
                            @endrole

                            @permission('show-user')
                                <a href="{{ route('user.show', $user) }}" target="_blank" class="btn btn-info">
                                    <i class="ti-eye text-white"></i>
                                </a>
                            @endpermission

                            <button data-toggle="modal" data-target="#update-user-modal"
                                wire:click="edit({{ $user->id }})" class="btn btn-primary">
                                <i class="ti-pencil text-white"></i>
                            </button>

                            <button class="btn btn-danger" type="button" data-toggle="modal"
                                data-target="#delete-user-{{ $user->id }}">
                                <i class="ti-trash text-white"></i>
                            </button>

                            <div id="delete-user-{{ $user->id }}" class="modal fade" tabindex="-1" role="dialog"
                                aria-labelledby="delete-user-{{ $user->id }}-title" aria-hidden="true">
                                <div class="modal-dialog" role="document">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title" id="delete-user-{{ $user->id }}-title">
                                                {{ $user->crud_name() }}
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

                                            <button wire:click="delete({{ $user->id }})" class="btn btn-danger"
                                                data-dismiss="modal">
                                                {{ __('global.delete') }}
                                            </button>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <button type="button" class="btn btn-warning " data-toggle="dropdown"
                                aria-expanded="false">
                                <i class="ti-agenda text-white"></i>
                            </button>
                            <div class="dropdown-menu">
                                <a class="dropdown-item"
                                    href="{{ route('repo_p6_r1_active.page', $user->id) }}">{{ __('global.tasks') }}</a>
                                <a class="dropdown-item"
                                    href="{{ route('repo_p6_r1_closed_soon.page', $user->id) }}">{{ __('global.repo-p6-r1') }}</a>
                                <a class="dropdown-item"
                                    href="{{ route('repo_p6_r2.page.user', $user->id) }}">{{ __('global.repo-p6-r2') }}</a>
                                <a class="dropdown-item"
                                    href="{{ route('repo_p7_r1.page.user', $user->id) }}">{{ __('global.repo-p8-r1') }}</a>
                                <a class="dropdown-item"
                                    href="{{ route('repo_p8_R2.page.user', $user->id) }}">{{ __('global.p8-r2') }}</a>
                                <a class="dropdown-item"
                                    href="{{ route('repo_p10_R1.page.user', $user->id) }}">{{ __('global.p10-r1') }}</a>
                                <a class="dropdown-item"
                                    href="{{ route('repo_p11.page.user', $user->id) }}">{{ __('global.p11') }}</a>
                                <a class="dropdown-item"
                                    href="{{ route('repo_p12.page.user', $user->id) }}">{{ __('global.p12') }}</a>
                                <a class="dropdown-item"
                                    href="{{ route('repo_p13.page.user', $user->id) }}">{{ __('global.p13') }}</a>
                            </div>

                        </td>
                    </tr>
                @endforeach
            </tbody>

        </table>

        {{ $users->links() }}
    </div>
</div>
