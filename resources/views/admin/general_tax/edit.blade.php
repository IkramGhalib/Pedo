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
        <form method="POST" action="{{ route('admin.general-tax.update',$record->id) }}" id="userForm">
          {{ csrf_field() }}
         
          <div class="row">

          <div class="form-group col-md-4">
              <label class="form-control-label">Tax Name</label>
              <input required type="text" value="{{ $record->tax_name }}" class="form-control" name="tax_name"
                placeholder=""/>
                @if ($errors->has('tax_name'))
                    <label class="error" for="tax_name">{{ $errors->first('tax_name') }}</label>
                @endif
            </div>
          
            <div class="form-group col-md-4">
              <label class="form-control-label">Tax Percentage</label>
              <input required type="text" value="{{ $record->tax_percentage }}" class="form-control" name="tax_percentage"
                placeholder=""/>
                @if ($errors->has('tax_percent'))
                    <label class="error" for="tax_percent">{{ $errors->first('tax_percent') }}</label>
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

