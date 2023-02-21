@extends('layouts.master-frontend')
@section('title', 'Change password')


@section('content')
    <div class="content-body">
        <!-- row -->
        <div class="container-fluid">
            {!! Toastr::message() !!}

            <div class="card">
                <div class="card-head">
                    <h4>Change Password</h4>
                </div>
            <div class="card-body">

                @if (Session::has('flash_message_error'))
                    <div class="alert alert-danger alert-dismissible" role="alert">
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                        {!! Session('flash_message_error') !!}
                    </div>
                @endif

                @if (Session::has('flash_message_success'))
                    <div class="alert alert-success" role="alert">
                        {!! Session('flash_message_success') !!}
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>

                    </div>
                @endif

                <form action="{{ url('/frontend/update_password') }}" method="POST" id="change_password_form">
                    @csrf
                    <div class="form-group">
                        <label for="old_password">Old Password</label>
                        <input type="password" name="old_password" placeholder="Your current password" class="form-control" id="old_password">

                        @if ($errors->any('old_password'))
                            <span class="text-danger">{{ $errors->first('old_password') }}</span>
                        @endif
                    </div>


                    <div class="form-group">
                        <label for="new_password">New Password</label>
                        <input type="password" name="new_password" class="form-control" id="new_password">

                        @if ($errors->any('new_password'))
                            <span class="text-danger">{{ $errors->first('new_password') }}</span>
                        @endif
                    </div>


                    <div class="form-group">
                        <label for="confirm_password">Confirm Password</label>
                        <input type="password" name="confirm_password" class="form-control" id="confirm_password">

                        @if ($errors->any('confirm_password'))
                            <span class="text-danger">{{ $errors->first('confirm_password') }}</span>
                        @endif
                    </div>


                    <button id="submit" type="submit" class="btn btn-primary ">Update Password</button>
                </form>
            </div>
            </div>

        </div>
    </div>

    {{-- form validdator --}}
    <script type="javascript" src="{{ asset('js/profile.js') }}"></script>

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
