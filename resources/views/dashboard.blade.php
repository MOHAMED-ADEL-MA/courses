@extends('layouts.master')

@section('title', 'Dashboard')

@section('content')
    <div class="container-fluid">

        <!-- =================== Row 1: Stats Boxes =================== -->
        <div class="row">
            @php
                $colors = ['primary', 'warning', 'success', 'danger'];
                $icons = ['bi-people-fill', 'bi-people-fill', 'bi-book-fill', 'bi-person-badge-fill'];
                $labels = ['المدربين', 'الطلاب', 'الكورسات', 'المستخدمين'];
                $values = [
                    $stats['instructors_count'],
                    $stats['students_count'],
                    $stats['courses_count'],
                    $stats['users_count'],
                ];
            @endphp
            @foreach ($labels as $i => $label)
                <div class="col-12 col-sm-6 col-md-3">
                    <div class="info-box mb-3">
                        <span class="info-box-icon text-bg-{{ $colors[$i] }} shadow-sm">
                            <i class="bi {{ $icons[$i] }}"></i>
                        </span>
                        <div class="info-box-content">
                            <span class="info-box-text">{{ $label }}</span>
                            <span class="info-box-number">{{ $values[$i] }}</span>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>

        <!-- =================== Row 2: Invoices Summary =================== -->
        <div class="row mt-3">
            <div class="col-md-3">
                <div class="info-box mb-3 text-bg-info">
                    <span class="info-box-icon"><i class="bi bi-clipboard-fill"></i></span>
                    <div class="info-box-content">
                        <span class="info-box-text">عدد الفواتير</span>
                        <span class="info-box-number">{{ $stats['invoices_count'] }}</span>
                    </div>
                </div>
            </div>
            <div class="col-md-3">
                <div class="info-box mb-3 text-bg-success">
                    <span class="info-box-icon"><i class="bi bi-clipboard-fill"></i></span>
                    <div class="info-box-content">
                        <span class="info-box-text">الفواتير المدفوعة</span>
                        <span class="info-box-number">{{ number_format($stats['invoices_paid']) }} ج.م</span>
                    </div>
                </div>
            </div>
            <div class="col-md-3">
                <div class="info-box mb-3 text-bg-warning">
                    <span class="info-box-icon"><i class="bi bi-clipboard-fill"></i></span>
                    <div class="info-box-content">
                        <span class="info-box-text">الفواتير جزئيا</span>
                        <span class="info-box-number">{{ number_format($stats['invoices_partial']) }} ج.م</span>
                    </div>
                </div>
            </div>
            <div class="col-md-3">
                <div class="info-box mb-3 text-bg-danger">
                    <span class="info-box-icon"><i class="bi bi-clipboard-fill"></i></span>
                    <div class="info-box-content">
                        <span class="info-box-text">الفواتير غير المدفوعة</span>
                        <span class="info-box-number">{{ number_format($stats['invoices_unpaid']) }} ج.م</span>
                    </div>
                </div>
            </div>
        </div>

        <!-- =================== Row 3: Quick Reports =================== -->
        <div class="row mt-4">

            <!-- Latest Invoices -->
            <div class="col-md-6">
                <div class="card">
                    <div class="card-header bg-primary text-white">آخر الفواتير</div>
                    <div class="card-body p-0">
                        <table class="table m-0">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>الطالب</th>
                                    <th>الحالة</th>
                                    <th>المبلغ</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($latestInvoices as $invoice)
                                    <tr>
                                        <td>{{ $loop->iteration }}</td>
                                        <td>{{ $invoice->student->name ?? 'محذوف' }}</td>
                                        <td>
                                            @if ($invoice->status == 'مدفوعة')
                                                <span class="badge bg-success">مدفوعة</span>
                                            @elseif($invoice->status == 'غير مدفوعة')
                                                <span class="badge bg-danger">غير مدفوعة</span>
                                            @else
                                                <span class="badge bg-warning text-dark">جزئيا</span>
                                            @endif
                                        </td>
                                        <td>{{ number_format($invoice->total_amount) }} ج.م</td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>

            <!-- Payments Percentage -->
            <div class="col-md-6">
                <div class="card">
                    <div class="card-header bg-info text-white">نسبة المدفوعات</div>
                    <div class="card-body">
                        <h6>مدفوعة</h6>
                        <div class="progress mb-2">
                            <div class="progress-bar bg-success" role="progressbar" style="width: {{ $paidPercentage }}%">
                                {{ round($paidPercentage) }}%
                            </div>
                        </div>
                        <h6>جزئيا</h6>
                        <div class="progress mb-2">
                            <div class="progress-bar bg-warning" role="progressbar"
                                style="width: {{ $partialPercentage }}%">
                                {{ round($partialPercentage) }}%
                            </div>
                        </div>
                        <h6>غير مدفوعة</h6>
                        <div class="progress">
                            <div class="progress-bar bg-danger" role="progressbar" style="width: {{ $unpaidPercentage }}%">
                                {{ round($unpaidPercentage) }}%
                            </div>
                        </div>
                    </div>
                </div>
            </div>

        </div>

    </div>
@endsection
