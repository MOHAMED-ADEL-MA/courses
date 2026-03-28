@extends('layouts.master')
@section('title', ' المدربين')
@section('page-title', 'المدربين')


@section('content')
    <div class="container mt-5">
        <div class="card">
            <div class="card-header bg-secondary text-white d-flex justify-content-between align-items-center">
                <h5 class="mb-0">قائمة المدربين</h5>

            </div>
            <div class="card-body">
                @session('success')
                    <div class="alert alert-success alert-dismissible fade show" role="alert">{{ $value }}
                        <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                    </div>
                @endsession
                @session('error')
                    <div class="alert alert-danger alert-dismissible fade show" role="alert">{{ $value }}
                        <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                    </div>
                @endsession
                <table class="table table-bordered table-hover">
                    <thead class="bg-light">
                        <tr>
                            <th>م</th>
                            <th>الاسم</th>
                            <th>التخصص</th>
                            <th>الهاتف</th>
                            <th>البريد الإلكتروني</th>
                            <th>الخبرة</th>
                            <th></th>
                        </tr>
                    </thead>
                    <tbody>
                        @php
                            $count = 1;
                        @endphp
                        @forelse($instructors as $instructor)
                            <tr>
                                <td>{{ $count++ }}</td>
                                <td>{{ $instructor->name }}</td>
                                <td>{{ $instructor->specialization }}</td>
                                <td>{{ $instructor->phone }}</td>
                                <td>{{ $instructor->email }}</td>
                                <td>{{ $instructor->experience_years ?? '-' }} سنة</td>
                                <td class="d-flex justify-content-between align-items-center ">
                                    <!-- زر التعديل -->
                                    <a href="{{ route('instructors.edit', $instructor) }}" class="btn btn-warning btn-sm">
                                        تعديل<i class="bi bi-pencil-square"></i>
                                    </a>

                                    <!-- زر الحذف -->
                                    <form id="delete-form-{{ $instructor->id }}"
                                        action="{{ route('instructors.destroy', $instructor) }}" method="POST"
                                        style="display: none;">
                                        @csrf
                                        @method('DELETE')
                                    </form>


                                    <button onclick="confirmDelete({{ $instructor->id }})" class="btn btn-danger btn-sm">
                                        <i class="bi bi-trash"></i> حذف
                                    </button>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="7" class="text-center">لا يوجد مدربين حتى الآن.</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection
