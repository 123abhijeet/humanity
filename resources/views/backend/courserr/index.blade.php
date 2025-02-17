@extends('backend.layouts.master')
@section('title','Course Review Rating | Sattree Gurukul')
@section('body')
<style>
    /* Hide default checkbox */
    .status-toggle {
        display: none;
    }

    /* Style the switch */
    .switch {
        position: relative;
        display: inline-block;
        width: 40px;
        height: 20px;
        margin-left: 30px;
    }

    /* Style the slider */
    .slider {
        position: absolute;
        cursor: pointer;
        top: 0;
        left: 0;
        right: 0;
        bottom: 0;
        background-color: #ccc;
        -webkit-transition: .4s;
        transition: .4s;
        border-radius: 34px;
    }

    /* Style the slider (before state) */
    .slider:before {
        position: absolute;
        content: "";
        height: 12px;
        width: 12px;
        left: 1px;
        bottom: 4px;
        background-color: white;
        -webkit-transition: .4s;
        transition: .4s;
        border-radius: 50%;
    }

    /* Toggle switch to checked state */
    input.status-toggle:checked+.slider {
        background-color: #2196F3;
    }

    /* Toggle switch to checked state (before state) */
    input.status-toggle:checked+.slider:before {
        -webkit-transform: translateX(26px);
        -ms-transform: translateX(26px);
        transform: translateX(26px);
    }

    /* Rounded sliders */
    .slider.round {
        border-radius: 34px;
    }

    .slider.round:before {
        border-radius: 50%;
    }
</style>
<div class="page-wrapper">
    <div class="content container-fluid">
        <div class="page-header">
            <div class="row">
                <div class="col-md-6">
                    <h3 class="page-title mb-0">Course Review Rating</h3>
                </div>
                <div class="col-md-6">
                    <ul class="breadcrumb mb-0 p-0 float-right">
                        <li class="breadcrumb-item">
                            <a href="{{route('Admin-Dashboard')}}"><i class="fas fa-home"></i> Home</a>
                        </li>
                        <li class="breadcrumb-item"><span>Course Review Rating</span></li>
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
                                        <th>Course</th>
                                        @role('Admin')
                                        <th>Teacher Name</th>
                                        @endrole
                                        <th>Student Name</th>
                                        <th>Rating</th>
                                        <th>Review</th>
                                        <th>Date</th>
                                        <th>Status</th>
                                        @role('Admin')
                                        <th>Update Status</th>
                                        @endrole
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($review_details as $key=>$item)
                                    @php
                                    $course = App\Models\Backend\Course::where('id',$item->course_id)->first();
                                    $student = App\Models\User::where('id',$item->student_id)->first();
                                    $instructor = App\Models\Backend\Teacher::where('user_id',$item->teacher_id)->first();
                                    $formatted_date = \Carbon\Carbon::parse($item->created_at)->format('d F Y');
                                    @endphp
                                    <tr>
                                        <td>{{++$key}}</td>
                                        <td>{{$course->course_name}}</td>
                                        @role('Admin')
                                        <td>{{$instructor->name}}</td>
                                        @endrole
                                        <td>{{$student->name}}</td>
                                        <td style="font-size: 20px;">@for ($i = 0; $i < $item->rating; $i++)
                                                *
                                                @endfor
                                        </td>
                                        <td>{{$item->review}}</td>
                                        <td>{{$formatted_date}}</td>
                                        <td>{{ $item->status == 0 ? 'Not Approved' : 'Approved' }}</td>
                                        @role('Admin')
                                        <td><label class="switch">
                                                <input type="checkbox" class="status-toggle" data-id="{{ $item->id }}" {{ $item->status ? 'checked' : '' }}>
                                                <span class="slider round"></span>
                                            </label>
                                        </td>
                                        @endrole
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
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>

<script>
    $(document).ready(function() {
        $('.status-toggle').click(function() {
            var Id = $(this).data('id');
            var status = $(this).prop('checked') ? 1 : 0;

            $.ajax({
                url: '/update-courserr-status',
                type: 'POST',
                data: {
                    Id: Id,
                    status: status,
                    _token: '{{ csrf_token() }}'
                },
                success: function(response) {
                    successMsg(response.message);
                    location.reload();
                },
                error: function(xhr, status, error) {
                    console.error(xhr.responseText);
                }
            });
        });
    });
</script>
@endsection