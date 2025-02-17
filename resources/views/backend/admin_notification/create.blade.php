@extends('backend.layouts.master')
@section('title','Notification | Sattree Gurukul')
@section('body')
<div class="page-wrapper">
	<div class="content container-fluid">
		<div class="page-header">
			<div class="row">
				<div class="col-lg-6 col-md-6 col-sm-6 col-12">
					<h5 class="text-uppercase mb-0 mt-0 page-title">send Notification</h5>
				</div>
				<div class="col-lg-6 col-md-6 col-sm-6 col-12">
					<ul class="breadcrumb float-right p-0 mb-0">
						<li class="breadcrumb-item">
							<a href="{{route('Admin-Dashboard')}}"><i class="fas fa-home"></i> Home</a>
						</li>
						<li class="breadcrumb-item"><span> Send Notification</span></li>
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
									<form method="post" action="{{route('adminnotifications.store')}}" enctype="multipart/form-data">
										@csrf
										<div class="form-group">
											<label>Attachement <span class="text-danger">*</span><small class="text-danger">Allowed file size not more than 200KB</small></label>
											<input type="file" class="form-control @error('attachment') is-invalid @enderror" name="attachment" />
											@error('attachment')
											<span class="invalid-feedback" role="alert">
												<strong>{{ $message }}</strong>
											</span>
											@enderror
										</div>
								</div>
								<div class="col-lg-12 col-md-12 col-sm-12 col-12">
									<label>Your Message <span class="text-danger">*</span></label>
									<textarea class="form-control @error('message') is-invalid @enderror" name="message" cols="5" rows="5"></textarea>
									@error('message')
									<span class="invalid-feedback" role="alert">
										<strong>{{ $message }}</strong>
									</span>
									@enderror
								</div>
								<div class="col-lg-12 col-md-12 col-sm-12 col-12">
									<div class="form-group text-center custom-mt-form-group">
										<button class="btn btn-primary mr-2" type="submit">
											Send
										</button>
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
@endsection