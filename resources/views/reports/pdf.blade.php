<!DOCTYPE html>
<html lang="ar" dir="rtl">

<head>
    <meta charset="utf-8">
    <title>{{ $title }}</title>
    <style>
        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
        }

        th,
        td {
            border: 1px solid #ddd;
            padding: 8px;
            text-align: right;
        }

        th {
            background-color: #f2f2f2;
        }
    </style>
</head>

<body>
    <h1 style="text-align: center;">{{ $title }}</h1>

    <table>
        <thead>
            <tr>
                @if ($viewType == 'students')
                    <th>الاسم</th>
                    <th>الهاتف</th>
                    <th>البريد</th>
                    <th>الكورسات</th>
                @elseif($viewType == 'payments')
                    <th>الطالب</th>
                    <th>الكورس</th>
                    <th>المبلغ الكلي</th>
                    <th>المدفوع</th>
                    <th>المتبقي</th>
                    <th>الحالة</th>
                @elseif($viewType == 'attendance')
                    <th>الطالب</th>
                    <th>الكورس</th>
                    <th>الجلسة</th>
                    <th>التاريخ</th>
                    <th>الحالة</th>
                @elseif($viewType == 'instructors')
                    <th>اسم المدرب</th>
                    <th>التخصص</th>
                    <th>الكورسات</th>
                @endif
            </tr>
        </thead>
        <tbody>
            @foreach ($items as $item)
                <tr>
                    @if ($viewType == 'students')
                        <td>{{ $item->name }}</td>
                        <td>{{ $item->phone }}</td>
                        <td>{{ $item->email }}</td>
                        <td>{{ $item->courses->pluck('name')->join(', ') }}</td>
                    @elseif($viewType == 'payments')
                        <td>{{ $item->student->name }}</td>
                        <td>{{ $item->course->name }}</td>
                        <td>{{ $item->total_amount }}</td>
                        <td>{{ $item->paied_amount ?? 0 }}</td>
                        <td>{{ $item->remaining_amount }}</td>
                        <td>{{ $item->status }}</td>
                    @elseif($viewType == 'attendance')
                        <td>{{ $item->student->name }}</td>
                        <td>{{ $item->courseSession->course->name }}</td>
                        <td>{{ $item->courseSession->time }}</td>
                        <td>{{ $item->courseSession->date->format('d-m-Y') }}</td>
                        <td>

                            @if ($item->status == 'present')
                                <span>حاضر</span>
                            @elseif($item->status == 'absent')
                                <span>غائب</span>
                            @endif

                        </td>
                    @elseif($viewType == 'instructors')
                        <td>{{ $item->name }}</td>
                        <td>{{ $item->specialization }}</td>
                        <td>{{ $item->courses->pluck('name')->join(', ') ?? 'غير مرتبط بأي كورس' }}</td>
                    @endif
                </tr>
            @endforeach
        </tbody>
    </table>
</body>

</html>
