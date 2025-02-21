@extends('backend.layouts.master')
@section('title','Dashboard | Humanity')
@section('body')
<style>
    @keyframes flash {
        0% {
            background-color: #bf222b;
        }

        50% {
            background-color: white;
        }

        100% {
            background-color: #bf222b;
        }
    }

    .flash {
        animation: flash 1s infinite;
    }
</style>
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

        <!-- <h3 style="color:#bf222b">Total Donated Blood (Units)</h3>
        <div class="row">
            <div class="col-md-3 col-sm-3 col-lg-3 col-xl-3">
                <div class="dash-widget dash-widget5">
                    <span class="float-left"><img src="{{asset('backend/img/dash/dash-1.png')}}" alt="" width="80" /></span>
                    <div class="dash-widget-info text-right">
                        <span style="color:#bf222b">A+</span>
                        <h3>{{$totalApositive}}</h3>
                    </div>
                </div>
            </div>
            <div class="col-md-3 col-sm-3 col-lg-3 col-xl-3">
                <div class="dash-widget dash-widget5">
                    <span class="float-left"><img src="{{asset('backend/img/dash/dash-1.png')}}" alt="" width="80" /></span>
                    <div class="dash-widget-info text-right">
                        <span style="color:#bf222b">A-</span>
                        <h3>{{$totalAnegative}}</h3>
                    </div>
                </div>
            </div>
            <div class="col-md-3 col-sm-3 col-lg-3 col-xl-3">
                <div class="dash-widget dash-widget5">
                    <span class="float-left"><img src="{{asset('backend/img/dash/dash-1.png')}}" alt="" width="80" /></span>
                    <div class="dash-widget-info text-right">
                        <span style="color:#bf222b">B+</span>
                        <h3>{{$totalBpositive}}</h3>
                    </div>
                </div>
            </div>
            <div class="col-md-3 col-sm-3 col-lg-3 col-xl-3">
                <div class="dash-widget dash-widget5">
                    <span class="float-left"><img src="{{asset('backend/img/dash/dash-1.png')}}" alt="" width="80" /></span>
                    <div class="dash-widget-info text-right">
                        <span style="color:#bf222b">B-</span>
                        <h3>{{$totalBnegative}}</h3>
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
                        <h3>{{$totalOpositive}}</h3>
                    </div>
                </div>
            </div>
            <div class="col-md-3 col-sm-3 col-lg-3 col-xl-3">
                <div class="dash-widget dash-widget5">
                    <span class="float-left"><img src="{{asset('backend/img/dash/dash-1.png')}}" alt="" width="80" /></span>
                    <div class="dash-widget-info text-right">
                        <span style="color:#bf222b">O-</span>
                        <h3>{{$totalOnegative}}</h3>
                    </div>
                </div>
            </div>
            <div class="col-md-3 col-sm-3 col-lg-3 col-xl-3">
                <div class="dash-widget dash-widget5">
                    <span class="float-left"><img src="{{asset('backend/img/dash/dash-1.png')}}" alt="" width="80" /></span>
                    <div class="dash-widget-info text-right">
                        <span style="color:#bf222b">AB+</span>
                        <h3>{{$totalABpositive}}</h3>
                    </div>
                </div>
            </div>
            <div class="col-md-3 col-sm-3 col-lg-3 col-xl-3">
                <div class="dash-widget dash-widget5">
                    <span class="float-left"><img src="{{asset('backend/img/dash/dash-1.png')}}" alt="" width="80" /></span>
                    <div class="dash-widget-info text-right">
                        <span style="color:#bf222b">AB-</span>
                        <h3>{{$totalABnegative}}</h3>
                    </div>
                </div>
            </div>
            <div class="col-md-3 col-sm-3 col-lg-3 col-xl-3">
                <div class="dash-widget dash-widget5">
                    <span class="float-left"><img src="{{asset('backend/img/dash/dash-1.png')}}" alt="" width="80" /></span>
                    <div class="dash-widget-info text-right">
                        <span style="color:#bf222b">Bombay</span>
                        <h3>{{$totalBombay}}</h3>
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
                                <div class="page-title">All Donors</div>
                            </div>

                        </div>
                    </div>
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
                                        <th>Last Donation Date</th>
                                        <th>Donation Date</th>
                                        <th>Next Donation Date</th>
                                        <th>Address</th>
                                        <th>Venue</th>
                                        <th>Venue Address</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($donors as $key => $item)
                                    @php

                                    // Convert dates safely
                                    $donors_last_donation_date = !empty($item->donors_last_donation_date) ? Carbon\Carbon::parse($item->donors_last_donation_date)->format('d M Y') : 'N/A';
                                    $donation_date = !empty($item->donation_date) ? Carbon\Carbon::parse($item->donation_date) : null;
                                    $next_donation_date = $donation_date ? $donation_date->copy()->addDays(90) : null;
                                    $formatted_next_donation_date = $next_donation_date ? $next_donation_date->format('d M Y') : 'N/A';

                                    // Check if next donation date is today
                                    $is_today = $next_donation_date && $next_donation_date->isToday();
                                    @endphp
                                    <tr>
                                        <td>{{ ++$key }}</td>
                                        <td>{{ $item->donors_name }}</td>
                                        <td>{{ $item->donors_mobile }}</td>
                                        <td>{{ $item->donors_age }}</td>
                                        <td>{{ $item->donors_blood_group }}</td>
                                        <td>{{ $donors_last_donation_date }}</td>
                                        <td>{{ $donation_date ? $donation_date->format('d M Y') : 'N/A' }}</td>
                                        <td class="{{ $is_today ? 'flash' : '' }}">
                                            {{ $formatted_next_donation_date }}
                                        </td>
                                        <td>{{ $item->donors_address }}</td>
                                        <td>{{ $item->vanue_name }}</td>
                                        <td>{{ $item->vanue_address }}</td>
                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-lg-12">
                <div class="card">
                    <div class="card-header">
                        <div class="row align-items-center">
                            <div class="col-sm-6">
                                <div class="page-title">All Members</div>
                            </div>

                        </div>
                    </div>
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
                                        <th>Last Donation Date</th>
                                        <th>Next Donation Date</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($members as $key => $item)
                                    @php

                                    // Parse the last donation date safely
                                    $members_last_donation_date = !empty($item->members_last_donation_date)
                                    ? Carbon\Carbon::parse($item->members_last_donation_date)
                                    : null;

                                    // Calculate next donation date
                                    $next_donation_date = $members_last_donation_date
                                    ? $members_last_donation_date->copy()->addDays(90)
                                    : null;

                                    // Format dates
                                    $formatted_last_donation_date = $members_last_donation_date
                                    ? $members_last_donation_date->format('d M Y')
                                    : 'N/A';

                                    $formatted_next_donation_date = $next_donation_date
                                    ? $next_donation_date->format('d M Y')
                                    : 'N/A';

                                    // Check if next donation date is today
                                    $is_today = $next_donation_date && $next_donation_date->isToday();
                                    @endphp
                                    <tr>
                                        <td>{{ ++$key }}</td>
                                        <td>{{ $item->members_name }}</td>
                                        <td>{{ $item->members_mobile }}</td>
                                        <td>{{ $item->members_age }}</td>
                                        <td>{{ $item->members_blood_group }}</td>
                                        <td>{{ $item->members_address }}</td>
                                        <td>{{ $formatted_last_donation_date }}</td>
                                        <td class="{{ $is_today ? 'flash' : '' }}">
                                            {{ $formatted_next_donation_date }}
                                        </td>
                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        @endrole
    </div>
</div>
<!-- index end -->
@endsection