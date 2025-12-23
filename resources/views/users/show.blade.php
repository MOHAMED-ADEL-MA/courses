@extends('layouts.master')
@section('title','المستخدمين')
@section('page-title',' المستخدمين')

@section('content')
<div class="card mb-4">
    <div class="card-header">
        <h3 class="card-title">كل المستخدمين</h3>
    </div>
    <!-- /.card-header -->
    <div class="card-body">
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th style="width: 10px">م</th>
                    <th>الاسم</th>
                    <th>البريد الالكتروني</th>
                    <th>الدور</th>
                    <th style="width: 40px">العمليه</th>
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
                    <td><span class="badge text-bg-danger">55%</span></td>
                </tr>
                @endforeach


            </tbody>
        </table>
    </div>
    <!-- /.card-body -->
    <div class="card-footer clearfix">
        <ul class="pagination pagination-sm m-0 float-end">
            <li class="page-item"><a class="page-link" href="#">&laquo;</a></li>
            <li class="page-item"><a class="page-link" href="#">1</a></li>
            <li class="page-item"><a class="page-link" href="#">2</a></li>
            <li class="page-item"><a class="page-link" href="#">3</a></li>
            <li class="page-item"><a class="page-link" href="#">&raquo;</a></li>
        </ul>
    </div>
</div>
@endsection