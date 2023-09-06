@extends('layouts.AdminLTE-Header')
@section('content')
        <!-- partial -->
        <div class="page-content">
            <div class="row">
 
                @include('layouts.errors')
                <div class="col-md-12 grid-margin stretch-card">
                    <div class="card">
                        <div class="card-body">
                            <h6 class="card-title">                        
                                The Main Categories
                            </h6>
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
                                                <form method="post" action="{{route('MainCategory.store')}}" enctype="multipart/form-data">
                                                    @csrf
                                                    <div class="form-group">
                                                        <label for="recipient-name" class="col-form-label">Category Name:</label>
                                                        <input type="text" class="form-control" name="category" id="recipient-name">
                                                    </div>
                                                    <div class="form-group">
                                                        <label for="recipient-name" class="col-form-label">Category Image:</label>
                                                        <input type="file" class="form-control" name="category_image" id="recipient-name">
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
                                        <th>Category Name</th>
                                        <th>Actions</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    @foreach($All_Categories as $Categories)
                                    <tr id="category{{$Categories->id}}">
                                        <td> {{$Categories->category}} </td>
                                        <td class="btn-group">
                                            <!-- Button trigger modal -->
                                            <a href="#" class="btn btn-primary" data-toggle="modal" data-target="#editcategory{{$Categories->id}}">
                                                Edit
                                            </a>
                                            <form method="POST" action="{{ route('MainCategory.destroy', $Categories->id) }}">
                                                @csrf
                                                @method('DELETE') <!-- Specify the HTTP method here -->
                                                <button type="submit" class="btn btn-danger">Delete</button>
                                            </form>                                        
                                        </td>
                                    </tr>
                                    @endforeach
                                    </tbody>
                                </table>
                {{--   Start Edit modal--}}
                                            @foreach($All_Categories as $Categories)
                                            <div class="modal fade" id="editcategory{{$Categories->id}}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                                <div class="modal-dialog" role="document">
                                                    <div class="modal-content">
                                                        <div class="modal-header">
                                                            <h5 class="modal-title" id="exampleModalLabel">Edit Category</h5>
                                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                                <span aria-hidden="true">&times;</span>
                                                            </button>
                                                        </div>
                                                        <div class="modal-body">
                                                            <form method="post" action="{{ route('MainCategory.update',$Categories->id) }}" enctype="multipart/form-data">
                                                                @csrf
                                                                @method('PUT')
                                                                <div class="form-group">
                                                                    <label for="recipient-name" class="col-form-label">Category Name:</label>
                                                                    <input type="text" name="category" class="form-control" id="recipient-name" value="{{$Categories->category}}">
                                                                </div>
                                                                {{$Categories->id}}
                                                                <div class="form-group">
                                                                    <label for="recipient-name" class="col-form-label">Category image:</label>
                                                                    <input type="file" name="category_image" class="form-control" id="recipient-name">
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