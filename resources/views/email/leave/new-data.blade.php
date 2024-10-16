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
    </div>
@endsection
