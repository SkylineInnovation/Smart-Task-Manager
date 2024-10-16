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
    </div>
@endsection
