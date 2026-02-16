@extends('layouts.master')
@section('title','الطلاب')
@section('page-title','عرض الطلاب')

@section('content')
<div class="container mt-5">
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
                    $count=1;
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
                            <form id="delete-form-{{ $student->id }}" action="{{ route('students.destroy', $student) }}"
                                method="POST" style="display: none;">
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