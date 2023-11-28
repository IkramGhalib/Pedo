@extends('layouts.backend.index')
@section('content')
<div class="page-header">
  <ol class="breadcrumb">
    <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Dashboard</a></li>
    <li class="breadcrumb-item"><a href="{{ route('consumer.form') }}">Consumer</a></li>
    <li class="breadcrumb-item active">import consumer</li>
  </ol>
  <!-- <h1 class="page-title">Add </h1> -->
</div>


<div class="page-content">
    <div class="panel">
      <div class="panel-body">
        <form method="POST" action="{{ route('consumer.import.form.process') }}" id="userForm" enctype="multipart/form-data">
          {{ csrf_field() }}
          <div class="row">
              <div class="form-group col-md-4">
                <label class="form-control-label">excel file</label>
                <input required  type="file" id="excel_file" class="form-control excel_file" name="excel_file"                  />
                @if ($errors->has('excel_file'))
                <label class="error" for="excel_file">{{ $errors->first('excel_file') }}</label>
                @endif
              </div>
        </div>
       
          <hr>
          <div class="form-group row">
            <div class="col-md-4">
              <button type="submit" class="btn btn-primary">Submit</button>
              <button type="reset" class="btn btn-default btn-outline">Reset</button>
            </div>
          </div>
          
        </form>
      </div>
    </div>
    
           
          <!-- End Panel Basic -->
    </div>
@endsection
@section('javascript')
@endsection


