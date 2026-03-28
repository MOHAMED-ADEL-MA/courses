{{-- Side Bar --}}
<aside class="app-sidebar bg-body-secondary shadow" data-bs-theme="dark">
    <!--begin::Sidebar Brand-->
    <div class="sidebar-brand">
        <!--begin::Brand Link-->
        <a href="{{ route('dashboard') }}" class="brand-link">
            <!--begin::Brand Image-->
            <img src="{{ asset('img/booklogo.jpg') }}" alt="AdminLTE Logo" class="brand-image opacity-75 shadow" />
            <!--end::Brand Image-->
            <!--begin::Brand Text-->
            <span class="brand-text fw-light">إدارة مركز تدريب</span>
            <!--end::Brand Text-->
        </a>
        <!--end::Brand Link-->
    </div>
    <!--end::Sidebar Brand-->
    <!--begin::Sidebar Wrapper-->
    <div class="sidebar-wrapper">
        <nav class="mt-2">
            <!--begin::Sidebar Menu-->
            <ul class="nav sidebar-menu flex-column" data-lte-toggle="treeview" role="navigation"
                aria-label="Main navigation" data-accordion="false" id="navigation">
                <li class="nav-item">
                    <a href="{{ route('dashboard') }}" class="nav-link">
                        <i class="nav-icon bi bi-house-fill"></i>
                        <p>
                            الرئيسية
                        </p>
                    </a>
                </li>

                {{-- Users --}}
                <li class="nav-item">
                    <a href="#" class="nav-link">
                        <i class="nav-icon bi bi-people-fill"></i>
                        <p>
                            المستخدمين
                            <i class="nav-arrow bi bi-chevron-right"></i>
                        </p>
                    </a>
                    <ul class="nav nav-treeview">
                        @can('viewAny', Auth::user())
                            <li class="nav-item">
                                <a href="{{ route('show.user') }}" class="nav-link">
                                    <i class="nav-icon bi bi-circle"></i>
                                    <p>عرض المستخدمين</p>
                                </a>
                            </li>
                        @endcan
                        @can('view', Auth::user())
                            <li class="nav-item">
                                <a href="{{ route('register') }}" class="nav-link">
                                    <i class="nav-icon bi bi-circle"></i>
                                    <p>إضافة مستخدم</p>
                                </a>
                            </li>
                        @endcan

                    </ul>
                </li>

                {{-- Instructors --}}
                <li class="nav-item">
                    <a href="#" class="nav-link">
                        <i class="nav-icon bi bi-person-lines-fill"></i>
                        <p>
                            المدربين
                            <i class="nav-arrow bi bi-chevron-right"></i>
                        </p>
                    </a>
                    <ul class="nav nav-treeview">

                        <li class="nav-item">
                            <a href="{{ route('instructors.index') }}" class="nav-link">
                                <i class="nav-icon bi bi-circle"></i>
                                <p>عرض المدربين</p>
                            </a>
                        </li>

                        <li class="nav-item">
                            <a href="{{ route('instructors.create') }}" class="nav-link">
                                <i class="nav-icon bi bi-circle"></i>
                                <p>إضافة مدرب</p>
                            </a>
                        </li>


                    </ul>
                </li>
                {{-- Courses --}}
                <li class="nav-item">
                    <a href="#" class="nav-link">
                        <i class="nav-icon bi bi-book-fill"></i>
                        <p>
                            الكورسات
                            <i class="nav-arrow bi bi-chevron-right"></i>
                        </p>
                    </a>
                    <ul class="nav nav-treeview">

                        <li class="nav-item">
                            <a href="{{ route('courses.index') }}" class="nav-link">
                                <i class="nav-icon bi bi-circle"></i>
                                <p>الكورسات المتاحه</p>
                            </a>
                        </li>

                        <li class="nav-item">
                            <a href="{{ route('courses.create') }}" class="nav-link">
                                <i class="nav-icon bi bi-circle"></i>
                                <p>إضافة كورس جديد</p>
                            </a>
                        </li>


                    </ul>
                </li>
                {{-- Students --}}
                <li class="nav-item">
                    <a href="#" class="nav-link">
                        <i class="nav-icon bi bi-mortarboard-fill "></i>
                        <p>
                            الطلاب
                            <i class="nav-arrow bi bi-chevron-right"></i>
                        </p>
                    </a>
                    <ul class="nav nav-treeview">

                        <li class="nav-item">
                            <a href="{{ route('students.index') }}" class="nav-link">
                                <i class="nav-icon bi bi-circle"></i>
                                <p>عرض الطلاب</p>
                            </a>
                        </li>

                        <li class="nav-item">
                            <a href="{{ route('students.create') }}" class="nav-link">
                                <i class="nav-icon bi bi-circle"></i>
                                <p>إضافة طالب جديد</p>
                            </a>
                        </li>


                    </ul>
                </li>

                {{-- Invoices --}}
                <li class="nav-item">
                    <a href="#" class="nav-link">
                        <i class="nav-icon bi bi-clipboard-fill "></i>
                        <p>
                            الفواتير
                            <i class="nav-arrow bi bi-chevron-right"></i>
                        </p>
                    </a>
                    <ul class="nav nav-treeview">

                        <li class="nav-item">
                            <a href="{{ route('invoices.index') }}" class="nav-link">
                                <i class="nav-icon bi bi-circle"></i>
                                <p>عرض كل الفواتير</p>
                            </a>
                        </li>

                        <li class="nav-item">
                            <a href="{{ route('invoices.create') }}" class="nav-link">
                                <i class="nav-icon bi bi-circle"></i>
                                <p>إضافة فاتورة جديدة</p>
                            </a>
                        </li>


                    </ul>
                </li>

                {{-- Sessions and attendance --}}
                <li class="nav-item">
                    <a href="#" class="nav-link">
                        <i class="nav-icon bi bi-journal-bookmark-fill"></i>
                        <p>
                            الجلسات
                            <i class="nav-arrow bi bi-chevron-right"></i>
                        </p>
                    </a>
                    <ul class="nav nav-treeview">

                        <li class="nav-item">
                            <a href="{{ route('sessions.index') }}" class="nav-link">
                                <i class="nav-icon bi bi-circle"></i>
                                <p>ادارة الجلسات</p>
                            </a>
                        </li>




                    </ul>
                </li>

                {{-- Reports --}}
                <li class="nav-item">
                    <a href="#" class="nav-link">
                        <i class="nav-icon bi bi-bar-chart-fill "></i>
                        <p>
                            التقارير
                            <i class="nav-arrow bi bi-chevron-right"></i>
                        </p>
                    </a>
                    <ul class="nav nav-treeview">

                        <li class="nav-item">
                            <a href="{{ route('reports.index') }}" class="nav-link">
                                <i class="nav-icon bi bi-circle"></i>
                                <p>ادارة التقارير</p>
                            </a>
                        </li>




                    </ul>
                </li>


            </ul>
            <!--end::Sidebar Menu-->
        </nav>
    </div>
    <!--end::Sidebar Wrapper-->
</aside>
