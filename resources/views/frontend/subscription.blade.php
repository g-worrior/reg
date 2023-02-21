@extends('layouts.master-frontend')
@section('title', 'Billing')

@section('content')

    <div class="content-body">
        <!-- row -->
        <div class="container-fluid">
            {!! Toastr::message() !!}

            <div class="container">
                <h2 class="text-center">- Pay Through the following methods -</h2>
                <br>
                <div class="row">
                    <div class="col-sm">
                        <a href="">
                            <img src="{{ asset('images/subscription/airtel-logo.jpg') }}" width="100" height="100"
                                class="img-thumbnail" alt="Responsive image">
                        </a>
                    </div>
                    <div class="col-sm">
                        <a href="">
                            <img src="{{ asset('images/subscription/tnm-logo.png') }}" width="100" height="100"
                                class="img-fluid" alt="Responsive image">
                            </a>
                    </div>
                    <div class="col-sm">
                        <a href="">
                            <img src="{{ asset('images/subscription/unnamed.png') }}" width="100" height="100"
                                class="img-fluid" alt="Responsive image">
                        </a>
                    </div>
                </div>
            </div>

        </div>
    </div>
    <!-- Required vendors -->
    <script src="{{ asset('auth/vendor/global/global.min.js') }}"></script>
    <script src="{{ asset('auth/vendor/chart.js/Chart.bundle.min.js') }}"></script>
    <!-- Apex Chart -->
    <script src="{{ asset('auth/vendor/apexchart/apexchart.js') }}"></script>

    <!-- Datatable -->
    <script src="{{ asset('auth/vendor/datatables/js/jquery.dataTables.min.js') }}"></script>
    <script src="{{ asset('auth/js/plugins-init/datatables.init.js') }}"></script>

    <script src="{{ asset('auth/vendor/jquery-nice-select/js/jquery.nice-select.min.js') }}"></script>

    <script src="{{ asset('auth/js/custom.min.js') }}"></script>
    <script src="{{ asset('auth/js/dlabnav-init.js') }}"></script>
    <script src="{{ asset('auth/js/demo.js') }}"></script>
    <script src="{{ asset('auth/js/styleSwitcher.js') }}"></script>
@endsection
