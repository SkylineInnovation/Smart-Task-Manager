@extends('email.layout', [
    'task' => $extra_time->task,
])

@section('title')
    {{ __('email.there-is-new-extra-time') }}
@endsection

@section('content')
    <div>

        <h3>
            {{ __('email.there-is-a-new-extra-time-on-the-task') }}
        </h3>

        <hr>


        <h4>{{ __('extratime.user') }}: {{ $extra_time->user->name() }}</h4>
        <h4>{{ __('extratime.reason') }}: {{ $extra_time->reason }}</h4>
        <h4>{{ __('extratime.from_time') }}: {{ $extra_time->from_time }}</h4>
        <h4>{{ __('extratime.to_time') }}: {{ $extra_time->to_time }}</h4>
        <h4>{{ __('extratime.request_time') }}: {{ $extra_time->request_time }}</h4>
        <h4>{{ __('extratime.response_time') }}: {{ $extra_time->response_time }}</h4>
        <h4>{{ __('extratime.status') }}: {{ $extra_time->status }}</h4>
        <h4>{{ __('extratime.duration') }}: {{ $extra_time->duration }}</h4>

        {{--  --}}

        @if ($role == 'manager')
            {{--  --}}
            <a style="color: #fff; background: #0774f8; border-color: #0774f8;
                box-shadow: 0 5px 10px rgba(7, 116, 248, 0.3); display: inline-block;
                text-align: center; white-space: nowrap; vertical-align: middle;
                -webkit-user-select: none; -moz-user-select: none; -ms-user-select: none;
                user-select: none; border: 1px solid transparent;
                padding: 0.375rem 0.75rem; font-size: 0.9375rem; line-height: 1.84615385; border-radius: 5px;
                transition: color 0.15s ease-in-out, background-color 0.15s ease-in-out,
                border-color 0.15s ease-in-out, box-shadow 0.15s ease-in-out; width: 45%;"
                href="{{ route('web.exchange.accept', [$userID, Crypt::encryptString($extra_time->id)]) }}">
                {{ __('global.Accept') }}
            </a>
            {{--  --}}
            <a style="color: #fff; background: #f82649; border-color: #ed314c;
                box-shadow: 0 5px 10px rgba(7, 116, 248, 0.3); display: inline-block;
                text-align: center; white-space: nowrap; vertical-align: middle;
                -webkit-user-select: none; -moz-user-select: none; -ms-user-select: none;
                user-select: none; border: 1px solid transparent;
                padding: 0.375rem 0.75rem; font-size: 0.9375rem; line-height: 1.84615385; border-radius: 5px;
                transition: color 0.15s ease-in-out, background-color 0.15s ease-in-out,
                border-color 0.15s ease-in-out, box-shadow 0.15s ease-in-out; width: 45%;"
                href="{{ route('web.exchange.reject', [$userID, Crypt::encryptString($extra_time->id)]) }}">
                {{ __('global.Reject') }}
            </a>
            {{--  --}}
        @endif
    </div>
@endsection
