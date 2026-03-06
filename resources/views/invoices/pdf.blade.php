<!DOCTYPE html>
<html dir="rtl" lang="ar">

<head>
    <meta charset="utf-8">
    <title>فاتورة</title>
    <style>
        @font-face {
            font-family: 'Cairo';
            font-style: normal;
            font-weight: normal;
            /* استبدل public_path بـ asset */
            src: url('{{ public_path('fonts/Noto.ttf') }}');
        }

        body {
            font-family: 'Cairo', sans-serif;
            padding: 40px;
        }

        .header {
            text-align: center;
            margin-bottom: 40px;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 20px;
        }

        th,
        td {
            border: 1px solid #000;
            padding: 10px;
            text-align: center;
        }

        th {
            background-color: #f2f2f2;
        }

        .total-row {
            font-weight: bold;
            background-color: #ddd;
        }
    </style>
</head>

<body>
    <div class="header">
        <h1>فاتورة تسجيل كورس</h1>
        <p>رقم الفاتورة: {{ $invoice->id }}</p>
        <p>تاريخ الإصدار: {{ $invoice->issue_date }}</p>
    </div>

    <p>
        <strong>الطالب:</strong> {{ $invoice->student->name }} <br>
        <strong>الكورس:</strong> {{ $invoice->course->name }}
    </p>

    <table>
        <thead>
            <tr>
                <th>البند</th>
                <th>المبلغ (ج.م)</th>
            </tr>
        </thead>
        <tbody>
            <tr>
                <td>رسوم التسجيل - {{ $invoice->course->name }}</td>
                <td>{{ number_format($invoice->total_amount, 2) }}</td>
            </tr>
            <tr>
                <td>إجمالي المدفوعات</td>
                <td>{{ number_format($invoice->total_amount - $invoice->remaining_amount, 2) }}</td>
            </tr>
            <tr class="total-row">
                <td>المبلغ المتبقي</td>
                <td>{{ number_format($invoice->remaining_amount, 2) }}</td>
            </tr>
        </tbody>
    </table>

    <p><strong>الحالة:</strong>
        {{ $invoice->status == 'مدفوعة' ? 'مدفوع بالكامل' : ($invoice->status == 'مدفوعة جزئيا' ? 'مدفوع جزئياً' : 'غير مدفوع') }}
    </p>
</body>

</html>
