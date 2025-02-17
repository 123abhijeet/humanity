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
                                        <th>Student Name</th>
                                        <th>Course</th>
                                        <th>Price</th>
                                        <th>Teacher</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td>1</td>
                                        <td>Abhijeet Kumar</td>
                                        <td>Spoken English</td>
                                        <td>5000</td>
                                        <td>Ramesh Verma</td>
                                    </tr>
                                    <tr>
                                        <td>2</td>
                                        <td>Ravi Kumar</td>
                                        <td>Laravel Web Development</td>
                                        <td>8000</td>
                                        <td>Vinay Sharma</td>
                                    </tr>
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