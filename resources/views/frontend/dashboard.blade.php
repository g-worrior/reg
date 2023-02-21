@extends('layouts.master-frontend')
@section('title', 'Dashboard')

@section('content')

    <div class="content-body">
        <!-- row -->
        <div class="container-fluid">

            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <h4>My Information</h4>
                    </div>
                    <div class="card-body">
                        @if ($errors->any())
                            <div class="alert alert-danger">
                                @foreach ($errors as $error)
                                    <div>{{ $error }}</div>
                                @endforeach
                            </div>

                        @endif
                        @foreach ($users as $item)
                            @if ($item->user_id == Auth::user()->id)
                                <div>
                                    <h2>Personal Details Details</h2>
                                    <div class="row">
                                        <div class="col-md-4">
                                            <label for="">Profile Photo</label>
                                            <img src="{{ asset('images/user/' . Auth::user()->profile_picture) }}"
                                                alt="" class="rounded-circle w-75  mx-auto d-block">
                                        </div>
                                    </div>
                                    <br>
                                    <div class="row">
                                        <div class="col-md-4">
                                            <a href="{{ url('/frontend/updateprofile') }}">
                                                <div class="form-group">
                                                    <label class="btn btn-primary">Edit Profile</label>
                                                </div>
                                            </a>
                                        </div>
                                        <div class="col-md-4">
                                            <a href="{{ url('/frontend/myinfo') }}">
                                                <div class="form-group">
                                                    <label class="btn btn-primary">View My Info</label>
                                                </div>
                                            </a>
                                        </div>
                                        <div class="col-md-4">
                                            <a href="{{ url('/frontend/blog') }}">
                                                <div class="form-group">
                                                    <label class="btn btn-primary">View Post </label>
                                                </div>
                                            </a>
                                        </div>
                                    </div>
                                </div>
                            @endif
                        @endforeach
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
