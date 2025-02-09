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

        tr:nth-child(even) {
            background-color: #f9f9f9;
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

        td.greenBG{
            background: #00B035;
            color: white;
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
                    ahmad hakeem
                </td>
            </tr>
            <tr>
                <td>رخص البلدية والدفاع المدني لكل فرع [12995]</td>
                <td>1446/09/15 م04:55</td>
                <td>تحت التنفيذ</td>
                <td>SAR 0</td>
                <td>SAR 850</td>
                <td>غير محدد</td>

            </tr>
            <tr>
                <td>رخص البلدية والدفاع المدني لكل فرع [12995]</td>
                <td>1446/09/15 م04:55</td>
                <td>تحت التنفيذ</td>
                <td>SAR 0</td>
                <td>SAR 850</td>
                <td>غير محدد</td>
            </tr>
        </tbody>
    </table>

</body>

</html>
