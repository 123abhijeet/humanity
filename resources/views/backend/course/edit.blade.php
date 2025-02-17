@extends('backend.layouts.master')
@section('title','Course | Sattree Gurukul')
@section('body')
<div class="page-wrapper">
	<div class="content container-fluid">
		<div class="page-header">
			<div class="row">
				<div class="col-lg-6 col-md-6 col-sm-6 col-12">
					<h5 class="text-uppercase mb-0 mt-0 page-title">Edit Course</h5>
				</div>
				<div class="col-lg-6 col-md-6 col-sm-6 col-12">
					<ul class="breadcrumb float-right p-0 mb-0">
						<li class="breadcrumb-item">
							<a href="{{route('Admin-Dashboard')}}"><i class="fas fa-home"></i> Home</a>
						</li>
						<li class="breadcrumb-item">
							<a href="{{route('courses.index')}}">Course</a>
						</li>
						<li class="breadcrumb-item"><span> Edit Course</span></li>
					</ul>
				</div>
			</div>
		</div>
		<div class="page-content">
			<div class="row">
				<div class="col-lg-12 col-md-12 col-sm-12 col-12">
					<div class="card">
						<div class="card-body">
							<form method="post" action="{{route('courses.update',$course->id)}}" enctype="multipart/form-data">
								@csrf
								@method('put')
								<div class="row">
									<div class="col-lg-6 col-md-6 col-sm-6 col-12">
										<div class="form-group">
											<label>Course Category</label>
											<select class="form-control @error('course_category') is-invalid @enderror" name="course_category" id="course_category">
												@foreach($category as $item)
												<option value="{{$item->id}}" @if($course->course_category == $item->id) selected @endif>{{$item->category_name}}</option>
												@endforeach
											</select>
											@error('course_category')
											<span class="invalid-feedback" role="alert">
												<strong>{{ $message }}</strong>
											</span>
											@enderror
										</div>
										<div class="form-group">
											<label>Course ID</label>
											<input type="text" class="form-control @error('course_uid') is-invalid @enderror" name="course_uid" value="{{$course->course_uid}}" />
											@error('course_uid')
											<span class="invalid-feedback" role="alert">
												<strong>{{ $message }}</strong>
											</span>
											@enderror
										</div>
										<div class="form-group">
											<label>Course Name</label>
											<input type="text" class="form-control @error('course_name') is-invalid @enderror" name="course_name" value="{{ $course->course_name}}" />
											@error('course_name')
											<span class="invalid-feedback" role="alert">
												<strong>{{ $message }}</strong>
											</span>
											@enderror
										</div>
										<div class="form-group">
											<label>Course Fee</label>
											<input type="text" class="form-control @error('course_fee') is-invalid @enderror" name="course_fee" value="{{ $course->course_fee}}" />
											@error('course_fee')
											<span class="invalid-feedback" role="alert">
												<strong>{{ $message }}</strong>
											</span>
											@enderror
										</div>
										<div class="form-group">
											<label>Subject</label>
											<input type="text" class="form-control @error('subject') is-invalid @enderror" name="subject" value="{{ $course->subject}}" />
											@error('subject')
											<span class="invalid-feedback" role="alert">
												<strong>{{ $message }}</strong>
											</span>
											@enderror
										</div>
										<div class="form-group">
											<label>Course Level <span class="text-danger">*</span></label>
											<select name="level" id="level" class="form-control @error('level') is-invalid @enderror">
												<option value="Beginner" @if($course->level == 'Beginner') selected @endif>Beginner Level</option>
												<option value="Intermediate" @if($course->level == 'Intermediate') selected @endif>Intermediate Level</option>
												<option value="Advanced" @if($course->level == 'Advanced') selected @endif>Advanced Level</option>
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
											<label>Course Sub Category</label>
											<select class="form-control @error('course_subcategory') is-invalid @enderror" name="course_subcategory" id="course_subcategory">
												<option value="" selected disabled>Select Sub Category</option>
												@foreach($subcategory as $item)
												<option value="{{$item->id}}" {{$item->id == $course->course_subcategory ? 'selected' : ''}}>{{$item->subcategory_name}}</option>
												@endforeach
											</select>
											@error('course_subcategory')
											<span class="invalid-feedback" role="alert">
												<strong>{{ $message }}</strong>
											</span>
											@enderror
										</div>
										<div class="form-group">
											<label>Course Duration <span class="text-danger">(Hours)</span></label>
											<input type="text" class="form-control @error('course_duration') is-invalid @enderror" name="course_duration" value="{{ $course->course_duration}}" />
											@error('course_duration')
											<span class="invalid-feedback" role="alert">
												<strong>{{ $message }}</strong>
											</span>
											@enderror
										</div>
										<div class="form-group">
											<label>Intro Video <span class="text-danger">(Video size must be less than 10 MB)</span></label>
											<input type="file" class="form-control @error('course_video') is-invalid @enderror" name="course_video" accept="video/mp4,video/mpeg,video/quicktime"/>
											@error('course_video')
											<span class="invalid-feedback" role="alert">
												<strong>{{ $message }}</strong>
											</span>
											@enderror
										</div>
										<div class="form-group">
											<label>Course Status</label>
											<select class="form-control" name="status">
												<option value="1" @if($course->status == "1") selected @endif>Active</option>
												<option value="0" @if($course->status == "0") selected @endif>Inactive</option>
											</select>
										</div>
										<div class="form-group">
											<img src="{{asset('Course Banner/'.$course->course_banner)}}" alt="" width="60px" height="60px" class="mt-4">
										</div>
										<div class="form-group">
											<label>Course Banner <span class="text-danger">*</span></label>
											<input type="file" name="course_banner" accept="image/*" class="form-control @error('course_banner') is-invalid @enderror" value="{{ $course->course_banner}}" />
											@error('course_banner')
											<span class="invalid-feedback" role="alert">
												<strong>{{ $message }}</strong>
											</span>
											@enderror
										</div>
									</div>
									<div class="col-lg-12 col-md-12 col-sm-12 col-12">
										<div class="form-group">
											<label>Course Short Description <span class="text-danger">(maximum length of 255 characters)</span></label>
											<textarea class="form-control @error('course_short_description') is-invalid @enderror" rows="3" name="course_short_description">{{ $course->course_short_description}}</textarea>
											@error('course_short_description')
											<span class="invalid-feedback" role="alert">
												<strong>{{ $message }}</strong>
											</span>
											@enderror
										</div>
									</div>
									<div class="col-lg-12 col-md-12 col-sm-12 col-12">
										<div class="form-group">
											<label>Course Description <span class="text-danger">(maximum length of 4000 characters)</span></label>
											<textarea class="form-control @error('course_description') is-invalid @enderror" rows="6" name="course_description">{{ $course->course_description}}</textarea>
											@error('course_description')
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
											<a href="{{route('courses.index')}}" class="btn btn-secondary">Cancel</a>
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
<script>
	document.addEventListener('DOMContentLoaded', function() {
		var courseCategory = document.getElementById('course_category');
		var courseSubCategory = document.getElementById('course_subcategory');
		var selectedSubCategory = "{{ $course->course_subcategory }}";

		// Function to fetch and populate subcategories based on the selected category
		function populateSubcategories(categoryId) {
			// Clear existing options
			courseSubCategory.innerHTML = '';

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
							option.selected = true;
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
				})
				.catch(error => console.error('Error:', error));
		}

		// Trigger populateSubcategories function when the category dropdown changes
		courseCategory.addEventListener('change', function() {
			var categoryId = this.value;
			populateSubcategories(categoryId);
		});

		// Trigger populateSubcategories function on page load to populate subcategory based on the selected category
		var categoryId = courseCategory.value;
		populateSubcategories(categoryId);
	});
</script>
@endsection