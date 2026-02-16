@extends('layouts.master')
@section('title','المستخدمين')
@section('page-title',' المستخدمين')

@section('content')
<div class="container mt-5">
    <div class="card">
        @session('success')
        <div class="alert alert-success">
            {{ $value }}
        </div>
        @endsession
        @session('error')
        <div class="alert alert-danger">
            {{ $value }}
        </div>
        @endsession
        <div class="card-header bg-secondary text-white d-flex justify-content-between align-items-center">
            <h3 class="card-title">كل المستخدمين</h3>
        </div>
        <!-- /.card-header -->
        <div class="card-body">
            <table class="table table-bordered table-hover">
                <thead class="bg-light">
                    <tr class="bg-secondary text-white">
                        <th style="width: 10px">م</th>
                        <th>الاسم</th>
                        <th>البريد الالكتروني</th>
                        <th>الدور</th>
                        @can('view',auth()->user())
                        <th colspan="2"></th>
                        @endcan
                    </tr>
                </thead>
                <tbody>
                    @php
                    $count=1;
                    @endphp
                    @foreach ($users as $user )

                    <tr class="align-middle">
                        <td>{{ $count++ }}</td>
                        <td>{{ $user->name }}</td>
                        <td>{{ $user->email }}</td>
                        <td>{{ $user->role }}</td>
                        @can('view',auth()->user())
                        <td>
                            <a href="{{ route('edit.user', $user->id) }}" class="btn btn-warning btn-sm">
                                <i class="bi bi-pencil-square"></i> تعديل
                            </a>
                        </td>
                        <td>

                            <form id="delete-form-{{ $user->id }}" action="{{ route('delete.user', $user) }}"
                                method="POST" style="display: none;">
                                @csrf
                                @method('DELETE')
                            </form>


                            <button onclick="confirmDelete({{ $user->id }})" class="btn btn-danger btn-sm">
                                <i class="bi bi-trash"></i> حذف
                            </button>
                        </td>
                        @endcan
                    </tr>
                    @endforeach


                </tbody>
            </table>
        </div>
        <!-- /.card-body -->

    </div>
</div>
@endsection