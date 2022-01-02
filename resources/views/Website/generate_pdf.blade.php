<head>
    <link rel="stylesheet" href="../../assets/css1/contact.css">
    <link rel="stylesheet" href="../../assets/vendor1/bootstrap/bootstrap.css">
    <link rel="stylesheet" href="../../assets/vendor1/fontawesome/all.css">
    <link rel="stylesheet" href="../../assets/vendor1/boxicons/css/boxicons.min.css">
    <link rel="stylesheet" href="../../assets/vendor1/owl.carousel/owl.carousel.min.css">
    <link rel="stylesheet" href="../../assets/vendor1/slick/slick.css">
    <link rel="stylesheet" href="../../assets/vendor1/ion.rangeSlider-master/css/ion.rangeSlider.min.css">
    <link rel="shortcut icon" type="image/x-icon" href="../../assets/images1/icon.png">
    <link rel="stylesheet" href="../../assets/vendor1/swiper/swiper.min.css">
</head>
<!-- Start Account -->
<div class="account mt-5 mb-5">
    <div class="container">
        <div class="row">

            <div class="col-lg-9 col-md-8">
                <div class="pages">
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
                            </div>
                        </div>
                    </div>
                    <!-- End Orders -->

                </div>
            </div>
            <!-- End Pages -->

        </div>
    </div>
</div>
<!-- End account -->

