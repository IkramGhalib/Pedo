@extends('layouts.backend.index')
@section('content')
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.1/css/select2.min.css" integrity="sha512-YHJ091iDoDM1PZZA9QLuBvpo0VXBBiGHsvdezDoc3p56S3SOMPRjX+zlCbfkOV5k3BmH5O9FqrkKxBRhkdtOkQ==" crossorigin="anonymous" referrerpolicy="no-referrer" />
<div class="page-header">
  <ol class="breadcrumb">
    <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Dashboard</a></li>
    <li class="breadcrumb-item"><a href="#">Area</a></li>
    <li class="breadcrumb-item active">Feeder</li>
  </ol>
  <h1 class="page-title">Add </h1>
</div>


<div class="page-content">

    <div class="panel">
      <div class="panel-body">
        <form method="POST" action="{{ route('admin.feeder.store') }}" id="userForm">
          {{ csrf_field() }}
          <div class="row">
            <div class="form-group col-md-4">
              <label class="form-control-label">Divison</label>
              <select name="division" id="division" class="form-control">
                    <option value="">-- Division --</option>
                  </select>
                @if ($errors->has('division_code'))
                    <label class="error" for="division_code">{{ $errors->first('division_code') }}</label>
                @endif
            </div>
        
            <div class="form-group col-md-4">
              <label class="form-control-label">Sub Divison</label>
              <select name="sub_division" id="sub_division" class="form-control">
                    <option value="">-- Sub Division --</option>
                  </select>
                @if ($errors->has('sub_division'))
                    <label class="error" for="sub_division">{{ $errors->first('sub_division') }}</label>
                @endif
            </div>
        </div>

        <div class="row">
            <div class="form-group col-md-4">
              <label class="form-control-label">Code</label>
              <input required type="text" class="form-control" name="feeder_code"
                placeholder=""/>
                @if ($errors->has('feeder_code'))
                    <label class="error" for="feeder_code">{{ $errors->first('feeder_code') }}</label>
                @endif
            </div>

            <div class="form-group col-md-4">
              <label class="form-control-label">Name</label>
              <input required type="text" class="form-control" name="name"
                placeholder=""/>
                @if ($errors->has('name'))
                    <label class="error" for="test_title">{{ $errors->first('name') }}</label>
                @endif
            </div>


          <div class="form-group col-md-4">
            <label class="form-control-label">Status</label>
            <div>
              <div class="radio-custom radio-default radio-inline">
                <input type="radio" id="inputBasicActive" name="status" value="1" checked  />
                <label for="inputBasicActive">Active</label>
              </div>
              <div class="radio-custom radio-default radio-inline">
                <input type="radio" id="inputBasicInactive" name="status" value="0" />
                <label for="inputBasicInactive">De-Active</label>
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
$("#division").select2({
        ajax: {
            url: "{{route('get_all_division_where')}}",
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
                            text: item.division_code+'-'+item.name,
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


$("#sub_division").select2({
        ajax: {
            url: "{{route('get_all_sub_division_where')}}",
            dataType: 'json',
            data: function (params) {
                var query = {
                    search: params.term,
                    division_id: $('#division').val()
                }
                return query;
            },
            processResults: function (data) {
                return {
                    results: $.map(data, function (item) {
                        return {
                            text: item.sub_division_code+'-'+item.name,
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
@endsection
