@extends('backend.layouts.master')
@section('title','Sub Category | Sattree Gurukul')
@section('body')
<div class="page-wrapper">
	<div class="content container-fluid">
		<div class="page-header">
			<div class="row">
				<div class="col-md-6">
					<h3 class="page-title mb-0">Sub Category</h3>
				</div>
				<div class="col-md-6">
					<ul class="breadcrumb mb-0 p-0 float-right">
						<li class="breadcrumb-item">
							<a href="{{route('Admin-Dashboard')}}"><i class="fas fa-home"></i> Home</a>
						</li>
						<li class="breadcrumb-item"><span>Sub Category</span></li>
					</ul>
				</div>
			</div>
		</div>
		<div class="row">
			<div class="col-sm-4 col-12"></div>
			<div class="col-sm-8 col-12 text-right add-btn-col">
				<a href="" class="btn btn-primary btn-rounded float-right" data-toggle="modal" data-target="#add_subcategory"><i class="fas fa-plus"></i> Add Sub Category</a>
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
										<th>Sub Category Name</th>
										<!-- <th>Image</th> -->
										<th class="text-right">Action</th>
									</tr>
								</thead>
								<tbody>
									@foreach($subcategory as $key=>$item)
									@php
									$category_details = App\Models\Backend\Category::where('id',$item->category_id)->first();
									@endphp
									<tr>
										<td>{{++$key}}</td>
										<td>{{$category_details->category_name}}</td>
										<td>{{$item->subcategory_name}}</td>
										<!-- <td><img src="{{ asset('Sub Category Image/'.$item->subcategory_image)}}" alt="" height="80px" width="80px"></td> -->
										<td class="text-right">
											<div class="dropdown dropdown-action">
												<a href="#" class="action-icon dropdown-toggle" data-toggle="dropdown" aria-expanded="false"><i class="fas fa-ellipsis-v"></i></a>
												<div class="dropdown-menu dropdown-menu-right">
													<a class="dropdown-item" href="" data-toggle="modal" data-target="#update_subcategory_{{$item->id}}"><i class="fas fa-pencil-alt m-r-5"></i> Edit</a>
													<form action="{{ route('subcategory.destroy', $item->id) }}" method="POST" class="d-inline">
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
<div class="modal custom-modal fade" id="add_subcategory">
	<div class="modal-dialog modal-dialog-centered">
		<div class="modal-content">
			<div class="modal-header">
				<h4 class="modal-title">Add Sub Category</h4>
				<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
			</div>
			<div class="modal-body">
				<form action="{{route('subcategory.store')}}" method="post" enctype="multipart/form-data" id="subcategory_form">
					@csrf
					<div class="form-group">
						<label>Choose Category</label>
						<select name="category_id" id="category_id" class="form-control">
							@foreach($category as $item)
							<option value="{{$item->id}}">{{$item->category_name}}</option>
							@endforeach
						</select>
					</div>
					<div class="form-group">
						<label>Sub Category Name</label>
						<input class="form-control form-white" placeholder="Enter name" type="text" name="subcategory_name">
						<span class="text-danger" id="subcategory_name_error"></span>
					</div>
					<!-- <div class="form-group">
						<label>Choose Sub Category Image</label>
						<input type="file" name="subcategory_image" accept="image/*" class="form-control" value="" />
						<span class="text-danger" id="subcategory_image_error"></span>
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
@foreach($subcategory as $key=>$item)
<div class="modal custom-modal fade" id="update_subcategory_{{$item->id}}">
	<div class="modal-dialog modal-dialog-centered">
		<div class="modal-content">
			<div class="modal-header">
				<h4 class="modal-title">Update Category</h4>
				<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
			</div>
			<div class="modal-body">
				<form action="{{route('subcategory.update',$item->id)}}" method="post" enctype="multipart/form-data" id="update_subcategory_form_{{$item->id}}">
					@csrf
					@method('put')
					<div class="form-group">
						<label>Choose Category</label>
						<select name="category_id" id="category_id" class="form-control">
							@foreach($category as $category_item)
							<option value="{{$category_item->id}}" @if($item->category_id == $category_item->id) selected @endif>{{$category_item->category_name}}</option>
							@endforeach
						</select>
					</div>
					<div class="form-group">
						<label>Sub Category Name</label>
						<input class="form-control form-white" placeholder="Enter name" type="text" name="subcategory_name" value="{{$item->subcategory_name}}">
						<span class="text-danger" id="update_subcategory_name_error"></span>
					</div>
					<!-- <div class="form-group">
						<label>Choose Sub Category Image</label>
						<input type="file" name="subcategory_image" accept="image/*" class="form-control" />
						<span class="text-danger" id="update_subcategory_image_error"></span>
						<img src="{{ asset('Sub Category Image/'.$item->subcategory_image)}}" alt="" height="80px" width="80px">
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
		$('#subcategory_form').on('submit', function(event) {
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
						if (response.errors.subcategory_name) {
							document.getElementById("subcategory_name_error").innerText = response.errors.subcategory_name[0];
						} else {
							document.getElementById("subcategory_name_error").innerText = '';
						}
						// if (response.errors.subcategory_image) {
						// 	document.getElementById("subcategory_image_error").innerText = response.errors.subcategory_image[0];
						// } else {
						// 	document.getElementById("subcategory_image_error").innerText = '';
						// }
					} else if (response.success) {
						// If no errors, reset form and close modal
						document.getElementById("subcategory_form").reset();
						$('#add_subcategory').modal('hide');
						// Clear error messages
						document.getElementById("subcategory_name_error").innerText = '';
						// document.getElementById("subcategory_image_error").innerText = '';
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
		$('[id^=update_subcategory_]').find('form').on('submit', function(event) {
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
						if (response.errors.subcategory_name) {
							$('#update_subcategory_name_error').text(response.errors.subcategory_name[0]);
						} else {
							$('#update_subcategory_name_error').text('');
						}
						// if (response.errors.subcategory_image) {
						// 	$('#update_subcategory_image_error').text(response.errors.subcategory_image[0]);
						// } else {
						// 	$('#update_subcategory_image_error').text('');
						// }
					} else if (response.success) {
						// If no errors, reset form and close modal
						$('#update_subcategory_form_' + id)[0].reset();
						$('#update_subcategory_' + id).modal('hide');
						// Clear error messages
						$('#update_subcategory_name_error').text('');
						// $('#update_subcategory_image_error').text('');
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
		document.getElementById("update_subcategory_form").reset();
		$('#add_subcategory').modal('hide');
		document.getElementById("subcategory_name_error").innerText = '';
		// document.getElementById("subcategory_image_error").innerText = '';
	}
</script>