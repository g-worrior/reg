@extends('layouts.master')
@section('title', 'Business categories')

@section('content')
    {{-- message --}}
    {!! Toastr::message() !!}
    {{-- message --}}
    <div class="content-body">
        <div class="container-fluid">
            <div class="page-header">
                <div class="row align-items-center">
                    <div class="col">
                        <h3 class="page-title">Business Categories</h3>
                        <ul class="breadcrumb">
                            <li class="breadcrumb-item"><a href="{{ url('admin/dashboard') }}">Dashboard</a></li>
                            <li class="breadcrumb-item active">Business Categories</li>
                        </ul>
                    </div>
                    <div class="col-auto float-right ml-auto">
                        <a href="#" class="btn add-btn" data-toggle="modal" data-target="#add_type"><i
                                class="fa fa-plus"></i> Add Business Category</a>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-header">
                            <h4 class="card-title">Business Categories</h4>
                        </div>
                        <div class="card-body">
                            <div class="table-responsive">
                                <table id="example" class="display" style="min-width: 845px">
                                    <thead>
                                        <tr>
                                            <th>#</th>
                                            <td hidden>ID</td>
                                            <th>Category Name</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($categories as $key => $items)
                                            <tr>
                                                <td>{{ ++$key }}</td>
                                                <td hidden class="e_id"> {{ $items->id }}</td>
                                                <td class="category_name">{{ $items->category_name }}</td>
                                                <td>
                                                    <div class="dropdown dropdown-action">
                                                        <a href="#" class="action-icon dropdown-toggle"
                                                            data-toggle="dropdown" aria-expanded="false"><i
                                                                class="material-icons">more_vert</i></a>
                                                        <div class="dropdown-menu dropdown-menu-right">
                                                            <a class="dropdown-item edit_type " href="#"
                                                                data-toggle="modal" data-target="#edit_type"><i
                                                                    class="fa fa-pencil m-r-5"></i> Edit</a>
                                                            <a class="dropdown-item delete_type" href="#"
                                                                data-toggle="modal" data-target="#delete_type"><i
                                                                    class="fa fa-trash-o m-r-5"></i> Delete</a>
                                                        </div>
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

                <!-- category Modal -->
                <div id="add_type" class="modal custom-modal fade" role="dialog">
                    <div class="modal-dialog modal-dialog-centered" role="document">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title">Add New Category</h5>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                            <div class="modal-body">
                                <form action="{{ url('admin/categorysave') }}" method="POST">
                                    @csrf
                                    <div class="form-group">
                                        <label>category Name <span class="text-danger">*</span></label>
                                        <input class="form-control" type="text" id="type" name="category_name">
                                    </div>
                                    <div class="submit-section">
                                        <button type="submit" class="btn btn-primary submit-btn">Submit</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- /Add category Modal -->

                <!-- Edit category Modal -->
                <div id="edit_type" class="modal custom-modal fade" role="dialog">
                    <div class="modal-dialog modal-dialog-centered" role="document">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title">Edit Category</h5>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                            <div class="modal-body">
                                <form action="{{ url('admin/categoryupdate') }}" method="POST">
                                    @csrf
                                    <input type="hidden" class="form-control" id="e_id" name="id" value="">
                                    <div class="form-group">
                                        <label>Category Name<span class="text-danger">*</span></label>
                                        <input class="form-control" type="text" id="e_category_name" name="category_name"
                                            value="">
                                    </div>
                                    <div class="submit-section">
                                        <button type="submit" class="btn btn-primary submit-btn">Save</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- /Edit category Modal -->

                <!-- Delete category Modal -->
                <div class="modal custom-modal fade" id="delete_type" role="dialog">
                    <div class="modal-dialog modal-dialog-centered">
                        <div class="modal-content">
                            <div class="modal-body">
                                <div class="form-header">
                                    <h3>Delete Category</h3>
                                    <p>Are you sure want to delete?</p>
                                </div>
                                <div class="modal-btn delete-action">
                                    <form action="{{ url('admin/categorydelete') }}" method="POST">
                                        @csrf
                                        <input type="hidden" name="id" class="e_id" value="">
                                        <div class="row">
                                            <div class="col-6">
                                                <button type="submit"
                                                    class="btn btn-primary continue-btn submit-btn">Delete</button>
                                            </div>
                                            <div class="col-6">
                                                <a data-dismiss="modal" class="btn btn-primary cancel-btn">Cancel</a>
                                            </div>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- /Delete category Modal -->
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
    
    {{-- edit model --}}
    <script>
        $(document).on('click', '.edit_type', function() {
            var _this = $(this).parents('tr');
            $('#e_id').val(_this.find('.e_id').text());
            $('#e_category_name').val(_this.find('.category_name').text());
        });
    </script>
    {{-- delete model --}}
     <script>
        $(document).on('click','.delete_type',function()
        {
            var _this = $(this).parents('tr');
            $('.e_id').val(_this.find('.e_id').text());
        });
    </script>





@endsection
