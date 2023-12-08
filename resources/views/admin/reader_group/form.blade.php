@extends('layouts.backend.index')
@section('content')
<div class="page-header">
  <ol class="breadcrumb">
    <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Dashboard</a></li>
    <li class="breadcrumb-item"><a href="#">Reading</a></li>
    <li class="breadcrumb-item active">Meter Reader Group </li>
  </ol>
  <!-- <h1 class="page-title">Add </h1> -->
</div>


<div class="page-content">

    <div class="panel">
      <div class="panel-body">
        <form method="POST"  action="{{ route('reader.group.save') }}" id="form" enctype="multipart/form-data">
          {{ csrf_field() }}
          <input type="hidden" name="record_id" value="{{ $user->id }}">
     
          <div class="row">
          
            <div class="form-group col-md-4">
              <label class="form-control-label"> User</label>
              <div class="input-group " >
                <select class="form-control" name="user">
                    @foreach ($list as $u)
                      <option value="{{$u->id}}" @if($u->id==$user->user_id) {{'selected'}} @endif> {{$u->first_name}} </option>  
                    @endforeach
                </select>
               
                @if ($errors->has('user'))
                    <label class="error" for="user">{{ $errors->first('user') }}</label>
                @endif
              </div>
            </div>


            <div class="form-group col-md-4">
              <label class="form-control-label"> Ref Start</label>
              <div class="input-group " data-provide="datepicker">
              <input required type="number" class="form-control" name="ref_start" value="{{ $user->ref_start }}"
                />
               
                @if ($errors->has('ref_start'))
                    <label class="error" for="ref_start">{{ $errors->first('ref_start') }}</label>
                @endif
              </div>
            </div>

            <div class="form-group col-md-4">
              <label class="form-control-label"> Ref End</label>
              <div class="input-group " >
                <input required type="number" class="form-control" name="ref_end" value="{{ $user->ref_end }}"
                />
                
                @if ($errors->has('ref_end'))
                    <label class="error" for="ref_end">{{ $errors->first('ref_end') }}</label>
                @endif
              </div>
            </div>
          </div>

          <!-- <hr> -->
          <div class="form-group row">
            <div class="col-md-4">
              <button type="submit" class="btn btn-primary ">Generate</button>
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


