@extends('email.layout', [
    'task' => $leave->task,
])

@section('title')
    {{ __('email.there-is-new-leave') }}
@endsection

@section('content')
    <div>

        <h3>
            {{ __('email.there-is-a-new-leave-on-the-task') }}
        </h3>

        <hr>

        <h4>{{ __('leave.user') }}: {{ $leave->user->name() }}</h4>
        <h4>{{ __('leave.type') }}: {{ $leave->the_type() }}</h4>
        <h4>{{ __('leave.time_out') }}: {{ $leave->time_out }}</h4>
        <h4>{{ __('leave.time_in') }}: {{ $leave->time_in }}</h4>
        <h4>{{ __('leave.effect_on_time') }}: {{ $leave->effect_on_time }}</h4>
        <h4>{{ __('leave.reason') }}: {{ $leave->reason }}</h4>
        <h4>{{ __('leave.status') }}: {{ $leave->the_status() }}</h4>

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
                href="{{ route('web.exchange.accept', [$userID, Crypt::encryptString($leave->id)]) }}">
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
                href="{{ route('web.exchange.reject', [$userID, Crypt::encryptString($leave->id)]) }}">
                {{ __('global.Reject') }}
            </a>
            {{--  --}}
        @endif
    </div>
@endsection
