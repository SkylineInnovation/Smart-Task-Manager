@extends('email.layout', [
    'task' => $task,
])

@section('title')
    {{ __('email.there-is-new-task') }}
@endsection

{{-- @section('content')
    <div>

        <h3>
            {{ __('email.there-is-a-new-attachment-on-the-task') }}
            <a href="{{ asset($attachment->file) }}">{{ __('global.view') }}</a>
        </h3>

        <hr>

        <h4>{{ __('attachment.user') }}: {{ $attachment->user->name() }}</h4>
        <h4>{{ __('attachment.title') }}: {{ $attachment->title }}</h4>
        <h4>{{ __('attachment.desc') }}: {{ $attachment->desc }}</h4>
    </div>
@endsection --}}
