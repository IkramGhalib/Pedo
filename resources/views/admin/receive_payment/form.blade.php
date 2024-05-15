@extends('layouts.backend.index')
@section('content')
<style> 
div.date {
  z-index: 10000 !important;
}
</style>

<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.1/css/select2.min.css" integrity="sha512-YHJ091iDoDM1PZZA9QLuBvpo0VXBBiGHsvdezDoc3p56S3SOMPRjX+zlCbfkOV5k3BmH5O9FqrkKxBRhkdtOkQ==" crossorigin="anonymous" referrerpolicy="no-referrer" />
<div class="page-header">
  <ol class="breadcrumb">
    <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Dashboard</a></li>
    <li class="breadcrumb-item"><a href="{{ route('consumer.form') }}">Payments </a></li>
    <li class="breadcrumb-item active">Add </li>
  </ol>
  <!-- <h1 class="page-title">Add </h1> -->
</div>


<div class="page-content">

    <div class="panel">
      <div class="panel-body">
        <form method="POST" action="{{ route('reading.save') }}" id="userForm" enctype="multipart/form-data">
          {{ csrf_field() }}
          {{-- <input type="hidden" name="user_id" value="{{ $user->id }}"> --}}
      
          <div class="row">

        

            <div class="form-group col-md-3">
              <label class="form-control-label"> Payment Month</label>
              <!-- <input required type="month" class="form-control payment_month" name="payment_month" value="{{old('payment_month')}}"
                /> -->
                <input required type="month" class="form-control payment_month" name="payment_month" min="@if($bill_payment_month){{date('Y-m',strtotime($bill_payment_month->month_year))}}@endif" max="@if($bill_payment_month){{date('Y-m',strtotime($bill_payment_month->month_year))}}@endif" value="@if($bill_payment_month){{date('Y-m',strtotime($bill_payment_month->month_year))}}@endif"
                />
                @if ($errors->has('payment_month'))
                    <label class="error" for="payment_month">{{ $errors->first('payment_month') }}</label>
                @endif
            </div>

            <div class="form-group col-md-2 mt-2 pt-1">

              <label class=""> Payment date</label>
                <div class="input-group " data-provide="datepicker">
                    <input type="text" class="form-control payment_date date  " value="{{date('d-m-Y')}}">
                    <div class="input-group-addon">
                    <span class="glyphicon glyphicon-th"></span>
                    </div>
                    @if ($errors->has('payment_date'))
                        <label class="error" for="payment_date">{{ $errors->first('payment_date') }}</label>
                    @endif
              </div>
            </div>

           
            

            <!-- <div class="form-group col-md-3 mt-2 pt-1">

              <label class=""> Payment date</label>
                <div class="input-group date" data-provide="datepicker">
                    <input type="text" class="form-control payment_date" value="{{date('d-m-Y')}}">
                    <div class="input-group-addon">
                    <span class="glyphicon glyphicon-th"></span>
                    </div>
                    @if ($errors->has('payment_date'))
                        <label class="error" for="payment_date">{{ $errors->first('payment_date') }}</label>
                    @endif
              </div>
            </div> -->


            <!-- <div class="form-group col-md-3">
              <label class="form-control-label"> Payment date</label>
              <input required type="text" class="form-control payment_date " data-provide="datepicker-inline" name="payment_date" value="{{old('payment_date')}}"
                />
                @if ($errors->has('payment_date'))
                    <label class="error" for="payment_date">{{ $errors->first('payment_date') }}</label>
                @endif

                
            </div> -->



            <div class="form-group col-md-3">
              <label class="form-control-label">Bank</label>
              <select name="bank" id="bank" class="form-control">
                <option value="">-- Select --</option>
                @foreach($banks as $b => $brow)
                <option value="{{$brow->id}}">{{$brow->code}} | {{$brow->title}}</option>
                @endforeach
                  </select>
                @if ($errors->has('bank'))
                    <label class="error" for="bank">{{ $errors->first('bank') }}</label>
                @endif
            </div>

            <div class="form-group col-md-2 mt-2 pt-1">

              <label class=""> Page No</label>
                <div class="input-group " >
                    <input type="number" class="form-control page_no "  required>
                    {{-- <div class="input-group-addon"> --}}
                    {{-- <span class="glyphicon glyphicon-th"></span> --}}
                    {{-- </div> --}}
                    @if ($errors->has('page_no'))
                        <label class="error" for="page_no">{{ $errors->first('page_no') }}</label>
                    @endif
              </div>
            </div>

          </div>
          <div class="row">
            <div class="form-group col-md-6">
              <label class="form-control-label">Refrence No</label>
              <select name="ref_no" id="ref_no" class="form-control">
                    <option value="">-- Select --</option>
                  </select>
                @if ($errors->has('ref_no'))
                    <label class="error" for="ref_no">{{ $errors->first('ref_no') }}</label>
                @endif
            </div>
           

              <div class="form-group col-md-4">
                <label class="form-control-label">Amount</label>
                <input type="number" step="any" class="form-control amount" name="amount" value="{{old('amount')}}"
                  />
                  @if ($errors->has('amount'))
                      <label class="error" for="amount">{{ $errors->first('amount') }}</label>
                  @endif
              </div>
        </div>

          <!-- <hr> -->
          {{-- <div class="form-group row">
            <div class="col-md-4">
              <button type="submit" class="btn btn-primary save-btn">Submit</button>
              <button type="reset" class="btn btn-default btn-outline">Reset</button>
            </div>
          </div> --}}
          
        </form>
      </div>
    </div>
    
           
          <!-- End Panel Basic -->
    </div>
