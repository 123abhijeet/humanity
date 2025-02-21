@extends('backend.layouts.master')
@section('title','Donors | Humanity')
@section('body')
<style>
     .dataTables_scrollBody {
        position: inherit !important;
        overflow: auto !important;
        width: 100% !important;
    }
</style>
<div class="page-wrapper">
    <div class="content container-fluid">
        <div class="page-header">
            <div class="row">
                <div class="col-md-6">
                    <h3 class="page-title mb-0">Donors</h3>
                </div>
                <div class="col-md-6">
                    <ul class="breadcrumb mb-0 p-0 float-right">
                        <li class="breadcrumb-item">
                            <a href="{{route('Admin-Dashboard')}}"><i class="fas fa-home"></i> Home</a>
                        </li>
                        <li class="breadcrumb-item"><span>Donors</span></li>
                    </ul>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-sm-4 col-12"></div>
        </div>
        <div class="row">
            <div class="col-sm-12">
                <div class="card">
                    <div class="card-body">
                        <div class="table-responsiveness">
                            <table class="table custom-table DataTable" style="width: 100%;">
                                <thead class="thead-light">
                                    <tr>
                                        <th>#</th>
                                        <th>Name</th>
                                        <th>Mobile</th>
                                        <th>Age</th>
                                        <th>Blood Group</th>
                                        <th>Address</th>
                                        <th>Venue</th>
                                        <th>Vanue Address</th>
                                        <th>Last Donation Date</th>
                                        <th>Donation Date</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($donors as $key=>$item)
                                    @php 
                                    $donors_last_donation_date = \Carbon\Carbon::parse($item->donors_last_donation_date)->format('d M Y');
                                    $donation_date = \Carbon\Carbon::parse($item->donation_date)->format('d M Y');
                                    @endphp
                                    <tr>
                                        <td>{{++$key}}</td>
                                        <td>{{$item->donors_name}}</td>
                                        <td>{{$item->donors_mobile}}</td>
                                        <td>{{$item->donors_age}}</td>
                                        <td>{{$item->donors_blood_group}}</td>
                                        <td>{{$item->donors_address}}</td>
                                        <td>{{$item->vanue_name}}</td>
                                        <td>{{$item->vanue_address}}</td>
                                        <td>{{$donors_last_donation_date}}</td>
                                        <td>{{$donation_date}}</td>
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