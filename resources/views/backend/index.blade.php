@extends('backend.layouts.master')
@section('title','Dashboard | Humanity')
@section('body')
<!-- index start -->
<div class="page-wrapper">
    <div class="content container-fluid">
        <div class="page-header">
            <div class="row">
                <div class="col-md-6">
                    <h3 class="page-title mb-0">Dashboard</h3>
                </div>
                <div class="col-md-6">
                    <ul class="breadcrumb mb-0 p-0 float-right">
                        <li class="breadcrumb-item">
                            <a href="{{route('Admin-Dashboard')}}"><i class="fas fa-home"></i> Home</a>
                        </li>
                        <li class="breadcrumb-item"><span>Dashboard</span></li>
                    </ul>
                </div>
            </div>
        </div>
        @role('Admin')
        <div class="row">
            <div class="col-md-6 col-sm-6 col-lg-6 col-xl-4">
                <div class="dash-widget dash-widget5">
                    <span class="float-left"><img src="{{asset('backend/img/dash/dash-1.png')}}" alt="" width="80" /></span>
                    <div class="dash-widget-info text-right">
                        <span>Students</span>
                        <h3>600</h3>
                    </div>
                </div>
            </div>
            <div class="col-md-6 col-sm-6 col-lg-6 col-xl-4">
                <div class="dash-widget dash-widget5">
                    <span class="float-left"><img src="{{asset('backend/img/dash/dash-3.png')}}" alt="" width="80" /></span>
                    <div class="dash-widget-info text-right">
                        <span>Courses</span>
                        <h3>50</h3>
                    </div>
                </div>
            </div>
            <div class="col-md-6 col-sm-6 col-lg-6 col-xl-4">
                <div class="dash-widget dash-widget5">
                    <div class="dash-widget-info d-inline-block text-left">
                        <span>Total Earnings</span>
                        <h3>Rs 20,000</h3>
                    </div>
                    <span class="float-right"><img src="{{asset('backend/img/dash/dash-4.png')}}" alt="" width="80" /></span>
                </div>
            </div>
        </div>
        @endrole

        @role('Teacher')
        <div class="row">
            <div class="col-md-6 col-sm-6 col-lg-6 col-xl-4">
                <div class="dash-widget dash-widget5">
                    <span class="float-left"><img src="{{asset('backend/img/dash/dash-1.png')}}" alt="" width="80" /></span>
                    <div class="dash-widget-info text-right">
                        <span>Students</span>
                        <h3>60</h3>
                    </div>
                </div>
            </div>
            <div class="col-md-6 col-sm-6 col-lg-6 col-xl-4">
                <div class="dash-widget dash-widget5">
                    <span class="float-left"><img src="{{asset('backend/img/dash/dash-3.png')}}" alt="" width="80" /></span>
                    <div class="dash-widget-info text-right">
                        <span>Courses</span>
                        <h3>4</h3>
                    </div>
                </div>
            </div>
            <div class="col-md-6 col-sm-6 col-lg-6 col-xl-4">
                <div class="dash-widget dash-widget5">
                    <div class="dash-widget-info d-inline-block text-left">
                        <span>Total Earnings</span>
                        <h3>Rs 5,000</h3>
                    </div>
                    <span class="float-right"><img src="{{asset('backend/img/dash/dash-4.png')}}" alt="" width="80" /></span>
                </div>
            </div>
        </div>
        @endrole

        <!-- <div class="row">
            <div class="col-lg-6 d-flex">
                <div class="card flex-fill">
                    <div class="card-header">
                        <div class="row align-items-center">
                            <div class="col-auto">
                                <div class="page-title">Students Survay</div>
                            </div>
                            <div class="col text-right">
                                <div class="mt-sm-0 mt-2">
                                    <button class="btn btn-light" type="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                        <i class="fas fa-ellipsis-h"></i>
                                    </button>
                                    <div class="dropdown-menu dropdown-menu-right">
                                        <a class="dropdown-item" href="#">Action</a>
                                        <div role="separator" class="dropdown-divider"></div>
                                        <a class="dropdown-item" href="#">Another action</a>
                                        <div role="separator" class="dropdown-divider"></div>
                                        <a class="dropdown-item" href="#">Something else here</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="card-body">
                        <div id="chart1"></div>
                    </div>
                </div>
            </div>
            <div class="col-lg-6 d-flex">
                <div class="card flex-fill">
                    <div class="card-header">
                        <div class="row align-items-center">
                            <div class="col-auto">
                                <div class="page-title">Student Performance</div>
                            </div>
                            <div class="col text-right">
                                <div class="mt-sm-0 mt-2">
                                    <button class="btn btn-light" type="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                        <i class="fas fa-ellipsis-h"></i>
                                    </button>
                                    <div class="dropdown-menu dropdown-menu-right">
                                        <a class="dropdown-item" href="#">Action</a>
                                        <div role="separator" class="dropdown-divider"></div>
                                        <a class="dropdown-item" href="#">Another action</a>
                                        <div role="separator" class="dropdown-divider"></div>
                                        <a class="dropdown-item" href="#">Something else here</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="card-body">
                        <div id="chart2"></div>
                    </div>
                </div>
            </div>
        </div> -->
        <!-- <div class="row">
            <div class="col-lg-6 col-md-12 col-12 d-flex">
                <div class="card flex-fill">
                    <div class="card-header">
                        <div class="row align-items-center">
                            <div class="col-auto">
                                <div class="page-title">Events</div>
                            </div>
                            <div class="col text-right">
                                <div class="mt-sm-0 mt-2">
                                    <button class="btn btn-light" type="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                        <i class="fas fa-ellipsis-h"></i>
                                    </button>
                                    <div class="dropdown-menu dropdown-menu-right">
                                        <a class="dropdown-item" href="#">Action</a>
                                        <div role="separator" class="dropdown-divider"></div>
                                        <a class="dropdown-item" href="#">Another action</a>
                                        <div role="separator" class="dropdown-divider"></div>
                                        <a class="dropdown-item" href="#">Something else here</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="card-body">
                        <div id="calendar" class="overflow-hidden"></div>
                    </div>
                </div>
            </div>
            <div class="col-lg-6 col-md-12 col-12 d-flex">
                <div class="card flex-fill">
                    <div class="card-header">
                        <div class="row align-items-center">
                            <div class="col-auto">
                                <div class="page-title">Total Member</div>
                            </div>
                            <div class="col text-right">
                                <div class="mt-sm-0 mt-2">
                                    <button class="btn btn-light" type="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                        <i class="fas fa-ellipsis-h"></i>
                                    </button>
                                    <div class="dropdown-menu dropdown-menu-right">
                                        <a class="dropdown-item" href="#">Action</a>
                                        <div role="separator" class="dropdown-divider"></div>
                                        <a class="dropdown-item" href="#">Another action</a>
                                        <div role="separator" class="dropdown-divider"></div>
                                        <a class="dropdown-item" href="#">Something else here</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="card-body d-flex align-items-center justify-content-center overflow-hidden">
                        <div id="chart3"></div>
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-lg-6 col-md-12 col-12 d-flex">
                <div class="card flex-fill">
                    <div class="card-header">
                        <div class="row align-items-center">
                            <div class="col-auto">
                                <div class="page-title">Income Monthwise</div>
                            </div>
                            <div class="col text-right">
                                <div class="mt-sm-0 mt-2">
                                    <button class="btn btn-light" type="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                        <i class="fas fa-ellipsis-h"></i>
                                    </button>
                                    <div class="dropdown-menu dropdown-menu-right">
                                        <a class="dropdown-item" href="#">Action</a>
                                        <div role="separator" class="dropdown-divider"></div>
                                        <a class="dropdown-item" href="#">Another action</a>
                                        <div role="separator" class="dropdown-divider"></div>
                                        <a class="dropdown-item" href="#">Something else here</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="card-body">
                        <div id="chart4"></div>
                    </div>
                </div>
            </div>
            <div class="col-lg-6 d-flex">
                <div class="card flex-fill">
                    <div class="card-header">
                        <div class="row align-items-center">
                            <div class="col-auto">
                                <div class="page-title">Exam List</div>
                            </div>
                            <div class="col text-right">
                                <div class="mt-sm-0 mt-2">
                                    <button class="btn btn-light" type="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                        <i class="fas fa-ellipsis-h"></i>
                                    </button>
                                    <div class="dropdown-menu dropdown-menu-right">
                                        <a class="dropdown-item" href="#">Action</a>
                                        <div role="separator" class="dropdown-divider"></div>
                                        <a class="dropdown-item" href="#">Another action</a>
                                        <div role="separator" class="dropdown-divider"></div>
                                        <a class="dropdown-item" href="#">Something else here</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-12">
                                <div class="table-responsive">
                                    <table class="table custom-table">
                                        <thead class="thead-light">
                                            <tr>
                                                <th>Exam Name</th>
                                                <th>Subject</th>
                                                <th>Class</th>
                                                <th>Section</th>
                                                <th>Time</th>
                                                <th>Date</th>
                                                <th class="text-right">Action</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <tr>
                                                <td>
                                                    <a href="exam-detail.html" class="avatar bg-green">C</a>
                                                </td>
                                                <td>English</td>
                                                <td>5</td>
                                                <td>B</td>
                                                <td>10.00am</td>
                                                <td>20/1/2019</td>
                                                <td class="text-right">
                                                    <a href="edit-exam.html" class="btn btn-primary btn-sm mb-1">
                                                        <i class="far fa-edit"></i>
                                                    </a>
                                                    <button type="submit" data-toggle="modal" data-target="#delete_employee" class="btn btn-danger btn-sm mb-1">
                                                        <i class="far fa-trash-alt"></i>
                                                    </button>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td>
                                                    <a href="exam-detail.html" class="avatar bg-purple">C</a>
                                                </td>
                                                <td>English</td>
                                                <td>4</td>
                                                <td>A</td>
                                                <td>10.00am</td>
                                                <td>2/1/2019</td>
                                                <td class="text-right">
                                                    <a href="edit-exam.html" class="btn btn-primary btn-sm mb-1">
                                                        <i class="far fa-edit"></i>
                                                    </a>
                                                    <button type="submit" data-toggle="modal" data-target="#delete_employee" class="btn btn-danger btn-sm mb-1">
                                                        <i class="far fa-trash-alt"></i>
                                                    </button>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td>
                                                    <a href="exam-detail.html" class="avatar bg-green">C</a>
                                                </td>
                                                <td>Maths</td>
                                                <td>6</td>
                                                <td>B</td>
                                                <td>10.00am</td>
                                                <td>2/1/2019</td>
                                                <td class="text-right">
                                                    <a href="edit-exam.html" class="btn btn-primary btn-sm mb-1">
                                                        <i class="far fa-edit"></i>
                                                    </a>
                                                    <button type="submit" data-toggle="modal" data-target="#delete_employee" class="btn btn-danger btn-sm mb-1">
                                                        <i class="far fa-trash-alt"></i>
                                                    </button>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td>
                                                    <a href="exam-detail.html" class="avatar bg-dark">C</a>
                                                </td>
                                                <td>Science</td>
                                                <td>3</td>
                                                <td>B</td>
                                                <td>10.00am</td>
                                                <td>20/1/2019</td>
                                                <td class="text-right">
                                                    <a href="edit-exam.html" class="btn btn-primary btn-sm mb-1">
                                                        <i class="far fa-edit"></i>
                                                    </a>
                                                    <button type="submit" data-toggle="modal" data-target="#delete_employee" class="btn btn-danger btn-sm mb-1">
                                                        <i class="far fa-trash-alt"></i>
                                                    </button>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td>
                                                    <a href="exam-detail.html" class="avatar bg-green">C</a>
                                                </td>
                                                <td>Maths</td>
                                                <td>6</td>
                                                <td>B</td>
                                                <td>10.00am</td>
                                                <td>20/1/2019</td>
                                                <td class="text-right">
                                                    <a href="edit-exam.html" class="btn btn-primary btn-sm mb-1">
                                                        <i class="far fa-edit"></i>
                                                    </a>
                                                    <button type="submit" data-toggle="modal" data-target="#delete_employee" class="btn btn-danger btn-sm mb-1">
                                                        <i class="far fa-trash-alt"></i>
                                                    </button>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td>
                                                    <a href="exam-detail.html" class="avatar bg-dark">C</a>
                                                </td>
                                                <td>English</td>
                                                <td>7</td>
                                                <td>B</td>
                                                <td>10.00am</td>
                                                <td>20/1/2019</td>
                                                <td class="text-right">
                                                    <a href="edit-exam.html" class="btn btn-primary btn-sm mb-1">
                                                        <i class="far fa-edit"></i>
                                                    </a>
                                                    <button type="submit" data-toggle="modal" data-target="#delete_employee" class="btn btn-danger btn-sm mb-1">
                                                        <i class="far fa-trash-alt"></i>
                                                    </button>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td>
                                                    <a href="exam-detail.html" class="avatar bg-purple">C</a>
                                                </td>
                                                <td>Science</td>
                                                <td>5</td>
                                                <td>B</td>
                                                <td>10.00am</td>
                                                <td>20/1/2019</td>
                                                <td class="text-right">
                                                    <a href="edit-exam.html" class="btn btn-primary btn-sm mb-1">
                                                        <i class="far fa-edit"></i>
                                                    </a>
                                                    <button type="submit" data-toggle="modal" data-target="#delete_employee" class="btn btn-danger btn-sm mb-1">
                                                        <i class="far fa-trash-alt"></i>
                                                    </button>
                                                </td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div> -->
        <div class="row">
            <div class="col-lg-12">
                <div class="card">
                    <div class="card-header">
                        <div class="row align-items-center">
                            <div class="col-sm-6">
                                <div class="page-title">All Students</div>
                            </div>
                            <div class="col-sm-6 text-sm-right">
                                <div class="mt-sm-0 mt-2">
                                    <button class="btn btn-outline-primary mr-2">
                                        <img src="{{asset('backend/img/excel.png')}}" alt="" /><span class="ml-2">Excel</span>
                                    </button>
                                    <button class="btn btn-outline-danger mr-2">
                                        <img src="{{asset('backend/img/pdf.png')}}" alt="" height="18" /><span class="ml-2">PDF</span>
                                    </button>
                                    <button class="btn btn-light" type="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                        <i class="fas fa-ellipsis-h"></i>
                                    </button>
                                    <!-- <div class="dropdown-menu dropdown-menu-right">
                                        <a class="dropdown-item" href="#">Action</a>
                                        <div role="separator" class="dropdown-divider"></div>
                                        <a class="dropdown-item" href="#">Another action</a>
                                        <div role="separator" class="dropdown-divider"></div>
                                        <a class="dropdown-item" href="#">Something else here</a>
                                    </div> -->
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table custom-table">
                                <thead class="thead-light">
                                    <tr>
                                        <th>Name</th>
                                        <th>Student ID</th>
                                        <th>Class</th>
                                        <th>Age</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td>
                                            <h2>
                                                Ankita kumari
                                            </h2>
                                        </td>
                                        <td>ST-0001</td>
                                        <td>Vocational</td>
                                        <td>26 Years</td>
                                    </tr>
                                    <tr>
                                        <td>
                                            <h2>
                                            Himanshu kumari
                                            </h2>
                                        </td>
                                        <td>ST-0002</td>
                                        <td>Vocational</td>
                                        <td>28 Years</td>
                                    </tr>
                                    <tr>
                                        <td>
                                            <h2>
                                            Vishal kumar
                                            </h2>
                                        </td>
                                        <td>ST-0003</td>
                                        <td>Vocational</td>
                                        <td>19 Years</td>
                                    </tr>
                                    <tr>
                                        <td>
                                            <h2>
                                            Priyanshu kumar
                                            </h2>
                                        </td>
                                        <td>ST-0004</td>
                                        <td>Vocational</td>
                                        <td>19 Years</td>
                                    </tr>
                                    <tr>
                                        <td>
                                            <h2>
                                            Aakash kumar
                                            </h2>
                                        </td>
                                        <td>ST-0005</td>
                                        <td>Vocational</td>
                                        <td>28 Years</td>
                                    </tr>
                                    <tr>
                                        <td>
                                            <h2>
                                            Mantu kumar
                                            </h2>
                                        </td>
                                        <td>ST-0006</td>
                                        <td>Vocational</td>
                                        <td>25 Years</td>
                                    </tr>
                                    <tr>
                                        <td>
                                            <h2>
                                            Aniket kumar
                                            </h2>
                                        </td>
                                        <td>ST-0007</td>
                                        <td>Vocational</td>
                                        <td>17 Years</td>
                                    </tr>
                                    <tr>
                                        <td>
                                            <h2>
                                            Sumit kumar
                                            </h2>
                                        </td>
                                        <td>ST-0008</td>
                                        <td>Vocational</td>
                                        <td>25 Years</td>
                                    </tr>
                                    <tr>
                                        <td>
                                            <h2>
                                            Sachin kumar
                                            </h2>
                                        </td>
                                        <td>ST-0009</td>
                                        <td>Vocational</td>
                                        <td>26 Years</td>
                                    </tr>
                                    <tr>
                                        <td>
                                            <h2>
                                            Raghav kumar
                                            </h2>
                                        </td>
                                        <td>ST-0010</td>
                                        <td>Vocational</td>
                                        <td>25 Years</td>
                                    </tr>
                                    <tr>
                                        <td>
                                            <h2>
                                            Pappu kumar
                                            </h2>
                                        </td>
                                        <td>ST-0011</td>
                                        <td>Vocational</td>
                                        <td>26 Years</td>
                                    </tr>
                                    
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-header">
                        <div class="row align-items-center">
                            <div class="col-sm-6">
                                <div class="page-title">New Students</div>
                            </div>
                            <div class="col-sm-6 text-sm-right">
                                <div class="mt-sm-0 mt-2">
                                    <button class="btn btn-outline-primary mr-2">
                                        <img src="{{asset('backend/img/excel.png')}}" alt="" /><span class="ml-2">Excel</span>
                                    </button>
                                    <button class="btn btn-outline-danger mr-2">
                                        <img src="{{asset('backend/img/pdf.png')}}" alt="" height="18" /><span class="ml-2">PDF</span>
                                    </button>
                                    <button class="btn btn-light" type="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                        <i class="fas fa-ellipsis-h"></i>
                                    </button>
                                    <div class="dropdown-menu dropdown-menu-right">
                                        <a class="dropdown-item" href="#">Action</a>
                                        <div role="separator" class="dropdown-divider"></div>
                                        <a class="dropdown-item" href="#">Another action</a>
                                        <div role="separator" class="dropdown-divider"></div>
                                        <a class="dropdown-item" href="#">Something else here</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="card-body">
                        <div class="row">
                            <div class="col-lg-12 col-md-12 col-sm-12 col-12">
                                <div class="table-responsive">
                                    <table class="table custom-table">
                                        <thead class="thead-light">
                                            <tr>
                                                <th>Name</th>
                                                <th>Student ID</th>
                                                <th>Parent Name</th>
                                                <th>Mobile</th>
                                                <th>Address</th>
                                                <th>Date Of Admition</th>
                                                <th>Fees Receipt</th>
                                                <th class="text-right">Action</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <tr>
                                                <td>
                                                    <h2>
                                                        <a href="" class="avatar text-white"><img src="{{asset('backend/img/profile/img-1.jpg')}}" alt="" /></a><a href="">Parker <span></span></a>
                                                    </h2>
                                                </td>
                                                <td>ST-0d001</td>
                                                <td>Mr. Johnson</td>
                                                <td>973-584-58700</td>
                                                <td>9946 Baker Rd. Marysville,</td>
                                                <td>20/1/2021</td>
                                                <td><img src="{{asset('backend/img/pdf.png')}}" alt="" /></td>
                                                <td class="text-right">
                                                    <a href="" class="btn btn-primary btn-sm mb-1">
                                                        <i class="far fa-edit"></i>
                                                    </a>
                                                    <button type="submit" data-toggle="modal" data-target="#delete_employee" class="btn btn-danger btn-sm mb-1">
                                                        <i class="far fa-trash-alt"></i>
                                                    </button>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td>
                                                    <h2>
                                                        <a href="" class="avatar text-white"><img src="{{asset('backend/img/profile/img-2.jpg')}}" alt="" /></a><a href="">Smith <span></span></a>
                                                    </h2>
                                                </td>
                                                <td>ST-0d002</td>
                                                <td>Mr. Luke Idaman</td>
                                                <td>973-584-58700</td>
                                                <td>193 S. Harrison Drive</td>
                                                <td>20/1/2021</td>
                                                <td><img src="{{asset('backend/img/pdf.png')}}" alt="" /></td>
                                                <td class="text-right">
                                                    <a href="" class="btn btn-primary btn-sm mb-1">
                                                        <i class="far fa-edit"></i>
                                                    </a>
                                                    <button type="submit" data-toggle="modal" data-target="#delete_employee" class="btn btn-danger btn-sm mb-1">
                                                        <i class="far fa-trash-alt"></i>
                                                    </button>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td>
                                                    <h2>
                                                        <a href="" class="avatar text-white"><img src="{{asset('backend/img/profile/img-3.jpg')}}" alt="" /></a><a href="">Hensley<span></span></a>
                                                    </h2>
                                                </td>
                                                <td>ST-0d003</td>
                                                <td>Mr. Kevin H</td>
                                                <td>973-584-58700</td>
                                                <td>8949 Golf St. Palm Coast</td>
                                                <td>20/1/2021</td>
                                                <td><img src="{{asset('backend/img/pdf.png')}}" alt="" /></td>
                                                <td class="text-right">
                                                    <a href="" class="btn btn-primary btn-sm mb-1">
                                                        <i class="far fa-edit"></i>
                                                    </a>
                                                    <button type="submit" data-toggle="modal" data-target="#delete_employee" class="btn btn-danger btn-sm mb-1">
                                                        <i class="far fa-trash-alt"></i>
                                                    </button>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td>
                                                    <h2>
                                                        <a href="" class="avatar text-white"><img src="{{asset('backend/img/profile/img-4.jpg')}}" alt="" /></a><a href="">Friesen<span></span></a>
                                                    </h2>
                                                </td>
                                                <td>ST-0d004</td>
                                                <td>Mr. Randy O</td>
                                                <td>973-584-58700</td>
                                                <td>23 Ohio Court Alexandria</td>
                                                <td>20/1/2021</td>
                                                <td><img src="{{asset('backend/img/pdf.png')}}" alt="" /></td>
                                                <td class="text-right">
                                                    <a href="" class="btn btn-primary btn-sm mb-1">
                                                        <i class="far fa-edit"></i>
                                                    </a>
                                                    <button type="submit" data-toggle="modal" data-target="#delete_employee" class="btn btn-danger btn-sm mb-1">
                                                        <i class="far fa-trash-alt"></i>
                                                    </button>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td>
                                                    <h2>
                                                        <a href="" class="avatar text-white"><img src="{{asset('backend/img/profile/img-5.jpg')}}" alt="" /></a><a href="">Jackson<span></span></a>
                                                    </h2>
                                                </td>
                                                <td>ST-0d005</td>
                                                <td>Mr. Steven</td>
                                                <td>973-584-58700</td>
                                                <td>338 North Cleveland Rd</td>
                                                <td>20/1/2021</td>
                                                <td><img src="{{asset('backend/img/pdf.png')}}" alt="" /></td>
                                                <td class="text-right">
                                                    <a href="" class="btn btn-primary btn-sm mb-1">
                                                        <i class="far fa-edit"></i>
                                                    </a>
                                                    <button type="submit" data-toggle="modal" data-target="#delete_employee" class="btn btn-danger btn-sm mb-1">
                                                        <i class="far fa-trash-alt"></i>
                                                    </button>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td>
                                                    <h2>
                                                        <a href="" class="avatar text-white"><img src="{{asset('backend/img/profile/img-6.jpg')}}" alt="" /></a><a href="">Mason<span></span></a>
                                                    </h2>
                                                </td>
                                                <td>ST-0d006</td>
                                                <td>Mr. Ervin</td>
                                                <td>973-584-58700</td>
                                                <td>7909 W. Sunnyslope St.</td>
                                                <td>20/1/2021</td>
                                                <td><img src="{{asset('backend/img/pdf.png')}}" alt="" /></td>
                                                <td class="text-right">
                                                    <a href="" class="btn btn-primary btn-sm mb-1">
                                                        <i class="far fa-edit"></i>
                                                    </a>
                                                    <button type="submit" data-toggle="modal" data-target="#delete_employee" class="btn btn-danger btn-sm mb-1">
                                                        <i class="far fa-trash-alt"></i>
                                                    </button>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td>
                                                    <h2>
                                                        <a href="" class="avatar text-white"><img src="{{asset('backend/img/profile/img-7.jpg')}}" alt="" /></a>
                                                        <a href="">Garrett <span></span></a>
                                                    </h2>
                                                </td>
                                                <td>ST-0d007</td>
                                                <td>Mr. Marquz</td>
                                                <td>973-584-58700</td>
                                                <td>7361 Dunbar Street</td>
                                                <td>20/1/2021</td>
                                                <td><img src="{{asset('backend/img/pdf.png')}}" alt="" /></td>
                                                <td class="text-right">
                                                    <a href="" class="btn btn-primary btn-sm mb-1">
                                                        <i class="far fa-edit"></i>
                                                    </a>
                                                    <button type="submit" data-toggle="modal" data-target="#delete_employee" class="btn btn-danger btn-sm mb-1">
                                                        <i class="far fa-trash-alt"></i>
                                                    </button>
                                                </td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div> -->

    </div>
</div>
<!-- index end -->
@endsection