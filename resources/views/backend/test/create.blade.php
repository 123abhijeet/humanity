@extends('backend.layouts.master')
@section('title','Test | Sattree Gurukul')
@section('body')
<div class="page-wrapper">
	<div class="content container-fluid">
		<div class="page-header">
			<div class="row">
				<div class="col-lg-6 col-md-6 col-sm-6 col-12">
					<h5 class="text-uppercase mb-0 mt-0 page-title">add Test</h5>
				</div>
				<div class="col-lg-6 col-md-6 col-sm-6 col-12">
					<ul class="breadcrumb float-right p-0 mb-0">
						<li class="breadcrumb-item">
							<a href="{{route('Admin-Dashboard')}}"><i class="fas fa-home"></i> Home</a>
						</li>
						<li class="breadcrumb-item">
							<a href="{{route('tests.index')}}">Test</a>
						</li>
						<li class="breadcrumb-item"><span> Add Test</span></li>
					</ul>
				</div>
			</div>
		</div>
		<div class="page-content">
			<div class="row">
				<div class="col-lg-12 col-md-12 col-sm-12 col-12">
					<div class="card">
						<div class="card-body">
							<form method="post" action="{{route('tests.store')}}">
								@csrf
								<div class="row">
									<div class="col-lg-6 col-md-6 col-sm-6 col-12">
										<div class="form-group">
											<label>Category <span class="text-danger">*</span></label>
											<select class="form-control @error('course_category') is-invalid @enderror" name="course_category" id="course_category">
												<option value="" selected disabled>Select Category</option>
												@foreach($category as $item)
												<option value="{{$item->id}}"  {{ old('course_category') == $item->id ? 'selected' : '' }}>{{$item->category_name}}</option>
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
											<label>Test Type <span class="text-danger">*</span></label>
											<select name="type" id="test_type" class="form-control @error('type') is-invalid @enderror">
												<option value="Objective" {{ old('type') == 'Objective' ? 'selected' : '' }}>Objective</option>
												<option value="Subjective" {{ old('type') == 'Subjective' ? 'selected' : '' }} Selected>Subjective</option>
											</select>
											@error('type')
											<span class="invalid-feedback" role="alert">
												<strong>{{ $message }}</strong>
											</span>
											@enderror
										</div>
										<div class="form-group">
											<label>Test Duration <span class="text-danger">*</span></label>
											<input type="time" class="form-control @error('total_time') is-invalid @enderror" name="total_time" value="{{old('total_time')}}" />
											@error('total_time')
											<span class="invalid-feedback" role="alert">
												<strong>{{ $message }}</strong>
											</span>
											@enderror
										</div>
										<div class="form-group">
											<label>Test Level <span class="text-danger">*</span></label>
											<select name="level" id="test_level" class="form-control @error('level') is-invalid @enderror">
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

									</div>
									<div class="col-lg-6 col-md-6 col-sm-6 col-12">
										<div class="form-group">
											<label>Sub Category <span class="text-danger">*</span></label>
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
											<label>Test Title <span class="text-danger">*</span></label>
											<input type="text" class="form-control @error('title') is-invalid @enderror" name="title" value="{{old('title')}}" />
											@error('title')
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

										<div class="form-group">
											<label>Total Questions <span class="text-danger">*</span></label>
											<input type="text" id="total_questions" class="form-control @error('total_questions') is-invalid @enderror" name="total_questions" value="{{old('total_questions')}}" />
											@error('total_questions')
											<span class="invalid-feedback" role="alert">
												<strong>{{ $message }}</strong>
											</span>
											@enderror
										</div>
									</div>

									<div class="col-lg-12 col-md-12 col-sm-12 col-12" id="subjective">
										<div class="table-responsive">
											<table class="table custom-table datatable">
												<thead class="thead-light">
													<tr>
														<th>#</th>
														<th>Question</th>
													</tr>
												</thead>
												<tbody>

												</tbody>
											</table>
										</div>
									</div>
									<div class="col-lg-12 col-md-12 col-sm-12 col-12" style="display: none;" id="objective">
										<div style="overflow-x: auto;" class="table-responsive">
											<table class="table custom-table datatable objective" style="min-width: 800px;">
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
											<a href="{{route('tests.index')}}" class="btn btn-secondary">Cancel</a>
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
	$('#test_type').on('change', function() {
		$('#total_questions').val('');
		var tableBody = document.querySelector('.custom-table tbody');
		tableBody.innerHTML = '';
		var test_type = $(this).val();
		if (test_type == 'Objective') {
			$('#objective').css('display', 'block');
			$('#subjective').css('display', 'none');
		} else {
			$('#objective').css('display', 'none');
			$('#subjective').css('display', 'block');
		}
	});

	// Function to add rows to the table
	function addSubjectiveRowsToTable(numRows) {
		console.log('Adding subjective rows');
		var tableBody = document.querySelector('.custom-table tbody');
		tableBody.innerHTML = ''; // Clear existing rows

		for (var i = 0; i < numRows; i++) {
			var newRow = document.createElement('tr');
			newRow.innerHTML = `
                <td>${i + 1}</td>
                <td><input type="text" class="form-control large-input" name="question[]" /></td>
            `;
			tableBody.appendChild(newRow);
		}
	}

	// Function to add rows to the table
	function addObjectiveRowsToTable(numRows) {
		console.log('Adding objective rows');
		var tableBody = document.querySelector('.objective tbody');
		tableBody.innerHTML = ''; // Clear existing rows

		for (var i = 0; i < numRows; i++) {
			var newRow = document.createElement('tr');
			newRow.innerHTML = `
            <td>${i + 1}</td>
            <td><input type="text" class="form-control large-input" name="question[]" /></td>
            <td><input type="text" class="form-control small-input" name="option_a[]" /></td>
            <td><input type="text" class="form-control small-input" name="option_b[]" /></td>
            <td><input type="text" class="form-control small-input" name="option_c[]" /></td>
            <td><input type="text" class="form-control small-input" name="option_d[]" /></td>
            <td><input type="text" class="form-control small-input" name="answer[]" /></td>
        `;
			tableBody.appendChild(newRow);
		}
	}

	// Event listener for changes in total_questions input field
	document.getElementById('total_questions').addEventListener('input', function() {
		var totalQuestions = parseInt(this.value);
		if (!isNaN(totalQuestions)) {
			var test_type = $('#test_type').val();
			if (test_type == 'Objective') {
				addObjectiveRowsToTable(totalQuestions);
			} else {
				addSubjectiveRowsToTable(totalQuestions);
			}
		}
	});

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