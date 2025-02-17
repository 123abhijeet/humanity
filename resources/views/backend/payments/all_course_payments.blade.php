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
                                        <th>Instructor Name</th>
                                        <th>Course</th>
                                        <th>Payment Type</th>
                                        <th>Price</th>
                                        <th>Discount Coupon</th>
                                        <th>Amount Paid</th>
                                        <th>Payment Date</th>
                                        <th>Payment Status</th>
                                        <th>View</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($all_course_payments as $key=>$item)
                                    @php
                                    $course = App\Models\Backend\Course::where('id',$item->course_id)->first();
                                    $student = App\Models\User::where('id',$item->student_id)->first();
                                    $instructor = App\Models\Backend\Teacher::where('user_id',$item->teacher_id)->first();
                                    $formatted_date = \Carbon\Carbon::parse($item->updated_at)->format('d F Y');
                                    $amount_paid = App\Models\Backend\Emipayment::where('course_payment_id',$item->id)->sum('paid_amount');
                                    @endphp
                                    <tr>
                                        <td>{{++$key}}</td>
                                        <td>{{$student->name}}</td>
                                        <td>{{$instructor->name}}</td>
                                        <td>{{$course->course_name}}</td>
                                        <td>{{$item->payment_type == 'one_time' ? 'Full Payment' : 'EMI' }}</td>
                                        <td>₹ {{$item->amount}}</td>
                                        <td>{{!empty($item->coupon_code) ? $item->coupon_code : 'N/A'}}</td>
                                        <td>₹ {{!empty($item->discounted_amount) ? $item->discounted_amount : ($item->payment_type == 'one_time' ? $item->amount : $amount_paid) }}</td>
                                        <td>{{$formatted_date}}</td>
                                        <td>{{$item->payment_status}}</td>
                                        @if($item->payment_type == 'monthly')
                                        <td> <a href="" data-toggle="modal" data-target="#emi_{{$item->id}}"><i class="fas fa-eye m-r-5"></i></a></td>
                                        @else
                                        <td>N/A</td>
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
@foreach($all_course_payments as $key=>$item)
<div class="modal custom-modal fade" id="emi_{{$item->id}}">
    <div class="modal-dialog modal-dialog-centered modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">All Paid EMI</h4>
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
            </div>
            <div class="modal-body">
                <div class="table-responsive">
                    <table class="table custom-table datatable">
                        <thead class="thead-light">
                            <tr>
                                <th>#</th>
                                <th>Course</th>
                                <th>Transaction Id</th>
                                <th>Paid Amount</th>
                                <th>Due Amount</th>
                                <th>Due Date</th>
                                <th>Payment Date</th>
                                <th>Payment Status</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($installments = App\Models\Backend\Emipayment::where('course_payment_id',$item->id)->get() as $key=>$installment)
                            @php
                            $course = App\Models\Backend\Course::where('id',$item->course_id)->first();
                            $due_date = \Carbon\Carbon::parse($installment->due_date)->format('d F Y');
                            $payment_date = \Carbon\Carbon::parse($installment->created_at)->format('d F Y');
                            @endphp
                            <tr>
                                <td>{{++$key}}</td>
                                <td>{{$course->course_name}}</td>
                                <td>{{$installment->transaction_id}}</td>
                                <td>₹{{$installment->paid_amount}}</td>
                                <td>₹{{$installment->due_amount}}</td>
                                <td>{{$due_date}}</td>
                                <td>{{$payment_date}}</td>
                                <td>{{$installment->payment_status}}</td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div> <br>
                <div class="submit-section text-center">
                    <button type="button" class="btn btn-danger float-right" data-dismiss="modal">Close</button>
                </div>
            </div>
        </div>
    </div>
</div>
@endforeach
@endsection