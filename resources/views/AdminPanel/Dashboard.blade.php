<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="shortcut icon" type="image/x-icon" href="../../assets/images1/icon.png">
    <title>Dashboard Panel | Evara-Shop </title>
    <!-- core:css -->
    <link rel="stylesheet" href="{{asset('assets/vendors/core/core.css')}}">
    <!-- endinject -->
    <!-- plugin css for this page -->
    <link rel="stylesheet" href="{{asset('assets/css/demo_1/style.css')}}">
    <!-- end plugin css for this page -->
    <!-- inject:css -->
    <link rel="stylesheet" href="{{asset('assets/vendors/flag-icon-css/css/flag-icon.min.css')}}">
    <link rel="stylesheet" href="{{asset('assets/fonts/feather-font/css/iconfont.css')}}">
    <!-- endinject -->
    <!-- Layout styles -->
    <link rel="stylesheet" href="{{asset('assets/vendors/bootstrap-datepicker/bootstrap-datepicker.min.css')}}">
    <!-- End layout styles -->
</head>
<body class="sidebar-dark">
<div class="main-wrapper">
    <!-- partial:partials/_sidebar.html -->
    <nav class="sidebar">
        <div class="sidebar-header">
            <a href="#" class="sidebar-brand">
                Evara<span>Shop</span>
            </a>
            <div class="sidebar-toggler not-active">
                <span></span>
                <span></span>
                <span></span>
            </div>
        </div>
        <div class="sidebar-body">
            <ul class="nav">
                <li class="nav-item nav-category">Main</li>
                <li class="nav-item">
                    <a href="{{route('dashboard')}}" class="nav-link">
                        <i class="link-icon" data-feather="box"></i>
                        <span class="link-title">Dashboard</span>
                    </a>
                </li>
                <li class="nav-item nav-category">Manage The Products</li>
                <li class="nav-item">
                    <a class="nav-link" data-toggle="collapse" href="#emails" role="button" aria-expanded="false" aria-controls="emails">
                        <i class="link-icon" data-feather="folder"></i>
                        <span class="link-title">The Categories</span>
                        <i class="link-arrow" data-feather="chevron-down"></i>
                    </a>
                    <div class="collapse" id="emails">
                        <ul class="nav sub-menu">
                            <li class="nav-item">
                                <a href="{{route('MainCategory')}}" class="nav-link">The Main Categories</a>
                            </li>
                            <li class="nav-item">
                                <a href="{{route('SubCategory')}}" class="nav-link">The Sub-Categories</a>
                            </li>
                        </ul>
                    </div>
                </li>
                <li class="nav-item">
                    <a href="{{route('ManageProducts')}}" class="nav-link">
                        <i class="link-icon" data-feather="shopping-cart"></i>
                        <span class="link-title">Manage The Products</span>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="{{route('manage.orders')}}" class="nav-link">
                        <i class="link-icon" data-feather="shopping-cart"></i>
                        <span class="link-title">Manage Orders</span>
                    </a>
                </li>
                <li class="nav-item nav-category">Manage the website</li>
                <li class="nav-item">
                    <a href="{{route('manage.mails')}}" class="nav-link">
                        <i class="link-icon" data-feather="mail"></i>
                        <span class="link-title">Manage Mails</span>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="{{route('settings.view')}}" class="nav-link">
                        <i class="link-icon" data-feather="settings"></i>
                        <span class="link-title">Manage Website Settings</span>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="{{route('manage.users')}}" class="nav-link">
                        <i class="link-icon" data-feather="settings"></i>
                        <span class="link-title">Manage users</span>
                    </a>
                </li>
            </ul>
        </div>
    </nav>
    <!-- partial -->
    <div class="page-wrapper">
        <!-- partial:partials/_navbar.html -->
        <nav class="navbar">
            <a href="#" class="sidebar-toggler">
                <i data-feather="menu"></i>
            </a>
            <div class="navbar-content">
                <ul class="navbar-nav">
                    <li class="nav-item dropdown nav-profile">
                        <a class="nav-link dropdown-toggle" href="#" id="profileDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            <img src="https://via.placeholder.com/30x30" alt="userr">
                        </a>
                        <div class="dropdown-menu" aria-labelledby="profileDropdown">
                            <div class="dropdown-header d-flex flex-column align-items-center">
                                <div class="figure mb-3">
                                    <img src="https://via.placeholder.com/80x80" alt="">
                                </div>
                                <div class="info text-center">
                                    <p class="name font-weight-bold mb-0">{{auth('web')->user()->name}}</p>
                                    <p class="email text-muted mb-3">{{auth('web')->user()->email}}</p>
                                </div>
                            </div>
                            <div class="dropdown-body">
                                <ul class="profile-nav p-0 pt-3">
                                    <li class="nav-item">
                                        <a href="{{url('admin/logout')}}" class="nav-link">
                                            <i data-feather="log-out"></i>
                                            <span>Log Out</span>
                                        </a>
                                    </li>
                                </ul>
                            </div>
                        </div>
                    </li>
                </ul>
            </div>
        </nav>
        <!-- partial -->
        <div class="page-content">

            <div class="d-flex justify-content-between align-items-center flex-wrap grid-margin">
                <div>
                    <h4 class="mb-3 mb-md-0">Welcome to Dashboard</h4>
                </div>
            </div>
            <div class="row">
                <div class="col-12 col-xl-12 stretch-card">
                    <div class="row flex-grow">
                        <div class="card col-lg-3 mx-2 mt-2">
                            <div class="card-body pb-0 px-0 ">
                                <div class="d-flex justify-content-between align-items-baseline">
                                    <h5 class="mb-3 col-12 px-0 pl-4 text-uppercase">The Users</h5>
                                </div>
                                <div class="d-flex flex-column justify-content-start">
                                    <h3 id="card0" class=" mb-2 pl-4  font-weight-bold">{{$count_users}}</h3>
                                </div>
                            </div>
                        </div>

                        <div class="card col-lg-3 mx-2 mt-2">
                            <div class="card-body pb-0 px-0 ">
                                <div class="d-flex justify-content-between align-items-baseline">
                                    <h5 class="mb-3 col-12 px-0 pl-4 text-uppercase">The Products</h5>
                                </div>
                                <div class="d-flex flex-column justify-content-start">
                                    <h3 id="card0" class=" mb-2 pl-4  font-weight-bold">{{$count_products}}</h3>
                                </div>
                            </div>
                        </div>

                        <div class="card col-lg-3 mx-2 mt-2">
                            <div class="card-body pb-0 px-0 ">
                                <div class="d-flex justify-content-between align-items-baseline">
                                    <h5 class="mb-3 col-12 px-0 pl-4 text-uppercase">Orders</h5>
                                </div>
                                <div class="d-flex flex-column justify-content-start">
                                    <h3 id="card0" class=" mb-2 pl-4  font-weight-bold">{{$count_orders}}</h3>
                                </div>
                            </div>
                        </div>

                        <div class="card col-lg-3 mx-2 mt-2">
                            <div class="card-body pb-0 px-0 ">
                                <div class="d-flex justify-content-between align-items-baseline">
                                    <h5 class="mb-3 col-12 px-0 pl-4 text-uppercase">Pending Orders</h5>
                                </div>
                                <div class="d-flex flex-column justify-content-start">
                                    <h3 id="card0" class=" mb-2 pl-4  font-weight-bold">{{$count_pending_orders}}</h3>
                                </div>
                            </div>
                        </div>

                    </div>
                </div>
            </div> <!-- row -->
        </div>
        <!-- partial:partials/_footer.html -->
        <footer class="footer d-flex flex-column flex-md-row align-items-center justify-content-between">
            <p class="text-muted text-center text-md-left">Copyright © 2022 <a href="{{url('/')}}" target="_blank">Evara-Shop</a>. All rights reserved</p>
            <p class="text-muted text-center text-md-left mb-0 d-none d-md-block">Handcrafted With <i class="mb-1 text-primary ml-1 icon-small" data-feather="heart"></i></p>
        </footer>
        <!-- partial -->
    </div>
</div>

<!-- core:js -->
<script src="{{asset('assets/vendors/core/core.js')}}"></script>
<!-- endinject -->
<!-- plugin js for this page -->
<script src="{{asset('assets/js/datepicker.js')}}"></script>
<script src="{{asset('assets/js/dashboard.js')}}"></script>
<script src="{{asset('assets/js/template.js')}}"></script>
<script src="{{asset('assets/vendors/feather-icons/feather.min.js')}}"></script>
<script src="{{asset('assets/vendors/progressbar.js/progressbar.min.js')}}"></script>
<script src="{{asset('assets/vendors/apexcharts/apexcharts.min.js')}}"></script>
<!-- end plugin js for this page -->
<!-- inject:js -->
<script src="{{asset('assets/vendors/bootstrap-datepicker/bootstrap-datepicker.min.js')}}"></script>
<script src="{{asset('assets/vendors/jquery.flot/jquery.flot.resize.js')}}"></script>
<!-- endinject -->
<!-- custom js for this page -->
<script src="{{asset('assets/vendors/jquery.flot/jquery.flot.js')}}"></script>
<script src="{{asset('assets/vendors/chartjs/Chart.min.js')}}"></script>
<!-- end custom js for this page -->
</body>
</html>
