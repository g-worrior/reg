@extends('layouts.master')
@section('title', 'Change password')
@include('layouts.inc.frontend-navbar')


@section('content')
    <div class="card">
        <div class="card-head">
            <h4>Change Password</h4>
        </div>
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

        <form action="{{ url('/profile/update_password') }}" method="POST" id="change_password_form">
            @csrf
            <div class="form-group">
                <label for="old_password">Old Password</label>
                <input type="password" name="old_password" class="form-control" id="old_password">

                @if ($errors->any('old_password'))
                    <span class="text-danger">{{ $errors->first('old_password') }}</span>
                @endif
            </div>


            <div class="form-group">
                <label for="new_password">Confirm Password</label>
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

    <script type="javascript" src="{{ asset('js/profile.js') }}"></script>
@endsection
