@extends('layouts.master')
@section('title', 'Admin Dashboard')

@section('content')

    <div class="content-body">
        <!-- row -->
        <div class="container-fluid">
            {!! Toastr::message() !!}
            <form action="{{ url('admin/add-user-db') }}" method="POST" enctype="multipart/form-data">
                @csrf

                <h2 style="text-align: center">Add User</h2>
                <br>
                <div class="row">
                    <div class="col-md-4">
                        <div class="form-group">
                            <label for="">Full Name</label>
                            <input name="fullname" type="text" class="form-control">
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group">
                            <label for="">Phone Number</label>
                            <input name="phonenumber" type="text" class="form-control">
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group">
                            <label for="">Email ID</label>
                            <input name="email" type="email" class="form-control">
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-4">
                        <div class="form-group">
                            <label for="">Gender</label>
                            <select class="form-select" name="gender_id" id="gender_id">
                                <option value="">Select Gender</option>
                                @foreach ($gender as $gender)
                                    <option value="{{ $gender->id }}">{{ $gender->gender_name }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group">
                            <label for="">District</label>
                            <select class="form-select" name="district_id" id="district_id">
                                <option value="">Select district</option>
                                @foreach ($district as $district)
                                    <option value="{{ $district->id }}">{{ $district->district_name }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group">
                            <label for="">User Role</label>
                            <select class="form-select" name="role" id="role">
                                <option value="">Select Role</option>
                                <option value="1">Admin</option>
                                <option value="2">Executive</option>
                            </select>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-4">
                        <div class="form-group">
                            <label for="">Password</label>
                            <input name="password" type="password" class="form-control">
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group">
                            <label for="">Confirm Password</label>
                            <input name="password_confirmation" type="password" class="form-control">
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-4">
                        <label for="">Profile Photo</label>
                        <input type="file" name="profile_picture" class="form-control" accept="jpg,png,jpeg">
                    </div>
                </div>
                <br>
                    <div class="col-md-4">
                        <div class="form-group">
                            <button type="submit" class="btn btn-primary">Add User</button>
                        </div>
                    </div>
            </form>
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
