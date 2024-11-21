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
</body>

</html>
