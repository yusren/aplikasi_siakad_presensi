<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>@yield('title')</title>
    <!-- Tell the browser to be responsive to screen width -->
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">

    <link rel="icon" href="{{ asset('img/logo.png') }}" type="image/png">

    <!-- Bootstrap 3.3.5 -->
    <link rel="stylesheet" href="{{ asset('assets/adminlte/bootstrap/css/bootstrap.min.css') }}">
    <!-- DataTables -->
    <link rel="stylesheet" href="{{ asset('assets/adminlte/plugins/datatables/dataTables.bootstrap.css') }}">
    <link rel="stylesheet"
        href="{{ asset('assets/adminlte/plugins/datatables/extensions/Responsive/css/dataTables.responsive.css') }}">
    <!-- Datetimepicker -->
    <link href="{{ asset('assets/adminlte/plugins/datepicker/bootstrap-datepicker.min.css') }}" rel="stylesheet"
        type="text/css" />
    <link href="{{ asset('assets/adminlte/plugins/datepicker/datepicker3.css') }}" rel="stylesheet" type="text/css" />
    <!-- Daterangepicker -->
    <link href="{{ asset('assets/adminlte/plugins/daterangepicker/daterangepicker-bs3.css') }}" rel="stylesheet"
        type="text/css" />

    <!-- Ionicons -->
    <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.4.0/css/font-awesome.min.css">
    <!-- Select2 -->
    <link rel="stylesheet" href="{{ asset('assets/adminlte/plugins/select2/select2.min.css') }}">
    <!-- Theme style -->
    {{-- <link rel="stylesheet" href="{{ asset('/AdminLTE-2/dist/css/AdminLTE.min.css') }}"> --}}
    <!-- AdminLTE Skins. Choose a skin from the css/skins folder instead of downloading all of them to reduce the load. -->
    {{-- <link rel="stylesheet" href="{{ asset('/AdminLTE-2/dist/css/skins/_all-skins.min.css') }}"> --}}

    <!-- Google Font -->
    <link rel="stylesheet"
        href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,600,700,300italic,400italic,600italic">
    <!-- Theme style -->
    <link rel="stylesheet" href="{{ asset('assets/zenTheme/css/AdminLTE.min.css') }}">
    <!-- Skins -->
    <link rel="stylesheet" href="{{ asset('assets/zenTheme/css/_all-skins.min.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/zenTheme/css/custom.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/zenTheme/css/admin-style.css') }}">
</head>

<body class="hold-transition skin-purple sidebar-mini">
    <div class="wrapper">
        @include('sweetalert::alert')

        <!-- Main Header -->
        <header class="main-header">

            <!-- Logo -->
            <a href="/" class="logo">
                <!-- mini logo for sidebar mini 50x50 pixels -->
                <span class="logo-mini"><b>POS</b></span>
                <!-- logo for regular state and mobile devices -->
                <span class="logo-lg"><b>POS</b></span>
            </a>

            <!-- Header Navbar -->
            <nav class="navbar navbar-static-top" role="navigation">
                <!-- Sidebar toggle button-->
                <a href="#" class="sidebar-toggle" data-toggle="offcanvas" role="button">
                    <span class="sr-only">Toggle navigation</span>
                </a>
                <!-- Navbar Right Menu -->
                <div class="navbar-custom-menu">
                    <ul class="nav navbar-nav">
                        <!-- User Account Menu -->
                        <li class="dropdown user user-menu">
                            <!-- Menu Toggle Button -->
                            <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                                <!-- The user image in the navbar-->
                                <img src="{{ asset('img/logo.png') }}" class="user-image" alt="User Image">
                                <!-- hidden-xs hides the username on small devices so only the image appears. -->
                                <span class="hidden-xs">{{ Auth::user()->name }}</span>
                            </a>
                            <ul class="dropdown-menu">
                                <!-- Menu Footer-->
                                <li class="user-footer">
                                    <div class="pull-left">
                                        <a href="{{ route('profile.edit') }}" class="btn btn-default btn-flat">
                                            Ganti Password
                                        </a>
                                    </div>
                                    <div class="pull-right">
                                        <form action="{{ route('logout') }}" method="POST">
                                            @csrf
                                            <button class="btn btn-default btn-flat">Logout</button>
                                        </form>
                                    </div>
                                </li>
                            </ul>
                        </li>
                    </ul>
                </div>
            </nav>
        </header>
        @include('layouts.sidebar')

        <!-- Content Wrapper. Contains page content -->
        <div class="content-wrapper">
            @yield('container')
        </div><!-- /.content-wrapper -->

        <!-- Main Footer -->
        <footer class="main-footer">
            <strong>
                Copyright &copy; {{ date('Y') }} SPPD | Developed by <a href="#">PT. Decaaindo. Surya
                    Persada</a>.
            </strong>
            <!-- Default to the left -->

        </footer>
    </div><!-- ./wrapper -->

    <!-- REQUIRED JS SCRIPTS -->

    <!-- jQuery 2.1.4 -->
    <script src="{{ asset('assets/adminlte/plugins/jQuery/jQuery-2.1.4.min.js') }}"></script>
    <!-- Bootstrap 3.3.5 -->
    <script src="{{ asset('assets/adminlte/bootstrap/js/bootstrap.min.js') }}"></script>
    <!-- Select2 -->
    <script src="{{ asset('assets/adminlte/plugins/select2/select2.full.min.js') }}"></script>
    <!-- Datepicker -->
    <script src="{{ asset('assets/adminlte/plugins/datepicker/bootstrap-datepicker.min.js') }}"></script>
    <!-- AdminLTE App -->
    <script src="{{ asset('assets/adminlte/dist/js/app.min.js') }}"></script>
    <!-- DataTables -->
    <script src="{{ asset('assets/adminlte/plugins/datatables/jquery.dataTables.min.js') }}"></script>
    <script src="{{ asset('assets/adminlte/plugins/datatables/dataTables.bootstrap.min.js') }}"></script>
    <!-- SlimScroll -->
    <script src="{{ asset('assets/adminlte/plugins/slimScroll/jquery.slimscroll.min.js') }}"></script>
    <!-- FastClick -->
    <script src="{{ asset('assets/adminlte/plugins/fastclick/fastclick.min.js') }}"></script>
    <!-- bootstrap time picker -->
    <script src="{{ asset('assets/adminlte/plugins/datepicker/bootstrap-datepicker.min.js') }}"></script>
    <script src="{{ asset('assets/adminlte/plugins/datepicker/bootstrap-datepicker.js') }}"></script>
    <!-- datetimerange -->
    <script src="{{ asset('assets/adminlte/plugins/daterangepicker/moment.js') }}"></script>
    <script src="{{ asset('assets/adminlte/plugins/daterangepicker/daterangepicker.js') }}"></script>
    <!-- page script -->
    <script>
        $(function() {
            $(".select2").select2();
            $("#example1").DataTable();
            $('#example2').DataTable({
                "paging": true,
                "lengthChange": false,
                "searching": false,
                "ordering": true,
                "info": true,
                "autoWidth": false
            });

            //Date picker
            $('#datepicker').datepicker({
                autoclose: true
            })
        });
    </script>
    @yield('page-script')
</body>

</html>
