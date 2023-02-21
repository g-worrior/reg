<!DOCTYPE html>
<html>

<head>
    <title>Login</title>
    <link rel="stylesheet" type="text/css" href="css/login.css">
    <link href="https://fonts.googleapis.com/css?family=Poppins:600&display=swap" rel="stylesheet">
    <script src="https://kit.fontawesome.com/a81368914c.js"></script>
    <meta name="viewport" content="width=device-width, initial-scale=1">
</head>

<body>
    <img class="wave" src="images/login/wave.png">
    <div class="container">
        <div class="img">
            <img src="images/login/bg.svg">
        </div>
        <div class="login-content">


    

            @if (Session::has('error'))
                <div class="alert alert-danger alert-dismissible" role="alert">
                    {!! Session('{{ $message }}') !!}
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>

                </div>
            @endif


            <form action={{ route('login') }} method="POST">
                @csrf
                <img src="images/login/BIBN.png">
                <h2 class="title">Welcome</h2>
                <div class="input-div one">
                    <div class="i">
                        <i class="fas fa-envelope"></i>
                    </div>
                    <div class="div">
                        <h5>Username</h5>
                        <input type="email" required class="input" name='email' value="{{ old('email') }}">
                        <div class="alert alert-danger alert-dismissible" role="alert" style="color: red">
                            @error('email')
                                {{ $message }}
                            @enderror
						</div>
                    </div>
                </div>
                <div class="input-div pass">
                    <div class="i">
                        <i class="fas fa-lock"></i>
                    </div>
                    <div class="div">
                        <h5>Password</h5>
                        <input type="password" required class="input" name='password'>
                        <div class="alert alert-danger alert-dismissible" role="alert" style="color: red">
                            @error('password')
                                {{ $message }}
                            @enderror
						</div>
                    </div>
                </div>
                <a href="{{ route('password.request') }}">Forgot Password?</a>
                <a href="register">Register</a>
                <input type="submit" class="btn" value="Login">
            </form>

        </div>
    </div>
    <script type="text/javascript" src="/js/login.js"></script>
</body>

</html>
