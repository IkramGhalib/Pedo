@extends('layouts.backend.index')
@section('content')
<div class="page-header">
  <ol class="breadcrumb">
    <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Dashboard</a></li>
    <!-- <li class="breadcrumb-item"><a href="{{ route('admin.users') }}">Area</a></li> -->
    <li class="breadcrumb-item active">Tax</li>
  </ol>
  <h1 class="page-title">Edit</h1>
</div>


<div class="page-content">

    <div class="panel">
      <div class="panel-body">
        <form method="POST" action="{{ route('admin.charges.update',$record->id) }}" id="userForm">
          {{ csrf_field() }}
         
          <div class="row">

            <div class="form-group col-md-3">
              <label class="form-control-label">Charges Type</label>
              <select name="charges_type" id="charges_type" class="form-control">
                    <option value="">-- Type --</option>
                    @foreach($charges as $c => $row)
                    <option value="{{$row->id}}" @if($row->id==$record->charges_type_id) {{'selected'}} @endif>{{$row->title}}</option>
                    @endforeach
                  </select>
                @if ($errors->has('charges_type'))
                    <label class="error" for="charges_type">{{ $errors->first('charges_type') }}</label>
                @endif
            </div>


            <div class="form-group col-md-3">
              <label class="form-control-label">Consumer  Type</label>
              <select name="consumer_type" id="consumer_type" class="form-control">
                    <option value="">-- Type --</option>
                    @foreach($types as $t => $tr)
                    <option value="{{$tr->id}}" @if($tr->id==$record->sub_cat_id) {{'selected'}} @endif>{{$tr->name}}</option>
                    @endforeach
                  </select>
                @if ($errors->has('consumer_type'))
                    <label class="error" for="consumer_type">{{ $errors->first('consumer_type') }}</label>
                @endif
            </div>

          
            <div class="form-group col-md-2">
              <label class="form-control-label">charges</label>
              <input required type="text" value="{{ $record->charges }}" class="form-control" name="charges"
                placeholder=""/>
                @if ($errors->has('charges'))
                    <label class="error" for="charges">{{ $errors->first('charges') }}</label>
                @endif
            </div>

            <div class="form-group col-md-2">
              <label class="form-control-label">Applicable on</label>
              <select name="applicable" class="form-control"> 
                <option value="units" @if($record->applicable_on=='units') {{'selected'}}@endif> Units</option>
                <option value="charges" @if($record->applicable_on=='charges') {{'selected'}}@endif> Charges</option>
              </select>
                @if ($errors->has('applicable'))
                    <label class="error" for="applicable">{{ $errors->first('applicable') }}</label>
                @endif
            </div>


           

          <div class="form-group col-md-3">
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

