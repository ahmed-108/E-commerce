@extends('layouts.Header_Website')
@section('Home','active')
@section('content')
    @section('page','My Account')
<!-- Start Account -->
<div class="account mt-5 mb-5">
    <div class="container">
        <div class="row">

            <!-- Start Tabs -->
            <div class="col-lg-3 col-md-4 mb-lg-0 mb-md-0 mb-4">
                <div class="tabs">
                    <li class="active dashboard">
                        <i class='bx bx-slider-alt mr-2'></i>
                        Dashboard
                    </li>
                    <li class="orders">
                        <i class='bx bx-shopping-bag mr-2'></i>
                        Orders
                    </li>
                    <li class="details">
                        <i class='bx bx-user mr-2'></i>
                        Account Details
                    </li>
                    <a href="{{url('/logout')}}">
                        <li>
                            <i class='bx bx-log-out mr-2'></i>
                            Logout
                        </li>
                    </a>
                </div>
            </div>
            <!-- End Tabs -->

            <!-- ------------------------------------------ -->

            <!-- Start Pages -->
            <div class="col-lg-9 col-md-8">
                <div class="pages">
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
                    <!-- Start Dashboard -->
                    <div class="dashboard page active">
                        <div class="image-box mb-4">
                            <img src="../../assets/images1/profile.png" alt="">
                            <span class="ml-3">Hello {{auth('user')->user()->username}}!</span>
                        </div>
                        <div class="info">
                            <p>From your account dashboard. you can easily view your <span>orders</span></p>
                            <p>manage your <span>Account Details</span> and <span>Edit Your Profile</span></p>
                            <p class="mt-3"><strong>Please make sure to fill in your <span>account details</span> carefully</strong></p>
                        </div>
                    </div>
                    <!-- End Dashboard -->

                    <!-- Start Orders -->
                    <div class="orders page">
                        <div class="card">
                            <div class="card-header">
                                Your Orders
                            </div>
                            <div class="card-body">
                                <table class="table table-striped table-bordered table-hover table-responsive-md">
                                    <thead>
                                    <tr>
                                        <th scope="col">Order</th>
                                        <th scope="col">Date</th>
                                        <th scope="col">Status</th>
                                        <th scope="col">Total</th>
                                        <th scope="col">Items</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    @foreach($orders as $order)
                                    <tr>
                                        <td># {{$order->id}}</td>
                                        <td> {{$order->created_at->format('d.m.Y')}}</td>
                                        @if($order->status==0)
                                            <td> Pending</td>
                                        @elseif($order->status==1)
                                            <td> Accepted </td>
                                        @elseif($order->status==2)
                                            <td> Rejected</td>
                                        @elseif($order->status==3)
                                            <td> In Progress</td>
                                        @else
                                            <td> Delivered </td>
                                        @endif
                                        <td>{{$order->total_invoice}} EPG</td>
                                        <td>{{$order->items}} item</td>
                                    </tr>
                                    @endforeach
                                    </tbody>
                                </table>
                                <button type="submit" onclick="location.href='{{url('/generate_pdf')}}' " class="button">
                                    PDF
                                </button>
                            </div>
                        </div>
                    </div>
                    <!-- End Orders -->

                    <!-- Start details -->
                        <div class="details page">
                            <div class="card">
                                <div class="card-header">
                                    Billing Details
                                </div>
                                <div class="card-body">
                                    <form method="post" action="{{route('update_info')}}">
                                        @csrf
                                        @foreach($account_info as $info)
                                            <div class="form-group">
                                                <img src="../../assets/images1/form/name.png" alt="">
                                                <input type="text" name="full_name" class="form-control" value="{{$info->full_name}}" placeholder="Full Name *" required>
                                            </div>
                                            <div class="form-group">
                                                <img src="../../assets/images1/form/phone.png" alt="">
                                                <input type="number" name="phone1" class="form-control" value="{{$info->phone1}}" placeholder="Your Phone (1) *" required>
                                            </div>
                                            <div class="form-group">
                                                <img src="../../assets/images1/form/phone.png" alt="">
                                                <input type="number" name="phone2" class="form-control" value= "{{$info->phone2}}" placeholder="Your Phone (2)">
                                            </div>
                                            <div class="row pl-0 pr-0">
                                                <div class="col-md-6 pl-0 pr-lg-2 pr-md-2 pr-sm-0 pr-0">
                                                    <div class="form-group">
                                                        <img src="../../assets/images1/form/country.png" alt="">
                                                        <input type="text" name="country" class="form-control" value="{{$info->country}}" placeholder="Your Country *" required>
                                                    </div>
                                                </div>
                                                <div class="col-md-6 pr-0 pl-lg-2 pl-md-2 pl-sm-0 pl-0">
                                                    <div class="form-group">
                                                        <img src="../../assets/images1/form/city.png" alt="">
                                                        <input type="text" name="city" class="form-control" value="{{$info->city}}" placeholder="Your City *" required>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <img src="../../assets/images1/form/code-zip.png" alt="">
                                                <input type="text" name="zip_code" class="form-control" value="{{$info->zip_code}}" placeholder="Postcode / Zip *" required>
                                            </div>
                                            <div class="form-group">
                                                <img src="../../assets/images1/form/address.png" alt="">
                                                <input type="text" name="full_address" class="form-control" value="{{$info->full_address}}" placeholder="Your Address *" required>
                                            </div>

                                            <button type="submit" class="submit">Save</button>
                                        @endforeach
                                    </form>
                                </div>
                            </div>
                            <div class="card">
                                <div class="card-header">
                                    Account Details
                                </div>
                                <div class="card-body">
                                    <form method="post" action="{{route('update_account')}}">
                                        @csrf
                                            <div class="form-group">
                                                <img src="../../assets/images1/form/name.png" alt="">
                                                <input type="text" name="username" class="form-control" value="{{auth('user')->user()->username}}" placeholder="Full Name *" required>
                                            </div>
                                            <div class="form-group">
                                                <img src="../../assets/images1/form/phone.png" alt="">
                                                <input type="email" name="email" class="form-control" value="{{auth('user')->user()->email}}" placeholder="Your Phone (1) *" required>
                                            </div>
                                            <div class="form-group">
                                                <img src="../../assets/images1/form/phone.png" alt="">
                                                <input type="password" name="password" class="form-control" value= "" placeholder="Your password">
                                            </div>
                                            <button type="submit" class="submit">Save</button>
                                    </form>
                                </div>
                            </div>
                        </div>
                     <!-- End details -->


                </div>
            </div>
            <!-- End Pages -->

        </div>
    </div>
</div>
<!-- End account -->
<!-- ------------------------------------------------------------------------------ -->

<!-- ------------------------------------------------------------------------------ -->
@endsection
