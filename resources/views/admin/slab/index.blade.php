@extends('layouts.backend.index')
@section('content')
<div class="page-header">
  <ol class="breadcrumb">
    <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Dashboard</a></li>
    <li class="breadcrumb-item active">Consumer </li>
    <li class="breadcrumb-item active">Slab </li>
  </ol>
  <h1 class="page-title">  List</h1>
</div>

<div class="page-content">

<div class="panel">
        <div class="panel-heading">
            <div class="panel-title">
              <a href="{{ route('admin.slab.form') }}" class="btn btn-success btn-sm"><i class="icon wb-plus" aria-hidden="true"></i> Add </a>
            </div>
          
          <div class="panel-actions">
          <form method="GET" action="{{ route('admin.slab.list') }}">
              <div class="input-group">
                <input type="text" class="form-control" name="search" placeholder="Search..." value="{{ Request::input('search') }}">
                <span class="input-group-btn">
                  <button type="submit" class="btn btn-primary" data-toggle="tooltip" data-original-title="Search"><i class="icon wb-search" aria-hidden="true"></i></button>
                  <a href="{{ route('admin.slab.list') }}" class="btn btn-danger" data-toggle="tooltip" data-original-title="Clear Search"><i class="icon wb-close" aria-hidden="true"></i></a>
                </span>
              </div>
          </form>
          </div>
        </div>
        
        <div class="panel-body">
          <div class="table-responsive">
          <table class="table table-hover table-striped w-full">
            <thead>
              <tr>
                <th>#</th>
                <th>Type</th>
                <th>Sub Type</th>
                <th>Unit Start From</th>
                <th>Unit Start End </th>
                <th>Price/Unit</th>
                <th> Status</th>
                <th>Actions</th>
              </tr>
            </thead>
            <tbody>
              @foreach($list as $key=>$row)
              <tr>
                <td>{{ $key+1 }}</td>
                 <!-- <td>{{-- $test->user->first_name --}}</td>  -->
                <!-- <td>{{-- $test->course->course_title --}}</td> -->
                <td>{{$row->sub_category->consumerCategory->name}}</td>
                <td>{{$row->sub_category->name}}</td>
                <td>{{$row->slab_start_unit}}</td>
                <td>{{$row->slab_end_unit}}</td>
                <td>{{$row->charges}}</td>
                <td>
                  @if($row->is_active)
                  <span class="badge badge-success">Active</span>
                  @else
                  <span class="badge badge-danger">Inactive</span>
                  @endif
                </td>
                <td>
                  <a href="{{ route('admin.slab.edit',$row->id) }}" class="btn btn-sm btn-icon btn-inverse btn-round" title="Edit">
                    <i class="icon wb-pencil" aria-hidden="true"></i>
                  </a>
                  
                </td>
              </tr>

              @endforeach
            </tbody>
          </table>
          </div>
          
          <div class="float-right">
            {{ $list->appends(['search' => Request::input('search')])->links() }}
          </div>
          
          
        </div>
      </div>
      <!-- End Panel Basic -->
</div>

@endsection

@section('javascript')
<script type="text/javascript">
    $(document).ready(function()
    { 
        
    });
</script>
@endsection