@extends('backend.layouts.master')
@section('title','Donors | Humanity')
@section('body')
<style>
    .dataTables_scrollBody {
        position: inherit !important;
        overflow: auto !important;
        width: 100% !important;
    }

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
                            <div class="table-responsiveness">
                                <table class="table custom-table DataTable" style="width: 100%;">
                                    <thead class="thead-light">
                                        <tr>
                                            <th>#</th>
                                            <th>Registration No</th>
                                            <th>Name</th>
                                            <th>Mobile</th>
                                            <th>Age</th>
                                            <th>Blood Group</th>
                                            <th>Last Donation Date</th>
                                            <th class="text-danger">Donation Date</th>
                                            <th>Next Donation Date</th>
                                            <th>Address</th>
                                            <th>Venue</th>
                                            <th>Venue Address</th>
                                            <!-- <th>Action</th> -->
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
                                            <td>{{ $item->registration_no }}</td>
                                            <td>{{ $item->donors_name }}</td>
                                            <td>{{ $item->donors_mobile }}</td>
                                            <td>{{ $item->donors_age }}</td>
                                            <td>{{ $item->donors_blood_group }}</td>
                                            <td>{{ $donors_last_donation_date }}</td>
                                            <td data-toggle="modal" data-target="#UpdateDonorsLastDateModal{{ $item->id }}">{{ $donation_date ? $donation_date->format('d M Y') : 'N/A' }}</td>
                                            <td class="{{ $is_today ? 'flash' : '' }}">
                                                {{ $formatted_next_donation_date }}
                                            </td>
                                            <td>{{ $item->donors_address }}</td>
                                            <td>{{ $item->vanue_name }}</td>
                                            <td>{{ $item->vanue_address }}</td>
                                            <!-- <td><a href=""><i class="fa fa-pencil-alt"></i></a></td> -->
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
</div>

<!-- Update Donors Last Donation Date Modal Start -->
@foreach($donors as $item)
<div class="modal fade" id="UpdateDonorsLastDateModal{{ $item->id }}" tabindex="-1" aria-labelledby="UpdateDonorsLastDateModalLabel{{ $item->id }}" aria-hidden="true">
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-header">
				<h5 class="modal-title" id="UpdateDonorsLastDateModalLabel{{ $item->id }}">आखरी रक्तदान - {{ $item->donors_name }}</h5>
			</div>
			<form method="post" action="{{ route('Update-Last-Donation-Date-Donor') }}">
				@csrf
				<input type="hidden" name="donor_id" value="{{ $item->id }}" /> <!-- Store member ID -->
				<div class="modal-body">
					<label>आखरी रक्तदान की तिथि <span class="text-danger">*</span></label>
					<input type="date" name="donors_last_donation_date" class="form-control" value="{{ $item->donation_date }}" required />
				</div>
				<div class="modal-footer">
					<button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
					<button type="submit" class="btn btn-primary">Update</button>
				</div>
			</form>
		</div>
	</div>
</div>
@endforeach
<!-- Update Donors Last Donation Date Modal End -->

@endsection