@endsection
@section('javascript')
<script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.1/js/select2.full.min.js" integrity="sha512-/gPqsEnTjI8VpAkWa61qLLmZn4ySeH86yURIM9rck0iyCMhjMGfkDw298eXFLM2CuRJ93LFhYT1M+SGxJ8asIw==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
<script>
  $(document).ready(function(){
    let bill_record;
    // var date = $('.payment_date').datepicker();
    // $( ".payment_date" ).datepicker({ dateFormat: 'dd-mm-yy' });
    $('.date').datepicker({
      dateFormat: 'dd-mm-yy',
    // startDate: '-3d',
    autoclose: true,
});
    // var dateTypeVar = $('payment_date').datepicker('getDate');
  });
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
                        return {
                            text: 'Ref:'+item.ref_no+'  Consumer Code: '+item.consumer_code+'  Consumer:'+item.full_name+' CNIC:'+item.cnic ,
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
    
    // $(document).on('keypress', '.select2-search__field', function(e) {
    //   console.log(e.which);
    //   if (e.keyCode  === 0) {
    //     e.preventDefault();
    //     console.log('enter key press');
    //     // $('#example').select2("close");
    //     // var inputs = $(this).closest('form').find(':input:visible');
    //     // inputs.eq(inputs.index(this) + 1).focus();
    //     $(".amount").focus();
    //   }
    // });

    $(".amount").keyup( function(e){
      e.preventDefault();
      if(e.which == 13) {
        save_record();
    }
    });
    function save_record(){
      var v1=$('#ref_no').val();
      var v2=$('.payment_month').val();
      var v3=$('.payment_date').val();
      var v4=$('#bank').val();
      var v5=$('.amount').val();
      var v6=$('.page_no').val();
      if(v1 && v2 && v3 && v4 && v5 && v6)
      {
        $.ajax({

                type:'POST',

                url:"{{route('receive.payment.save')}}",

                data:{'ref_no':v1,'payment_month':v2,'payment_date':v3,'bank':v4,'amount':v5,'page_no':v6},

                success:function(data){
                  if(data.success=='true')
                  {

                    message('success',data.message);
                    // $('#ref_no').focus();
                    $('#ref_no').select2('open');
                    // $('#ref_no').select2('focus');
                  }
                  else
                  message('error',data.message);

                //  console.log(data);

                }

                });
      }
      else
      {
        message('error','Please Fill Required Field');
      }
    }
      $(".save-btn").click( function(e){
      e.preventDefault();
      // var v1=$('#ref_no').val();
      // var v2=$('.payment_month').val();
      // var v3=$('.payment_date').val();
      // var v4=$('#bank').val();
      // var v5=$('.amount').val();
      // var v6=$('.page_no').val();
      // if(v1 && v2 && v3 && v4 && v5 && v6)
      // {
      //   $.ajax({

      //           type:'POST',

      //           url:"{{route('receive.payment.save')}}",

      //           data:{'ref_no':v1,'payment_month':v2,'payment_date':v3,'bank':v4,'amount':v5,'page_no':v6},

      //           success:function(data){
      //             if(data.success=='true')
      //             {

      //               message('success',data.message);
      //               // $('#ref_no').focus();
      //               $('#ref_no').select2('open');
      //               // $('#ref_no').select2('focus');
      //             }
      //             else
      //             message('error',data.message);

      //           //  console.log(data);

      //           }

      //           });
      // }
      // else
      // {
      //   message('error','Please Fill Required Field');
      // }
      
    
       
    });
    // $("#ref_no,.payment_month").change( function(){
    //   // e.preventDefault();
    //   change_in_ref_month();
    // });
    $("#ref_no,.payment_month,.payment_date").change( function()
    {

    
         var v1=$('#ref_no').val();
         var v2=$('.payment_month').val();
         var v3=$('.payment_date').val();

         if(v1 && v2)
      {
          $.ajax({

              type:'get',

              url:"{{route('get_user_bill')}}",

              data:{'ref_no':v1,payment_month:v2,payment_date:v3},

              success:function(data){
                console.log(data.data.amount);
                if(data.success==true)
                {
                  bill_record=data.data;
                  // console.log($('.payment_date').val());
                  // var date = $("#payment_date").datepicker("getDate");
                  // console.log($.datepicker.formatDate("yy-mm-dd", date));

                  // let pay_date=new Date($('.payment_date').val());
                  // let due_date=new Date(data.data.DueDate);
                  // console.log(pay_date);
                  // console.log(due_date);
                  $('.amount').val(parseFloat(data.data.amount));
                }
                else
                {
                  $('.amount').val(0);
                }
                // message('success',data.message);
                // else
                // message('error',data.message);

              //  console.log(data);

              }

              });
      }        
    
       
    });


</script>
@endsection


