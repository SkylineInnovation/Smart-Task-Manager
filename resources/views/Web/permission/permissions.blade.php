@extends('layouts.livewire-app')
@section('css')
    <style>
        .scrollable-container {
            max-height: 200px;
            /* Adjust height as needed */
            overflow-y: auto;
            border: 1px solid #ddd;
            /* Optional: to highlight the scrollable area */
            padding: 10px;
            border-radius: 5px;
        }
    </style>
@endsection

@section('content')
    <div class="">


        <div class="card">
            <div class="card-body">
                <div class="col-md-2 py-5">
                    <button class="btn btn-primary-gradient" data-toggle="modal" data-target="#exampleModalCenter">
                        <i class="fa fa-plus"></i>
                    </button>
                </div>
                <div class="table-responsive">
                    <table class="table table-bordered">

                        <thead>
                            <tr>
                                {{-- <th class="col-1" scope="col">#</th> --}}
                                <th class="col-4" scope="col">{{ __('global.Group number') }}</th>
                                <th class="col-4" scope="col">{{ __('global.Group name') }}</th>
                                <th class="col-3" scope="col">{{ __('global.Number of users') }}</th>
                                <th class="col-3" scope="col">{{ __('global.action') }}</th>
                            </tr>
                        </thead>
                        <tbody>

                            @foreach ($roles as $role)
                                <tr>
                                    <th scope="row">{{ $role->id }}</th>
                                    {{-- <td>{{ $loop->index }}</td> --}}
                                    <td>{{ $role->display_name }}</td>
                                    <td>{{ $role->users_count() }}</td>
                                    <td>
                                        @if (!in_array($role->name, ['owner', 'manager', 'employee', 'financial', 'technical']))
                                            <button data-toggle="modal" data-target="#delete-role-{{ $role->id }}"
                                                class="btn btn-danger-gradient">
                                                <i class='fa fa-trash'></i>
                                            </button>
                                            <!-- Modal -->
                                            <div class="modal fade" id="delete-role-{{ $role->id }}" tabindex="-1"
                                                role="dialog" aria-labelledby="delete-role-Label" aria-hidden="true">
                                                <div class="modal-dialog" role="document">
                                                    <div class="modal-content">

                                                        <form action="{{ route('delete.id', $role) }}" method="post">
                                                            @csrf

                                                            <div class="modal-header">
                                                                <h5 class="modal-title" id="delete-role-Label">
                                                                    {{ __('global.delete') }}
                                                                    {{ $role->display_name }}
                                                                </h5>
                                                                <button type="button" class="close" data-dismiss="modal"
                                                                    aria-label="Close">
                                                                    <span aria-hidden="true">&times;</span>
                                                                </button>
                                                            </div>

                                                            <div class="modal-footer">
                                                                <button type="button" class="btn btn-secondary"
                                                                    data-dismiss="modal">{{ __('global.Close') }}</button>
                                                                <button type="submit"
                                                                    class="btn btn-primary">{{ __('global.delete') }}</button>
                                                            </div>
                                                        </form>
                                                    </div>
                                                </div>
                                            </div>
                                        @endif
                                    </td>
                                </tr>
                            @endforeach

                        </tbody>
                    </table>
                </div>
            </div>
        </div>


    </div>

    <!-- Button trigger modal -->


    <!-- Modal -->
    <div class="modal fade" id="exampleModalCenter" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle"
        aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <form action="{{ route('web.permissions.create') }}" enctype="multipart/form-data" method="post"
                    accept-charset="utf-8">
                    @csrf
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLongTitle">{{ __('global.create-permissions') }}</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <ul class="nav nav-tabs" id="myTab" role="tablist">
                            <li class="nav-item col-6 ">
                                <a class="nav-link d-flex justify-content-center active  w-100" id="home-tab"
                                    data-toggle="tab" href="#home" role="tab" aria-controls="home"
                                    aria-selected="true">
                                    {{ __('global.Role') }}
                                </a>
                            </li>
                            <li class="nav-item col-6 ">
                                <a class="nav-link d-flex justify-content-center w-100" id="profile-tab" data-toggle="tab"
                                    href="#profile" role="tab" aria-controls="profile" aria-selected="false">
                                    {{ __('global.Permission') }}
                                </a>
                            </li>

                        </ul>
                        <div class="tab-content" id="myTabContent">
                            <div class="tab-pane fade show active" id="home" role="tabpanel"
                                aria-labelledby="home-tab">
                                <div class="py-3">
                                    <label for="role_name">{{ __('global.role_name') }}</label>
                                    <input class="form-control" type="text" name="role_name">
                                </div>
                            </div>

                            <div class="tab-pane fade scrollable-container" id="profile" role="tabpanel"
                                aria-labelledby="profile-tab" style="">

                                <div class="form-check">
                                    @foreach ($permissions as $rp)
                                        <div class="form-check-item">
                                            <input class="form-check-input" type="checkbox" value="{{ $rp->id }}"
                                                id="permission-{{ $rp->id }}" name="permissions[]">
                                            <label class="form-check-label me-4" for="permission-{{ $rp->id }}">
                                                {{ $rp->display_name }}
                                            </label>
                                        </div>
                                    @endforeach
                                </div>
                            </div>

                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary"
                            data-dismiss="modal">{{ __('global.Close') }}</button>
                        <button type="submit" class="btn btn-primary">{{ __('global.Save changes') }}</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
