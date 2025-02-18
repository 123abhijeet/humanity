@extends('frontend.layouts.master')
@section('title','Our Mentors | Sattree Gurukul')
@section('body')
<!-- Header Start -->
<div class="container-fluid bg-primary py-5 mb-5 page-header">
	<div class="container py-5">
		<div class="row justify-content-center">
			<div class="col-lg-10 text-center">
				<h1 class="display-3 text-white animated slideInDown">Our Mentors</h1>
				<nav aria-label="breadcrumb">
					<ol class="breadcrumb justify-content-center">
						<li class="breadcrumb-item"><a class="text-white" href="/">Home</a></li>
						<li class="breadcrumb-item"><a class="text-white" href="#">Pages</a></li>
						<li class="breadcrumb-item text-white active" aria-current="page">Mentors</li>
					</ol>
				</nav>
			</div>
		</div>
	</div>
</div>
<!-- Header End -->


<!-- Team Start -->
<div class="container-xxl py-5">
	<div class="container">
		<div class="text-center wow fadeInUp" data-wow-delay="0.1s">
			<h6 class="section-title bg-white text-center text-primary px-3">Instructors</h6>
			<h1 class="mb-5">Expert Instructors</h1>
		</div>
		<div class="row g-4">
		@if($teachers->isEmpty())
			<div class="col-lg-12">
				<div class="alert alert-warning text-center">
					No Mentors Found
				</div>
			</div>
			@else
			@foreach($teachers as $item)
			<div class="col-lg-3 col-md-6 wow fadeInUp" data-wow-delay="0.1s">
				<div class="team-item bg-light">
					<div class="overflow-hidden">
						<img class="img-fluid" src="{{asset('Teacher Picture/'.$item->picture)}}" alt="">
					</div>
					<div class="position-relative d-flex justify-content-center" style="margin-top: -23px;">
						<div class="bg-light d-flex justify-content-center pt-2 px-1">
							<a class="btn btn-sm-square btn-primary mx-1" href=""><i class="fab fa-facebook-f"></i></a>
							<a class="btn btn-sm-square btn-primary mx-1" href=""><i class="fab fa-twitter"></i></a>
							<a class="btn btn-sm-square btn-primary mx-1" href=""><i class="fab fa-instagram"></i></a>
						</div>
					</div>
					<div class="text-center p-4">
						<h5 class="mb-0">{{$item->name}}</h5>
						<small>{{$item->experience}}+ Years</small> <br>
						<small>{{$item->qualification}}</small>
					</div>
				</div>
			</div>
			@endforeach
			@endif
			<div class="col-lg-3 col-md-6 wow fadeInUp" data-wow-delay="0.1s">
				<div class="team-item bg-light">
					<div class="overflow-hidden">
						<img class="img-fluid" src="{{asset('frontend/img/you.jpg')}}" alt="">
					</div>
					<div class="text-center p-4">
						<h5 class="mb-0">Are you the next</h5>
						<small><a href="{{route('Join-AS-Mentor')}}">Click to apply</a></small>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>
<!-- Team End -->
@endsection