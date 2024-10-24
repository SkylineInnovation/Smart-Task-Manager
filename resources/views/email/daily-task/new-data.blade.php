@extends('email.layout')

@section('title')
    {{ __('email.there-is-new-daily-task') }}
@endsection

@section('content')
    <div>

        <h3>
            {{ __('email.there-is-a-new-daily-task-on-the-task') }}
        </h3>

        {{-- <h4>{{ __('dailytask.title') }}: {{ $daily_task->title }}</h4> --}}
    </div>
@endsection
