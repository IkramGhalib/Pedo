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
    <form method="POST" action="{{route('admin.report.bill.process')}}" id="categoryForm">
      {{ csrf_field() }}
      {{-- <input type="hidden" name="category_id" value="{{ $category->id }}"> --}}
      <div class="row">
        <div class="form-group col-md-3 ">
          <label class="form-control-label">Month/Year <span class="text-danger"> *</span></label>
          <input type="month" class="form-control" name="month">
          
          @if ($errors->has('month'))
              <label class="error" for="group">{{ $errors->first('month') }}</label>
          @endif
      </div>
      <div class="form-group col-md-3 ">
          <label class="form-control-label"> Condition</label>
          <select name="condition" class="form-control"> 
              <option value="all"> List of Bills </option>
              <option value="design"> Print Bill With Design </option>
              <option value="without-design"> Print Bill With out Design </option>
              <option value="bill-summary"> Bill Summary (Count)</option>
              <option value="bill-summary-list"> Bill Summary List </option>
              <option value="all-breakup"> Bills (with All Breakup) </option>
              <!-- <option value="="> Equal </option> -->

          </select>   
          @if ($errors->has('condition'))
              <label class="error" for="condition">{{ $errors->first('condition') }}</label>
          @endif       
          
      </div>


      <div class="form-group col-md-3 ">
          <label class="form-control-label"> Refrence Start</label>
          <input type="number" class="form-control" name="start_refrence">
          
          @if ($errors->has('start_refrence'))
              <label class="error" for="start_refrence">{{ $errors->first('start_refrence') }}</label>
          @endif
      </div>

      <div class="form-group col-md-3 ">
          <label class="form-control-label"> Refer End</label>
          <input type="number" class="form-control" name="end_refrence">
          
          @if ($errors->has('end_refrence'))
              <label class="error" for="end_refrence">{{ $errors->first('end_refrence') }}</label>
          @endif
      </div>
      
    

      </div>
      <hr>
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
    $(document).ready(function()
    { 
      function add_row()
      {
        var subject_row=`<div class="row row-1 mb-1">
              

        

               

                  


          </div>`;
          $('.subject_append_row').append(subject_row);
      }

      add_row()
      $(document).on('click','.add_button',function(){
        add_row();
        
      });
      $(document).on('click','.remove_button',function(){
        if($('.row-1').length>1)
        $(this).closest('.row').remove();
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
    });
</script>
@endsection