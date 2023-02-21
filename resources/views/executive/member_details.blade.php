@extends('layouts.master-executive')
@section('title', 'Member Profile')

@section('content')

    <div class="content-body">
        <!-- row -->
        <div class="container-fluid">

            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <h3>User Information</h3>
                    </div>
                    <div class="card-body">
                        @foreach ($users as $item)
                            @if ($item->user_id == $user_id)
                                <form>
                                    @csrf
                                    
                                    <br>
                                    <h2>Personal Details Details</h2>
                                    <div class="row">
                                        <div class="col-md-4">
                                            <label for="">Profile Photo</label>
                                            <img src="{{ asset('images/user/' . $item->profile_picture) }}"
                                                alt="" class="rounded-circle w-75  mx-auto d-block">
                                            {{-- <input type="file" name="profile_picture" class="form-control"
                                                accept="image/png,jpeg"> --}}
                                            <br>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <label for="">Full Name</label>
                                                <input readonly name="fullname" type="text" class="form-control"
                                                    value="{{ $item->name }}">
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <label for="">Gender</label>
                                                <input readonly class="form-control" name="gender_id" id="gender_id"
                                                    value={{ $item->gender_name }}>
                                            </div>
                                        </div>

                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <label for="">Phone Number</label>
                                                <input readonly name="phonenumber" type="text" class="form-control"
                                                    value="{{ $item->phonenumber }}">
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <label for="">Email ID</label>
                                                <input readonly type="text" class="form-control"
                                                    value="{{ $item->email }}">
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <label for="">District</label>
                                                <input readonly class="form-control" name="district_id" id="district_id"
                                                    value={{ $item->district_name }}>
                                            </div>
                                        </div>
                                    </div>
                                    <br>
                                    <h2>Business Details</h2>
                                    <div class="row">
                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <label for="">Business Name</label>
                                                <input readonly name="business_name" type="text"  class="form-control"
                                                    value="{{ $item->business_name }}">
                                            </div>
                                        </div>

                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <label for="">Business Category</label>
                                                <input readonly class="form-control" name="category_id" id="category_id"
                                                    value={{ $item->category_name}}>
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <label for="">Business Type</label>
                                                <input readonly class="form-control" name="business_type_id" id="business_type_id"
                                                    value={{ $item->business_type_name }}>
                                            </div>
                                        </div>
                                    </div>
                                    
                                    <br>
                                    <h2>Business Documents</h2>
                                    <div class="row">
                                        <div class="col-md-4">
                                            <label for="">Business Certificate</label>
                                            <img src="{{ asset('images/business-cert/' . $item->business_certificate) }}"
                                                alt="" class="w-75">
                                            {{-- <input type="file" name="certificate" class="form-control"
                                                accept="png,jpeg,pdf,jpg"> --}}
                                        </div>
                                        <div class="col-md-4">
                                            <label for="">Tax Clearance</label>
                                            <img src="{{ asset('images/tax-cert/' . $item->tax_clearance) }}"
                                                alt="" class="w-75">
                                            {{-- <input type="file" name="tax" class="form-control"
                                                accept="png,jpeg,pdf,jpg"> --}}
                                        </div>
                                    </div>
                                    <br>
                                    <div class="row">
                                        <div class="col-md-4">
                                            <label for="">PPDA Certificate File</label>
                                            <img src="{{ asset('images/ppda/' . $item->ppda) }}" alt=""
                                                class="w-75">
                                            {{-- <input type="file" name="ppda" class="form-control"
                                                accept="png,jpeg,pdf,jpg"> --}}
                                        </div>
                                        <div class="col-md-4">
                                            <label for="">Other Documents</label>
                                            <img src="{{ asset('images/other-docs/' . $item->other_docs) }}"
                                                alt="" class="w-75">
                                            {{-- <input type="file" name="otherdocs" class="form-control"
                                                accept="png,jpeg,pdf,jpg"> --}}
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

    <script src="{{ asset('auth/vendor/jquery-nice-input/js/jquery.nice-input.min.js') }}"></script>

    <script src="{{ asset('auth/js/custom.min.js') }}"></script>
    <script src="{{ asset('auth/js/dlabnav-init.js') }}"></script>
    <script src="{{ asset('auth/js/demo.js') }}"></script>
    <script src="{{ asset('auth/js/styleSwitcher.js') }}"></script>
@endsection
