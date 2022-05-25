<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>MTL Cooperatives</title>

    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
    <!--Import materialize.css-->
    <!-- <link type="text/css" rel="stylesheet" href="css/materialize.min.css"  media="screen,projection"/> -->
    <!--<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/materialize/1.0.0/css/materialize.min.css">-->

    <!-- Google Font: Source Sans Pro -->
    <link rel="stylesheet"
        href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="{{ asset('plugins/fontawesome-free/css/all.min.css') }}">
    <!-- Ionicons -->
    <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
    <!-- Tempusdominus Bootstrap 4 -->
    <link rel="stylesheet"
        href="{{ asset('plugins/tempusdominus-bootstrap-4/css/tempusdominus-bootstrap-4.min.css') }}">
    <!-- iCheck -->

    <link rel="stylesheet" href="{{ asset('plugins/icheck-bootstrap/icheck-bootstrap.min.css') }}">

    <!-- Theme style -->
    <link rel="stylesheet" href="{{ asset('dist/css/adminlte.min.css') }}">
    <!-- overlayScrollbars -->
    <link rel="stylesheet" href="{{ asset('plugins/overlayScrollbars/css/OverlayScrollbars.min.css') }}">
    <!-- Daterange picker -->
    <link rel="stylesheet" href="{{ asset('plugins/daterangepicker/daterangepicker.css') }}">
    <!-- summernote -->
    <link rel="stylesheet" href="{{ asset('plugins/summernote/summernote-bs4.min.css') }}">
    <link rel="stylesheet" href="{{ asset('css/mystyle.css') }}">
    @yield('css')
    <!-- Scripts -->
    <script src="{{ asset('js/myjavascript.js') }}" defer></script>
</head>

