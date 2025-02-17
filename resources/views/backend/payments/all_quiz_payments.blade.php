@extends('backend.layouts.master')
@section('title','Quiz Payments | Sattree Gurukul')
@section('body')
<div class="page-wrapper">
    <div class="content container-fluid">
        <div class="page-header">
            <div class="row">
                <div class="col-md-6">
                    <h3 class="page-title mb-0">Quiz Payments</h3>
                </div>
                <div class="col-md-6">
                    <ul class="breadcrumb mb-0 p-0 float-right">
                        <li class="breadcrumb-item">
                            <a href="{{route('Admin-Dashboard')}}"><i class="fas fa-home"></i> Home</a>
                        </li>
                        <li class="breadcrumb-item"><span>Quiz Payments</span></li>
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
                                    <tr class="text-center">
                                        <th>#</th>
                                        <th>Student Name</th>
                                        <th>Quiz</th>
                                        <th>price</th>
                                        <th>Discount Coupon</th>
                                        <th>Amount Paid</th>
                                        <th>Payment Date</th>
                                        <th>Payment Status</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($all_quiz_payments as $key=>$item)
                                    @php
                                    $quiz = App\Models\Teacher\Quiz::where('id',$item->quiz_id)->first();
                                    $student = App\Models\User::where('id',$item->student_id)->first();
                                    $formatted_date = \Carbon\Carbon::parse($item->updated_at)->format('d F Y');
                                    @endphp
                                    <tr class="text-center">
                                        <td>{{++$key}}</td>
                                        <td>{{$student->name}}</td>
                                        <td>{{$quiz->title}}</td>
                                        <td>₹ {{$quiz->price}}</td>
                                        <td>{{!empty($item->coupon_code) ? $item->coupon_code : 'N/A'}}</td>
                                        <td>₹ {{!empty($item->discounted_amount) ? $item->discounted_amount : $quiz->price }}</td>
                                        <td>{{$formatted_date}}</td>
                                        <td>{{$item->payment_status}}</td>
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
@foreach($all_quiz_payments as $key=>$item)
<div class="modal custom-modal fade" id="upload_{{$item->id}}">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">Upload Proof</h4>
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
            </div>
            <div class="modal-body">
                <form action="{{route('Upload-Quiz-Payment-Proof',$item->id)}}" method="post" enctype="multipart/form-data">
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