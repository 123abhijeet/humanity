@extends('backend.layouts.master')
@section('title','Course Video | Sattree Gurukul')
@section('body')
<style>
	/* Custom styles for input fields */
	.large-input {
		width: 100%;
	}

	.small-input {
		width: 50%;
	}

	/* Progress bar styling */
	.progress {
		display: none;
		width: 100%;
		height: 20px;
		background-color: #f3f3f3;
		border-radius: 5px;
		margin-top: 20px;
	}

	.progress-bar {
		width: 0;
		height: 100%;
		background-color: #4caf50;
		border-radius: 5px;
		text-align: center;
		color: white;
		line-height: 20px;
	}
</style>

<div class="page-wrapper">
	<div class="content container-fluid">
		<div class="page-header">
			<div class="row">
				<div class="col-lg-6 col-md-6 col-sm-6 col-12">
					<h5 class="text-uppercase mb-0 mt-0 page-title">add Course Video</h5>
				</div>
				<div class="col-lg-6 col-md-6 col-sm-6 col-12">
					<ul class="breadcrumb float-right p-0 mb-0">
						<li class="breadcrumb-item">
							<a href="{{route('Admin-Dashboard')}}"><i class="fas fa-home"></i> Home</a>
						</li>
						<li class="breadcrumb-item">
							<a href="{{route('coursevideos.index')}}">Course Video</a>
						</li>
						<li class="breadcrumb-item"><span> Add Course Video</span></li>
					</ul>
				</div>
			</div>
		</div>
		<div class="page-content">
			<div class="row">
				<div class="col-lg-12 col-md-12 col-sm-12 col-12">
					<div class="card">
						<div class="card-body">
							<form id="video-upload-form" enctype="multipart/form-data">
								@csrf
								<div class="row">
									<div class="col-lg-6 col-md-6 col-sm-6 col-12">
										<div class="form-group">
											<label>Category <span class="text-danger">*</span></label>
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
											<label>Section <span class="text-danger">*</span></label>
											<input type="text" name="section" class="form-control">
											@error('section')
											<span class="invalid-feedback" role="alert">
												<strong>{{ $message }}</strong>
											</span>
											@enderror
										</div>

									</div>
									<div class="col-lg-12 col-md-12 col-sm-12 col-12">
										<div class="table-responsive">
											<table class="table custom-table datatable">
												<thead class="thead-light">
													<tr>
														<th>#</th>
														<th>Title</th>
														<th>Duration <span class="text-danger">(HH:MM:SS)</span></th>
														<th>Upload Video <span class="text-danger">(Total video size is must be less than 100 MB)</span></th>
													</tr>
												</thead>
												<tbody>
                                                <tr>
                                                    <input type="hidden" name="total_videos" value="1">
                                                    <td>#</td>
                                                	<td><input type="text" name="title" class="form-control"></td>
                                                	<td><input type="text" name="duration" class="form-control"></td>
                                                	<td><input type="file" name="video" accept="video/mp4,video/mpeg,video/quicktime" class="form-control"></td>
                                                </tr>
												</tbody>
											</table>
										</div>
									</div>
									<div class="col-lg-12 col-md-12 col-sm-12 col-12">
										<!-- Progress bar -->
										<div class="progress">
											<div class="progress-bar" id="progress-bar">0%</div>
										</div>
									</div>

									<div class="col-lg-12 col-md-12 col-sm-12 col-12">
										<div class="form-group text-center custom-mt-form-group">
											<button class="btn btn-primary mr-2" type="submit">
												Submit
											</button>
											<a href="{{route('coursevideos.index')}}" class="btn btn-secondary">Cancel</a>
										</div>
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
<link rel="stylesheet" href="{{ asset('toastr/toastr.css') }}">
<script src="{{ asset('backend/js/jquery-3.6.0.min.js')}}"></script>
<script src="{{ asset('toastr/toastr.min.js') }}"></script>
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


		const form = document.getElementById('video-upload-form');
		const progressBar = document.getElementById('progress-bar');
		const progressContainer = document.querySelector('.progress');

	});

	var courseCategory = document.getElementById('course_category');
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
    document.addEventListener('DOMContentLoaded', function () {
    const form = document.getElementById('video-upload-form');
    const progressBar = document.getElementById('progress-bar');
    const progressContainer = document.querySelector('.progress');
    const CHUNK_SIZE = 1024 * 1024 * 5; // 5MB per chunk

    form.addEventListener('submit', function (e) {
        e.preventDefault();

        const fileInput = document.querySelector('input[name="video"]');
        const file = fileInput.files[0];

        if (!file) {
            errorMsg("Please select a video file to upload")
            return;
        }

        // Show progress bar
        progressContainer.style.display = 'block';

        // Start uploading in chunks
        uploadChunks(file);
    });

    function uploadChunks(file) {
        const totalChunks = Math.ceil(file.size / CHUNK_SIZE);
        let currentChunk = 0;
        let start = 0;
        var section = document.querySelector('input[name="section"]').value; 
        var course_category = document.getElementById('course_category').value;
        var course_subcategory = document.getElementById('course_subcategory').value;
        var course = document.getElementById('course').value;
        var title = document.querySelector('input[name="title"]').value;
        var duration = document.querySelector('input[name="duration"]').value;

        const uploadNextChunk = () => {
            const end = Math.min(start + CHUNK_SIZE, file.size);
            const chunk = file.slice(start, end);

            // Create a new FormData object for each chunk
            const formData = new FormData();
            formData.append('video_chunk', chunk);
            formData.append('chunk_number', currentChunk + 1);
            formData.append('total_chunks', totalChunks);
            formData.append('_token', '{{ csrf_token() }}');
            formData.append('_token', '{{ csrf_token() }}');
            
            formData.append('course_category', course_category);
            formData.append('course_subcategory', course_subcategory);
            formData.append('course',course);
            formData.append('section',section);
             formData.append('title',title);
            formData.append('duration',duration);

            const xhr = new XMLHttpRequest();
            xhr.open('POST', '{{ route("coursevideos.chunked_upload") }}', true);

            xhr.upload.addEventListener('progress', function (e) {
                if (e.lengthComputable) {
                    const percentComplete = Math.round(((start + e.loaded) / file.size) * 100);
                    progressBar.style.width = percentComplete + '%';
                    progressBar.textContent = percentComplete + '%';
                }
            });

            xhr.onload = function () {
                if (xhr.status === 200) {
                    // Move to the next chunk
                    currentChunk++;
                    start = end;

                    if (currentChunk < totalChunks) {
                        uploadNextChunk(); // Upload the next chunk
                    } else {
                        // Upload complete
                        progressBar.textContent = 'Upload complete!';
                        setTimeout(() => {
                            progressBar.style.width = '0%';
                            progressBar.textContent = '0%';
                            progressContainer.style.display = 'none';
                        }, 2000);
                        successMsg("Video uploaded successfully!")
                        window.location.href = '/Panel/coursevideos';
                    }
                } else {
                    // Handle error
                    progressBar.textContent = 'Upload failed!';
                }
            };

            xhr.send(formData);
        };

        uploadNextChunk();
    }
});
</script>
@endsection