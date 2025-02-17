@extends('backend.layouts.master')
@section('title','Quiz | Sattree Gurukul')
@section('body')
<div class="page-wrapper">
	<div class="content container-fluid">
		<div class="page-header">
			<div class="row">
				<div class="col-lg-6 col-md-6 col-sm-6 col-12">
					<h5 class="text-uppercase mb-0 mt-0 page-title">Edit Quiz</h5>
				</div>
				<div class="col-lg-6 col-md-6 col-sm-6 col-12">
					<ul class="breadcrumb float-right p-0 mb-0">
						<li class="breadcrumb-item">
							<a href="{{route('Admin-Dashboard')}}"><i class="fas fa-home"></i> Home</a>
						</li>
						<li class="breadcrumb-item">
							<a href="{{route('quizzes.index')}}">Quiz</a>
						</li>
						<li class="breadcrumb-item"><span> Edit Quiz</span></li>
					</ul>
				</div>
			</div>
		</div>
		<div class="page-content">
			<div class="row">
				<div class="col-lg-12 col-md-12 col-sm-12 col-12">
					<div class="card">
						<div class="card-body">
							<form method="post" action="{{route('quizzes.update',$quiz->id)}}" enctype="multipart/form-data">
								@csrf
								@method('put')
								<div class="row">
									<div class="col-lg-6 col-md-6 col-sm-6 col-12">
										<div class="form-group">
											<label>Course Category</label>
											<select class="form-control @error('course_category') is-invalid @enderror" name="course_category" id="course_category">
												@foreach($category as $item)
												<option value="{{$item->id}}" @if($quiz->course_category == $item->id) selected @endif>{{$item->category_name}}</option>
												@endforeach
											</select>
											@error('course_category')
											<span class="invalid-feedback" role="alert">
												<strong>{{ $message }}</strong>
											</span>
											@enderror
										</div>
										<div class="form-group">
											<label>Choose Course <span class="text-danger">*</span></label>
											<select class="form-control @error('course') is-invalid @enderror" name="course" id="course">
												<option value="" selected disabled>Select Course</option>

											</select>
											@error('course')
											<span class="invalid-feedback" role="alert">
												<strong>{{ $message }}</strong>
											</span>
											@enderror
										</div>
										<div class="form-group">
											<label>Quiz Title <span class="text-danger">*</span></label>
											<input type="text" class="form-control @error('title') is-invalid @enderror" name="title" value="{{$quiz->title}}" />
											@error('title')
											<span class="invalid-feedback" role="alert">
												<strong>{{ $message }}</strong>
											</span>
											@enderror
										</div>
										<div class="form-group">
											<label>Quiz Level <span class="text-danger">*</span></label>
											<select name="level" id="quiz_level" class="form-control @error('level') is-invalid @enderror">
												<option value="Easy" @if($quiz->level == 'Easy') selected @endif>Easy</option>
												<option value="Medium" @if($quiz->level == 'Medium') selected @endif>Medium</option>
												<option value="Hard" @if($quiz->level == 'Hard') selected @endif>Hard</option>
											</select>
											@error('level')
											<span class="invalid-feedback" role="alert">
												<strong>{{ $message }}</strong>
											</span>
											@enderror
										</div>
										<div class="form-group paid_quiz" style="display: none;">
											<label>Price (Rs) <span class="text-danger">*</span></label>
											<input type="text" class="form-control @error('price') is-invalid @enderror required" name="price" value="{{$quiz->price}}" />
											@error('price')
											<span class="invalid-feedback" role="alert">
												<strong>{{ $message }}</strong>
											</span>
											@enderror
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
										<div class="form-group">
											<label>Quiz Subject <span class="text-danger">*</span></label>
											<input type="text" class="form-control @error('subject') is-invalid @enderror" name="subject" value="{{$quiz->subject}}" />
											@error('subject')
											<span class="invalid-feedback" role="alert">
												<strong>{{ $message }}</strong>
											</span>
											@enderror
										</div>
										<div class="form-group">
											<label>Total Questions <span class="text-danger">*</span></label>
											<input type="text" id="total_questions" class="form-control @error('total_questions') is-invalid @enderror" name="total_questions" value="{{$quiz->total_questions}}" readonly />
											@error('total_questions')
											<span class="invalid-feedback" role="alert">
												<strong>{{ $message }}</strong>
											</span>
											@enderror
										</div>
										<div class="form-group">
											<label>Quiz Duration <span class="text-danger">*</span></label>
											<input type="time" class="form-control @error('total_time') is-invalid @enderror" name="total_time" value="{{$quiz->total_time}}" />
											@error('total_time')
											<span class="invalid-feedback" role="alert">
												<strong>{{ $message }}</strong>
											</span>
											@enderror
										</div>
										<div class="form-group paid_quiz" style="display: none;">
											<label>Attempt Date <span class="text-danger">*</span></label>
											<input type="datetime-local" class="form-control @error('attempt_date') is-invalid @enderror required" name="attempt_date" value="{{$quiz->attempt_date}}" />
											@error('attempt_date')
											<span class="invalid-feedback" role="alert">
												<strong>{{ $message }}</strong>
											</span>
											@enderror
										</div>

									</div>
									<div class="col-lg-12 col-md-12 col-sm-12 col-12">
										<div style="overflow-x: auto;" class="table-responsive">
											<table class="table custom-table datatable" style="min-width: 800px;">
												<thead class="thead-light">
													<tr>
														<th>#</th>
														<th style="width: 30%;">Question</th>
														<th style="width: 15%;">Option A</th>
														<th style="width: 15%;">Option B</th>
														<th style="width: 15%;">Option C</th>
														<th style="width: 15%;">Option D</th>
														<th style="width: 15%;">Answer</th>
													</tr>
												</thead>
												<tbody>
													@foreach($quiz_questions as $key=>$item)
													<tr>
														<td>{{++$key}}</td>
														<td>{{$item->question}}</td>
														<td>{{$item->option_a}}</td>
														<td>{{$item->option_b}}</td>
														<td>{{$item->option_c}}</td>
														<td>{{$item->option_d}}</td>
														<td>{{$item->answer}}</td>
													</tr>
													@endforeach
												</tbody>
											</table>
										</div>
									</div>
									<div class="col-lg-12 col-md-12 col-sm-12 col-12">
										<div class="form-group text-center custom-mt-form-group">
											<button class="btn btn-primary mr-2" type="submit">
												Submit
											</button>
											<a href="{{route('quizzes.index')}}" class="btn btn-secondary">Cancel</a>
										</div>
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
<script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
@if(Auth::check() && Auth::user()->hasRole('Admin'))
<script>
	$(document).ready(function() {
		$('.paid_quiz').css('display', 'block');
	});
