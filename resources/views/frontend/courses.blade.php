@extends('frontend.layouts.master')
@section('title','Courses | Sattree Gurukul')
@section('body')
<!-- Header Start -->
<div class="container-fluid bg-primary py-5 mb-5 page-header">
    <div class="container py-5">
        <div class="row justify-content-center">
            <div class="col-lg-10 text-center">
                <h1 class="display-3 text-white animated slideInDown">Courses</h1>
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb justify-content-center">
                        <li class="breadcrumb-item"><a class="text-white" href="/">Home</a></li>
                        <li class="breadcrumb-item"><a class="text-white" href="#">Pages</a></li>
                        <li class="breadcrumb-item text-white active" aria-current="page">Courses</li>
                    </ol>
                </nav>
            </div>
        </div>
    </div>
</div>
<!-- Header End -->


<!-- Books Start -->
<div class="container-xxl py-5 category">
    <div class="container">
        <div class="text-center wow fadeInUp" data-wow-delay="0.1s">
            <h6 class="section-title bg-white text-center text-primary px-3">Books</h6>
            <h1 class="mb-5">Our Books</h1>
        </div>
        <div class="row g-3">
            @if($books->isEmpty())
            <div class="col-lg-12">
                <div class="alert alert-warning text-center">
                    No Books Found
                </div>
            </div>
            @else
            @foreach($books as $item)
            <div class="col-lg-3 col-md-6 wow fadeInUp" data-wow-delay="0.1s">
                <div class="course-item bg-light">
                    <div class="position-relative overflow-hidden">
                        <img class="img-fluid" src="{{asset('Book Cover/'.$item->cover_image)}}" alt="" style="border-radius: 10%;">
                    </div>
                    <div class="text-center p-4 pb-0">
                        <h5 class="mb-4">{{$item->title}}</h5>
                    </div>
                    <h6 class="mx-2">{{$item->publication}} <span class="mx-2" style="float: right;">₹ {{$item->price}}</span></h6>
                    <span class="mx-2">{{$item->subject}} <span class="mx-2" style="float: right;">{{$item->language}} </span> </span> <br>
                    @php
                    $description = implode(' ', array_slice(explode(' ', $item->description), 0, 5));
                    @endphp
                    <span class="mx-2">{{$description}}...</span> <br> <br>
                    <a style="margin-left:35%;" class="btn btn-primary" href="{{route('Coming-Soon')}}">Buy Now</a> <br>
                    <br>
                </div>
            </div>
            @endforeach
            @endif
        </div>

    </div>
</div>
<!-- Books Start -->


<!-- Courses Start -->
<div class="container-xxl py-5">
    <div class="container">
        <div class="text-center wow fadeInUp" data-wow-delay="0.1s">
            <h6 class="section-title bg-white text-center text-primary px-3">Courses</h6>
            <h1 class="mb-5">Popular Courses</h1>
        </div>
        <div class="row g-4 justify-content-center">
            @if($courses->isEmpty())
            <div class="col-lg-12">
                <div class="alert alert-warning text-center">
                    No Courses Found
                </div>
            </div>
            @else
            @foreach($courses as $item)
            <div class="col-lg-4 col-md-6 wow fadeInUp" data-wow-delay="0.1s">
                <div class="course-item bg-light">
                    <div class="position-relative overflow-hidden">
                        <img class="img-fluid" src="{{asset('Course Banner/'.$item->course_banner)}}" alt="">
                    </div>
                    <div class="text-center p-4 pb-0">
                        <h3 class="mb-0">₹ {{$item->course_fee}}</h3>
                        <div class="mb-3">
                            <small class="fa fa-star text-primary"></small>
                            <small class="fa fa-star text-primary"></small>
                            <small class="fa fa-star text-primary"></small>
                            <small class="fa fa-star text-primary"></small>
                            <small class="fa fa-star text-primary"></small>
                        </div>
                        <h5 class="mb-4">{{$item->course_name}}</h5>
                    </div>
                    <div class="d-flex border-top">
                        <small class="flex-fill text-center border-end py-2"><i class="fa fa-user-tie text-primary me-2"></i>Abhijeet Kumar</small>
                        <small class="flex-fill text-center border-end py-2"><i class="fa fa-clock text-primary me-2"></i>{{$item->course_duration}} Hours</small>
                    </div>
                    @php
                    $description = implode(' ', array_slice(explode(' ', $item->course_short_description), 0, 10));
                    @endphp
                    <span class="mx-2">{{$description}}...</span> <br> <br>
                    <a style="margin-left:38%;" href="{{route('Coming-Soon')}}" class="btn btn-primary">Buy Now</a> <br> <br>
                </div>
            </div>
            @endforeach
            @endif
        </div>
    </div>
</div>
<!-- Courses End -->


<!-- Testimonial Start -->
<div class="container-xxl py-5 wow fadeInUp" data-wow-delay="0.1s">
    <div class="container">
        <div class="text-center">
            <h6 class="section-title bg-white text-center text-primary px-3">Testimonial</h6>
            <h1 class="mb-5">Our Students Say!</h1>
        </div>
        <div class="owl-carousel testimonial-carousel position-relative">
            <div class="testimonial-item text-center">
                <img class="border rounded-circle p-2 mx-auto mb-3" src="{{asset('frontend/img/testimonial-1.jpg')}}" style="width: 80px; height: 80px;">
                <h5 class="mb-0">Client Name</h5>
                <p>Profession</p>
                <div class="testimonial-text bg-light text-center p-4">
                    <p class="mb-0">Tempor erat elitr rebum at clita. Diam dolor diam ipsum sit diam amet diam et eos. Clita erat ipsum et lorem et sit.</p>
                </div>
            </div>
            <div class="testimonial-item text-center">
                <img class="border rounded-circle p-2 mx-auto mb-3" src="{{asset('frontend/img/testimonial-2.jpg')}}" style="width: 80px; height: 80px;">
                <h5 class="mb-0">Client Name</h5>
                <p>Profession</p>
                <div class="testimonial-text bg-light text-center p-4">
                    <p class="mb-0">Tempor erat elitr rebum at clita. Diam dolor diam ipsum sit diam amet diam et eos. Clita erat ipsum et lorem et sit.</p>
                </div>
            </div>
            <div class="testimonial-item text-center">
                <img class="border rounded-circle p-2 mx-auto mb-3" src="{{asset('frontend/img/testimonial-3.jpg')}}" style="width: 80px; height: 80px;">
                <h5 class="mb-0">Client Name</h5>
                <p>Profession</p>
                <div class="testimonial-text bg-light text-center p-4">
                    <p class="mb-0">Tempor erat elitr rebum at clita. Diam dolor diam ipsum sit diam amet diam et eos. Clita erat ipsum et lorem et sit.</p>
                </div>
            </div>
            <div class="testimonial-item text-center">
                <img class="border rounded-circle p-2 mx-auto mb-3" src="{{asset('frontend/img/testimonial-4.jpg')}}" style="width: 80px; height: 80px;">
                <h5 class="mb-0">Client Name</h5>
                <p>Profession</p>
                <div class="testimonial-text bg-light text-center p-4">
                    <p class="mb-0">Tempor erat elitr rebum at clita. Diam dolor diam ipsum sit diam amet diam et eos. Clita erat ipsum et lorem et sit.</p>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- Testimonial End -->
@endsection