@extends('layouts.master')

@section('title', 'إدارة الجلسات')
@section('content')
    <div class="container mt-5">
        <div class="card shadow-sm">
            <div class="card-header bg-info text-white d-flex justify-content-between align-items-center">
                <h5 class="mb-0">جدول الجلسات</h5>
                <button class="btn btn-sm btn-light" data-bs-toggle="modal" data-bs-target="#addSessionModal">
                    إضافة جلسة
                </button>
            </div>

            <div class="card-body">
                <!-- فلتر الكورس -->
                <form method="GET" class="row mb-3">
                    <div class="col-md-4">
                        <select name="course_id" class="form-select" onchange="this.form.submit()">
                            <option value="">كل الكورسات</option>
                            @foreach ($courses as $course)
                                <option value="{{ $course->id }}"
                                    {{ request('course_id') == $course->id ? 'selected' : '' }}>
                                    {{ $course->name }}
                                </option>
                            @endforeach
                        </select>
                    </div>
                </form>
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
                <table class="table table-bordered table-hover">
                    <thead class="table-light">
                        <tr>
                            <th>الكورس</th>
                            <th>التاريخ</th>
                            <th>الوقت</th>
                            <th>القاعة</th>
                            <th>الحالة</th>
                            <th>الإجراءات</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($sessions as $session)
                            <tr>
                                <td>{{ $session->course->name }}</td>
                                <td>{{ $session->date->format('d-m-Y') }}</td>
                                <td>{{ $session->time }}</td>
                                <td>{{ $session->hall }}</td>
                                <td>
                                    @if ($session->status == 'completed')
                                        <span class="badge bg-success">انتهت الجلسه</span>
                                    @else
                                        <span class="badge bg-warning text-dark">لم تتم</span>
                                    @endif
                                </td>
                                <td class="text-center">
                                    <!-- زر تسجيل الحضور -->
                                    <a href="{{ route('attendance.create', $session) }}" class="btn btn-primary btn-sm">
                                        <i class="bi bi-check2-square"></i> الحضور
                                    </a>
                                    <!-- زر انهاء الجلسه -->
                                    @if ($session->status != 'completed')
                                        <a href="{{ route('sessions.end', $session) }}" class="btn btn-success btn-sm">
                                            <i class="bi bi-stop-circle"></i> انهـــاء
                                        </a>
                                    @else
                                        <span class="btn btn-secondary btn-sm text-dark"><i class="bi bi-stop-circle"></i>
                                            منتهيه</span>
                                    @endif

                                    <!-- زر الحذف -->
                                    <form id="delete-form-{{ $session->id }}"
                                        action="{{ route('sessions.destroy', $session) }}" method="POST"
                                        style="display: none;">
                                        @csrf
                                        @method('DELETE')
                                    </form>


                                    <button onclick="confirmDelete({{ $session->id }})" class="btn btn-danger btn-sm">
                                        <i class="bi bi-trash"></i> حذف
                                    </button>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="6" class="text-center">لا توجد جلسات.</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <!-- Modal إضافة جلسة جديدة -->
    <div class="modal fade" id="addSessionModal" tabindex="-1" aria-labelledby="addSessionModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <form action="{{ route('sessions.store') }}" method="POST">
                    @csrf

                    <div class="modal-header bg-primary text-white">
                        <h5 class="modal-title" id="addSessionModalLabel">إضافة جلسة جديدة</h5>
                        <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"
                            aria-label="Close"></button>
                    </div>

                    <div class="modal-body">
                        <!-- اختيار الكورس -->
                        <div class="mb-3">
                            <label for="course_id" class="form-label">الكورس</label>
                            <select class="form-select @error('course_id') is-invalid @enderror" id="course_id"
                                name="course_id" required>
                                <option value="" selected disabled>اختر الكورس...</option>
                                @foreach ($courses as $course)
                                    <option value="{{ $course->id }}"
                                        {{ old('course_id') == $course->id ? 'selected' : '' }}>
                                        {{ $course->name }}
                                    </option>
                                @endforeach
                            </select>
                            @error('course_id')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <!-- التاريخ -->
                        <div class="mb-3">
                            <label for="date" class="form-label">التاريخ</label>
                            <div class="input-group">
                                <span class="input-group-text bg-white"><i
                                        class="bi bi-calendar-event text-primary"></i></span>
                                <input type="date" class="form-control @error('date') is-invalid @enderror"
                                    id="date" name="date" required>
                                @error('date')
                                    <div class="invalid-feedback d-block">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>

                        <!-- الوقت -->
                        <div class="mb-3">
                            <label for="time" class="form-label">الوقت</label>
                            <div class="input-group">
                                <span class="input-group-text bg-white"><i class="bi bi-clock text-primary"></i></span>
                                <input type="time" class="form-control @error('time') is-invalid @enderror"
                                    id="time" name="time" required>
                                @error('time')
                                    <div class="invalid-feedback d-block">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>

                        <!-- القاعة -->
                        <div class="mb-3">
                            <label for="hall" class="form-label">القاعة</label>
                            <input type="text" class="form-control @error('hall') is-invalid @enderror" id="hall"
                                name="hall" placeholder="مثال: قاعة 1" required>
                            @error('hall')
                                <div class="invalid-feedback d-block">{{ $message }}</div>
                            @enderror
                        </div>

                        <!-- الحالة -->
                        <div class="mb-3">
                            <label for="status" class="form-label">الحالة</label>
                            <select class="form-select" id="status" name="status" required>
                                <option value="pending" selected>لم تتم</option>
                                <option value="completed">تمت</option>
                            </select>
                        </div>
                    </div>

                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">إلغاء</button>
                        <button type="submit" class="btn btn-primary">حفظ الجلسة</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
