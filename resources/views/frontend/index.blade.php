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
                            Lorem ipsum dolor sit amet, consectetur adipiscing elit. Aliquam convallis quam sed tincidunt accumsan. Aliquam at tincidunt tortor, ac porta turpis. Curabitur lacinia venenatis semper.
                        </p>
                        <p>
                            Aliquam ut nibh ut lacus posuere facilisis. Vestibulum ullamcorper arcu et bibendum ultrices. Suspendisse rutrum turpis vitae.
                        </p>
                        <a href="about.html">Read More</a>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- About Section End-->

    <!-- Services Section Start -->
    <section id="services">
        <div class="container">
            <header class="section-header">
                <h3>Services</h3>
            </header>
            <div class="row">
                <div class="col-sm-6 col-md-4 col-lg-3">
                    <div class="single-service">
                        <div class="icon icon-1"></div>
                        <h4>Consultation</h4>
                        <span>20 Min | $50.00</span>
                        <p>Lorem ipsum dolor sit amet consectetur adipisicing.</p>
                        <a href="booking.html">Book Now</a>
                    </div>
                </div>
                <div class="col-sm-6 col-md-4 col-lg-3">
                    <div class="single-service">
                        <div class="icon icon-2"></div>
                        <h4>Health Checkup</h4>
                        <span>30 Min | $30.00</span>
                        <p>Lorem ipsum dolor sit amet consectetur adipisicing.</p>
                        <a href="booking.html">Book Now</a>
                    </div>
                </div>
                <div class="col-sm-6 col-md-4 col-lg-3">
                    <div class="single-service">
                        <div class="icon icon-3"></div>
                        <h4>Flu Shots</h4>
                        <span>10 Min | $15.00</span>
                        <p>Lorem ipsum dolor sit amet consectetur adipisicing.</p>
                        <a href="booking.html">Book Now</a>
                    </div>
                </div>
                <div class="col-sm-6 col-md-4 col-lg-3">
                    <div class="single-service">
                        <div class="icon icon-4"></div>
                        <h4>Blood Test</h4>
                        <span>30 Min | $10.00</span>
                        <p>Lorem ipsum dolor sit amet consectetur adipisicing.</p>
                        <a href="booking.html">Book Now</a>
                    </div>
                </div>
                <div class="col-sm-6 col-md-4 col-lg-3">
                    <div class="single-service">
                        <div class="icon icon-5"></div>
                        <h4>Physical Exams</h4>
                        <span>30 Min | $50.00</span>
                        <p>Lorem ipsum dolor sit amet consectetur adipisicing.</p>
                        <a href="booking.html">Book Now</a>
                    </div>
                </div>
                <div class="col-sm-6 col-md-4 col-lg-3">
                    <div class="single-service">
                        <div class="icon icon-6"></div>
                        <h4>Prevention</h4>
                        <span>10 Min | $20.00</span>
                        <p>Lorem ipsum dolor sit amet consectetur adipisicing.</p>
                        <a href="booking.html">Book Now</a>
                    </div>
                </div>
                <div class="col-sm-6 col-md-4 col-lg-3">
                    <div class="single-service">
                        <div class="icon icon-7"></div>
                        <h4>Family Planning</h4>
                        <span>30 Min | $20.00</span>
                        <p>Lorem ipsum dolor sit amet consectetur adipisicing.</p>
                        <a href="booking.html">Book Now</a>
                    </div>
                </div>
                <div class="col-sm-6 col-md-4 col-lg-3">
                    <div class="single-service">
                        <div class="icon icon-8"></div>
                        <h4>Home Visits</h4>
                        <span>30 Min | $30.00</span>
                        <p>Lorem ipsum dolor sit amet consectetur adipisicing.</p>
                        <a href="booking.html">Book Now</a>
                    </div>
                </div>
                <div class="col-sm-6 col-md-4 col-lg-3 d-sm-none d-md-block d-lg-none">
                    <div class="single-service">
                        <div class="icon icon-9"></div>
                        <h4>Insurance</h4>
                        <span>10 Min | $100.00</span>
                        <p>Lorem ipsum dolor sit amet consectetur adipisicing.</p>
                        <a href="booking.html">Book Now</a>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- Service Section End-->

    <!-- Team Section Start -->
    <section id="team">
        <div class="container">
            <div class="section-header">
                <h3>Meet My Assistant</h3>
            </div>

            <div class="row">
                <div class="col-md-4">
                    <div class="box8">
                        <img src="{{ asset('frontend/img/team-1.jpg')}}" alt="">
                        <div class="box-content">
                            <ul class="icon">
                                <li><a href="#" class="fa fa-twitter"></a></li>
                                <li><a href="#" class="fa fa-facebook"></a></li>
                                <li><a href="#" class="fa fa-pinterest"></a></li>
                                <li><a href="#" class="fa fa-google-plus"></a></li>
                            </ul>
                        </div>
                    </div>
                    <h4>Maureen L. Reidy</h4>
                    <span>Assistant Nurse</span>
                    <p>
                        Lorem ipsum dolor sit amet adipiscing elit. Proin consequat cursus sit amet elit proin consequat.
                    </p>
                </div>

                <div class="col-md-4">
                    <div class="box8">
                        <img src="{{ asset('frontend/img/team-2.jpg')}}" alt="">
                        <div class="box-content">
                            <ul class="icon">
                                <li><a href="#" class="fa fa-twitter"></a></li>
                                <li><a href="#" class="fa fa-facebook"></a></li>
                                <li><a href="#" class="fa fa-pinterest"></a></li>
                                <li><a href="#" class="fa fa-google-plus"></a></li>
                            </ul>
                        </div>
                    </div>
                    <h4>Janelle J. Hittle</h4>
                    <span>Assistant Nurse</span>
                    <p>
                        Lorem ipsum dolor sit amet adipiscing elit. Proin consequat cursus sit amet elit proin consequat.
                    </p>
                </div>

                <div class="col-md-4">
                    <div class="box8">
                        <img src="{{ asset('frontend/img/team-3.jpg')}}" alt="">
                        <div class="box-content">
                            <ul class="icon">
                                <li><a href="#" class="fa fa-twitter"></a></li>
                                <li><a href="#" class="fa fa-facebook"></a></li>
                                <li><a href="#" class="fa fa-pinterest"></a></li>
                                <li><a href="#" class="fa fa-google-plus"></a></li>
                            </ul>
                        </div>
                    </div>
                    <h4>Michael C. Powell</h4>
                    <span>Assistant Nurse</span>
                    <p>
                        Lorem ipsum dolor sit amet adipiscing elit. Proin consequat cursus sit amet elit proin consequat.
                    </p>
                </div>
            </div>
        </div>
    </section>
    <!-- Team Section End -->

    <!-- Testimonials Section Start -->
    <section id="testimonials" class="section-bg wow fadeInUp">
        <div class="container">
            <div class="section-header">
                <h3>Happy Client</h3>
            </div>

            <div class="owl-carousel testimonials-carousel">
                <div class="row testimonial-item">
                    <div class="col-sm-4">
                        <div class="box8">
                            <img src="{{ asset('frontend/img/testimonial-1.jpg')}}" class="testimonial-img" alt="">
                            <div class="box-content">
                                <ul class="icon">
                                    <li><a href="#" class="fa fa-twitter"></a></li>
                                    <li><a href="#" class="fa fa-facebook"></a></li>
                                    <li><a href="#" class="fa fa-pinterest"></a></li>
                                    <li><a href="#" class="fa fa-google-plus"></a></li>
                                </ul>
                            </div>
                        </div>
                    </div>
                    <div class="col-sm-8">
                        <div class="content">
                            <h3>Jamie D. Boyd</h3>
                            <h4>Oral Radiologist</h4>
                            <p>
                                <i class="fa fa-quote-left"></i>
                                Commodo sed hendrerit id, posuere tempus odio. Phasellus vel leo aliquam, interdum massa quis, aliquam sapien. Aliquam erat volutpat. Etiam nec feugiat libero. Phasellus in ipsum nunc.
                                <i class="fa fa-quote-right"></i>
                            </p>
                        </div>
                    </div>
                </div>

                <div class="row testimonial-item">
                    <div class="col-sm-4">
                        <div class="box8">
                            <img src="{{ asset('frontend/img/testimonial-2.jpg')}}" class="testimonial-img" alt="">
                            <div class="box-content">
                                <ul class="icon">
                                    <li><a href="#" class="fa fa-twitter"></a></li>
                                    <li><a href="#" class="fa fa-facebook"></a></li>
                                    <li><a href="#" class="fa fa-pinterest"></a></li>
                                    <li><a href="#" class="fa fa-google-plus"></a></li>
                                </ul>
                            </div>
                        </div>
                    </div>
                    <div class="col-sm-8">
                        <div class="content">
                            <h3>Albert J. Cerrato</h3>
                            <h4>Craft Artist</h4>
                            <p>
                                <i class="fa fa-quote-left"></i>
                                Proin ut dui dictum ligula condimentum cursus. Ut orci arcu, commodo sed hendrerit id, posuere tempus odio. Phasellus vel leo aliquam, interdum massa quis, aliquam sapien. Aliquam erat volutpat
                                <i class="fa fa-quote-right"></i>
                            </p>
                        </div>
                    </div>
                </div>

                <div class="row testimonial-item">
                    <div class="col-sm-4">
                        <div class="box8">
                            <img src="{{ asset('frontend/img/testimonial-3.jpg')}}" class="testimonial-img" alt="">
                            <div class="box-content">
                                <ul class="icon">
                                    <li><a href="#" class="fa fa-twitter"></a></li>
                                    <li><a href="#" class="fa fa-facebook"></a></li>
                                    <li><a href="#" class="fa fa-pinterest"></a></li>
                                    <li><a href="#" class="fa fa-google-plus"></a></li>
                                </ul>
                            </div>
                        </div>
                    </div>
                    <div class="col-sm-8">
                        <div class="content">
                            <h3>Theresa R. Wood</h3>
                            <h4>Prepress Technician</h4>
                            <p>
                                <i class="fa fa-quote-left"></i>
                                Dictum ligula condimentum cursus commodo sed hendrerit id, posuere tempus odio. Phasellus vel leo aliquam, interdum massa quis, aliquam sapien. Aliquam erat volutpat. Etiam nec ultricies semper risus.
                                <i class="fa fa-quote-right"></i>
                            </p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- Testimonials Section End -->

    <!-- Contact Section Start -->
    <section id="contact" class="section-bg wow fadeInUp">
        <div class="container">
            <div class="section-header">
                <h3>Contact Us</h3>
            </div>

            <div class="row">
                <div class="col-md-6">
                    <div class="contact-detail">
                        <div class="contact-hours">
                            <h4>Opening Hours</h4>
                            <p>Monday-Friday: 9am to 7pm</p>
                            <p>Saturday: 9am to 4pm</p>
                            <p>Sunday: Closed</p>
                        </div>

                        <div class="contact-info">
                            <h4>Contact Info</h4>
                            <p>4137 State Street, CA, USA</p>
                            <p><a href="tel:+1-234-567-8900">+1-234-567-8900</a></p>
                            <p><a href="mailto:info@example.com">info@example.com</a></p>
                        </div>
                    </div>
                </div>

                <div class="col-md-6">
                    <div class="contact-form">
                        <form>
                            <div class="form-row">
                                <div class="form-group col-md-6">
                                    <input type="text" class="form-control" placeholder="Your Name" required="required" />
                                </div>
                                <div class="form-group col-md-6">
                                    <input type="email" class="form-control" placeholder="Your Email" required="required" />
                                </div>
                            </div>
                            <div class="form-group">
                                <input type="text" class="form-control" placeholder="Subject" required="required" />
                            </div>
                            <div class="form-group">
                                <textarea class="form-control" rows="5" placeholder="Message" required="required"></textarea>
                            </div>
                            <div><button type="submit">Send Message</button></div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- Contact end -->

    <!-- Support Section Start -->
    <section id="support">
        <div class="container">
            <h1>
                Need help? Call us <br> 943-145-5520, 799-225-2323, 700-467-7500, <br> 938-614-5543, 970-967-3100
            </h1>
        </div>
    </section>
    <!-- Support Section end -->

</main>
@endsection