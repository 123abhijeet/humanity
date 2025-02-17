@extends('backend.layouts.master')
@section('title','Teacher | Sattree Gurukul')
@section('body')
<div class="page-wrapper">
	<div class="content container-fluid">
		<div class="page-header">
			<div class="row">
				<div class="col-lg-6 col-md-6 col-sm-6 col-12">
					<h5 class="text-uppercase mb-0 mt-0 page-title">add Teacher</h5>
				</div>
				<div class="col-lg-6 col-md-6 col-sm-6 col-12">
					<ul class="breadcrumb float-right p-0 mb-0">
						<li class="breadcrumb-item">
							<a href="{{route('Admin-Dashboard')}}"><i class="fas fa-home"></i> Home</a>
						</li>
						<li class="breadcrumb-item">
							<a href="{{route('teachers.index')}}">Teacher</a>
						</li>
						<li class="breadcrumb-item"><span> Add Teacher</span></li>
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
									<form method="post" action="{{route('teachers.store')}}" enctype="multipart/form-data">
										@csrf
										<div class="form-group">
											<label>Course Category</label>
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
											<label>Name</label>
											<input type="text" class="form-control @error('name') is-invalid @enderror" name="name" value="{{old('name')}}" />
											@error('name')
											<span class="invalid-feedback" role="alert">
												<strong>{{ $message }}</strong>
											</span>
											@enderror
										</div>
										<div class="form-group">
											<label>Mobile number <span class="text-danger">*</span> <span class="text-danger">Mobile No is used as password</span></label>
											<input type="text" class="form-control @error('mobile') is-invalid @enderror" name="mobile" oninput="validateMobileNumber(this)" value="{{old('mobile')}}" />
											@error('mobile')
											<span class="invalid-feedback" role="alert">
												<strong>{{ $message }}</strong>
											</span>
											@enderror
										</div>
										<div class="form-group">
											<label>Experience <span class="text-danger">in Years</span></label>
											<input type="text" class="form-control @error('experience') is-invalid @enderror" name="experience" value="{{old('experience')}}" />
											@error('experience')
											<span class="invalid-feedback" role="alert">
												<strong>{{ $message }}</strong>
											</span>
											@enderror
										</div>
										<div class="form-group">
											<label>Picture <small class="text-danger">*</small></label>
											<input type="file" name="picture" accept="image/x-png,image/gif,image/jpeg" class="form-control @error('picture') is-invalid @enderror" value="{{old('picture')}}" />
											@error('picture')
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
										</select>
										@error('course_subcategory')
										<span class="invalid-feedback" role="alert">
											<strong>{{ $message }}</strong>
										</span>
										@enderror
									</div>
									<div class="form-group">
										<label>Email</label>
										<input type="text" class="form-control @error('email') is-invalid @enderror" name="email" value="{{old('email')}}" />
										@error('email')
										<span class="invalid-feedback" role="alert">
											<strong>{{ $message }}</strong>
										</span>
										@enderror
									</div>
									<div class="form-group">
										<label>Subject</label>
										<input type="text" class="form-control @error('subject') is-invalid @enderror" name="subject" value="{{old('subject')}}" />
										@error('subject')
										<span class="invalid-feedback" role="alert">
											<strong>{{ $message }}</strong>
										</span>
										@enderror
									</div>
									<div class="form-group">
										<label>Qualification</label>
										<input type="text" class="form-control @error('qualification') is-invalid @enderror" name="qualification" value="{{old('qualification')}}" />
										@error('qualification')
										<span class="invalid-feedback" role="alert">
											<strong>{{ $message }}</strong>
										</span>
										@enderror
									</div>

									<div class="form-group">
										<label>ID Proof <small class="text-danger">Aadhar,PAN,Driving Licence</small></label>
										<input type="file" name="identity_proof" accept="application/pdf" class="form-control @error('identity_proof') is-invalid @enderror" value="{{old('identity_proof')}}" />
										@error('identity_proof')
										<span class="invalid-feedback" role="alert">
											<strong>{{ $message }}</strong>
										</span>
										@enderror
									</div>
								</div>
								<div class="col-lg-12 col-md-12 col-sm-12 col-12">
									<div class="form-group">
										<label>Premanent Address</label>
										<textarea class="form-control @error('address') is-invalid @enderror" rows="4" name="address">{{old('address')}}</textarea>
										@error('address')
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
										<a href="{{route('teachers.index')}}" class="btn btn-secondary">Cancel</a>
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
</script>
@endsection