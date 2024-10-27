@extends('email.layout', [
    'task' => $task,
])

@section('title')
    {{ __('email.urgent-task-reminder') }}
@endsection

@section('content')
    <div>

        <h3>
            {{ __('email.urgent-task-reminder') }}
        </h3>

        <hr>

    </div>
@endsection
