@extends('layouts.backend.index')
@section('content')
<div class="page-header">
  <ol class="breadcrumb">
    <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Dashboard</a></li>
    <li class="breadcrumb-item active">Result Lists</li>
  </ol>
  <h1 class="page-title">Result Lists</h1>
</div>

<div class="page-content">

<div class="panel">
        <div class="panel-heading">
            {{-- <div class="panel-title">
              <a href="{{ route('admin.question') }}" class="btn btn-success btn-sm"><i class="icon wb-plus" aria-hidden="true"></i> Add Question</a>
            </div> --}}
          
          <div class="panel-actions">
          {{-- <form method="GET" action="{{ route('admin.question.list') }}">
              <div class="input-group">
                <input type="text" class="form-control" name="search" placeholder="Search..." value="{{ Request::input('search') }}">
                <span class="input-group-btn">
                  <button type="submit" class="btn btn-primary" data-toggle="tooltip" data-original-title="Search"><i class="icon wb-search" aria-hidden="true"></i></button>
                  <a href="{{ route('admin.question.list') }}" class="btn btn-danger" data-toggle="tooltip" data-original-title="Clear Search"><i class="icon wb-close" aria-hidden="true"></i></a>
                </span>
              </div>
          </form> --}}
          </div>
        </div>
        
        <div class="panel-body">
          <div class="table-responsive">
          <table class="table table-hover table-striped w-full">
            <thead>
              <tr>
                <th>Sl.no</th>
                <th>Group Name</th>
                <th>Test Name</th>
                <th>Wrong</th>
                <th>Correct</th>
                <th>Obtain Marks</th>
                <th>Percentage</th>
                <th>Total</th>
                <th>Actions</th>
              </tr>
            </thead>
            <tbody>
             
            </tbody>
          </table>
          </div>
          
          <div class="float-right">
            {{-- {{ $questions->appends(['search' => Request::input('search')])->links() }} --}}
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