</script>
@else
<script>
	$(document).ready(function() {
		$('.paid_quiz').css('display', 'none');
	});
</script>
@endif
<script>
	document.addEventListener('DOMContentLoaded', function() {

		var courseCategory = document.getElementById('course_category');
		var courseSubCategory = document.getElementById('course_subcategory');
		var courseDropdown = document.getElementById('course');
		var selectedSubCategory = "{{ $quiz->course_subcategory }}";
		var selectedCourse = "{{ $quiz->course }}";

		// Function to fetch and populate subcategories based on the selected category
		function populateSubcategories(categoryId) {
			// Clear existing options
			courseSubCategory.innerHTML = '';

			var defaultOption = document.createElement('option');
			defaultOption.text = 'Select Sub Category';
			defaultOption.disabled = true;
			defaultOption.selected = true;
			courseSubCategory.add(defaultOption);
			// Make an AJAX request to fetch subcategories based on the selected category
			fetch('/get-subcategories/' + categoryId)
				.then(response => {
					if (!response.ok) {
						throw new Error('Network response was not ok');
					}
					return response.json();
				})
				.then(data => {
					if (data.length > 0) {
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
						courseSubCategory.add(option);
					}
					courseSubCategory.value = selectedSubCategory;
					var subcategory_value = $('#course_subcategory').val();

					if (subcategory_value == null) {
						courseSubCategory.selectedIndex = 0;
					}
					// Trigger change event to update courses based on the selected subcategory
					courseSubCategory.dispatchEvent(new Event('change'));
				})
				.catch(error => console.error('Error:', error));
		}

		// Function to fetch and populate courses based on the selected subcategory
		function populateCourses(subcategoryId) {
			// Clear existing options
			courseDropdown.innerHTML = '';

			// Make an AJAX request to fetch courses based on the selected subcategory
			fetch('/get-courses-by-subcategory/' + subcategoryId)
				.then(response => {
					if (!response.ok) {
						throw new Error('Network response was not ok');
					}
					return response.json();
				})
				.then(data => {
					if (data.length > 0) {
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
						courseDropdown.add(option);
					}
					courseDropdown.value = selectedCourse;
					var course_value = $('#course').val();

					if (course_value == null) {
						courseDropdown.selectedIndex = 0;
					}
				})
				.catch(error => console.error('Error:', error));
		}

		// Trigger populateSubcategories function when the category dropdown changes
		courseCategory.addEventListener('change', function() {
			var categoryId = this.value;
			populateSubcategories(categoryId);
		});

		// Trigger populateCourses function when the subcategory dropdown changes
		courseSubCategory.addEventListener('change', function() {
			var subcategoryId = this.value;
			populateCourses(subcategoryId);
		});

		// Trigger populateSubcategories function on page load to populate subcategory based on the selected category
		var categoryId = courseCategory.value;
		populateSubcategories(categoryId);
	});
</script>

@endsection