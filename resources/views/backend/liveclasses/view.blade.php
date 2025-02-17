@extends('backend.layouts.master')
@section('title','Live Class | Sattree Gurukul')
@section('body')
<div class="page-wrapper">
	<div class="content container-fluid">
		<div class="page-header">
			<div class="row">
				<div class="col-lg-6 col-md-6 col-sm-6 col-12">
					<h5 class="text-uppercase mb-0 mt-0 page-title">View Live Class</h5>
				</div>
				<div class="col-lg-6 col-md-6 col-sm-6 col-12">
					<ul class="breadcrumb float-right p-0 mb-0">
						<li class="breadcrumb-item">
							<a href="{{route('Admin-Dashboard')}}"><i class="fas fa-home"></i> Home</a>
						</li>
						<li class="breadcrumb-item">
							<a href="{{route('Agora-Meetings')}}">Live Class</a>
						</li>
						<li class="breadcrumb-item"><span> View Live Class</span></li>
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
									<div class="form-group">
										<label>Category <span class="text-danger">*</span></label>
										<input type="text" class="form-control" value="{{$category->category_name}}" readonly>
									</div>
									<div class="form-group">
										<label>Choose Course <span class="text-danger">*</span></label>
										<input type="text" class="form-control" value="{{$course->course_name}}" readonly>
									</div>
									<div class="form-group">
										<label>Start Time <span class="text-danger">*</span></label>
										<input type="datetime-local" class="form-control @error('start_time') is-invalid @enderror" name="start_time" value="{{$meeting->start_time}}" readonly />
									</div>
								</div>
								<div class="col-lg-6 col-md-6 col-sm-6 col-12">
									<div class="form-group">
										<label>Sub Category <span class="text-danger">*</span></label>
										<input type="text" class="form-control" value="{{$subcategory->subcategory_name}}" readonly>
									</div>
									<div class="form-group">
										<label>Title <span class="text-danger">*</span></label>
										<input type="text" class="form-control @error('title') is-invalid @enderror" name="title" value="{{$meeting->title}}" readonly />
									</div>
									<div class="form-group">
										<label>End Time <span class="text-danger">*</span></label>
										<input type="datetime-local" class="form-control @error('end_time') is-invalid @enderror" name="end_time" value="{{$meeting->end_time}}" readonly/>
									</div>
								</div>
								<div class="col-lg-12 col-md-12 col-sm-12 col-12">
									<div class="form-group text-center custom-mt-form-group">
										<a href="{{route('Agora-Meetings')}}" class="btn btn-secondary">Cancel</a>
									</div>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>
</div>
@endsection