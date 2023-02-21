<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="keywords" content="admin, dashboard">
    <meta name="author" content="Ohalha">
    <meta name="robots" content="index, follow">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta property="og:image" content="https://dompet.dexignlab.com/xhtml/social-image.png">
    <meta name="format-detection" content="telephone=no">

    <!-- PAGE TITLE HERE -->
    <title>@yield('title')</title>

    <!-- Main CSS -->
    <link rel="stylesheet" href="{{ URL::to('assets/css/style.css') }}">
    {{-- message toastr --}}
    <link rel="stylesheet" href="{{ URL::to('assets/css/toastr.min.css') }}">


    <!-- Select2 CSS -->
    <link rel="stylesheet" href="{{ URL::to('assets/css/select2.min.css') }}">
    <!-- Favicon -->
    <link rel="shortcut icon" type="image/x-icon" href="{{ URL::to('assets/img/favicon.png') }}">
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="{{ URL::to('assets/css/bootstrap.min.css') }}">
    <!-- Fontawesome CSS -->
    <link rel="stylesheet" href="{{ URL::to('assets/css/font-awesome.min.css') }}">
    <!-- Lineawesome CSS -->
    <link rel="stylesheet" href="{{ URL::to('assets/css/line-awesome.min.css') }}">
    <!-- Select2 CSS -->
    <link rel="stylesheet" href="{{ URL::to('assets/css/select2.min.css') }}">
    <!-- Datetimepicker CSS -->
    <link rel="stylesheet" href="{{ URL::to('assets/css/bootstrap-datetimepicker.min.css') }}">
    <!-- Chart CSS -->
    <link rel="stylesheet" href="{{ URL::to('ssets/plugins/morris/morris.css') }}">




    <!-- FAVICONS ICON -->
    <link rel="shortcut icon" type="image/png" href="{{ asset('auth/images/favicon.png') }}">

    <link href="{{ asset('auth/vendor/jquery-nice-select/css/nice-select.css') }}" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('auth/vendor/nouislider/nouislider.min.css') }}">

    <!-- Style css -->
    <link href="{{ asset('auth/css/style.css') }}" rel="stylesheet">


    {{-- dataTables css --}}
    <link rel="stylesheet" href="{{ asset('auth/css/jquery.datatables.min.css') }}">
    <link rel="stylesheet" href="{{ asset('auth/css/buttons.dataTables.min.css') }}">

    {{-- message toastr --}}
    <link rel="stylesheet" href="{{ asset('auth/css/toastr.min.css') }}">




</head>


<!--*******************
        Preloader start
    ********************-->
<div id="preloader">
    <div class="waviy">
        <span style="--i:1">L</span>
        <span style="--i:2">o</span>
        <span style="--i:3">a</span>
        <span style="--i:4">d</span>
        <span style="--i:5">i</span>
        <span style="--i:6">n</span>
        <span style="--i:7">g</span>
        <span style="--i:8">.</span>
        <span style="--i:9">.</span>
        <span style="--i:10">.</span>
    </div>
</div>
<!--*******************
        Preloader end
    ********************-->

<!--**********************************
        Main wrapper start
    ***********************************-->
<div id="main-wrapper">
    @include('layouts.inc.frontend-navbar')
    @include('layouts.inc.frontend-sidebar')
    @yield('content')
    @include('layouts.inc.footer')
</div>
<!--**********************************
    Main wrapper end
***********************************-->

<body>

    {{-- charts --}}
    <script src="{{ asset('js/chart.min.js') }}"></script>
    <script src="{{ asset('js/mychart.js') }}"></script>

    <!-- jQuery -->
    <script src="{{ URL::to('assets/js/jquery-3.5.1.min.js') }}"></script>
    <!-- Bootstrap Core JS -->
    <script src="{{ URL::to('assets/js/popper.min.js') }}"></script>
    <script src="{{ URL::to('assets/js/bootstrap.min.js') }}"></script>

    <!-- Required vendors -->
    <script src="{{ asset('auth/vendor/global/global.min.js') }}"></script>
    <script src="{{ asset('auth/vendor/chart.js/Chart.bundle.min.js') }}"></script>
    <script src="{{ asset('auth/vendor/jquery-nice-select/js/jquery.nice-select.min.js') }}"></script>

    <!-- Apex Chart -->
    <script src="{{ asset('auth/vendor/apexchart/apexchart.js') }}"></script>
    <script src="{{ asset('auth/vendor/nouislider/nouislider.min.js') }}"></script>
    <script src="{{ asset('auth/vendor/wnumb/wNumb.js') }}"></script>

    <script src="{{ asset('auth/js/custom.min.js') }}"></script>
    <script src="{{ asset('auth/js/dlabnav-init.js') }}"></script>
    <script src="{{ asset('auth/js/demo.js') }}"></script>
    <script src="{{ asset('auth/js/styleSwitcher.js') }}"></script>

    <!-- Required vendors -->
    <script src="{{ asset('auth/vendor/global/global.min.js') }}"></script>
    <script src="{{ asset('auth/vendor/chart.js/Chart.bundle.min.js') }}"></script>
    <!-- Apex Chart -->
    <script src="{{ asset('auth/vendor/apexchart/apexchart.js') }}"></script>

    {{-- export --}}
    <script src="{{ asset('auth/js/jquery.dataTables.min.js') }}"></script>
    <script src="{{ asset('auth/js/dataTables.buttons.min.js') }}"></script>
    <script src="{{ asset('auth/js/jszip.min.js') }}"></script>
    <script src="{{ asset('auth/js/pdfmake.min.js') }}"></script>
    <script src="{{ asset('auth/js/vfs_fonts.js') }}"></script>
    <script src="{{ asset('auth/js/buttons.html5.min.js') }}"></script>
    <script src="{{ asset('auth/js/buttons.print.min.js') }}"></script>


    <script src="{{ asset('auth/js/custom.min.js') }}"></script>
    <script src="{{ asset('auth/js/dlabnav-init.js') }}"></script>
    <script src="{{ asset('auth/js/demo.js') }}"></script>
    <script src="{{ asset('auth/js/styleSwitcher.js') }}"></script>

    {{-- toastr --}}
    <script src="{{ asset('auth/js/toastr.min.js') }}"></script>

    {!! Toastr::message() !!}

</body>

</html>
