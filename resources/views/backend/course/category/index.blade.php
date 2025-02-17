@extends('backend.layouts.master')
@section('title','Category | Sattree Gurukul')
@section('body')
<div class="page-wrapper">
    <div class="content container-fluid">
        <div class="page-header">
            <div class="row">
                <div class="col-md-6">
                    <h3 class="page-title mb-0">Category</h3>
                </div>
                <div class="col-md-6">
                    <ul class="breadcrumb mb-0 p-0 float-right">
                        <li class="breadcrumb-item">
                            <a href="{{route('Admin-Dashboard')}}"><i class="fas fa-home"></i> Home</a>
                        </li>
                        <li class="breadcrumb-item"><span>Category</span></li>
                    </ul>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-sm-4 col-12"></div>
            <div class="col-sm-8 col-12 text-right add-btn-col">
                <a href="" class="btn btn-primary btn-rounded float-right" data-toggle="modal" data-target="#add_category"><i class="fas fa-plus"></i> Add Category</a>
            </div>
        </div>
        <div class="row">
            <div class="col-sm-12">
                <div class="card">
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table custom-table datatable">
                                <thead class="thead-light">
                                    <tr>
                                        <th>#</th>
                                        <th>Category Name</th>
                                        <!-- <th>Image</th> -->
                                        <th class="text-right">Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($category as $key=>$item)
                                    <tr>
                                        <td>{{++$key}}</td>
                                        <td>{{$item->category_name}}</td>
                                        <!-- <td><img src="{{ asset('Category Image/'.$item->category_image)}}" alt="" height="80px" width="80px"></td> -->
                                        <td class="text-right">
                                            <div class="dropdown dropdown-action">
                                                <a href="#" class="action-icon dropdown-toggle" data-toggle="dropdown" aria-expanded="false"><i class="fas fa-ellipsis-v"></i></a>
                                                <div class="dropdown-menu dropdown-menu-right">
                                                    <a class="dropdown-item" href="" data-toggle="modal" data-target="#update_category_{{$item->id}}"><i class="fas fa-pencil-alt m-r-5"></i> Edit</a>
                                                    <form action="{{ route('category.destroy', $item->id) }}" method="POST" class="d-inline">
                                                        @csrf
                                                        @method('delete')
                                                        <button type="submit" class="dropdown-item"><i class="fas fa-trash-alt m-r-5"></i> Delete</button>
                                                    </form>
                                                </div>
                                            </div>
                                        </td>
                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<div class="modal custom-modal fade" id="add_category">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">Add Category</h4>
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
            </div>
            <div class="modal-body">
                <form action="{{route('category.store')}}" method="post" enctype="multipart/form-data" id="category_form">
                    @csrf
                    <div class="form-group">
                        <label>Category Name</label>
                        <input class="form-control form-white" placeholder="Enter name" type="text" name="category_name">
                        <span class="text-danger" id="category_name_error"></span>
                    </div>
                    <!-- <div class="form-group">
                        <label>Choose Category Image</label>
                        <input type="file" name="category_image" accept="image/*" class="form-control" value="" />
                        <span class="text-danger" id="category_image_error"></span>
                    </div> -->
                    <div class="submit-section text-center">
                        <button type="submit" class="btn btn-primary save-category submit-btn">Save</button>
                        <button type="button" class="btn btn-danger" onclick="cancelForm()">Cancle</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@foreach($category as $key=>$item)
<div class="modal custom-modal fade" id="update_category_{{$item->id}}">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">Update Category</h4>
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
            </div>
            <div class="modal-body">
                <form action="{{route('category.update',$item->id)}}" method="post" enctype="multipart/form-data" id="update_category_form_{{$item->id}}">
                    @csrf
                    @method('put')
                    <div class="form-group">
                        <label>Category Name</label>
                        <input class="form-control form-white" placeholder="Enter name" type="text" name="category_name" value="{{$item->category_name}}">
                        <span class="text-danger" id="update_category_name_error"></span>
                    </div>
                    <!-- <div class="form-group">
                        <label>Choose Category Image</label>
                        <input type="file" name="category_image" accept="image/*" class="form-control" />
                        <span class="text-danger" id="update_category_image_error"></span>
                        <img src="{{ asset('Category Image/'.$item->category_image)}}" alt="" height="80px" width="80px">
                    </div> -->
                    <div class="submit-section text-center">
                        <button type="submit" class="btn btn-primary save-category submit-btn">Save</button>
                        <button type="button" class="btn btn-danger" data-dismiss="modal">Cancle</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endforeach
@endsection
<script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
<script>
    $(document).ready(function() {

        // AJAX request for creating category
        $('#category_form').on('submit', function(event) {
            event.preventDefault();
            $.ajax({
                url: $(this).attr('action'),
                method: 'POST',
                data: new FormData(this),
                contentType: false,
                cache: false,
                processData: false,
                success: function(response) {
                    if (response.errors) {
                        // Display validation errors
                        if (response.errors.category_name) {
                            document.getElementById("category_name_error").innerText = response.errors.category_name[0];
                        } else {
                            document.getElementById("category_name_error").innerText = '';
                        }
                        // if (response.errors.category_image) {
                        //     document.getElementById("category_image_error").innerText = response.errors.category_image[0];
                        // } else {
                        //     document.getElementById("category_image_error").innerText = '';
                        // }
                    } else if (response.success) {
                        // If no errors, reset form and close modal
                        document.getElementById("category_form").reset();
                        $('#add_category').modal('hide');
                        // Clear error messages
                        document.getElementById("category_name_error").innerText = '';
                        // document.getElementById("category_image_error").innerText = '';
                        // Show success message if needed
                        successMsg(response.success);
                        location.reload();
                    }
                },
                error: function(xhr, status, error) {
                    errorMsg(xhr.responseText);
                }
            });
        });

        // AJAX request for updating category
        $('[id^=update_category_]').find('form').on('submit', function(event) {
            event.preventDefault();
            var id = $(this).attr('id').split('_')[3];
            $.ajax({
                url: $(this).attr('action'),
                method: 'POST',
                data: new FormData(this),
                contentType: false,
                cache: false,
                processData: false,
                success: function(response) {
                    if (response.errors) {
                        // Display validation errors
                        if (response.errors.category_name) {
                            $('#update_category_name_error').text(response.errors.category_name[0]);
                        } else {
                            $('#update_category_name_error').text('');
                        }
                        // if (response.errors.category_image) {
                        //     $('#update_category_image_error').text(response.errors.category_image[0]);
                        // } else {
                        //     $('#update_category_image_error').text('');
                        // }
                    } else if (response.success) {
                        // If no errors, reset form and close modal
                        $('#update_category_form_' + id)[0].reset();
                        $('#update_category_' + id).modal('hide');
                        // Clear error messages
                        $('#update_category_name_error').text('');
                        // $('#update_category_image_error').text('');
                        // Show success message if needed
                        successMsg(response.success);
                        location.reload();
                    }
                },
                error: function(xhr, status, error) {
                    console.error(xhr.responseText);
                }
            });
        });
    });

    function cancelForm() {
        document.getElementById("update_category_form").reset();
        $('#add_category').modal('hide');
        document.getElementById("category_name_error").innerText = '';
        // document.getElementById("category_image_error").innerText = '';
    }
</script>