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
    <link rel="stylesheet" href="../../assets/vendor1/swiper/swiper.min.css">
    <link rel="shortcut icon" type="image/x-icon" href="../../assets/images1/icon.png">

    <!-- Main Css File -->
    <link rel="stylesheet" href="../../assets/css1/style.css">

    <title>Evara</title>

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
                    <a href="#">
                        <i class='bx bx-shopping-bag' ></i>
                        <div class="number">2</div>
                    </a>
                    <a href="#">
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
                    <li class="nav-item active">
                        <a class="nav-link" href="#">Home <span class="sr-only">(current)</span></a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#">About</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#">Shop</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#">Blogs</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="contact.html">Contact</a>
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

    <!-- Start Carousel -->
    <div class="container">
        <div class="owl-carousel owl-theme w-100">

            <div class="item ">
                <div class="row w-100 align-items-center">
                    <div class="col-lg-6">
                        <h4>Hot promotions</h4>
                        <h2>Big Deals From</h2>
                        <h1 class="title-1">Great Collection</h1>
                        <p>Save more with coupons & up to 20% off</p>
                        <div class="shop">
                            <a href="#">Shop Now</a>
                            <img src="{{ URL::asset('assets/images1/Slider/btn-brush-bg-2.png') }}" alt="">
                        </div>
                    </div>
                    <div class="col-lg-6">
                        <img src="{{ URL::asset('assets/images1/Slider/cover1.png') }}" alt="">
                    </div>
                </div>
            </div>
            <div class="item ">
                <div class="row w-100 align-items-center">
                    <div class="col-lg-6">
                        <h4>Trade-in offer</h4>
                        <h2>Supper value deals</h2>
                        <h1 class="title-2">On all products</h1>
                        <p>Save more with coupons & up to 70% off</p>
                        <div class="shop">
                            <a href="#">Shop Now</a>
                            <img src="{{ URL::asset('assets/images1/Slider/btn-brush-bg-3.png') }}" alt="">
                        </div>
                    </div>
                    <div class="col-lg-6">
                        <img src="{{ URL::asset('assets/images1/Slider/cover2.png') }}" alt="">
                    </div>
                </div>
            </div>
            <div class="item ">
                <div class="row w-100 align-items-center">
                    <div class="col-lg-6">
                        <h4>Upcoming Offer</h4>
                        <h2>Big Deals From</h2>
                        <h1 class="title-3">Manufacturer</h1>
                        <p>Clothing, Shoes, Bags, Wallets...</p>
                        <div class="shop">
                            <a href="#">Shop Now</a>
                            <img src="{{ URL::asset('assets/images1/Slider/btn-brush-bg-1.png') }}" alt="">
                        </div>
                    </div>
                    <div class="col-lg-6">
                        <img src="{{ URL::asset('assets/images1/Slider/cover3.png') }}" alt="">
                    </div>
                </div>
            </div>

        </div>
    </div>
    <!-- End Carousel -->

</div>
<!-- End Header -->
<!-- ------------------------------------------------------------------------------ -->

<!-- ------------------------------------------------------------------------------ -->
<!-- Start Featured -->
<div class="featured">
    <div class="container">
        <div class="row">

            <div class=" col-lg-2 col-md-4 col-sm-6 col-12 mb-lg-0 mb-3">
                <div class="box">
                    <img src="{{ URL::asset('assets/images1/Featured/feature-1.png ') }}" alt="">
                    <div class="title bg-1">Free Shipping</div>
                </div>
            </div>
            <div class=" col-lg-2 col-md-4 col-sm-6 col-12 mb-lg-0 mb-3">
                <div class="box">
                    <img src="{{ URL::asset('assets/images1/Featured/feature-2.png') }}" alt="">
                    <div class="title bg-2"> Online Order</div>
                </div>
            </div>
            <div class=" col-lg-2 col-md-4 col-sm-6 col-12 mb-lg-0 mb-3">
                <div class="box">
                    <img src="{{ URL::asset('assets/images1/Featured/feature-3.png') }}" alt="">
                    <div class="title bg-3"> Save Money</div>
                </div>
            </div>
            <div class=" col-lg-2 col-md-4 col-sm-6 col-12 mb-lg-0 mb-3">
                <div class="box">
                    <img src="{{ URL::asset('assets/images1/Featured/feature-4.png') }}" alt="">
                    <div class="title bg-4">Promotions</div>
                </div>
            </div>
            <div class=" col-lg-2 col-md-4 col-sm-6 col-12 mb-lg-0 mb-3">
                <div class="box">
                    <img src="{{ URL::asset('assets/images1/Featured/feature-5.png') }}" alt="">
                    <div class="title bg-5">Happy Sell</div>
                </div>
            </div>
            <div class=" col-lg-2 col-md-4 col-sm-6 col-12">
                <div class="box">
                    <img src="{{ URL::asset('assets/images1/Featured/feature-6.png') }}" alt="">
                    <div class="title bg-6">24/7 Support</div>
                </div>
            </div>

        </div>
    </div>
