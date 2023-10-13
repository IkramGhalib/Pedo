@extends('layouts.backend.index')
@section('content')
<div class="page-header">
  <ol class="breadcrumb">
    <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Dashboard</a></li>
    <li class="breadcrumb-item active">Settings</li>
  </ol>
  <h1 class="page-title">Charge</h1>
</div>

<div class="page-content">

<div class="panel">
  <div class="panel-body">
    <form method="POST" action="{{ route('admin.saveConfig') }}">
      {{ csrf_field() }}
      <input type="hidden" name="code" value="settingCharges">
        <div class="row">
            <div class="form-group col-md-6">
              <label class="form-control-label">L.P Surcharge %</label>
              <input type="text" class="form-control" name="late_fee_surcharge" 
                placeholder="" value="{{ isset($config['late_fee_surcharge']) ? $config['late_fee_surcharge'] : '' }}" />
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
