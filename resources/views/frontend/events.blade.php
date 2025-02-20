@extends('frontend.layouts.master')
@section('title','Events | Humanity')
@section('body')
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
    </div>
</section>
@endsection