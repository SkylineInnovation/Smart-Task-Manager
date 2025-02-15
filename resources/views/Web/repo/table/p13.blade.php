<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <title>Document</title>

</head>
<style>
    body {
        font-family: Arial, sans-serif;

        margin: 0;
        padding: 20px;
        direction: rtl;
    }

    .container {
        background-color: #fff;
        padding: 20px;
        border-radius: 8px;
        box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        /* max-width: 600px; */
        margin: auto;
        min-height: 93vh;
    }

    .container-table {
        background-color: #fff;
        padding: 20px;
        border-radius: 8px;
        box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        /* max-width: 600px; */
        margin: auto;
        margin-top: 30px;


    }

    .header {
        font-size: 18px;
        font-weight: bold;
        margin-bottom: 20px;
        text-align: center;
    }

    .content {
        font-size: 14px;
        line-height: 1.6;
    }

    .content table {
        width: 100%;
        border-collapse: collapse;
        margin-bottom: 20px;
    }

    .content table td {
        padding: 10px;
        border: 1px solid #ddd;
    }

    .footer {
        font-size: 12px;
        text-align: center;
        margin-top: 20px;
    }

    table {
        width: 100%;
        border-collapse: collapse;
        margin-bottom: 20px;
    }

    th,
    td {
        padding: 12px;
        border: 1px solid #ddd;
        text-align: center;
    }

    th {

        font-weight: bold;
    }

    .footer {
        font-size: 12px;
        text-align: center;
        margin-top: 20px;
    }



    th {
        background: #F2F4FA;
        color: #9599a6
    }

    .mt {
        margin-top: 30px
    }

    .btn-white {
        background-color: #ffffff;
        color: #000;
        /* Black text */
        border: 1px solid #ddd;
        /* Light gray border */
        transition: all 0.3s ease-in-out;
    }

    .btn-white:hover {
        background-color: #f8f9fa;
        /* Light gray background on hover */
        color: #000;
        border-color: #ccc;
    }

    .btn-white:active,
    .btn-white:focus {
        background-color: #f1f1f1;
        box-shadow: 0 0 5px rgba(0, 0, 0, 0.2);
        border-color: #bbb;
    }


    @media print {

        .row {
            display: none !important;
        }

        body {
            background: white !important;
        }

        .container-table {
            background-color: #fff;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            /* max-width: 600px; */
            margin: auto;
            margin-top: 30px;

        }
    }
</style>

<body>
    <div class="container-table">

        <div class="row w-100 m-0 justify-content-between">
            <div class="col-4">
                <button class="btn btn-white" onclick="window.print()">طباعة</button>
            </div>

            <div class="col-4 text-start ">
                <input type="text" id="searchInput" class="form-control mb-3" placeholder="Search...">
            </div>
        </div>

        <table>
            <thead>
                <tr>
                    <th>#</th>
                    <th>رقم الاذن</th>
                    <th>البيان</th>
                    <th>المبلغ المطلوب</th>
                    <th>الموظف</th>
                    <th>تاريخ الاذن</th>
                    <th>رد المدير المالي </th>
                    <th>تاريخ رد المدير المالي </th>
                    <th>رد المدير الفني</th>
                    <th> تاريخ رد المدير الفني</th>

                </tr>

            </thead>

            <tbody id="tableBody">
                @foreach ($exchanges as $exchange)
                    <tr>
                        <td>{{ $loop->index + 1 }}</td>
                        <td>{{ $exchange->id }}</td>
                        <td>{{ $exchange->content }}</td>
                        <td>{{ $exchange->amount }}</td>
                        <td>{{ $exchange->user->crud_name() }}</td>
                        <td>{{ $exchange->created_at->format('h:m:s') }}</td>
                        <td>

                            {{ $exchange->financial_director_response }}
                        </td>
                        <td>{{ $exchange->financial_director_time }}</td>
                        <td>{{ $exchange->technical_director_response }}</td>
                        <td>{{ $exchange->technical_director_time }}</td>

                    </tr>
                @endforeach
            </tbody>
        </table>


    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous">
    </script>
    <script>
        document.getElementById('searchInput').addEventListener('keyup', function() {
            let filter = this.value.toLowerCase();
            let rows = document.querySelectorAll('#tableBody tr');

            rows.forEach(row => {
                let text = row.textContent.toLowerCase();
                row.style.display = text.includes(filter) ? '' : 'none';
            });
        });
    </script>
</body>

</html>
