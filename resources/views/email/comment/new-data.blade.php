@extends('email.layout', [
    'task' => $comment->task,
])

@section('title')
    {{ __('email.there-is-new-comment') }}
@endsection

@section('content')
    <div>

        <h3>
            {{ __('email.there-is-a-new-comment-on-the-task') }}
        </h3>

        <hr>

        <h4>{{ __('comment.user') }}: {{ $comment->user->name() }}</h4>
        <h4>{{ __('comment.title') }}: {{ $comment->title }}</h4>
        <h4>{{ __('comment.desc') }}: {{ $comment->desc }}</h4>
    </div>
@endsection
