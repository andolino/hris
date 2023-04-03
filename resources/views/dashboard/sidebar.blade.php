<aside class="main-sidebar sidebar-dark-primary elevation-4">
    <!-- Brand Logo -->
    <a href="#" class="brand-link">
        <img src="dist/img/AdminLTELogo.png" alt="AdminLTE Logo" class="brand-image img-circle elevation-3"
            style="opacity: .8">
        <span class="brand-text font-weight-light">HRIS</span>
    </a>

    <!-- Sidebar -->
    <div class="sidebar">
        <!-- Sidebar user panel (optional) -->
        <div class="user-panel mt-3 pb-3 mb-3 d-flex">
            <div class="image">
                <img src="dist/img/user2-160x160.jpg" class="img-circle elevation-2" alt="User Image">
            </div>
            <div class="info">
                <a href="#" class="d-block">{{ Auth::user()->name }}</a>
            </div>
        </div>
        <!-- Sidebar Menu -->
        <nav class="mt-2">
            <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
                <!-- Add icons to the links using the .nav-icon class
       with font-awesome or any other icon font library -->
                <li class="nav-item menu-open">
                    <a href="{{ route('dashboard') }}" class="nav-link @yield('dashboard-active')">
                        <i class="nav-icon fa-solid fa-gauge-high"></i>
                        <p>
                            Dashboard
                        </p>
                    </a>
                </li>
                <li class="nav-header">HUMAN RESOURCES</li>
                <li class="nav-item">
                    <a href="#" class="nav-link">
                        <i class="nav-icon fa-solid fa-sack-dollar"></i>
                        <p>
                            201 Employee
                            <i class="fas fa-angle-left right"></i>
                        </p>
                    </a>
                    <ul class="nav nav-treeview">
                        <li class="nav-item">
                            <a href="{{ route('employee_monthly') }}" class="nav-link">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Monthly</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ route('employee_weekly') }}" class="nav-link">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Weekly</p>
                            </a>
                        </li>

                    </ul>
                </li>
                <li class="nav-item">
                    <a href="#" class="nav-link">
                        <i class="nav-icon fa-solid fa-handcuffs"></i>
                        <p>
                            Department
                            <i class="fas fa-angle-left right"></i>
                        </p>
                    </a>
                    <ul class="nav nav-treeview">
                        <li class="nav-item">
                            <a href="{{ route('department') }}" class="nav-link">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Department List</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ route('departmentschedule') }}" class="nav-link">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Department Schedule</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ route('daytype') }}" class="nav-link">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Day Type</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ route('shifting') }}" class="nav-link">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Shifting</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="#" class="nav-link">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Add</p>
                            </a>
                        </li>

                    </ul>
                </li>
                <li class="nav-item">
                    <a href="#" class="nav-link">
                        <i class="nav-icon fa-solid fa-chart-pie"></i>
                        <p>
                            Employees History
                            <i class="fas fa-angle-left right"></i>
                        </p>
                    </a>
                    <ul class="nav nav-treeview">
                        <li class="nav-item">
                            <a href="#" class="nav-link">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Resigned</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="#" class="nav-link">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Terminate</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="#" class="nav-link">
                                <i class="far fa-circle nav-icon"></i>
                                <p>AWOL</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="#" class="nav-link">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Leaves</p>
                            </a>
                        </li>
                    </ul>
                </li>
                <li class="nav-item">
                    <a href="#" class="nav-link">
                        <i class="nav-icon fa-solid fa-edit"></i>
                        <p>
                            Employees Request
                            <i class="fas fa-angle-left right"></i>
                        </p>
                    </a>
                    <ul class="nav nav-treeview">
                        <li class="nav-item">
                            <a href="{{ route('ot_leave_request') }}" class="nav-link">
                                <i class="far fa-circle nav-icon"></i>
                                <p>OT/Leave Request</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ route('dtr_adj_request') }}" class="nav-link">
                                <i class="far fa-circle nav-icon"></i>
                                <p>DTR Adjustment Request</p>
                            </a>
                        </li>
                    </ul>
                </li>
                <li class="nav-header">DTR</li>
                <li class="nav-item @yield('emp-menu-open')">
                    <a href="#" class="nav-link @yield('emp-active')">
                        <i class="nav-icon fa-solid fa-users"></i>
                        <p>
                            Monthly
                            <i class="right fas fa-angle-left"></i>
                        </p>
                    </a>
                    <ul class="nav nav-treeview">
                        <li class="nav-item">
                            <a href="javascript:void(0);" class="nav-link @yield('emp-active')" 
                                data-form="mod_upload_dtr_form" 
                                data-type="import-dtr-monthly-form" 
                                id="show_form">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Upload DTR</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ route('dtr_list') }}" class="nav-link">
                                <i class="far fa-circle nav-icon"></i>
                                <p>DTR List</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ route('missed_time_in_out') }}" class="nav-link">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Missed Time in/out</p>
                            </a>
                        </li>
                        
                        {{-- <li class="nav-item">
                            <a href="#" class="nav-link">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Department Schedule</p>
                            </a>
                        </li> --}}
                        <li class="nav-item">
                            <a href="{{ route('employee_holiday') }}" class="nav-link">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Holiday</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="#" class="nav-link">
                                <i class="far fa-circle nav-icon"></i>
                                <p>View Logs</p>
                            </a>
                        </li>
                    </ul>
                </li>
                <li class="nav-item @yield('emp-menu-open')">
                    <a href="#" class="nav-link @yield('emp-active')">
                        <i class="nav-icon fa-solid fa-users"></i>
                        <p>
                            Weekly
                            <i class="right fas fa-angle-left"></i>
                        </p>
                    </a>
                    <ul class="nav nav-treeview">
                        <li class="nav-item">
                            <a href="javascript:void(0);" class="nav-link @yield('emp-active')" 
                                data-form="mod_upload_dtr_form" 
                                data-type="import-dtr-weekly-form" 
                                id="show_form">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Upload DTR</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="javascript:void(0);" class="nav-link @yield('emp-active')" 
                                data-form="mod_upload_piece_rate_form" 
                                data-type="import-piece-rate-form" 
                                id="show_form">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Upload Pieace Rate</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="#" class="nav-link">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Missed Time in/out</p>
                            </a>
                        </li>
                        {{-- <li class="nav-item">
                            <a href="#" class="nav-link">
                                <i class="far fa-circle nav-icon"></i>
                                <p>OT/Leave Request</p>
                            </a>
                        </li> --}}
                        {{-- <li class="nav-item">
                            <a href="#" class="nav-link">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Department Schedule</p>
                            </a>
                        </li> --}}
                        <li class="nav-item">
                            <a href="#" class="nav-link">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Holiday</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="#" class="nav-link">
                                <i class="far fa-circle nav-icon"></i>
                                <p>View Logs</p>
                            </a>
                        </li>
                    </ul>
                </li>
                <li class="nav-header">PAYROLL</li>
                <li class="nav-item">
                    <a href="{{ route('payroll_monthly') }}" class="nav-link">
                        <i class="nav-icon fa-solid fa-bullhorn"></i>
                        <p>
                            Monthly
                        </p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="{{ route('payroll_weekly') }}" class="nav-link">
                        <i class="nav-icon fa-solid fa-people-pulling"></i>
                        <p>
                            Weekly
                        </p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="#" class="nav-link">
                        <i class="nav-icon fa-solid fa-folder-minus"></i>
                        <p>
                            Managerial
                        </p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="#" class="nav-link">
                        <i class="nav-icon fa-solid fa-folder-minus"></i>
                        <p>
                            Reports
                        </p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="{{ url('loans') }}" class="nav-link">
                        <i class="nav-icon fa-solid fa-folder-minus"></i>
                        <p>
                            Loans
                        </p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="javascript:void(0);" 
                        data-form="mod_upload_dtr_form" 
                        data-type="import-outright-ded-form" 
                        id="show_form"
                        class="nav-link">
                        <i class="nav-icon fa-solid fa-folder-minus"></i>
                        <p>
                            Upload Outright Ded
                        </p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="javascript:void(0);" 
                        data-form="mod_upload_dtr_form" 
                        data-type="import-oth-ded-form" 
                        id="show_form"
                        class="nav-link">
                        <i class="nav-icon fa-solid fa-folder-minus"></i>
                        <p>
                            Upload Outside Ded
                        </p>
                    </a>
                </li>

                <li class="nav-item">
                    <a href="#" class="nav-link">
                        <i class="nav-icon fa-solid fa-signal"></i>
                        <p>
                            13th Month
                            <i class="fas fa-angle-left right"></i>
                        </p>
                    </a>
                    <ul class="nav nav-treeview">
                        <li class="nav-item">
                            <a href="#" class="nav-link">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Monthly</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="#" class="nav-link">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Weekly</p>
                            </a>
                        </li>

                    </ul>
                </li>

                <li class="nav-item">
                    <a href="{{ route('admin.logout') }}" class="nav-link">
                        <i class="text-danger nav-icon fa-solid fa-right-from-bracket"></i>
                        <p class="text">Log out</p>
                    </a>
                </li>
            </ul>
        </nav>
        <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->

</aside>
@include('dashboard.modal.upload_dtr')
@include('dashboard.modal.upload_piece_rate')