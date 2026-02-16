@extends('layouts.master')
@section('title','الكورسات')
@section('page-title','الكورسات ')




@section('content')
<div class="container mt-5">
    <div class="card">
        <div class="card-header bg-secondary text-white d-flex justify-content-between align-items-center">
            <h5 class="mb-0">قائمة الكورسات المتاحة</h5>

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
                        <th>اسم الكورس</th>
                        <th>المدرب</th>
                        <th>السعر </th>
                        <th>المده</th>
                        <th>تاريخ البدايه</th>
                        <th></th>
                    </tr>
                </thead>
                <tbody>
                    @php
                    $count=1;
                    @endphp
                    @forelse($courses as $course)
                    <tr>
                        <td>{{ $count++ }}</td>
                        <td>
                            <strong class="d-block text-dark">{{ $course->name }}</strong>
                            <small class="text-muted">{{ str($course->description)->limit(50) }}</small>
                        </td>
                        <td>{{ $course->instructor->name }}</td>
                        <td>
                            <div class="fw-bold text-success">{{ $course->price }} ج.م </div>
                        </td>
                        <td>{{ $course->hours}} ساعه</td>
                        <td>{{ $course->start_date->format('d-m-Y')}}</td>
                        <td class="d-flex justify-content-between align-items-center ">
                            <!-- زر التعديل -->
                            <a href="{{ route('courses.edit', $course) }}" class="btn btn-warning btn-sm">
                                <i class="bi bi-pencil-square"></i> تعديل
                            </a>

                            <!-- زر الحذف -->
                            <form id="delete-form-{{ $course->id }}" action="{{ route('courses.destroy', $course) }}"
                                method="POST" style="display: none;">
                                @csrf
                                @method('DELETE')
                            </form>


                            <button onclick="confirmDelete({{ $course->id }})" class="btn btn-danger btn-sm">
                                <i class="bi bi-trash"></i> حذف
                            </button>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="7" class="text-center">لا يوجد كورسات متاحه حتى الآن.</td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection
