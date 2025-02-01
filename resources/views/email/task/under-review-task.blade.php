@extends('email.layout', [
    'task' => $task,
])

@section('title')
    {{ __('email.under-review') }}
@endsection

@section('content')
    <div>

        <h3>
            {{ __('email.task-under-review') }}
        </h3>

        <hr>

    </div>
@endsection
