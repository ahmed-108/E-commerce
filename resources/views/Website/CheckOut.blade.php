@extends('layouts.Header_Website')
@section('Home','active')
@section('content')
    <!-- Start Breadcrumb -->
    <div class="breadcrumb">
        <div class="container d-flex">
            <li>
                <a href="index.html">Home</a>
            </li>
            <i class="fas fa-angle-right"></i>
            <li>
                <a href="#">Shop</a>
            </li>
            <i class="fas fa-angle-right"></i>
            <li>
                <a href="#">CheckOut</a>
            </li>

        </div>
    </div>
    <!-- End Breadcrumb -->
    <!-- ------------------------------------------------------------------------------ -->

    <!-- ------------------------------------------------------------------------------ -->
    <!-- Start CheckOut -->
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
    <div class="checkout mb-5 mt-5">
        <div class="container">
            @if($count_checkout==0)
                <form method="post" action="{{route('confirm.order')}}">
                    @csrf
                    <div class="row">
                        <!-- Start Left Section -->
                        <div class="col-lg-6 mb-lg-0 mb-4">
                            <div class="left">
                                <div class="title mb-4">
                                    <img src="../../assets/images1/form/form.png" alt="">
                                    Billing Details
                                </div>
                                <div class="form-group">
                                    <img src="../../assets/images1/form/name.png" alt="">
                                    <input type="text" name="full_name" value="" class="form-control" placeholder="Full Name *"
                                           required>
                                    <input hidden type="text" name="user_id" value="{{auth('user')->user()->id}}" class="form-control" placeholder="Full Name *"
                                           required>
                                </div>
                                <div class="form-group">
                                    <img src="../../assets/images1/form/phone.png" alt="">
                                    <input type="number" value="" name="phone1" class="form-control"
                                           placeholder="Your Phone (1) *" required>
                                </div>
                                <div class="form-group">
                                    <img src="../../assets/images1/form/phone.png" alt="">
                                    <input type="number" value="" name="phone2" class="form-control"
                                           placeholder="Your Phone (2)">
                                </div>
                                <div class="row pl-0 pr-0">
                                    <div class="col-md-6 pl-0 pr-lg-2 pr-md-2 pr-sm-0 pr-0">
                                        <div class="form-group">
                                            <img src="../../assets/images1/form/country.png" alt="">
                                            <input type="text" value="" name="country" class="form-control"
                                                   placeholder="Your Country *"
                                                   required>
                                        </div>
                                    </div>
                                    <div class="col-md-6 pr-0 pl-lg-2 pl-md-2 pl-sm-0 pl-0">
                                        <div class="form-group">
                                            <img src="../../assets/images1/form/city.png" alt="">
                                            <input type="text" value="" name="city" class="form-control"
                                                   placeholder="Your City *" required>
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <img src="../../assets/images1/form/code-zip.png" alt="">
                                    <input type="text" value="" name="zip_code" class="form-control"
                                           placeholder="Postcode / Zip *" required>
                                </div>
                                <div class="form-group">
                                    <img src="../../assets/images1/form/address.png" alt="">
                                    <input type="text" value="" name="full_address" class="form-control"
                                           placeholder="Your Address *" required>
                                </div>
                                <div class="form-group notes">
                                    <textarea class="form-control" name="notes" rows="6"
                                              placeholder="Order Notes ..."></textarea>
                                </div>
                            </div>
                        </div>
                        <!-- End Left Section -->

                        <!-- Start Right Section -->
                        <div class="col-lg-6">
                            <div class="right">
                                <div class="title mb-4">
                                    <img src="../../assets/images1/form/orders.png" alt="">
                                    Your Orders
                                </div>

                                <!-- Start Table -->
                                <div class="table-responsive-md mb-4">
                                    <table class="table table-bordered text-center">
                                        <thead>
                                        <tr>
                                            <th colspan="2">Product</th>
                                            <th scope="col">total</th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                        @foreach($Products_Cart as $products)
                                        <tr>
                                            <td><img src="{{$products->path}}" alt=""></td>
                                            <td class="name">
                                                {{$products->title}}
                                                <p>x {{$products->quantity}}</p>
                                            </td>
                                            <td class="price">{{$products->Sub_total}} EPG</td>
                                        </tr>
                                        @endforeach

                                        <!-- Strat Total -->
                                        <tr>
                                            <td colspan="1">
                                                Total
                                            </td>
                                            <td colspan="2" class="total-price">
                                                <span>{{$total_price}} EPG</span> + Shipping Expenses
                                            </td>
                                        </tr>
                                        <!-- End Total -->
                                        </tbody>
                                    </table>
                                </div>
                                <!-- End Table -->

                                <!-- Start Payment -->
                                <div class="payment">
                                    <div class="title mb-3">
                                        <img src="../../assets/images1/form/payment.png" alt="">
                                        Payment
                                    </div>
                                    <div class="form-check">
                                        <input class="form-check-input" type="radio" name="payment_method" value="cash" id="cash"
                                            checked>
                                        <label class="form-check-label" for="cash">
                                            Cash
                                        </label>
                                        <input hidden type="text" name="user_id"  value="{{auth('user')->user()->id}}">
                                    </div>
                                    <div class="form-check">
                                        <input class="form-check-input" type="radio" value="paypal" name="payment_method" id="paypal">
                                        <label class="form-check-label" for="paypal">
                                            Paypal
                                        </label>
                                    </div>
                                </div>
                                <!-- End Payment -->
                                <!-- Start Submit -->
                                <button type="submit" class="submit mt-4">
                                    Place Order
                                </button>
                                <!-- End Submit -->

                            </div>
                        </div>
                        <!-- End Right Section -->

                    </div>
                </form>
            @endif
            @foreach($billing_details as $data)
            <form method="post" action="{{route('confirm.order')}}">
                @csrf
                <div class="row">
                    <!-- Start Left Section -->
                    <div class="col-lg-6 mb-lg-0 mb-4">
                        <div class="left">
                            <div class="title mb-4">
                                <img src="../../assets/images1/form/form.png" alt="">
                                Billing Details
                            </div>

                                <div class="form-group">
                                    <img src="../../assets/images1/form/name.png" alt="">
                                    <input type="text" name="full_name" value="{{$data->full_name}}" class="form-control" placeholder="Full Name *"
                                           required>
                                    <input type="text" hidden name="user_id" value="{{auth('user')->user()->id}}" class="form-control" placeholder="Full Name *"
                                           required>
                                </div>
                                <div class="form-group">
                                    <img src="../../assets/images1/form/phone.png" alt="">
                                    <input type="number" value="{{$data->phone1}}" name="phone1" class="form-control"
                                           placeholder="Your Phone (1) *" required>
                                </div>
                                <div class="form-group">
                                    <img src="../../assets/images1/form/phone.png" alt="">
                                    <input type="number" value="{{$data->phone2}}" name="phone2" class="form-control"
                                           placeholder="Your Phone (2)">
                                </div>
                                <div class="row pl-0 pr-0">
                                    <div class="col-md-6 pl-0 pr-lg-2 pr-md-2 pr-sm-0 pr-0">
                                        <div class="form-group">
                                            <img src="../../assets/images1/form/country.png" alt="">
                                            <input type="text" value="{{$data->country}}" name="country" class="form-control"
                                                   placeholder="Your Country *"
                                                   required>
                                        </div>
                                    </div>
                                    <div class="col-md-6 pr-0 pl-lg-2 pl-md-2 pl-sm-0 pl-0">
                                        <div class="form-group">
                                            <img src="../../assets/images1/form/city.png" alt="">
                                            <input type="text" value="{{$data->city}}" name="city" class="form-control"
                                                   placeholder="Your City *" required>
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <img src="../../assets/images1/form/code-zip.png" alt="">
                                    <input type="text" value="{{$data->zip_code}}" name="zip_code" class="form-control"
                                           placeholder="Postcode / Zip *" required>
                                </div>
                                <div class="form-group">
                                    <img src="../../assets/images1/form/address.png" alt="">
                                    <input type="text" value="{{$data->full_address}}" name="full_address" class="form-control"
                                           placeholder="Your Address *" required>
                                </div>
                                <div class="form-group notes">
                                    <textarea class="form-control" name="notes" rows="6"
                                              placeholder="Order Notes ...">{{$data->notes}}</textarea>
                                </div>
                        </div>
                    </div>
                    <!-- End Left Section -->

                    <!-- Start Right Section -->
                    <div class="col-lg-6">
                        <div class="right">
                            <div class="title mb-4">
                                <img src="../../assets/images1/form/orders.png" alt="">
                                Your Orders
                            </div>

                            <!-- Start Table -->
                            <div class="table-responsive-md mb-4">
                                <table class="table table-bordered text-center">
                                    <thead>
                                    <tr>
                                        <th colspan="2">Product</th>
                                        <th scope="col">total</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    @foreach($Products_Cart as $products)
                                        <tr>
                                            <td><img src="{{$products->path}}" alt=""></td>
                                            <td class="name">
                                                {{$products->title}}
                                                <p>x {{$products->quantity}}</p>
                                            </td>
                                            <td class="price">{{$products->Sub_total}} EPG</td>
                                        </tr>
                                    @endforeach

                                    <!-- Strat Total -->
                                    <tr>
                                        <td colspan="1">
                                            Total
                                        </td>
                                        <td colspan="2" class="total-price">
                                            <span>{{$total_price}} EPG</span> + Shipping Expenses
                                        </td>
                                    </tr>
                                    <!-- End Total -->
                                    </tbody>
                                </table>
                            </div>
                            <!-- End Table -->

                            <!-- Start Payment -->
                            <div class="payment">
                                <div class="title mb-3">
                                    <img src="../../assets/images1/form/payment.png" alt="">
                                    Payment
                                </div>
                                <div class="form-check">
                                    <input class="form-check-input" type="radio" name="payment_method" value="cash" id="cash"
                                        {{ ($data->payment_method=="cash")? "checked" : "" }}>
                                    <label class="form-check-label" for="cash">
                                        Cash
                                    </label>
                                </div>
                                <div class="form-check">
                                    <input class="form-check-input" {{ ($data->payment_method=="paypal")? "checked" : "" }}
                                    type="radio" value="paypal" name="payment_method" id="paypal">
                                    <label class="form-check-label" for="paypal">
                                        Paypal
                                    </label>
                                </div>
                            </div>
                            <!-- End Payment -->

                            <!-- Start Submit -->
                            <button type="submit" class="submit mt-4">
                                Place Order
                            </button>
            <!-- End Submit -->

        </div>
    </div>
    <!-- End Right Section -->

    </div>
    </form>
            @endforeach

    <!-- End CheckOut -->
    <!-- ------------------------------------------------------------------------------ -->

    <!-- ------------------------------------------------------------------------------ -->
@endsection
