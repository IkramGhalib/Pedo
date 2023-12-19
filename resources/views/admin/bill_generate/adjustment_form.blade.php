@extends('layouts.backend.index')
@section('content')
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.1/css/select2.min.css" integrity="sha512-YHJ091iDoDM1PZZA9QLuBvpo0VXBBiGHsvdezDoc3p56S3SOMPRjX+zlCbfkOV5k3BmH5O9FqrkKxBRhkdtOkQ==" crossorigin="anonymous" referrerpolicy="no-referrer" />
<div class="page-header">
  <ol class="breadcrumb">
    <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Dashboard</a></li>
    <li class="breadcrumb-item"><a href="#">Bill </a></li>
    <li class="breadcrumb-item"><a href="#">Bill Adjustment </a></li>
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
      <div class="row">
            <div class="form-group col-md-8">
              <label class="form-control-label">Refrence No</label>
              <select name="ref_no" id="ref_no" class="form-control" required>
                    <option value="">-- Select --</option>
                  </select>
                @if ($errors->has('ref_no'))
                    <label class="error" for="ref_no">{{ $errors->first('ref_no') }}</label>
                @endif
            </div>
      </div>
         
          <div class="row">
          

            <div class="form-group col-md-3">
                <label class="form-control-label">Amount</label>
                <input required type="number" class="form-control amount" name="amount" value="{{old('amount')}}"
                  />
                  @if ($errors->has('amount'))
                      <label class="error" for="amount">{{ $errors->first('amount') }}</label>
                  @endif
              </div>

              <div class="form-group col-md-5">
                <label class="form-control-label"> remarks</label>
                <input  type="text" class="form-control remarks" name="remarks" value=""
                  />
                  
              </div>
             

              
              
        </div>
          <!-- <hr> -->
          <div class="form-group row">
            <div class="col-md-4">
              <button type="submit" class="btn btn-primary save-btn">Submit</button>
              <!-- <button type="reset" class="btn btn-default btn-outline">Reset</button> -->
            </div>
          </div>
          
        </form>
      </div>
    </div>
    
           
          <!-- End Panel Basic -->
    </div>
@endsection
@section('javascript')
<script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.1/js/select2.full.min.js" integrity="sha512-/gPqsEnTjI8VpAkWa61qLLmZn4ySeH86yURIM9rck0iyCMhjMGfkDw298eXFLM2CuRJ93LFhYT1M+SGxJ8asIw==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
<script>
$("#ref_no").select2({
        ajax: {
            url: "{{route('get_meter_info_against_ref_no')}}",
            dataType: 'json',
            data: function (params) {
                var query = {
                    search: params.term,
                }
                return query;
            },
            processResults: function (data) {
                return {
                    results: $.map(data, function (item) {
                      console.log(item);
                        return {
                            text: 'Ref:'+item.ref_no+'  Consumer Code: '+item.consumer_code+'  Consumer:'+item.full_name ,
                            id: item.ref_no
                        }
                    })
                };
            }
        },
        cache: true,
        placeholder: 'Search ',
        minimumInputLength: 3
    });




$(document).ready(function(){
  $("#ref_no").change( function(e){
    // get_data_for_reading();
  });

  // $(".offpeak").keyup( function(e){
  //   // get_data_for_reading();
  //   // $(this).val();
  //   // $('.pre_reading').val();
  //   $('.cal_units').val($(this).val() - $('.pre_reading').val());

  // });

  // $(".month_year").change( function(e){
  //   get_data_for_reading();
  // });
  // function get_data_for_reading(){
  //     // e.preventDefault();
  //     let ref_no=$("#ref_no").val();
  //     // let month_year=$('.month_year').val();
      
  //     // if(ref_no && month_year)
  //     if(ref_no)
  //     {
        
     
  //     $.ajax({
  //         // type:'POST',
  //         url:"{{route('get_data_agaist_reading')}}",
  //         // data: {ref_no:ref_no,month_year:month_year},
  //         data: {ref_no:ref_no},
  //         success:function(response){
  //           console.log(response);

  //           // cal_units
  //           //   pre_reading
  //           if(response.success==true)
  //           {
  //             // if(response.data.length>0)
  //             // {
  //               $('.pre_reading').val(response.data.previous_reading_off_peak);
  //               // $('.offpeak').val();
  //               // $('.cal_units').val();
  //             // }
  //           }
  //           // message('success',response.message);
  //           // else if(response.success==false)
  //           // message('error',response.message);
  //           // else
  //           // message('error',response.message);

  //         },
  //         error:function(response)
  //         {
  //           message('error',response.responseJSON.message);
  //         }

  //         });

  //       }      
    
       
  //   }

  $(".save-btn").click( function(e){
      e.preventDefault();
      let myform = document.getElementById("dataForm");
      let dataForm = new FormData(myform );
      
      $.ajax({
        cache: false,
        processData: false,
        contentType: false,
          type:'POST',
          url:"{{route('bill.adjustment.save')}}",
          data: dataForm,
          success:function(response){
            if(response.success==true)
            {
              $(".amount").val(0);
              $(".remarks").val();
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
    
       
    });
});
</script>
@endsection


