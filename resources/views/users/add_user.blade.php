@extends('layouts.master')
@section('title','اضافه مستخدم')

@section('content')
<div class="row justify-content-center w-100">
    <div class="col-md-8 col-lg-6 col-xxl-3">
        <div class="card mb-0">
            <div class="card-body">

                <p class="text-center">
                <h3 style="text-align: center">اضافه مستخدم</h3>
                </p>

                <form method="POST" action="{{ route('register') }}">
                    @csrf
                    <div class="mb-3">
                        <label for="name" class="form-label">اسم المستخدم </label>
                        <input type="text" class="form-control" id="name" name="name" />
                        @error('name')
                        <small style="color: red">{{ $message }}</small>
                        @enderror
                    </div>
                    <div class="mb-3">
                        <label for="email" class="form-label">البريد الالكتروني</label>
                        <input type="email" class="form-control" id="email" name="email" required />
                        @error('email')
                        <small style="color: red">{{ $message }}</small>
                        @enderror
                    </div>
                    <div class="mb-4">
                        <label for="password" class="form-label">كلمة المرور</label>
                        <input type="password" class="form-control" name="password" id="password" required>
                        @error('password')
                        <small style="color: red">{{ $message }}</small>
                        @enderror
                    </div>
                    <div class="mb-4">
                        <label for="password" class="form-label">تأكيد كلمة المرور</label>
                        <input type="password" class="form-control" name="password_confirmation" id="password" required
                            autocomplete="current-password">
                        @error('password_confirmation')
                        <small style="color: red">{{ $message }}</small>
                        @enderror
                    </div>

                    <button type="submit" class="btn btn-primary w-100 py-8 fs-4 mb-4 rounded-2">
                        اضافه
                    </button>
                </form>

            </div>
        </div>
    </div>
</div>
@endsection