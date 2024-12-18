<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <title>Tayler Taylers HTML Template</title>
    <!-- Stylesheets -->
    <link href="{{ asset('assets/css/bootstrap.css') }}" rel="stylesheet">
    <link href="{{ asset('assets/css/style.css') }}" rel="stylesheet">
    <!-- Responsive File -->
    <link href="{{ asset('assets/css/responsive.css') }}" rel="stylesheet">
    <!-- Color File -->
    <link href="{{ asset('assets/css/color.css') }}" rel="stylesheet">

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Crimson+Text:wght@400;600;700&family=DM+Sans:wght@400;500;700&display=swap" rel="stylesheet">

    <link rel="shortcut icon" href="{{ asset('assets/images/favicon.png') }}" type="image/x-icon">
    <link rel="icon" href="{{ asset('assets/images/favicon.png') }}" type="image/x-icon">

    <!-- Responsive -->
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0">
    <!--[if lt IE 9]><script src="https://cdnjs.cloudflare.com/ajax/libs/html5shiv/3.7.3/html5shiv.js"></script><![endif]-->
    <!--[if lt IE 9]><script src="js/respond.js"></script><![endif]-->
</head>

<body>

    <div class="page-wrapper">

        <!-- Main Header -->
        <header class="main-header header-style-one">

            <!-- Header Upper -->
            <div class="header-upper">
                <div class="auto-container">
                    <div class="inner-container">
                        <div class="left-column">
                            <!--Logo-->
                            <div class="logo-box">
                                <div class="logo"><a href="{{ route('landing') }}"><h3>Bibib Mode</h3></a></div>
                            </div>
                            <!--Nav Box-->
                            <div class="nav-outer">
                                <!--Mobile Navigation Toggler-->
                                <div class="mobile-nav-toggler"><img src="{{ asset('assets/images/icons/icon-bar.png') }}" alt=""></div>

                                <!-- Main Menu -->
                                <nav class="main-menu navbar-expand-md navbar-light">
                                    <div class="collapse navbar-collapse show clearfix" id="navbarSupportedContent">
                                        <ul class="navigation">
                                            <li><a href="{{ route('landing') }}">Home</a></li>
                                            <li><a href="{{ url('tracking') }}">Tracking Pesanan</a></li>
                                            <li><a href="{{ route('login') }}">Login</a></li>
                                        </ul>
                                    </div>
                                </nav>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!--End Header Upper-->

            <!-- Sticky Header  -->
            <div class="sticky-header">
                <div class="header-upper">
                    <div class="auto-container">
                        <div class="inner-container">
                            <!--Logo-->
                            <div class="logo-box">
                                <div class="logo"><a href="{{ route('landing') }}"><h3>Bibib Mode</h3></a></div>
                            </div>
                            <div class="right-column">
                                <!--Nav Box-->
                                <div class="nav-outer">
                                    <!--Mobile Navigation Toggler-->
                                    <div class="mobile-nav-toggler"><img src="{{ asset('assets/images/icons/icon-bar.png') }}" alt=""></div>

                                    <!-- Main Menu -->
                                    <nav class="main-menu navbar-expand-md navbar-light">
                                    </nav>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div><!-- End Sticky Menu -->

            <!-- Mobile Menu  -->
            <div class="mobile-menu">
                <div class="menu-backdrop"></div>
                <div class="close-btn"><i class="icon fal fa-times"></i></div>

                <nav class="menu-box">
                    <div class="nav-logo"><a href="{{ route('landing') }}"><img src="{{ asset('assets/images/logo-light.png') }}" alt="" title=""></a></div>
                    <div class="menu-outer"><!--Here Menu Will Come Automatically Via Javascript / Same Menu as in Header--></div>
                    <!--Social Links-->
                    <div class="social-links">
                        <ul class="clearfix">
                            <li><a href="#"><span class="fab fa-twitter"></span></a></li>
                            <li><a href="#"><span class="fab fa-facebook-square"></span></a></li>
                            <li><a href="#"><span class="fab fa-pinterest-p"></span></a></li>
                            <li><a href="#"><span class="fab fa-instagram"></span></a></li>
                            <li><a href="#"><span class="fab fa-youtube"></span></a></li>
                        </ul>
                    </div>
                </nav>
            </div><!-- End Mobile Menu -->

            <div class="nav-overlay">
                <div class="cursor"></div>
                <div class="cursor-follower"></div>
            </div>
        </header>
        <!-- End Main Header -->

        <!-- Bnner Section -->
        <section class="banner-section">
            <div class="swiper-container banner-slider">
                <div class="swiper-wrapper">
                    <!-- Slide Item -->
                    <div class="swiper-slide" style="background-image: url({{ asset('assets/images/Tailor.png') }});">
                        <div class="content-outer">
                            <div class="content-box">
                                <!-- <div class="inner">
                                    <h4>Welcome to Quality Tayler</h4>
                                    <h1 style="font-color: black">our Personal <br>
                                        Quality tayler</h1>
                                </div> -->
                            </div>
                        </div>
                    </div>
                    <!-- Slide Item -->
                    <div class="swiper-slide" style="background-image: url({{ asset('assets/images/drawing-fabric.jpg') }});">
                        <div class="content-outer">
                            <div class="content-box">
                                <!-- <div class="inner">
                                    <h4>Welcome to Quality Tayler</h4>
                                    <h1>Create your <br> own Personal Style</h1>
                                </div> -->
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="banner-slider-nav">
                <div class="banner-slider-control banner-slider-button-prev"><span><i class="fas fa-arrow-right"></i></span></div>
                <div class="banner-slider-control banner-slider-button-next"><span><i class="fas fa-arrow-right"></i></span> </div>
            </div>
        </section>
        <!-- End Bnner Section -->

        <!-- Our services -->
        <section class="services-section" style="background-image: url({{ asset('assets/images/background/bg-2.jpg') }});">
            <div class="auto-container">
                <div class="sec-title-box text-center">
                    <div class="sec-title-dec"><img src="{{ asset('assets/images/shape/shape-1.png') }}" alt=""></div>
                    <div class="sub-title">What We Do</div>
                    <h2 class="sec-title">Services We Offer</h2>
                </div>
                <div class="theme_carousel owl-theme owl-carousel owl-style-one" data-options='{"loop": true, "margin": 0, "autoheight":true, "lazyload":true, "nav": true, "dots": true, "autoplay": true, "autoplayTimeout": 6000, "smartSpeed": 1000, "responsive":{ "0" :{ "items": "1" }, "480" :{ "items" : "1" }, "600" :{ "items" : "2" }, "768" :{ "items" : "2" } , "992":{ "items" : "3", "center": true }, "1200":{ "items" : "3", "center": true }}}'>
                    <div class="col-lg-12 service-block-one">
                        <div class="inner-box wow fadeInUp" data-wow-delay="0ms" data-wow-duration="1500ms">
                            <div class="image img_hover_1"><img src="{{ asset('assets/images/portrait-beautiful-young-asian-woman-smile-happy.jpg') }}" alt=""></div>
                            <h4>Suits & Shirts</a></h4>
                            <div class="text">Baju yang terbuat dari bahan katun dan <br> nyaman dipakai.</div>
                        </div>
                    </div>
                    <div class="col-lg-12 service-block-one">
                        <div class="inner-box wow fadeInUp" data-wow-delay="300ms" data-wow-duration="1500ms">
                            <div class="image img_hover_1"><img src="{{ asset('assets/images/woman-traditional-wedding-dress-java-premium-photo.jpg') }}" alt=""></div>
                            <h4>Wedding Dresses</a></h4>
                            <div class="text">Baju pernikahan yang diimpikan dan nyaman dipakai.</div>
                        </div>
                    </div>
                    <div class="col-lg-12 service-block-one">
                        <div class="inner-box wow fadeInUp" data-wow-delay="300ms" data-wow-duration="1500ms">
                            <div class="image img_hover_1"><img src="{{ asset('assets/images/clothes-store-with-mannequin.jpg') }}" alt=""></div>
                            <h4>Stylish Clothing</a></h4>
                            <div class="text">Baju yang formal dan elegan.</div>
                        </div>
                    </div>
                    <div class="col-lg-12 service-block-one">
                        <div class="inner-box wow fadeInUp" data-wow-delay="0ms" data-wow-duration="1500ms">
                            <div class="image img_hover_1"><img src="{{ asset('assets/images/portrait-beautiful-young-asian-woman-smile-happy.jpg') }}" alt=""></div>
                            <h4>Suits & Shirts</a></h4>
                            <div class="text">Baju yang terbuat dari bahan katun dan <br> nyaman dipakai.</div>
                        </div>
                    </div>
                    <div class="col-lg-12 service-block-one">
                        <div class="inner-box wow fadeInUp" data-wow-delay="300ms" data-wow-duration="1500ms">
                            <div class="image img_hover_1"><img src="{{ asset('assets/images/woman-traditional-wedding-dress-java-premium-photo.jpg') }}" alt=""></div>
                            <h4>Wedding Dresses</a></h4>
                            <div class="text">Baju pernikahan yang diimpikan dan nyaman dipakai.</div>
                        </div>
                    </div>
                    <div class="col-lg-12 service-block-one">
                        <div class="inner-box wow fadeInUp" data-wow-delay="300ms" data-wow-duration="1500ms">
                            <div class="image img_hover_1"><img src="{{ asset('assets/images/clothes-store-with-mannequin.jpg') }}" alt=""></div>
                            <h4>Stylish Clothing</a></h4>
                            <div class="text">Baju yang formal dan elegan.</div>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <!-- Services two -->
        <section class="services-two-section pt-0">
            <div class="top-area">
                <div class="auto-container full-width">
                    <div class="row no-gutters">
                        <div class="col-lg-6 image-bg" style="background-image: url({{ asset('assets/images/portrait-beautiful-young-asian-woman-smile-happy.jpg') }});">
                        </div>
                        <div class="col-lg-6">
                            <div class="inner-container">
                                <div class="sec-title-dec"><img src="{{ asset('assets/images/shape/shape-1.png') }}" alt=""></div>
                                <div class="sub-title light">Checkout our services</div>
                                <h2 class="sec-title light mb-30">Wedding or Causual <br> Suits Services?</h2>
                                <div class="text light mb-30">Kami menyediakan berbagai macam pakaian untuk kebutuhan anda danPakaian yang nyaman ketika dipakai.</div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="bottom-area">
                <div class="auto-container">
                    <div class="row">
                        <div class="col-lg-3 col-md-6">
                            <div class="service-block-two wow fadeInDown" data-wow-delay="0ms" data-wow-duration="1500ms">
                                <div class="service-block-two_icon"><i class="flaticon-botton"></i></div>
                                <h4 class="service-block-two_title">Quality Fabric</h4>
                                <div class="service-block-two_text">Kualitas bahan yang terbaik dan penjahit yang berpengalaman</div>
                            </div>
                        </div>
                        <div class="col-lg-3 col-md-6">
                            <div class="service-block-two wow fadeInDown" data-wow-delay="300ms" data-wow-duration="1500ms">
                                <div class="service-block-two_icon"><i class="flaticon-seam-ripper"></i></div>
                                <h4 class="service-block-two_title">Finest Work</h4>
                                <div class="service-block-two_text">Dikerjakan oleh penjahit yang berpengalaman dan diberi jahitan yang rapi</div>
                            </div>
                        </div>
                        <div class="col-lg-3 col-md-6">
                            <div class="service-block-two wow fadeInDown" data-wow-delay="500ms" data-wow-duration="1500ms">
                                <div class="service-block-two_icon"><i class="flaticon-embroidery"></i></div>
                                <h4 class="service-block-two_title">Unique Design</h4>
                                <div class="service-block-two_text">Model yang unik dan berbeda dari yang lain</div>
                            </div>
                        </div>
                        <div class="col-lg-3 col-md-6">
                            <div class="service-block-two wow fadeInDown" data-wow-delay="700ms" data-wow-duration="1500ms">
                                <div class="service-block-two_icon"><i class="flaticon-thread"></i></div>
                                <h4 class="service-block-two_title">Timely Deliver</h4>
                                <div class="service-block-two_text">Dikirim dengan cepat dan dengan jaminan kualitas yang baik</div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <!-- Map Section -->
        <section class="map-section pb-0 pt-0">
            <div class="auto-container full-width">
                <div class="contact-map">
                    <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3989.657576776149!2d101.47215287453311!3d0.5143151636925887!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x31d5ae81ec4f63f5%3A0x9aec81ae7e858a16!2sJl.%20Kempas%2C%20Rejosari%2C%20Kec.%20Tenayan%20Raya%2C%20Kota%20Pekanbaru%2C%20Riau%2028111!5e0!3m2!1sid!2sid!4v1734162922746!5m2!1sid!2sid" width="600" height="500" frameborder="0" style="border:0; width: 100%" allowfullscreen="" aria-hidden="false" tabindex="0"></iframe>
                </div>
            </div>
        </section>

        <footer class="main-footer" style="background-image: url({{ asset('assets/images/background/bg-6.jpg') }});">
            <!-- Footer Bottom -->
            <div class="footer-bottom">
                <div class="auto-container">
                    <div class="copyright"> 2023 by Company.com</div>
                </div>
            </div>
        </footer>

    </div>
    <!--End pagewrapper-->

    <!--Scroll to top-->
    <div class="scroll-to-top"><a href="# " class="back-to-top " data-wow-duration="1.0s " data-wow-delay="1.0s "><i class="fa fa-angle-up "></i></a></div>

    <script src="{{ asset('assets/js/jquery.js') }}"></script>
    <script src="{{ asset('assets/js/popper.min.js') }}"></script>
    <script src="{{ asset('assets/js/bootstrap.min.js') }}"></script>
    <script src="{{ asset('assets/js/bootstrap-select.min.js') }}"></script>
    <script src="{{ asset('assets/js/jquery.fancybox.js') }}"></script>
    <script src="{{ asset('assets/js/isotope.js') }}"></script>
    <script src="{{ asset('assets/js/owl.js') }}"></script>
    <script src="{{ asset('assets/js/appear.js') }}"></script>
    <script src="{{ asset('assets/js/wow.js') }}"></script>
    <script src="{{ asset('assets/js/scrollbar.js') }}"></script>
    <script src="{{ asset('assets/js/TweenMax.min.js') }}"></script>
    <script src="{{ asset('assets/js/swiper.min.js') }}"></script>
    <script src="{{ asset('assets/js/jquery.ajaxchimp.min.js') }}"></script>
    <script src="{{ asset('assets/js/parallax-scroll.js') }}"></script>
    <script src="{{ asset('assets/js/script.js') }}"></script>

</body>
</html>