</div>
<!-- End Featured -->
<!-- ------------------------------------------------------------------------------ -->

<!-- ------------------------------------------------------------------------------ -->
<!-- Start New-Added -->
<div class="new-added">
    <div class="container">
        <div class="title">
            <span>New</span> Added
        </div>
        <div class="row">
            @foreach($NewestProducts as $newproducts)
            <div class="col-lg-3 col-md-6 col-12 mb-4">
                <div class="box">
                    <div class="image-box">
                        @if(isset($newproducts->discount))
                        <div class="persentage">-{{$newproducts->discount}} %</div>
                        @endif
                        <a href="#">
                            <img src="{{$newproducts->path}}" alt="">
                        </a>
                    </div>
                    <div class="info-box">
                        <a href="" class="cart">
                            <div class="content">
                                <i class='bx bx-shopping-bag'></i>
                            </div>
                        </a>
                        <div class="category">
                            <a href="#">{{$newproducts->category}}</a>
                            <span>-</span>
                            <a href="#">{{$newproducts->sub_category_name}}</a>
                        </div>
                        <a href="#" class="Name">{{$newproducts->title}}</a>
                        <div class="rating">
                            <i class="far fa-star"></i>
                            <i class="far fa-star"></i>
                            <i class="far fa-star"></i>
                            <i class="far fa-star"></i>
                            <i class="far fa-star"></i>
                            <span>90%</span>
                        </div>
                        <div class="price">
                            <span class="new-price">{{$newproducts->price}} EGP</span>
                            @if(isset($newproducts->old_price))
                            <span class="old-price">{{$newproducts->old_price}} EGP</span>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
            @endforeach

        </div>
    </div>
</div>
<!-- End New-Added -->
<!-- ------------------------------------------------------------------------------ -->

<!-- ------------------------------------------------------------------------------ -->
<!-- Start Bannar -->
<div class="bannar">
    <div class="container">
        <div class="content">
            <img src="{{ URL::asset('assets/images1/banner-4.png') }}" alt="">
            <div class="info">
                <div class="title">Repair Services</div>
                <h1>
                    We're an Apple
                    <br>
                    Authorised Service Provider
                </h1>
                <a href="#">
                    Shopping Now
                    <i class='bx bx-right-arrow-alt ml-2' ></i>
                </a>
            </div>
        </div>
    </div>
</div>
<!-- End Bannar -->
<!-- ------------------------------------------------------------------------------ -->

<!-- ------------------------------------------------------------------------------ -->
<!-- Start Categories -->
<div class="categories new-added">
    <div class="container">
        <div class="title mt-5">
            <span>Popular</span> Categories
        </div>
        <div class="slider row">
            @foreach($PopularCategories as $MostCategories)
            <div class="item">
                <div class="box">

                    <div class="image-box">
                        <a href="#">
                            <img src="{{$MostCategories->category_image}}" alt="">
                        </a>
                    </div>
                    <div class="name">
                        <a href="#">{{$MostCategories->category}}</a>
                    </div>
                </div>
            </div>
            @endforeach

        </div>
    </div>
</div>
<!-- End Categories -->
<!-- ------------------------------------------------------------------------------ -->

