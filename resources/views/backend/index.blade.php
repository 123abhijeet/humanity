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
                        <span>Members</span>
                        <h3>{{$total_members}}</h3>
                    </div>
                </div>
            </div>
            <div class="col-md-6 col-sm-6 col-lg-6 col-xl-4">
                <div class="dash-widget dash-widget5">
                    <span class="float-left"><img src="{{asset('backend/img/dash/dash-3.png')}}" alt="" width="80" /></span>
                    <div class="dash-widget-info text-right">
                        <span>Donors</span>
                        <h3>{{$total_donations}}</h3>
                    </div>
                </div>
            </div>
            <div class="col-md-6 col-sm-6 col-lg-6 col-xl-4">
                <div class="dash-widget dash-widget5">
                    <div class="dash-widget-info d-inline-block text-left">
                        <span>Total Blood Requests</span>
                        <h3>{{$total_requests}}</h3>
                    </div>
                    <span class="float-right"><img src="{{asset('backend/img/dash/dash-4.png')}}" alt="" width="80" /></span>
                </div>
            </div>
        </div>

        <h3 style="color:#bf222b">Total Donated Blood (Units)</h3>
        <div class="row">
            <div class="col-md-3 col-sm-3 col-lg-3 col-xl-3">
                <div class="dash-widget dash-widget5">
                    <span class="float-left"><img src="{{asset('backend/img/dash/dash-1.png')}}" alt="" width="80" /></span>
                    <div class="dash-widget-info text-right">
                        <span style="color:#bf222b">A+</span>
                        <h3>60</h3>
                    </div>
                </div>
            </div>
            <div class="col-md-3 col-sm-3 col-lg-3 col-xl-3">
                <div class="dash-widget dash-widget5">
                    <span class="float-left"><img src="{{asset('backend/img/dash/dash-1.png')}}" alt="" width="80" /></span>
                    <div class="dash-widget-info text-right">
                        <span style="color:#bf222b">A-</span>
                        <h3>6</h3>
                    </div>
                </div>
            </div>
            <div class="col-md-3 col-sm-3 col-lg-3 col-xl-3">
                <div class="dash-widget dash-widget5">
                    <span class="float-left"><img src="{{asset('backend/img/dash/dash-1.png')}}" alt="" width="80" /></span>
                    <div class="dash-widget-info text-right">
                        <span style="color:#bf222b">B+</span>
                        <h3>6</h3>
                    </div>
                </div>
            </div>
            <div class="col-md-3 col-sm-3 col-lg-3 col-xl-3">
                <div class="dash-widget dash-widget5">
                    <span class="float-left"><img src="{{asset('backend/img/dash/dash-1.png')}}" alt="" width="80" /></span>
                    <div class="dash-widget-info text-right">
                        <span style="color:#bf222b">B-</span>
                        <h3>6</h3>
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-3 col-sm-3 col-lg-3 col-xl-3">
                <div class="dash-widget dash-widget5">
                    <span class="float-left"><img src="{{asset('backend/img/dash/dash-1.png')}}" alt="" width="80" /></span>
                    <div class="dash-widget-info text-right">
                        <span style="color:#bf222b">O+</span>
                        <h3>600</h3>
                    </div>
                </div>
            </div>
            <div class="col-md-3 col-sm-3 col-lg-3 col-xl-3">
                <div class="dash-widget dash-widget5">
                    <span class="float-left"><img src="{{asset('backend/img/dash/dash-1.png')}}" alt="" width="80" /></span>
                    <div class="dash-widget-info text-right">
                        <span style="color:#bf222b">O-</span>
                        <h3>400</h3>
                    </div>
                </div>
            </div>
            <div class="col-md-3 col-sm-3 col-lg-3 col-xl-3">
                <div class="dash-widget dash-widget5">
                    <span class="float-left"><img src="{{asset('backend/img/dash/dash-1.png')}}" alt="" width="80" /></span>
                    <div class="dash-widget-info text-right">
                        <span style="color:#bf222b">AB+</span>
                        <h3>60</h3>
                    </div>
                </div>
            </div>
            <div class="col-md-3 col-sm-3 col-lg-3 col-xl-3">
                <div class="dash-widget dash-widget5">
                    <span class="float-left"><img src="{{asset('backend/img/dash/dash-1.png')}}" alt="" width="80" /></span>
                    <div class="dash-widget-info text-right">
                        <span style="color:#bf222b">AB-</span>
                        <h3>60</h3>
                    </div>
                </div>
            </div>
            <div class="col-md-3 col-sm-3 col-lg-3 col-xl-3">
                <div class="dash-widget dash-widget5">
                    <span class="float-left"><img src="{{asset('backend/img/dash/dash-1.png')}}" alt="" width="80" /></span>
                    <div class="dash-widget-info text-right">
                        <span style="color:#bf222b">Bombay</span>
                        <h3>0</h3>
                    </div>
                </div>
            </div>
        </div>
        @endrole

        @role('Teacher')

        @endrole
    </div>
</div>
<!-- index end -->
@endsection