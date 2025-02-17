@extends('backend.layouts.master')
@section('title','Sold Courses | Sattree Gurukul')
@section('body')
<div class="page-wrapper">
    <div class="content container-fluid">
        <div class="page-header">
            <div class="row">
                <div class="col-md-6">
                    <h3 class="page-title mb-0">Sold Courses</h3>
                </div>
                <div class="col-md-6">
                    <ul class="breadcrumb mb-0 p-0 float-right">
                        <li class="breadcrumb-item">
                            <a href="{{route('Admin-Dashboard')}}"><i class="fas fa-home"></i> Home</a>
                        </li>
                        <li class="breadcrumb-item"><span>Sold Courses</span></li>
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
                                        <th>Course</th>
                                        <th>Price</th>
                                        <th>Student Name</th>
                                        <th>Sold Date</th>
                                        @role('Admin')
                                        <th>Teacher</th>
                                        @endrole
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($sold_courses as $key=>$item)
                                    @php
                                    $student = App\Models\User::where('id',$item->student_id)->first();
                                    $teacher = App\Models\Backend\Teacher::where('user_id',$item->teacher_id)->first();
                                    $course = App\Models\Backend\Course::where('id',$item->course_id)->first();
                                    $sold_date = Carbon\Carbon::parse($item->created_at)->format('d F Y');
                                    @endphp
                                    <tr>
                                        <td>{{++$key}}</td>
                                        <td>{{$course->course_name}}</td>
                                        <td>₹ {{$course->course_fee}}</td>
                                        <td>{{$student->name}}</td>
                                        <td>{{$sold_date}}</td>
                                        @role('Admin')
                                        <td>{{$teacher->name}}</td>
                                        @endrole
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