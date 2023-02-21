@extends('layouts.master')
@section('title', 'View Post')

@section('content')
<div class="content-body">
    <div class="container-fluid">

    <div class="container">
        <div class="row">
            <div class="col-12 pt-2">
                <a href="{{ url()->previous() }}" class="btn btn-outline-primary btn-sm">Go back</a>
                <div class="border rounded mt-5 pl-4 pr-4 pt-4 pb-4">
                    <h3 class="display-4">View Post</h3>
                    <hr>                         
                        <div class="row">
                            @foreach ($post as $post)
                            <p> <span class="font-weight-bold">Post created on: </span> {{  date('F d, Y', strtotime($post->created_at))  }} <span class="font-weight-bold">at</span> {{ date('g:ia', strtotime($post->created_at)) }} <span class="font-weight-bold">by</span> {{ $post->name }}</p>
                           
                            <div class="control-group col-12">
                                <h3>
                                    <p class="title" >{{ $post->title }}</p>
                                </h3>                
                            </div>
                            <div class="pt-4 border-bottom-1 pb-3">
                                <p class="body">{{ $post->body }}</p>
                            </div>                                
                            
                        </div>                         
                </div>

            </div>
            <div>
                @comments(['model' => $post])
            </div>
            @endforeach
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