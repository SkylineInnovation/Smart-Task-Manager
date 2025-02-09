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
            <th>13410</th>
            <th class="color">عنوان المهمة</th>
            <th colspan="5" class="">التدريب الفترة الصيادية ( 9:00 صباحاً الى غاية 01:00 مساءاً مع لرفاق
                كشوفات
                التحضير
                والصور
                للمعاونات والحضور وكشف تحضير الدروس</th>
        </tr>
        <tr>
            <th class="color">جهة التكليف</th>
            <th>وسفرابو خضر</th>
            <th class="color">الموظفون</th>
            <th colspan="3">إصن عثمان على اكتباً</th>
            <th class="color">تاريخ الإستلام</th>
            <th>1447706/09</th>

        </tr>
        <tr>
            <th colspan="8" class="color-darker">الإنجازات والتعليقات خلال هذه الفترة</th>
        </tr>
        <tr>
            <th class="color">المرسل</th>
            <th colspan="3">حسن حمام علي افقتي</th>
            <th class="color">تاريخ التعليق</th>
            <th>1448077/14</th>
            <th class="color">وقت التعليق</th>
            <th>0:06:11</th>
        </tr>

        <tr>
            <th colspan="8" class="color-commints">
                محاضرة الكيمياء العامة بدلوم حماية البيئة الربع الثاني مجموع طلاب الشعبية ، 7 حضر منهم 5 طلاب ، موضوع
                المحاضرة الجدول الدوري
            </th>
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
