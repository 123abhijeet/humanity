@extends('backend.layouts.master')
@section('title','Query | Sattree Gurukul')
@section('body')
<div class="page-wrapper">
	<div class="content container-fluid">
		<div class="page-header">
			<div class="row">
				<div class="col-lg-6 col-md-6 col-sm-6 col-12">
					<h5 class="text-uppercase mb-0 mt-0 page-title">Edit Query</h5>
				</div>
				<div class="col-lg-6 col-md-6 col-sm-6 col-12">
					<ul class="breadcrumb float-right p-0 mb-0">
						<li class="breadcrumb-item">
							<a href="{{route('Admin-Dashboard')}}"><i class="fas fa-home"></i> Home</a>
						</li>
						<li class="breadcrumb-item">
							<a href="{{route('queries.index')}}">Query</a>
						</li>
						<li class="breadcrumb-item"><span> Edit Query</span></li>
					</ul>
				</div>
			</div>
		</div>
		<div class="page-content">
			<div class="row">
				<div class="col-lg-12 col-md-12 col-sm-12 col-12">
					<div class="card">
						<div class="card-body">
							<form method="post" action="{{route('queries.update',$query->id)}}">
								@csrf
								@method('put')
								<div class="row">
									<div class="col-lg-6 col-md-6 col-sm-6 col-12">
										<div class="form-group">
											<label>Course</label>
											<input type="text" class="form-control" value="{{$course->course_name}}" readonly />
										</div>
									</div>
									<div class="col-lg-6 col-md-6 col-sm-6 col-12">
										<div class="form-group">
											<label>Student </label>
											<input type="text" class="form-control" value="{{$student->name}}" readonly />
										</div>
									</div>
								</div>
								<div class="row">
									<div class="col-lg-8 col-md-8 col-sm-8 col-12">
										<div class="form-group">
											<label>Question</label>
											<textarea class="form-control" rows="4" readonly>{{$query->question_text}}</textarea>
										</div>
									</div>
									<div class="col-lg-4 col-md-4 col-sm-4 col-12">
										<div class="form-group" style="position: relative;">
											<label>Question Image</label> <br>
											<img src="{{asset('Student Query/'.$query->question_image)}}" alt="" height="150px" width="200px">
										</div>
									</div>
									<a href="{{ asset('Student Query/'.$query->question_image) }}" target="_blank" style="position: absolute; top: 0; left: 0; display: block; width: 100%; height: 100%;"></a>
								</div>
								<div class="col-lg-12 col-md-12 col-sm-12 col-12">
									<div class="form-group">
										<label>Answer</label>
										<textarea class="form-control  @error('answer') is-invalid @enderror" rows="4" name="answer">{{$query->answer}}</textarea>
										@error('answer')
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
										<a href="{{route('queries.index')}}" class="btn btn-secondary">Cancel</a>
									</div>
							</form>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>
@endsection