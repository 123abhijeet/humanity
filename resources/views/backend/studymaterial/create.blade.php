@extends('backend.layouts.master')
@section('title','Study Material | Sattree Gurukul')
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
					<h5 class="text-uppercase mb-0 mt-0 page-title">add Study Material</h5>
				</div>
				<div class="col-lg-6 col-md-6 col-sm-6 col-12">
					<ul class="breadcrumb float-right p-0 mb-0">
						<li class="breadcrumb-item">
							<a href="{{route('Admin-Dashboard')}}"><i class="fas fa-home"></i> Home</a>
						</li>
						<li class="breadcrumb-item">
							<a href="{{route('studymaterials.index')}}">Study Material</a>
						</li>
						<li class="breadcrumb-item"><span> Add Study Material</span></li>
					</ul>
				</div>
			</div>
		</div>
		<div class="page-content">
			<div class="row">
				<div class="col-lg-12 col-md-12 col-sm-12 col-12">
					<div class="card">
						<div class="card-body">
							<form method="post" action="{{route('studymaterials.store')}}" enctype="multipart/form-data">
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
											<label>Title <span class="text-danger">*</span></label>
											<input type="text" class="form-control @error('title') is-invalid @enderror" name="title" value="{{old('title')}}" />
											@error('title')
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
											<label>Type<span class="text-danger">*</span></label>
											<select class="form-control @error('type') is-invalid @enderror" name="type" id="type">
												<option value="" selected disabled>Select Type</option>
												@foreach($types as $item)
												<option value="{{$item->id}}" {{ old('type') == $item->id ? 'selected' : '' }}>{{$item->type}}</option>
												@endforeach
											</select>
											@error('type')
											<span class="invalid-feedback" role="alert">
												<strong>{{ $message }}</strong>
											</span>
											@enderror
										</div>
										<div class="form-group hide_subject">
											<label>Subject <span class="text-danger">*</span></label>
											<input type="text" class="form-control @error('subject') is-invalid @enderror" name="subject" value="{{old('subject')}}" />
											@error('subject')
											<span class="invalid-feedback" role="alert">
												<strong>{{ $message }}</strong>
											</span>
											@enderror
										</div>
										<div class="form-group">
											<label>Total Chapters <span class="text-danger">*</span></label>
											<input type="text" id="total_chapters" class="form-control @error('total_chapters') is-invalid @enderror" name="total_chapters" value="{{old('total_chapters')}}" />
											@error('total_chapters')
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
														<th>Chapter</th>
														<th>Upload PDF</th>
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
											<a href="{{route('studymaterials.index')}}" class="btn btn-secondary">Cancel</a>
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
	// Function to add rows to the table
	function addRowsToTable(numRows) {
		var tableBody = document.querySelector('.custom-table tbody');
		tableBody.innerHTML = ''; // Clear existing rows

		for (var i = 0; i < numRows; i++) {
			var newRow = document.createElement('tr');
			newRow.innerHTML = `
                <td>${i + 1}</td>
				<td><input type="text" class="form-control large-input" name="chapter[]" style="width: 100%;" required/></td>
				<td><input type="file" class="form-control" name="pdf[]" accept="application/pdf" required/></td>
            `;
			tableBody.appendChild(newRow);
		}
	}

	// Event listener for changes in total_chapters input field
	document.getElementById('total_chapters').addEventListener('input', function() {
		var totalQuestions = parseInt(this.value);
		if (!isNaN(totalQuestions)) {
			addRowsToTable(totalQuestions);
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