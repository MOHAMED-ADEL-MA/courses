{{-- <x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Profile') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6">
            <div class="p-4 sm:p-8 bg-white shadow sm:rounded-lg">
                <div class="max-w-xl">
                    @include('profile.partials.update-profile-information-form')
                </div>
            </div>

            <div class="p-4 sm:p-8 bg-white shadow sm:rounded-lg">
                <div class="max-w-xl">
                    @include('profile.partials.update-password-form')
                </div>
            </div>

            <div class="p-4 sm:p-8 bg-white shadow sm:rounded-lg">
                <div class="max-w-xl">
                    @include('profile.partials.delete-user-form')
                </div>
            </div>
        </div>
    </div>
</x-app-layout> --}}

@extends('layouts.master')
@section('title','الملف الشخصي')
@section('page-title','الملف الشخصي')
@section('content')
<!--begin::App Content-->
<div class="app-content">
    <!--begin::Container-->
    <div class="container-fluid">
        <!--begin::Row-->
        <div class="row g-4">
            <!--begin::Col-->
            <!--begin::Col-->
            <div class="col-md-8 m-2">
                <!--begin::Basic Info-->
                <div class="card card-primary card-outline mb-4">
                    <!--begin::Header-->
                    <div class="card-header">
                        <div class="card-title">البيانات الاساسيه</div>
                    </div>
                    <!--end::Header-->
                    <!--begin::Form-->
                    <form method="post" action="{{ route('profile.update') }}">
                        @csrf
                        @method('patch')
                        <!--begin::Body-->
                        <div class="card-body">
                            <div class="mb-3">
                                <label for="name" class="form-label">اسم المستخدم</label>
                                <input type="text" name="name" class="form-control" id="name"
                                    value="{{ Auth::user()->name }}" />

                                @error('name')
                                <small style="color: red">{{ $message }}</small>
                                @enderror

                            </div>
                            <div class="mb-3">
                                <label for="email" class="form-label">البريد الالكتروني</label>
                                <input type="email" name="email" class="form-control" id="email"
                                    value="{{ Auth::user()->email }}" />
                                @error('email')
                                <small style="color: red">{{ $message }}</small>
                                @enderror
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
                <!--end::Basic Info-->
                <!--begin::Password-->
                <div class="card card-success card-outline mb-4">
                    <!--begin::Header-->
                    <div class="card-header">
                        <div class="card-title">كلمة المرور</div>
                    </div>
                    <!--end::Header-->
                    <!--begin::Form-->
                    <form method="post" action="{{ route('password.update') }}" class="mt-6 space-y-6">
                        @csrf
                        @method('put')
                        <!--begin::Body-->
                        <div class="card-body">
                            <div class="mb-3">
                                <label for="name" class="form-label">كلمه المرور الحاليه</label>
                                <input name="current_password" type="password" class="form-control" id="name"
                                    value="" />

                                @error('current_password')
                                <small style="color: red">{{ $message }}</small>
                                @enderror

                            </div>
                            <div class="mb-3">
                                <label for="password" class="form-label">كلمه المرور الجديده</label>
                                <input name="password" type="password" class="form-control" id="password" value="" />

                                @error('password')
                                <small style="color: red">{{ $message }}</small>
                                @enderror

                            </div>
                            <div class="mb-3">
                                <label for="passwordConfirmation" class="form-label">تأكيد كلمه المرور </label>
                                <input name="password_confirmation" type="password" class="form-control"
                                    id="passwordConfirmation" value="" />

                                @error('password_confirmation')
                                <small style="color: red">{{ $message }}</small>
                                @enderror

                            </div>

                            @session('success_password')
                            <div class="alert alert-success">{{ $value }}</div>
                            @endsession


                        </div>
                        <!--end::Body-->
                        <!--begin::Footer-->
                        <div class="card-footer">
                            <button type="submit" class="btn btn-success">حفظ</button>
                        </div>
                        <!--end::Footer-->
                    </form>
                    <!--end::Form-->
                </div>
                <!--end::Input Group-->
                <!--begin::Horizontal Form-->
                <div class="card card-danger card-outline mb-4">
                    <!--begin::Header-->
                    <div class="card-header">
                        <div class="card-title">حذف الحساب</div>
                    </div>
                    <!--end::Header-->
                    <!--begin::Form-->
                    <form method="post" action="{{ route('profile.destroy') }}" class="p-6">
                        @csrf
                        @method('delete')
                        <!--begin::Body-->
                        <div class="card-body">

                            <div class="row mb-3">
                                <p>سيتم حذف جميع البيانات الخاصة بهذا الحساب و لن تتمكن من تسجيل الدخول اليه مره اخري
                                </p>
                                <label for="inputPassword3" class="col-sm-2 col-form-label">يرجي ادخال كلمه المرور لحذف
                                    الحساب</label>
                                <div class="col-sm-10">
                                    <input type="password" name="password" class="form-control" id="inputPassword3"
                                        value="" />
                                    @error('password')
                                    <small style="color: red">
                                        {{ $message }}
                                    </small>
                                    @enderror
                                </div>
                            </div>

                        </div>
                        <!--end::Body-->
                        <!--begin::Footer-->
                        <div class="card-footer">
                            <button type="submit" class="btn btn-danger">حذف الحساب</button>

                        </div>
                        <!--end::Footer-->
                    </form>
                    <!--end::Form-->
                </div>
                <!--end::Horizontal Form-->
            </div>
            <!--end::Col-->
        </div>
    </div>
</div>
@endsection