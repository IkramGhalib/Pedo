@extends('layouts.backend.index')
@section('content')
<!-- <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.1/css/select2.min.css" integrity="sha512-YHJ091iDoDM1PZZA9QLuBvpo0VXBBiGHsvdezDoc3p56S3SOMPRjX+zlCbfkOV5k3BmH5O9FqrkKxBRhkdtOkQ==" crossorigin="anonymous" referrerpolicy="no-referrer" /> -->
<div class="page-header">
  <ol class="breadcrumb">
    <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Dashboard</a></li>
    <li class="breadcrumb-item"><a href="{{ route('consumer.form') }}">Meter Reading</a></li>
    <li class="breadcrumb-item active">Add </li>
  </ol>
  <!-- <h1 class="page-title">Add </h1> -->
</div>


<div class="page-content">

    <div class="panel">
      <div class="panel-body">
        <form method="POST" action="{{ route('reading.save') }}" id="dataForm" enctype="multipart/form-data">
          {{ csrf_field() }}
          {{-- <input type="hidden" name="user_id" value="{{ $user->id }}"> --}}
       {{-- <div class="row">
            <div class="form-group col-md-8">
              <label class="form-control-label">Refrence No</label>
             <select name="ref_no" id="ref_no" class="form-control" required>
                    <option value="">-- Select --</option>
                  </select>
                @if ($errors->has('ref_no'))
                    <label class="error" for="ref_no">{{ $errors->first('ref_no') }}</label>
                @endif
                
                <input type="text" id="ref_no" name="ref_no" class="form-control ref_no">
            </div>
      </div>
      --}}
          <div class="row">

            <div class="form-group col-md-4">
              <label class="form-control-label"> Year-Month</label>
              <!-- <input required type="month" class="form-control month_year " name="month_year" value="{{old('month_year')}}"
                /> -->
              
                @if($last_date) 
                @php
                $new_date=date('Y-m',strtotime($last_date->month_year.'+1 month'));
                
                @endphp
                @else
               @php
                $new_date=null;
                @endphp
                @endif
                
                <input required type="month" class="form-control month_year " name="month_year"  min="@if($new_date){{$new_date}}@endif" max="@if($new_date){{$new_date}}@endif" value="@if($new_date){{$new_date}}@endif"
                />
               
                @if ($errors->has('month_year'))
                    <label class="error" for="full_name">{{ $errors->first('month_year') }}</label>
                @endif
            </div>

          </div>
          <div class="row">
          <div class="form-group col-md-2">
              <label class="form-control-label">Refrence No</label>
              {{--<select name="ref_no" id="ref_no" class="form-control" required>
                    <option value="">-- Select --</option>
                  </select>
                @if ($errors->has('ref_no'))
                    <label class="error" for="ref_no">{{ $errors->first('ref_no') }}</label>
                @endif
                --}}
                <input type="text" id="ref_no" name="ref_no" class="form-control ref_no">
            </div>

            <div class="form-group col-md-2">
                <label class="form-control-label">Current Reading</label>
                <input required type="text" class="form-control offpeak" name="offpeak" value="{{old('offpeak')}}"
                  />
                  @if ($errors->has('offpeak'))
                      <label class="error" for="offpeak">{{ $errors->first('offpeak') }}</label>
                  @endif
              </div>

              <div class="form-group col-md-2">
                <label class="form-control-label">Pre.Reading</label>
                <input readonly type="text" class="form-control pre_reading" name="pre_reading" value=""
                  />
                  
              </div>
             

              <div class="form-group col-md-2">
                <label class="form-control-label">Cal.Units</label>
                <input readonly type="text" class="form-control cal_units" name="cal_units" value=""
                  />
                  
              </div>  

              <div class="form-group col-md-3">
                <label class="form-control-label">Off Peak Image</label>
                <input type="file" class="form-control" name="off_peak_image" value=""
                  />
                  @if ($errors->has('off_peak_image'))
                      <label class="error" for="off_peak_image">{{ $errors->first('off_peak_image') }}</label>
                  @endif
              </div>
        </div>


        <!-- <div class="row">

            <div class="form-group col-md-4">
                <label class="form-control-label">Peak Reading</label>
                <input type="text" class="form-control" name="peak" value="{{old('peak')}}"
                  />
                  @if ($errors->has('peak'))
                      <label class="error" for="peak">{{ $errors->first('peak') }}</label>
                  @endif
              </div>

              <div class="form-group col-md-4">
                <label class="form-control-label">Peak Image</label>
                <input type="file" class="form-control" name="peak_image" value="{{old('peak_image')}}"
                  />
                  @if ($errors->has('peak_image'))
                      <label class="error" for="peak_image">{{ $errors->first('peak_image') }}</label>
                  @endif
              </div>
        </div> -->


          <!-- <hr> -->
          {{--
          <div class="form-group row">
            <div class="col-md-4">
              <button type="submit" class="btn btn-primary save-btn">Submit</button>
              <!-- <button type="reset" class="btn btn-default btn-outline">Reset</button> -->
            </div>
          </div>
          --}}
          
        </form>
      </div>
    </div>
    
           
          <!-- End Panel Basic -->
    </div>
