@extends('layouts.backend.index')
@section('content')
<div class="page-header">
  <ol class="breadcrumb">
    <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Dashboard</a></li>
    <!-- <li class="breadcrumb-item"><a href="{{ route('admin.users') }}">Area</a></li> -->
    <li class="breadcrumb-item active">General Tax</li>
  </ol>
  <h1 class="page-title">Edit</h1>
</div>


<div class="page-content">

    <div class="panel">
      <div class="panel-body">
        <form method="POST" action="{{ route('admin.meter.update',$record->meter_id) }}" id="userForm">
          {{ csrf_field() }}
         
          <div class="row">
          
            <div class="form-group col-md-4">
              <label class="form-control-label">Meter No</label>
              <input required type="text" value="{{ $record->meter_no }}" class="form-control" name="meter_no"
                placeholder=""/>
                @if ($errors->has('meter_no'))
                    <label class="error" for="meter_no">{{ $errors->first('meter_no') }}</label>
                @endif
            </div>


           

          <div class="form-group col-md-4">
            <label class="form-control-label">Status</label>
            <div>
              <div class="radio-custom radio-default radio-inline">
                <input  type="radio" id="inputBasicActive" name="status"  value="free" @if($record->status=="free") checked @endif  />
                <label for="inputBasicActive">Active</label>
              </div>
              <div class="radio-custom radio-default radio-inline">
                <input  type="radio" id="inputBasicInactive" name="status" value="assigned" @if($record->status=='assigned') checked @endif />
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

