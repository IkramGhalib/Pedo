@extends('layouts.backend.index')
@section('content')
<div class="page-header">
  <ol class="breadcrumb">
    <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Dashboard</a></li>
    <li class="breadcrumb-item"><a href="#">Charges</a></li>
    <li class="breadcrumb-item active"> Charges Types</li>
  </ol>
  <h1 class="page-title">Add </h1>
</div>


<div class="page-content">

    <div class="panel">
      <div class="panel-body">
        <form method="POST" action="{{ route('admin.charges.type.store') }}" id="userForm">
          {{ csrf_field() }}
          {{-- <input type="hidden" name="user_id" value="{{ $user->id }}"> --}}
          <div class="row">
          
            
          <div class="form-group col-md-4">
              <label class="form-control-label">Name / Title</label>
              <input required type="text" class="form-control" name="title"
                placeholder=""/>
                @if ($errors->has('title'))
                    <label class="error" for="title">{{ $errors->first('title') }}</label>
                @endif
            </div>

            <!-- <div class="form-group col-md-4">
              <label class="form-control-label">charges</label>
              <input required type="number" class="form-control" name="charges"
                placeholder=""/>
                @if ($errors->has('charges'))
                    <label class="error" for="charges">{{ $errors->first('charges') }}</label>
                @endif
            </div> -->
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

