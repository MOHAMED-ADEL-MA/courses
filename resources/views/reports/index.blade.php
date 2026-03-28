@extends('layouts.master')

@section('title', 'التقارير')
@section('page-title', 'التقارير والإحصائيات')

@section('content')

    <div class="container-fluid mt-4">

        {{-- Tabs --}}
        <ul class="nav nav-tabs mb-4">

            <li class="nav-item">
                <a class="nav-link {{ $viewType == 'students' ? 'active' : '' }}"
                    href="{{ route('reports.index', ['view' => 'students']) }}">
                    تقرير الطلاب
                </a>
            </li>

            <li class="nav-item">
                <a class="nav-link {{ $viewType == 'payments' ? 'active' : '' }}"
                    href="{{ route('reports.index', ['view' => 'payments']) }}">
                    تقرير المدفوعات
                </a>
            </li>

            <li class="nav-item">
                <a class="nav-link {{ $viewType == 'attendance' ? 'active' : '' }}"
                    href="{{ route('reports.index', ['view' => 'attendance']) }}">
                    تقرير الحضور
                </a>
            </li>

            <li class="nav-item">
                <a class="nav-link {{ $viewType == 'instructors' ? 'active' : '' }}"
                    href="{{ route('reports.index', ['view' => 'instructors']) }}">
                    تقرير المدربين
                </a>
            </li>

        </ul>


        {{-- ================= تقرير الطلاب ================= --}}
        @if ($viewType == 'students')

            <div class="card shadow-sm">

                <div class="card-header bg-white d-flex justify-content-between">
                    <h5 class="mb-0">فلترة الطلاب</h5>

                    <a href="{{ route('reports.export.pdf', array_merge(request()->all(), ['view' => 'students'])) }}"
                        class="btn btn-danger btn-sm ms-auto"> PDF <i class="bi bi-download"></i>

                    </a>
                    <a href="{{ route('reports.export.excel', array_merge(request()->all(), ['view' => 'students'])) }}"
                        class="btn btn-success btn-sm ms-2"> Excele <i class="bi bi-download"></i>

                    </a>

                </div>

                <div class="card-body">

                    <form method="GET" action="{{ route('reports.index') }}" class="row g-3">
                        @csrf
                        <input type="hidden" name="view" value="students">

                        <div class="col-md-4">

                            <select name="course_id" class="form-select">

                                <option value="">كل الكورسات</option>

                                @foreach ($courses as $course)
                                    <option value="{{ $course->id }}"
                                        {{ request('course_id') == $course->id ? 'selected' : '' }}>

                                        {{ $course->name }}

                                    </option>
                                @endforeach

                            </select>

                        </div>

                        <div class="col-md-2">
                            <button type="submit" class="btn btn-primary w-100">بحث</button>
                        </div>

                    </form>

                </div>


                <div class="table-responsive">

                    <table class="table table-hover align-middle mb-0">

                        <thead class="table-light">

                            <tr>
                                <th>الاسم</th>
                                <th>البريد</th>
                                <th>الهاتف</th>
                                <th>الكورسات</th>
                            </tr>

                        </thead>

                        <tbody>

                            @forelse($items as $student)
                                <tr>

                                    <td>{{ $student->name }}</td>

                                    <td>{{ $student->email }}</td>

                                    <td>{{ $student->phone }}</td>

                                    <td>
                                        {{ $student->courses->pluck('name')->join(', ') }}
                                    </td>

                                </tr>

                            @empty

                                <tr>
                                    <td colspan="4" class="text-center">لا توجد بيانات</td>
                                </tr>
                            @endforelse

                        </tbody>

                    </table>

                </div>

            </div>

        @endif



        {{-- ================= تقرير المدفوعات ================= --}}
        @if ($viewType == 'payments')

            <div class="card shadow-sm">

                <div class="card-header bg-white d-flex justify-content-between">

                    <h5 class="mb-0">فلترة المدفوعات</h5>

                    <a href="{{ route('reports.export.pdf', array_merge(request()->all(), ['view' => 'payments'])) }}"
                        class="btn btn-danger btn-sm ms-auto"> PDF <i class="bi bi-download"></i>

                    </a>
                    <a href="{{ route('reports.export.excel', array_merge(request()->all(), ['view' => 'payments'])) }}"
                        class="btn btn-success btn-sm ms-2"> Excele <i class="bi bi-download"></i>

                    </a>

                </div>


                <div class="card-body">

                    <form method="GET" action="{{ route('reports.index') }}" class="row g-3">

                        <input type="hidden" name="view" value="payments">

                        <div class="col-md-3">

                            <select name="status" class="form-select">

                                <option value="">كل الحالات</option>

                                <option value="مدفوعة" {{ request('status') == 'مدفوعة' ? 'selected' : '' }}>
                                    مدفوعة
                                </option>

                                <option value="غير مدفوعة" {{ request('status') == 'غير مدفوعة' ? 'selected' : '' }}>
                                    غير مدفوعة
                                </option>

                                <option value="مدفوعة جزئيا" {{ request('status') == 'مدفوعة جزئيا' ? 'selected' : '' }}>
                                    مدفوعة جزئيا
                                </option>

                            </select>

                        </div>


                        <div class="col-md-3">

                            <select name="course_id" class="form-select">

                                <option value="">كل الكورسات</option>

                                @foreach ($courses as $course)
                                    <option value="{{ $course->id }}"
                                        {{ request('course_id') == $course->id ? 'selected' : '' }}>

                                        {{ $course->name }}

                                    </option>
                                @endforeach

                            </select>

                        </div>


                        <div class="col-md-2">
                            <button class="btn btn-primary w-100">بحث</button>
                        </div>

                    </form>

                </div>


                <div class="table-responsive">

                    <table class="table table-hover align-middle mb-0">

                        <thead class="table-light">

                            <tr>

                                <th>الطالب</th>
                                <th>الكورس</th>
                                <th>المبلغ الكلي</th>
                                <th>المدفوع</th>
                                <th>المتبقي</th>
                                <th>الحالة</th>

                            </tr>

                        </thead>

                        <tbody>

                            @forelse($items as $invoice)
                                <tr>

                                    <td>{{ $invoice->student->name ?? 'طالب محذوف' }}</td>

                                    <td>{{ $invoice->course->name ?? 'كورس محذوف' }}</td>

                                    <td>{{ $invoice->total_amount }}</td>

                                    <td>{{ $invoice->paied_amount ?? 0 }}</td>

                                    <td>{{ $invoice->remaining_amount }}</td>

                                    <td>

                                        @if ($invoice->status == 'مدفوعة')
                                            <span class="badge bg-success">مدفوعة</span>
                                        @elseif($invoice->status == 'غير مدفوعة')
                                            <span class="badge bg-danger">غير مدفوعة</span>
                                        @else
                                            <span class="badge bg-warning text-dark">مدفوعة جزئيا</span>
                                        @endif

                                    </td>

                                </tr>

                            @empty

                                <tr>
                                    <td colspan="6" class="text-center">لا توجد بيانات</td>
                                </tr>
                            @endforelse

                        </tbody>

                    </table>

                </div>

            </div>

        @endif




        {{-- ================= تقرير الحضور ================= --}}
        @if ($viewType == 'attendance')

            <div class="card shadow-sm">

                <div class="card-header bg-white d-flex justify-content-between align-items-center">

                    <h5 class="mb-0">فلترة الحضور</h5>

                    <a href="{{ route('reports.export.pdf', array_merge(request()->all(), ['view' => 'attendance'])) }}"
                        class="btn btn-danger btn-sm ms-auto"> PDF <i class="bi bi-download"></i>

                    </a>
                    <a href="{{ route('reports.export.excel', array_merge(request()->all(), ['view' => 'attendance'])) }}"
                        class="btn btn-success btn-sm ms-2"> Excele <i class="bi bi-download"></i>

                    </a>

                </div>

                <div class="card-body">

                    <form method="GET" action="{{ route('reports.index') }}" class="row g-3">

                        <input type="hidden" name="view" value="attendance">

                        <div class="col-md-3">

                            <select name="course_id" class="form-select">

                                <option value="">كل الكورسات</option>

                                @foreach ($courses as $course)
                                    <option value="{{ $course->id }}"
                                        {{ request('course_id') == $course->id ? 'selected' : '' }}>

                                        {{ $course->name }}

                                    </option>
                                @endforeach

                            </select>

                        </div>


                        <div class="col-md-3">

                            <input type="date" name="date_from" class="form-control"
                                value="{{ request('date_from') }}">

                        </div>


                        <div class="col-md-2">
                            <button class="btn btn-primary w-100">بحث</button>
                        </div>

                    </form>

                </div>


                <div class="table-responsive">

                    <table class="table table-hover align-middle mb-0">

                        <thead class="table-light">

                            <tr>

                                <th>الطالب</th>
                                <th>الكورس</th>
                                <th>الجلسة</th>
                                <th>التاريخ</th>
                                <th>الحالة</th>

                            </tr>

                        </thead>

                        <tbody>

                            @forelse($items as $attendance)
                                <tr>

                                    <td>
                                        <!-- عرض الصورة أو صورة افتراضية -->
                                        <img src="{{ $attendance->student->photo ? asset('storage/' . $attendance->student->photo) : 'https://ui-avatars.com/api/?name=' . urlencode($attendance->student->name) . '&background=random' }}"
                                            alt="avatar" class="rounded-circle"
                                            style="width: 40px; height: 40px; object-fit: cover;">
                                        {{ $attendance->student->name }}
                                    </td>

                                    <td>{{ $attendance->courseSession->course->name }}</td>

                                    <td>{{ $attendance->courseSession->time }}</td>

                                    <td>{{ $attendance->courseSession->date->format('d-m-Y') }}</td>

                                    <td>

                                        @if ($attendance->status == 'present')
                                            <span class="badge bg-success">حاضر</span>
                                        @elseif($attendance->status == 'absent')
                                            <span class="badge bg-danger">غائب</span>
                                        @endif

                                    </td>

                                </tr>

                            @empty

                                <tr>
                                    <td colspan="5" class="text-center">لا توجد بيانات</td>
                                </tr>
                            @endforelse

                        </tbody>

                    </table>

                </div>

            </div>

        @endif



        {{-- ================= تقرير المدربين ================= --}}
        @if ($viewType == 'instructors')

            <div class="card shadow-sm">

                <div class="card-header bg-white d-flex justify-content-between align-items-center ">
                    <h5 class="mb-0">إحصائيات المدربين</h5>

                    <a href="{{ route('reports.export.pdf', ['view' => 'instructors']) }}"
                        class="btn btn-danger btn-sm ms-auto"> PDF <i class="bi bi-download"></i>

                    </a>
                    <a href="{{ route('reports.export.excel', array_merge(request()->all(), ['view' => 'instructors'])) }}"
                        class="btn btn-success btn-sm ms-2"> Excele <i class="bi bi-download"></i>

                    </a>


                </div>

                <div class="table-responsive">

                    <table class="table table-hover align-middle mb-0">

                        <thead class="table-light">

                            <tr>

                                <th>الاسم</th>
                                <th>التخصص</th>
                                <th>عدد الكورسات</th>

                            </tr>

                        </thead>

                        <tbody>

                            @foreach ($items as $instructor)
                                <tr>

                                    <td>{{ $instructor->name }}</td>

                                    <td>{{ $instructor->specialization }}</td>

                                    <td>

                                        <span class="badge bg-info">
                                            {{ $instructor->courses_count }}
                                        </span>

                                    </td>

                                </tr>
                            @endforeach

                        </tbody>

                    </table>

                </div>

            </div>

        @endif


    </div>

@endsection
