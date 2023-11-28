@extends('layouts.backend.index')
@section('content')
<div class="page-header">
  <ol class="breadcrumb">
    <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Dashboard</a></li>
    <li class="breadcrumb-item"><a href="{{ route('consumer.form') }}">Consumer</a></li>
    <li class="breadcrumb-item active">import consumer</li>
  </ol>
  <!-- <h1 class="page-title">Add </h1> -->
</div>


<div class="page-content">
    <div class="panel">
      <div class="panel-body">
        <form method="POST" action="{{ route('consumer.save') }}" id="userForm" enctype="multipart/form-data">
          {{ csrf_field() }}
          {{-- <input type="hidden" name="user_id" value="{{ $user->id }}"> --}}
      
          <div class="row">
              <div class="form-group col-md-4">
                <label class="form-control-label">excel file</label>
                <input required type="file" class="form-control" name="excel_file"                  />
              </div>
        </div>
       
          <hr>
          <div class="form-group row">
            <div class="col-md-4">
              <button type="submit" class="btn btn-primary">Submit</button>
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
<script type="text/javascript">
$(document).ready(function()
{
 

$('.division').change(function (e) 
{
          e.preventDefault();
          var division_id = $(this).val();

          $.ajaxSetup({
              headers: {
                  'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
              }
          });

          $.ajax({
                      method:"get",
                      url: "{{Route('get_all_sub_division_where')}}",
                      dataType: "json",
                      data:{
                          'division_id':$(this).val(),
                      },
                      success:function(response){
                        var sub_division='';
                          if(response)
                          {
                            sub_division+='<option value=""> Select </option>';
                            $.each( response, function( key, value ) {
                              sub_division+='<option value="'+value.id+'">'+value.sub_division_code+'-'+value.name+'</option>';
                            });
                            $('.sub_division').empty();
                            $('.sub_division').append(sub_division);
                          }
                          else
                          message('error',response.message);
                      }
                  });
});


$('.sub_division').change(function (e) 
{
          e.preventDefault();
          // var sub_division_id = $(this).val();

          $.ajaxSetup({
              headers: {
                  'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
              }
          });

          $.ajax({
                      method:"get",
                      url: "{{Route('get_all_feeder_where')}}",
                      dataType: "json",
                      data:{
                          'id':$(this).val(),
                      },
                      success:function(response){
                        var feeder='';
                          if(response)
                          {
                            feeder+='<option value=""> Select </option>';
                            $.each( response, function( key, value ) {
                              feeder+='<option value="'+value.id+'">'+value.feeder_code+'-'+value.name+'</option>';
                            });
                            $('.feeder').empty();
                            $('.feeder').append(feeder);
                          }
                          else
                          message('error',response.message);
                      }
                  });
});


});


</script>
@endsection


