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
    <div class="mobile_show">
        <br>
        <a style="background: #A52A2A; color: #fff; font-weight: 700; padding: 15px 30px; border-radius: 50px; letter-spacing: 1px; margin-left: 20px;" href="{{route('Donate-Blood')}}">Donate Blood</a>
        <a style="background: #A52A2A; color: #fff; font-weight: 700; padding: 15px 30px; border-radius: 50px; letter-spacing: 1px;" href="{{route('Request-Blood')}}">Request Blood</a>
        <br>
        <br>
    </div>
    <main id="main">
        <section id="booking">
            <div class="container">
                <div class="section-header">
                    <h3>रक्त अनुरोध प्रपत्र</h3>
                </div>
                <span>🙏नोट:- कृपया मरीज की पूरी जानकारी विस्तार के साथ हॉस्पिटल द्वारा दिए गए ओरिजनल डिमांड लेटर और ब्लड रिपोर्ट के साथ जरूर दीजिए,पहले मरीज के घर के सदस्य रक्तदान करे🙏
                    ब्लड बैंक से ब्लड 🩸लेने के लिए कृप्या मरीज का ब्लड सैंपल और डॉक्टर द्वारा दिया गया डिमांड लेटर साथ लेकर ब्लड बैंक आएं</span>
                <div class="row">
                    <div class="col-12">
                        <div class="booking-form">
                            <form method="post" action="{{route('Store-Blood-Request')}}" id="RequestForm">
                                @csrf
                                <br>
                                <div class="form-row">
                                    <div class="control-group col-sm-6">
                                        <label>पेशेंट का नाम <span class="text-danger">*</span></label>
                                        <input type="text" name="patent_name" class="form-control @error('patent_name') is-invalid @enderror" value="{{ old('patent_name') }}" required="required" />
                                        @error('patent_name')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                        @enderror
                                    </div>
                                    <div class="control-group col-sm-6">
                                        <label>पेशेंट की उम्र <span class="text-danger">*</span></label>
                                        <input type="text" name="patent_age" class="form-control @error('patent_age') is-invalid @enderror" value="{{ old('patent_age') }}" required="required" />
                                        @error('patent_age')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                        @enderror
                                    </div>
                                </div>
                                <div class="form-row">
                                    <div class="control-group col-sm-6">
                                        <label>पेशेंट का पता <span class="text-danger">*</span></label>
                                        <input type="text" name="patent_address" class="form-control @error('patent_address') is-invalid @enderror" value="{{ old('patent_address') }}" required="required" />
                                        @error('patent_address')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                        @enderror
                                    </div>
                                    <div class="control-group col-sm-6">
                                        <label>क्या प्रॉब्लम है <span class="text-danger">*</span></label>
                                        <input type="text" name="patent_problem" class="form-control @error('patent_problem') is-invalid @enderror" value="{{ old('patent_problem') }}" id="date" required="required" />
                                        @error('patent_problem')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                        @enderror
                                    </div>
                                </div>
                                <div class="form-row">
                                    <div class="control-group col-sm-6">
                                        <label>पेशेंट का ब्लड ग्रुप <span class="text-danger">*</span></label>
                                        <select name="patent_blood_group" class="custom-select @error('patent_blood_group') is-invalid @enderror">
                                            <option selected disabled>Select Blood Group</option>
                                            <option value="O+">O+</option>
                                            <option value="O-">O-</option>
                                            <option value="A+">A+</option>
                                            <option value="A-">A-</option>
                                            <option value="B+">B+</option>
                                            <option value="B-">B-</option>
                                            <option value="AB+">AB+</option>
                                            <option value="AB-">AB-</option>
                                            <option value="Bombay">Bombay</option>
                                        </select>
                                        @error('patent_blood_group')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                        @enderror
                                    </div>
                                    <div class="control-group col-sm-6">
                                        <label>कितना यूनिट ब्लड चाहिए <span class="text-danger">*</span></label>
                                        <input type="number" name="unit_required" class="form-control @error('unit_required') is-invalid @enderror" value="{{ old('unit_required') }}" required="required" />
                                        @error('unit_required')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                        @enderror
                                    </div>
                                </div>
                                <div class="form-row">
                                    <div class="control-group col-sm-6">
                                        <label>हॉस्पिटल का नाम <span class="text-danger">*</span></label>
                                        <input type="text" name="hospital_name" class="form-control @error('hospital_name') is-invalid @enderror" value="{{ old('hospital_name') }}" required="required" />
                                        @error('hospital_name')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                        @enderror
                                    </div>
                                    <div class="control-group col-sm-6">
                                        <label>हॉस्पिटल का पता <span class="text-danger">*</span></label>
                                        <input type="text" name="hospital_address" class="form-control @error('hospital_address') is-invalid @enderror" value="{{ old('hospital_address') }}" required="required" />
                                        @error('hospital_address')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                        @enderror
                                    </div>
                                </div>
                                <div class="form-row">
                                    <div class="control-group col-sm-6">
                                        <label>ब्लड कब चाहिए तारीख <span class="text-danger">*</span></label>
                                        <input type="date" name="date_required" class="form-control @error('date_required') is-invalid @enderror" value="{{ old('date_required') }}" required="required" />
                                        @error('date_required')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                        @enderror
                                    </div>
                                    <div class="control-group col-sm-6">
                                        <label>अटेंडेंट का नाम <span class="text-danger">*</span></label>
                                        <input type="text" name="attendent_name" class="form-control @error('attendent_name') is-invalid @enderror" value="{{ old('attendent_name') }}" required="required" />
                                        @error('attendent_name')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                        @enderror
                                    </div>
                                </div>
                                <div class="form-row">
                                    <div class="control-group col-sm-6">
                                        <label>अटेंडेंट का मोबाइल नंबर <span class="text-danger">*</span></label>
                                        <input type="text" name="attendent_mobile" class="form-control @error('attendent_mobile') is-invalid @enderror" value="{{ old('attendent_mobile') }}" required="required" />
                                        @error('attendent_mobile')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                        @enderror
                                    </div>
                                    <div class="control-group col-sm-6">
                                        <label>परिवार वालों ने कितना यूनिट ब्लड दिया <span class="text-danger">*</span></label>
                                        <input type="number" name="donated_unit" class="form-control @error('donated_unit') is-invalid @enderror" value="{{ old('donated_unit') }}" required="required" />
                                        @error('donated_unit')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                        @enderror
                                    </div>
                                </div>
                                <span>नोट:- इस पूरी जानकारी की जवाबदेही मरीज़ के परिजन की है,किसी भी गलत जानकारी के लिए मरीज के परिजन की जवाबदेही होगी।</span>
                                <div class="button">
                                    <br>
                                    <button type="submit" id="RequestBtn">Submit</button>
                                </div>
                            </form>
                        </div>
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
            var RequestBtn = document.getElementById('RequestBtn');
            var RequestForm = document.getElementById('RequestForm');

            RequestBtn.addEventListener('click', function() {
                RequestBtn.disabled = true; // Disable the button to prevent double-click
                RequestForm.submit(); // Submit the form
            });
        });
    </script>
</body>

</html>