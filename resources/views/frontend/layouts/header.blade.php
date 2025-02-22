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
	<!-- Top Header Start -->
	@include('frontend.layouts.banner')
	<!-- Top Header End -->


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