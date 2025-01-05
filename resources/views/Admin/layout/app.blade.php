<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Dashboard</title>
    <link rel="stylesheet" href="{{asset('dashboard/css/bootstrap.min.css')}}">
    <link rel="stylesheet" href="{{asset('dashboard/css/style.css')}}">
    <link rel="stylesheet" href="{{asset('dashboard/fontawesome/css/all.min.css')}}">
    <link href="https://fonts.googleapis.com/css?family=Nunito:200,300,400,600,700,800,900" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

</head>

<body>
    @include('Admin.include.sidebar')
    
    <div class="content" id="content">
        @include('Admin.include.navbar')

        @yield('content')
    </div>
    <script src="{{asset('dashboard/js/bootstrap.bundle.min.js')}}"></script>
    <script src="{{asset('dashboard/js/script.js')}}"></script>
    <script src="{{asset('dashboard/vendor/jquery/jquery.slim.js')}}"></script>
    <script src="{{asset('dashboard/vendor/jquery/jquery.slim.min.js')}}"></script>
</body>

</html>