@extends('backend.layouts.master')
@section('title','Quiz | Sattree Gurukul')
@section('body')
<style>
	/* Custom styles for input fields */
	.large-input {
		width: 200%;
		/* Full width */
	}

	.small-input {
		width: 100%;
		/* Half width */
	}
</style>
<div class="page-wrapper">
	<div class="content container-fluid">
		<div class="page-header">
			<div class="row">
				<div class="col-lg-6 col-md-6 col-sm-6 col-12">
					<h5 class="text-uppercase mb-0 mt-0 page-title">add Quiz</h5>
				</div>
				<div class="col-lg-6 col-md-6 col-sm-6 col-12">
					<ul class="breadcrumb float-right p-0 mb-0">
						<li class="breadcrumb-item">
							<a href="{{route('Admin-Dashboard')}}"><i class="fas fa-home"></i> Home</a>
						</li>
						<li class="breadcrumb-item">
							<a href="{{route('quizzes.index')}}">Quiz</a>
						</li>
						<li class="breadcrumb-item"><span> Add Quiz</span></li>
					</ul>
				</div>
			</div>
		</div>
		<div class="page-content">
			<div class="row">
				<div class="col-lg-12 col-md-12 col-sm-12 col-12">
					<div class="card">
						<div class="card-body">
							<form method="post" action="{{route('quizzes.store')}}" enctype="multipart/form-data">
								@csrf
								<div class="row">
									<div class="col-lg-6 col-md-6 col-sm-6 col-12">
										<div class="form-group">
											<label>Course Category <span class="text-danger">*</span></label>
											<select class="form-control @error('course_category') is-invalid @enderror" name="course_category" id="course_category">
												<option value="" selected disabled>Select Category</option>
												@foreach($category as $item)
												<option value="{{$item->id}}" {{ old('course_category') == $item->id ? 'selected' : '' }}>{{$item->category_name}}</option>
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
											<input type="text" class="form-control @error('title') is-invalid @enderror" name="title" value="{{old('title')}}" />
											@error('title')
											<span class="invalid-feedback" role="alert">
												<strong>{{ $message }}</strong>
											</span>
											@enderror
										</div>
										<div class="form-group">
											<label>Quiz Level <span class="text-danger">*</span></label>
											<select name="level" id="quiz_level" class="form-control @error('level') is-invalid @enderror">
												<option value="Easy" {{ old('level') == 'Easy' ? 'selected' : '' }}>Easy</option>
												<option value="Medium" {{ old('level') == 'Medium' ? 'selected' : '' }}>Medium</option>
												<option value="Hard" {{ old('level') == 'Hard' ? 'selected' : '' }}>Hard</option>
											</select>
											@error('level')
											<span class="invalid-feedback" role="alert">
												<strong>{{ $message }}</strong>
											</span>
											@enderror
										</div>
										<div class="form-group paid_quiz" style="display: none;">
											<label>Price (Rs) <span class="text-danger">*</span></label>
											<input type="text" class="form-control @error('price') is-invalid @enderror required" name="price" value="{{old('price')}}" />
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
											<input type="text" class="form-control @error('subject') is-invalid @enderror" name="subject" value="{{old('subject')}}" />
											@error('subject')
											<span class="invalid-feedback" role="alert">
												<strong>{{ $message }}</strong>
											</span>
											@enderror
										</div>
										<div class="form-group">
											<label>Total Questions <span class="text-danger">*</span></label>
											<input type="text" id="total_questions" class="form-control @error('total_questions') is-invalid @enderror" name="total_questions" value="{{old('total_questions')}}" />
											@error('total_questions')
											<span class="invalid-feedback" role="alert">
												<strong>{{ $message }}</strong>
											</span>
											@enderror
										</div>
										<div class="form-group">
											<label>Quiz Duration <span class="text-danger">*</span></label>
											<input type="time" class="form-control @error('total_time') is-invalid @enderror" name="total_time" value="{{old('total_time')}}" />
											@error('total_time')
											<span class="invalid-feedback" role="alert">
												<strong>{{ $message }}</strong>
											</span>
											@enderror
										</div>
										<div class="form-group paid_quiz" style="display: none;">
											<label>Attempt Date <span class="text-danger">*</span></label>
											<input type="datetime-local" class="form-control @error('attempt_date') is-invalid @enderror required" name="attempt_date" value="{{old('attempt_date')}}" />
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
	// Function to add rows to the table
	function addRowsToTable(numRows) {
		var tableBody = document.querySelector('.custom-table tbody');
		tableBody.innerHTML = ''; // Clear existing rows

		for (var i = 0; i <numRows; i++) {
			var newRow = document.createElement('tr');
			newRow.innerHTML = `
                <td>${i + 1}</td>
				<td><input type="text" class="form-control large-input" name="question[]" style="width: 100%;" required/></td>
				<td><input type="text" class="form-control small-input" name="option_a[]" style="width: 100%;" required/></td>
				<td><input type="text" class="form-control small-input" name="option_b[]" style="width: 100%;" required/></td>
				<td><input type="text" class="form-control small-input" name="option_c[]" style="width: 100%;" required/></td>
				<td><input type="text" class="form-control small-input" name="option_d[]" style="width: 100%;" required/></td>
				<td><input type="text" class="form-control small-input" name="answer[]" style="width: 100%;" required/></td>
            `;
			tableBody.appendChild(newRow);
		}
	}

	// Event listener for changes in total_questions input field
	document.getElementById('total_questions').addEventListener('input', function() {
		var totalQuestions = parseInt(this.value);
		if (!isNaN(totalQuestions)) {
			addRowsToTable(totalQuestions);
		}
	});

	function validateMobileNumber(input) {
		input.value = input.value.replace(/\D/g, ''); // Remove non-numeric characters
		if (input.value.length > 10) {
			input.value = input.value.slice(0, 10);
		}
	}

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