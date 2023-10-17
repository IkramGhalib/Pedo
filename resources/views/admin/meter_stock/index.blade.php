@extends('layouts.backend.index')
@section('content')
<div class="page-header">
  <ol class="breadcrumb">
    <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Dashboard</a></li>
    <li class="breadcrumb-item active">Neter</li>
  </ol>
  <h1 class="page-title"> Meter</h1>
</div>

<div class="page-content">

<div class="panel">
        <div class="panel-heading">
            <div class="panel-title">
              <a href="{{ route('admin.meter.form') }}" class="btn btn-success btn-sm"><i class="icon wb-plus" aria-hidden="true"></i> Add </a>
            </div>
          
          <div class="panel-actions">
          <form method="GET" action="{{ route('admin.meter.list') }}">
              <div class="input-group">
                <input type="text" class="form-control" name="search" placeholder="Search..." value="{{ Request::input('search') }}">
                <span class="input-group-btn">
                  <button type="submit" class="btn btn-primary" data-toggle="tooltip" data-original-title="Search"><i class="icon wb-search" aria-hidden="true"></i></button>
                  <a href="{{ route('admin.meter.list') }}" class="btn btn-danger" data-toggle="tooltip" data-original-title="Clear Search"><i class="icon wb-close" aria-hidden="true"></i></a>
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
                <th>Meter No#</th>
                <th>Status</th>
                <th>Actions</th>
              </tr>
            </thead>
            <tbody>
              @foreach($list as $key=>$row)
              <tr>
                <td>{{ $key+1 }}</td>
                 <!-- <td>{{-- $test->user->first_name --}}</td>  -->
                <!-- <td>{{-- $test->course->course_title --}}</td> -->
                <td>{{$row->meter_no}}</td>
                
                <td>
                  @if($row->status=='free')
                  <span class="badge badge-success">Free</span>
                  @else
                  <span class="badge badge-danger">Assigned</span>
                  @endif
                </td>
                <td>
                  <a href="{{ route('admin.meter.edit',$row->meter_id) }}" class="btn btn-sm btn-icon btn-inverse btn-round" data-toggle="tooltip" data-original-title="Edit">
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