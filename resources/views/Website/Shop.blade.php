@extends('layouts.Header_Website')
@section('Shop','active')
@section('content')
    @section('page',basename(Request::path()))
<!-- Start Shop -->
<div class="shop pt-5 pb-5">
    <div class="container">
        <div class="row">

            <!-- Start Left -->
            <div class="col-lg-9 mb-lg-0 mb-4">
                <div class="left">

                    <!-- Start Header -->
                    <div class="header d-flex align-content-center">
                        <div class="title text-left d-flex align-items-center">
                            We found <strong class="ml-1 mr-1">{{$count}}</strong> items for you!
                        </div>
                        <div class="button text-right ml-auto">
                            <img src="../../assets/images1/sort.png" alt="">
                            <div class="dropdown">
                                <button class="btn dropdown-toggle" type="button" id="dropdownMenu2" data-toggle="dropdown" aria-expanded="false">
                                    Sort by:
                                    @if(Request::get('sort')=="price_asc")
                                        Price: Low to Heigh
                                    @elseif(Request::get('sort')=="price_desc")
                                        Price: Heigh to Low
                                    @elseif(Request::get('sort')=="product_oldest")
                                        Date: Old to New
                                    @elseif(Request::get('sort')=="product_newest")
                                        Date: New to Old
                                    @elseif(Request::get('sort')=="lowest_rating")
                                        Rating: Low to Heigh
                                    @elseif(Request::get('sort')=="highest_rating")
                                        Rating: Heigh to Low
                                    @elseif(Request::get('sort')== null)
                                        Featured
                                    @endif
                                </button>
                                <div class="dropdown-menu" aria-labelledby="dropdownMenu2">
                                    <a href="{{url()->current()."?sort=price_asc"}}" class="dropdown-item" >Price: Low to Heigh</a>
                                    <a href="{{url()->current()."?sort=price_desc"}}" class="dropdown-item" >Price: Heigh to Low</a>
                                    <a href="{{url()->current()."?sort=product_oldest"}}" class="dropdown-item" >Date: Old to New</a>
                                    <a href="{{url()->current()."?sort=product_newest"}}" class="dropdown-item" type="button">Date: New to Old</a>
                                    <a href="{{url()->current()."?sort=lowest_rating"}}" class="dropdown-item" type="button">Rating: Low to Heigh</a>
                                    <a href="{{url()->current()."?sort=highest_rating"}}" class="dropdown-item" type="button">Rating: Heigh to Low</a>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- End Header -->
                    <!-- Start Items -->
                    <div class="items new-added">
                        <div class="row">
                            @foreach($NewestProducts as $newproducts)
                                <div class="col-lg-3 col-md-6 col-12 mb-4">
                                    <div class="box">
                                        <div class="image-box">
                                            @if(isset($newproducts->discount))
                                                <div class="persentage">-{{$newproducts->discount}} %</div>
                                            @endif
                                            <a href="/Product/{{$newproducts->product_id}}/{{$newproducts->title}}">
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
                                                <a href="/Shop/Category/{{$newproducts->category}}">{{$newproducts->category}}</a>
                                                <span>-</span>
                                                <a href="/Shop/Sub_Category/{{$newproducts->sub_category_name}}">{{$newproducts->sub_category_name}}</a>
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
                    <!-- End Items -->

                    <!-- Start Pagination -->

                    <div class="pagination">
                        <nav class="m-auto" aria-label="Page navigation example">
                            {{$NewestProducts->links()}}
                        </nav>
                    </div>
                    <!-- ENd Pagination -->

                </div>
            </div>
            <!-- End Left -->

            <!-- Start Right -->
            <div class="col-lg-3">
                <div class="right">
                    @include('layouts.Listctageories')
                    <!-- Start Filter -->
                    <div class="list-box filter mb-3">
                        <div class="title">Fill By Price</div>
                        <form action="" class="mt-5">
                            <input type="number" id="slideprice" class="js-range-slider" name="my_range" value="" />
                            <input class="min" id="min" type="text" value="100">
                            <input class="max" id="max" type="text" value="1000">
                            <button type="submit" class="mt-4"><i class='bx bx-filter-alt mr-2'></i>Filter</button>
                        </form>
                    </div>
                    <!-- End Filter -->

                    <!-- Start Banar -->
                    <div class="banar">
                        <img src="../../assets/images1/banars/banner-11.jpg" alt="">
                        <div class="info">
                            <div>
                                <p>Women Zone</p>
                                <h4>Save 17% on Office Dress</h4>
                                <a href="#">Shop Now <i class="fas fa-long-arrow-alt-right ml-1"></i></a>
                            </div>
                        </div>
                    </div>
                    <!-- End Banar -->

                </div>
            </div>
            <!-- End Right -->

        </div>
    </div>
</div>
<!-- End Shop -->
<!-- ------------------------------------------------------------------------------ -->

<!-- ------------------------------------------------------------------------------ -->
@endsection
