@extends('layouts.main')


@section('content')
    <!-- ROW-1 OPEN -->
    <div class="row">
        <div class="col-lg-4 col-xl-4 col-md-12 col-sm-12">
            <div class="card">
                <div class="card-body">
                    <div class="text-center">
                        <div class="userprofile">
                            <div class="userpic brround">
                                <img src="{{ asset($user->image) }}" alt="">
                            </div>
                            <h3 class="username text-dark mb-2">{{ $user->name() }}</h3>
                            <p class="mb-1 text-muted">{{ $user->rolesSideBySide() }}</p>
                            <div class="text-center mb-4">
                                {{-- <span><i class="fa fa-star text-warning"></i></span> --}}
                                {{-- <span><i class="fa fa-star-half-o text-warning"></i></span> --}}
                                <span><i class="fa fa-star-o text-warning"></i></span>
                                <span><i class="fa fa-star-o text-warning"></i></span>
                                <span><i class="fa fa-star-o text-warning"></i></span>
                                <span><i class="fa fa-star-o text-warning"></i></span>
                                <span><i class="fa fa-star-o text-warning"></i></span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="card">
                <div class="card-header">
                    <div class="card-title">{{ __('user.edit-password') }}</div>
                </div>
                <form action="{{ route('update.password') }}" enctype="multipart/form-data" method="post"
                    accept-charset="utf-8" class="form-horizontal">

                    @csrf
                    <div class="card-body">
                        <div class="row">

                            <!-- Current Password -->
                            {{-- @include('inputs.create.input', [
                                'label' => 'user.current_password',
                                'name' => 'current_password',
                                'required' => 'required',
                                'type' => 'password',
                                'lg' => 12, 'md' => 12, 'sm' => 12,
                            ]) --}}

                            <!-- New Password -->
                            @include('inputs.create.input', [
                                'label' => 'user.new_password',
                                'name' => 'new_password',
                                'required' => 'required',
                                'type' => 'password',
                                'lg' => 12,
                                'md' => 12,
                                'sm' => 12,
                            ])

                            <!-- Confirm New Password -->
                            @include('inputs.create.input', [
                                'label' => 'user.confirm_password',
                                'name' => 'confirm_password',
                                'required' => 'required',
                                'type' => 'password',
                                'lg' => 12,
                                'md' => 12,
                                'sm' => 12,
                            ])

                        </div>


                    </div>
                    <div class="card-footer ">
                        <div class="form-group">
                            <button type="submit" class="btn btn-primary w-100"> {{ __('global.save-changes') }} </button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
        <div class="col-lg-8 col-xl-8 col-md-12 col-sm-12">
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">{{ __('user.edit-profile') }}</h3>
                </div>

                <form action="{{ route('update.profile') }}" enctype="multipart/form-data" method="post"
                    accept-charset="utf-8" class="form-horizontal">

                    @csrf
                    <div class="card-body">
                        <div class="row">

                            @include('inputs.edit.input', [
                                'label' => 'user.first_name',
                                'name' => 'first_name',
                                'val' => $user->first_name,
                                'required' => 'required',
                            ])

                            @include('inputs.edit.input', [
                                'label' => 'user.last_name',
                                'name' => 'last_name',
                                'val' => $user->last_name,
                                'required' => 'required',
                            ])

                            @include('inputs.edit.input', [
                                'label' => 'user.user_name',
                                'name' => 'user_name',
                                'val' => $user->user_name,
                                'required' => 'required',
                            ])

                            @include('inputs.edit.input', [
                                'label' => 'user.email',
                                'name' => 'email',
                                'val' => $user->email,
                                'type' => 'email',
                                'required' => 'required',
                            ])

                            @include('inputs.edit.input', [
                                'label' => 'user.phone',
                                'name' => 'phone',
                                'val' => $user->phone,
                                'type' => 'tel',
                                'required' => 'required',
                            ])

                            <div class="col-lg-6 col-md-6 col-sm-12">
                                <div class="form-group">
                                    <label for="gender"
                                        class="block font-medium text-sm text-gray-700">{{ __('user.gender') }}</label>
                                    <select name="gender" id="gender"
                                        class="form-control rounded-md shadow-sm border-gray-300 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 @error('gender') is-invalid @enderror">
                                        <option value="male">Male</option>
                                        <option value="female">Female</option>
                                    </select>

                                    @error('gender')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>

                            @include('inputs.edit.input', [
                                'label' => 'user.birth_day',
                                'name' => 'birth_day',
                                'val' => $user->birth_day,
                                'type' => 'date',
                                'required' => 'required',
                            ])

                        </div>

                        {{-- <x-input-label for="textarea" :value="__('user.textarea')" />
                            <x-textarea id="textarea" class="block mt-1 w-full" type="text" name="textarea" :value="old('textarea')" required/> --}}


                    </div>
                    <div class="card-footer">
                        <div class="form-group">
                            <button type="submit" class="btn btn-success w-100"> {{ __('global.save-changes') }} </button>
                        </div>
                    </div>
                </form>

            </div>
        </div>
    </div>
    <!-- ROW-1 CLOSED -->
@endsection
