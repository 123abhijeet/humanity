<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <title>@yield('title')</title>
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta content="width=device-width, initial-scale=1.0" name="viewport">
    <meta content="" name="keywords">
    <meta content="" name="description">

    <!-- Favicons -->
    <link href="{{asset('frontend/img/favicon.ico')}}" rel="icon">
    <link href="{{asset('frontend/img/apple-touch-icon.png')}}" rel="apple-touch-icon">

    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,400,600|Nunito:600,700,800,900" rel="stylesheet">

    <!-- Bootstrap CSS File -->
    <link href="{{ asset('frontend/vendor/bootstrap/css/bootstrap.min.css')}}" rel="stylesheet">

    <!-- Libraries CSS Files -->
    <link href="{{ asset('/frontend/vendor/font-awesome/css/font-awesome.min.css')}}" rel="stylesheet">
    <link href="{{ asset('/frontend/vendor/animate/animate.min.css')}}" rel="stylesheet">
    <link href="{{ asset('/frontend/vendor/ionicons/css/ionicons.min.css')}}" rel="stylesheet">
    <link href="{{ asset('/frontend/vendor/owlcarousel/assets/owl.carousel.min.css')}}" rel="stylesheet">

    <!-- Main Stylesheet File -->
    <link href="{{ asset('/frontend/css/hover-style.css')}}" rel="stylesheet">
    <link href="{{ asset('/frontend/css/style.css')}}" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('toastr/toastr.css') }}">

    <style>
        .nav-menu button {
            padding: 22px 15px 21px 15px;
            text-decoration: none;
            display: inline-block;
            color: #ffffff;
            font-weight: 600;
            font-size: 18px;
            outline: none;
        }

        .donate_img {
            height: 180px;
            width: 350px;
            margin-left: 160px;
        }

        .join_img {
            height: 180px;
            width: 190px;
            margin-left: 320px;
        }

        .mobile_show {
            display: none;
        }

        /* Target devices with a maximum width of 768px (typical tablets and smaller screens) */
        @media only screen and (max-width: 768px) {
            .donate_img {
                height: 180px;
                width: 350px;
                margin-left: -25px;
            }

            .join_img {
                height: 180px;
                width: 190px;
                margin-left: 0;
            }

            .mobile_show {
                display: block;
            }
        }

        /* Additional media queries for smaller devices like smartphones */
        @media only screen and (max-width: 480px) {
            .donate_img {
                height: 180px;
                width: 350px;
                margin-left: -25px;
            }

            .join_img {
                height: 180px;
                width: 190px;
                margin-left: 0;
            }

            .mobile_show {
                display: block;
            }
        }
    </style>
</head>

