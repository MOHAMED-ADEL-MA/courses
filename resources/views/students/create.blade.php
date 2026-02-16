@extends('layouts.master')
@section('title','الطلاب')
@section('page-title','تسجيل الطلاب')


@section('content')
<div class="container mt-5">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header bg-success text-white">
                    <h4>تسجيل طالب جديد</h4>
                </div>
                <div class="card-body">
                    @session('success')
                    <div class="alert alert-success">{{ $value }}</div>
                    @endsession
                    <form action="{{ route('students.store') }}" method="POST" enctype="multipart/form-data">
                        @csrf

                        <div class="mb-3">
                            <label for="name" class="form-label">اسم الطالب </label>
                            <input type="text" class="form-control @error('name') is-invalid @enderror" id="name"
                                name="name" value="{{ old('name') }}">
                            @error('name') <div class="invalid-feedback">{{ $message }}</div> @enderror
                        </div>

                        <div class="mb-3">
                            <label for="phone" class="form-label">رقم الهاتف</label>
                            <input type="text" class="form-control @error('phone') is-invalid @enderror" id="phone"
                                name="phone" value="{{ old('phone') }}">
                            @error('phone') <div class="invalid-feedback">{{ $message }}</div> @enderror
                        </div>

                        <div class="mb-3">
                            <label for="email" class="form-label">البريد الإلكتروني (اختياري)</label>
                            <input type="email" class="form-control @error('email') is-invalid @enderror" id="email"
                                name="email" value="{{ old('email') }}">
                            @error('email') <div class="invalid-feedback">{{ $message }}</div> @enderror
                        </div>

                        <div class="mb-3">
                            <label for="birth_date" class="form-label">تاريخ الميلاد</label>
                            <input type="date" class="form-control @error('birth_date') is-invalid @enderror "
                                id="birth_date" name="birth_date" value="{{ old('birth_date') }}">
                        </div>

                        <!-- حقل الصورة -->
                        <div class="mb-3">
                            <label for="photo" class="form-label">صورة الطالب (اختياري)</label>
                            <input type="file" class="form-control @error('photo') is-invalid @enderror" id="photo"
                                name="photo" accept="image/*">

                            @error('photo')
                            <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                            <small class="text-muted">صيغ مسموحة: JPG, PNG</small>
                        </div>

                        <div class="d-flex justify-content-between mt-4">
                            <a href="{{ route('students.index') }}" class="btn btn-secondary">إلغاء</a>
                            <button type="submit" class="btn btn-success">حفظ الطالب</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection