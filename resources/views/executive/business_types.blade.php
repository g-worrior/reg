@extends('layouts.master-executive')
@section('title', 'Business Types')

@section('content')
    {{-- message --}}
    {!! Toastr::message() !!}
    {{-- message --}}
    <div class="content-body">
        <div class="container-fluid">
            <div class="page-header">
                <div class="row align-items-center">
                    <div class="col">
                        <h3 class="page-title">Business Types</h3>
                        <ul class="breadcrumb">
                            <li class="breadcrumb-item"><a href="{{ url('executive/dashboard') }}">Dashboard</a></li>
                            <li class="breadcrumb-item active">Business Types</li>
                        </ul>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-header">
                            <h4 class="card-title">Business Types</h4>
                        </div>
                        <div class="card-body">
                            <div class="table-responsive">
                                <table id="example" class="display" style="min-width: 845px">
                                    <thead>
                                        <tr>
                                            <th>#</th>
                                            <th>Business Type Name</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($types as $key => $items)
                                            <tr>
                                                <td>{{ ++$key }}</td>
                                                <td class="business_type_name">{{ $items->business_type_name }}</td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- /Page Content -->
    </div>
    <!-- /Page Wrapper -->
    
    <div class="footer">
        <div class="copyright">
            <p>Copyright © Designed &amp; Developed by Maravi Commodity Traders 2022
            </p>
        </div>
    </div>

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

    {!! Toastr::message() !!}

    <script>
        $(document).ready(function() {
            $('#example').DataTable({
                dom: 'Bfrtip',
                buttons: [
                    'copy', 'csv', 'excel', 'pdf', 'print'
                ],
                language: {
                    paginate: {
                        next: '<i class="fa fa-angle-double-right" aria-hidden="true"></i>',
                        previous: '<i class="fa fa-angle-double-left" aria-hidden="true"></i>'
                    }
                }
            });
        });
    </script>


@endsection
