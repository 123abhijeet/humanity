<!DOCTYPE html>
<html lang="en">

<head>
	<meta charset="utf-8">
	<title>@yield('title')</title>
	<meta name="csrf-token" content="{{ csrf_token() }}">
	<meta content="width=device-width, initial-scale=1.0" name="viewport">
	<meta content="" name="keywords">
	<meta content="" name="description">

	<!-- Favicon -->
	<link href="{{asset('frontend/img/sat_logo.png')}}" rel="icon">

	<!-- Google Web Fonts -->
	<link rel="preconnect" href="https://fonts.googleapis.com">
	<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
	<link href="https://fonts.googleapis.com/css2?family=Heebo:wght@400;500;600&family=Nunito:wght@600;700;800&display=swap" rel="stylesheet">

	<!-- Icon Font Stylesheet -->
	<link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.10.0/css/all.min.css" rel="stylesheet">
	<link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.4.1/font/bootstrap-icons.css" rel="stylesheet">

	<!-- Libraries Stylesheet -->
	<link href="{{asset('frontend/lib/animate/animate.min.css')}}" rel="stylesheet">
	<link href="{{asset('frontend/lib/owlcarousel/assets/owl.carousel.min.css')}}" rel="stylesheet">

	<!-- Customized Bootstrap Stylesheet -->
	<link href="{{asset('frontend/css/bootstrap.min.css')}}" rel="stylesheet">

	<!-- Template Stylesheet -->
	<link href="{{asset('frontend/css/style.css')}}" rel="stylesheet">
	<link rel="stylesheet" href="{{ asset('toastr/toastr.css') }}">
	<style>
		@media only screen and (max-width: 800px) {}
	</style>
</head>

<body>
	<!-- Spinner Start -->
	<div id="spinner" class="show bg-white position-fixed translate-middle w-100 vh-100 top-50 start-50 d-flex align-items-center justify-content-center">
		<div class="spinner-border text-primary" style="width: 3rem; height: 3rem;" role="status">
			<span class="sr-only">Loading...</span>
		</div>
	</div>
	<!-- Spinner End -->


	<!-- Navbar Start -->
	<nav class="navbar navbar-expand-lg bg-white navbar-light shadow sticky-top p-0">
		<a href="/" class="navbar-brand d-flex align-items-center px-4 px-lg-5">
			<h2 class="m-0 text-primary" style="font-size: 20px;"><img src="{{ asset('frontend/img/sat_logo.png')}}" alt="" style="width: 52px; height:52px;"> &nbsp;Sattree Gurukul</h2>
		</a>
		<button type="button" class="navbar-toggler me-4" data-bs-toggle="collapse" data-bs-target="#navbarCollapse">
			<span class="navbar-toggler-icon"></span>
		</button>
		<div class="collapse navbar-collapse" id="navbarCollapse">
			<div class="navbar-nav ms-auto p-4 p-lg-0">
				<a href="{{route('Home')}}" class="nav-item nav-link{{ request()->is('/') ? ' active' : '' }}">Home</a>
				<a href="{{route('Courses')}}" class="nav-item nav-link{{ request()->is('courses') ? ' active' : '' }}">Courses</a>
				<a href="{{route('Our-Mentors')}}" class="nav-item nav-link{{ request()->is('our_mentors') ? ' active' : '' }}">Our Mentors</a>
				<div class="nav-item dropdown">
					<a href="#" class="nav-link dropdown-toggle" data-bs-toggle="dropdown">Careers</a>
					<div class="dropdown-menu m-0">
						<a href="{{route('Join-AS-Mentor')}}" class="dropdown-item">Mentors</a>
						<a href="{{route('Coming-Soon')}}" class="dropdown-item">Marketing</a>
					</div>
				</div>
				<a href="{{route('Contact')}}" class="nav-item nav-link{{ request()->is('contact') ? ' active' : '' }}">Contact</a>
				@if(Auth::check())
				<a href="{{ route('Admin-Dashboard') }}" class="nav-item nav-link active"><i class="fa fa-home m-1"></i>Dashboard</a>
				<form action="{{ route('logout') }}" method="POST">
					@csrf
					<button type="submit" class="nav-item nav-link active" style="border: none; background: none; padding: 25px 0px -1px 0px; font: inherit; cursor: pointer;"><i class="fa fa-sign-out-alt m-1"></i>Log Out</button>
				</form>
				@else
				<a href="{{route('Coming-Soon')}}" target="_blank" class="nav-item nav-link active">Try Now<i class="fa fa-arrow-right ms-3"></i></a>
				<a class="nav-item nav-link active" href="{{ route('login') }}"><i class="fa fa-lock m-1"></i>Log In</a>
				@endif
			</div>
		</div>
	</nav>
	<!-- Navbar End -->