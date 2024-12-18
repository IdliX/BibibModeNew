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
                    <div class="nav-logo"><a href="{{ route('landing') }}"><h3>Bibib Mode</h3></a></div>
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

        <section class="tracking-section">
        <div class="container mt-5">
            <div class="card">
                <div class="card-header">
                    <h2>Tracking Pesanan</h2>
                </div>
                <div class="card-body">

                    <!-- Menampilkan pesan error jika ada -->
                    @if(session('error'))
                        <div class="alert alert-danger">
                            {{ session('error') }}
                        </div>
                    @endif

                    <!-- Form tracking -->
                    <form method="POST" action="{{ route('tracking.search') }}">
                        @csrf
                        <div class="form-group">
                            <label for="tracking_number">Masukkan Tracking Number:</label>
                            <input type="text" 
                                   id="tracking_number" 
                                   name="tracking_number" 
                                   class="form-control" 
                                   placeholder="Masukkan nomor resi Anda" 
                                   required>
                        </div>
                        <button type="submit" class="btn btn-primary mt-3">Cari</button>
                    </form>

                    <!-- Menampilkan hasil pencarian -->
                    @if(isset($orderStatuses) && $orderStatuses->isNotEmpty())
                        <h3 class="mt-4">Hasil Pencarian:</h3>
                        <table class="table table-bordered mt-3">
                            <thead>
                                <tr>
                                    <th>Status</th>
                                    <th>Tanggal Status</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($orderStatuses as $status)
                                    <tr>
                                        <td>{{ $status->status_code }}</td>
                                        <td>{{ \Carbon\Carbon::parse($status->status_date)->format('d M Y') }}</td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    @elseif(isset($orderStatuses)) {{-- Jika tidak ada data --}}
                        <div class="alert alert-warning mt-4">
                            Tidak ada data ditemukan untuk nomor resi ini.
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </section>

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
