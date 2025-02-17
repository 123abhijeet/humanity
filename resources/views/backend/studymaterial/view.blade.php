@extends('backend.layouts.master')
@section('title','Teacher | Sattree Gurukul')
@section('body')
<div class="page-wrapper">
    <div class="content container-fluid">
        <div class="page-header">
            <div class="row">
                <div class="col-lg-6 col-md-6 col-sm-6 col-12">
                    <h5 class="text-uppercase mb-0 mt-0 page-title">View Teacher</h5>
                </div>
                <div class="col-lg-6 col-md-6 col-sm-6 col-12">
                    <ul class="breadcrumb float-right p-0 mb-0">
                        <li class="breadcrumb-item">
                            <a href="{{route('Admin-Dashboard')}}"><i class="fas fa-home"></i> Home</a>
                        </li>
                        <li class="breadcrumb-item">
                            <a href="{{route('teachers.index')}}">Teacher</a>
                        </li>
                        <li class="breadcrumb-item"><span> View Teacher</span></li>
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
                                                <option value="{{$item->id}}" disabled @if($teacher->course_category == $item->id) selected @endif>{{$item->category_name}}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                        <div class="form-group">
                                            <label>Name</label>
                                            <input type="text" class="form-control" name="name" value="{{$teacher->name}}" readonly />
                                        </div>
                                        <div class="form-group">
                                            <label>Mobile number</label>
                                            <input type="text" class="form-control" name="mobile" value="{{$teacher->mobile}}" readonly />
                                        </div>
                                        <div class="form-group">
                                            <label>Experience <span class="text-danger">in Years</span></label>
                                            <input type="text" class="form-control" name="experience" value="{{$teacher->experience}}" readonly />
                                        </div>
                                        <div class="form-group">
                                            <label>Picture </label>
                                            <img src="{{asset('Teacher Picture/'.$teacher->picture)}}" alt="" height="50px" width="50px" class="mt-1">
                                        </div>

                                </div>
                                <div class="col-lg-6 col-md-6 col-sm-6 col-12">
                                    <div class="form-group">
                                        <label>Course Sub Category</label>
                                        <select class="form-control" name="course_subcategory" id="course_subcategory">
                                            @foreach($subcategory as $item)
                                            <option value="{{$item->id}}" disabled @if($teacher->course_subcategory == $item->id) selected @endif>{{$item->subcategory_name}}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <div class="form-group">
                                        <label>Email</label>
                                        <input type="text" class="form-control" name="email" value="{{$teacher->email}}" readonly />
                                    </div>
                                    <div class="form-group">
                                        <label>Subject</label>
                                        <input type="text" class="form-control" name="subject" value="{{$teacher->subject}}" readonly />
                                    </div>
                                    <div class="form-group">
                                        <label>Qualification</label>
                                        <input type="text" class="form-control" name="qualification" value="{{$teacher->qualification}}" readonly />
                                    </div>

                                    <div class="form-group">
                                        <label>ID Proof <small class="text-danger">Aadhar,PAN,Driving Licence</small></label>
                                        <a href="{{asset('Identity Proof/'. $teacher->identity_proof)}}" class="form-control mt-1" download="">Download</a>
                                    </div>
                                </div>
                                <div class="col-lg-12 col-md-12 col-sm-12 col-12">
                                    <div class="form-group">
                                        <label>Premanent Address</label>
                                        <textarea class="form-control" rows="4" name="address" readonly>{{$teacher->address}}</textarea>
                                    </div>
                                </div>
                                <div class="col-lg-12 col-md-12 col-sm-12 col-12">
                                    <div class="form-group text-center custom-mt-form-group">
                                        <a href="{{route('teachers.index')}}" class="btn btn-secondary">Cancel</a>
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
@endsection