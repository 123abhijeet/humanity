@extends('backend.layouts.master')
@section('title','Test Report | Sattree Gurukul')
@section('body')
<div class="page-wrapper">
    <div class="content container-fluid">
        <div class="page-header">
            <div class="row">
                <div class="col-md-6">
                    <h3 class="page-title mb-0">Test Report</h3>
                </div>
                <div class="col-md-6">
                    <ul class="breadcrumb mb-0 p-0 float-right">
                        <li class="breadcrumb-item">
                            <a href="{{route('Admin-Dashboard')}}"><i class="fas fa-home"></i> Home</a>
                        </li>
                        <li class="breadcrumb-item"><span>Test Report</span></li>
                    </ul>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-sm-12">
                <div class="card">
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table custom-table datatable">
                                <thead class="thead-light">
                                    <tr>
                                        <th>#</th>
                                        <th>Test Title</th>
                                        <th>Student Name</th>
                                        <th>Time Taken</th>
                                        <th>Total Questions</th>
                                        <th>Right</th>
                                        <th>Wrong</th>
                                        <th>Score</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($testresults as $key=>$item)
                                    @php
                                    $test = App\Models\Teacher\Test::where('id',$item->test_id)->first();
                                    $student = App\Models\User::where('id',$item->student_id)->first();
                                    @endphp
                                    <tr>
                                        <td>{{++$key}}</td>
                                        <td>{{$test->title}}</td>
                                        <td>{{$student->name}}</td>
                                        <td>{{$item->time_taken}}</td>
                                        <td>{{$item->total_question}}</td>

                                        <td>{{$item->total_right}}</td>
                                        <td>{{$item->total_wrong}}</td>
                                        <td>{{$item->total_score}}</td>
                                    </tr>
                                    @endforeach
                                </tbody>
                            </table> 
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection