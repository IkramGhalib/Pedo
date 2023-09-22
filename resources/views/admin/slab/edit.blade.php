@extends('layouts.backend.index')
@section('content')
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.1/css/select2.min.css" integrity="sha512-YHJ091iDoDM1PZZA9QLuBvpo0VXBBiGHsvdezDoc3p56S3SOMPRjX+zlCbfkOV5k3BmH5O9FqrkKxBRhkdtOkQ==" crossorigin="anonymous" referrerpolicy="no-referrer" />
<div class="page-header">
  <ol class="breadcrumb">
    <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Dashboard</a></li>
    <li class="breadcrumb-item"><a href="{{ route('admin.users') }}">Area</a></li>
    <li class="breadcrumb-item active">Division</li>
  </ol>
  <h1 class="page-title">Edit</h1>
</div>


<div class="page-content">

    <div class="panel">
      <div class="panel-body">
        <form method="POST" action="{{ route('admin.slab.update',$record->id) }}" id="userForm">
          {{ csrf_field() }}
         
          <div class="row">
            <div class="form-group col-md-4">
              <label class="form-control-label">Consumer Type</label>
              <select name="type"  id="type" class="form-control">
              <option value="{{$parant_record_l1->id}}" selected>{{$parant_record_l1->name}}</option>
                  </select>
                @if ($errors->has('type'))
                    <label class="error" for="type">{{ $errors->first('type') }}</label>
                @endif
            </div>
        
            <div class="form-group col-md-4">
              <label class="form-control-label">Consumer Sub Type</label>
              <select name="sub_type"  id="sub_type" class="form-control">
              <option value="{{$parant_record_l2->id}}" selected>{{$parant_record_l2->name}}</option>
                    <option value="">-- Sub Type --</option>
                  </select>
                @if ($errors->has('sub_division'))
                    <label class="error" for="sub_division">{{ $errors->first('sub_division') }}</label>
                @endif
            </div>
        </div>

        <div class="row">
            <div class="form-group col-md-4">
              <label class="form-control-label">Slab Start Unit</label>
              <input required type="text" value="{{ $record->slab_start_unit }}" class="form-control" name="slab_start_unit"
                placeholder=""/>
                @if ($errors->has('slab_start_unit'))
                    <label class="error" for="slab_start_unit">{{ $errors->first('slab_start_unit') }}</label>
                @endif
            </div>

            <div class="form-group col-md-4">
              <label class="form-control-label">Slab End Unit</label>
              <input required type="text" value="{{ $record->slab_end_unit }}" class="form-control" name="slab_end_unit"
                placeholder=""/>
                @if ($errors->has('slab_end_unit'))
                    <label class="error" for="slab_end_unit">{{ $errors->first('slab_end_unit') }}</label>
                @endif
            </div>

            <div class="form-group col-md-4">
              <label class="form-control-label">Price Per Unit</label>
              <input required type="text" value="{{ $record->charges }}" class="form-control" name="price"
                placeholder=""/>
                @if ($errors->has('charges'))
                    <label class="error" for="charges">{{ $errors->first('charges') }}</label>
                @endif
            </div>


            <div class="form-group col-md-4">
            <label class="form-control-label">Status</label>
            <div>
              <div class="radio-custom radio-default radio-inline">
                <input  type="radio" id="inputBasicActive" name="status"  value="1" @if($record->is_active==1) checked @endif  />
                <label for="inputBasicActive">Active</label>
              </div>
              <div class="radio-custom radio-default radio-inline">
                <input  type="radio" id="inputBasicInactive" name="status" value="0" @if($record->is_active==0) checked @endif />
                <label for="inputBasicInactive">Inactive</label>
              </div>
            </div>
</div>
</div>
            
          

          <div class="form-group row">
            <div class="col-md-4">
              <button type="submit" class="btn btn-primary">Submit</button>
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
$("#type").select2({
        ajax: {
            url: "{{route('get_all_consumer_category_where')}}",
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
                            text: item.name,
                            id: item.id
                        }
                    })
                };
            }
        },
        cache: true,
        placeholder: 'Search ',
        minimumInputLength: 3
    });


$("#sub_type").select2({
        ajax: {
            url: "{{route('get_all_consumer_sub_category_where')}}",
            dataType: 'json',
            data: function (params) {
                var query = {
                    search: params.term,
                    parent_id: $('#type').val()
                }
                return query;
            },
            processResults: function (data) {
                return {
                    results: $.map(data, function (item) {
                        return {
                            text: item.name,
                            id: item.id
                        }
                    })
                };
            }
        },
        cache: true,
        placeholder: 'Search ',
        minimumInputLength: 3
    });
</script>
</script>
@endsection

