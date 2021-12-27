<html lang="en">
<head>
    <!-- Meta Tags -->
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- Vendor Css Files -->
    <link rel="stylesheet" href="../../assets/vendor1/bootstrap/bootstrap.css">
    <link rel="stylesheet" href="../../assets/vendor1/fontawesome/all.css">
    <link rel="stylesheet" href="../../assets/vendor1/boxicons/css/boxicons.min.css">
    <link rel="stylesheet" href="../../assets/vendor1/owl.carousel/owl.carousel.min.css">
    <link rel="stylesheet" href="../../assets/vendor1/slick/slick.css">
    <link rel="stylesheet" href="../../assets/vendor1/ion.rangeSlider-master/css/ion.rangeSlider.min.css">
    <link rel="shortcut icon" type="image/x-icon" href="../../assets/images1/icon.png">
    <link rel="stylesheet" href="../../assets/vendor1/swiper/swiper.min.css">

    <!-- Main Css File -->
    <link rel="stylesheet" href="../../assets/css1/style.css">
    <link rel="stylesheet" href="../../assets/css1/shop.css">
    <link rel="stylesheet" href="../../assets/css1/single-product.css">
    <link rel="stylesheet" href="../../assets/css1/cart.css">
    <link rel="stylesheet" href="../../assets/css1/checkout.css">
    <link rel="stylesheet" href="../../assets/css1/about.css">
    <link rel="stylesheet" href="../../assets/css1/my-Account.css">
    <link rel="stylesheet" href="../../assets/css1/contact.css">


    <title> Evara </title>

</head>
<body id="scroll">

<!-- ------------------------------------------------------------------------------ -->
<!-- Start Header -->
<div class="header">

    <!-- Start Top bar -->
    <div class="top-bar">
        <img src="{{ URL::asset('assets/images1/topbar-bg.jpg') }}" alt="">
        <div class="container">
            <div class="row">
                <div class="left col-lg-6 col-md-6 col-sm-6 col-12 text-lg-left text-md-left text-sm-left  text-center mb-lg-0 mb-md-0 mb-sm-0 mb-3">
                            <span>
                                <a href="#">
                                    <i class='bx bx-mobile'></i> (+01) - 2345 - 6789
                                </a>
                            </span>
                    <span>
                                <a href="#">
                                    <i class='bx bx-location-plus'></i> Our location
                                </a>
                            </span>
                </div>
                @if (auth('user')->check())
                    <div class="right col-lg-6 col-md-6 col-sm-6 col-12 text-lg-right text-md-right text-sm-right  text-center">
                        <div>
                            <i class='bx bx-user' ></i>
                            <span href="#">{{auth('user')->user()->username}}</span>
                            <span>/</span>
                            <i class='bx bx-log-out' ></i>

                            <a href="{{route('logout')}}">Logout</a>
                        </div>
                    </div>
                @else
                    <div class="right col-lg-6 col-md-6 col-sm-6 col-12 text-lg-right text-md-right text-sm-right  text-center">
                        <div>
                            <i class='bx bx-user' ></i>
                            <a href="{{route('user.login')}}">Log In</a>
                            <span>/</span>
                            <a href="{{route('user.signup')}}">Sign Up</a>
                        </div>
                    </div>
                @endif
            </div>
        </div>
    </div>
    <!-- End Top bar -->

    <!-- Start Search bar -->
    <div class="search-bar">
        <div class="container">
            <div class="row align-items-center">

                <div class="col-lg-3 col-md-3 col-sm-3 col-5 text-left">
                    <img class="logo" src="{{ URL::asset('assets/images1/logo.svg') }}" alt="">
                </div>

                <div class="col-6 search">
                    <form action="">
                        <div class="input-group">
                            <input type="text" class="form-control" placeholder="Search ...">
                            <i class='bx bx-search-alt'></i>
                        </div>
                    </form>
                </div>

                <div class="col-lg-3 col-md3 col-sm-3 col-7 text-right right">
                    <a href="#">
                        <i class='bx bx-heart'></i>
                        <div class="number">4</div>
                    </a>
                    <a href="{{url('/Cart')}}">
                        <i class='bx bx-shopping-bag' ></i>
                        <div class="number">{{$Count_cart}}</div>
                    </a>
                    <a href="{{url('Profile')}}">
                        <i class='bx bx-user' ></i>
                    </a>
                </div>

            </div>
        </div>
    </div>
    <!-- End Search bar -->

    <!-- Start Navbar -->
    <nav class="navbar navbar-expand-lg navbar-light">
        <div class="container">

            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>

            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <ul class="navbar-nav mr-auto">
                    <li class="nav-item @yield('Home')">
                        <a class="nav-link" href="/">Home <span class="sr-only">(current)</span></a>
                    </li>
                    <li class="nav-item @yield('About')">
                        <a class="nav-link" href="{{url('/aboutus')}}">About</a>
                    </li>
                    <li class="nav-item @yield('Shop')">
                        <a class="nav-link" href="{{url('/Shop')}}">Shop</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link @yield('Contact')" href="{{url('/contactus')}}">Contact</a>
                    </li>
                </ul>
                <form action="" class="mt-2 mb-2">
                    <div class="input-group">
                        <input type="text" class="form-control" placeholder="Search ...">
                    </div>
                </form>
            </div>

            <div class="right">
                <i class='bx bx-headphone' ></i>
                Hotline <span>1900 - 888</span>
            </div>

        </div>
    </nav>
    <!-- End Navbar -->


