@extends('layouts.AdminLTE-Header')
@section('content')
        <!-- partial -->
        <div class="page-content">
            <div class="row">
                @if (session()->has('success'))
                    <div class="alert alert-success" style="width: 100% !important;text-align: center;" role="alert">{{session()->get('success') }}</div>
                @endif
                @if (session()->has('error'))
                    <div class="alert alert-danger" style="width: 100% !important;text-align: center;" role="alert">{{session()->get('error') }}</div>
                @endif
                <div class="col-md-12 grid-margin stretch-card">
                    <div class="card">
                        <div class="card-body">
                            <h6 class="card-title">Sub Category</h6>
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
                                                <form method="post" action="{{route('SubCategory.store')}}">
                                                    @csrf
                                                    <div class="form-group">
                                                        <label for="recipient-name" class="col-form-label">Sub-Category Name:</label>
                                                        <input type="text" name="sub_category_name" class="form-control" id="recipient-name">
                                                    </div>
                                                    <div class="form-group">
                                                        <div class="btn-group">
                                                            <div class="form-group">
                                                                <label>The Main Category</label>
                                                                <select name="category_id" class="js-example-basic-single w-100">
                                                                    @foreach($main_categories as $category)
                                                                    <option value="{{$category->id}}">{{$category->category}}</option>
                                                                    @endforeach
                                                                </select>
                                                            </div>
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
{{--               End add modal--}}
{{--            Start the table --}}
                                <table id="dataTableExample" class="table">
                                    <thead>
                                    <tr>
                                        <th>Sub-Category Name</th>
                                        <th>Actions</th>
                                    </tr>
                                    </thead>
                                    <tbody>                          
                                        @foreach($All_Sub_Categories as $SubCategories)
                                        <tr id="subcategory{{$SubCategories['id']}}">
                                        <td>{{$SubCategories['SubCategory']}}</td>
                                        <td class="btn-group">
                                            <!-- Button trigger modal -->
                                            <a href="{{route('GetId',$SubCategories['id'])}}" class="btn btn-primary" data-toggle="modal" data-target="#editsubcategory{{$SubCategories['id']}}">
                                                Edit
                                            </a>
                                            <form method="POST" action="{{ route('SubCategory.destroy', $SubCategories['id']) }}">
                                                @csrf
                                                @method('DELETE') <!-- Specify the HTTP method here -->
                                                <button type="submit" class="btn btn-danger">Delete</button>
                                            </form>
                                        </td>
                                        </tr>
                                    @endforeach
                                    </tbody>
                                </table>
                                            {{--             start Edit modal--}}
                                @foreach($All_Sub_Categories as $SubCategories)
                                <div class="modal fade" id="editsubcategory{{$SubCategories['id']}}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                                <div class="modal-dialog" role="document">
                                                    <div class="modal-content">
                                                        <div class="modal-header">
                                                            <h5 class="modal-title" id="exampleModalLabel">Edit the sub-Category</h5>
                                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                                <span aria-hidden="true">&times;</span>
                                                            </button>
                                                        </div>
                                                        <div class="modal-body">
                                                            <form method="post" action="{{route('SubCategory.update',$SubCategories['id'])}}">
                                                                @csrf
                                                                @method('PUT')
                                                                <div class="form-group">
                                                                    <label for="recipient-name" class="col-form-label">Sub-Category Name:</label>
                                                                    <input type="text" value="{{$SubCategories['SubCategory']}}" name="sub_category_name" class="form-control" id="recipient-name">
                                                                </div>
                                                                <div class="form-group">
                                                                    <div class="btn-group">
                                                                        <div class="form-group">
                                                                            <label>The Main Category</label>
                                                                            <select name="category_id" class="js-example-basic-single w-100">
                                                                                @foreach($main_categories as $category)
                                                                                    <option value="{{$category->id}}" {{$category->id==$SubCategories['category_id'] ? 'selected' : ''}}>{{$category->category}}</option>
                                                                                @endforeach
                                                                            </select>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                                <div class="modal-footer">
                                                                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                                                    <button type="submit" class="btn btn-primary">Save</button>
                                                                </div>
                                                            </form>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                @endforeach
{{--          End Edit modal--}}
{{--            End the table --}}
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
@endsection