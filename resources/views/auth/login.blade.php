<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <title>Login Here | Sattree Gurukul</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0">

    <link rel="shortcut icon" type="image/x-icon" href="{{asset('frontend/img/sat_logo.png')}}">

    <link href="../../../../css?family=Roboto:300,400,500,700,900" rel="stylesheet">

    <link rel="stylesheet" href="{{ asset('backend/css/bootstrap.min.css')}}">

    <link rel="stylesheet" href="{{ asset('backend/plugins/fontawesome/css/all.min.css')}}">
    <link rel="stylesheet" href="{{ asset('backend/plugins/fontawesome/css/fontawesome.min.css')}}">

    <link rel="stylesheet" href="{{ asset('backend/css/style.css')}}">
    <!--[if lt IE 9]>
		<script src="{{ asset('backend/js/html5shiv.min.js')}}"></script>
		<script src="{{ asset('backend/js/respond.min.js')}}"></script>
	<![endif]-->
</head>

<body>
    <div class="main-wrapper">
        <div class="account-page">
            <div class="container">
                <h3 class="account-title text-white">Login</h3>
                <div class="account-box">
                    <div class="account-wrapper">
                        <div class="account-logo">
                            <a href=""></a>
                        </div>
                        <form method="post" action="{{route('login')}}" id="loginForm">
                            @csrf
                            <div class="form-group">
                                <label>Email</label>
                                <input type="text" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required>
                                @error('email')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label>Password</label>
                                <input type="password" class="form-control @error('password') is-invalid @enderror" name="password" required>
                                @error('password')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                            <div class="form-group text-center custom-mt-form-group">
                                <button class="btn btn-primary btn-block account-btn" type="submit" id="loginBtn">Login</button>
                            </div>
                            @if (Route::has('password.request'))
                            <div class="text-center">
                                <a href="{{ route('password.request') }}">Forgot your password?</a>
                            </div>
                            @endif

                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script src="{{ asset('backend/js/jquery-3.6.0.min.js')}}"></script>

    <script src="{{ asset('backend/js/bootstrap.bundle.min.js')}}"></script>

    <script src="{{ asset('backend/js/jquery.slimscroll.js')}}"></script>

    <script src="{{ asset('backend/js/app.js')}}"></script>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            var loginBtn = document.getElementById('loginBtn');
            var loginForm = document.getElementById('loginForm');

            loginBtn.addEventListener('click', function() {
                loginBtn.disabled = true; // Disable the button to prevent double-click
                loginForm.submit(); // Submit the form
            });
        });
    </script>
</body>

</html>