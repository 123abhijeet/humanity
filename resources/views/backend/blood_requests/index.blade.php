@extends('backend.layouts.master')
@section('title','Blood Requests | Humanity')
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
                    <h3 class="page-title mb-0">Blood Requests</h3>
                </div>
                <div class="col-md-6">
                    <ul class="breadcrumb mb-0 p-0 float-right">
                        <li class="breadcrumb-item">
                            <a href="{{route('Admin-Dashboard')}}"><i class="fas fa-home"></i> Home</a>
                        </li>
                        <li class="breadcrumb-item"><span>Blood Requests</span></li>
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
                                        <th>Patent Name</th>
                                        <th>Patent Age</th>
                                        <th>Patent Blood Group</th>
                                        <th>Patent Address</th>
                                        <th>Patent Problem</th>
                                        <th>Unit Required</th>
                                        <th>Required Date</th>
                                        <th>Donated Unit</th>
                                        <th>Hospital</th>
                                        <th>Hospital Address</th>
                                        <th>Attendent Name</th>
                                        <th>Attendent Mobile</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($blood_requests as $key=>$item)
                                    @php 
                                    $date_required = \Carbon\Carbon::parse($item->date_required)->format('d M Y');
                                    @endphp
                                    <tr>
                                        <td>{{++$key}}</td>
                                        <td>{{$item->patent_name}}</td>
                                        <td>{{$item->patent_age}}</td>
                                        <td>{{$item->patent_blood_group}}</td>
                                        <td>{{$item->patent_address}}</td>
                                        <td>{{$item->patent_problem}}</td>
                                        <td>{{$item->unit_required}}</td>
                                        <td>{{$date_required}}</td>
                                        <td>{{$item->donated_unit}}</td>
                                        <td>{{$item->hospital_name}}</td>
                                        <td>{{$item->hospital_address}}</td>
                                        <td>{{$item->attendent_name}}</td>
                                        <td>{{$item->attendent_mobile}}</td>
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