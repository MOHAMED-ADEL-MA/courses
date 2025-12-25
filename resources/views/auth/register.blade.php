{{-- <x-guest-layout>
    <form method="POST" action="{{ route('register') }}">
        @csrf

        <!-- Name -->
        <div>
            <x-input-label for="name" :value="__('Name')" />
            <x-text-input id="name" class="block mt-1 w-full" type="text" name="name" :value="old('name')" required
                autofocus autocomplete="name" />
            <x-input-error :messages="$errors->get('name')" class="mt-2" />
        </div>

        <!-- Email Address -->
        <div class="mt-4">
            <x-input-label for="email" :value="__('Email')" />
            <x-text-input id="email" class="block mt-1 w-full" type="email" name="email" :value="old('email')" required
                autocomplete="username" />
            <x-input-error :messages="$errors->get('email')" class="mt-2" />
        </div>

        <!-- Password -->
        <div class="mt-4">
            <x-input-label for="password" :value="__('Password')" />

            <x-text-input id="password" class="block mt-1 w-full" type="password" name="password" required
                autocomplete="new-password" />

            <x-input-error :messages="$errors->get('password')" class="mt-2" />
        </div>

        <!-- Confirm Password -->
        <div class="mt-4">
            <x-input-label for="password_confirmation" :value="__('Confirm Password')" />

            <x-text-input id="password_confirmation" class="block mt-1 w-full" type="password"
                name="password_confirmation" required autocomplete="new-password" />

            <x-input-error :messages="$errors->get('password_confirmation')" class="mt-2" />
        </div>

        <div class="flex items-center justify-end mt-4">
            <a class="underline text-sm text-gray-600 hover:text-gray-900 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500"
                href="{{ route('login') }}">
                {{ __('Already registered?') }}
            </a>

            <x-primary-button class="ms-4">
                {{ __('Register') }}
            </x-primary-button>
        </div>
    </form>
</x-guest-layout> --}}

@extends('layouts.master')
@section('title','اضافه مستخدم')

@section('content')
<div class="row justify-content-center w-100">
    <div class="col-md-8 col-lg-6 col-xxl-3">
        <div class="card mb-0">
            <div class="card-body">
                @session('success')
                <div class="alert alert-success">
                    {{ $value }}
                </div>
                @endsession

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
                        <input type="email" class="form-control" id="email" name="email" />
                        @error('email')
                        <small style="color: red">{{ $message }}</small>
                        @enderror
                    </div>
                    <div class="mb-4">
                        <label for="password" class="form-label">كلمة المرور</label>
                        <input type="password" class="form-control" name="password" id="password">
                        @error('password')
                        <small style="color: red">{{ $message }}</small>
                        @enderror
                    </div>
                    <div class="mb-4">
                        <label for="password" class="form-label">تأكيد كلمة المرور</label>
                        <input type="password" class="form-control" name="password_confirmation" id="password"
                            autocomplete="current-password">
                        @error('password_confirmation')
                        <small style="color: red">{{ $message }}</small>
                        @enderror
                    </div>

                    <div class="form-group ">
                        <label for="inputRole">اختيار دور :</label>
                        <select id="inputRole" class="form-control mb-4" name="role">
                            <option selected>موظف</option>
                            <option>مدير</option>
                        </select>
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