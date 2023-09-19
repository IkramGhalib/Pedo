@extends('layouts.backend.index')
@section('content')
<div class="page-header">
  <ol class="breadcrumb">
    <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Dashboard</a></li>
    <li class="breadcrumb-item"><a href="{{ route('consumer.form') }}">Instructor</a></li>
    <li class="breadcrumb-item active">Add consumer</li>
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
              <label class="form-control-label">Consumer category</label>
              <select  class="form-control" name="category" required>
                @foreach ($category as $course)
                    <option value="{{ $course->id }}">{{ $course->name }}</option>
                @endforeach
                
              </select>
              @if ($errors->has('category'))
              <label class="error" for="category">{{ $errors->first('category') }}</label>
              @endif
              
               
            </div>
            <div class="form-group col-md-4">
              <label class="form-control-label"> Name</label>
              <input required type="text" class="form-control" name="full_name"
                />
                @if ($errors->has('full_name'))
                    <label class="error" for="full_name">{{ $errors->first('full_name') }}</label>
                @endif
            </div>


            <div class="form-group col-md-4">
                <label class="form-control-label">Father Name</label>
                <input type="text" class="form-control" name="father_name"
                  />
                  @if ($errors->has('father_name'))
                      <label class="error" for="father_name">{{ $errors->first('father_name') }}</label>
                  @endif
              </div>

              <div class="form-group col-md-4">
                <label class="form-control-label">CNIC</label>
                <input required type="text" class="form-control" name="cnic"
                 />
                  @if ($errors->has('cnic'))
                      <label class="error" for="cnic">{{ $errors->first('cnic') }}</label>
                  @endif
              </div>

              <div class="form-group col-md-4">
                <label class="form-control-label">Contact</label>
                <input required type="number" class="form-control" name="mobile"
                  placeholder="Mobile"/>
                  @if ($errors->has('mobile'))
                      <label class="error" for="email">{{ $errors->first('mobile') }}</label>
                  @endif
              </div>


              <div class="form-group col-md-4">
                <label class="form-control-label">Consumer ID</label>
                <input required type="text" class="form-control" name="consumer_id"
                 />
                  @if ($errors->has('consumer_id'))
                      <label class="error" for="consumer_id">{{ $errors->first('consumer_id') }}</label>
                  @endif
              </div>


              <div class="form-group col-md-4">
                <label class="form-control-label">Refrence Number</label>
                <input required type="text" class="form-control" name="ref_no"
                 />
                  @if ($errors->has('ref_no'))
                      <label class="error" for="ref_no">{{ $errors->first('ref_no') }}</label>
                  @endif
              </div>
          
              <div class="form-group col-md-4">
            <label class="form-control-label">Status</label>
            <div>
              <div class="radio-custom radio-default radio-inline">
                <input type="radio" id="inputBasicActive" name="status" value="1"  />
                <label for="inputBasicActive">Active</label>
              </div>
              <div class="radio-custom radio-default radio-inline">
                <input type="radio" id="inputBasicInactive" name="status" value="0" />
                <label for="inputBasicInactive">Inactive</label>
              </div>
            </div>
          </div>


          <div class="form-group col-md-12">
                <label class="form-control-label">address</label>
                <textarea class="form-control" name="address"></textarea>
               
                  @if ($errors->has('address'))
                      <label class="error" for="address">{{ $errors->first('address') }}</label>
                  @endif
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

