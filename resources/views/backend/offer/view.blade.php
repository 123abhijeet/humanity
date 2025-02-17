@extends('backend.layouts.master')
@section('title','Offer | Sattree Gurukul')
@section('body')
<div class="page-wrapper">
    <div class="content container-fluid">
        <div class="page-header">
            <div class="row">
                <div class="col-lg-6 col-md-6 col-sm-6 col-12">
                    <h5 class="text-uppercase mb-0 mt-0 page-title">View Offer</h5>
                </div>
                <div class="col-lg-6 col-md-6 col-sm-6 col-12">
                    <ul class="breadcrumb float-right p-0 mb-0">
                        <li class="breadcrumb-item">
                            <a href="{{route('Admin-Dashboard')}}"><i class="fas fa-home"></i> Home</a>
                        </li>
                        <li class="breadcrumb-item">
                            <a href="{{route('offers.index')}}">Offer</a>
                        </li>
                        <li class="breadcrumb-item"><span> View Offer</span></li>
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
                                        <label>Course Category</label>
                                        <input type="text" class="form-control" value="{{$category->category_name}}" readonly>
                                    </div>
                                    <div class="form-group">
                                        <label>Offer For <span class="text-danger">*</span></label>
                                        <select name="offer_type" id="offer_type" class="form-control" disabled>
                                            <option value="course" @if($offer->offer_type == 'course') selected @endif>Course</option>
                                            <option value="quiz" @if($offer->offer_type == 'quiz') selected @endif>Quiz</option>
                                        </select>
                                    </div>
                                    <div class="form-group">
                                        <label>Offer Title <span class="text-danger">*</span></label>
                                        <input type="text" class="form-control @error('offer_title') is-invalid @enderror" name="offer_title" value="{{$offer->offer_title}}" readonly />
                                    </div>

                                    <div class="form-group">
                                        <label>Offer Banner <span class="text-danger">*</span></label>
                                        <img src="{{asset($offer->offer_banner)}}" alt="" height="50px" width="100px" class="mt-1">
                                    </div>
                                    <div class="form-group">
                                        <label>Offer Start Date <span class="text-danger">*</span></label>
                                        <input type="date" class="form-control @error('start_date') is-invalid @enderror" name="start_date" value="{{$offer->start_date}}" readonly />
                                    </div>
                                    <div class="form-group">
                                        <label>Status<span class="text-danger">*</span></label>
                                        <select name="status" class="form-control" disabled>
                                            <option value="1" @if($offer->status == '1') selected @endif>Active</option>
                                            <option value="0" @if($offer->status == '0') selected @endif>Inactive</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-lg-6 col-md-6 col-sm-6 col-12">
                                    <div class="form-group">
                                        <label>Course Sub Category</label>
                                        <input type="text" class="form-control" value="{{$subcategory->subcategory_name}}" readonly>
                                    </div>
                                    <div class="form-group" id="course" style="display: {{ $offer->offer_type == 'course' ? 'block' : 'none' }};">
                                        <label>Course <span class="text-danger">*</span></label>
                                        <input type="text" class="form-control" value="{{$course->course_name}}" readonly>
                                    </div>
                                    <div class="form-group" id="quiz" style="display: {{ $offer->offer_type == 'quiz' ? 'block' : 'none' }};">
                                        <label>Quiz <span class="text-danger">*</span></label>
                                        <input type="text" class="form-control" value="{{$quiz->title}}" readonly>
                                    </div>

                                    <div class="form-group">
                                        <label>Coupon Code <span class="text-danger">*</span></label>
                                        <input type="text" class="form-control @error('offer_code') is-invalid @enderror" name="offer_code" value="{{$offer->offer_code}}" readonly />
                                    </div>
                                    <div class="form-group">
                                        <label>Offer Value (Rs) <span class="text-danger">*</span></label>
                                        <input type="text" class="form-control @error('offer_value') is-invalid @enderror" name="offer_value" value="{{$offer->offer_value}}" readonly />
                                    </div>

                                    <div class="form-group">
                                        <label>Offer End Date <span class="text-danger">*</span></label>
                                        <input type="date" class="form-control @error('end_date') is-invalid @enderror" name="end_date" value="{{$offer->end_date}}" readonly />
                                    </div>
                                </div>

                                <div class="col-lg-12 col-md-12 col-sm-12 col-12">
                                    <div class="form-group text-center custom-mt-form-group">
                                        <a href="{{route('offers.index')}}" class="btn btn-secondary">Cancel</a>
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