<!-- ------------------------------------------------------------------------------ -->
<!-- Start Offers -->
<div class="offers">
    <div class="container">
        <div class="row">

            <div class="col-lg-4 col-md-4 col-12 mb-lg-0 mb-3">
                <div class="box w-100">
                    <img class="w-100" src="{{ URL::asset('assets/images1/banars/banner-1.png') }}" alt="">
                    <div class="info">
                        <p>Smart Offer</p>
                        <div class="title">Save 20% on Woman Bag</div>
                        <a href="#">
                            Shop Now <i class="fas fa-long-arrow-alt-right ml-2"></i>
                        </a>
                    </div>
                </div>
            </div>
            <div class="col-lg-4 col-md-4 col-12 mb-lg-0 mb-3">
                <div class="box w-100">
                    <img class="w-100" src="{{ URL::asset('assets/images1/banars/banner-2.png') }}" alt="">
                    <div class="info">
                        <p>Sale off</p>
                        <div class="title">Great Summer Collection</div>
                        <a href="#">
                            Shop Now <i class="fas fa-long-arrow-alt-right ml-2"></i>
                        </a>
                    </div>
                </div>
            </div>
            <div class="col-lg-4 col-md-4 col-12">
                <div class="box w-100">
                    <img class="w-100" src="{{ URL::asset('assets/images1/banars/banner-3.png') }}" alt="">
                    <div class="info">
                        <p>New Arrivals</p>
                        <div class="title">Shop Today’s Deals & Offers</div>
                        <a href="#">
                            Shop Now <i class="fas fa-long-arrow-alt-right ml-2"></i>
                        </a>
                    </div>
                </div>
            </div>

        </div>
    </div>
</div>
<!-- End Offers -->
<!-- ------------------------------------------------------------------------------ -->

