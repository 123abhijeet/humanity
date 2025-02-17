@extends('backend.layouts.master')
@section('title','Quiz | Sattree Gurukul')
@section('body')
<div class="page-wrapper">
    <div class="content container-fluid">
        <div class="page-header">
            <div class="row">
                <div class="col-lg-6 col-md-6 col-sm-6 col-12">
                    <h5 class="text-uppercase mb-0 mt-0 page-title">View Quiz</h5>
                </div>
                <div class="col-lg-6 col-md-6 col-sm-6 col-12">
                    <ul class="breadcrumb float-right p-0 mb-0">
                        <li class="breadcrumb-item">
                            <a href="{{route('Admin-Dashboard')}}"><i class="fas fa-home"></i> Home</a>
                        </li>
                        <li class="breadcrumb-item">
                            <a href="{{route('quizzes.index')}}">Quiz</a>
                        </li>
                        <li class="breadcrumb-item"><span> View Quiz</span></li>
                    </ul>
                </div>
            </div>
        </div>
        <div class="page-content">
            <div class="row">
                <div class="col-lg-12 col-md-12 col-sm-12 col-12">
                    <div class="card">
                        <div class="card-body">
                            <form>
                                <div class="row">
                                    <div class="col-lg-6 col-md-6 col-sm-6 col-12">
                                        <div class="form-group">
                                            <label>Category</label>
                                            <input type="text" class="form-control" value="{{$category->category_name}}" readonly>
                                        </div>
                                        <div class="form-group">
                                            <label>Quiz Title <span class="text-danger">*</span></label>
                                            <input type="text" class="form-control" name="title" value="{{$quiz->title}}" readonly />
                                        </div>
                                        <div class="form-group">
                                            <label>Quiz Level <span class="text-danger">*</span></label>
                                            <input type="text" class="form-control" name="level" value="{{$quiz->level}}" readonly />
                                        </div>
                                        <div class="form-group paid_quiz" style="display: none;">
                                            <label>Price (Rs) <span class="text-danger">*</span></label>
                                            <input type="text" class="form-control" name="price" value="{{$quiz->price}}" readonly />
                                        </div>
                                    </div>
                                    <div class="col-lg-6 col-md-6 col-sm-6 col-12">
                                        <div class="form-group">
                                            <label>Sub Category</label>
                                            <input type="text" class="form-control" value="{{$subcategory->subcategory_name}}" readonly>
                                        </div>
                                        <div class="form-group">
                                            <label>Quiz Subject <span class="text-danger">*</span></label>
                                            <input type="text" class="form-control" name="subject" value="{{$quiz->subject}}" readonly />
                                        </div>
                                        <div class="form-group">
                                            <label>Total Questions <span class="text-danger">*</span></label>
                                            <input type="text" id="total_questions" class="form-control" name="total_questions" value="{{$quiz->total_questions}}" readonly />
                                        </div>
                                        <div class="form-group">
                                            <label>Quiz Duration <span class="text-danger">*</span></label>
                                            <input type="time" class="form-control" name="total_time" value="{{$quiz->total_time}}" readonly />
                                        </div>
                                        <div class="form-group paid_quiz" style="display: none;">
                                            <label>Attempt Date <span class="text-danger">*</span></label>
                                            <input type="datetime-local" class="form-control" name="attempt_date" value="{{$quiz->attempt_date}}" readonly/>
                                        </div>

                                    </div>
                                    <div class="col-lg-12 col-md-12 col-sm-12 col-12">
                                        <div style="overflow-x: auto;" class="table-responsive">
                                            <table class="table custom-table datatable" style="min-width: 800px;">
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
                                                    @foreach($quiz_questions as $key=>$item)
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
                                    <div class="col-lg-12 col-md-12 col-sm-12 col-12">
                                        <div class="form-group text-center custom-mt-form-group">
                                            <a href="{{route('quizzes.index')}}" class="btn btn-secondary">Cancel</a>
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
<script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
@if(Auth::check() && Auth::user()->hasRole('Admin'))
<script>
	$(document).ready(function() {
		$('.paid_quiz').css('display', 'block');
	});
</script>
@else
<script>
	$(document).ready(function() {
		$('.paid_quiz').css('display', 'none');
	});
</script>
@endif
@endsection