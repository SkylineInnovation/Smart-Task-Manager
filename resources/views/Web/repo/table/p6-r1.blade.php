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
            <th>رقم الشيخا علوان المهمة</th>
            <th>أقوام الشيخا علوان المهمة</th>
            <th>عدد الكونا لألعاق</th>
            <th>عدد الكونا التسبق</th>
            <th>عدد الكونا الحضورات</th>
            <th>عدد الخارج الأعاق</th>
            <th>تاريخ الأعاق</th>
        </tr>
        <tr>
            <td>[145564] التعاون الدائمني والمخصصات والعاملين التدريجة</td>
            <td>71 سنة</td>
            <td>0</td>
            <td>0</td>
            <td>2</td>
            <td>1446/08/01 و1159</td>
            <td>1446/08/01 و1159</td>
        </tr>
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
