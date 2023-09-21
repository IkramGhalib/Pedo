@extends('layouts.backend.index')
@section('content')
<div class="page-header">
  <ol class="breadcrumb">
    <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Dashboard</a></li>
    <li class="breadcrumb-item active">Consumer</li>
  </ol>
  <!-- <h1 class="page-title">Categories</h1> -->
</div>

<div class="page-content">

<div class="panel">
        <div class="panel-heading">
            <div class="panel-title">
              <a href="{{ route('consumer.form') }}" class="btn btn-success btn-sm"><i class="icon wb-plus" aria-hidden="true"></i> Add  </a>
            </div>
          
          <div class="panel-actions">
           <form method="GET" action="{{ route('consumer.lists') }}">
              <div class="input-group">
                <input type="text" class="form-control" name="search" placeholder="Search..." value="{{ Request::input('search') }}">
                <span class="input-group-btn">
                  <button type="submit" class="btn btn-primary" data-toggle="tooltip" data-original-title="Search"><i class="icon wb-search" aria-hidden="true"></i></button>
                  <a href="{{ route('consumer.lists') }}" class="btn btn-danger" data-toggle="tooltip" data-original-title="Clear Search"><i class="icon wb-close" aria-hidden="true"></i></a>
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
               
                <th>Consumer Code</th>
                <th>Name</th>
                <th>Father Name</th>
                <th>CNIC</th>
                <th>Contact</th>
                <th>Status</th>

                <th>Actions</th>
                

              </tr>
            </thead>
            <tbody>
              @foreach($instructors as $key=>$instructor)
              <tr>
                <td>{{ $key+1}}</td>
                <td>{{ $instructor->consumer_code}}</td>
                <td>{{ $instructor->full_name }} </td>
                <td>{{ $instructor->father_name }}</td>
                <td>{{ $instructor->cnic }}</td>
                <td>{{ $instructor->mobile }}</td>

                <td>
                  @if($instructor->status=="active")
                  <span class="badge badge-success">Active</span>
                  @else
                  <span class="badge badge-danger">Disable</span>
                  @endif
                </td>
                <td>
                  <a href="{{ url('consumer-form-edit/'.$instructor->id) }}" class="btn btn-xs btn-icon btn-inverse btn-round" data-toggle="tooltip" data-original-title="Edit" >
                    <i class="icon wb-pencil" aria-hidden="true"></i>
                  </a>

                  <a href="{{ url('consumer-disable/'.$instructor->id) }}" class="btn btn-xs btn-icon btn-inverse btn-round" data-toggle="tooltip"  >
                    <i class="fa fa-ban disabled-icon"></i>
                  </a>
                </td>
                {{-- <td>
                  <a style="background-color:rgb(73, 196, 73);color:white;text-decoration:none" href="{{ route('admin.view.courses',$category->id) }}" class="btn-xs btn-icon btn-inverse btn-round" data-toggle="tooltip" >
                    view courses</i>
                  </a>
                </td> --}}
              </tr>
              @endforeach
            </tbody>
          </table>
        </div>
          
          <div class="float-right">
            {{-- {{ $instructor->appends(['search' => Request::input('search')])->links() }} --}}
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