@extends('layouts.backend.index')
@section('content')
<div class="page-header">
  <ol class="breadcrumb">
    <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Dashboard</a></li>
    <li class="breadcrumb-item"><a href="{{ route('consumer.form') }}">Consumer</a></li>
    <li class="breadcrumb-item active">Edit</li>
  </ol>
  <!-- <h1 class="page-title">Edit Instructor</h1> -->
</div>


<div class="page-content">
  

    <div class="panel">
      <div class="panel-body">
        <ul class="nav nav-tabs" role="tablist">
          <li class="nav-item">
            <a class="nav-link active" data-toggle="tab" href="#tabs-1" role="tab">Consumer</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" data-toggle="tab" href="#tabs-2" role="tab">Meter</a>
          </li>
         
        </ul>
        <div class="tab-content">
          <div class="tab-pane active" id="tabs-1" role="tabpanel">
            <form method="POST" action="{{ route('consumer.update',$instructor->id) }}" id="userForm">
              {{ csrf_field() }}
              {{-- <input type="hidden" name="user_id" value="{{ $user->id }}"> --}}
              <div class="row mt-4">
                 <div class="form-group col-md-4">
                    <label class="form-control-label">Consumer code</label>
                    <input required type="text" class="form-control" name="consumer_code" value="{{($instructor->consumer_code) ? $instructor->consumer_code : old('consumer_code')}}" 
                     />
                      @if ($errors->has('consumer_code'))
                          <label class="error" for="consumer_code">{{ $errors->first('consumer_code') }}</label>
                      @endif
                  </div>
    
                  {{--
    
                <div class="form-group col-md-4">
                  <label class="form-control-label">Refrence No</label>
                  <input required type="text" class="form-control" name="ref_no" value="{{old('ref_no')}}"
                    />
                    @if ($errors->has('ref_no'))
                        <label class="error" for="ref_no">{{ $errors->first('ref_no') }}</label>
                    @endif
                </div>
                --}}
              </div>
    
              <div class="row">
    
                    <div class="form-group col-md-4">
                      <label class="form-control-label"> Name</label>
                      <input required type="text" class="form-control" name="full_name" value="{{($instructor->full_name) ? $instructor->full_name : old('full_name')}}"
                        />
                        @if ($errors->has('full_name'))
                            <label class="error" for="full_name">{{ $errors->first('full_name') }}</label>
                        @endif
                    </div>
    
    
                    <div class="form-group col-md-4">
                        <label class="form-control-label">Father Name</label>
                        <input type="text" class="form-control" name="father_name" value="{{($instructor->father_name) ? $instructor->father_name : old('father_name')}}"
                          />
                          @if ($errors->has('father_name'))
                              <label class="error" for="father_name">{{ $errors->first('father_name') }}</label>
                          @endif
                      </div>
    
                      <div class="form-group col-md-4">
                        <label class="form-control-label">CNIC</label>
                        <input  type="text" class="form-control" name="cnic" value="{{($instructor->cnic) ? $instructor->cnic : old('cnic')}}"
                        />
                          @if ($errors->has('cnic'))
                              <label class="error" for="cnic">{{ $errors->first('cnic') }}</label>
                          @endif
                      </div>
    
                      <div class="form-group col-md-4">
                        <label class="form-control-label">Contact</label>
                        <input required type="number" class="form-control" name="mobile" value="{{($instructor->mobile) ? $instructor->mobile : old('mobile')}}"
                          placeholder="Mobile"/>
                          @if ($errors->has('mobile'))
                              <label class="error" for="email">{{ $errors->first('mobile') }}</label>
                          @endif
                      </div>
    
                      <div class="form-group col-md-8">
                        <label class="form-control-label">address</label>
                        <textarea class="form-control" name="address" required>{{($instructor->address) ? $instructor->address : old('address')}}</textarea>
                      
                          @if ($errors->has('address'))
                              <label class="error" for="address">{{ $errors->first('address') }}</label>
                          @endif
                      </div>
    
    
                      
              <div class="form-group col-md-4">
                      <label class="form-control-label">Tariff / Consumer Type</label>
                      <select  class="form-control" name="consumer_type" required>
                        @foreach ($category as $course)
                            <option value="{{ $course->id }}">{{ $course->name }}</option>
                        @endforeach
                        
                      </select>
                      @if ($errors->has('consumer_type'))
                      <label class="error" for="consumer_type">{{ $errors->first('consumer_type') }}</label>
                      @endif
                      
                      
                    </div>
                </div>
    
    
                <div class="row">
                  <div class="form-group col-md-4">
                        <label class="form-control-label"> Division</label>
                        <select  class="form-control division" name="division" required>
                          <option value=''>  Select </option>
                          @foreach ($divisions as $d)
                              <option value="{{ $d->id }}" @if($area_data_all->division_id==$d->id) {{'selected'}} @endif>{{ $d->division_code }}-{{ $d->name }}</option>
                          @endforeach
                          
                        </select>
                        @if ($errors->has('division'))
                        <label class="error" for="division">{{ $errors->first('division') }}</label>
                        @endif
                        
                        
                      </div>
    
                      <div class="form-group col-md-4">
                          <label class="form-control-label">Sub  Division</label>
                          <select  class="form-control sub_division" name="sub_division" required>
                          @foreach ($sub_divisions as $sd)
                                  <option value="{{ $sd->id }}" @if($area_data_all->sub_dev_id==$sd->id) {{'selected'}} @endif>{{ $sd->sub_division_code }}-{{ $sd->name }}</option>
                              @endforeach
                          
                            
                          </select>
                          @if ($errors->has('sub_division'))
                          <label class="error" for="sub_division">{{ $errors->first('sub_division') }}</label>
                          @endif
                    </div>
              
    
                    <div class="form-group col-md-4">
                          <label class="form-control-label"> Feeder</label>
                          <select  class="form-control feeder" name="feeder" required>
                          @foreach ($feeders as $fd)
                                  <option value="{{ $fd->id }}" @if($area_data_all->feeder_id==$fd->id) {{'selected'}} @endif>{{ $fd->feeder_code }}-{{ $fd->name }}</option>
                              @endforeach
                            
                          </select>
                          @if ($errors->has('Feder'))
                          <label class="error" for="Feder">{{ $errors->first('Feder') }}</label>
                          @endif
                          
                          
                    </div>
                    {{--
                    <div class="form-group col-md-3">
                      <label class="form-control-label"> Meter No</label>
                      <select  class="form-control meter_no" name="meter_no" required>
                      <option value=''>  Select </option>
                      @foreach ($meters as $m)
                              <option value="{{ $m->meter_id }}">{{ $m->meter_no }}</option>
                          @endforeach
                      </select>
                      @if ($errors->has('meter_no'))
                      <label class="error" for="meter_no">{{ $errors->first('meter_no') }}</label>
                      @endif
                      
                    </div>
    
                    
    
    
                    <div class="form-group col-md-2">
                      <label class="form-control-label"> connection date</label>
                      <input type="date"  class="form-control feeder" name="connection_date"  required>
                    
                      @if ($errors->has('connection_date'))
                      <label class="error" for="connection_date">{{ $errors->first('connection_date') }}</label>
                      @endif
                      
                      
                    </div>
    
                    
    
    
                    <div class="form-group col-md-2">
                      <label class="form-control-label"> Definiation date</label>
                      <input type="date"  class="form-control feeder" name="definition_date" required>
                    
                      @if ($errors->has('definition_date'))
                      <label class="error" for="Feder">{{ $errors->first('definition_date') }}</label>
                      @endif
                      
                      
                    </div>
    
                    <div class="form-group col-md-2">
                      <label class="form-control-label"> Previous Reading </label>
                      <input type="number"  class="form-control previous_reading" value="0" name="previous_reading" required>
                      @if ($errors->has('previous_reading'))
                      <label class="error" for="Feder">{{ $errors->first('previous_reading') }}</label>
                      @endif
                      
                      
                    </div>
    
                    <div class="form-group col-md-2">
                      <label class="form-control-label"> Arrear </label>
                      <input type="number"  class="form-control feeder" name="arrear"  value="0" required>
                      
                      @if ($errors->has('arrear'))
                      <label class="error" for="arrear">{{ $errors->first('arrear') }}</label>
                      @endif
                      
                      
                    </div>
    
                    --}}
                
                </div>
                <div class="form-group row">
                    <div class="col-md-4">
                      <button type="submit" class="btn btn-primary">Submit</button>
                      <button type="reset" class="btn btn-default btn-outline">Reset</button>
                    </div>
                  </div>
            </form>
          </div>
          <div class="tab-pane" id="tabs-2" role="tabpanel">
            <form method="POST" action="{{ route('consumer.update',$instructor->id) }}" id="userForm">
              {{ csrf_field() }}
              <input type="hidden" name="update_section" value="meter">
            @foreach ($instructor->meters as  $mkey => $mrow)
            <input type="hidden" name="transection_id[]" value="{{$mrow->cm_id}}">
            
                  <div class="row mt-4">

                    <div class="form-group col-md-2">
                      <label class="form-control-label"> Ref No (Meter {{$mkey+1}})</label>
                      <input type="text"  class="form-control " name="mannual_ref_no[]"  value="{{ $mrow->mannual_ref_no}}" required>
                      
                      @if ($errors->has('mannual_ref_no'))
                      <label class="error" for="mannual_ref_no">{{ $errors->first('mannual_ref_no') }}</label>
                      @endif
                      
                      
                    </div>
                  </div>

                  <div class="row">



                    <div class="form-group col-md-3">
                      <label class="form-control-label"> Meter No</label>
                      <select  class="form-control meter_no" name="meter_no[]" required>
                     
                      <option value='{{$mrow->meter->meter_id}}'>  {{$mrow->meter->meter_no}} </option>

                      @foreach ($meters as $m)
                              <option value="{{ $m->meter_id }}">{{ $m->meter_no }}</option>
                          @endforeach
                      </select>
                      @if ($errors->has('meter_no'))
                      <label class="error" for="meter_no">{{ $errors->first('meter_no') }}</label>
                      @endif
                      
                    </div>




    
                    
    
    
                    <div class="form-group col-md-2">
                      <label class="form-control-label"> connection date</label>
                      <input type="date"  class="form-control feeder" value="{{ $mrow->connection_date}}" name="connection_date[]"  required>
                    
                      @if ($errors->has('connection_date'))
                      <label class="error" for="connection_date">{{ $errors->first('connection_date') }}</label>
                      @endif
                      
                      
                    </div>
    
                    
    
    
                    <div class="form-group col-md-2">
                      <label class="form-control-label"> Definiation date</label>
                      <input type="date"  class="form-control feeder" value="{{ $mrow->definition_date}}" name="definition_date[]" required>
                    
                      @if ($errors->has('definition_date'))
                      <label class="error" for="Feder">{{ $errors->first('definition_date') }}</label>
                      @endif
                      
                      
                    </div>
    
                    <div class="form-group col-md-2">
                      <label class="form-control-label"> Previous Reading </label>

                      <input type="number"  class="form-control previous_reading" value="{{ $mrow->previous_reading_off_peak}}" name="previous_reading[]" required>
                      @if ($errors->has('previous_reading'))
                      <label class="error" for="Feder">{{ $errors->first('previous_reading') }}</label>
                      @endif
                      
                      
                    </div>
    
                    <div class="form-group col-md-2">
                      <label class="form-control-label"> Arrear </label>
                      <input type="number"  class="form-control feeder" name="arrear[]"  value="{{ $mrow->arrear}}" required>
                      
                      @if ($errors->has('arrear'))
                      <label class="error" for="arrear">{{ $errors->first('arrear') }}</label>
                      @endif
                      
                      
                    </div>
                  </div>
                  <hr/>

                  @endforeach
                  <div class="form-group row">
                    <div class="col-md-4">
                      <button type="submit" class="btn btn-primary">Submit</button>
                    </div>
                  </div>
                </form>
    
                    
          
                </div>
        </div>
       
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




