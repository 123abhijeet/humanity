@extends('backend.layouts.master')
@section('title','Test | Sattree Gurukul')
@section('body')
<div class="page-wrapper">
	<div class="content container-fluid">
		<div class="page-header">
			<div class="row">
				<div class="col-lg-6 col-md-6 col-sm-6 col-12">
					<h5 class="text-uppercase mb-0 mt-0 page-title">View Test</h5>
				</div>
				<div class="col-lg-6 col-md-6 col-sm-6 col-12">
					<ul class="breadcrumb float-right p-0 mb-0">
						<li class="breadcrumb-item">
							<a href="{{route('Admin-Dashboard')}}"><i class="fas fa-home"></i> Home</a>
						</li>
						<li class="breadcrumb-item">
							<a href="{{route('tests.index')}}">Test</a>
						</li>
						<li class="breadcrumb-item"><span> View Test</span></li>
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
									<form method="post" action="">
										<div class="form-group">
											<label>Course Category</label>
											<input type="text" value="{{$category->category_name}}" class="form-control" readonly>
										</div>
										<div class="form-group">
											<label>Course</label>
											<input type="text" class="form-control" name="name" value="{{$course->course_name}}" readonly />
										</div>
										<div class="form-group">
											<label>Test Type</label>
											<input type="text" class="form-control" name="mobile" value="{{$test->type}}" id="test_type" readonly />
										</div>
										<div class="form-group">
											<label>Test Duration </label>
											<input type="text" class="form-control" name="experience" value="{{$test->total_time}}" readonly />
										</div>
										<div class="form-group">
											<label>Test Level </label>
											<input type="text" class="form-control" name="experience" value="{{$test->level}}" readonly />
										</div>
								</div>
								<div class="col-lg-6 col-md-6 col-sm-6 col-12">
									<div class="form-group">
										<label>Course Sub Category</label>
										<input type="text" value="{{$subcategory->subcategory_name}}" class="form-control" readonly>
									</div>
									<div class="form-group">
										<label>Title</label>
										<input type="text" class="form-control" name="email" value="{{$test->title}}" readonly />
									</div>
									<div class="form-group">
										<label>Subject</label>
										<input type="text" class="form-control" name="subject" value="{{$test->subject}}" readonly />
									</div>
									<div class="form-group">
										<label>Total Questions</label>
										<input type="text" class="form-control" name="qualification" value="{{$test->total_questions}}" readonly />
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
												@foreach($test_questions as $key=>$item)
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
								<div class="col-lg-12 col-md-12 col-sm-12 col-12" style="display: none;" id="subjective">
									<div class="table-responsive">
										<table class="table custom-table datatable">
											<thead class="thead-light">
												<tr>
													<th>#</th>
													<th>Question</th>
												</tr>
											</thead>
											<tbody>
												@foreach($test_questions as $key=>$item)
												<tr>
													<td>{{++$key}}</td>
													<td>{{$item->question}}</td>
												</tr>
												@endforeach
											</tbody>
										</table>
									</div>
								</div>
								<div class="col-lg-12 col-md-12 col-sm-12 col-12">
									<div class="form-group text-center custom-mt-form-group">
										<a href="{{route('tests.index')}}" class="btn btn-secondary">Cancel</a>
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
<script>
	document.addEventListener('DOMContentLoaded', function() {
		var test_type = $('#test_type').val();
		if (test_type == 'Objective') {
			$('#objective').css('display', 'block');
			$('#subjective').css('display', 'none');
		} else {
			$('#objective').css('display', 'none');
			$('#subjective').css('display', 'block');
		}
	});
</script>

@endsection