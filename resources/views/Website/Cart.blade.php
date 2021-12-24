@extends('layouts.Header_Website')
@section('Shop','active')
@section('content')
    @section('page','Cart')
<!-- Start Cart -->
<div class="cart container mt-5">
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
    <!-- Start Table -->
    <div id="cart" class="table-responsive-lg mb-2">
        <table class="table table-hover text-center">
            <thead>
            <tr>
                <th scope="col">Image</th>
                <th scope="col">Name</th>
                <th scope="col">Price</th>
                <th scope="col">Quantity</th>
                <th scope="col">Sub Total</th>
                <th scope="col">Remove</th>
            </tr>
            </thead>
            <tbody>

            @if(auth('user')->check())

                @foreach($Products_Cart as $products)
                    <tr>
                        <td><img src="{{$products->path}}" alt=""></td>
                        <td class="name">{{$products->title}}</td>
                        <td class="price" id="price">{{$products->price}} EPG</td>
                        <td class="quantity" id="quantity">{{$products->quantity}}</td>

                        <td class="subtotal" id="total_price">{{$products->Sub_total}} EPG</td>
                        <td class="remove">
                            <a href="{{route('delete.item',$products->id)}}">
                                <i class='bx bx-trash'></i>
                            </a>
                        </td>
                    </tr>
                @endforeach
                <script type="text/javascript">
                    function GetSelectedTextValue(qty) {
                        let selectedText = qty.options[qty.selectedIndex].innerHTML;
                        let selectedValue = qty.value;
                        let id =  document.getElementById('id').value;
                        alert("id: " + id + " Value: " + selectedValue);
                        $.ajax({
                            type: "get",
                            url: '/ChangeQuantity/' + id + '/' + selectedValue,
                            data: {},
                            success: function( msg ) {
                                $( "#cart" ).load(window.location.href + " #cart" );

                            }
                        });
                    }
                </script>
                @if($Count_cart==0)
                    <!-- If Cart is Empty -->
                    <tr>
                        <td colspan="6">There are no products to display in the cart</td>
                    </tr>
                @endif
            @else
                <tr>
                    <td colspan="6">Please login to the account for adding the product to cart</td>
                </tr>
            @endif

            </tbody>
        </table>

    </div>
    <!-- End Table -->

    <!-- Start buttons -->
    <div class="buttons mt-3">

        <div class="info d-flex align-items-center">
            <div class="left">
                <a href="#">Total: <span>{{$total_price}} EPG</span></a>
            </div>
            <div class="right ml-auto">
                <a href="{{route('delete.allitems')}}" class="clear ml-auto">
                    <i class="far fa-times-circle"></i> Clear Cart
                </a>
            </div>
        </div>

        <div class="proccess mt-5 d-flex align-items-center">
            <div class="left">
                <a href="{{url('/Shop')}}" class="mr-3"><i class="fas fa-long-arrow-alt-left mr-2"></i> Continue Shopping</a>
            </div>
            <div class="right ml-auto">
                <a href="{{url('/checkout')}}">Proceed To CheckOut <i class="fas fa-sign-out-alt ml-2"></i></a>
            </div>
        </div>
    </div>
    <!-- End buttons -->

</div>
<!-- End Cart -->
<!-- ------------------------------------------------------------------------------ -->

<!-- ------------------------------------------------------------------------------ -->
@endsection
