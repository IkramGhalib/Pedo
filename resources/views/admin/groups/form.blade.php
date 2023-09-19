@extends('layouts.backend.index')
@section('content')
<div class="page-header">
  <ol class="breadcrumb">
    <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Dashboard</a></li>
    <li class="breadcrumb-item"><a href="{{ route('admin.groups') }}">group</a></li>
    <li class="breadcrumb-item active">Add</li>
  </ol>
  <!-- <h1 class="page-title">Add Category</h1> -->
</div>

<div class="page-content">

<div class="panel">
  <div class="panel-body">
    <form method="POST" action="{{ route('admin.saveGroup') }}" id="categoryForm">
      {{ csrf_field() }}
      {{-- <input type="hidden" name="category_id" value="{{ $category->id }}"> --}}
      <div class="row">
      
        <div class="form-group col-md-8">
          <label class="form-control-label"> Name <span class="required">*</span></label>
          <input type="text" class="form-control" name="name" 
            placeholder="" value="{{ $category->name }}" />
            
            @if ($errors->has('name'))
                <label class="error" for="name">{{ $errors->first('name') }}</label>
            @endif
        </div>
        <div class="form-group col-md-4">
            <label class="form-control-label">Category <span class="required">*</span></label>
            <select class="form-control" name="category_id">
                <option value="">Select</option>
                @foreach($master_category as $row)
                    <option value="{{ $row->id }}"
                   {{-- @if($category->id == $course->category_id){{ 'selected' }}@endif --}}
                    >
                        {{ $row->name }}
                    </option>
                @endforeach
            </select>
            
            @if ($errors->has('category_id'))
                <label class="error" for="category_id">{{ $errors->first('category_id') }}</label>
            @endif
        </div>

        <div class="form-group col-md-4">
            <label class="form-control-label">Registration Method <span class="required">*</span></label>
            <select class="form-control" name="registration_method">
                
                    <option value="whole" >
                        Whole Course
                    </option>

                    <option value="single" >
                        Custome Selection 
                    </option>
                
            </select>
            
            @if ($errors->has('registration_method'))
                <label class="error" for="category_id">{{ $errors->first('registration_method') }}</label>
            @endif
        </div>

      <div class="form-group col-md-4">
          <label class="form-control-label">Total Seat <span class="required">*</span></label>
          <input type="text" class="form-control" name="total_seat" 
             value="{{ $category->total_seat }}" />
            @if ($errors->has('total_seat'))
                <label class="error" for="name">{{ $errors->first('total_seat') }}</label>
            @endif
        </div>


        <div class="form-group col-md-4">
          <label class="form-control-label">Status</label>
          <div>
                <div class="radio-custom radio-default radio-inline">
                  <input type="radio" id="inputBasicActive" name="is_active" value="1" @if($category->is_active) checked @endif />
                  <label for="inputBasicActive">Active</label>
                </div>
                <div class="radio-custom radio-default radio-inline">
                  <input type="radio" id="inputBasicSingle Course" name="is_active" value="0" @if(!$category->is_active) checked @endif/>
                  <label for="inputBasicInactive">Inactive</label>
                </div>
          </div>
      </div>

          
      

      
     
   

        <div class="col-md-12 ">
        <hr/>
          <div class="row mb-1">
              <div class="col-md-3">
                  <label class="form-control-label">subject <span class="required">*</span></label>
              </div>

        

                <div class=" col-md-3">
                    <label class="form-control-label">Instructor <span class="required">*</span></label>
                    
                </div>

                  <div class=" col-md-2">
                      <label class="form-control-label">Price <span class="required">*</span></label>
                      
                  </div>
                  <div class=" col-md-2">
                      <label class="form-control-label">No of Tests <span class="required">*</span></label>
                      
                  </div>

                  <div class=" col-md-1">
                  <input type="button" class=" btn btn-primary add_button btn-right btn-sm" name="price" value=" + "> 
                     
                  </div>


        </div>
        </div>


        
        <div class="col-md-12 subject_append_row">
          <div class="subject_row">
          
        </div>
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

@section('javascript')
<script type="text/javascript">
    $(document).ready(function()
    { 
      function add_row()
      {
        var subject_row=`<div class="row row-1 mb-1">
              <div class="col-md-3">
                  
                  <select class="form-control" name="subject_id[]">
                      <option value="">Select</option>
                      @foreach($master_course as $row)
                          <option value="{{ $row->id }}"
                        {{-- @if($category->id == $course->category_id){{ 'selected' }}@endif --}}
                          >
                              {{ $row->course_title }}
                          </option>
                      @endforeach
                  </select>
                  
                  @if ($errors->has('category_id'))
                      <label class="error" for="category_id">{{ $errors->first('category_id') }}</label>
                  @endif
              </div>

        

                <div class=" col-md-3">
                    
                    <select class="form-control" name="instructor_id[]">
                        <option value="">Select</option>
                        @foreach($instructor as $row)
                            <option value="{{ $row->id }}"
                          {{-- @if($category->id == $course->category_id){{ 'selected' }}@endif --}}
                            >
                                {{ $row->first_name.' '.$row->last_name }}
                            </option>
                        @endforeach
                    </select>
                    
                    @if ($errors->has('instructor_id'))
                        <label class="error" for="instructor_id">{{ $errors->first('instructor_id') }}</label>
                    @endif
                </div>

                  <div class=" col-md-2">
                      
                      <input type="number" class="form-control" name="price[]">
                  </div>
                  <div class=" col-md-2">
                      
                      <input type="number" class="form-control" name="no_of_test[]">
                  </div>

                  <div class=" col-md-1">
                      <!-- <label class="form-control-label"> &nbsp;  </label> -->
                      <input type="button" class=" btn btn-danger remove_button" name="price" value="-"> 
                  </div>


          </div>`;
          $('.subject_append_row').append(subject_row);
      }

      add_row()
      $(document).on('click','.add_button',function(){
        add_row();
        
      });
      $(document).on('click','.remove_button',function(){
        if($('.row-1').length>1)
        $(this).closest('.row').remove();
      });


        // $("#categoryForm").validate({
        //     rules: {
        //         name: {
        //             required: true
        //         },
        //         icon_class: {
        //             required: true
        //         }
        //     },
        //     messages: {
        //         name: {
        //             required: 'The category name field is required.'
        //         },
        //         icon_class: {
        //             required: 'The icon class field is required.'
        //         }
        //     }
        // });
    });
</script>
@endsection