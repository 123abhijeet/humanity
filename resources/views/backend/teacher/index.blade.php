@extends('backend.layouts.master')
@section('title','Teacher | Sattree Gurukul')
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
                    <h3 class="page-title mb-0">Teacher</h3>
                </div>
                <div class="col-md-6">
                    <ul class="breadcrumb mb-0 p-0 float-right">
                        <li class="breadcrumb-item">
                            <a href="{{route('Admin-Dashboard')}}"><i class="fas fa-home"></i> Home</a>
                        </li>
                        <li class="breadcrumb-item"><span>Teacher</span></li>
                    </ul>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-sm-4 col-12"></div>
            <div class="col-sm-8 col-12 text-right add-btn-col">
                <a href="{{route('teachers.create')}}" class="btn btn-primary btn-rounded float-right"><i class="fas fa-plus"></i> Add Teacher</a>
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
                                        <th>Name</th>
                                        <th>Email</th>
                                        <th>Mobile</th>
                                        <th>Address</th>
                                        <th>Status</th>
                                        <th class="text-right">Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($teacher as $key=>$item)
                                    @php
                                    $user_status = App\Models\User::where('email',$item->email)->first();
                                    @endphp
                                    <tr>
                                        <td>{{++$key}}</td>
                                        <td>{{$item->name}}</td>
                                        <td>{{$item->email}}</td>
                                        <td>{{$item->mobile}}</td>
                                        <td>{{$item->address}}</td>
                                        <td><label class="switch">
                                                <input type="checkbox" class="status-toggle" data-user-id="{{ $user_status->id }}" {{ $user_status->status ? 'checked' : '' }}>
                                                <span class="slider round"></span>
                                            </label></td>
                                        <td class="text-right">
                                            <div class="dropdown dropdown-action">
                                                <a href="#" class="action-icon dropdown-toggle" data-toggle="dropdown" aria-expanded="false"><i class="fas fa-ellipsis-v"></i></a>
                                                <div class="dropdown-menu dropdown-menu-right">
                                                    <a class="dropdown-item" href="{{route('teachers.edit',$item->id)}}"><i class="fas fa-pencil-alt m-r-5"></i> Edit</a>
                                                    <a class="dropdown-item" href="{{route('teachers.show',$item->id)}}"><i class="fas fa-eye m-r-5"></i> View</a>
                                                    <form action="{{ route('teachers.destroy', $item->id) }}" method="POST" class="d-inline">
                                                        @csrf
                                                        @method('delete')
                                                        <button type="submit" class="dropdown-item"><i class="fas fa-trash-alt m-r-5"></i> Delete</button>
                                                    </form>
                                                </div>
                                            </div>
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
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>

<script>
    $(document).ready(function() {
        $('.status-toggle').click(function() {
            var userId = $(this).data('user-id');
            var status = $(this).prop('checked') ? 1 : 0;

            $.ajax({
                url: '/update-teacher-status',
                type: 'POST',
                data: {
                    userId: userId,
                    status: status,
                    _token: '{{ csrf_token() }}'
                },
                success: function(response) {
                    successMsg(response.message);
                },
                error: function(xhr, status, error) {
                    console.error(xhr.responseText);
                }
            });
        });
    });
</script>
@endsection