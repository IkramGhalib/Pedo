@extends('layouts.backend.index')
@section('content')
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.1/css/select2.min.css" integrity="sha512-YHJ091iDoDM1PZZA9QLuBvpo0VXBBiGHsvdezDoc3p56S3SOMPRjX+zlCbfkOV5k3BmH5O9FqrkKxBRhkdtOkQ==" crossorigin="anonymous" referrerpolicy="no-referrer" />
<div class="page-header">
  <ol class="breadcrumb">
    <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Dashboard</a></li>
    <li class="breadcrumb-item"><a href="#">Charges</a></li>
    <li class="breadcrumb-item active">Tax</li>
  </ol>
  <h1 class="page-title">Add </h1>
</div>


<div class="page-content">

    <div class="panel">
      <div class="panel-body">
        <form method="POST" action="{{ route('admin.general-tax.store') }}" id="userForm">
          {{ csrf_field() }}
          {{-- <input type="hidden" name="user_id" value="{{ $user->id }}"> --}}
          <div class="row">
          
            <div class="form-group col-md-4">
              <label class="form-control-label">Consumer Type</label>
              <select name="type" id="type" class="form-control">
                    <option value="">-- Consumer Type --</option>
                  </select>
                @if ($errors->has('type'))
                    <label class="error" for="type">{{ $errors->first('type') }}</label>
                @endif
            </div>
     
          </div>
          <div class="row">
          <div class="form-group col-md-4">
              <label class="form-control-label">Tax Title</label>
              <select name="tax_title" id="tax_title" class="form-control">
                    <option value="">-- Select --</option>
                    @foreach($record as $r =>$row)
                    <option value="{{$row->id}}">{{$row->title}}</option>

                    @endforeach
                  </select>
                @if ($errors->has('tax_title'))
                    <label class="error" for="tax_title">{{ $errors->first('tax_title') }}</label>
                @endif
            </div>
          

            <div class="form-group col-md-4">
              <label class="form-control-label">charges</label>
              <input required type="number" step="any" class="form-control" name="charges"
                placeholder=""/>
                @if ($errors->has('charges'))
                    <label class="error" for="charges">{{ $errors->first('charges') }}</label>
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
</script>
@endsection

