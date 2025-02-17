@extends('backend.layouts.master')
@section('title','Completed Courses | Sattree Gurukul')
@section('body')
<div class="page-wrapper">
    <div class="content container-fluid">
        <div class="page-header">
            <div class="row">
                <div class="col-md-6">
                    <h3 class="page-title mb-0">Completed Course</h3>
                </div>
                <div class="col-md-6">
                    <ul class="breadcrumb mb-0 p-0 float-right">
                        <li class="breadcrumb-item">
                            <a href="{{route('Admin-Dashboard')}}"><i class="fas fa-home"></i> Home</a>
                        </li>
                        <li class="breadcrumb-item"><span>Completed Course</span></li>
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
                                        @role('Admin')
                                        <th>Instructor </th>
                                        @endrole
                                        <th>Course </th>
                                        <th>Student</th>
                                        <th>Started Date</th>
                                        <th>Completed Date</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($coursecompleted as $key=>$item)
                                    @php
                                    $course = App\Models\Backend\Course::where('id',$item->course_id)->first();
                                    $student = App\Models\User::where('id',$item->student_id)->first();
                                    $instructor = App\Models\Backend\Teacher::where('user_id',$item->teacher_id)->first();
                                    $started_date = \Carbon\Carbon::parse($item->course_start_date)->format('d F Y');
                                    $ended_date = \Carbon\Carbon::parse($item->course_end_date)->format('d F Y');
                                    @endphp
                                    <tr>
                                        <td>{{++$key}}</td>
                                        @role('Admin')
                                        <td>{{$instructor->name}}</td>
                                        @endrole
                                        <td>{{$course->course_name}}</td>
                                        <td>{{$student->name}}</td>
                                        <td>{{$started_date}}</td>
                                        <td>{{$ended_date}}</td>
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