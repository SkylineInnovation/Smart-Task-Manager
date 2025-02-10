<!DOCTYPE html>
<html lang="ar" dir="rtl">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>التقرير المالي</title>
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
            background-color: #EEF9FF;
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

    <div class="header">المعهد الاهلي المالي للتدريب</div>
    <div class="sub-header">تحت اشراف المؤسسة العامة للتدريب المهني والكتابي</div>
    <div class="sub-header">تقرير عن النهاء المالي على تاريخ إعلانها أقل من 72 سنة (ثلاث أية) من تاريخ اليوم</div>
    <button class="header" onclick="window.print()">طباعة</button>
    <table>
        <tr>
            <th>رقم المهمة علوان المهمة</th>
            <th> الوقت المتبقي للاغلاق </th>
            <th>عدد طلبات الاغلاق</th>
            <th>عدد طلبات التمديد</th>
            <th>عدد طلبات المغادرات</th>
            <th>عدد الخصومات </th>
            <th>تاريخ الاغلاق</th>
        </tr>
        @foreach ($tasks as $task)
            <tr>
                <td>{{ $task->title }}</td>
                <td>{{ $task->remaining_time }}</td>
                {{-- TODO --}}
                <td>0</td>
                {{-- End TODO --}}
                <td>{{$task->extra_times->count()}}</td>
                <td>{{$task->leaves_times->count()}}</td>
                <td>{{$task->discounts->sum()}}</td>
                <td>{{$task->format_date($task->end_time)}}</td>
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
