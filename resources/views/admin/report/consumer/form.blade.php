@extends('layouts.backend.index')
@section('content')
<div class="page-header">
  <ol class="breadcrumb">
    <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Dashboard</a></li>
    <li class="breadcrumb-item"><a href="#">Report</a></li>
    <li class="breadcrumb-item active">Form</li>
  </ol>
  <!-- <h1 class="page-title">Add Category</h1> -->
</div>

<div class="page-content">

<div class="panel">
  <div class="panel-body">
    <form method="POST" action="{{route('admin.report.consumer.process')}}" id="categoryForm">
      {{ csrf_field() }}
      {{-- <input type="hidden" name="category_id" value="{{ $category->id }}"> --}}
      <div class="row">
        
      <div class="form-group col-md-4 ">
          <label class="form-control-label"> Report Type</label>
          <select name="report_type" class="form-control report_type"> 
              <option value="all"> All </option>
              <option value="active"> Active </option>
              <option value="de-active"> De-Active</option>
              <option value="consumer-info"> Consumer(Full Info)</option>
          </select>   
          @if ($errors->has('report_type'))
              <label class="error" for="report_type">{{ $errors->first('report_type') }}</label>
          @endif       
          
      </div>
      <div class="form-group col-md-3 refrence_section" style="display:none">
        <label class="form-control-label"> Refrence no</label>
        <input type="number" class="form-control" name="refrence_no">
        
        @if ($errors->has('refrence_no'))
            <label class="error" for="refrence_no">{{ $errors->first('refrence_no') }}</label>
        @endif
    </div>

     
      
    

      </div>
      <div class="form-group row">
        <div class="col-md-4">
          <button type="submit" class="btn btn-primary">Generate Report</button>
          {{-- <button type="reset" class="btn btn-default btn-outline">Reset</button> --}}
        </div>
      </div>
      
    </form>
  </div>
</div>

       
      <!-- End Panel Basic -->
</div>

@endsection

@section('javascript')
<script type="text/javascript">
    
      
     
$(document).ready(function(){
  
  $('.report_type').change(function(){
    if($(this).val()=='consumer-info')
    {
      console.log('1');
      $('.refrence_section').show();
    }
    else
    {
      $('.refrence_section').hide();
      console.log('2');

    }
  });
});

        // $("#categoryForm").validate({
        //     rules: {
        //         name: {
        //             required: true
        //         },
        //         icon_class: {
        //             required: true
        //         }
        //     },
        //     messages: {
        //         name: {
        //             required: 'The category name field is required.'
        //         },
        //         icon_class: {
        //             required: 'The icon class field is required.'
        //         }
        //     }
        // });
  
</script>
@endsection