</div>
<!-- End Header -->
@if(View::hasSection('page'))
        <div class="breadcrumb">
            <div class="container d-flex">
                <li>
                    <a href="/">Home</a>
                </li>
                <i class="fas fa-angle-right"></i>
                <li>
                    <a class="categ" href="{{basename(Request::path())}}">@yield('page')</a>
                </li>
            </div>
        </div>
@else
@endif

@yield('content')

<!-- Start Footer -->
<div class="footer">

    <!-- Start Newsletter -->
    <div class="newsletter">
        <div class="container">
            <div class="row align-items-center justify-content-around">

                <div class="col-lg-5 col-md-6 mb-lg-0 mb-md-0 mb-3">
                    <div class="left text-left">
                        <img src="../../assets/images1/Footer/icon-email.svg" alt="">
                        <span class="ml-2">Sign up to Newsletter</span>
                    </div>
                </div>
                <div class="col-lg-5 col-md-6 text-right">
                    <div class="right">
                        <form action="" class="mb-0">
                            <div class="input-group">
                                <input type="email" placeholder="Enter your email ..">
                                <button type="submit">Subscribe</button>
                            </div>
                        </form>
                    </div>
                </div>

            </div>
        </div>
    </div>
    <!-- End Newsletter -->

    <!-- --------------------------- -->

    <!-- Start Section -->
    <div class="section">
        <div class="container">
            <div class="row">

                <div class="col-lg-4 col-md-6 col-12">
                    <div class="contact">
                        <img class="logo" src="../../assets/images1/logo.svg" alt="">
                        <div class="subtitle">Contact</div>
                        <div class="text">
                            <strong>Address: </strong>562 Wellington Road, Street 32, San Francisco
                        </div>
                        <div class="text">
                            <strong>Phone: </strong>+01 2222 365 /(+91) 01 2345 6789
                        </div>
                        <div class="text">
                            <strong>Hours: </strong>10:00 - 18:00, Mon - Sat
                        </div>
                        <div class="subtitle">Follow Us</div>
                        <a href="#"><img src="../../assets/images1/Footer/icon-facebook.svg" alt=""></a>
                        <a href="#"><img src="../../assets/images1/Footer/icon-instagram.svg" alt=""></a>
                        <a href="#"><img src="../../assets/images1/Footer/icon-pinterest.svg" alt=""></a>
                        <a href="#"><img src="../../assets/images1/Footer/icon-twitter.svg" alt=""></a>
                        <a href="#"><img src="../../assets/images1/Footer/icon-youtube.svg" alt=""></a>
                    </div>
                </div>
                <div class="col-lg-2 col-md-3 col-12">
                    <div class="about">
                        <h4 class="title">About</h4>
                        <a href="#">About Us</a>
                        <a href="#">Delivery Information</a>
                        <a href="#">Privacy Policy</a>
                        <a href="#">Terms & Conditions</a>
                        <a href="#">Contact Us</a>
                        <a href="#">Support Center</a>
                    </div>
                </div>
                <div class="col-lg-2 col-md-3 col-12">
                    <div class="account about">
                        <h4 class="title">My Account</h4>
                        <a href="#">Sign In</a>
                        <a href="#">View Cart</a>
                        <a href="#">My Wishlist</a>
                        <a href="#">Track My Order</a>
                        <a href="#">Help</a>
                        <a href="#">Order</a>
                    </div>
                </div>
                <div class="col-lg-4 col-12">
                    <div class="about install">
                        <h4 class="title">Install App</h4>
                        <div class="text">
                            From App Store or Google Play
                        </div>
                        <div class="app">
                            <a href="#">
                                <img src="../../assets/images1/Footer/app-store.jpg" alt="">
                            </a>
                            <a href="#">
                                <img src="../../assets/images1/Footer/google-play.jpg" alt="">
                            </a>
                        </div>
                        <div class="text mb-3">
                            Secured Payment Gateways
                        </div>
                        <img class="payment" src="../../assets/images1/Footer/payment-method.png" alt="">
                    </div>
                </div>

            </div>
        </div>
    </div>
    <!-- Start Section -->

    <!-- ----------------------------- -->

    <!-- Start Copy right -->
    <div class="container">
        <div class="copy-right">
            <div class="row">

                <div class="col-lg-6 col-md-6 col-12">
                    <div class="left text-lg-left text-md-left text-sm-center text-center mb-lg-0 mb-md-0 mb-2">
                        © 2021, Evara - Faculty of computers and information team
                    </div>
                </div>
                <div class="col-lg-6 col-md-6 col-12">
                    <div class="right text-lg-right text-md-right text-sm-center text-center">
                        Designed by <Strong>Abdalla Fathy</Strong> - All rights reserved
                    </div>
                </div>

            </div>
        </div>
    </div>
    <!-- Start Copy right -->

