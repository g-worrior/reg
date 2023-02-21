@extends('layouts.master-frontend')
@section('title', 'Update Profile')

@section('content')

    <div class="content-body">
        <!-- row -->
        <div class="container-fluid">

            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <h3>My Information</h3>
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
                                <form action="{{ url('frontend/my-profile-update') }}" method="POST"
                                    enctype="multipart/form-data">
                                    @csrf
                                    <div class="col-md-4">
                                        <h5 style="color: red">Fields with * are read only!!</h5>
                                        <label for="">Profile Photo</label>
                                        <img src="{{ asset('images/user/' . Auth::user()->profile_picture) }}"
                                            alt="" class="rounded-circle w-75  mx-auto d-block">
                                        <input type="file" name="profile_picture" class="form-control"
                                            accept="image/png,jpeg">
                                        <br>
                                    </div>
                                    <br>
                                    <h2>Personal Details Details</h2>
                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label for="">Full Name</label>
                                                <input name="fullname" type="text" class="form-control"
                                                    value="{{ Auth::user()->name }}">
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <label for="">Gender <span style="color: red">*</span> </label>
                                                <input readonly type="text" class="form-control"
                                                    value="{{ $item->gender_name }}">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">

                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <label for="">Phone Number</label>
                                                <input name="phonenumber" type="text" class="form-control"
                                                    value="{{ Auth::user()->phonenumber }}">
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <label for="">Email ID<span style="color: red">*</span></label>
                                                <input readonly type="text" class="form-control"
                                                    value="{{ Auth::user()->email }}">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <label for="">District</label>
                                                <select class="form-select" name="district_id" id="district_id">
                                                    <option value="">{{ $item->district_name }}</option>
                                                    @foreach ($district as $district)
                                                        <option value="{{ $district->id }}">{{ $district->district_name }}
                                                        </option>
                                                    @endforeach
                                                </select>
                                            </div>
                                        </div>

                                    </div>
                                    <br>
                                    <h2>Business Details</h2>
                                    <div class="row">
                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <label for="">Business Name</label>
                                                <input name="business_name" type="text" class="form-control"
                                                    value="{{ $item->business_name }}">
                                            </div>
                                        </div>

                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <label for="">Business Category</label>
                                                <select class="form-select" name="category_id" id="category_id">
                                                    <option value="">{{ $item->category_name }}</option>
                                                    @foreach ($categories as $category)
                                                        <option value="{{ $category->id }}">{{ $category->category_name }}
                                                        </option>
                                                    @endforeach
                                                </select>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                                <label for="">Business Type</label>
                                                <select class="form-select" name="business_type_id" id="business_type_id">
                                                    <option value="">{{ $item->business_type_name }}</option>
                                                    @foreach ($business_types as $business_types)
                                                        <option value="{{ $business_types->id }}">{{ $business_types->business_type_name }}
                                                        </option>
                                                    @endforeach
                                                </select>
                                            </div>
                                    </div>
                                    <br>
                                    <h2>Business Documents</h2>
                                    <div class="row">
                                        <div class="col-md-4">
                                            <label for="">Business Certificate</label>
                                            <img src="{{ asset('images/business-cert/' . $item->business_certificate) }}"
                                                alt="" class="w-75">
                                            <input type="file" name="certificate" class="form-control"
                                                accept="png,jpeg,pdf,jpg">
                                        </div>
                                        <div class="col-md-4">
                                            <label for="">Tax Clearance</label>
                                            <img src="{{ asset('images/tax-cert/' . $item->tax_clearance) }}"
                                                alt="" class="w-75">
                                            <input type="file" name="tax" class="form-control"
                                                accept="png,jpeg,pdf,jpg">
                                        </div>
                                    </div>
                                    <br>
                                    <div class="row">
                                        <div class="col-md-4">
                                            <label for="">PPDA Certificate File</label>
                                            <img src="{{ asset('images/ppda/' . $item->ppda) }}" alt=""
                                                class="w-75">
                                            <input type="file" name="ppda" class="form-control"
                                                accept="png,jpeg,pdf,jpg">
                                        </div>
                                        <div class="col-md-4">
                                            <label for="">Other Documents</label>
                                            <img src="{{ asset('images/other-docs/' . $item->other_docs) }}"
                                                alt="" class="w-75">
                                            <input type="file" name="otherdocs" class="form-control"
                                                accept="png,jpeg,pdf,jpg">
                                        </div>
                                    </div>


                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <br>
                                            <button type="submit" class="btn btn-primary">Update profile</button>
                                        </div>
                                    </div>

                                </form>
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
