@extends('backend.layouts.master')
@section('title','Book Payments | Sattree Gurukul')
@section('body')
<div class="page-wrapper">
    <div class="content container-fluid">
        <div class="page-header">
            <div class="row">
                <div class="col-md-6">
                    <h3 class="page-title mb-0">Book Payments</h3>
                </div>
                <div class="col-md-6">
                    <ul class="breadcrumb mb-0 p-0 float-right">
                        <li class="breadcrumb-item">
                            <a href="{{route('Admin-Dashboard')}}"><i class="fas fa-home"></i> Home</a>
                        </li>
                        <li class="breadcrumb-item"><span>Book Payments</span></li>
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
                                        <th>Book</th>
                                        <th>Payment Date</th>
                                        <th>Payment Status</th>
                                        <th>Tracking Details</th>
                                        <th>Shipping Details</th>
                                        <th>Upload Tracking Details</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($all_book_payments as $key=>$item)
                                    @php
                                    $book = App\Models\Backend\Book::where('id',$item->book_id)->first();
                                    $student = App\Models\User::where('id',$item->student_id)->first();
                                    $formatted_date = \Carbon\Carbon::parse($item->created_at)->format('d F Y');
                                    @endphp
                                    <tr>
                                        <td>{{++$key}}</td>
                                        <td>{{$student->name}}</td>
                                        <td>{{$book->title}}</td>
                                        <td>{{$formatted_date}}</td>
                                        <td>{{$item->payment_status}}</td>
                                        @if($item->tracking_detail == '')
                                        <td>N/A</td>
                                        @else
                                        <td><img src="{{asset('Tracking Detail/'.$item->tracking_detail)}}" alt="" height="100" width="100"></td>
                                        @endif
                                        <td> <a class="dropdown-item" href="" data-toggle="modal" data-target="#view_{{$item->id}}"><i class="fas fa-eye m-r-5"></i> View</a></td>
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
@foreach($all_book_payments as $key=>$item)
<div class="modal custom-modal fade" id="upload_{{$item->id}}">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">Upload Tracking Detail</h4>
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
            </div>
            <div class="modal-body">
                <form action="{{route('Upload-Book-Tracking-Detail',$item->id)}}" method="post" enctype="multipart/form-data">
                    @csrf
                    <div class="form-group">
                        <label>Upload</label>
                        <input class="form-control form-white" type="file" name="tracking_detail">
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
@foreach($all_book_payments as $key=>$item)
<div class="modal custom-modal fade" id="view_{{$item->id}}">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">View Shipping Details</h4>
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
            </div>
            <div class="modal-body">
                <div class="form-group">
                    <label>Name</label>
                    <input class="form-control form-white" type="text" readonly value="{{$item->name}}">
                </div>
                <div class="form-group">
                    <label>Email</label>
                    <input class="form-control form-white" type="text" readonly value="{{$item->email}}">
                </div>
                <div class="form-group">
                    <label>Mobile</label>
                    <input class="form-control form-white" type="text" readonly value="{{$item->mobile}}">
                </div>
                <div class="form-group">
                    <label>Address</label>
                    <input class="form-control form-white" type="text" readonly value="{{$item->address}}">
                </div>
                <div class="submit-section text-center">
                    <button type="button" class="btn btn-danger" data-dismiss="modal">Cancle</button>
                </div>
            </div>
        </div>
    </div>
</div>
@endforeach
@endsection