<body class="hold-transition sidebar-mini layout-fixed">
    <div class="wrapper">

        <!-- Preloader
  <div class="preloader flex-column justify-content-center align-items-center">
    <img class="animation__shake" src="{{ asset('img/dvllogo.png') }}" alt="AdminLTELogo" height="60" width="60">
  </div> -->

        <!-- Navbar -->
        <nav class="main-header navbar navbar-expand navbar-white navbar-light">
            <!-- Left navbar links -->
            <ul class="navbar-nav">
                <li class="nav-item">
                    <a class="nav-link" data-widget="pushmenu" href="#" role="button"><i class="fas fa-bars"></i></a>
                </li>
                <li class="nav-item d-none d-sm-inline-block">
                    <a href="{{ url('/home') }}" class="nav-link">Home</a>
                </li>
                <li class="nav-item d-none d-sm-inline-block">
                    <a href="#" class="nav-link">Contact</a>
                </li>
            </ul>

            <!-- Right navbar links -->
            <ul class="navbar-nav ml-auto">
                <!-- Navbar Search -->
                <li class="nav-item">
                    <a class="nav-link" data-widget="navbar-search" href="#" role="button">
                        <i class="fas fa-search"></i>
                    </a>
                    <div class="navbar-search-block">
                        <form class="form-inline">
                            <div class="input-group input-group-sm">
                                <input class="form-control form-control-navbar" type="search" placeholder="Search"
                                    aria-label="Search">
                                <div class="input-group-append">
                                    <button class="btn btn-navbar" type="submit">
                                        <i class="fas fa-search"></i>
                                    </button>
                                    <button class="btn btn-navbar" type="button" data-widget="navbar-search">
                                        <i class="fas fa-times"></i>
                                    </button>
                                </div>
                            </div>
                        </form>
                    </div>
                </li>
                <!-- Notifications Dropdown Menu -->
                <li class="nav-item dropdown">
                    <a class="nav-link" data-toggle="dropdown" href="#">
                        <i class="far fa-bell"></i>
                        <span class="badge badge-warning navbar-badge">15</span>
                    </a>
                    <div class="dropdown-menu dropdown-menu-lg dropdown-menu-right">
                        <span class="dropdown-item dropdown-header">Notifications</span>
                        <div class="dropdown-divider"></div>
                        <a href="#" class="dropdown-item">
                            <i class="fas fa-envelope mr-2"></i> 4 new messages
                            <span class="float-right text-muted text-sm">3 mins</span>
                        </a>
                        <div class="dropdown-divider"></div>
                        <a href="#" class="dropdown-item dropdown-footer">See All Notifications</a>
                    </div>
                </li>
                <li class="nav-item">
                    <a class="nav-link" data-widget="fullscreen" href="#" role="button">
                        <i class="fas fa-expand-arrows-alt"></i>
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" data-widget="control-sidebar" data-slide="true" href="#" role="button">
                        <i class="fas fa-th-large"></i>
                    </a>
                </li>
            </ul>
        </nav>
        <!-- /.navbar -->

        <!-- Main Sidebar Container -->
        <aside class="main-sidebar sidebar-dark-primary elevation-4">
            <!-- Brand Logo -->
            <a href="{{ url('/home') }}" class="brand-link">
                <img src="{{ asset('img/coop_logo.jpeg') }}" alt="AdminLTE Logo"
                    class="brand-image img-circle elevation-3" style="opacity: .8">
                <span class="brand-text font-weight-light">MTL Cooperative</span>
            </a>

            <!-- Sidebar -->
            <div class="sidebar">
                <!-- Sidebar user panel (optional) -->
                <div class="user-panel mt-3 pb-3 mb-3 d-flex">
                    <div class="image">
                        <img src="{{ asset('dist/img/user2-160x160.jpg') }}" class="img-circle elevation-2"
                            alt="User Image">
                    </div>
                    <div class="info">
                        <a href="#" class="d-block">Njoku Chris</a>
                    </div>
                </div>
                <!-- Sidebar Menu -->
                <nav class="mt-2">
                    <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu"
                        data-accordion="false">
                        <!-- Add icons to the links using the .nav-icon class
               with font-awesome or any other icon font library -->
                        <?php
                        $segment = Request::segment(2);
                        $segment1 = Request::segment(3);
                        ?>
                        <li class="nav-item menu-open">
                            <a href="{{ route('home') }}" class="nav-link
            @if (!$segment) active @endif ">

              <i class=" nav-icon fas fa-tachometer-alt"></i>
                                <p>
                                    Dashboard
                                </p>
                            </a>
                        </li>

                        @can('admin')
                        <li class="nav-item">
                            <a href="#" class="nav-link">
                                <i class="nav-icon fas fa-copy"></i>
                                <p>
                                    Cooperative Members
                                    <i class="fas fa-angle-left right"></i>

                                </p>
                            </a>
                            <ul class="nav nav-treeview">
                                <li class="nav-item">
                                    <a href="{{ route('members.create') }}" class="nav-link">

                                        <i class="far fa-circle nav-icon"></i>
                                        <p>New Member Registration</p>
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a href="{{ route('members.index') }}" class="nav-link">
                                    <i class=" far fa-circle nav-icon"></i>
                                        <p>Manage Member</p>
                                    </a>
                                </li>

                            </ul>
                        </li>
                        @endcan




                        <li class="nav-item">
                            <a href="#" class="nav-link">
                                <i class="nav-icon fas fa-copy"></i>
                                <p>
                                    Self Help
                                    <i class="fas fa-angle-left right"></i>
                                </p>
                            </a>
                            <ul class="nav nav-treeview">

                                <li class="nav-item">
                                    <a href="{{ route('loans.create') }}" class="nav-link">
                                        <i class="far fa-circle nav-icon"></i>
                                        <p>
                                            Self

                                        </p>
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a href="{{ route('loans.index') }}" class="nav-link">
                                        <i class="far fa-circle nav-icon"></i>
                                        <p>Self</p>
                                    </a>
                                </li>

                            </ul>
                        </li>

                        @can('admin')
                        <li class="nav-item">
                            <a href="#" class="nav-link">
                                <i class="nav-icon fas fa-copy"></i>
                                <p>
                                    Loans
                                    <i class="fas fa-angle-left right"></i>
                                </p>
                            </a>
                            <ul class="nav nav-treeview">

                                <li class="nav-item">
                                    <a href="{{ route('loans.create') }}" class="nav-link">
                                        <i class="far fa-circle nav-icon"></i>
                                        <p>
                                            Loan Application

                                        </p>
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a href="{{ route('loans.index') }}" class="nav-link">
                                        <i class="far fa-circle nav-icon"></i>
                                        <p>Loans Managemrt</p>
                                    </a>
                                </li>

                            </ul>
                        </li>
                        @endcan

                        @can('admin')
                        <li class="nav-item">
                            <a href="#" class="nav-link">
                                <i class="nav-icon fas fa-copy"></i>
                                <p>
                                    Cash Withdrawers
                                    <i class="fas fa-angle-left right"></i>
                                </p>
                            </a>
                            <ul class="nav nav-treeview">

                                <li class="nav-item">
                                    <a href="{{ route('withdrawers.create') }}" class="nav-link">
                                        <i class="far fa-circle nav-icon"></i>
                                        <p>
                                            Cash Withdrawers

                                        </p>
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a href="{{ route('withdrawers.index') }}" class="nav-link">
                                        <i class="far fa-circle nav-icon"></i>
                                        <p>Manage Withdrawers</p>
                                    </a>
                                </li>
                            </ul>
                        </li>
                        @endcan

                        @can('admin')
                        <li class="nav-item">
                            <a href="#" class="nav-link">
                                <i class="nav-icon fas fa-copy"></i>
                                <p>
                                    Cash Deposits
                                    <i class="fas fa-angle-left right"></i>
                                </p>
                            </a>
                            <ul class="nav nav-treeview">

                                <li class="nav-item">
                                    <a href="{{ route('deposit.create') }}" class="nav-link">
                                        <i class="far fa-circle nav-icon"></i>
                                        <p>
                                            Cash Deposits

                                        </p>
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a href="{{ route('deposit.index') }}" class="nav-link">
                                        <i class="far fa-circle nav-icon"></i>
                                        <p>Manage Cash Deposits</p>
                                    </a>
                                </li>
                            </ul>
                        </li>
                        @endcan

                        @can('admin')
                        <li class="nav-item">
                            <a href="#" class="nav-link">
                                <i class="nav-icon fas fa-copy"></i>
                                <p>
                                    Receivables
                                    <i class="fas fa-angle-left right"></i>
                                </p>
                            </a>
                            <ul class="nav nav-treeview">

                                <li class="nav-item">
                                    <a href="{{ route('receipt.create') }}" class="nav-link">
                                        <i class="far fa-circle nav-icon"></i>
                                        <p>
                                            Cash Receipts

                                        </p>
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a href="{{ route('receipt.index') }}" class="nav-link">
                                        <i class="far fa-circle nav-icon"></i>
                                        <p>Manage Receipts</p>
                                    </a>
                                </li>
                            </ul>
                        </li>
                        @endcan

                        @can('admin')
                        <li class="nav-item">
                            <a href="#" class="nav-link">
                                <i class="nav-icon fas fa-copy"></i>
                                <p>
                                    Payables
                                    <i class="fas fa-angle-left right"></i>
                                </p>
                            </a>
                            <ul class="nav nav-treeview">

                                <li class="nav-item">
                                    <a href="{{ route('payments.create') }}" class="nav-link">
                                        <i class="far fa-circle nav-icon"></i>
                                        <p>
                                            New Payments

                                        </p>
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a href="{{ route('payments.index') }}" class="nav-link">
                                        <i class="far fa-circle nav-icon"></i>
                                        <p>Manage Payments</p>
                                    </a>
                                </li>
                            </ul>
                        </li>


                        <li class="nav-item">
                            <a href="#" class="nav-link">
                                <i class="nav-icon fas fa-copy"></i>
                                <p>
                                    Comodities
                                    <i class="fas fa-angle-left right"></i>
                                </p>
                            </a>
                            <ul class="nav nav-treeview">

                                <li class="nav-item">
                                    <a href="{{ route('orders.create') }}" class="nav-link">
                                        <i class="far fa-circle nav-icon"></i>
                                        <p>
                                            New Order
                                        </p>
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a href="#" class="nav-link">
                                        <i class="far fa-circle nav-icon"></i>
                                        <p>Manage Comodities</p>
                                    </a>
                                </li>
                            </ul>
                        </li>
                        <li class="nav-item">
                            <a href="#" class="nav-link">
                                <i class="nav-icon fas fa-copy"></i>
                                <p>
                                    Setups
                                    <i class="fas fa-angle-left right"></i>

                                </p>
                            </a>
                            <ul class="nav nav-treeview">
                                <li class="nav-item">
                                    <a href="{{ route('products.index') }}" class="nav-link">
                                        <i class="far fa-circle nav-icon"></i>
                                        <p>Create Products</p>
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a href="{{ route('prod_category.index') }}" class="nav-link">
                                        <i class="far fa-circle nav-icon"></i>
                                        <p>Create Product Category</p>
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a href="{{ route('company.index') }}" class="nav-link">
                                        <i class="far fa-circle nav-icon"></i>
                                        <p>Create Company</p>
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a href="{{ route('accounts.index') }}" class="nav-link">
                                        <i class="far fa-circle nav-icon"></i>
                                        <p>accounts</p>
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a href="{{ route('branch.index') }}" class="nav-link">
                                        <i class=" far fa-circle nav-icon"></i>
                                        <p>Branch</p>
                                    </a>
                                </li>

                            </ul>
                        </li>

                        <li class="nav-item">
                            <a href="#" class="nav-link
                                @if ($segment=='setups' ) active @endif">
                                <i class="nav-icon fas fa-copy"></i>
                                <p>
                                    Reports
                                    <i class="fas fa-angle-left right"></i>

                                </p>
                            </a>
                            <ul class="nav nav-treeview">
                                <li class="nav-item">
                                    <a href="{{ route('company.index') }}" class="nav-link">
                                        <i class="far fa-circle nav-icon"></i>
                                        <p>Loans Report</p>
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a href="#" class="nav-link
                                        @if ($segment=='setups' ) active @endif ">
                                        <i class=" far fa-circle nav-icon"></i>
                                        <p>Cash Deposit Report</p>
                                    </a>
                                </li>

                            </ul>
                        </li>

                        <li class="nav-item">
                            <a href="#" class="nav-link
                                @if ($segment=='setups' ) active @endif">
                                <i class="nav-icon fas fa-copy"></i>
                                <p>
                                    Services
                                    <i class="fas fa-angle-left right"></i>

                                </p>
                            </a>
                            <ul class="nav nav-treeview">
                                <li class="nav-item">
                                    <a href="{{ route('users.create') }}" class="nav-link">
                                        <i class="far fa-circle nav-icon"></i>
                                        <p>Create User</p>
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a href="{{ route('users.index') }}" class="nav-link">
                                        <i class="far fa-circle nav-icon"></i>
                                        <p>Users List</p>
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a href="{{ route('roles.index') }}" class="nav-link
                                        @if ($segment=='setups' ) active @endif ">
                                        <i class=" far fa-circle nav-icon"></i>
                                        <p>Roles</p>
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a href="#" class="nav-link
                                        @if ($segment=='setups' ) active @endif ">
                                        <i class=" far fa-circle nav-icon"></i>
                                        <p>Role Permission</p>
                                    </a>
                                </li>

                            </ul>
                        </li>
                        @endcan





                        <li class="nav-header">Action</li>
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('logout') }}" onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                                <i class="nav-icon far fa-circle text-danger"></i>
                                {{ __('Logout') }}
                            </a>

                            <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                                @csrf
                            </form>


                        </li>

                    </ul>
                </nav>
                <!-- /.sidebar-menu -->
            </div>
            <!-- /.sidebar -->
        </aside>

        <!-- Content Wrapper. Contains page content -->
        <div class="content-wrapper">
            @yield('content')
        </div>
        <!-- /.content-wrapper -->
        <footer class="main-footer">
            <strong>Copyright &copy; 2021 <a href="#">Chris</a>.</strong>
            All rights reserved.
            <div class="float-right d-none d-sm-inline-block">
                <b>Version</b> 3.1.0
            </div>
        </footer>

        <!-- Control Sidebar -->
        <aside class="control-sidebar control-sidebar-dark">
            <!-- Control sidebar content goes here -->
        </aside>
        <!-- /.control-sidebar -->
    </div>
    <!-- ./wrapper -->

    <!-- jQuery -->
    <script src="{{ asset('plugins/jquery/jquery.min.js') }}"></script>
    <!-- jQuery UI 1.11.4 -->
    <script src="{{ asset('plugins/jquery-ui/jquery-ui.min.js') }}"></script>
    <!-- Resolve conflict in jQuery UI tooltip with Bootstrap tooltip -->
    <script>
        $.widget.bridge('uibutton', $.ui.button)
    </script>
    <!-- Bootstrap 4 -->
    <script src="{{ asset('plugins/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
    <!-- ChartJS -->
    <script src="{{ asset('plugins/chart.js/Chart.min.js') }}"></script>
    <!-- Sparkline -->
    <script src="{{ asset('plugins/sparklines/sparkline.js') }}"></script>
    <!-- jQuery Knob Chart -->
    <script src="{{ asset('plugins/jquery-knob/jquery.knob.min.js') }}"></script>
    <!-- daterangepicker -->
    <script src="{{ asset('plugins/moment/moment.min.js') }}"></script>
    <script src="{{ asset('plugins/daterangepicker/daterangepicker.js') }}"></script>
    <!-- Tempusdominus Bootstrap 4 -->
    <script src="{{ asset('plugins/tempusdominus-bootstrap-4/js/tempusdominus-bootstrap-4.min.js') }}"></script>
    <!-- Summernote -->
    <script src="{{ asset('plugins/summernote/summernote-bs4.min.js') }}"></script>
    <!-- overlayScrollbars -->
    <script src="{{ asset('plugins/overlayScrollbars/js/jquery.overlayScrollbars.min.js') }}"></script>
    <!-- AdminLTE App -->
    <script src="{{ asset('dist/js/adminlte.js') }}"></script>
    <script src="{{ asset('js/sweetalert.js') }}"></script>
    <!-- AdminLTE for demo purposes -->
    <script src="{{ asset('dist/js/demo.js') }}"></script>
    <!-- AdminLTE dashboard demo (This is only for demo purposes) -->
    <script src="{{ asset('dist/js/pages/dashboard.js') }}"></script>

    <script>
        //Date range picker
        $('#reservation').daterangepicker()


        // Prepare the preview for profile picture
        $("#wizard-picture").change(function() {
            readURL(this);
        });

        //Function to show image before upload

        function readURL(input) {
            if (input.files && input.files[0]) {
                var reader = new FileReader();

                reader.onload = function(e) {
                    $('#wizardPicturePreview').attr('src', e.target.result).fadeIn('slow');
                }
                reader.readAsDataURL(input.files[0]);
            }
        }
    </script>

    <script>
        @if (session('message'))
            // alert('{{ session('message') }}');
            // @endif

        @if (session('message'))
            swal("Success","{{ session('message') }}","success",{
            button:"Done",
            })
        @endif
    </script>

    <!--
<script>
    $(document).ready(function() {
        let row_number = 1;
        $("#add_row").click(function(e) {
            e.preventDefault();
            let new_row_number = row_number - 1;
            $('#product' + row_number).html($('#product' + new_row_number).html()).find(
                'td:first-child');
            $('#products_table').append('<tr id="product' + (row_number + 1) + '"></tr>');
            row_number++;
        });

        $("#delete_row").click(function(e) {
            e.preventDefault();
            if (row_number > 1) {
                $("#product" + (row_number - 1)).html('');
                row_number--;
            }
        });
    });
</script>-->
    @stack('scripts')
</body>

</html>
