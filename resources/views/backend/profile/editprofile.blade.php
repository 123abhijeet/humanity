@extends('backend.layouts.master')
@section('title','Edit Profile | Humanity')
@section('body')
<div class="page-wrapper">
	<div class="content container-fluid">
		<div class="page-header">
			<div class="row">
				<div class="col-lg-6 col-md-6 col-sm-6 col-12">
					<h5 class="text-uppercase mb-0 mt-0 page-title">Edit Profile</h5>
				</div>
				<div class="col-lg-6 col-md-6 col-sm-6 col-12">
					<ul class="breadcrumb float-right p-0 mb-0">
						<li class="breadcrumb-item"><a href="{{route('Admin-Dashboard')}}"><i class="fas fa-home"></i> Home</a></li>
						<li class="breadcrumb-item"><a href="#">Pages</a></li>
						<li class="breadcrumb-item"><span>Edit Profile</span></li>
					</ul>
				</div>
			</div>
		</div>
		<div class="page-content">
			<div class="row">
				<div class="col-lg-12 col-md-12 col-sm-12 col-12">
					<div class="card">
						<div class="card-header">
							<div class="card-title">Basic information</div>
						</div>
						<div class="card-body">
							<div class="row">
								<div class="col-lg-6 col-md-6 col-sm-6 col-12">
									<form method="post" action="{{route('Update-Profile')}}">
										@csrf
										<div class="form-group">
											<label>User ID</label>
											<input type="text" name="name" class="form-control" value="रक्तवीर-00{{Auth::user()->id}}" readonly>
										</div>
										@php
										$roleName = Auth::user()->getRoleNames()->first();
										@endphp
										<div class="form-group">
											<label>Role</label>
											<input type="text" class="form-control" value="" readonly>
										</div>

										<div class="form-group">
											<label>Password</label>
											<input type="password" class="form-control @error('password') is-invalid @enderror" name="password">
											@error('password')
											<span class="invalid-feedback" role="alert">
												<strong>{{ $message }}</strong>
											</span>
											@enderror
										</div>
								</div>
								<div class="col-lg-6 col-md-6 col-sm-6 col-12">
									<div class="form-group">
										<label>Name</label>
										<input type="text" name="name" class="form-control" value="{{Auth::user()->name}}">
										@error('name')
										<span class="invalid-feedback" role="alert">
											<strong>{{ $message }}</strong>
										</span>
										@enderror
									</div>
									<div class="form-group">
										<label>Email</label>
										<input type="text" name="email" class="form-control" value="{{Auth::user()->email}}" readonly>
									</div>
									<div class="form-group">
										<label>Comfirm Password</label>
										<input type="password" name="password_confirmation" class="form-control @error('password') is-invalid @enderror">
										@error('password')
										<span class="invalid-feedback" role="alert">
											<strong>{{ $message }}</strong>
										</span>
										@enderror
									</div>

								</div>
								<div class="col-lg-12 col-md-12 col-sm-12 col-12">

									<div class="form-group text-center custom-mt-form-group">
										<button class="btn btn-primary mr-2" type="submit">Save</button>
										<a href="{{route('Admin-Dashboard')}}" class="btn btn-secondary">Cancel</a>
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