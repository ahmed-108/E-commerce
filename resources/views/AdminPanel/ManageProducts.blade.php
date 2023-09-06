<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Manage Products | Evara-Shop</title>
    <!-- core:css -->
    <link rel="stylesheet" href="../../../assets/vendors/core/core.css">
    <!-- endinject -->
    <!-- plugin css for this page -->
    <link rel="stylesheet" href="../../../assets/vendors/datatables.net-bs4/dataTables.bootstrap4.css">
    <!-- end plugin css for this page -->
    <!-- inject:css -->
    <link rel="stylesheet" href="../../../assets/fonts/feather-font/css/iconfont.css">
    <link rel="stylesheet" href="../../../assets/vendors/flag-icon-css/css/flag-icon.min.css">
    <!-- endinject -->
    <!-- Layout styles -->
    <link rel="stylesheet" href="../../../assets/css/demo_1/style.css">
    <!-- End layout styles -->
    <link rel="shortcut icon" type="image/x-icon" href="../../assets/images1/icon.png">
    <link href="https://transloadit.edgly.net/releases/uppy/v1.6.0/uppy.min.css" rel="stylesheet">
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
                                    <li class="nav-item">
                                        <a href="{{route('manage.users')}}" class="nav-link">
                                            <i class="link-icon" data-feather="settings"></i>
                                            <span class="link-title">Manage users</span>
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
            <div class="row">
                @if ( session('success') )
                    <div class="alert alert-success" style="width: 100% !important;text-align: center;" role="alert">{{ session('success') }}</div>
                @endif
                @if ( session('error') )
                    <div class="alert alert-danger" style="width: 100% !important;text-align: center;" role="alert">{{ session('error') }}</div>
                @endif
                <div class="col-md-12 grid-margin stretch-card">
                    <div class="card">
                        <div class="card-body">
                            <h6 class="card-title">Manage Products</h6>
                            <div class="table-responsive">
                                <button type="button" style="float: right;" class="btn btn-primary" data-toggle="modal" data-target="#exampleModal">
                                    Add
                                </button><br><br>
            {{--  start add modal--}}
                                <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                    <div class="modal-dialog" role="document">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title" id="exampleModalLabel">Add new Category</h5>
                                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                    <span aria-hidden="true">&times;</span>
                                                </button>
                                            </div>
                                            <div class="modal-body">
                                                <form method="post" action="{{route('add.products')}}" enctype="multipart/form-data">
                                                    @csrf
                                                    <div class="form-group">
                                                        <label for="recipient-name" class="col-form-label">Product Title:</label>
                                                        <input type="text" class="form-control" name="product_title" id="recipient-name">
                                                    </div>
                                                    <div class="form-group">
                                                        <label for="recipient-name" class="col-form-label">Short Description:</label>
                                                        <textarea class="form-control" name="short_description" id="recipient-name"> </textarea>
                                                    </div>
                                                    <div class="form-group">
                                                        <label for="recipient-name" class="col-form-label">Long Description:</label>
                                                        <textarea class="form-control" name="long_description" id="recipient-name"> </textarea>
                                                    </div>
                                                    <div class="form-group">
                                                        <label for="recipient-name" class="col-form-label">Product Price:</label>
                                                        <input type="text" class="form-control" name="product_price" id="recipient-name">
                                                    </div>
                                                    <div class="form-group">
                                                        <label for="recipient-name" class="col-form-label">the discount:</label>
                                                        <input type="text" class="form-control percent" name="product_discount" id="percent">
                                                    </div>
                                                    <div class="form-group">
                                                        <label>The Main Category</label>
                                                        <select name="main_category" class="js-example-basic-single w-100">
                                                            @foreach($All_Categories as $category)
                                                                <option value="{{$category->id}}">{{$category->category}}</option>
                                                            @endforeach
                                                        </select>
                                                    </div>
                                                    <div class="form-group">
                                                        <label>The Sub Category</label>
                                                        <select name="sub_category" class="js-example-basic-single w-100">
                                                            @foreach($all_subcategories as $subcategory)
                                                                <option value="{{$subcategory->id}}">{{$subcategory->sub_category_name}}</option>
                                                            @endforeach
                                                        </select>
                                                    </div>
                                                    <div class="form-group">
                                                        <div class="field">
                                                            <label for="recipient-name" class="col-form-label">Images:</label>
                                                            <input type="file" class="form-control" name="product_images" id="recipient-name">
                                                        </div>
                                                    </div>
                                                    <div class="modal-footer">
                                                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                                        <button type="submit" class="btn btn-primary">Add</button>
                                                    </div>
                                                </form>
                                            </div>
                                        </div>
                                    </div>
                                </div>
            {{--  End add modal--}}
{{--            Start the table --}}
                                <table id="dataTableExample" class="table">
                                    <thead>
                                    <tr>
                                        <th>Product title</th>
                                        <th>The Sub-Product</th>
                                        <th>Product Price</th>
                                        <th>Actions</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    @foreach($all_products as $product)
                                        <tr id="category{{$product->id}}">
                                            <td> {{$product->title}} </td>
                                            <span style="visibility: hidden;">{{$subcategory= \App\Http\Models\sub_categories::select(array('sub_category_name'))->where('id',$product->sub_category_id )->get()}}</span>
                                            @foreach($subcategory as $Subcategory)
                                                <td> {{$Subcategory->sub_category_name}} </td>
                                            @endforeach
                                            <td> {{$product->price}} </td>
                                            <td class="btn-group">
                                                <!-- Button trigger modal -->
                                                <a href="" class="btn btn-primary" data-toggle="modal" data-target="#editproduct{{$product->id}}">
                                                    Edit
                                                </a>
                                                <a href="{{route('delete.product',$product->id)}}" class="btn btn-danger">Delete</a>
                                            </td>
                                        </tr>
                                    @endforeach
                                    </tbody>
                                </table>
                {{--   Start Edit modal--}}
                                @foreach($all_products as $product)

                                <div class="modal fade" id="editproduct{{$product->id}}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                                <div class="modal-dialog" role="document">
                                                    <div class="modal-content">
                                                        <div class="modal-header">
                                                            <h5 class="modal-title" id="exampleModalLabel">Edit Category</h5>
                                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                                <span aria-hidden="true">&times;</span>
                                                            </button>
                                                        </div>
                                                        <div class="modal-body">
                                                            <form method="post" action="">
                                                                @csrf
                                                                <div class="form-group">
                                                                    <label for="recipient-name" class="col-form-label">Product Title:</label>
                                                                    <input type="text" class="form-control" name="product_title" value="{{$product->title}}" id="recipient-name">
                                                                </div>
                                                                <div class="form-group">
                                                                    <label for="recipient-name" class="col-form-label">Short Description:</label>
                                                                    <textarea class="form-control" name="short_description" id="recipient-name">{{$product->short_description}}</textarea>
                                                                </div>
                                                                <div class="form-group">
                                                                    <label for="recipient-name" class="col-form-label">Long Description:</label>
                                                                    <textarea class="form-control" name="long_description" id="recipient-name">{{$product->long_description}} </textarea>
                                                                </div>
                                                                <div class="form-group">
                                                                    <label for="recipient-name" class="col-form-label">Product Price:</label>
                                                                    <input type="text" class="form-control" name="product_price" value="{{$product->price}}" id="recipient-name">
                                                                </div>
                                                                <div class="form-group">
                                                                    <label for="recipient-name" class="col-form-label">the discount:</label>
                                                                    <input type="text" class="form-control percent" name="product_discount" id="percent">
                                                                </div>
                                                                <div class="form-group">
                                                                    <label>The Main Category</label>
                                                                    <select name="main_category" class="js-example-basic-single w-100">
                                                                        @foreach($All_Categories as $category)
                                                                            <option value="{{$category->id}}">{{$category->category}}</option>
                                                                        @endforeach
                                                                    </select>
                                                                </div>
                                                                <div class="form-group">
                                                                    <label>The Sub Category</label>
                                                                    <select name="sub_category" class="js-example-basic-single w-100">
                                                                        @foreach($all_subcategories as $subcategory)
                                                                            <option value="{{$subcategory->id}}">{{$subcategory->sub_category_name}}</option>
                                                                        @endforeach
                                                                    </select>
                                                                </div>
                                                                <div class="form-group">
                                                                    <div class="field">
                                                                        <label for="recipient-name" class="col-form-label">Images:</label>
                                                                        <input type="file" class="form-control" name="product_images" id="recipient-name">
                                                                    </div>
                                                                </div>
                                                                <div class="modal-footer">
                                                                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                                                    <button type="submit" class="btn btn-primary">Save changes</button>
                                                                </div>
                                                            </form>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                @endforeach
{{--                End the Edit modal --}}

