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
        <form method="POST" class="from_submission" action="{{ route('bill.generate.load_statistics_view') }}" id="form" enctype="multipart/form-data">
          {{ csrf_field() }}
          {{-- <input type="hidden" name="user_id" value="{{ $user->id }}"> --}}
     
          <div class="row">
            <div class="col-md-12 mb-4">
                <div class="progress">
                  <div id="progressbar" class="progress-bar progress-bar-striped active" role="progressbar"
                  aria-valuenow="40" aria-valuemin="0" aria-valuemax="100" style="width: @if($reading_record->status=='generated') {{100}}@else {{0}}@endif%">
                  
                    @if($reading_record->status=='generated') {{100}}   @else {{0}}@endif %
                  </div>
                </div>
            </div>
            <div class="col-md-4">
              Month: <span class="g-total-reading">{{date('M-Y',strtotime($all_inputs['month_year']))}} </span><br/>
              Total Readings: <span class="g-total-reading">{{$all_reading}} </span><br/>
              Generated Bills: <span class="g-gbills">{{$generated_bills_reading}} </span><br/>
            </div>

           

            <div class="col-md-4">
              Status: 
              <span class="badge badge-success g-status">@if($reading_record) {{$reading_record->status}} @else {{'N/A'}} @endif</span>
            </div>
          </div>
          <input hidden="generated_id" id="main_record_id" name="main_record_id" value="@if($reading_record) {{$reading_record->id}}@endif">

          <!-- <hr> -->
          {{-- <div class="form-group row">
            <div class="col-md-4">
              <button type="submit" class="btn btn-primary show-confirmation-form">Generate</button>
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
<script>
  $(document).ready(function(){

    // draw progress bar
    function progress_bar(rec)
    {
      var all_record={{$all_reading}};
      var percent=parseInt((rec/all_record)*100);
      $("#progressbar").attr('style','width:'+percent+'%');
      $("#progressbar").text(percent+'%');

    }
  
// $("#btn-save").click(function (e) {
  // generation of bill start here
  function start_bill_generation()
  {
    $(".se-pre-con").fadeOut("slow");
  $.ajaxSetup({
      headers: {
          'X-CSRF-TOKEN': jQuery('meta[name="csrf-token"]').attr('content')
      }
  });
  // e.preventDefault();
  // var id=jQuery('#record_id').val();
  var formData = {
      id: $('#main_record_id').val(),
  };
 
  $.ajax({
      type: 'POST',
      url: '{{route("bill.generate.save")}}',
      data: formData,
      dataType: 'json',
      async: false,
      success: function (data) {
          console.log(data);
          // jQuery('#formModal').modal('hide')
          if(data.success==true)
          {
            var rec=data.data.generated_record;
            progress_bar(rec);
            $(".g-status").text(data.data.status);
            $(".g-gbills").text(data.data.generated_record);
            if(data.data.remaining_record>0)
            {
              start_bill_generation();
            }
            else
            {
              message('success',data.message);
            }
            // $("#row"+id).closest('tr').remove();
            // message('success',data.message);
          }
          else
          {
          // message('error',data.message);
          }
        },
      error: function (data) {
          console.log(data);
      }
  });
}

setTimeout(start_bill_generation(), 500);
// });

});
</script>
@endsection


