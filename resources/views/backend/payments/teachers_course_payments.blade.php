@extends('backend.layouts.master')
@section('title','Teachers Course Payments | Sattree Gurukul')
@section('body')
<div class="page-wrapper">
    <div class="content container-fluid">
        <div class="page-header">
            <div class="row">
                <div class="col-md-6">
                    <h3 class="page-title mb-0">Teachers Course Payments</h3>
                </div>
                <div class="col-md-6">
                    <ul class="breadcrumb mb-0 p-0 float-right">
                        <li class="breadcrumb-item">
                            <a href="{{route('Admin-Dashboard')}}"><i class="fas fa-home"></i> Home</a>
                        </li>
                        <li class="breadcrumb-item"><span>Teachers Course Payments</span></li>
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
                                        <th>Student Name</th>
                                        <th>Instructor Name</th>
                                        <th>Course</th>
                                        <th>Payment Type</th>
                                        <th>Commission</th>
                                        <th>Payment Date</th>
                                        <th>Payment Status</th>
                                        <th>Payment Proof</th>
                                        <th>Upload Proof</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($teachers_course_payments as $key=>$item)
                                    @php
                                    $course = App\Models\Backend\Course::where('id',$item->course_id)->first();
                                    $student = App\Models\User::where('id',$item->student_id)->first();
                                    $instructor = App\Models\Backend\Teacher::where('user_id',$item->teacher_id)->first();
                                    $formatted_date = \Carbon\Carbon::parse($item->updated_at)->format('d F Y');
                                    @endphp
                                    <tr>
                                        <td>{{++$key}}</td>
                                        <td>{{$student->name}}</td>
                                        <td>{{$instructor->name}}</td>
                                        <td>{{$course->course_name}}</td>
                                        <td>{{$item->payment_type == 'one_time' ? 'Full Payment' : 'EMI' }}</td>
                                        <td>₹ {{$item->commission}}</td>
                                        <td>{{$formatted_date}}</td>
                                        <td>{{$item->payment_status}}</td>
                                        @if($item->payment_proof == '')
                                        <td>N/A</td>
                                        @else
                                        <td><img src="{{asset('Course Payment Proof/'.$item->payment_proof)}}" alt="" height="100" width="100"></td>
                                        @endif
                                        <td> <a class="dropdown-item" href="" data-toggle="modal" data-target="#upload_{{$item->id}}"><i class="fas fa-upload m-r-5"></i> Upload</a></td>
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
@foreach($teachers_course_payments as $key=>$item)
<div class="modal custom-modal fade" id="upload_{{$item->id}}">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">Upload Proof</h4>
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
            </div>
            <div class="modal-body">
                <form action="{{route('Upload-Course-Payment-Proof',$item->id)}}" method="post" enctype="multipart/form-data">
                    @csrf
                    <div class="form-group">
                        <label>Upload</label>
                        <input class="form-control form-white" placeholder="Enter name" type="file" name="payment_proof">
                    </div>
                    <div class="submit-section text-center">
                        <button type="submit" class="btn btn-primary save-type submit-btn">Upload</button>
                        <button type="button" class="btn btn-danger" data-dismiss="modal">Cancle</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endforeach
@endsection