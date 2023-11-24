@extends('layouts.backend.index')
@section('content')
<div class="page-header">
  <ol class="breadcrumb">
    <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Dashboard</a></li>
    <li class="breadcrumb-item"><a href="{{ route('consumer.form') }}">Meter Reading</a></li>
    <li class="breadcrumb-item active">Edit</li>
  </ol>
  <!-- <h1 class="page-title">Edit Instructor</h1> -->
</div>


<div class="page-content">

    <div class="panel">
      <div class="panel-body">
        <form method="POST" action="{{ route('reading.update',$record->id) }}" id="userForm">
          {{ csrf_field() }}
          {{-- <input type="hidden" name="user_id" value="{{ $user->id }}"> --}}
        

    
          <div class="row">
            <div class="form-group col-md-8">
              <label class="form-control-label">Refrence No</label>
              <input type="text" name="ref_no" value="{{$record->bConsumerMeter->ref_no}}" id="ref_no"  class="form-control" readonly>
                
            </div>
      </div>
          {{-- <div class="row">

            <div class="form-group col-md-4">
              <label class="form-control-label"> Year-Month</label>
              <input required type="month" class="form-control" value="{{date('Y-m',strtotime($record->month_year))}}"  name="month_year" value="{{old('month_year')}}"
                />
                @if ($errors->has('month_year'))
                    <label class="error" for="full_name">{{ $errors->first('month_year') }}</label>
                @endif
            </div>

          </div> --}}
          <div class="row">

            <div class="form-group col-md-4">
                <label class="form-control-label"> Reading</label>
                <input type="text" class="form-control" value="{{$record->offpeak}}" name="offpeak" value="{{old('offpeak')}}"
                  />
                  @if ($errors->has('offpeak'))
                      <label class="error" for="offpeak">{{ $errors->first('offpeak') }}</label>
                  @endif
              </div>

              <div class="form-group col-md-4">
                <label class="form-control-label">Off Peak Image</label>
                <input type="file" class="form-control" name="off_peak_image" 
                  />
                  @if ($errors->has('off_peak_image'))
                      <label class="error" for="off_peak_image">{{ $errors->first('off_peak_image') }}</label>
                  @endif
              </div>
        </div>


        {{-- <div class="row">

            <div class="form-group col-md-4">
                <label class="form-control-label">Peak Reading</label>
                <input type="text" class="form-control" value="{{$record->peak}}" name="peak" value="{{old('')}}"
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
        </div> --}}



              
      


        
          
      

        

            



            


           

           

           
        
        </div>
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
                      url: "{{Route('subDivision.getSubDivisionsAgainstDivision')}}",
                      dataType: "json",
                      data:{
                          'id':$(this).val(),
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
                      url: "{{Route('feeder.getFeedersAgainstSubDivision')}}",
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




