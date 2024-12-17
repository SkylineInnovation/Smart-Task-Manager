<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Exchange Permission</title>
</head>

<body>
    <table style="width:100%">
        <tr>
            <th>{{ __('exchangepermission.content') }}</th>
            <th>{{ __('exchangepermission.amount') }}</th>
            <th>{{ __('exchangepermission.attachment') }}</th>
        </tr>
        <tr>
            <td>{{ $exchangePermission->content }}</td>
            <td>{{ $exchangePermission->amount }}</td>
            <td>
                <a href="{{ asset($exchangePermission->attachment) }}">{{ __('exchangepermission.attachment') }}</a>
            </td>
        </tr>

    </table>

    @if ($role != 'owner')
        {{--  --}}
        <a style="color: #fff; background: #0774f8; border-color: #0774f8;
                box-shadow: 0 5px 10px rgba(7, 116, 248, 0.3); display: inline-block;
                text-align: center; white-space: nowrap; vertical-align: middle;
                -webkit-user-select: none; -moz-user-select: none; -ms-user-select: none;
                user-select: none; border: 1px solid transparent;
                padding: 0.375rem 0.75rem; font-size: 0.9375rem; line-height: 1.84615385; border-radius: 5px;
                transition: color 0.15s ease-in-out, background-color 0.15s ease-in-out,
                border-color 0.15s ease-in-out, box-shadow 0.15s ease-in-out; width: 45%;"
            href="{{ route('web.exchange.accept', [$userID, Crypt::encryptString($exchangePermission->id)]) }}">
            {{ __('global.Accept') }}
        </a>
        {{--  --}}
        <a style="color: #fff; background: #f82649; border-color: #ed314c;
                box-shadow: 0 5px 10px rgba(7, 116, 248, 0.3); display: inline-block;
                text-align: center; white-space: nowrap; vertical-align: middle;
                -webkit-user-select: none; -moz-user-select: none; -ms-user-select: none;
                user-select: none; border: 1px solid transparent;
                padding: 0.375rem 0.75rem; font-size: 0.9375rem; line-height: 1.84615385; border-radius: 5px;
                transition: color 0.15s ease-in-out, background-color 0.15s ease-in-out,
                border-color 0.15s ease-in-out, box-shadow 0.15s ease-in-out; width: 45%;"
            href="{{ route('web.exchange.reject', [$userID, Crypt::encryptString($exchangePermission->id)]) }}">
            {{ __('global.Reject') }}
        </a>
        {{--  --}}
    @endif

</body>

</html>
