@extends('backend.layouts.master')
@section('title','Study Material | Sattree Gurukul')
@section('body')
<div class="page-wrapper">
    <div class="content container-fluid">
        <div class="page-header">
            <div class="row">
                <div class="col-md-6">
                    <h3 class="page-title mb-0">Study Material</h3>
                </div>
                <div class="col-md-6">
                    <ul class="breadcrumb mb-0 p-0 float-right">
                        <li class="breadcrumb-item">
                            <a href="{{route('Admin-Dashboard')}}"><i class="fas fa-home"></i> Home</a>
                        </li>
                        <li class="breadcrumb-item"><span>Study Material</span></li>
                    </ul>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-sm-4 col-12"></div>
            <div class="col-sm-8 col-12 text-right add-btn-col">
                <a href="{{route('studymaterials.create')}}" class="btn btn-primary btn-rounded float-right"><i class="fas fa-plus"></i> Add Study Material</a>
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
                                        <th>Category</th>
                                        <th>Sub Category</th>
                                        <th>Course</th>
                                        <th>Type</th>
                                        <th>Title</th>
                                        <th>Subject</th>
                                        <th>Total Chapters</th>
                                        <th class="text-right">Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($studymaterials as $key => $item)
                                    @php
                                    $category = App\Models\Backend\Category::where('id',$item->course_category)->first();
                                    $subcategory = App\Models\Backend\Subcategory::where('id',$item->course_subcategory)->first();
                                    $course = App\Models\Backend\Course::where('id',$item->course)->first();
                                    $type = App\Models\Teacher\Studymaterialtype::where('id',$item->type)->first();
                                    @endphp
                                    <tr>
                                        <td>{{++$key}}</td>
                                        <td>{{$category->category_name}}</td>
                                        <td>{{$subcategory->subcategory_name}}</td>
                                        <td>{{$course->course_name}}</td>
                                        <td>{{$type->type}}</td>
                                        <td>{{$item->title}}</td>
                                        <td>{{$item->subject}}</td>
                                        <td>{{$item->total_chapters}}</td>
                                        <td class="text-right">
                                            <div class="dropdown dropdown-action">
                                                <a href="#" class="action-icon dropdown-toggle" data-toggle="dropdown" aria-expanded="false"><i class="fas fa-ellipsis-v"></i></a>
                                                <div class="dropdown-menu dropdown-menu-right">
                                                    <a class="dropdown-item" href="{{route('studymaterials.edit',$item->id)}}"><i class="fas fa-pencil-alt m-r-5"></i> Edit</a>
                                                    <form action="{{ route('studymaterials.destroy', $item->id) }}" method="POST" class="d-inline">
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
@endsection