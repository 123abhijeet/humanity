<!-- Footer Start -->
<div class="container-fluid bg-dark text-light footer pt-5 mt-5 wow fadeIn" data-wow-delay="0.1s">
      <div class="container py-5">
          <div class="row g-5">
              <div class="col-lg-6 col-md-6">
                  <h4 class="text-white mb-3">About Sattree Gurukul</h4>
                  <p>Sattree is the new Startup ed-tech company and the creator of India's most loved school learning app. Launched in 2024, Sattree offers highly effective learning programs for every One.
                  We are providing Best way to learn Computer and English . We craft learning journeys for every student that address their unique needs.</p>
              </div>
              <div class="col-lg-3 col-md-6">
                  <h4 class="text-white mb-3">Quick Link</h4>
                  <a class="btn btn-link" href="{{route('About')}}">About Us</a>
                  <a class="btn btn-link" href="{{route('Privacy-Policy')}}">Privacy Policy</a>
                  <a class="btn btn-link" href="{{route('Terms-Conditions')}}">Term & Conditions</a>
                  <a class="btn btn-link" href="{{route('Refund-Policy')}}">Return & Refund</a>
              </div>
              <div class="col-lg-3 col-md-6">
                  <h4 class="text-white mb-3">Contact</h4>
                  <p class="mb-2"><i class="fa fa-map-marker-alt me-3"></i>Fatehpur, P.O.+ P.S. - Ander, Dist- Siwan, 841231</p>
                  <p class="mb-2"><i class="fa fa-phone-alt me-3"></i>+91 9708467940</p>
                  <p class="mb-2"><i class="fa fa-envelope me-3"></i>sattreevision@gmail.com</p>
                  <!--<div class="d-flex pt-2">-->
                  <!--    <a class="btn btn-outline-light btn-social" href=""><i class="fab fa-twitter"></i></a>-->
                  <!--    <a class="btn btn-outline-light btn-social" href=""><i class="fab fa-facebook-f"></i></a>-->
                  <!--    <a class="btn btn-outline-light btn-social" href=""><i class="fab fa-youtube"></i></a>-->
                  <!--    <a class="btn btn-outline-light btn-social" href=""><i class="fab fa-linkedin-in"></i></a>-->
                  <!--</div>-->
              </div>
          </div>
      </div>
      <div class="container">
          <div class="copyright">
              <div class="row">
                  <div class="col-md-6 text-center text-md-start mb-3 mb-md-0">
                      All Right Reserved.
                      Designed By <a class="border-bottom" href="https://www.archangelitdms.com/">Arch Angel IT & Digital Marketing Agency</a>
                  </div>
              </div>
          </div>
      </div>
  </div>
  <!-- Footer End -->


  <!-- Back to Top -->
  <a href="#" class="btn btn-lg btn-primary btn-lg-square back-to-top"><i class="bi bi-arrow-up"></i></a>


  <!-- JavaScript Libraries -->
  <script src="https://code.jquery.com/jquery-3.4.1.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0/dist/js/bootstrap.bundle.min.js"></script>
  <script src="{{asset('frontend/lib/wow/wow.min.js')}}"></script>
  <script src="{{asset('frontend/lib/easing/easing.min.js')}}"></script>
  <script src="{{asset('frontend/lib/waypoints/waypoints.min.js')}}"></script>
  <script src="{{asset('frontend/lib/owlcarousel/owl.carousel.min.js')}}"></script>

  <!-- Template Javascript -->
  <script src="{{asset('frontend/js/main.js')}}"></script>
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
      })
  </script>
  </body>

  </html>