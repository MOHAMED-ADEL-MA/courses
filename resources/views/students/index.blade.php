@extends('layouts.master')
@section('title', 'الطلاب')
@section('page-title', 'عرض الطلاب')

@section('content')
    <div class="container mt-5">
        <div class="card mb-4 shadow-sm">
            <div class="card-header bg-light">
                <h6 class="mb-0"><i class="bi bi-funnel"></i> تصفية الطلاب</h6>
            </div>
            <div class="card-body">
                <form action="{{ route('students.index') }}" method="GET" class="row g-3 align-items-end">

                    <!-- فلتر الكورس -->
                    <div class="col-md-4">
                        <label class="form-label">الكورس</label>
                        <select name="course_id" class="form-select">
                            <option value="">الكل</option>
                            @foreach ($courses as $course)
                                <option value="{{ $course->id }}"
                                    {{ request('course_id') == $course->id ? 'selected' : '' }}>
                                    {{ $course->name }} ({{ $course->instructor->name }})
                                </option>
                            @endforeach
                        </select>
                    </div>

                    <!-- فلتر تاريخ التسجيل -->
                    <div class="col-md-4">
                        <label class="form-label">تاريخ التسجيل</label>
                        <input type="date" name="registration_date" class="form-control"
                            value="{{ request('registration_date') }}">
                    </div>

                    <!-- زر البحث وإلغاء -->
                    <div class="col-md-4">
                        <div>
                            <button type="submit" class="btn btn-primary w-100"><i class="bi bi-search"></i> بحث</button>

                        </div>
                    </div>
                </form>
            </div>
        </div>

        <div class="card">
            <div class="card-header bg-secondary text-white d-flex justify-content-between align-items-center">
                <h5 class="mb-0">قائمةالطلاب</h5>

            </div>
            <div class="card-body">

                @session('success')
                    <div class="alert alert-success">{{ $value }}</div>
                @endsession

                @session('error')
                    <div class="alert alert-danger">{{ $value }}</div>
                @endsession
                <table class="table table-bordered table-hover">
                    <thead class="bg-light">
                        <tr>
                            <th>م</th>
                            <th>اسم الطالب</th>
                            <th>رقم الهاتف</th>
                            <th>البريد الالكتروني </th>
                            <th>العمر</th>
                            <th>تاريخ التسجيل</th>
                            <th></th>

                        </tr>
                    </thead>
                    <tbody>
                        @php
                            $count = 1;
                        @endphp
                        @forelse($students as $student)
                            <tr>
                                <td>{{ $count++ }}</td>
                                <td>
                                    <!-- عرض الصورة أو صورة افتراضية -->
                                    <img src="{{ $student->photo ? asset('storage/' . $student->photo) : 'https://ui-avatars.com/api/?name=' . urlencode($student->name) . '&background=random' }}"
                                        alt="avatar" class="rounded-circle"
                                        style="width: 40px; height: 40px; object-fit: cover;">
                                    {{ $student->name }}
                                </td>
                                <td>{{ $student->phone }}</td>
                                <td>{{ $student->email ?? '-' }}</td>
                                <td>{{ $student->age }} </td>
                                <td>{{ $student->created_at->format('d/m/Y') }}</td>
                                <td class="d-flex justify-content-between align-items-center ">
                                    <!-- زر التعديل -->
                                    <a href="{{ route('students.edit', $student) }}" class="btn btn-warning btn-sm">
                                        <i class="bi bi-pencil-square"></i> تعديل
                                    </a>

                                    <!-- زر الحذف -->
                                    <form id="delete-form-{{ $student->id }}"
                                        action="{{ route('students.destroy', $student) }}" method="POST"
                                        style="display: none;">
                                        @csrf
                                        @method('DELETE')
                                    </form>


                                    <button onclick="confirmDelete({{ $student->id }})" class="btn btn-danger btn-sm">
                                        <i class="bi bi-trash"></i> حذف
                                    </button>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="6" class="text-center">لا يوجد طلاب مسجلين.</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    @endsection
