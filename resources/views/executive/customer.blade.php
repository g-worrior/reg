@extends('layouts.master-executive')
@section('title', 'Members')
@section('content')

    <div class="content-body">
        <div class="container-fluid">

            <div class="row page-titles">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item active"><a href="javascript:void(0)">Members</a></li>
                    <li class="breadcrumb-item"><a href="javascript:void(0)">Datatable</a></li>
                </ol>
            </div>
            <!-- row -->


            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-header">
                            <h4 class="card-title">Members Datatable</h4>
                        </div>
                        <div class="card-body">
                            <div class="table-responsive">
                                <table id="example3" class="display" style="min-width: 845px">
                                    <thead>
                                        <tr>
                                            <th>#</th>
                                            {{-- <th>Profile</th> --}}
                                            <th>Full Name</th>
                                            <th>Phone Number</th>
                                            <th>District</th>
                                            <th>Gender</th>
                                            <th>Email</th>
                                            <th>Joining Date</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($users as $key => $user)
                                            <tr>
                                                <td>{{ ++$key }}</td>
                                                {{-- <td><img class="rounded-circle" width="35"
                                                        src="{{ asset('images/user/' . $user->profile_picture) }}"
                                                        alt=""></td> --}}
                                                <td>{{ $user->name }}</td>
                                                <td>{{ $user->phonenumber }}</td>
                                                <td>{{ $user->district_name }}</td>
                                                <td>{{ $user->gender_name }}</td>
                                                <td><a href="javascript:void(0);"> {{ $user->email }}</a></td>
                                                <td>{{ $user->created_at }}</td>
                                                <td><a href="{{ url('/executive/member_details/'.$user->user_id) }}" 
                                                    class="btn btn-primary shadow btn-xs sharp me-1">
                                                    <i
                                                    class="fas fa-pencil-alt"></i>
                                                    </a>
                                                </td>
                                                {{-- <td hidden>
                                                    <div class="d-flex">
                                                        <a href="#"
                                                            class="btn btn-primary shadow btn-xs sharp me-1"><i
                                                                class="fas fa-pencil-alt"></i></a>
                                                        <a href="#" class="btn btn-danger shadow btn-xs sharp"><i
                                                                class="fa fa-trash"></i></a>
                                                    </div>
                                                </td> --}}
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-12">
                    <div class="card">
                        <div class="card-header">
                            <h4 class="card-title">Subscription Table</h4>
                        </div>
                        <div class="card-body">
                            <div class="table-responsive">
                                <table id="example4" class="display" style="min-width: 845px">
                                    <thead>
                                        <tr>
                                            <th>#</th>
                                            <th>Fullname</th>
                                            <th>Bussiness Name</th>
                                            <th>Business Type </th>
                                            <th>Subscription Trans ID </th>
                                            <th>Subscription Start Date</th>
                                            <th>Subscription End Date</th>
                                            <th>Status </th>
                                        </tr>
                                    </thead>
                                    @foreach ($subscriptions as $key => $item)
                                        <tbody>
                                            <tr>
                                                <td>{{ ++$key }}</td>
                                                <td>{{ $item->fullname }}</td>
                                                <td>{{ $item->business_name }}</td>
                                                <td>{{ $item->business_type }}</td>
                                                <td>{{ $item->subscription_trans_id }}</td>
                                                <td>{{ $item->subscription_start_date }}</td>
                                                <td>{{ $item->subscription_end_date }}</td>
                                                @if ($item->state == active)
                                                    <td><span class="badge light badge-success">{{ $item->state }}</span>
                                                    </td>
                                                @else
                                                    <td><span class="badge light badge-danger">{{ $item->state }}</span>
                                                    </td>
                                                @endif
                                            </tr>
                                        </tbody>
                                    @endforeach
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
                </table>
            </div>
        </div>
    </div>

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
            $('#example3').DataTable({
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
    <script>
        $(document).ready(function() {
            $('#example4').DataTable({
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
