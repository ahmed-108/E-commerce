@extends('layouts.Header_Website')
@section('Shop','active')
@section('page',str_replace('%20',' ',basename(Request::path())) )

@section('content')
    <!-- Start Product -->
    @foreach($NewestProducts as $product)
        <div class="product pt-4 pb-4">
        <div class="container">
            <div class="row mb-5">
                <!-- Start Left Side -->
                <div class="col-lg-6 col-md-6">
                    <div class="left">
                        <div class="slider slider-single">
                            <div class="item">
                                <img class="w-100"  src="{{$product->path}}" alt="">
                            </div>
                        </div>
                    </div>
                </div>
                <!-- End Left Side -->
                <!-- Start Right Side -->
                <div class="col-lg-6 col-md-6 mt-lg-0 mt-md-0 mt-sm-4 mt-4">
                    <div class="right">
                        @if ($errors->any())
                            <div class="alert alert-danger alert-block">
                                <button type="button" class="close" data-dismiss="alert">×</button>
                                <ul>
                                    @foreach ($errors->all() as $error)
                                        <li>{{ $error }}</li>
                                    @endforeach
                                </ul>
                            </div>
                        @endif
                        @if (Session::get('success'))
                            <div class="alert alert-success alert-block">
                                <button type="button" class="close" data-dismiss="alert">×</button>
                                <strong>{{ Session::get('success') }}</strong>
                            </div>
                        @endif
                        @if (session()->has('error'))
                            <div class="alert alert-danger alert-block">
                                <button type="button" class="close" data-dismiss="alert">×</button>
                                <strong>{{ Session::get('error') }}</strong>
                            </div>
                        @endif
                        <h1 class="mb-0">{{$product->title}}</h1>
                        <div class="d-flex align-items-center pt-3">
                            <div class="left text-left">
                                <strong>Category:</strong>
                                 <a class="category" href="/Shop/Category/{{$product->category}}"> {{$product->category}}</a> -
                                <a class="category" href="/Shop/Sub_Category/{{$product->sub_category_name}}"> {{$product->sub_category_name}}</a>
                            </div>
                            <div class="right text-right ml-auto">
                                <div class="rating">
                                    <i class="far fa-star"></i>
                                    <i class="far fa-star"></i>
                                    <i class="far fa-star"></i>
                                    <i class="far fa-star"></i>
                                    <i class="far fa-star"></i>
                                    <span>(25 reviews)</span>
                                </div>
                            </div>
                        </div>
                        <hr>
                        <div class="price pt-1 pb-1 d-flex align-items-center">
                            <span class="new mr-3">{{$product->price}} EPG</span>
                            @if(isset($product->old_price))
                                <span class="old mr-3">{{$product->old_price}}EPG</span>
                                <span class="persentage">{{$product->discount}}% Off</span>
                            @endif

                        </div>
                        <hr>
                        <div class="description pt-1 pb-1">
                            {{$product->short_description}}
                        </div>
                        <ul class="pt-4 pb-4 mb-0">
                            <li><i class='bx bx-sync mr-2'></i> 30 Day Return Policy</li>
                            <li><i class='bx bx-credit-card mr-2' ></i> Cash on Delivery available</li>
                        </ul>
                        <div class="size">
                            <span class="mr-2">Size</span>
                            <button class="active">S</button>
                            <button>M</button>
                            <button>L</button>
                            <button>XL</button>
                            <button>XXL</button>
                        </div>
                        <div class="d-flex align-items-center mt-4 mb-5">
                            <button type="submit" onclick="location.href='{{route('Add.To.Cart',[$product->product_id, auth('user')->id(),$product->price])}}';" class="add mr-2 ml-2">Add to Cart</button>
                        </div>
                        <hr>
                        <div class="stock mt-4">Availability: <span>8 Items In Stock</span></div>
                    </div>
                </div>
                <!-- End Right Side -->

            </div>

            <!-- Start Delivery -->
            <div class="delivery content mb-5">
                <div class="title">Packaging & Delivery</div>
                <p>{{$product->long_description}}</p>
            </div>
            <!-- End Delivery -->
        @endforeach
            <!-- Start Add-review -->
            <div class="add-review content mb-5">
                <div class="title">Add a review</div>
                <form method="post" action="{{route('post.comment')}}">
                    @csrf
                    <div class="textbox mb-3 mt-4 ">
                        <textarea placeholder="Write Comment" name="comment" class="w-100 h-100"></textarea>
                    </div>
                    <input type="number" class="mr-2 mb-3 number" min="1" max="5" value="1" name="rating">
                    <span>Star</span>
                    <input hidden type="text" name="user_id" value="{{auth('user')->id()}}">
                    <input type="text" hidden name="product_id" value="{{$product->product_id}}">
                    <div class="submit">
                        <button type="submit" >Submit Review</button>
                    </div>
                </form>

            </div>
            <!-- End Add-review -->

            <!-- Start Reviews -->
            <div class="reviews content mb-5">
                <div class="title">Reviews (3)</div>
                <div class="row mt-3 mb-5">

                    <!-- Start Left Side -->
                    <div class="col-lg-8 mb-lg-0 mb-5">
                        <div class="left">
                            @if ($errors->any())
                                <div class="alert alert-danger alert-block">
                                    <button type="button" class="close" data-dismiss="alert">×</button>
                                    <ul>
                                        @foreach ($errors->all() as $error)
                                            <li>{{ $error }}</li>
                                        @endforeach
                                    </ul>
                                </div>
                            @endif
                            @if (Session::get('success'))
                                <div class="alert alert-success alert-block">
                                    <button type="button" class="close" data-dismiss="alert">×</button>
                                    <strong>{{ Session::get('success') }}</strong>
                                </div>
                            @endif
                            @if (session()->has('error'))
                                <div class="alert alert-danger alert-block">
                                    <button type="button" class="close" data-dismiss="alert">×</button>
                                    <strong>{{ Session::get('error') }}</strong>
                                </div>
                            @endif
                            <div class="sub-title mt-4 mb-4">Customer Comments</div>
                            @foreach($comments as $comment)
                            <div class="row d-flex pt-3 pb-3 align-items-center">
                                <div class="left mr-3">
                                    <div>
                                        <img src="../../assets/images1/Profile/avatar-6.jpg" alt="">
                                        <h6 class="name mb-0 text-center mt-2">{{$comment->username}}</h6>
                                    </div>
                                </div>
                                <div class="right">
                                    <div class="rating">
                                        <div class="rating">
                                            <i class="far fa-star"></i>
                                            <i class="far fa-star"></i>
                                            <i class="far fa-star"></i>
                                            <i class="far fa-star"></i>
                                            <i class="far fa-star"></i>
                                            @if(isset($comment->rating))
                                            <span class="ml-2">( {{$comment->rating}} Star )</span>
                                            @endif
                                        </div>
                                    </div>
                                    <div class="comment mt-2 mb-2">
                                        {{$comment->comment}}
                                    </div>
                                    <div class="date">
                                        4/10/2021 at 3:12 PM
                                    </div>
                                    <div class="date">
                                        {{$comment->created_at->toDayDateTimeString()}}
                                    </div>
                                </div>
                            </div>
                            @endforeach
                        </div>
                    </div>
                    <!-- End Left Side -->

                    <!-- Start Right Side -->
                    <div class="col-lg-3">
                        <div class="right left">
                            <div class="sub-title mb-4">Customer Reviews</div>

                            <div class="rating mt-3 mb-4">
                                <i class="far fa-star"></i>
                                <i class="far fa-star"></i>
                                <i class="far fa-star"></i>
                                <i class="far fa-star"></i>
                                <i class="far fa-star"></i>
                                <span class="ml-2">50%</span>
                            </div>

                            <div class="progress w-100 d-flex align-items-center">
                                <span>5 Star</span>
                                <div class="progress-bar" role="progressbar" style="width: 25%;" aria-valuenow="25" aria-valuemin="0" aria-valuemax="100">25%</div>
                            </div>
                            <div class="progress w-100 d-flex align-items-center">
                                <span>4 Star</span>
                                <div class="progress-bar" role="progressbar" style="width: 40%;" aria-valuenow="40" aria-valuemin="0" aria-valuemax="100">40%</div>
                            </div>
                            <div class="progress w-100 d-flex align-items-center">
                                <span>3 Star</span>
                                <div class="progress-bar" role="progressbar" style="width: 20%;" aria-valuenow="20" aria-valuemin="0" aria-valuemax="100">20%</div>
                            </div>
                            <div class="progress w-100 d-flex align-items-center">
                                <span>2 Star</span>
                                <div class="progress-bar" role="progressbar" style="width: 10%;" aria-valuenow="10" aria-valuemin="0" aria-valuemax="100">10%</div>
                            </div>
                            <div class="progress w-100 d-flex align-items-center">
                                <span>1 Star</span>
                                <div class="progress-bar" role="progressbar" style="width: 5%;" aria-valuenow="5" aria-valuemin="0" aria-valuemax="100">5%</div>
                            </div>

                        </div>
                    </div>
                    <!-- End Right Side -->

                </div>
            </div>
            <!-- End Reviews -->

        </div>
    </div>
<!-- End Product -->
<!-- ------------------------------------------------------------------------------ -->
<!-- Start Related-product -->

<div class="related-product best-sell categories new-added">
    <div class="container">
        <div class="title">
            <span>Related</span> products
        </div>
        <div id="slider" class="slider row">
            @foreach($RelatedProducts as $product)
            <div class="item">
                <div class="box">
                    <div class="image-box">
                        @if(isset($product->discount))
                            <div class="persentage">-{{$product->discount}}%</div>
                        @endif
                        <a href="/Product/{{$product->product_id}}/{{$product->title}}">
                            <img src="{{$product->path}}" alt="">
                        </a>
                    </div>
                    <div class="info-box">
                        <a href="#" class="cart">
                            <div class="content">
                                <i class='bx bx-shopping-bag'></i>
                            </div>
                        </a>
                        <div class="category">
                            <div class="category">
                                <a href="/Shop/Category/{{$product->category}}">{{$product->category}}</a>
                                <span>-</span>
                                <a href="/Shop/Sub_Category/{{$product->sub_category_name}}">{{$product->sub_category_name}}</a>
                            </div>
                        </div>
                        <a href="#" class="Name">{{$product->title}}</a>
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
                            @if(isset($product->discount))
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


@endsection
