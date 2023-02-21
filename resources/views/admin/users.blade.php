@extends('layouts.master')
@section('title', 'User List')

@section('content')

    <div class="content-body">
        <!-- row -->
        <div class="container-fluid">
            {!! Toastr::message() !!}
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-header">
                            <h4 class="card-title">Customer Datatable</h4>
                        </div>
                        <div class="col-auto float-right ml-auto">
                            <a href="{{ url('admin/add-user') }}" class="btn add-btn"><i class="fa fa-plus"></i> Add User</a>
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
                                            <th>Role</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($users as $key => $user)
                                            <tr>
                                                <td>{{ ++$key }}</td>
                                                <td>{{ $user->name }}</td>
                                                <td>{{ $user->phonenumber }}</td>
                                                <td>{{ $user->district_name }}</td>
                                                <td>{{ $user->gender_name }}</td>
                                                <td>{{ $user->email }}</td>
                                                <td>{{ $user->role_as == '1' ? 'Admin' : 'Executive' }}</td>
                                                <td>
                                                    <div class="d-flex">
                                                        <a href="{{ url('/admin/delete-user-db/' . $user->email) }}"
                                                            class="btn btn-danger shadow btn-xs sharp"><i
                                                                class="fa fa-trash"></i></a>
                                                    </div>
                                                </td>
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
