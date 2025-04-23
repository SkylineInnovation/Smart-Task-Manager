<!DOCTYPE html>
<html lang="en" dir="rtl">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Table Example</title>
    <style>
        body {
            font-family: Arial, sans-serif;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin: 20px 0;
        }

        th,
        td {
            border: 1px solid #ddd;
            padding: 8px;
            text-align: center;
        }

        th {
            background-color: #EEF9FF;
            font-weight: bold;
        }



        tr:hover {
            background-color: #f1f1f1;
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

        td.greenBG {
            background: #00B035;
            color: white;
            text-align: center
        }

        td.pinkBG {
            background: #FF9096;
            color: black;
            text-align: center
        }

        td.grayBG {
            background: #D6D6D6;
            color: black;
            text-align: center
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
        <thead>
            <tr>
                <th>رقم المهمة/ عنوان الجهة</th>
                <th>تاريخ الإعلاق</th>
                <th>حالة المهمة</th>
                <th>إجمالي الخصومات البدوية</th>
                <th>حالة الجمعية الإلكترونية</th>
                <th>التقييم</th>

            </tr>
        </thead>
        <tbody>
            <tr>
                <td class="greenBG" colspan="6">
                    {{ $taskM->manager->crud_name() }}
                </td>
            </tr>
            
                <tr>
                    <td>{{ $taskM->title.' '.$taskM->id}}</td>
                    <td>{{ $taskM->format_date($taskM->end_time) }}</td>
                    <td>{{ $taskM->status }}</td>
                    <td>{{ $taskM->discounts->count() }}</td>
                    <td>{{ $taskM->discounts->where('reason', 'auto-finish-task')->count() }}</td>
                    <td>غير محدد</td>

                </tr>
            


            {{-- <tr>
                <td class="pinkBG">
                    عدد المهام /{{ $taskM->count() }}
                </td>
                <td class="grayBG" colspan="2"></td>
                <td class="pinkBG">0 SAR</td>
                <td class="pinkBG">0 SAR</td>
                <td class="grayBG"></td>
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
