@extends('layouts.livewire-app')
@section('css')
    {{-- <style>
        .scrollable-container {
            max-height: 200px;
            /* Adjust height as needed */
            overflow-y: auto;
            border: 1px solid #ddd;
            /* Optional: to highlight the scrollable area */
            padding: 10px;
            border-radius: 5px;
        }
    </style> --}}
@endsection

@section('content')
    <div class="">

        @if ($errors->any())
            <div class="alert alert-danger">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <div class="card">
            <div class="card-header">
                <h5 class="modal-title" id="exampleModalLongTitle">{{ __('global.create-permissions') }}</h5>
            </div>

            <div class="card-body">
                <form action="{{ route('web.permissions.update', $role) }}" enctype="multipart/form-data" method="post"
                    accept-charset="utf-8">
                    @csrf
                    <div class="modal-header">

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
                                <div class="row mt-3">
                                    <div class="col-12">
                                        <label for="role_name">{{ __('global.role_name') }}</label>
                                        <input value="{{ old('role_name', $role->name) }}" id="role_name"
                                            class="form-control" type="text" name="role_name"
                                            placeholder="{{ __('global.enter') }} {{ __('global.role_name') }}">
                                    </div>
                                    <div class="col-6">
                                        <label for="role_name_ar">{{ __('global.role_name_ar') }}</label>
                                        <input value="{{ old('role_name_ar', $role->the_display_name('ar')) }}"
                                            id="role_name_ar" class="form-control" type="text" name="role_name_ar"
                                            placeholder="{{ __('global.enter') }} {{ __('global.role_name_ar') }}">
                                    </div>
                                    <div class="col-6">
                                        <label for="role_name_en">{{ __('global.role_name_en') }}</label>
                                        <input value="{{ old('role_name_en', $role->the_display_name('en')) }}"
                                            id="role_name_en" class="form-control" type="text" name="role_name_en"
                                            placeholder="{{ __('global.enter') }} {{ __('global.role_name_en') }}">
                                    </div>
                                    <div class="col-12">
                                        <label for="role_description_ar">{{ __('global.role_description_ar') }}</label>
                                        <textarea name="role_description_ar" id="role_description_ar" rows="3"class="form-control"
                                            placeholder="{{ __('global.enter') }} {{ __('global.role_description_ar') }}">{{ old('role_description_ar', $role->the_description('ar')) }}</textarea>
                                    </div>
                                    <div class="col-12">
                                        <label for="role_description_en">{{ __('global.role_description_en') }}</label>
                                        <textarea name="role_description_en" id="role_description_en" rows="3"class="form-control"
                                            placeholder="{{ __('global.enter') }} {{ __('global.role_description_en') }}">{{ old('role_description_en', $role->the_description('en')) }}</textarea>
                                    </div>
                                </div>
                            </div>

                            <div class="tab-pane fade scrollable-container" id="profile" role="tabpanel"
                                aria-labelledby="profile-tab" style="">

                                <div class="form-check">
                                    @foreach ($permissions as $rp)
                                        <div class="form-check-item">
                                            <input class="form-check-input" type="checkbox" value="{{ $rp->id }}"
                                                id="permission-{{ $rp->id }}" name="permissions[]"
                                                @if (old('permissions')) @if (in_array($rp->id, old('permissions', []))) checked @endif
                                            @else @if ($rp->roles->contains($role)) checked @endif @endif>
                                            <label class="form-check-label me-4" for="permission-{{ $rp->id }}">
                                                {{ $rp->the_display_name() }}
                                            </label>
                                        </div>
                                    @endforeach
                                </div>
                            </div>

                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="submit" class="btn btn-primary">{{ __('global.Save changes') }}</button>
                    </div>
                </form>
            </div>
        </div>


    </div>
@endsection
