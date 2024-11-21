<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Change Exchange </title>
</head>

<body>


    @if ($changeExchange->financial_director_response == 'accept')
        your request have been approve by {{ $changeExchange->financial_director->name() }}
        your request have been approve by {{ $changeExchange->technical_director->name() }}
    @else
        your request have been reject by {{ $changeExchange->financial_director->name() }}
        your request have been reject by {{ $changeExchange->technical_director->name() }}
    @endif




</body>

</html>