<!-- ------------------------------------------------------------------------------ -->
<!-- Start Best Sell -->
<div class="best-sell categories new-added">
    <div class="container">
        <div class="title">
            <span>Monthly</span> Best Sell
        </div>
        <div id="slider" class="slider row">

            <div class="item">
                <div class="box">
                    <div class="image-box">
                        <div class="persentage">-22%</div>
                        <a href="#">
                            <img src="{{ URL::asset('assets/images1/products/product-1-2.jpg') }}" alt="">
                        </a>
                    </div>
                    <div class="info-box">
                        <a href="#" class="cart">
                            <div class="content">
                                <i class='bx bx-shopping-bag'></i>
                            </div>
                        </a>
                        <div class="category">
                            <a href="#">Shirt</a>
                            <span>-</span>
                            <a href="#">Men's</a>
                        </div>
                        <a href="#" class="Name">Colorful Pattern Shirts</a>
                        <div class="rating">
                            <i class="far fa-star"></i>
                            <i class="far fa-star"></i>
                            <i class="far fa-star"></i>
                            <i class="far fa-star"></i>
                            <i class="far fa-star"></i>
                            <span>90%</span>
                        </div>
                        <div class="price">
                            <span class="new-price">$238.85</span>
                            <span class="old-price">$245.8</span>
                        </div>
                    </div>
                </div>
            </div>
            <div class="item">
                <div class="box">
                    <div class="image-box">
                        <div class="persentage">-30%</div>
                        <a href="#">
                            <img src="{{ URL::asset('assets/images1/products/product-2-2.jpg') }}" alt="">
                        </a>
                    </div>
                    <div class="info-box">
                        <a href="#" class="cart">
                            <div class="content">
                                <i class='bx bx-shopping-bag'></i>
                            </div>
                        </a>
                        <div class="category">
                            <a href="#">Scarf</a>
                            <span>-</span>
                            <a href="#">Men's</a>
                        </div>
                        <a href="#" class="Name">Colorful Pattern Scarf</a>
                        <div class="rating">
                            <i class="far fa-star"></i>
                            <i class="far fa-star"></i>
                            <i class="far fa-star"></i>
                            <i class="far fa-star"></i>
                            <i class="far fa-star"></i>
                            <span>90%</span>
                        </div>
                        <div class="price">
                            <span class="new-price">$256.85</span>
                            <span class="old-price">$368.8</span>
                        </div>
                    </div>
                </div>
            </div>
            <div class="item">
                <div class="box">
                    <div class="image-box">
                        <div class="persentage">-22%</div>
                        <a href="#">
                            <img src="{{ URL::asset('assets/images1/products/product-4-2.jpg') }}" alt="">
                        </a>
                    </div>
                    <div class="info-box">
                        <a href="#" class="cart">
                            <div class="content">
                                <i class='bx bx-shopping-bag'></i>
                            </div>
                        </a>
                        <div class="category">
                            <a href="#">Cap</a>
                            <span>-</span>
                            <a href="#">Men's</a>
                        </div>
                        <a href="#" class="Name">Colorful Pattern Cap</a>
                        <div class="rating">
                            <i class="far fa-star"></i>
                            <i class="far fa-star"></i>
                            <i class="far fa-star"></i>
                            <i class="far fa-star"></i>
                            <i class="far fa-star"></i>
                            <span>70%</span>
                        </div>
                        <div class="price">
                            <span class="new-price">$145.85</span>
                            <span class="old-price">$200.8</span>
                        </div>
                    </div>
                </div>
            </div>
            <div class="item">
                <div class="box">
                    <div class="image-box">
                        <div class="persentage">-34%</div>
                        <a href="#">
                            <img src="{{ URL::asset('assets/images1/products/product-6-2.jpg') }}" alt="">
                        </a>
                    </div>
                    <div class="info-box">
                        <a href="#" class="cart">
                            <div class="content">
                                <i class='bx bx-shopping-bag'></i>
                            </div>
                        </a>
                        <div class="category">
                            <a href="#">Shirt</a>
                            <span>-</span>
                            <a href="#">Men's</a>
                        </div>
                        <a href="#" class="Name">Colorful Pattern Shirts</a>
                        <div class="rating">
                            <i class="far fa-star"></i>
                            <i class="far fa-star"></i>
                            <i class="far fa-star"></i>
                            <i class="far fa-star"></i>
                            <i class="far fa-star"></i>
                            <span>86%</span>
                        </div>
                        <div class="price">
                            <span class="new-price">$658.85</span>
                            <span class="old-price">$700.8</span>
                        </div>
                    </div>
                </div>
            </div>
            <div class="item">
                <div class="box">
                    <div class="image-box">
                        <div class="persentage">-21%</div>
                        <a href="#">
                            <img src="{{ URL::asset('assets/images1/products/product-14-2.jpg') }}" alt="">
                        </a>
                    </div>
                    <div class="info-box">
                        <a href="#" class="cart">
                            <div class="content">
                                <i class='bx bx-shopping-bag'></i>
                            </div>
                        </a>
                        <div class="category">
                            <a href="#">Shoes</a>
                            <span>-</span>
                            <a href="#">Men's</a>
                        </div>
                        <a href="#" class="Name">Colorful Pattern Shoes</a>
                        <div class="rating">
                            <i class="far fa-star"></i>
                            <i class="far fa-star"></i>
                            <i class="far fa-star"></i>
                            <i class="far fa-star"></i>
                            <i class="far fa-star"></i>
                            <span>95%</span>
                        </div>
                        <div class="price">
                            <span class="new-price">$238.85</span>
                            <span class="old-price">$245.8</span>
                        </div>
                    </div>
                </div>
            </div>
            <div class="item">
                <div class="box">
                    <div class="image-box">
                        <div class="persentage">-50%</div>
                        <a href="#">
                            <img src="{{ URL::asset('assets/images1/products/product-15-2.jpg') }}" alt="">
                        </a>
                    </div>
                    <div class="info-box">
                        <a href="#" class="cart">
                            <div class="content">
                                <i class='bx bx-shopping-bag'></i>
                            </div>
                        </a>
                        <div class="category">
                            <a href="#">Shirt</a>
                            <span>-</span>
                            <a href="#">Men's</a>
                        </div>
                        <a href="#" class="Name">Colorful Pattern Shirts</a>
                        <div class="rating">
                            <i class="far fa-star"></i>
                            <i class="far fa-star"></i>
                            <i class="far fa-star"></i>
                            <i class="far fa-star"></i>
                            <i class="far fa-star"></i>
                            <span>98%</span>
                        </div>
                        <div class="price">
                            <span class="new-price">$165.85</span>
                            <span class="old-price">$245.8</span>
                        </div>
                    </div>
                </div>
            </div>
            <div class="item">
                <div class="box">
                    <div class="image-box">
                        <div class="persentage">-10%</div>
                        <a href="#">
                            <img src="{{ URL::asset('assets/images1/products/product-10-2.jpg') }}" alt="">
                        </a>
                    </div>
                    <div class="info-box">
                        <a href="#" class="cart">
                            <div class="content">
                                <i class='bx bx-shopping-bag'></i>
                            </div>
                        </a>
                        <div class="category">
                            <a href="#">Shirt</a>
                            <span>-</span>
                            <a href="#">Men's</a>
                        </div>
                        <a href="#" class="Name">Colorful Pattern Shirts</a>
                        <div class="rating">
                            <i class="far fa-star"></i>
                            <i class="far fa-star"></i>
                            <i class="far fa-star"></i>
                            <i class="far fa-star"></i>
                            <i class="far fa-star"></i>
                            <span>67%</span>
                        </div>
                        <div class="price">
                            <span class="new-price">$211.85</span>
                            <span class="old-price">$245.8</span>
                        </div>
                    </div>
                </div>
            </div>
            <div class="item">
                <div class="box">
                    <div class="image-box">
                        <div class="persentage">-22%</div>
                        <a href="#">
                            <img src="{{ URL::asset('assets/images1/products/product-9-2.jpg') }}" alt="">
                        </a>
                    </div>
                    <div class="info-box">
                        <a href="#" class="cart">
                            <div class="content">
                                <i class='bx bx-shopping-bag'></i>
                            </div>
                        </a>
                        <div class="category">
                            <a href="#">Shirt</a>
                            <span>-</span>
                            <a href="#">Men's</a>
                        </div>
                        <a href="#" class="Name">Colorful Pattern Shirts</a>
                        <div class="rating">
                            <i class="far fa-star"></i>
                            <i class="far fa-star"></i>
                            <i class="far fa-star"></i>
                            <i class="far fa-star"></i>
                            <i class="far fa-star"></i>
                            <span>90%</span>
                        </div>
                        <div class="price">
                            <span class="new-price">$238.85</span>
                            <span class="old-price">$245.8</span>
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </div>
</div>
<!-- End Best Sell -->
<!-- ------------------------------------------------------------------------------ -->

