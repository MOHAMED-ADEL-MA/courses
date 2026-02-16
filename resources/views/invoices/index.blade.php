@extends('layouts.master')

@section('title', 'الفواتير')
@section('page-title', 'الفواتير')
@section('content')
<div class="container mt-5">
    <div class="card">
        <div class="card-header bg-success text-white d-flex justify-content-between align-items-center">
            <h5 class="mb-0">سجل الفواتير</h5>
            <a href="{{ route('invoices.create') }}" class="btn btn-sm btn-light">
                <i class="bi bi-plus-circle"></i> إضافة فاتورة
            </a>
        </div>
        <div class="card-body">

            @session('success')
            <div class="alert alert-success">{{ $value }}</div>
            @endsession

            <div class="table-responsive">
                <table class="table table-bordered table-hover align-middle">
                    <thead class="table-light">
                        <tr>
                            <th class="text-center">م</th>
                            <th>الطالب</th>
                            <th>الكورس</th>
                            <th>المبلغ</th>
                            <th>حالة السداد</th>
                            <th>تاريخ الإصدار</th>
                            <th></th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($invoices as $invoice)
                        <tr>
                            <td class="text-center">{{ $invoice->id }}</td>

                            <!-- اسم الطالب -->
                            <td>
                                <strong>{{ $invoice->student->name }}</strong>
                                <br>
                                <small class="text-muted">{{ $invoice->student->phone }}</small>
                            </td>

                            <!-- اسم الكورس -->
                            <td>
                                {{ $invoice->course->name }}
                                <br>
                                <small class="text-muted">({{ $invoice->course->instructor->name }})</small>
                            </td>

                            <!-- المبلغ -->
                            <td class="fw-bold text-primary">
                                {{ number_format($invoice->total_amount) }} ج.م
                            </td>

                            <!-- حالة السداد (مدفوع / غير مدفوع) -->
                            <td>
                                @if($invoice->status == 'مدفوعة')
                                <span class="badge bg-success">مدفوعة</span>
                                @else
                                <span class="badge bg-danger">غير مدفوعة</span>
                                @endif
                            </td>

                            <!-- التاريخ -->
                            <td>{{ $invoice->issue_date->format('d-m-Y') }}</td>

                            <!-- الإجراءات -->
                            <td class="text-center">
                                <!-- زر تغيير الحالة (التعديل) -->
                                <a href="{{ route('invoices.edit', $invoice) }}" class="btn btn-sm btn-warning">
                                    <i class="bi bi-pencil-square"></i>
                                </a>

                                <!-- زر الحذف -->
                                <form action="{{ route('invoices.destroy', $invoice) }}" method="POST" class="d-inline"
                                    onsubmit="return confirm('هل أنت متأكد من حذف الفاتورة؟')">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-sm btn-danger">
                                        <i class="bi bi-trash"></i>
                                    </button>
                                </form>
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="7" class="text-center text-muted py-3">
                                لا توجد فواتير مسجلة حتى الآن.
                            </td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>

        </div>
    </div>
</div>
@endsection