@extends('layouts.master')
@section('title','تعديل مدربين')
@section('page-title',' المدربين')

@section('content')
<div class="container mt-5">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">

                <div class="card-header bg-warning text-dark">
                    <h4>تعديل بيانات المدربين</h4>
                </div>
                <div class="card-body">
                    @session('success')
                    <div class="alert alert-success">{{ $value }}</div>
                    @endsession
                    <form action="{{ route('instructors.update', $instructor) }}" method="POST">
                        @csrf
                        @method('PATCH')
                        <!-- الاسم -->
                        <div class="mb-3">
                            <label for="name" class="form-label">الاسم</label>
                            <input type="text" class="form-control @error('name') is-invalid @enderror" id="name"
                                name="name" value="{{ old('name',$instructor->name) }}">
                            @error('name')
                            <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <!-- التخصص -->
                        <div class="mb-3">
                            <label for="specialization" class="form-label">التخصص</label>
                            <input type="text" class="form-control @error('specialization') is-invalid @enderror"
                                id="specialization" name="specialization"
                                value="{{ old('specialization',$instructor->specialization) }}">
                            @error('specialization')
                            <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <!-- الهاتف -->
                        <div class="mb-3">
                            <label for="phone" class="form-label">رقم الهاتف</label>
                            <input type="text" class="form-control @error('phone') is-invalid @enderror" id="phone"
                                name="phone" value="{{ old('phone',$instructor->phone) }}">
                            @error('phone')
                            <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <!-- البريد الإلكتروني -->
                        <div class="mb-3">
                            <label for="email" class="form-label">البريد الإلكتروني (اختياري)</label>
                            <input type="email" class="form-control @error('email') is-invalid @enderror" id="email"
                                name="email" value="{{ old('email',$instructor->email) }}">
                            @error('email')
                            <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <!-- سنوات الخبرة -->
                        <div class="mb-3">
                            <label for="experience_years" class="form-label">سنوات الخبرة (اختياري)</label>
                            <input type="text" class="form-control" id="experience_years" name="experience_years"
                                value="{{ old('experience_years',$instructor->experience_years) }}">
                        </div>

                        <!-- الأزرار -->
                        <div class="d-flex justify-content-between">
                            <a href="{{ route('instructors.index') }}" class="btn btn-secondary">إلغاء</a>
                            <button type="submit" class="btn btn-success">حفظ</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection