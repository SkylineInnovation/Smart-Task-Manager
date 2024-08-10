<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>{{ env('APP_NAME') }}</title>
</head>

<body>
    <h2>The Code For forget password</h2>

    <h4>the code for reset your password is : {{ $passwordCode->code }}</h4>

    <br>
    <p>Thank You</p>

    <a href="{{ env('APP_URL') }}">{{ env('APP_NAME') }}</a>
</body>

</html>
