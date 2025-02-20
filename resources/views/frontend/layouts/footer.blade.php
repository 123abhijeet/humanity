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
         })
     </script>
     </body>

     </html>