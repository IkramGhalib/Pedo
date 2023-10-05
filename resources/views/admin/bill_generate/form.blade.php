@extends('layouts.backend.index')
@section('content')
<div class="page-header">
  <ol class="breadcrumb">
    <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Dashboard</a></li>
    <li class="breadcrumb-item"><a href="#">Generate Bill</a></li>
    <li class="breadcrumb-item active">Generate </li>
  </ol>
  <!-- <h1 class="page-title">Add </h1> -->
</div>


<div class="page-content">

    <div class="panel">
      <div class="panel-body">
        <form method="POST" action="{{ route('bill.generate.save') }}" id="userForm" enctype="multipart/form-data">
          {{ csrf_field() }}
          {{-- <input type="hidden" name="user_id" value="{{ $user->id }}"> --}}
     
          <div class="row">

            <div class="form-group col-md-4">
              <label class="form-control-label"> Month-Year</label>
              <input required type="month" class="form-control" name="month_year" value="{{old('month_year')}}"
                />
                @if ($errors->has('month_year'))
                    <label class="error" for="full_name">{{ $errors->first('month_year') }}</label>
                @endif
            </div>

            <div class="form-group col-md-4">
              <label class="form-control-label"> Due Date</label>
              <input required type="date" class="form-control" name="dute_date" value="{{old('dute_date')}}"
                />
                @if ($errors->has('dute_date'))
                    <label class="error" for="dute_date">{{ $errors->first('dute_date') }}</label>
                @endif
            </div>

          </div>

          <!-- <hr> -->
          <div class="form-group row">
            <div class="col-md-4">
              <button type="submit" class="btn btn-primary">Generate</button>
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