@endsection
@section('javascript')
<!-- <script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.1/js/select2.full.min.js" integrity="sha512-/gPqsEnTjI8VpAkWa61qLLmZn4ySeH86yURIM9rck0iyCMhjMGfkDw298eXFLM2CuRJ93LFhYT1M+SGxJ8asIw==" crossorigin="anonymous" referrerpolicy="no-referrer"></script> -->
<script>
// $("#ref_no").select2({
//         ajax: {
//             url: "{{route('get_meter_info_against_ref_no')}}",
//             dataType: 'json',
//             data: function (params) {
//                 var query = {
//                     search: params.term,
//                 }
//                 return query;
//             },
//             processResults: function (data) {
//                 return {
//                     results: $.map(data, function (item) {
//                       console.log(item);
//                         return {
//                             text: 'Ref:'+item.ref_no+'  Consumer Code: '+item.consumer_code+'  Consumer:'+item.full_name+' CNIC:'+item.cnic ,
//                             id: item.ref_no
//                         }
//                     })
//                 };
//             }
//         },
//         cache: true,
//         placeholder: 'Search ',
//         minimumInputLength: 3
//     });




$(document).ready(function(){
  $("#ref_no").keyup( function(e){
     e.preventDefault();
      if(e.which == 13) {
      get_data_for_reading();
    }
  });

  $(".offpeak").keyup( function(e){
    // get_data_for_reading();
    // $(this).val();
    // $('.pre_reading').val();
    $('.cal_units').val($(this).val() - $('.pre_reading').val());
    if(e.which == 13) {
        save_date();
       
        

       }


  });

  // $(".month_year").change( function(e){
  //   get_data_for_reading();
  // });
  function get_data_for_reading(){
      // e.preventDefault();
      let ref_no=$("#ref_no").val();
      // let month_year=$('.month_year').val();
      
      // if(ref_no && month_year)
      if(ref_no)
      {
        
     
      $.ajax({
          // type:'POST',
          url:"{{route('get_single_record_against_ref_no')}}",
          // data: {ref_no:ref_no,month_year:month_year},
          data: {ref_no:ref_no},
          success:function(response){
            console.log(response);


            // cal_units
            //   pre_reading
            if(response.data != null)
            {

              // if(response.data.length>0)
              // {
                $('.pre_reading').val(response.data.previous_reading_off_peak);
                 $('.offpeak').focus();
                // $('.offpeak').val();
                // $('.cal_units').val();
              // }
            }
            else
            {
              $('.pre_reading').val('');
              message('error','Record Not Found');
            }
            // message('success',response.message);
            // else if(response.success==false)
            // message('error',response.message);
            // else
            // message('error',response.message);

          },
          error:function(response)
          {
            message('error',response.responseJSON.message);
          }

          });

        }      
    
       
    }

  // $(".save-btn").click( function(e){
      // e.preventDefault();
    function save_date(){


      let myform = document.getElementById("dataForm");
      let dataForm = new FormData(myform );
      
      $.ajax({
        cache: false,
        processData: false,
        contentType: false,
          type:'POST',
          url:"{{route('reading.save')}}",
          data: dataForm,
          success:function(response){
            if(response.success==true)
            {
              // $("#off_peak_image").val(null);
              // $(".cal_units").val(0);
              // $(".offpeak").val(0);
              // $(".pre_reading").val(0);
               var ref_no_old=$("#ref_no").val();
              $('#dataForm').trigger("reset");
               $("#ref_no").val(ref_no_old+1);
               $("#ref_no").focus();
              
        
              message('success',response.message);
            }
            else if(response.success==false)
            message('error',response.message);
            else
            message('error',response.message);

          },
          error:function(response)
          {
            message('error',response.responseJSON.message);
          }

          });
    
       
    // });
    }
});
</script>
@endsection


