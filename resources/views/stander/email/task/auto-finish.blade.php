<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>{{ env('APP_NAME') }}</title>
</head>

<body>
    <h2>the task finished automatically</h2>

    <p>{{ $task->title }}</p>

    <hr>
    <p>{{ $task->format_date($task->start_time) }}</p>
    <p>{{ $task->format_date($task->end_time) }}</p>
    <hr>
    <p>{{ $task->the_status() }}</p>

    {{-- <a class="btn btn-info" href="{{ route('dashboard', $task) }}">Open</a> --}}

    <br>
    <p>Thank You</p>

    <a href="{{ env('APP_URL') }}">{{ env('APP_NAME') }}</a>
</body>

</html>
