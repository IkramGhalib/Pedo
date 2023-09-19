@extends('layouts.backend.index')
@section('content')
<div class="page-header">
  <ol class="breadcrumb">
    <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Dashboard</a></li>
    <li class="breadcrumb-item active">Group's Courses list</li>
  </ol>
  <!-- <h1 class="page-title">Categories</h1> -->
</div>




<div class="page-content">

<div class="panel">
  <div class="panel-heading">
    {{-- <div class="panel-title">
      <a href="{{ route('admin.categoryform') }}" class="btn btn-success btn-sm"><i class="icon wb-plus" aria-hidden="true"></i> Add Category</a>
    </div> --}}
  
  <div class="panel-actions">
  {{-- <form method="GET" action="{{ route('admin.categoryIndex') }}">
      <div class="input-group">
        <input type="text" class="form-control" name="search" placeholder="Search..." value="{{ Request::input('search') }}">
        <span class="input-group-btn">
          <button type="submit" class="btn btn-primary" data-toggle="tooltip" data-original-title="Search"><i class="icon wb-search" aria-hidden="true"></i></button>
          <a href="{{ route('admin.categoryIndex') }}" class="btn btn-danger" data-toggle="tooltip" data-original-title="Clear Search"><i class="icon wb-close" aria-hidden="true"></i></a>
        </span>
      </div>
  </form> --}}
  </div>
</div>
            
          
          
        <div class="panel-body">
          <table class="table table-hover table-striped w-full">
            <thead>
              <tr>
                <th>#</th>
                <th>Courses Name</th>
                <th>Price</th>
                <th>Actions</th>
                

              </tr>
            </thead>
            <tbody>
                @foreach ($courses as $key=>$course)
              <tr>
                <td>{{ $key+1 }}</td>
                <td>{{ $course->course_title}}</td>
                <td>{{ $course->price}}</td>
                
               
               
                <td>
                  <a href="{{ url('instructor-course-info/'.$course->id) }}" class="btn btn-xs btn-icon btn-success btn-round" data-toggle="tooltip" data-original-title="Edit" >
                    Edit Course
                  </a>

                  <a href="{{ url('admin/view-course-test/'.$course->id) }}" class="btn btn-xs btn-icon btn-primary btn-round" data-toggle="tooltip" data-original-title="Edit" >
                     Course Test
                  </a>

                 

                  {{-- <a href="{{ url('admin/delete-category/'.$category->id) }}" class="delete-record btn btn-xs btn-icon btn-inverse btn-round" data-toggle="tooltip" data-original-title="Delete" >
                    <i class="icon wb-trash" aria-hidden="true"></i>
                  </a> --}}
                </td>
                
              </tr>
              @endforeach
            </tbody>
          </table>
          
         
          <div class="float-right">
            {{-- {{ $course->appends(['search' => Request::input('search')])->links() }} --}}
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