@extends('layouts.backend.index')
@section('content')
<div class="page-header">
  <ol class="breadcrumb">
    <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Dashboard</a></li>
    <li class="breadcrumb-item"><a href="{{ route('instructor.form') }}">Instructor</a></li>
    <li class="breadcrumb-item active">Edit</li>
  </ol>
  <h1 class="page-title">Edit Instructor</h1>
</div>


<div class="page-content">

    <div class="panel">
      <div class="panel-body">
        <form method="POST" action="{{ route('instructor.update',$instructor->id) }}" id="userForm">
          {{ csrf_field() }}
          {{-- <input type="hidden" name="user_id" value="{{ $user->id }}"> --}}
          <div class="row">
          
           
          
            <div class="form-group col-md-4">
              <label class="form-control-label">First Name</label>
              <input required type="text" class="form-control" value="{{ $instructor->first_name }}" name="first_name"
                placeholder="First name"/>
                @if ($errors->has('first_name'))
                    <label class="error" for="first_name">{{ $errors->first('first_name') }}</label>
                @endif
            </div>


            <div class="form-group col-md-4">
                <label class="form-control-label">Last Name</label>
                <input type="text" class="form-control" value="{{ $instructor->last_name }}"name="last_name"
                  placeholder="Last name"/>
                  @if ($errors->has('last_name'))
                      <label class="error" for="last_name">{{ $errors->first('last_name') }}</label>
                  @endif
              </div>

              <div class="form-group col-md-4">
                <label class="form-control-label">Email</label>
                <input required type="email" class="form-control" value="{{ $instructor->contact_email }}" name="contact_email"
                  placeholder="Email"/>
                  @if ($errors->has('contact_email'))
                      <label class="error" for="contact_email">{{ $errors->first('contact_email') }}</label>
                  @endif
              </div>

              <div class="form-group col-md-4">
                <label class="form-control-label">Contact</label>
                <input required type="number" value="{{ $instructor->mobile }}"class="form-control" name="mobile"
                  placeholder="Mobile"/>
                  @if ($errors->has('mobile'))
                      <label class="error" for="email">{{ $errors->first('mobile') }}</label>
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

