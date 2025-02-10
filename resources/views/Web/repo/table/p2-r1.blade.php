<!DOCTYPE html>
<html lang="ar" dir="rtl">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>المعهد الأهلي العالي للتدريب</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 20px;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 20px;
        }

        th,
        td {
            border: 1px solid #000;
            padding: 8px;
            text-align: center;
        }

        th {
            background-color: #ffffff;
        }

        .header {
            text-align: center;
            font-size: 20px;
            font-weight: bold;
            margin-bottom: 20px;
        }

        .sub-header {
            text-align: center;
            font-size: 16px;
            margin-bottom: 20px;
        }

        .color {
            background-color: #F0F9FF;
            color: black;
        }

        .color-commints {
            color: black;
            background: #E8E8E8
        }

        .color-darker {

            color: black;
            background: #BBBBBB
        }

        @media print {
            button {
                display: none !important;
            }

            body {
                background: white !important;
            }
        }
    </style>
</head>

<body>

    <h5 class="">المعهد الأهلي العالي للتدريب</h5>
    <h5 class="">عرض سكاكا ـ رفعاء ـ التربات ـ حفر الباطن</h5>


    <h2 class="sub-header">المعهد الأهلي العالي للتدريب</h2>
    <button class="header" onclick="window.print()">طباعة</button>
    <table>

        <tr>
            <th class="color">رقم المهمة</th>
            <th>{{ $task->id }}</th>
            <th class="color">عنوان المهمة</th>
            <th colspan="5" class="">{{ $task->title }}</th>
        </tr>
        <tr>
            <th class="color">جهة التكليف</th>
            <th>{{ $task->manager->crud_name() }}</th>
            <th class="color">الموظفون</th>
            <th colspan="3">{!! $task->employee_names() !!}</th>
            <th class="color">تاريخ الإستلام</th>
            <th>{{ $task->created_at }}</th>

        </tr>
        <tr>
            <th colspan="8" class="color-darker">الإنجازات والتعليقات خلال هذه الفترة</th>
        </tr>


        @foreach ($comments as $comm)
            <tr>
                <th class="color">المرسل</th>
                <th colspan="3"> {{ $comm->user->crud_name() }} </th>
                <th class="color">تاريخ التعليق</th>
                <th>{{ $comm->created_at->format('Y-m-d') }}</th>
                <th class="color">وقت التعليق</th>
                <th>{{ $comm->created_at->format('h:m:s') }}</th>
            </tr>

            <tr>
                <th colspan="8" class="color-commints">
                    {{ $comm->desc }}
                </th>
            </tr>
        @endforeach
    </table>

    <script>
        // Disable right-click
        document.addEventListener("contextmenu", function(e) {
            e.preventDefault();
        });

        // Disable certain key combinations
        document.addEventListener("keydown", function(e) {
            if (
                e.keyCode == 123 || // F12
                (e.ctrlKey && e.shiftKey && e.keyCode == 73) || // Ctrl + Shift + I
                (e.ctrlKey && e.shiftKey && e.keyCode == 74) || // Ctrl + Shift + J
                (e.ctrlKey && e.keyCode == 85) // Ctrl + U (View Source)
            ) {
                e.preventDefault();
            }
        });

        // Detect and close developer tools
        (function() {
            var element = new Image();
            Object.defineProperty(element, "id", {
                get: function() {
                    alert("تم اكتشاف أدوات المطور! الرجاء عدم محاولة الفحص.");
                    window.location.reload();
                },
            });
            console.log("%c", element);
        })();
    </script>

</body>

</html>
