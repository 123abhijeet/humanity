<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <title>Reset Password | Sattree Gurukul</title>
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
                <div class="row justify-content-center">
                    <div class="col-md-8">
                        <div class="card">
                            <div class="card-header">{{ __('Reset Password') }}</div>

                            <div class="card-body">
                                <form method="POST" action="{{ route('password.update') }}">
                                    @csrf

                                    <input type="hidden" name="token" value="{{ $token }}">

                                    <div class="row mb-3">
                                        <label for="email" class="col-md-4 col-form-label text-md-end">{{ __('Email Address') }}</label>

                                        <div class="col-md-6">
                                            <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ $email ?? old('email') }}" required autocomplete="email" autofocus>

                                            @error('email')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                            @enderror
                                        </div>
                                    </div>

                                    <div class="row mb-3">
                                        <label for="password" class="col-md-4 col-form-label text-md-end">{{ __('Password') }}</label>

                                        <div class="col-md-6">
                                            <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="new-password">

                                            @error('password')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                            @enderror
                                        </div>
                                    </div>

                                    <div class="row mb-3">
                                        <label for="password-confirm" class="col-md-4 col-form-label text-md-end">{{ __('Confirm Password') }}</label>

                                        <div class="col-md-6">
                                            <input id="password-confirm" type="password" class="form-control" name="password_confirmation" required autocomplete="new-password">
                                        </div>
                                    </div>

                                    <div class="row mb-0">
                                        <div class="col-md-6 offset-md-4">
                                            <button type="submit" class="btn btn-primary">
                                                {{ __('Reset Password') }}
                                            </button>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>
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