@extends('backend.layouts.master')
@section('title','Book | Sattree Gurukul')
@section('body')
<div class="page-wrapper">
    <div class="content container-fluid">
        <div class="page-header">
            <div class="row">
                <div class="col-lg-6 col-md-6 col-sm-6 col-12">
                    <h5 class="text-uppercase mb-0 mt-0 page-title">View Book</h5>
                </div>
                <div class="col-lg-6 col-md-6 col-sm-6 col-12">
                    <ul class="breadcrumb float-right p-0 mb-0">
                        <li class="breadcrumb-item">
                            <a href="{{route('Admin-Dashboard')}}"><i class="fas fa-home"></i> Home</a>
                        </li>
                        <li class="breadcrumb-item">
                            <a href="{{route('books.index')}}">Book</a>
                        </li>
                        <li class="breadcrumb-item"><span> View Book</span></li>
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
                                    <form method="post">
                                        <div class="form-group">
                                            <label>Title <span class="text-danger">*</span></label>
                                            <input type="text" placeholder="Title" name="title" class="form-control" value="{{$book->title}}" readonly>
                                        </div>
                                        <div class="form-group">
                                            <label>Language <span class="text-danger">*</span></label>
                                            <input type="text" placeholder="Language" name="language" class="form-control" value="{{$book->language}}" readonly>
                                        </div>
                                        <div class="form-group">
                                            <label>Subject <span class="text-danger">*</span></label>
                                            <input type="text" placeholder="Subject" name="subject" class="form-control" value="{{$book->subject}}" readonly>
                                        </div>
                                </div>
                                <div class="col-lg-6 col-md-6 col-sm-6 col-12">
                                    <div class="form-group">
                                        <label>Publication <span class="text-danger">*</span></label>
                                        <input type="text" placeholder="Publication" name="publication" class="form-control" value="{{$book->publication}}" readonly>
                                    </div>
                                    <div class="form-group">
                                        <label>Price <span class="text-danger">*</span></label>
                                        <input type="text" placeholder="Price" name="price" class="form-control" value="{{$book->price}}" readonly>
                                    </div>
                                    <div class="form-group">
                                        <label>Cover Image</label>
                                        <img src="{{asset('/Book Cover/'.$book->cover_image)}}" alt="" height="80px" width="100px">
                                    </div>
                                </div>
                                <div class="col-lg-12 col-md-12 col-sm-12 col-12">
                                    <div class="form-group">
                                        <label>Description</label>
                                        <textarea class="form-control @error('description') is-invalid @enderror" rows="4" name="description" readonly>{{$book->description}}</textarea>
                                        @error('description')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-lg-12 col-md-12 col-sm-12 col-12">
                                    <div class="form-group text-center custom-mt-form-group">
                                        <a href="{{route('books.index')}}" class="btn btn-secondary">Cancel</a>
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