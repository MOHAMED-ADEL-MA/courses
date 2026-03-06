@extends('layouts.master')

@section('content')
    <!-- Info boxes -->
    <div class="row">

        <div class="col-12 col-sm-6 col-md-3">
            <div class="info-box">
                <span class="info-box-icon text-bg-primary shadow-sm">
                    <i class="bi bi-people-fill"></i>
                </span>
                <div class="info-box-content">
                    <span class="info-box-text">المدربين</span>
                    <span class="info-box-number">{{ \App\Models\Instructor::count() }}</span>
                </div>
                <!-- /.info-box-content -->
            </div>
            <!-- /.info-box -->
        </div>
        <!-- /.col -->
        <div class="col-12 col-sm-6 col-md-3">
            <div class="info-box">
                <span class="info-box-icon text-bg-warning shadow-sm">
                    <i class="bi bi-people-fill"></i>
                </span>
                <div class="info-box-content">
                    <span class="info-box-text">الطلاب</span>
                    <span class="info-box-number">{{ \App\Models\Student::count() }}</span>
                </div>
                <!-- /.info-box-content -->
            </div>
            <!-- /.info-box -->
        </div>
        <!-- /.col -->
        <div class="col-12 col-sm-6 col-md-3">
            <div class="info-box">
                <span class="info-box-icon text-bg-success shadow-sm">
                    <i class="bi bi-book-fill"></i>
                </span>
                <div class="info-box-content">
                    <span class="info-box-text">الكورسات</span>
                    <span class="info-box-number">{{ \App\Models\Course::count() }}</span>
                </div>
                <!-- /.info-box-content -->
            </div>
            <!-- /.info-box -->
        </div>
        <!-- /.col -->
        <div class="col-12 col-sm-6 col-md-3">
            <div class="info-box">
                <span class="info-box-icon text-bg-danger shadow-sm">
                    <i class="bi bi-people-fill"></i>
                </span>
                <div class="info-box-content">
                    <span class="info-box-text">المستخدمين</span>
                    <span class="info-box-number">{{ \App\Models\User::count() }}</span>
                </div>
                <!-- /.info-box-content -->
            </div>
            <!-- /.info-box -->
        </div>
        <!-- /.col -->
    </div>
    <!-- /.row -->

    {{-- التقارير --}}

    {{-- <!-- Info boxes -->
    <div class="row">

        <div class="col-12 col-sm-6 col-md-3">
            <div class="info-box">
                <span class="info-box-icon text-bg-primary shadow-sm">
                    <i class="bi bi-clipboard-fill"></i>
                </span>
                <div class="info-box-content">
                    <span class="info-box-text">عدد الفواتير</span>
                    <span class="info-box-number">{{ \App\Models\Invoice::count() }}</span>
                </div>
                <!-- /.info-box-content -->
            </div>
            <!-- /.info-box -->
        </div>
        <!-- /.col -->
        <div class="col-12 col-sm-6 col-md-3">
            <div class="info-box">
                <span class="info-box-icon text-bg-warning shadow-sm">
                    <i class="bi bi-clipboard-fill"></i>
                </span>
                <div class="info-box-content">
                    <span class="info-box-text">اجمالي الفواتير</span>
                    <span class="info-box-number">{{ number_format(\App\Models\Invoice::sum('total_amount')) }} ج.م</span>
                </div>
                <!-- /.info-box-content -->
            </div>
            <!-- /.info-box -->
        </div>
        <!-- /.col -->
        <div class="col-12 col-sm-6 col-md-3">
            <div class="info-box">
                <span class="info-box-icon text-bg-success shadow-sm">
                    <i class="bi bi-clipboard-fill"></i>
                </span>
                <div class="info-box-content">
                    <span class="info-box-text">الفواتير المدفوعه</span>
                    <span
                        class="info-box-number">{{ number_format(\App\Models\Invoice::where('status', 'مدفوعة')->sum('total_amount')) }}
                        ج.م</span>
                </div>
                <!-- /.info-box-content -->
            </div>
            <!-- /.info-box -->
        </div>
        <!-- /.col -->
        <div class="col-12 col-sm-6 col-md-3">
            <div class="info-box">
                <span class="info-box-icon text-bg-danger shadow-sm">
                    <i class="bi bi-clipboard-fill"></i>
                </span>
                <div class="info-box-content">
                    <span class="info-box-text">الفواتير غير المدفوعه</span>
                    <span class="info-box-number">
                        {{ number_format(\App\Models\Invoice::where('status', 'غير مدفوعة')->sum('total_amount')) }}
                        ج.م</span>
                </div>
                <!-- /.info-box-content -->
            </div>
            <!-- /.info-box -->
        </div>
        <!-- /.col -->
    </div> --}}
    <!-- /.row -->
    <div class="row">
        <!-- /.col -->
        <div class="col-md-4">
            <!-- Info Boxes Style 2 -->
            <div class="info-box mb-3 text-bg-info">
                <span class="info-box-icon"> <i class="bi bi-clipboard-fill"></i> </span>
                <div class="info-box-content">
                    <span class="info-box-text">اجمالي الفواتير : {{ \App\Models\Invoice::count() }}</span>
                    <span class="info-box-number">{{ \App\Models\Invoice::sum('total_amount') }} ج.م</span>
                </div>
                <!-- /.info-box-content -->
            </div>
            <!-- /.info-box -->
            <div class="info-box mb-3 text-bg-success">
                <span class="info-box-icon"> <i class="bi bi-clipboard-fill"></i> </span>
                <div class="info-box-content">
                    <span class="info-box-text">الفواتير المدفوعة :
                        {{ \App\Models\Invoice::where('status', 'مدفوعة')->count() }}</span>
                    <span class="info-box-number">{{ \App\Models\Invoice::where('status', 'مدفوعة')->sum('total_amount') }}
                        ج.م</span>
                </div>
                <!-- /.info-box-content -->
            </div>
            <div class="info-box mb-3 text-bg-warning">
                <span class="info-box-icon"> <i class="bi bi-clipboard-fill"></i> </span>
                <div class="info-box-content">
                    <span class="info-box-text"> الفواتير المدفوعة جزئيا:
                        {{ \App\Models\Invoice::where('status', 'مدفوعة جزئيا')->count() }}</span>
                    <span
                        class="info-box-number">{{ \App\Models\Invoice::where('status', 'مدفوعة جزئيا')->sum('total_amount') }}
                        ج.م</span>
                </div>
                <!-- /.info-box-content -->
            </div>
            <div class="info-box mb-3 text-bg-danger">
                <span class="info-box-icon"> <i class="bi bi-clipboard-fill"></i> </span>
                <div class="info-box-content">
                    <span class="info-box-text">الفواتير غير المدفوعة :
                        {{ \App\Models\Invoice::where('status', 'غير مدفوعة')->count() }}</span>
                    <span
                        class="info-box-number">{{ \App\Models\Invoice::where('status', 'غير مدفوعة')->sum('total_amount') }}
                        ج.م</span>
                </div>
                <!-- /.info-box-content -->
            </div>




        </div>
        <!-- /.col -->
        <!-- Start col -->
        <div class="col-md-8">
            <!--begin::Latest Order Widget-->
            <div class="card">
                <div class="card-header bg-primary text-white">
                    <h3 class="card-title">حاله الفواتير</h3>
                    <div class="card-tools">
                        <button type="button" class="btn btn-tool text-white" data-lte-toggle="card-collapse">
                            <i data-lte-icon="expand" class="bi bi-plus-lg"></i>
                            <i data-lte-icon="collapse" class="bi bi-dash-lg"></i>
                        </button>

                    </div>
                </div>
                <!-- /.card-header -->
                <div class="card-body p-0">
                    <div class="table-responsive">
                        <table class="table m-0">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>العناصر</th>
                                    <th>الحالة</th>
                                    <th>الاجمالي</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td>
                                        <span>1</span>
                                    </td>
                                    <td>الفواتير المدفوعه</td>
                                    <td><span class="badge text-bg-success"> Shipped </span></td>
                                    <td>
                                        <div id="table-sparkline-1"></div>
                                    </td>
                                </tr>
                                <tr>
                                    <td>
                                        <a href="pages/examples/invoice.html"
                                            class="link-primary link-offset-2 link-underline-opacity-25 link-underline-opacity-100-hover">OR1848</a>
                                    </td>
                                    <td>Samsung Smart TV</td>
                                    <td><span class="badge text-bg-warning">Pending</span></td>
                                    <td>
                                        <div id="table-sparkline-2"></div>
                                    </td>
                                </tr>
                                <tr>
                                    <td>
                                        <a href="pages/examples/invoice.html"
                                            class="link-primary link-offset-2 link-underline-opacity-25 link-underline-opacity-100-hover">OR7429</a>
                                    </td>
                                    <td>iPhone 6 Plus</td>
                                    <td><span class="badge text-bg-danger"> Delivered </span></td>
                                    <td>
                                        <div id="table-sparkline-3"></div>
                                    </td>
                                </tr>
                                <tr>
                                    <td>
                                        <a href="pages/examples/invoice.html"
                                            class="link-primary link-offset-2 link-underline-opacity-25 link-underline-opacity-100-hover">OR7429</a>
                                    </td>
                                    <td>Samsung Smart TV</td>
                                    <td><span class="badge text-bg-info">Processing</span></td>
                                    <td>
                                        <div id="table-sparkline-4"></div>
                                    </td>
                                </tr>
                                <tr>
                                    <td>
                                        <a href="pages/examples/invoice.html"
                                            class="link-primary link-offset-2 link-underline-opacity-25 link-underline-opacity-100-hover">OR1848</a>
                                    </td>
                                    <td>Samsung Smart TV</td>
                                    <td><span class="badge text-bg-warning">Pending</span></td>
                                    <td>
                                        <div id="table-sparkline-5"></div>
                                    </td>
                                </tr>
                                <tr>
                                    <td>
                                        <a href="pages/examples/invoice.html"
                                            class="link-primary link-offset-2 link-underline-opacity-25 link-underline-opacity-100-hover">OR7429</a>
                                    </td>
                                    <td>iPhone 6 Plus</td>
                                    <td><span class="badge text-bg-danger"> Delivered </span></td>
                                    <td>
                                        <div id="table-sparkline-6"></div>
                                    </td>
                                </tr>
                                <tr>
                                    <td>
                                        <a href="pages/examples/invoice.html"
                                            class="link-primary link-offset-2 link-underline-opacity-25 link-underline-opacity-100-hover">OR9842</a>
                                    </td>
                                    <td>Call of Duty IV</td>
                                    <td><span class="badge text-bg-success">Shipped</span></td>
                                    <td>
                                        <div id="table-sparkline-7"></div>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                    <!-- /.table-responsive -->
                </div>
                <!-- /.card-body -->
                <div class="card-footer clearfix">
                    <a href="javascript:void(0)" class="btn btn-sm btn-primary float-start">
                        Place New Order
                    </a>
                    <a href="javascript:void(0)" class="btn btn-sm btn-secondary float-end">
                        View All Orders
                    </a>
                </div>
                <!-- /.card-footer -->
            </div>
            <!-- /.card -->
        </div>


    </div>
@endsection
