@extends('layouts.AdminLTE-Header')
@section('content')

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
                                                <form method="post" action="{{route('ManageProducts.store')}}" enctype="multipart/form-data">
                                                    @csrf
                                                    <div class="form-group">
                                                        <label for="recipient-name" class="col-form-label">Product Title:</label>
                                                        <input type="text" class="form-control" name="title" id="recipient-name">
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
                                                        <input type="text" class="form-control" name="price" id="recipient-name">
                                                    </div>
                                                    <div class="form-group">
                                                        <label for="recipient-name" class="col-form-label">the discount:</label>
                                                        <input type="text" class="form-control percent" name="discount" id="percent">
                                                    </div>
                                                    <div class="form-group">
                                                        <label>The Main Category</label>
                                                        <select name="category_id" class="js-example-basic-single w-100">
                                                            @foreach($All_Categories as $category)
                                                                <option value="{{$category->id}}">{{$category->category}}</option>
                                                            @endforeach
                                                        </select>
                                                    </div>
                                                    <div class="form-group">
                                                        <label>The Sub Category</label>
                                                        <select name="sub_category_id" class="js-example-basic-single w-100">
                                                            @foreach($All_SubCategories as $subcategory)
                                                                <option value="{{$subcategory->id}}">{{$subcategory->sub_category_name}}</option>
                                                            @endforeach
                                                        </select>
                                                    </div>
                                                    <div class="form-group">
                                                        <div class="field">
                                                            <label for="recipient-name" class="col-form-label">Images:</label>
                                                            <input onchange="previewImages(this)" type="file" id="upload" accept="image/*" class="form-control" name="images[]" id="recipient-name" multiple>
                                                        </div>
                                                    </div>
                                                    <div id="image-preview-container"></div>
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
                                    @foreach($All_Products as $product)
                                        <tr id="category{{$product->id}}">
                                            <td> {{$product->title}} </td>
                                            <td> {{$product->price}} </td>
                                            <td class="btn-group">
                                                <!-- Button trigger modal -->
                                                <a href="" class="btn btn-primary" data-toggle="modal" data-target="#editproduct{{$product->id}}">
                                                    Edit
                                                </a>
                                                <a href="{{route('ManageProducts.destroy',$product->id)}}" class="btn btn-danger">Delete</a>
                                            </td>
                                        </tr>
                                    @endforeach
                                    </tbody>
                                </table>
                {{--   Start Edit modal--}}
                                @foreach($All_Products as $product)

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
                                                                        @foreach($All_SubCategories as $subcategory)
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
        @endsection