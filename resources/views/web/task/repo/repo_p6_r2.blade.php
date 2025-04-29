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
            background-color: white;
            font-weight: bold;
        }


        .header-row {
            background-color: #e0e0e0;
        }

        .sub-header {
            background-color: #f9f9f9;
        }

        .text-right {
            text-align: right;
        }

        .text-center {
            text-align: center;
        }

        th.bg-top {
            background: #ECFBFF
        }

        td.bg-green {
            background-color: #00CF87;
            color: white
        }

        td.bg-pink {
            background: #EF9591;
            color: white
        }

        td.bg-center {
            background: #EBEBEB
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
    <button class="header" style="margin: 20px" onclick="window.print()">طباعة</button>
    <table>
        <thead>
            <tr class="header-row">
                <th colspan="2" class="bg-top">المرسل</th>
                <th colspan="2"></th>
                <th colspan="2" class="bg-top">تاريخ الحركة</th>
            </tr>
        </thead>
        <tbody>

            <tr>
                <td colspan="2" class="bg-green"> {{ $task->manager->crud_name() }}</td>
                <td colspan="2" class="bg-center">
                    {{ $task->title }}
                </td>
                <td colspan="2" class="bg-pink">{{ $task->format_date($task->created_at) }}</td>
            </tr>
            <tr>
                <td colspan="6">
                    {{ $task->desc }}

                </td>
            </tr>



            {{-- <tr>
                <td colspan="6">
                    6-3 إذ يتم استخدامها، العمل يوم الثلاث، 01-28-2015م بسبب انعاذ الجهاز المختصة للشرع
                    والتهاء، جعلت تحديد قناعات الجواهران 02-2025م ومكتب المتعهد في التهام القليم


                </td>
            </tr>
            <tr>
                <td colspan="2" class="bg-green">احمد عبدوو</td>
                <td colspan="2" class="bg-center">
                    استحقاق السؤالات/نتاج الصينامي والسالي المدارس والتيحات وأهواتف
                </td>
                <td colspan="2" class="bg-pink">14729-14730</td>
            </tr>
            <tr>
                <td colspan="6">
                    6-3 إذ يتم استخدامها، العمل يوم الثلاث، 01-28-2015م بسبب انعاذ الجهاز المختصة للشرع
                    والتهاء، جعلت تحديد قناعات الجواهران 02-2025م ومكتب المتعهد في التهام القليم


                </td>
            </tr>
            <tr>
                <td colspan="2" class="bg-green">احمد عبدوو</td>
                <td colspan="2" class="bg-center">
                    استحقاق السؤالات/نتاج الصينامي والسالي المدارس والتيحات وأهواتف
                </td>
                <td colspan="2" class="bg-pink">14729-14730</td>
            </tr>
            <tr>
                <td colspan="6">
                    6-3 إذ يتم استخدامها، العمل يوم الثلاث، 01-28-2015م بسبب انعاذ الجهاز المختصة للشرع
                    والتهاء، جعلت تحديد قناعات الجواهران 02-2025م ومكتب المتعهد في التهام القليم


                </td>
            </tr> --}}
        </tbody>
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
