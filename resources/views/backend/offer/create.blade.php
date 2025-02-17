@extends('backend.layouts.master')
@section('title','Offer | Sattree Gurukul')
@section('body')
<div class="page-wrapper">
	<div class="content container-fluid">
		<div class="page-header">
			<div class="row">
				<div class="col-lg-6 col-md-6 col-sm-6 col-12">
					<h5 class="text-uppercase mb-0 mt-0 page-title">add Offer</h5>
				</div>
				<div class="col-lg-6 col-md-6 col-sm-6 col-12">
					<ul class="breadcrumb float-right p-0 mb-0">
						<li class="breadcrumb-item">
							<a href="{{route('Admin-Dashboard')}}"><i class="fas fa-home"></i> Home</a>
						</li>
						<li class="breadcrumb-item">
							<a href="{{route('offers.index')}}">Offer</a>
						</li>
						<li class="breadcrumb-item"><span> Add Offer</span></li>
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
									<form method="post" action="{{route('offers.store')}}" enctype="multipart/form-data">
										@csrf
										<div class="form-group">
											<label>Course Category <span class="text-danger">*</span></label>
											<select class="form-control @error('course_category') is-invalid @enderror" name="course_category" id="course_category">
												<option value="" selected disabled>Select Category</option>
												@foreach($category as $item)
												<option value="{{$item->id}}">{{$item->category_name}}</option>
												@endforeach
											</select>
											@error('course_category')
											<span class="invalid-feedback" role="alert">
												<strong>{{ $message }}</strong>
											</span>
											@enderror
										</div>
										<div class="form-group">
											<label>Offer For <span class="text-danger">*</span></label>
											<select name="offer_type" id="offer_type" class="form-control">
												<option value="course">Course</option>
												<option value="quiz">Quiz</option>
											</select>
										</div>
										<div class="form-group">
											<label>Offer Title <span class="text-danger">*</span></label>
											<input type="text" class="form-control @error('offer_title') is-invalid @enderror" name="offer_title" value="{{old('offer_title')}}" />
											@error('offer_title')
											<span class="invalid-feedback" role="alert">
												<strong>{{ $message }}</strong>
											</span>
											@enderror
										</div>
										<div class="form-group">
											<label>Offer Banner <span class="text-danger">*</span><small class="text-danger">Allowed file size :JPG of 2000 X 1333 less than 2MB</small></label>
											<input type="file" class="form-control @error('offer_banner') is-invalid @enderror" name="offer_banner" />
											@error('offer_banner')
											<span class="invalid-feedback" role="alert">
												<strong>{{ $message }}</strong>
											</span>
											@enderror
										</div>
										<div class="form-group">
											<label>Offer Start Date <span class="text-danger">*</span></label>
											<input type="date" class="form-control @error('start_date') is-invalid @enderror" name="start_date" value="{{old('start_date')}}" />
											@error('start_date')
											<span class="invalid-feedback" role="alert">
												<strong>{{ $message }}</strong>
											</span>
											@enderror
										</div>
										<div class="form-group">
											<label>Status<span class="text-danger">*</span></label>
											<select name="status" class="form-control">
												<option value="1">Active</option>
												<option value="0">Inactive</option>
											</select>
										</div>
								</div>
								<div class="col-lg-6 col-md-6 col-sm-6 col-12">
									<div class="form-group">
										<label>Course Sub Category <span class="text-danger">*</span></label>
										<select class="form-control @error('course_subcategory') is-invalid @enderror" name="course_subcategory" id="course_subcategory">
											<option value="" selected disabled>Select Sub Category</option>
										</select>
										@error('course_subcategory')
										<span class="invalid-feedback" role="alert">
											<strong>{{ $message }}</strong>
										</span>
										@enderror
									</div>

									<div class="form-group" id="course" style="display: none;">
										<label>Choose Course <span class="text-danger">*</span></label>
										<select class="form-control @error('course_id') is-invalid @enderror" name="course_id" id="course_id">
											<option value="" selected disabled>Select Course</option>
										</select>
										@error('course_id')
										<span class="invalid-feedback" role="alert">
											<strong>{{ $message }}</strong>
										</span>
										@enderror
									</div>
									<div class="form-group" id="quiz" style="display: none;">
										<label>Choose Quiz <span class="text-danger">*</span></label>
										<select class="form-control @error('quiz_id') is-invalid @enderror" name="quiz_id" id="quiz_id">
											<option value="" selected disabled>Select Quiz</option>
										</select>
										@error('quiz_id')
										<span class="invalid-feedback" role="alert">
											<strong>{{ $message }}</strong>
										</span>
										@enderror
									</div>

									<div class="form-group">
										<label>Coupon Code <span class="text-danger">*</span></label>
										<input type="text" class="form-control @error('offer_code') is-invalid @enderror" name="offer_code" value="{{old('offer_code')}}" />
										@error('offer_code')
										<span class="invalid-feedback" role="alert">
											<strong>{{ $message }}</strong>
										</span>
										@enderror
									</div>
									<div class="form-group">
										<label>Offer Value (Rs) <span class="text-danger">*</span></label>
										<input type="text" class="form-control @error('offer_value') is-invalid @enderror" name="offer_value" value="{{old('offer_value')}}" />
										@error('offer_value')
										<span class="invalid-feedback" role="alert">
											<strong>{{ $message }}</strong>
										</span>
										@enderror
									</div>

									<div class="form-group">
										<label>Offer End Date <span class="text-danger">*</span></label>
										<input type="date" class="form-control @error('end_date') is-invalid @enderror" name="end_date" value="{{old('end_date')}}" />
										@error('end_date')
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
										<a href="{{route('offers.index')}}" class="btn btn-secondary">Cancel</a>
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
	var courseDropdown = document.getElementById('course_id');
	var quizDropdown = document.getElementById('quiz_id');

	courseSubCategory.addEventListener('change', function() {
		var subcategoryId = this.value;
		courseDropdown.innerHTML = ''; // Clear existing options
		quizDropdown.innerHTML = '';

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
		// Make an AJAX request to fetch courses based on the selected subcategory
		fetch('/get-quiz-by-subcategory/' + subcategoryId)
			.then(response => response.json())
			.then(data => {
				if (data.length > 0) { // Check if data is available
					data.forEach(function(quiz) {
						var option = document.createElement('option');
						option.text = quiz.title;
						option.value = quiz.id;
						quizDropdown.add(option);
					});
				} else {
					var option = document.createElement('option');
					option.text = 'No Quiz Found';
					option.disabled = true;
					option.selected = true;
					quizDropdown.add(option);
				}
			})
			.catch(error => console.error('Error:', error));
	});

	document.getElementById('course').style.display = "block";
	$('#offer_type').on('change', function() {
		var offer_type = $(this).val();
		if (offer_type == 'course') {
			document.getElementById('course').style.display = "block";
			document.getElementById('quiz').style.display = "none";
			document.getElementById('course_id').setAttribute('required', 'required');
		} else {
			document.getElementById('course').style.display = "none";
			document.getElementById('quiz').style.display = "block";
			document.getElementById('quiz_id').removeAttribute('required');

			var courseSubCategory = document.getElementById('course_subcategory');
			var quizDropdown = document.getElementById('quiz_id');

			var subcategoryId = courseSubCategory.value;
			quizDropdown.innerHTML = ''; // Clear existing options

			// Make an AJAX request to fetch courses based on the selected subcategory
			fetch('/get-quiz-by-subcategory/' + subcategoryId)
				.then(response => response.json())
				.then(data => {
					if (data.length > 0) { // Check if data is available
						data.forEach(function(quiz) {
							var option = document.createElement('option');
							option.text = quiz.title;
							option.value = quiz.id;
							quizDropdown.add(option);
						});
					} else {
						var option = document.createElement('option');
						option.text = 'No Quiz Found';
						option.disabled = true;
						option.selected = true;
						quizDropdown.add(option);
					}
				})
				.catch(error => console.error('Error:', error));
		}
	});
</script>
@endsection