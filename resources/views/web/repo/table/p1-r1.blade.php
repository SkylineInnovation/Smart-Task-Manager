<!DOCTYPE html>
<html lang="ar" dir="rtl">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>المعهد الأهلي العالي للتدريب</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            text-align: center;
            margin: 20px;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
        }

        th,
        td {
            border: 1px solid black;
            padding: 10px;
            text-align: center;
        }

        th {
            background-color: #EFF9FF;
        }


        header {
            font-size: 18px;
            font-weight: bold;
            margin-bottom: 20px;
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
    <header>
        الحي الأول شمال الرياض<br>
        تحت إشراف المؤسسة العامة للتدريب التقني والمهني<br>
        تقرير مستمر عن المهام
    </header>
    <button onclick="window.print()">طباعة</button>
    <table>
        <tr>
            <th>رقم المهمة</th>
            <th>العنوان</th>
            <th>تاريخ الإنشاء</th>
            <th>جهة التكليف</th>
            <th>الموظفون</th>
            <th>تاريخ التسليم</th>
            <th>الحالة</th>
        </tr>
        @foreach ($tasks as $task)
            <tr>
                <td>{{ $task->id }}</td>
                <td>{{ $task->title }}</td>
                <td>{{ $task->created_at }}</td>
                <td>{{ $task->manager->crud_name() }}</td>
                <td>
                    {!! $task->employee_names() !!}
                </td>
                <td>{{ $task->format_date($task->end_time) }}</td>
                <td>{{ $task->status }}</td>
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
