<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Registration</title>

    {{-- styles --}}
    <link rel="stylesheet" type="text/css" href="{{ 'css/signup.css' }}">

</head>

<body>
    <div id="page" class="site">
        <div class="container">
            <div class="form-box">
                <div class="progress">
                    <div class="logo"><a href="{{ url('login') }}"><span>.Maravi</span>Design</a></div>
                    <ul class="progress-steps">
                        <li class="step active">
                            <span>1</span>
                            <p>Personal<br><span>25 secs to complete</span></p>
                        </li>
                        <li class="step">
                            <span>2</span>
                            <p>Security<br><span>60 secs to complete</span></p>
                        </li>
                        <li class="step">
                            <span>3</span>
                            <p>Business<br><span>30 secs to complete</span></p>
                        </li>
                    </ul>
                </div>

                @if (Session::has('success'))
                    <div class="alert alert-danger alert-dismissible" role="alert">
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                        {!! Session('success') !!}
                    </div>
                @endif

                @if (Session::has('error'))
                    <div class="alert alert-success" role="alert">
                        {!! Session('error') !!}
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>

                    </div>
                @endif

                <form action="{{ route('register') }}" method="POST" enctype="multipart/form-data" id="form">
                    @if (Session::has('success'))
                        <div class="alert alert-success">{{ Session::get('success') }}</div>
                    @endif

                    @if (Session::has('fail'))
                        <div class="alert alert-danger">{{ Session::get('fail') }}</div>
                    @endif

                    @csrf
                    <div class="form-one form-step active">
                        <div class="bg-svg"></div>
                        <h2>Personal Information</h2>
                        <p>Enter your personal information correctly</p>
                        <div class="form-group required">
                            <label class="col-md-2 control-label">Full Name</label>
                            <span class="text-danger">
                                @error('fullname')
                                    {{ $message }}
                                @enderror
                            </span>
                            <input class="form-control" type="text" placeholder="e.g John Doe" required name="fullname" id="fullname" value="{{old('fullname')}}">
                        </div>
                        <div class="form-group required">
                            <label class="col-md-2 control-label">Phone Number</label>
                            <span class="text-danger">
                                @error('phonenumber')
                                    {{ $message }}
                                @enderror
                            </span>
                            
                            <input  class="form-control" type="tel" placeholder="099..." required name="phonenumber" id="phonenumber" value="{{old('phonenumber')}}">
                        </div>
                        <div class="form-group required">
                            <label class="col-md-2 control-label">Gender</label>
                            <span class="text-danger">
                                @error('gender_id')
                                    {{ $message }}
                                @enderror
                            </span>
                            <select class="form-select" name="gender_id" id="gender_id">
                                <option value="">Please Select Your gender</option>
                                @foreach ($gender as $gender)
                                    <option value="{{$gender->id}}">{{$gender->gender_name}}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group required">
                            <label class="col-md-2 control-label">District</label>
                            <span class="text-danger">
                                @error('district_id')
                                    {{ $message }}
                                @enderror
                            </span>
                            <select class="form-select" name="district_id" id="district_id" required>
                                <option value="">Please Select Your District</option>
                                @foreach ($district as $district)
                                    <option value="{{$district->id}}">{{$district->district_name}}</option>
                                @endforeach
                            </select>
                        </div>
                        <div>
                            <label class="form-label">Profile Picture</label>
                            <span class="text-danger">
                                @error('profile')
                                    {{ $message }}
                                @enderror
                            </span>
                            <input class="form-control" type="file" id="profile" name="profile" id="profile" accept=".jpeg,.png,.jpg">
                        </div>

                    </div>
                    <div class="form-two form-step">
                        <div class="bg-svg"></div>
                        <h2>Security</h2>
                        <div class="form-group required">
                            <label class="col-md-2 control-label">Email</label>
                            <span class="text-danger">
                                @error('email')
                                    {{ $message }}
                                @enderror
                            </span>
                            <input  class="form-control" type="email" required placeholder="Your email address" name="email" id="email" value="{{old('email')}}">
                        </div>
                        <div class="form-group required">
                            <label class="col-md-2 control-label">Password</label>
                            <span class="text-danger">
                                @error('password')
                                    {{ $message }}
                                @enderror
                            </span>
                            <input class="form-control" type="password" placeholder="Password" id="password" name="password" value="{{old('password')}}">
                        </div>
                        <div class="form-group required">
                            <label class="col-md-2 control-label">Confirm Password</label>
                            <span class="text-danger">
                                @error('password_confirmation')
                                    {{ $message }}
                                @enderror
                            </span>
                            <input class="form-control" type="password" required placeholder="Confirm Password" id="password_confirmation" name="password_confirmation" value="{{old('password_confirmation')}}">
                        </div>
                    </div>
                    <div class="form-three form-step">
                        <div class="bg-svg"></div>
                        <h2>Business Information</h2>
                        <div class="form-group required">
                            <label class="col-md-2 control-label">Business Name</label>
                            <span class="text-danger">
                                @error('business_name')
                                    {{ $message }}
                                @enderror
                            </span>
                            <input class="form-control" type="text" required placeholder="Business Name" id="business_name" name="business_name" value="{{old('business_name')}}">
                        </div>
                        <div class="form-group required">
                            <label class="col-md-2 control-label">Business Type</label>
                            <span class="text-danger">
                                @error('business_type_id')
                                    {{ $message }}
                                @enderror
                            </span>
                            <select class="form-select" required name="business_type_id" id="business_type_id">
                                <option value="">Choose Business type</option>
                                @foreach ($business_type as $item)
                                    <option value='{{$item->id}}'>{{ $item->business_type_name }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group required">
                            <label class="col-md-2 control-label">Business Category</label>
                            <span class="text-danger">
                                @error('category_id')
                                    {{ $message }}
                                @enderror
                            </span>
                            <select class="form-select" required name="category_id" id="category_id">
                                <option value="">Please Select Category</option>
                                @foreach ($category as $category)
                                    <option value="{{$category->id}}">{{$category->category_name}}</option>                                    
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group required">
                            <label class="col-md-2 control-label">Tax Clearance</label>
                            <span class="text-danger">
                                @error('tax')
                                    {{ $message }}
                                @enderror
                            </span>
                            <input class="form-control" required type="file" name="tax" id="tax" accept=".jpeg,.png,.jpg,.pdf" {{old('tax')}}>
                        </div>
                        <div class="form-group required">
                            <label class="col-md-2 control-label">Business Certificate</label>
                            <span class="text-danger">
                                @error('certificate')
                                    {{ $message }}
                                @enderror
                            </span>
                            <input class="form-control" required type="file" name="certificate" accept=".jpeg,.png,.jpg,.pdf" id="certificate" value="{{old('certificate')}}">
                        </div>
                        <div>
                            <label class="form-label">PPDA</label>
                            <span class="text-danger">
                                @error('ppda')
                                    {{ $message }}
                                @enderror
                            </span>
                            <input class="form-control" type="file" id="ppda" name="ppda" value="{{old('ppda')}}">
                        </div>
                        <div>
                            <label class="form-label">Other Document</label>
                            <span class="text-danger">
                                @error('otherdocs')
                                    {{ $message }}
                                @enderror
                            </span>
                            <input class="form-control" type="file" id="otherdocs" name="otherdocs" accept=".jpeg,.png,.jpg,.pdf" value="{{old('otherdocs')}}">
                        </div>

                        <div class="checkbox">
                            <input type="checkbox" id="myCheck" name="remember" required>
                            <label class="form-check-label" for="myCheck">I Agree to the Terms and Conditions</label>
                        </div>
                    </div>
                    <div class="btn-group">
                        <button type="button" class="btn-prev" disabled>Back</button>
                        <button type="button" class="btn-next">Next Step</button>
                        <button type="submit" class="btn-submit">Register</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <script src="{{ asset('js/script.js') }}"></script>
    <script src="{{ asset('js/register-form-validate.js') }}"></script>
</body>

</html>
