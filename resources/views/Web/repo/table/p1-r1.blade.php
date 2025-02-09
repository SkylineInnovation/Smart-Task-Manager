
<!DOCTYPE html>
<html lang="ar" dir="rtl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>تقرير مستمر</title>
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
        th, td {
            border: 1px solid black;
            padding: 10px;
            text-align: center;
        }
        th {
            background-color: #f2f2f2;
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
            <th>الجهة</th>
            <th>تاريخ الإنشاء</th>
            <th>جهة التكليف</th>
            <th>الموظفون</th>
            <th>تاريخ التسليم</th>
            <th>الحالة</th>
        </tr>
        <tr>
            <td>13802</td>
            <td>متابعة مهام التوظيف وإرسال الصوص</td>
            <td>1446/06/14</td>
            <td>وسام أبو عصر</td>
            <td>[اسم موظف]</td>
            <td>1446/08/12</td>
            <td>سارية</td>
        </tr>
        <tr>
            <td>13701</td>
            <td>إصدار تصريح تدريب لصيانة المعدات الثقيلة</td>
            <td>1446/06/18</td>
            <td>وسام أبو عصر</td>
            <td>[اسم موظف]</td>
            <td>1446/08/12</td>
            <td>سارية</td>
        </tr>
        <tr>
            <td>13706</td>
            <td>متابعة فحص قطع صيانة - معدات بحرية</td>
            <td>1446/06/22</td>
            <td>وسام أبو عصر</td>
            <td>[اسم موظف]</td>
            <td>1447/01/05</td>
            <td>سارية</td>
        </tr>
        <tr>
            <td>13825</td>
            <td>توريد مواد نظافة مطابقة لمعايير الأمن</td>
            <td>1446/06/29</td>
            <td>وسام أبو عصر</td>
            <td>أحمد علي فيصل التركي</td>
            <td>1446/07/30</td>
            <td>سارية</td>
        </tr>
    </table>

    <script>
        // Disable right-click
        document.addEventListener("contextmenu", function (e) {
            e.preventDefault();
        });

        // Disable certain key combinations
        document.addEventListener("keydown", function (e) {
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
        (function () {
            var element = new Image();
            Object.defineProperty(element, "id", {
                get: function () {
                    alert("تم اكتشاف أدوات المطور! الرجاء عدم محاولة الفحص.");
                    window.location.reload();
                },
            });
            console.log("%c", element);
        })();
    </script>

</body>
</html>
