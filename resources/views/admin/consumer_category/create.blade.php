@extends('layouts.backend.index')
@section('content')
<div class="page-header">
  <ol class="breadcrumb">
    <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Dashboard</a></li>
    <li class="breadcrumb-item"><a href="#">Cosumser</a></li>
    <li class="breadcrumb-item active">Type</li>
  </ol>
  <h1 class="page-title">Add </h1>
</div>


<div class="page-content">

    <div class="panel">
      <div class="panel-body">
        <form method="POST" action="{{ route('admin.ccategory.store') }}" id="userForm">
          {{ csrf_field() }}
          {{-- <input type="hidden" name="user_id" value="{{ $user->id }}"> --}}
          <div class="row">
          
            
          
            <div class="form-group col-md-4">
              <label class="form-control-label">Name</label>
              <input required type="text" class="form-control" name="name"
                placeholder=""/>
                @if ($errors->has('name'))
                    <label class="error" for="test_title">{{ $errors->first('name') }}</label>
                @endif
            </div>

            <div class="form-group col-md-2">
              <label class="form-control-label">Tarrif Code</label>
              <input required type="text" class="form-control" name="tarrif_code"
                placeholder=""/>
                @if ($errors->has('tarrif_code'))
                    <label class="error" for="tarrif_code">{{ $errors->first('tarrif_code') }}</label>
                @endif
            </div>


          <div class="form-group col-md-4">
            <label class="form-control-label">Status</label>
            <div>
              <div class="radio-custom radio-default radio-inline">
                <input type="radio" id="inputBasicActive" name="status" value="1" checked  />
                <label for="inputBasicActive">Active</label>
              </div>
              <div class="radio-custom radio-default radio-inline">
                <input type="radio" id="inputBasicInactive" name="status" value="0" />
                <label for="inputBasicInactive">De-Active</label>
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

