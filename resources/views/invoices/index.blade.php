@extends('layouts.master')

@section('title', 'سجل الفواتير')

@section('content')
    <div class="container mt-5">

        <!-- قسم الفلاتر -->
        <div class="card mb-4 shadow-sm">
            <div class="card-header bg-light">
                <h6 class="mb-0"><i class="bi bi-funnel"></i> تصفية النتائج</h6>
            </div>
            <div class="card-body">
                <form action="{{ route('invoices.index') }}" method="GET" class="row g-3 align-items-end">
                    <!-- فلترة الحالة -->
                    <div class="col-md-3">
                        <label class="form-label">حالة السداد</label>
                        <select name="status" class="form-select">
                            <option value="">الكل</option>
                            <option value="unpaid" {{ request('status') == 'unpaid' ? 'selected' : '' }}>غير مدفوع</option>
                            <option value="partial" {{ request('status') == 'partial' ? 'selected' : '' }}>مدفوع جزئياً
                            </option>
                            <option value="paid" {{ request('status') == 'paid' ? 'selected' : '' }}>مدفوع بالكامل
                            </option>
                        </select>
                    </div>

                    <!-- فلترة الطالب -->
                    <div class="col-md-3">
                        <label class="form-label">الطالب</label>
                        <select name="student_id" class="form-select">
                            <option value="">الكل</option>
                            @foreach ($students as $s)
                                <option value="{{ $s->id }}" {{ request('student_id') == $s->id ? 'selected' : '' }}>
                                    {{ $s->name }}</option>
                            @endforeach
                        </select>
                    </div>

                    <!-- فلترة الكورس -->
                    <div class="col-md-3">
                        <label class="form-label">الكورس</label>
                        <select name="course_id" class="form-select">
                            <option value="">الكل</option>
                            @foreach ($courses as $c)
                                <option value="{{ $c->id }}" {{ request('course_id') == $c->id ? 'selected' : '' }}>
                                    {{ $c->name }}</option>
                            @endforeach
                        </select>
                    </div>

                    <!-- زر البحث -->
                    <div class="col-md-3">
                        <button type="submit" class="btn btn-primary w-100"><i class="bi bi-search"></i> بحث</button>
                    </div>
                </form>
            </div>
        </div>

        <!-- جدول الفواتير -->
        <div class="card shadow-sm">
            <div class="card-header bg-success text-white d-flex justify-content-between align-items-center">
                <h5 class="mb-0">سجل الفواتير</h5>

            </div>
            <div class="card-body">

                @session('success')
                    <div class="alert alert-success alert-dismissible fade show" role="alert">
                        {{ $value }}
                        <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                    </div>
                @endsession

                @session('error')
                    <div class="alert alert-danger alert-dismissible fade show" role="alert">
                        {{ $value }}
                        <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                    </div>
                @endsession

                <div class="table-responsive">
                    <table class="table table-bordered table-hover align-middle text-center">
                        <thead class="table-light">
                            <tr>
                                <th>#</th>
                                <th>الطالب</th>
                                <th>الكورس</th>
                                <th>المدرب</th>
                                <th>المبلغ الكلي</th>
                                <th>المتبقي</th>
                                <th>الحالة</th>
                                <th>الإجراءات</th>
                            </tr>
                        </thead>
                        <tbody>
                            @php
                                $count = 1;
                            @endphp
                            @forelse($invoices as $invoice)
                                <tr>
                                    <td>{{ $count++ }}</td>

                                    <td>
                                        <strong>{{ $invoice->student->name }}</strong>
                                        <br>
                                        <small class="text-muted">{{ $invoice->student->phone }}</small>
                                    </td>

                                    <td>{{ $invoice->course->name }}</td>

                                    <td>{{ $invoice->course->instructor->name }}</td>

                                    <td class="fw-bold text-primary">
                                        {{ number_format($invoice->total_amount, 2) }}
                                    </td>

                                    <td class="text-danger">
                                        {{ number_format($invoice->remaining_amount, 2) }}
                                    </td>

                                    <td>
                                        @if ($invoice->status == 'مدفوعة')
                                            <span class="badge bg-success">مدفوعة</span>
                                        @elseif($invoice->status == 'مدفوعة جزئيا')
                                            <span class="badge bg-warning text-dark">مدفوعة جزئيا</span>
                                        @else
                                            <span class="badge bg-danger">غير مدفوعة</span>
                                        @endif
                                    </td>

                                    <td class="text-center">
                                        <div class="d-flex justify-content-center gap-2">
                                            <a href="{{ route('invoices.download', $invoice) }}"
                                                class="btn btn-info btn-sm text-white" title="تحميل PDF">
                                                <i class="bi bi-file-earmark-pdf"></i> تحميل
                                            </a>

                                            @if ($invoice->status != 'paid')
                                                <button class="btn btn-success btn-sm" data-bs-toggle="modal"
                                                    data-bs-target="#payModal{{ $invoice->id }}" title="إضافة دفعة">
                                                    <i class="bi bi-cash-coin"></i> دفع
                                                </button>
                                            @endif

                                            <form action="{{ route('invoices.destroy', $invoice) }}" method="POST"
                                                onsubmit="return confirm('هل أنت متأكد من حذف هذه الفاتورة؟')">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="btn btn-danger btn-sm" title="حذف">
                                                    <i class="bi bi-trash"></i> حذف
                                                </button>
                                            </form>
                                        </div>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="8" class="text-center text-muted py-3">
                                        لا توجد فواتير مطابقة للبحث.
                                    </td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

    <!-- مودال الدفعات -->
    @foreach ($invoices as $invoice)
        <div class="modal fade" id="payModal{{ $invoice->id }}" tabindex="-1" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <form action="{{ route('invoices.pay', $invoice) }}" method="POST">
                        @csrf
                        <div class="modal-header">
                            <h5 class="modal-title">تسجيل دفعة جديدة</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            <div class="mb-3">
                                <p class="text-muted">فاتورة رقم: <strong>{{ $invoice->id }}</strong></p>
                                <p>اسم الطالب: <strong>{{ $invoice->student->name }}</strong></p>
                                <p class="alert alert-info py-2">
                                    المبلغ المتبقي: <strong>{{ number_format($invoice->remaining_amount, 2) }} ج.م</strong>
                                </p>
                            </div>
                            <div class="mb-3">
                                <label for="amount" class="form-label">قيمة الدفعة</label>
                                <input type="number" name="amount"
                                    class="form-control @error('amount') is-invalid
                                @enderror">
                                @error('amount')
                                    <small class="text-danger">{{ $message }}</small>
                                @enderror
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">إلغاء</button>
                            <button type="submit" class="btn btn-success">تسجيل الدفع</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    @endforeach

@endsection
