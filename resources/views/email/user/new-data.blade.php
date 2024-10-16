@extends('email.layout')

@section('title')
    {{ __('email.there-is-new-user') }}
@endsection

@section('content')
    <div>

        <h3>
            {{ __('email.there-is-a-new-user-added') }}
        </h3>

        <hr>

        <h4>{{ __('user.first_name') }}: {{ $user->first_name }}</h4>
        <h4>{{ __('user.last_name') }}: {{ $user->last_name }}</h4>
        <h4>{{ __('user.email') }}: {{ $user->email }}</h4>
        <h4>{{ __('user.phone') }}: {{ $user->phone }}</h4>

    </div>
@endsection
