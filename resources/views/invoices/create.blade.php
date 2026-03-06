@extends('layouts.master')
@section('title','الفواتير')
@section('page-title','الفواتير')

@section('content')
<div class="container mt-5">
    <div class="row justify-content-center">
        <div class="col-md-10">
            <div class="card">
                <div class="card-header bg-success text-white">
                    <h4>فاتورة تسجيل طالب جديد</h4>
                </div>
                <div class="card-body">
                    {{-- Alert Messages --}}
                    @session('success')
                    <div class="alert alert-success">{{ $value }}</div>
                    @endsession
                    @session('error')
                    <div class="alert alert-danger">{{ $value }}</div>
                    @endsession

                    <form action="{{ route('invoices.store') }}" method="POST">
                        @csrf

                        <div class="row">
                            <!-- اختيار الطالب -->
                            <div class="col-md-6 mb-3">
                                <label for="student_id" class="form-label">الطالب</label>
                                <select class="form-select @error('student_id') is-invalid @enderror" id="student_id"
                                    name="student_id">
                                    <option value="">اختر الطالب...</option>
                                    @foreach($students as $student)
                                    <option value="{{ $student->id }}">
                                        {{ $student->name }}
                                    </option>
                                    @endforeach
                                </select>
                                @error('student_id')
                                <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <!-- اختيار الكورس -->
                            <div class="col-md-6 mb-3">
                                <label for="course_id" class="form-label">الكورس</label>
                                <select class="form-select @error('course_id') is-invalid @enderror" id="course_id"
                                    name="course_id" onchange="updatePrice()">
                                    <option value="">اختر الكورس...</option>
                                    @foreach($courses as $course)
                                    <option value="{{ $course->id }}" data-price="{{ $course->price }}">
                                        {{ $course->name }} ({{ $course->price }} ج.م)
                                    </option>
                                    @endforeach
                                </select>
                                @error('course_id')
                                <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                        <div class="row">
                            <!-- السعر -->
                            <div class="col-md-6 mb-3">
                                <label for="total_amount" class="form-label">المبلغ الكلي</label>
                                <input type="number" step="0.01"
                                    class="form-control @error('total_amount') is-invalid @enderror" id="total_amount"
                                    name="total_amount">
                                @error('total_amount')
                                <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <!-- الحالة -->
                            <div class="col-md-6 mb-3">
                                <label for="status" class="form-label">حالة السداد</label>
                                <input type="text" class="form-control" id="status" value="غير مدفوعة" disabled>
                                {{-- <select class="form-select" id="status" name="status">
                                    <option value="غير مدفوعة">غير مدفوعة</option>
                                    <option value="مدفوعة">مدفوعة </option>
                                </select> --}}
                            </div>
                        </div>



                        <!-- الأزرار -->
                        <div class="d-flex justify-content-between mt-4">
                            <a href="{{ route('invoices.index') }}" class="btn btn-secondary">إلغاء</a>
                            <button type="submit" class="btn btn-success">تسجيل وإنشاء فاتورة</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

<!--  ملء السعر تلقائياً -->
<script>
    function updatePrice() {
        var select = document.getElementById('course_id');
        var priceInput = document.getElementById('total_amount');
        var selectedOption = select.options[select.selectedIndex];

        if (selectedOption) {
            priceInput.value = selectedOption.getAttribute('data-price');
        }
    }
</script>
@endsection