<!-- ------------------------------------------------------------------------------ -->
<!-- Start Footer -->
<div class="footer">

    <!-- Start Newsletter -->
    <div class="newsletter">
        <div class="container">
            <div class="row align-items-center justify-content-around">

                <div class="col-lg-5 col-md-6 mb-lg-0 mb-md-0 mb-3">
                    <div class="left text-left">
                        <img src="{{ URL::asset('assets/images1/Footer/icon-email.svg') }}" alt="">
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
                        <img class="logo" src="{{ URL::asset('assets/images1/logo.svg') }}" alt="">
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
                        <a href="#"><img src="{{ URL::asset('assets/images1/Footer/icon-facebook.svg') }}" alt=""></a>
                        <a href="#"><img src="{{ URL::asset('assets/images1/Footer/icon-instagram.svg') }}" alt=""></a>
                        <a href="#"><img src="{{ URL::asset('assets/images1/Footer/icon-pinterest.svg') }}" alt=""></a>
                        <a href="#"><img src="{{ URL::asset('assets/images1/Footer/icon-twitter.svg') }}" alt=""></a>
                        <a href="#"><img src="{{ URL::asset('assets/images1/Footer/icon-youtube.svg') }}" alt=""></a>
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
                                <img src="{{ URL::asset('assets/images1/Footer/app-store.jpg') }}" alt="">
                            </a>
                            <a href="#">
                                <img src="{{ URL::asset('assets/images1/Footer/google-play.jpg') }}" alt="">
                            </a>
                        </div>
                        <div class="text mb-3">
                            Secured Payment Gateways
                        </div>
                        <img class="payment" src="{{ URL::asset('assets/images1/Footer/payment-method.png') }}" alt="">
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
<script src="{{ URL::asset('assets/vendor1/jquery/jquery.min.js') }}"></script>
<script src="{{ URL::asset('assets/vendor1/bootstrap/popper.min.js') }}"></script>
<script src="{{ URL::asset('assets/vendor1/bootstrap/bootstrap.js') }}"></script>
<script src="{{ URL::asset('assets/vendor1/owl.carousel/owl.carousel.min.js') }}"></script>
<script src="{{ URL::asset('assets/vendor1/fontawesome/all.min.js') }}"></script>
<script src="{{ URL::asset('assets/vendor1/slick/slick.min.js') }}"></script>
<script src="{{ URL::asset('assets/vendor1/swiper/swiper.min.js') }}"></script>

<!-- Main Js Files -->
<script src="{{ URL::asset('assets/js1/main.js') }}"></script>
</body>
</html>