<body>
    <!-- Header Start -->
    <header id="header">
        <div class="container">
            <nav id="nav-menu-container">
                <ul class="nav-menu">
                    <li class="{{ Route::is('Home') ? 'menu-active' : '' }}"><a href="{{route('Home')}}">Home</a></li>
                    <li class="{{ Route::is('Events') ? 'menu-active' : '' }}"><a href="{{route('Events')}}">Events</a></li>
                    <li class="{{ Route::is('Donate-Blood') ? 'menu-active' : '' }}"><a href="{{route('Donate-Blood')}}">Donate Blood</a></li>
                    <li class="{{ Route::is('Become-Member') ? 'menu-active' : '' }}"><a href="{{route('Become-Member')}}">Become Member</a></li>
                    @if(Auth::check())
                    <li><a href="{{ route('Admin-Dashboard') }}" class="nav-item nav-link active"><i class="fa fa-home m-1"></i>Dashboard</a></li>
                    <li>
                        <form action="{{ route('logout') }}" method="POST">
                            @csrf
                            <button type="submit" class="nav-item nav-link" style="border: none; background: none; padding: 25px 0px -1px 0px; font: inherit; cursor: pointer;"><i class="fa fa-sign-out m-1"></i>Log Out</button>
                        </form>
                    </li>
                    @else
                    <li>
                        <a class="nav-item nav-link" href="{{ route('login') }}"><i class="fa fa-lock m-1"></i>Log In</a>
                    </li>
                    @endif
                </ul>
            </nav>
        </div>
    </header>
    <!-- Header End -->
    <section id="login">
        <div class="container">
            <div class="section-header">
                <h3>Login</h3>
            </div>
            <div class="row">
                <div class="col-md-12 form">
                    <form method="post" action="{{route('login')}}" id="loginForm">
                        @csrf
                        <div class="form-group">
                            <input type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required placeholder="Your Email" />
                            @error('email')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                            @enderror
                        </div>
                        <div class="form-group">
                            <input type="password" class="form-control @error('password') is-invalid @enderror" name="password" required placeholder="Your Password" />
                            @error('password')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                            @enderror
                        </div>
                        <div class="form-group">
                            <div class="custom-control custom-checkbox">
                                <input type="checkbox" class="custom-control-input" id="remember2" name="remember" {{ old('remember') ? 'checked' : '' }}>
                                <label class="custom-control-label" for="remember2">Remember me</label>
                            </div>
                        </div>
                        <div><button type="submit" id="loginBtn">Sign In</button></div>
                        @if (Route::has('password.request'))
                        <div class="text-center">
                            <a href="{{ route('password.request') }}" style="color: #A52A2A;">Forgot your password?</a>
                        </div>
                        @endif
                    </form>
                </div>
            </div>
        </div>
    </section>
    <!-- Support Section Start -->
    <section id="support">
        <div class="container">
            <h1>
                Need help? Call us <br> 943-145-5520, 799-225-2323, 700-467-7500, <br> 938-614-5543, 970-967-3100
            </h1>
        </div>
    </section>
    </main>
    <!-- Support Section end -->
    <!-- Footer Start -->
    <footer id="footer">
        <div class="container">
            <div class="copyright">
                <p>&copy; All Rights Reserved</p>

                <p>Designed By <a target="_blank" href="https://archangelitdms.com/">Arch Angel IT & Digital Marketing Solutions</a></p>
            </div>
        </div>
    </footer>
    <!-- Footer end -->

    <a href="#" class="back-to-top"><i class="fa fa-chevron-up"></i></a>
    <!-- Uncomment below i you want to use a preloader -->
    <!-- <div id="preloader"></div> -->

    <!-- JavaScript Libraries -->
    <script src="{{ asset('frontend/vendor/jquery/jquery.min.js')}}"></script>
    <script src="{{ asset('frontend/vendor/jquery/jquery-migrate.min.js')}}"></script>
    <script src="{{ asset('frontend/vendor/bootstrap/js/bootstrap.bundle.min.js')}}"></script>
    <script src="{{ asset('frontend/vendor/easing/easing.min.js')}}"></script>
    <script src="{{ asset('frontend/vendor/stickyjs/sticky.js')}}"></script>
    <script src="{{ asset('frontend/vendor/superfish/hoverIntent.js')}}"></script>
    <script src="{{ asset('frontend/vendor/superfish/superfish.min.js')}}"></script>
    <script src="{{ asset('frontend/vendor/owlcarousel/owl.carousel.min.js')}}"></script>
    <script src="{{ asset('frontend/vendor/touchSwipe/jquery.touchSwipe.min.js')}}"></script>

    <!-- Main Javascript File -->
    <script src="{{ asset('frontend/js/main.js')}}"></script>
    <script src="{{ asset('toastr/toastr.min.js') }}"></script>
    <script src="{{ asset('js/main.js') }}"></script>
    <script>
        $(document).ready(function() {
            if ("{{ !empty(session('success')) }}") {
                successMsg("{{ session('success') }}")
            }
            if ("{{ !empty(session('error')) }}") {
                errorMsg("{{ session('error') }}")
            }
        });
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