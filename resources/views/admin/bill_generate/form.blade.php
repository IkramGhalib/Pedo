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
        <form method="POST" class="from_submission" action="{{ route('bill.generate.save') }}" id="form" enctype="multipart/form-data">
          {{ csrf_field() }}
          {{-- <input type="hidden" name="user_id" value="{{ $user->id }}"> --}}
     
          <div class="row">
          @if($last_date)
          @php
          $new_date=date('Y-m',strtotime($last_date->month_year.'+1 month'));

          @endphp
          @else
               @php
                $new_date=null;
                @endphp
          @endif

            <div class="form-group col-md-4">
              <label class="form-control-label"> Month-Year</label>
              <input required type="month" class="form-control" name="month_year" min="@if($new_date){{$new_date}}@endif" max="@if($new_date){{$new_date}}@endif"  value="@if($new_date){{$new_date}}@endif"
                />
                @if ($errors->has('month_year'))
                    <label class="error" for="full_name">{{ $errors->first('month_year') }}</label>
                @endif
            </div>

            <div class="form-group col-md-4">
              <label class="form-control-label"> Due Date</label>
              <div class="input-group " data-provide="datepicker">
              <input required type="text" class="form-control date" name="due_date" value="@if(old('due_date')){{date('Y-m-d',strtotime(old('due_date')))}}@else{{date('Y-m-d')}}@endif "
                />
                <div class="input-group-addon">
                <span class="fa fa-calendar"></span>
                </div>
                @if ($errors->has('due_date'))
                    <label class="error" for="due_date">{{ $errors->first('due_date') }}</label>
                @endif
              </div>
            </div>



          </div>

          <!-- <hr> -->
          <div class="form-group row">
            <div class="col-md-4">
              <button type="submit" class="btn btn-primary show-confirmation-form">Generate</button>
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


