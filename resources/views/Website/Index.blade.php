@extends('layouts.Header_Website')
@section('Home','active')
@section('content')
<!-- ------------------------------------------------------------------------------ -->
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

@endsection