</div>
<!-- End Footer -->
<!-- ------------------------------------------------------------------------------ -->

<!-- ------------------------------------------------------------------------------ -->
<!-- Start Scrolltop -->
<i class="scroll fas fa-angle-up"></i>
<!-- ENd Scrolltop -->
<!-- ------------------------------------------------------------------------------ -->

<!-- ------------------------------------------------------------------------------ -->
<!-- Start Loading -->
<div class="box-loading">
    <div class="loader">
        <div class="inner one"></div>
        <div class="inner two"></div>
        <div class="inner three"></div>
    </div>
</div>
<!-- End Loading -->
<!-- ------------------------------------------------------------------------------ -->

<!-- --------------------------------------------------------------------------- -->
<!-- Vendor Js Files -->
<script src="../../assets/vendor1/jquery/jquery.min.js"></script>
<script src="../../assets/vendor1/bootstrap/popper.min.js"></script>
<script src="../../assets/vendor1/bootstrap/bootstrap.js"></script>
<script src="../../assets/vendor1/owl.carousel/owl.carousel.min.js"></script>
<script src="../../assets/vendor1/fontawesome/all.min.js"></script>
<script src="../../assets/vendor1/slick/slick.min.js"></script>
<script src="../../assets/vendor1/swiper/swiper.min.js"></script>

<!-- Main Js Files -->
<script src="../../assets/js1/main.js"></script>
</body>
</html>
