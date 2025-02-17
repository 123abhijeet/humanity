@extends('backend.layouts.master')
@section('title','Book | Sattree Gurukul')
@section('body')
<style>
	/* Custom styles for input fields */
	.large-input {
		width: 100%;
		/* Full width */
	}

	.small-input {
		width: 50%;
		/* Half width */
	}
</style>
<div class="page-wrapper">
	<div class="content container-fluid">
		<div class="page-header">
			<div class="row">
				<div class="col-lg-6 col-md-6 col-sm-6 col-12">
					<h5 class="text-uppercase mb-0 mt-0 page-title">add Book</h5>
				</div>
				<div class="col-lg-6 col-md-6 col-sm-6 col-12">
					<ul class="breadcrumb float-right p-0 mb-0">
						<li class="breadcrumb-item">
							<a href="{{route('Admin-Dashboard')}}"><i class="fas fa-home"></i> Home</a>
						</li>
						<li class="breadcrumb-item">
							<a href="{{route('books.index')}}">Book</a>
						</li>
						<li class="breadcrumb-item"><span> Add Book</span></li>
					</ul>
				</div>
			</div>
		</div>
		<div class="page-content">
			<div class="row">
				<div class="col-lg-12 col-md-12 col-sm-12 col-12">
					<div class="card">
						<div class="card-body">
							<div class="row">
								<div class="col-lg-6 col-md-6 col-sm-6 col-12">
									<form method="post" action="{{route('books.store')}}" enctype="multipart/form-data">
										@csrf
										<div class="form-group">
											<label>Title <span class="text-danger">*</span></label>
											<input type="text" placeholder="Title" name="title" class="form-control @error('title') is-invalid @enderror" value="{{old('title')}}">
											@error('title')
											<span class="invalid-feedback" role="alert">
												<strong>{{ $message }}</strong>
											</span>
											@enderror
										</div>
										<div class="form-group">
											<label>Language <span class="text-danger">*</span></label>
											<input type="text" placeholder="Language" name="language" class="form-control @error('language') is-invalid @enderror" value="{{old('language')}}">
											@error('language')
											<span class="invalid-feedback" role="alert">
												<strong>{{ $message }}</strong>
											</span>
											@enderror
										</div>
										<div class="form-group">
											<label>Subject <span class="text-danger">*</span></label>
											<input type="text" placeholder="Subject" name="subject" class="form-control @error('subject') is-invalid @enderror" value="{{old('subject')}}">
											@error('subject')
											<span class="invalid-feedback" role="alert">
												<strong>{{ $message }}</strong>
											</span>
											@enderror
										</div>
								</div>
								<div class="col-lg-6 col-md-6 col-sm-6 col-12">
									<div class="form-group">
										<label>Publication <span class="text-danger">*</span></label>
										<input type="text" placeholder="Publication" name="publication" class="form-control @error('publication') is-invalid @enderror" value="{{old('publication')}}">
										@error('publication')
										<span class="invalid-feedback" role="alert">
											<strong>{{ $message }}</strong>
										</span>
										@enderror
									</div>
									<div class="form-group">
										<label>Price <span class="text-danger">*</span></label>
										<input type="text" placeholder="Price" name="price" class="form-control @error('price') is-invalid @enderror" value="{{old('price')}}">
										@error('price')
										<span class="invalid-feedback" role="alert">
											<strong>{{ $message }}</strong>
										</span>
										@enderror
									</div>
									<div class="form-group">
										<label>Cover Image<span class="text-danger">*</span></label>
										<input type="file" class="form-control @error('cover_image') is-invalid @enderror" name="cover_image" accept="image/x-png,image/gif,image/jpeg" />
										@error('cover_image')
										<span class="invalid-feedback" role="alert">
											<strong>{{ $message }}</strong>
										</span>
										@enderror
									</div>
								</div>
								<div class="col-lg-12 col-md-12 col-sm-12 col-12">
									<div class="form-group">
										<label>Description</label>
										<textarea class="form-control @error('description') is-invalid @enderror" rows="4" name="description">{{old('description')}}</textarea>
										@error('description')
										<span class="invalid-feedback" role="alert">
											<strong>{{ $message }}</strong>
										</span>
										@enderror
									</div>
								</div>
								<div class="col-lg-12 col-md-12 col-sm-12 col-12">
									<div class="form-group text-center custom-mt-form-group">
										<button class="btn btn-primary mr-2" type="submit">
											Submit
										</button>
										<a href="{{route('books.index')}}" class="btn btn-secondary">Cancel</a>
									</div>
									</form>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>
<script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
<script>
	document.addEventListener('DOMContentLoaded', function() {
		var courseCategory = document.getElementById('course_category');
		var courseSubCategory = document.getElementById('course_subcategory');

		courseCategory.addEventListener('change', function() {
			var categoryId = this.value;
			courseSubCategory.innerHTML = ''; // Clear existing options

			var defaultOption = document.createElement('option');
			defaultOption.text = 'Select Sub Category';
			defaultOption.disabled = true;
			defaultOption.selected = true;
			courseSubCategory.add(defaultOption);

			// Make an AJAX request to fetch subcategories based on the selected category
			fetch('/get-subcategories/' + categoryId)
				.then(response => response.json())
				.then(data => {
					if (data.length > 0) { // Check if data is available
						data.forEach(function(subCategory) {
							var option = document.createElement('option');
							option.text = subCategory.subcategory_name;
							option.value = subCategory.id;
							courseSubCategory.add(option);
						});
					} else {
						var option = document.createElement('option');
						option.text = 'No Data Found';
						option.disabled = true;
						option.selected = true;
						courseSubCategory.add(option);
					}
				})
				.catch(error => console.error('Error:', error));
		});
	});

	var courseSubCategory = document.getElementById('course_subcategory');
	var courseDropdown = document.getElementById('course');

	courseSubCategory.addEventListener('change', function() {
		var subcategoryId = this.value;
		courseDropdown.innerHTML = ''; // Clear existing options

		// Make an AJAX request to fetch courses based on the selected subcategory
		fetch('/get-courses-by-subcategory/' + subcategoryId)
			.then(response => response.json())
			.then(data => {
				if (data.length > 0) { // Check if data is available
					data.forEach(function(course) {
						var option = document.createElement('option');
						option.text = course.course_name;
						option.value = course.id;
						courseDropdown.add(option);
					});
				} else {
					var option = document.createElement('option');
					option.text = 'No Courses Found';
					option.disabled = true;
					option.selected = true;
					courseDropdown.add(option);
				}
			})
			.catch(error => console.error('Error:', error));
	});
</script>
@endsection