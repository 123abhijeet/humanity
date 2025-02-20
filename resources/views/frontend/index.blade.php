@extends('frontend.layouts.master')
@section('title','Home | Humanity')
@section('body')
<main id="main">

    <!-- About Section Start-->
    <section id="about">
        <div class="container">
            <div class="row">
                <div class="col-lg-5 col-md-6">
                    <div class="about-col-left">
                        <img class="img-fluid" src="{{ asset('frontend/img/about-us.jpg')}}" />
                    </div>
                </div>

                <div class="col-lg-7 col-md-6">
                    <div class="about-col-right">
                        <header class="section-header">
                            <h3>About Humanity</h3>
                        </header>
                        <ul class="icon">
                            <li><a href="#" class="fa fa-twitter"></a></li>
                            <li><a href="#" class="fa fa-facebook"></a></li>
                            <li><a href="#" class="fa fa-youtube"></a></li>
                            <li><a href="#" class="fa fa-instagram"></a></li>
                        </ul>
                        <p>
                        ह्यूमैनिटी ब्लड डोनर्स ट्रस्ट खगड़िया बिहार
                        </p>
                        <p>
                            Aliquam ut nibh ut lacus posuere facilisis. Vestibulum ullamcorper arcu et bibendum ultrices. Suspendisse rutrum turpis vitae.
                        </p>
                        <a href="{{route('Request-Blood')}}">Request Blood</a>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- About Section End-->

    <!-- Events Section Start -->
    <section id="team">
        <div class="container">
            <div class="section-header">
                <h3>Events</h3>
            </div>

            <div class="row">
                <div class="col-md-4">
                    <div class="box8">
                        <img src="{{ asset('frontend/img/events/camp1.jpg')}}" alt="">
                    </div>
                    <h4>स्टेट अवार्ड सेरेमनी में ह्यूमैनिटी टीम हुई सम्मानित, वत्स सेवा समिति</h4>
                </div>

                <div class="col-md-4">
                    <div class="box8">
                        <img src="{{ asset('frontend/img/events/camp2.jpg')}}" alt="">
                    </div>
                    <h4>रक्तदान महाकुंभ 2022 का आयोजन, निरामया ब्लड बैंक, पटना </h4>
                </div>

                <div class="col-md-4">
                    <div class="box8">
                        <img src="{{ asset('frontend/img/events/camp3.jpg')}}" alt="">
                    </div>
                    <h4>स्वैच्छिक रक्तदान शिविर आयोजक कार्यशाला का आयोजन, चाणक्या होटल, पटना</h4>
                </div>
            </div>
            <div class="row">
                <div class="col-md-4">
                    <div class="box8">
                        <img src="{{ asset('frontend/img/events/camp1.jpg')}}" alt="">
                    </div>
                    <h4>स्टेट अवार्ड सेरेमनी में ह्यूमैनिटी टीम हुई सम्मानित, वत्स सेवा समिति</h4>
                </div>

                <div class="col-md-4">
                    <div class="box8">
                        <img src="{{ asset('frontend/img/events/camp2.jpg')}}" alt="">
                    </div>
                    <h4>रक्तदान महाकुंभ 2022 का आयोजन, निरामया ब्लड बैंक, पटना </h4>
                </div>

                <div class="col-md-4">
                    <div class="box8">
                        <img src="{{ asset('frontend/img/events/camp3.jpg')}}" alt="">
                    </div>
                    <h4>स्वैच्छिक रक्तदान शिविर आयोजक कार्यशाला का आयोजन, चाणक्या होटल, पटना</h4>
                </div>
            </div>
        </div>
    </section>
    <!-- Events Section End -->

    <section id="about">
        <div class="container">
            <div class="row">
                <div class="col-sm-6">
                    <div class="about-col">
                        <h4>आर्थिक सहयोग हेतु निवेदन</h4>
                        <img class="donate_img" src="{{asset('frontend/img/donate.jpeg')}}" alt="">
                    </div>
                </div>
                <div class="col-sm-6">
                    <div class="about-col">
                        <h4>जुड़ने के लिए स्कैन करें</h4>
                        <img class="join_img" src="{{asset('frontend/img/join.jpeg')}}" alt="">
                    </div>
                </div>
            </div>
        </div>
    </section>
    @endsection