@extends('backend.layouts.master')
@section('title','Course | Sattree Gurukul')
@section('body')
<div class="page-wrapper">
    <div class="content container-fluid">
        <div class="page-header">
            <div class="row">
                <div class="col-lg-6 col-md-6 col-sm-6 col-12">
                    <h5 class="text-uppercase mb-0 mt-0 page-title">add Course</h5>
                </div>
                <div class="col-lg-6 col-md-6 col-sm-6 col-12">
                    <ul class="breadcrumb float-right p-0 mb-0">
                        <li class="breadcrumb-item">
                            <a href="{{route('Admin-Dashboard')}}"><i class="fas fa-home"></i> Home</a>
                        </li>
                        <li class="breadcrumb-item">
                            <a href="{{route('courses.index')}}">Course</a>
                        </li>
                        <li class="breadcrumb-item"><span> Add Course</span></li>
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
                                    <form method="post" action="{{route('courses.store')}}" enctype="multipart/form-data">
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
                                            <label>Course ID</label>
                                            <input type="text" class="form-control @error('course_uid') is-invalid @enderror" name="course_uid" value="{{old('course_uid')}}" />
                                            @error('course_uid')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                            @enderror
                                        </div>
                                        <div class="form-group">
                                            <label>Course Name</label>
                                            <input type="text" class="form-control @error('course_name') is-invalid @enderror" name="course_name" value="{{old('course_name')}}" />
                                            @error('course_name')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                            @enderror
                                        </div>
                                        <div class="form-group">
                                            <label>Course Fee</label>
                                            <input type="text" class="form-control @error('course_fee') is-invalid @enderror" name="course_fee" value="{{old('course_fee')}}" />
                                            @error('course_fee')
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
                                            <label>Course Level</label>
                                            <select class="form-control" name="level">
                                                <option value="Beginner" {{ old('level') == 'Beginner' ? 'selected' : '' }}>Beginner Level</option>
                                                <option value="Intermediate" {{ old('level') == 'Intermediate' ? 'selected' : '' }}>Intermediate Level</option>
                                                <option value="Advanced" {{ old('level') == 'Advanced' ? 'selected' : '' }}>Advanced Level</option>
                                            </select>
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
                                        <label>Course Duration <span class="text-danger">(Hours)</span></label>
                                        <input type="text" class="form-control @error('course_duration') is-invalid @enderror" name="course_duration" value="{{old('course_duration')}}" />
                                        @error('course_duration')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                        @enderror
                                    </div>
                                    <div class="form-group">
                                        <label>Intro Video <span class="text-danger">(Video size must be less than 10 MB)</span></label>
                                        <input type="file" class="form-control @error('course_video') is-invalid @enderror" name="course_video" accept="video/mp4,video/mpeg,video/quicktime"/>
                                        @error('course_video')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                        @enderror
                                    </div>
                                    <div class="form-group">
                                        <label>Course Status</label>
                                        <select class="form-control" name="status">
                                            <option value="1">Active</option>
                                            <option value="0">Inactive</option>
                                        </select>
                                    </div>
                                    <div class="form-group">
                                        <label>Course Banner <span class="text-danger">*</span></label>
                                        <input type="file" name="course_banner" accept="image/x-png,image/gif,image/jpeg" class="form-control @error('course_banner') is-invalid @enderror" value="{{old('course_banner')}}" />
                                        @error('course_banner')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-lg-12 col-md-12 col-sm-12 col-12">
                                    <div class="form-group">
                                        <label>Course Short Description <span class="text-danger">(maximum length of 255 characters)</span></label>
                                        <textarea class="form-control @error('course_short_description') is-invalid @enderror" rows="2" name="course_short_description">{{old('course_short_description')}}</textarea>
                                        @error('course_short_description')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-lg-12 col-md-12 col-sm-12 col-12">
                                    <div class="form-group">
                                        <label>Course Description <span class="text-danger">(maximum length of 4000 characters)</span></label>
                                        <textarea class="form-control @error('course_description') is-invalid @enderror" rows="4" name="course_description">{{old('course_description')}}</textarea>
                                        @error('course_description')
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
                                        <a href="{{route('courses.index')}}" class="btn btn-secondary">Cancel</a>
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