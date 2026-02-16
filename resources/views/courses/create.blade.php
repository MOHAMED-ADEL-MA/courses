@extends('layouts.master')
@section('title','الكورسات')
@section('page-title','الكورسات')

@section('content')
<div class="container mt-5">
    <div class="row justify-content-center">
        <div class="col-md-10">
            <div class="card">
                <div class="card-header bg-success text-white">
                    <h4>إضافة كورس جديد</h4>
                </div>
                <div class="card-body">
                    @session('success')
                    <div class="alert alert-success">{{ $value }}</div>
                    @endsession
                    <form action="{{ route('courses.store') }}" method="POST">
                        @csrf

                        <!-- الاسم -->
                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <label for="name" class="form-label">اسم الكورس</label>
                                <input type="text" class="form-control @error('name') is-invalid @enderror" id="name"
                                    name="name" value="{{ old('name') }}">
                                @error('name')
                                <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <!-- المدرب (Select Box) -->
                            <div class="col-md-6 mb-3">
                                <label for="instructor_id" class="form-label">المدرب المسؤول</label>
                                <select class="form-select @error('instructor_id') is-invalid @enderror"
                                    id="instructor_id" name="instructor_id">
                                    <option value="">اختر المدرب...</option>

                                    @foreach($instructors as $instructor)
                                    <option value="{{ $instructor->id }}" {{ old('instructor_id')==$instructor->id ?
                                        'selected' : '' }}>
                                        {{ $instructor->name }} - ({{ $instructor->specialization }})
                                    </option>
                                    @endforeach
                                </select>
                                @error('instructor_id')
                                <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>

                        <!-- الوصف -->
                        <div class="mb-3">
                            <label for="description" class="form-label">الوصف</label>
                            <textarea class="form-control" id="description" name="description"
                                rows="3">{{ old('description') }}</textarea>
                        </div>

                        <!-- السعر والساعات -->
                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <label for="price" class="form-label">السعر</label>
                                <input type="text" class="form-control @error('price') is-invalid @enderror" id="price"
                                    name="price" value="{{ old('price') }}">
                                @error('price')
                                <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="col-md-6 mb-3">
                                <label for="hours" class="form-label">عدد الساعات</label>
                                <input type="text" class="form-control @error('hours') is-invalid @enderror" id="hours"
                                    name="hours" value="{{ old('hours') }}">
                                @error('hours')
                                <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>

                        <!-- التواريخ -->
                        <div class="row">
                            <!-- تاريخ البداية -->
                            <div class="col-md-6 mb-3">
                                <label for="start_date" class="form-label">تاريخ البداية</label>


                                <div class="input-group @error('start_date') is-invalid @enderror">

                                    <input type="date" class="form-control" id="start_date" name="start_date"
                                        value="{{ old('start_date') }}">
                                </div>

                                @error('start_date')
                                <div class="invalid-feedback d-block">{{ $message }}</div>
                                @enderror
                            </div>

                            <!-- تاريخ النهاية -->
                            <div class="col-md-6 mb-3">
                                <label for="end_date" class="form-label">تاريخ النهاية</label>

                                <div class="input-group @error('end_date') is-invalid @enderror">

                                    <input type="date" class="form-control" id="end_date" name="end_date"
                                        value="{{ old('end_date') }}">
                                </div>

                                @error('end_date')
                                <div class="invalid-feedback d-block">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>

                        <!-- الأزرار -->
                        <div class="d-flex justify-content-between mt-4">
                            <a href="{{ route('courses.index') }}" class="btn btn-secondary">إلغاء</a>
                            <button type="submit" class="btn btn-success">حفظ الكورس</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection