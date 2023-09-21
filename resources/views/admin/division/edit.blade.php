@extends('layouts.backend.index')
@section('content')
<div class="page-header">
  <ol class="breadcrumb">
    <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Dashboard</a></li>
    <li class="breadcrumb-item"><a href="{{ route('admin.users') }}">Area</a></li>
    <li class="breadcrumb-item active">Division</li>
  </ol>
  <h1 class="page-title">Edit</h1>
</div>


<div class="page-content">

    <div class="panel">
      <div class="panel-body">
        <form method="POST" action="{{ route('admin.division.update',$record->id) }}" id="userForm">
          {{ csrf_field() }}
         
          <div class="row">
          
            <div class="form-group col-md-4">
              <label class="form-control-label">Code</label>
              <input required type="text" value="{{ $record->division_code }}" class="form-control" name="division_code"
                placeholder=""/>
                @if ($errors->has('division_code'))
                    <label class="error" for="division_code">{{ $errors->first('division_code') }}</label>
                @endif
            </div>


            <div class="form-group col-md-4">
              <label class="form-control-label">Name</label>
              <input required type="text" value="{{ $record->name }}" class="form-control" name="name"
                placeholder=""/>
                @if ($errors->has('name'))
                    <label class="error" for="name">{{ $errors->first('name') }}</label>
                @endif
            </div>

          <div class="form-group col-md-4">
            <label class="form-control-label">Status</label>
            <div>
              <div class="radio-custom radio-default radio-inline">
                <input  type="radio" id="inputBasicActive" name="status"  value="1" @if($record->is_active==1) checked @endif  />
                <label for="inputBasicActive">Active</label>
              </div>
              <div class="radio-custom radio-default radio-inline">
                <input  type="radio" id="inputBasicInactive" name="status" value="0" @if($record->is_active==0) checked @endif />
                <label for="inputBasicInactive">Inactive</label>
              </div>
            </div>
          </div>


          


         
    
          
          
         
          </div>
         
          <div class="form-group row">
            <div class="col-md-4">
              <button type="submit" class="btn btn-primary">Submit</button>
              <!-- <button type="reset" class="btn btn-default btn-outline">Reset</button> -->
            </div>
          </div>
          
        </form>
      </div>
    </div>
    
           
          <!-- End Panel Basic -->
    </div>



@endsection

