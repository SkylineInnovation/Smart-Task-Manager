<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>{{ env('APP_NAME', 'Codexal') }}</title>
</head>

<body>
    <h2>{{ __('email.there is new task assigned') }}</h2>

    <table style="width: 90%;">
        <tbody>
            <tr>
                <td>
                    <p style="font-weight: 900;">{{ __('task.start_time') }}:</p>
                </td>
                <td>
                    <p>{{ $task->format_date($task->start_time) }}</p>
                </td>

                <td>
                    <p style="font-weight: 900;">{{ __('task.end_time') }}:</p>
                </td>
                <td>
                    <p>{{ $task->format_date($task->end_time) }}</p>
                </td>
            </tr>

            <tr>
                <td>
                    <p style="font-weight: 900;">{{ __('task.title') }}:</p>
                </td>
                <td colspan="3">
                    <p>{{ $task->title }}</p>
                </td>
            </tr>
            {{--  --}}
            <tr>
                <td>
                    <p style="font-weight: 900;">{{ __('task.desc') }}:</p>
                </td>
                <td colspan="3">
                    <p>{{ $task->desc }}</p>
                </td>
            </tr>
            {{--  --}}

            <tr>
                <td>
                    <p style="font-weight: 900;">{{ __('task.priority_level') }}:</p>
                </td>
                <td>
                    <p>{{ $task->the_priority_level() }}</p>
                </td>

                <td>
                    <p style="font-weight: 900;">{{ __('task.status') }}:</p>
                </td>
                <td>
                    <p>{{ $task->the_status() }}</p>
                </td>
            </tr>
            {{--  --}}
        </tbody>
    </table>

    <a class="btn"
        style="color: #fff;
            background: #0774f8;
            border-color: #0774f8;
            box-shadow: 0 5px 10px rgba(7, 116, 248, 0.3);
            display: inline-block;
            text-align: center;
            white-space: nowrap;
            vertical-align: middle;
            -webkit-user-select: none;
            -moz-user-select: none;
            -ms-user-select: none;
            user-select: none;
            border: 1px solid transparent;
            padding: 0.375rem 0.75rem;
            font-size: 0.9375rem;
            line-height: 1.84615385;
            border-radius: 5px;
            transition: color 0.15s ease-in-out, background-color 0.15s ease-in-out,
            border-color 0.15s ease-in-out, box-shadow 0.15s ease-in-out;
            width: 90%;
            "
        href="{{ route('web.task', Crypt::encryptString($task->id)) }}">{{ __('email.Open Task') }}</a>

    <br>
    <p>Thank You</p>

    <div style="width:90%;">
        <div style="float: left">
            <a href="{{ env('APP_URL') }}">{{ env('APP_NAME') }}</a>
        </div>
        <div style="float: right">
            Power By
            <a href="{{ env('POWER_COMPANY_LINK', 'javascript:;') }}" target="_blank">
                {{ env('POWER_COMPANY_NAME', 'Codexal') }}
            </a>
        </div>
    </div>


</body>

</html>
