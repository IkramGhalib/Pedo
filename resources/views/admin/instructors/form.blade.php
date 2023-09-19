@extends('layouts.backend.index')
@section('content')
<style type="text/css">

  label.cabinet{
  display: block;
  cursor: pointer;
}

/*label.cabinet input.file{
  position: relative;
  height: 100%;
  width: auto;
  opacity: 0;
  -moz-opacity: 0;
filter:progid:DXImageTransform.Microsoft.Alpha(opacity=0);
margin-top:-30px;
}*/
.cabinet.center-block{
  margin-bottom: -1rem;
}

#upload-demo{
  width: 558px;
  height: 372px;
padding-bottom:25px;
}
figure figcaption {
  position: absolute;
  bottom: 0;
  color: #fff;
  width: 100%;
  padding-left: 9px;
  padding-bottom: 5px;
  text-shadow: 0 0 10px #000;
}
.course-image-container{
  width: 200px;
  height: 200px;
  border: 1px solid #e4eaec;;
  position: relative;
}
.course-image-container img{
  width: 399px;
  height: 266px;
  position: absolute;  
  top: 0;  
  bottom: 0;  
  left: 0;  
  right: 0;  
  margin: auto;
}
.remove-lp{
  font-size: 16px;
  color: red;
  float: right;
  padding-right: 2px;
}
</style>
<div class="page-header">
  <ol class="breadcrumb">
    <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Dashboard</a></li>
    <li class="breadcrumb-item"><a href="{{ route('instructor.form') }}">Instructor</a></li>
    <li class="breadcrumb-item active">Add</li>
  </ol>
  <h1 class="page-title">Add Instructor</h1>
</div>


<div class="page-content">

    <div class="panel">
      <div class="panel-body">
        <form method="POST" action="{{ route('instructor.save') }}" id="userForm" enctype="multipart/form-data">
          {{ csrf_field() }}
          {{-- <input type="hidden" name="user_id" value="{{ $user->id }}"> --}}
          <div class="row">
          
            
          <div class="form-group col-md-6 pt-4">
            <span style="font-size: 10px;">
                Supported File Formats: jpg,jpeg,png 
                <br>Dimesnion: 825px X 550px
                <br> Max File Size: 500kb
            </span>
            
            <div class="row">
                <div class="col-md-6">
                    {{-- <div class="input-group input-group-file" data-plugin="inputGroupFile"> --}}
                        {{-- <input type="text" class="form-control" readonly=""> --}}
                        {{-- <span class="input-group-btn"> --}}
                          {{-- <span class="btn btn-success btn-file"> --}}
                            {{-- <i class="icon wb-upload" aria-hidden="true"></i> --}}
                            <input type="file" class="center-block" name="instructor_image"  />
                            {{-- <input type="hidden" name="course_image_base64" id="course_image_base64"> --}}
                          </span>
                        {{-- </span> --}}
                    {{-- </div> --}}
                </div>

               
            </div>
            <hr class="my-4">
        </div>
      </div>
      <div class="row">
          
            <div class="form-group col-md-4">
              <label class="form-control-label">First Name</label>
              <input required type="text" class="form-control" name="first_name"
                placeholder="First name"/>
                @if ($errors->has('first_name'))
                    <label class="error" for="first_name">{{ $errors->first('first_name') }}</label>
                @endif
            </div>


            <div class="form-group col-md-4">
                <label class="form-control-label">Last Name</label>
                <input type="text" class="form-control" name="last_name"
                  placeholder="Last name"/>
                  @if ($errors->has('last_name'))
                      <label class="error" for="last_name">{{ $errors->first('last_name') }}</label>
                  @endif
              </div>

              <div class="form-group col-md-4">
                <label class="form-control-label">Email</label>
                <input required type="email" class="form-control" name="contact_email"
                  placeholder="Email"/>
                  @if ($errors->has('contact_email'))
                      <label class="error" for="contact_email">{{ $errors->first('contact_email') }}</label>
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

