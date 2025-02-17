@extends('backend.layouts.master')
@section('title','Course Payments | Sattree Gurukul')
@section('body')
<div class="page-wrapper">
    <div class="content container-fluid">
        <div class="page-header">
            <div class="row">
                <div class="col-md-6">
                    <h3 class="page-title mb-0">Course Payments</h3>
                </div>
                <div class="col-md-6">
                    <ul class="breadcrumb mb-0 p-0 float-right">
                        <li class="breadcrumb-item">
                            <a href="{{route('Admin-Dashboard')}}"><i class="fas fa-home"></i> Home</a>
                        </li>
                        <li class="breadcrumb-item"><span>Course Payments</span></li>
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
                                        <th>Course</th>
                                        <th>Payment Type</th>
                                        <th>Commission</th>
                                        <th>Payment Date</th>
                                        <th>Payment Status</th>
                                        <th>Payment Proof</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($course_payments as $key=>$item)
                                    @php
                                    $course = App\Models\Backend\Course::where('id',$item->course_id)->first();
                                    $student = App\Models\User::where('id',$item->student_id)->first();
                                    $formatted_date = \Carbon\Carbon::parse($item->updated_at)->format('d F Y');
                                    @endphp
                                    <tr>
                                        <td>{{++$key}}</td>
                                        <td>{{$student->name}}</td>
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