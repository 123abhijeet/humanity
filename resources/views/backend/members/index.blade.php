@extends('backend.layouts.master')
@section('title','Members | Humanity')
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
					<h3 class="page-title mb-0">Members</h3>
				</div>
				<div class="col-md-6">
					<ul class="breadcrumb mb-0 p-0 float-right">
						<li class="breadcrumb-item">
							<a href="{{route('Admin-Dashboard')}}"><i class="fas fa-home"></i> Home</a>
						</li>
						<li class="breadcrumb-item"><span>Members</span></li>
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
										<td data-toggle="modal" data-target="#UpdateLastDateModal{{ $item->id }}">{{ $formatted_last_donation_date }}</td>
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
	</div>
</div>

<!-- Update Members Last Donation Date Modal Start -->
@foreach($members as $item)
<div class="modal fade" id="UpdateLastDateModal{{ $item->id }}" tabindex="-1" aria-labelledby="UpdateLastDateModalLabel{{ $item->id }}" aria-hidden="true">
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-header">
				<h5 class="modal-title" id="UpdateLastDateModalLabel{{ $item->id }}">आखरी रक्तदान - {{ $item->members_name }}</h5>
			</div>
			<form method="post" action="{{ route('Update-Last-Donation-Date') }}">
				@csrf
				<input type="hidden" name="member_id" value="{{ $item->id }}" /> <!-- Store member ID -->
				<div class="modal-body">
					<label>आखरी रक्तदान की तिथि <span class="text-danger">*</span></label>
					<input type="date" name="members_last_donation_date" class="form-control" value="{{ $item->members_last_donation_date }}" required />
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
<!-- Update Members Last Donation Date Modal End -->

@endsection