@extends('layouts.master')
@section('title','تعديل المستخدمين')
@section('page-title','تعديل المستخدمين')
@section('content')
<div class="col-md-8 m-2">
    <div class="card card-primary card-outline mb-4">
        <!--begin::Header-->
        <div class="card-header">
            <div class="card-title">البيانات الاساسيه</div>
        </div>
        <!--end::Header-->
        <!--begin::Form-->
        <form method="post" action="{{ route('update.user',$user) }}">
            @csrf
            @method('patch')
            <!--begin::Body-->
            <div class="card-body">
                <div class="mb-3">
                    <label for="name" class="form-label">اسم المستخدم</label>
                    <input type="text" name="name" class="form-control @error('name') is-invalid @enderror" id="name"
                        value="{{ old('name',$user->name) }}" />

                    @error('name')
                    <small style="color: red">{{ $message }}</small>
                    @enderror

                </div>
                <div class="mb-3">
                    <label for="email" class="form-label">البريد الالكتروني</label>
                    <input type="text" name="email" class="form-control @error('email') is-invalid @enderror" id="email"
                        value="{{ old('email',$user->email) }}" />
                    @error('email')
                    <small style="color: red">{{ $message }}</small>
                    @enderror
                </div>
                <div class="mb-4">
                    <label for="password" class="form-label">تحديث كلمة المرور</label>
                    <input type="password" class="form-control @error('password') is-invalid @enderror" name="password"
                        id="password" placeholder="للتحديث، أدخل كلمة مرور جديدة. للحفاظ على القديمة، اتركه فارغاً">
                    @error('password')
                    <small style="color: red">{{ $message }}</small>
                    @enderror
                </div>


                <div class="form-group ">
                    <label for="inputRole">اختيار دور :</label>
                    <select id="inputRole" class="form-control mb-4" name="role">
                        <option value="مدير" {{ $user->role == 'مدير' ? 'selected' : '' }}>مدير</option>
                        <option value="موظف" {{ $user->role == 'موظف' ? 'selected' : '' }}>موظف</option>
                    </select>
                </div>

                @session('success')
                <div class="alert alert-success">{{ $value }}</div>
                @endsession


            </div>
            <!--end::Body-->
            <!--begin::Footer-->
            <div class="card-footer">
                <button type="submit" class="btn btn-primary">حفظ</button>
            </div>
            <!--end::Footer-->
        </form>
        <!--end::Form-->
    </div>
</div>
@endsection