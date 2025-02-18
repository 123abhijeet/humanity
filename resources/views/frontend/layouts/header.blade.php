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
	<link href="img/favicon.ico" rel="icon">
	<link href="img/apple-touch-icon.png" rel="apple-touch-icon">
	<link href="{{asset('frontend/img/sat_logo.png')}}" rel="icon">

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
	</style>
</head>

<body>
	<!-- Top Header Start -->
	<section class="top-header">
		<div class="container text-center">
			<div class="row">
				<div class="col-md-12">
					<h1 style="font-size: 70px;"><a href="">HUMANITY BL🩸🩸D DONORS </a></h1>
					<a class="brand" href="" title="Home"><img alt="Logo" src="{{asset('frontend/img/logo.png')}}" style="width: 15%;border-radius: 50%;"></a>
				</div>
			</div>

			<div class="col-md-12">
				<h2>LETS CREATE🩸 BLOOD RELATION</h2>
				<a class="btn btn-full" href="{{route('Request-Blood')}}">Request Blood</a>
			</div>
		</div>
	</section>
	<!-- Top Header End -->


	<!-- Header Start -->
	<header id="header">
		<div class="container">
			<nav id="nav-menu-container">
				<ul class="nav-menu">
					<li class="{{ request()->is('/') ? 'menu-active ' : '' }}"><a href="{{route('Home')}}">Home</a></li>
					<li class="{{ request()->is('/gallery') ? 'menu-active ' : '' }}"><a href="{{route('Gallery')}}">Gallery</a></li>
					<li class="{{ request()->is('/events') ? 'menu-active ' : '' }}"><a href="{{route('Events')}}">Events</a></li>
					<li class="{{ request()->is('/donate-now') ? 'menu-active ' : '' }}"><a href="{{route('Donate-Now')}}">Donate Blood</a></li>
					<li class="{{ request()->is('/contact') ? 'menu-active ' : '' }}"><a href="{{route('Become-Member')}}">Become Member</a></li>
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
						<a class="nav-item nav-link active" href="{{ route('login') }}"><i class="fa fa-lock m-1"></i>Log In</a>
					</li>
					@endif
				</ul>
			</nav>
		</div>
	</header>
	<!-- Header End -->