@extends('layouts.master-frontend')
@section('title', 'Dashboard')

@section('content')
    <div class="content-body">
        <!-- row -->
        <div class="container-fluid">
            {!! Toastr::message() !!}

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
                                    </div>
                                    <br>
                                    <br>
                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label class="head" for="">Full Name</label>
                                                <input readonly name="fullname" type="text" class="form-control"
                                                    value="{{ Auth::user()->name }}">
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <label for="">Gender</label>
                                                <input readonly name="fullname" type="text" class="form-control"
                                                    value="{{ $item->gender_name }}">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">

                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <label for="">Phone Number</label>
                                                <input readonly name="phonenumber" type="text" class="form-control"
                                                    value="{{ Auth::user()->phonenumber }}">
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <label for="">Email ID</label>
                                                <input readonly type="text" class="form-control"
                                                    value="{{ Auth::user()->email }}">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label for="">District</label>
                                                <input readonly type="text" class="form-control"
                                                    value="{{ $item->district_name }}">
                                            </div>
                                        </div>

                                    </div>
                                    <br>
                                    <h2>Business Details</h2>
                                    <div class="row">
                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <label for="">Business Name</label>
                                                <input readonly type="text" class="form-control"
                                                    value="{{ $item->business_name }}">
                                            </div>
                                        </div>

                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <label for="">Business Category</label>
                                                <input readonly type="text" class="form-control"
                                                    value="{{ $item->category_name }}">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label for="">Business Type</label>
                                            <input readonly type="text" class="form-control"
                                                value="{{ $item->business_type_name }}">
                                        </div>
                                    </div>
                                    <br>
                                    <h2>Business Documents</h2>
                                    <div class="row">
                                        <div class="col-md-4">
                                            <label for="">Business Certificate</label>
                                            <img src="{{ asset('images/business-cert/' . $item->business_certificate) }}"
                                                alt="" class="w-75">
                                        </div>
                                        <div class="col-md-4">
                                            <label for="">Tax Clearance</label>
                                            <img src="{{ asset('images/tax-cert/' . $item->tax_clearance) }}"
                                                alt="" class="w-75">
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-4">
                                            <label for="">PPDA Document</label>
                                            <img src="{{ asset('images/ppda/' . $item->ppda) }}" alt=""
                                                class="w-75">
                                        </div>
                                        <div class="col-md-4">
                                            <label for="">Other Documents</label>
                                            <embed src="{{ asset('images/other-docs/' . $item->other_docs) }}" alt=""
                                                 type="pdf">
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
