@extends('backend.layouts.master')
@section('title','Course | Sattree Gurukul')
@section('body')
<div class="page-wrapper">
    <div class="content container-fluid">
        <div class="page-header">
            <div class="row">
                <div class="col-lg-6 col-md-6 col-sm-6 col-12">
                    <h5 class="text-uppercase mb-0 mt-0 page-title">View Course</h5>
                </div>
                <div class="col-lg-6 col-md-6 col-sm-6 col-12">
                    <ul class="breadcrumb float-right p-0 mb-0">
                        <li class="breadcrumb-item">
                            <a href="{{route('Admin-Dashboard')}}"><i class="fas fa-home"></i> Home</a>
                        </li>
                        <li class="breadcrumb-item">
                            <a href="{{route('courses.index')}}">Course</a>
                        </li>
                        <li class="breadcrumb-item"><span> View Course</span></li>
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
                                    <form method="post" action="" enctype="multipart/form-data">
                                        <div class="form-group">
                                            <label>Course Category</label>
                                            <select class="form-control" name="course_category">
                                                @foreach($category as $item)
                                                <option value="{{$item->id}}" disabled @if($course->course_category == $item->id) selected @endif>{{$item->category_name}}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                        <div class="form-group">
                                            <label>Course ID</label>
                                            <input type="text" class="form-control" name="course_uid" value="{{$course->course_uid}}" readonly/>
                                        </div>
                                        <div class="form-group">
                                            <label>Course Name</label>
                                            <input type="text" class="form-control" name="course_name" value="{{ $course->course_name}}" readonly/>
                                        </div>
                                        <div class="form-group">
                                            <label>Course Fee</label>
                                            <input type="text" class="form-control" name="course_fee" value="{{ $course->course_fee}}" readonly/>
                                        </div>
                                        <div class="form-group">
                                            <label>Subject</label>
                                            <input type="text" class="form-control" value="{{ $course->subject}}" readonly/>
                                        </div>
                                </div>
                                <div class="col-lg-6 col-md-6 col-sm-6 col-12">
                                    <div class="form-group">
                                        <label>Course Sub Category</label>
                                        <select class="form-control" name="course_subcategory" id="course_subcategory">
                                            @foreach($subcategory as $item)
                                            <option value="{{$item->id}}" disabled @if($course->course_subcategory == $item->id) selected @endif>{{$item->subcategory_name}}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <div class="form-group">
                                        <label>Course Duration <span class="text-danger">(days)</span></label>
                                        <input type="text" class="form-control" name="course_duration" value="{{ $course->course_duration}}" readonly/>
                                    </div>
                                    <div class="form-group">
                                        <label>Course Status</label>
                                        <select class="form-control" name="status">
                                            <option value="1" @if($course->status == '1') selected @endif>Active</option>
                                            <option value="0" @if($course->status == '0') selected @endif>Inactive</option>
                                        </select>
                                    </div>
                                    <div class="form-group">
                                        <label>Course Banner</label>
                                        <img src="{{asset('Course Banner/'.$course->course_banner)}}" alt="" width="100px" height="60px">
                                    </div>
                                </div>
                                <div class="col-lg-12 col-md-12 col-sm-12 col-12">
                                    <div class="form-group">
                                        <label>Course Short Description <span class="text-danger">(maximum length of 255 characters)</span></label>
                                        <textarea class="form-control" rows="3" name="course_short_description" readonly>{{ $course->course_short_description}}</textarea>
                                    </div>
                                </div>
                                <div class="col-lg-12 col-md-12 col-sm-12 col-12">
                                    <div class="form-group">
                                        <label>Course Description <span class="text-danger">(maximum length of 4000 characters)</span></label>
                                        <textarea class="form-control" rows="6" name="course_description" readonly>{{ $course->course_description}}</textarea>
                                    </div>
                                </div>
                                <div class="col-lg-12 col-md-12 col-sm-12 col-12">
                                    <div class="form-group text-center custom-mt-form-group">
                                        <a href="{{route('courses.index')}}" class="btn btn-secondary">Cancel</a>
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