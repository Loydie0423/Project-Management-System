<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <meta title="token" content="{{ csrf_token() }}">
    <title>{{ env('APP_NAME', 'PMS') }}</title>
    <link rel="stylesheet" href="{{ asset('plugins/bootstrap4.5.3.min.css') }}">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.6.0/css/all.min.css"
        integrity="sha512-Kc323vGBEqzTmouAECnVceyQqyqdsSiqLQISBL29aUW4U/M7pSPA/gEUZQqv1cwx4OnYxTxve5UMg5GT6L4JJg=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link href="https://cdn.datatables.net/1.10.21/css/jquery.dataTables.min.css" rel="stylesheet">
    <link href="https://cdn.datatables.net/1.10.21/css/dataTables.bootstrap4.min.css" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('css/adminlte.min.css') }}">
    <link rel="stylesheet" href="{{ asset('css/pms.css') }}">
    <script src="{{ asset('plugins/jquery-3.7.1.min.js') }}"></script>
    <script src="{{ asset('plugins/sweetalert2.11.14.3.js') }}"></script>
</head>

<body>

    <body class="hold-transition sidebar-mini layout-fixed">
        <div class="wrapper">

            <!-- Navbar -->
            <nav class="main-header navbar navbar-expand navbar-white navbar-light">
                <!-- Left navbar links -->
                <ul class="navbar-nav">
                    <li class="nav-item">
                        <a class="nav-link" data-widget="pushmenu" href="#" role="button"><i
                                class="fas fa-bars"></i></a>
                    </li>
                </ul>

                <!-- Right navbar links -->
                <ul class="navbar-nav ml-auto">

                    <!-- Profile Dropdown -->
                    <li class="nav-item dropdown">
                        <a class="nav-link" data-toggle="dropdown" href="#">
                            <i class="fas fa-user"></i>
                        </a>
                        <div class="dropdown-menu dropdown-menu-lg dropdown-menu-right">
                            <div class="dropdown-divider"></div>
                            <a href="#" class="dropdown-item">
                                <button class="btn font-weight-bold"><i class="fas fa-cog mr-2"></i> Account
                                    Settings
                                </button>
                            </a>
                            <div class="dropdown-divider"></div>
                            <a class="dropdown-item">
                                <button class="btn font-weight-bold" id="signout"><i class="fas fa-sign-out mr-2"></i>
                                    Logout
                                </button>
                            </a>
                        </div>
                    </li>
                </ul>
            </nav>
            <!-- /.navbar -->

            @include('admin.layouts.sidebar')

            @yield('content')

            <footer class="main-footer text-center">
                <strong class="footer-text">Copyright &copy; <a href="#" class="footer-app-name">Project
                        Management
                        System</a></strong>
                <span class="footer-text">All rights reserved.</span>
            </footer>

            <!-- Control Sidebar -->
            <aside class="control-sidebar control-sidebar-dark">
                <!-- Control sidebar content goes here -->
            </aside>
            <!-- /.control-sidebar -->
        </div>
        <!-- ./wrapper -->
        <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.19.0/jquery.validate.js"></script>
        <script src="https://cdn.datatables.net/1.10.21/js/jquery.dataTables.min.js"></script>
        <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.min.js"></script>
        <script src="{{ asset('plugins/bootstrap.bundle.min.js') }}"></script>
        <script src="{{ asset('js/adminlte.js') }}"></script>

        <script>
            $(document).ready(function() {
                $('#signout').click(function() {
                    let url = '/signout';
                    let token = $("meta[title='token']").attr('content');

                    $.ajax({
                        url: url,
                        method: 'POST',
                        headers: {
                            'X-CSRF-TOKEN': token
                        },
                        success: function(response) {
                            let message = response.message;

                            Swal.fire({
                                title: message,
                                text: '',
                                icon: 'success'
                            });

                            window.location = '/signin';
                        },
                        error: function(error) {
                            let status = error.status ?? null;

                            if (status == 500) {
                                Swal.fire({
                                    title: 'Server Error',
                                    text: message,
                                    icon: 'error'
                                });
                            }
                        }
                    });
                });
            });
        </script>
    </body>

</body>

</html>
