@extends('backend.layouts.master')
@section('title','Subjective Test Questions | Sattree Gurukul')
@section('body')
<div class="page-wrapper">
	<div class="content container-fluid">
		<div class="page-header">
			<div class="row">
				<div class="col-md-6">
					<h3 class="page-title mb-0">Subjective Test Questions</h3>
				</div>
				<div class="col-md-6">
					<ul class="breadcrumb mb-0 p-0 float-right">
						<li class="breadcrumb-item">
							<a href="{{route('Admin-Dashboard')}}"><i class="fas fa-home"></i> Home</a>
						</li>
						<li class="breadcrumb-item"><span>Subjective Test Questions</span></li>
					</ul>
				</div>
			</div>
		</div>
		<div class="page-content">
			<div class="row">
				<div class="col-lg-12 col-md-12 col-sm-12 col-12">
					<div class="card">
						<div class="card-body">
							<form method="post" action="{{route('Subjective-Test-Answer')}}">
								@csrf
								@foreach($subjective_test_questions as $key=> $item)
								<div class="row">
									<div class="col-lg-1 col-md-1 col-sm-1 col-12">
										<input type="hidden" name="test_id" value="{{$item->test_id}}">
										<input type="hidden" name="question_id[]" value="{{$item->question_id}}">
										<label for="">#</label>
										<input type="text" class="form-control" value="{{++$key}}" readonly>
									</div>
									<div class="col-lg-4 col-md-4 col-sm-4 col-6">
										<div class="form-group">
											<label>Question</label>
											<textarea class="form-control" rows="4" readonly>{{$item->question}}</textarea>
										</div>
									</div>
									<div class="col-lg-5 col-md-5 col-sm-5 col-6">
										<div class="form-group">
											<label>Answer</label>
											<textarea class="form-control" rows="4" readonly>{{$item->answer}}</textarea>
										</div>
									</div>
									<div class="col-lg-2 col-md-2 col-sm-2 col-12">
										<label for="">Marks out of 10</label>
										<input type="number" name="marks[]"  class="form-control">
									</div>
								</div>
								@endforeach
								<div class="col-lg-12 col-md-12 col-sm-12 col-12">
									<div class="form-group text-center custom-mt-form-group">
										<button class="btn btn-primary mr-2" type="submit">
											Submit
										</button>
										<a href="{{route('Subjective-Test-Reports')}}" class="btn btn-secondary">Cancel</a>
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
@endsection