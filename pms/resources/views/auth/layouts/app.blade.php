<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>{{ env('APP_NAME', 'PMS') }}</title>
    <link rel="stylesheet" href="{{ asset('plugins/bootstrap4.5.3.min.css') }}">
    <link rel="stylesheet" href="{{ asset('css/auth.css') }}">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.6.0/css/all.min.css"
        integrity="sha512-Kc323vGBEqzTmouAECnVceyQqyqdsSiqLQISBL29aUW4U/M7pSPA/gEUZQqv1cwx4OnYxTxve5UMg5GT6L4JJg=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />
</head>

<body>
    @yield('content')

    <div class="footer">
        <p style="font-weight: 400">Copyright © <span class="footer-brand-name">Project Management System</span> 2024
        </p>
    </div>

    <script src="{{ asset('plugins/jquery-3.5.1.slim.min.js') }}"></script>
    <script src="{{ asset('plugins/bootstrap.bundle.min.js') }}"></script>
</body>

</html>