{{--            End the table --}}
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- partial:../../partials/_footer.html -->
        <footer class="footer d-flex flex-column flex-md-row align-items-center justify-content-between">
            <p class="text-muted text-center text-md-left">Copyright © 2022 <a href="{{url('/')}}" target="_blank">Evara-Shop</a>. All rights reserved</p>
            <p class="text-muted text-center text-md-left mb-0 d-none d-md-block">Handcrafted With <i class="mb-1 text-primary ml-1 icon-small" data-feather="heart"></i></p>
        </footer>
        <!-- partial -->

    </div>
</div>
<script src="https://transloadit.edgly.net/releases/uppy/v1.6.0/uppy.min.js"></script>
<!-- core:js -->
<script src="../../../assets/vendors/core/core.js"></script>
<!-- endinject -->
<!-- plugin js for this page -->
<script src="../../../assets/vendors/datatables.net/jquery.dataTables.js"></script>
<script src="../../../assets/vendors/datatables.net-bs4/dataTables.bootstrap4.js"></script>
<!-- end plugin js for this page -->
<!-- inject:js -->
<script src="../../../assets/vendors/feather-icons/feather.min.js"></script>
<script src="../../../assets/js/template.js"></script>
<!-- endinject -->
<!-- custom js for this page -->
<script src="../../../assets/js/data-table.js"></script>
<script src="https://cdn.jsdelivr.xyz/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
<!-- end custom js for this page -->
</body>
</html>
