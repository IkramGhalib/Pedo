@extends('layouts.backend.index')
@section('content')
<div class="page-header">
  <ol class="breadcrumb">
    <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Dashboard</a></li>
    <li class="breadcrumb-item active">Test Lists</li>
  </ol>
  <h1 class="page-title">Test Lists</h1>
</div>

<div class="page-content">

<div class="panel">
        <div class="panel-heading">
            <div class="panel-title">
              <a href="{{ route('admin.test') }}" class="btn btn-success btn-sm"><i class="icon wb-plus" aria-hidden="true"></i> Add Test</a>
            </div>
          
          <div class="panel-actions">
          <form method="GET" action="{{ route('admin.test.list') }}">
              <div class="input-group">
                <input type="text" class="form-control" name="search" placeholder="Search..." value="{{ Request::input('search') }}">
                <span class="input-group-btn">
                  <button type="submit" class="btn btn-primary" data-toggle="tooltip" data-original-title="Search"><i class="icon wb-search" aria-hidden="true"></i></button>
                  <a href="{{ route('admin.test.list') }}" class="btn btn-danger" data-toggle="tooltip" data-original-title="Clear Search"><i class="icon wb-close" aria-hidden="true"></i></a>
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
                <th>Sl.no</th>
                <!-- <th>Name</th> -->
                <th>Course Name</th>
                <th>Test Title</th>
                <th>Start Date</th>
                <th>Start End</th>
                <th>Time Start</th>
                <th>Time End</th>
                <th> Status</th>
                <th>Actions</th>
              </tr>
            </thead>
            <tbody>
              @foreach($tests as $key=>$test)
              <tr>
                <td>{{ $key+1 }}</td>
                 <!-- <td>{{-- $test->user->first_name --}}</td>  -->
                <!-- <td>{{-- $test->course->course_title --}}</td> -->
                <td>{{$test->course_title}}</td>
                <td>{{ $test->test_title }}</td>
                <td>{{ $test->test_start }}</td>
                <td>{{ $test->test_end }}</td>
                <td>{{ $test->time_start }}</td>
                <td>{{ $test->time_end }}</td>
                {{-- <td>{{ $tests->test_title }}</td> --}}
               
                <td>
                  @if($test->status)
                  <span class="badge badge-success">Active</span>
                  @else
                  <span class="badge badge-danger">Inactive</span>
                  @endif
                </td>
                <td>
                  <a href="{{ route('admin.test.edit',$test->id) }}" class="btn btn-xs btn-icon btn-inverse btn-round" data-toggle="tooltip" data-original-title="Edit">
                    <i class="icon wb-pencil" aria-hidden="true"></i>
                  </a>
                  <a href="{{ route('admin.test.delete',$test->id) }}" class="btn btn-xs btn-icon btn-inverse btn-round" data-toggle="tooltip" data-original-title="Delete">
                    <i class="icon wb-trash" aria-hidden="true"></i>
                  </a>
                </td>
              </tr>

              @endforeach
            </tbody>
          </table>
          </div>
          
          <div class="float-right">
            {{ $tests->appends(['search' => Request::input('search')])->links() }}
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