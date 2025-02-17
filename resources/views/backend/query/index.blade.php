@extends('backend.layouts.master')
@section('title','Query | Sattree Gurukul')
@section('body')
<div class="page-wrapper">
    <div class="content container-fluid">
        <div class="page-header">
            <div class="row">
                <div class="col-md-6">
                    <h3 class="page-title mb-0">Query</h3>
                </div>
                <div class="col-md-6">
                    <ul class="breadcrumb mb-0 p-0 float-right">
                        <li class="breadcrumb-item">
                            <a href="{{route('Admin-Dashboard')}}"><i class="fas fa-home"></i> Home</a>
                        </li>
                        <li class="breadcrumb-item"><span>Query</span></li>
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
                                        @role('Admin')
                                        <th>Teacher</th>
                                        @endrole
                                        <th>Student Name</th>
                                        <th>Asked On</th>
                                        <th>Status</th>
                                        @role('Teacher')
                                        <th>Action</th>
                                        @endrole
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($queries as $key=>$item)
                                    @php
                                    $course = App\Models\Backend\Course::where('id',$item->course_id)->first();
                                    $student = App\Models\User::where('id',$item->student_id)->first();
                                    $teacher = App\Models\Backend\Teacher::where('user_id',$item->teacher_id)->first();
                                    $asked_on = Carbon\Carbon::parse($item->created_at)->format('d F Y');
                                    @endphp
                                    <tr>
                                        <td>{{++$key}}</td>
                                        <td>{{$course->course_name}}</td>
                                        @role('Admin')
                                        <td>{{$teacher->name}}</td>
                                        @endrole
                                        <td>{{$student->name}}</td>
                                        <td>{{$asked_on}}</td>
                                        <td>{{$item->status}}</td>
                                        @role('Teacher')
                                        <td>
                                            <div class="dropdown dropdown-action">
                                                <a href="#" class="action-icon dropdown-toggle" data-toggle="dropdown" aria-expanded="false"><i class="fas fa-ellipsis-v"></i></a>
                                                <div class="dropdown-menu dropdown-menu-right">
                                                    <a class="dropdown-item" href="{{route('queries.edit',$item->id)}}"><i class="fas fa-pencil-alt m-r-5"></i> Give Answer</a>
                                                </div>
                                            </div>
                                        </td>
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