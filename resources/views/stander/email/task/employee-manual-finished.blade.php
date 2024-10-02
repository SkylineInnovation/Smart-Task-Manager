<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>{{ env('APP_NAME') }}</title>
</head>

<body>
    <h2>{{ __('email.there is new task assigned') }}</h2>

    <p>{{ $task->title }}</p>
    <p>{{ $task->desc }}</p>
    <hr>
    <p>{{ $task->format_date($task->start_time) }}</p>
    <p>{{ $task->format_date($task->end_time) }}</p>
    <hr>
    <p>{{ $task->priority_level }}</p>
    <p>{{ $task->status }}</p>

    <a class="btn btn-info" href="{{ route('task.show', $task) }}">{{ __('email.Open Task') }}</a>

    <br>
    <p>{{ __('email.Thank You') }}</p>

    <a href="{{ env('APP_URL') }}">{{ env('APP_NAME') }}</a>
</body>

</html>
