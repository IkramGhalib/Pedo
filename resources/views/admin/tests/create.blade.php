@extends('layouts.backend.index')
@section('content')
<div class="page-header">
  <ol class="breadcrumb">
    <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Dashboard</a></li>
    <li class="breadcrumb-item"><a href="{{ route('admin.users') }}">Test</a></li>
    <li class="breadcrumb-item active">Add</li>
  </ol>
  <h1 class="page-title">Add Test</h1>
</div>


<div class="page-content">

    <div class="panel">
      <div class="panel-body">
        <form method="POST" action="{{ route('admin.send.test') }}" id="userForm">
          {{ csrf_field() }}
          {{-- <input type="hidden" name="user_id" value="{{ $user->id }}"> --}}
          <div class="row">
          
            <div class="form-group col-md-4">
              <label class="form-control-label">Course</label>
              <select  class="form-control" name="course_id" required>
                @foreach ($courses as $course)
                    <option value="{{ $course->id }}">{{ $course->course_title }}</option>
                @endforeach
                
              </select>
              @if ($errors->has('course_id'))
              <label class="error" for="course_id">{{ $errors->first('course_id') }}</label>
          @endif
              
               
            </div>
          
            <div class="form-group col-md-4">
              <label class="form-control-label">Test Title</label>
              <input required type="text" class="form-control" name="test_title"
                placeholder="Test Title"/>
                @if ($errors->has('test_title'))
                    <label class="error" for="test_title">{{ $errors->first('test_title') }}</label>
                @endif
            </div>
          
          <div class="form-group col-md-4">
            <label class="form-control-label">Start Date</label>
            <input type="date" class="form-control" name="test_start" required/>
              
            @if ($errors->has('test_start'))
                <label class="error" for="test_start">{{ $errors->first('test_start') }}</label>
            @endif
          </div>



          <div class="form-group col-md-4">
            <label class="form-control-label">End Date</label>
            <input type="date" class="form-control" name="test_end" required/>
              
            @if ($errors->has('test_end'))
                <label class="error" for="test_end">{{ $errors->first('test_end') }}</label>
            @endif
          </div>

          <div class="form-group col-md-4">
            <label class="form-control-label">Time Start</label>
            <input required type="time"  id="timeInput1" class="form-control" name="time_start"/>
              
            @if ($errors->has('time_start'))
                <label class="error" for="time_start">{{ $errors->first('time_start') }}</label>
            @endif
          </div>
          <div class="form-group col-md-4">
            <label class="form-control-label">Time End</label>
            <input required type="time"  id="timeInput2" class="form-control" name="time_end"/>
              
            @if ($errors->has('time_end'))
                <label class="error" for="time_end">{{ $errors->first('time_end') }}</label>
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
          {{-- <input type="text" value="{{ $test->id }}" name="test_id"> --}}


          


          {{-- <div class="form-group col-md-4">
            <label class="form-control-label">User</label>
            <input type="date" class="form-control" name="test_end"/>
              
            @if ($errors->has('test_end'))
                <label class="error" for="test_end">{{ $errors->first('test_end') }}</label>
            @endif
          </div> --}}
    
          {{-- <div class="form-group col-md-4">
              <label class="form-control-label">Role</label>
              <div>
                  <div class="checkbox-custom checkbox-default checkbox-inline">
                    <input type="checkbox" id="inputCheckboxStudent" name="roles[]" value="student" @if($user->id && $user->hasRole('student')) checked @endif>
                    <label for="inputCheckboxStudent">Student</label>
                  </div>
                  <div class="checkbox-custom checkbox-default checkbox-inline">
                    <input type="checkbox" id="inputCheckboxInstructor" name="roles[]" value="instructor" @if($user->id &&  $user->hasRole('instructor')) checked @endif>
                    <label for="inputCheckboxInstructor">Instructor</label>
                  </div>
                  <div id="role-div-error">
                  @if ($errors->has('roles'))
                    <label class="error">{{ $errors->first('roles') }}</label>
                  @endif
                  </div>
              </div>
          </div> --}}
          
          {{-- <div class="form-group col-md-4">
            <label class="form-control-label" >Password</label>
            <input type="password" class="form-control"  name="password"
              placeholder="Password"/>
            @if ($errors->has('password'))
                <label class="error" for="password">{{ $errors->first('password') }}</label>
            @endif
          </div> --}}
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

