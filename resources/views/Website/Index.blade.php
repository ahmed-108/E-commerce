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
                    <div class="shop">
                        <a href="{{url('/Shop')}}">Shop Now</a>
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
                    <div class="shop">
                        <a href="{{url('/Shop')}}">Shop Now</a>
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
                        <a href="{{url('/Shop')}}">Shop Now</a>
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
@if (Session::get('success'))
    <div class="alert alert-success alert-block">
        <button type="button" class="close" data-dismiss="alert">×</button>
        <strong>{{ Session::get('success') }}</strong>
    </div>
@endif
@if (Session::get('error'))
    <div class="alert alert-danger alert-block">
        <button type="button" class="close" data-dismiss="alert">×</button>
        <strong>{{ Session::get('error') }}</strong>
    </div>
@endif
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
                        <a href="/Product/{{$newproducts->id}}/{{$newproducts->title}}">
                            <img src="{{$newproducts->path}}" alt="">
                        </a>
                    </div>
                    <div class="info-box">
                        <a href="{{route('Add.To.Cart',[$newproducts->id, auth('user')->id(),$newproducts->price] ) }}" class="cart">
                            <div class="content">
                                <i class='bx bx-shopping-bag'></i>
                            </div>
                        </a>
                        <div class="category">
                            <a href="/Shop/Category/{{$newproducts->category}}">{{$newproducts->category}}</a>
                            <span>-</span>
                            <a href="/Shop/Sub_Category/{{$newproducts->sub_category_name}}">{{$newproducts->sub_category_name}}</a>
                        </div>
                        <a href="/Product/{{$newproducts->product_id}}/{{$newproducts->title}}" class="Name">{{$newproducts->title}}</a>
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
                        <a href="{{url('/Shop')}}">
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
                        <a href="{{url('/Shop')}}">
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
                        <a href="{{url('/Shop')}}">
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
            @foreach($popular_products as $product)
            <div class="item">
                <div class="box">
                    <div class="image-box">
                        @if(isset($product->discount))
                        <div class="persentage">-{{$product->discount}} %</div>
                        @endif
                        <a href="/Product/{{$product->product_id}}/{{$product->title}}">
                            <img src="{{$product->path}}" alt="">
                        </a>
                    </div>
                    <div class="info-box">
                        <a href="{{route('Add.To.Cart',[$product->product_id, auth('user')->id(),$product->price] ) }}" class="cart">
                            <div class="content">
                                <i class='bx bx-shopping-bag'></i>
                            </div>
                        </a>
                        <div class="category">
                            <a href="/Shop/Category/{{$product->category}}">{{$product->category}}</a>
                            <span>-</span>
                            <a href="/Shop/Sub_Category/{{$product->sub_category_name}}">{{$product->sub_category_name}}</a>
                        </div>
                        <a href="/Product/{{$product->product_id}}/{{$product->title}}" class="Name">{{$product->title}}</a>
                        <div class="rating">
                            <i class="far fa-star"></i>
                            <i class="far fa-star"></i>
                            <i class="far fa-star"></i>
                            <i class="far fa-star"></i>
                            <i class="far fa-star"></i>
                            <span>90%</span>
                        </div>
                        <div class="price">
                            <span class="new-price">{{$product->price}} EPG</span>
                            @if(isset($product->old_price))
                            <span class="old-price">{{$product->old_price}} EPG</span>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
            @endforeach
        </div>
    </div>
</div>
<!-- End Best Sell -->
<!-- ------------------------------------------------------------------------------ -->

@endsection
