<!DOCTYPE html>
<html lang="zxx">
@include('view_visitor.head')


<body id="bg">

<!-- Boxed Layout -->
<div id="page" class="site boxed-layout">

    <!-- Preloader -->


    <div class="preeloader">
        <div class="preloader-spinner"></div>
    </div>
    <!--	-->


    <!--/ End Preloader -->

    <!-- Header -->
@include('view_visitor.visitor_navbar')



@include('view_visitor.slidershow')

@include('view_visitor.visitor_features_area')

@include('view_visitor.call_to_action')

@include('view_visitor.index_services')

@include('view_visitor.index_portfolio')

@include('view_visitor.index_testimonies')

@include('view_visitor.index_blog')

@include('view_visitor.index_client')

@include('view_visitor.footer')







    <!-- Footer -->
    <footer class="footer" style="background-image:url('img/map.png')">
        <!-- Footer Top -->
        <div class="footer-top">
            <div class="container">
                <div class="row">
                    <div class="col-lg-3 col-md-6 col-12">
                        <!-- Footer About -->
                        <div class="single-widget footer-about widget">
                            <div class="logo">
                                <div class="img-logo">
                                    <a class="logo" href="index.html">
                                        <img class="img-responsive" src="img/logo2.png" alt="logo">
                                    </a>
                                </div>
                            </div>
                            <div class="footer-widget-about-description">
                                <p>Beatae vitae dicta su explicabo nemo enim ipsam voluptatem quia voluptas sitBeatae vitae sitBeatae vitae dicta suntania..</p>
                            </div>
                            <div class="social">
                                <!-- Social Icons -->
                                <ul class="social-icons">
                                    <li><a class="facebook" href="#" target="_blank"><i class="fa fa-facebook"></i></a></li>
                                    <li><a class="twitter" href="#" target="_blank"><i class="fa fa-twitter"></i></a></li>
                                    <li><a class="linkedin" href="#" target="_blank"><i class="fa fa-linkedin"></i></a></li>
                                    <li><a class="pinterest" href="#" target="_blank"><i class="fa fa-pinterest-p"></i></a></li>
                                    <li><a class="instagram" href="#" target="_blank"><i class="fa fa-instagram"></i></a></li>
                                </ul>
                            </div>
                            <div class="button"><a href="#" class="bizwheel-btn">About Us</a></div>
                        </div>
                        <!--/ End Footer About -->
                    </div>
                    <div class="col-lg-2 col-md-6 col-12">
                        <!-- Footer Links -->
                        <div class="single-widget f-link widget">
                            <h3 class="widget-title">Company</h3>
                            <ul>
                                <li><a href="#">About Us</a></li>
                                <li><a href="#">Our Services</a></li>
                                <li><a href="#">Portfolio</a></li>
                                <li><a href="#">Pricing Plan</a></li>
                                <li><a href="#">Contact us</a></li>
                            </ul>
                        </div>
                        <!--/ End Footer Links -->
                    </div>
                    <div class="col-lg-4 col-md-6 col-12">
                        <!-- Footer News -->
                        <div class="single-widget footer-news widget">
                            <h3 class="widget-title">Blog Page</h3>
                            <!-- Single News -->
                            <div class="single-f-news">
                                <div class="post-thumb"><a href="#"><img src="https://via.placeholder.com/70x70" alt="#"></a></div>
                                <div class="content">
                                    <p class="post-meta"><time class="post-date"><i class="fa fa-clock-o"></i>April 15, 2020</time></p>
                                    <h4 class="title"><a href="blog-sngle.html">We Provide you Best &amp; Creative Consulting Service</a></h4>
                                </div>
                            </div>
                            <!--/ End Single News -->
                            <!-- Single News -->
                            <div class="single-f-news">
                                <div class="post-thumb"><a href="#"><img src="https://via.placeholder.com/70x70" alt="#"></a></div>
                                <div class="content">
                                    <p class="post-meta"><time class="post-date"><i class="fa fa-clock-o"></i>April 10, 2020</time></p>
                                    <h4 class="title"><a href="blog-sngle.html">We Provide you Best &amp; Creative Consulting Service</a></h4>
                                </div>
                            </div>
                            <!--/ End Single News -->
                        </div>
                        <!--/ End Footer News -->
                    </div>
                    <div class="col-lg-3 col-md-6 col-12">
                        <!-- Footer Contact -->
                        <div class="single-widget footer_contact widget">
                            <h3 class="widget-title">Contact</h3>
                            <p>Beatae vitae dicta sunt explicabo nemo enim ipsam voluptatem</p>
                            <ul class="address-widget-list">
                                <li class="footer-mobile-number"><i class="fa fa-phone"></i>+(600) 125-4985-214</li>
                                <li class="footer-mobile-number"><i class="fa fa-envelope"></i>info@yoursite.com</li>
                                <li class="footer-mobile-number"><i class="fa fa-map-marker"></i>House Building Uttara</li>
                            </ul>
                        </div>
                        <!--/ End Footer Contact -->
                    </div>
                </div>
                <div class="row">
                    <div class="col-lg-6 offset-lg-3 col-md-8 offset-md-2 col-12">
                        <!-- Footer Newsletter -->
                        <div class="footer-newsletter">
                            <form action="#" method="post" class="newsletter-area">
                                <input type="email" placeholder="Your email address">
                                <button type="submit">Sign Up</button>
                            </form>
                        </div>
                        <!--/ End Footer Newsletter -->
                    </div>
                </div>
            </div>
        </div>
        <!-- Copyright -->
        <div class="copyright">
            <div class="container">
                <div class="row">
                    <div class="col-12">
                        <div class="copyright-content">
                            <!-- Copyright Text -->
                            <p>© Copyright <a href="#">Bizwheel</a>. Design &amp; Development By <a target="_blank" href="#">ThemeLamp</a></p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!--/ End Copyright -->
    </footer>

    <!-- Jquery JS -->
    <script src="{{ asset('t_visitor/bizwheel/js/jquery.min.js') }}"></script>
    <script src="{{ asset('t_visitor/bizwheel/js/jquery-migrate-3.0.0.js') }}"></script>
    <!-- Popper JS -->
    <script src="{{ asset('t_visitor/bizwheel/js/popper.min.js') }}"></script>
    <!-- Bootstrap JS -->
    <script src="{{ asset('t_visitor/bizwheel/js/bootstrap.min.js') }}"></script>
    <!-- Modernizr JS -->
    <script src="{{ asset('t_visitor/bizwheel/js/modernizr.min.js') }}"></script>
    <!-- ScrollUp JS -->
    <script src="{{ asset('t_visitor/bizwheel/js/scrollup.js') }}"></script>
    <!-- FacnyBox JS -->
    <script src="{{ asset('t_visitor/bizwheel/js/jquery-fancybox.min.js') }}"></script>
    <!-- Cube Portfolio JS -->
    <script src="{{ asset('t_visitor/bizwheel/js/cubeportfolio.min.js') }}"></script>
    <!-- Slick Nav JS -->
    <script src="{{ asset('t_visitor/bizwheel/js/slicknav.min.js') }}"></script>
    <!-- Slick Nav JS -->
    <script src="{{ asset('t_visitor/bizwheel/js/slicknav.min.js') }}"></script>
    <!-- Slick Slider JS -->
    <script src="{{ asset('t_visitor/bizwheel/js/owl-carousel.min.js') }}"></script>
    <!-- Easing JS -->
    <script src="{{ asset('t_visitor/bizwheel/js/easing.js') }}"></script>
    <!-- Magnipic Popup JS -->
    <script src="{{ asset('t_visitor/bizwheel/js/magnific-popup.min.js') }}"></script>
    <!-- Active JS -->
    <script src="{{ asset('t_visitor/bizwheel/js/active.js') }}"></script>


</body>
</html>
