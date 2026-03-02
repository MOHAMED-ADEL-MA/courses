@extends('layouts.master')

@section('title','الطلاب')
@section('page-title','تعديل بيانات الطالب')

@section('content')
<div class="container mt-5">
    <div class="row justify-content-center">
        <div class="col-md-10">
            <div class="card">
                <div class="card-header bg-warning text-dark">
                    <h4>تعديل بيانات الطالب</h4>
                </div>
                <div class="card-body">
                    @session('success')
                    <div class="alert alert-success">{{ $value }}</div>
                    @endsession

                    <form action="{{ route('students.update', $student) }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        @method('PUT')

                        <!-- الاسم  -->
                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <label for="name" class="form-label">اسم الطالب</label>
                                <input type="text" class="form-control @error('name') is-invalid @enderror" id="name"
                                    name="name" value="{{ old('name', $student->name) }}">
                                @error('name')
                                <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                            <!--  البريد الإلكتروني -->
                            <div class="col-md-6 mb-3">
                                <label for="email" class="form-label">البريد الإلكتروني</label>
                                <input type="email" class="form-control @error('email') is-invalid @enderror"
                                    id="email" name="email" value="{{ old('email', $student->email) }}">
                                @error('email')
                                <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>

                        <!-- الهاتف  -->
                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <label for="phone" class="form-label">رقم الهاتف</label>
                                <input type="text" class="form-control @error('phone') is-invalid @enderror" id="phone"
                                    name="phone" value="{{ old('phone', $student->phone) }}">
                                @error('phone')
                                <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <!--  تاريخ الميلاد  -->
                            <div class="col-md-6 mb-3">
                                <label for="birth_date" class="form-label">تاريخ الميلاد</label>
                                <div class="input-group @error('birth_date') is-invalid @enderror">
                                    <input type="date" class="form-control" id="birth_date" name="birth_date"
                                        value="{{ old('birth_date', $student->birth_date ? $student->birth_date->format('Y-m-d') : '') }}">
                                </div>
                                @error('birth_date')
                                <div class="invalid-feedback d-block">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>

                        <!-- الصورة -->
                        <div class="row">
                            <div class="col-md-12 mb-3">
                                <label for="photo" class="form-label">صورة الطالب</label>

                                <div class="d-flex align-items-center gap-3 mb-2">
                                    @if($student->photo)
                                        <img src="{{ asset('storage/' . str_replace('public/', '', $student->photo)) }}"
                                            class="rounded-circle"
                                            style="width: 60px; height: 60px; object-fit: cover; border: 2px solid #ddd;">
                                    @else
                                        <div class="bg-secondary text-white rounded-circle d-flex align-items-center justify-content-center"
                                            style="width: 60px; height: 60px;">
                                            <span>?</span>
                                        </div>
                                    @endif

                                    <input type="file" class="form-control @error('photo') is-invalid @enderror"
                                        id="photo" name="photo">
                                </div>

                                <small class="text-muted">اترك الحقل فارغاً إذا كنت لا تريد تغيير الصورة.</small>

                                @error('photo')
                                <div class="invalid-feedback d-block">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>

                        <!-- الأزرار -->
                        <div class="d-flex justify-content-between mt-4">
                            <a href="{{ route('students.index') }}" class="btn btn-secondary">إلغاء</a>
                            <button type="submit" class="btn btn-success">حفظ التغييرات</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
