@extends('layouts.backend.index')
@section('content')

<div class="page-header">
    <ol class="breadcrumb">
      <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Dashboard</a></li>
      <li class="breadcrumb-item"><a href="{{ route('admin.invoice') }}">invoice</a></li>
      
    </ol>
    <!-- <h1 class="page-title">Add Category</h1> -->
  </div>
  <div class="page-content">
  <div class="panel">
  <div class="panel-body">
<div class="container-fluid">
    <div class="row">
        <div class="col-md-12">
            <form action="{{ route('admin.send.invoice') }}" method="POST"  class="needs-validation" novalidate>
                @csrf
                <div class="form-row">
                  <div class="col-md-6 mb-3">
                    <label for="validationTooltip01">Name</label>
                    {{-- <input type="text" class="form-control" id="validationTooltip01" placeholder="First name" value="Mark" required> --}}
                    <select  class="form-control" id="validationTooltip01"  required>
                        @foreach ($user as $users)
                        <option value="{{ $users->id }}">{{ $users->reg_no }} / {{ $users->first_name }} / {{ $users->email }}</option>
                            
                        @endforeach
                    </select>
                  </div>
                  </div>
                  <div class="form-row">
                  <div class="col-md-6 mb-3">
                    <label for="validationTooltip02">Group</label>
                    {{-- <input type="text" class="form-control" id="validationTooltip02" placeholder="Last name" value="Otto" required> --}}
                    <select  name="group" class="form-control" id="group"   required>
                      <option val=""> Select</option>
                        @foreach ($group as $groups)
                        <option value="{{ $groups->id }}" data-group_type="{{$groups->registration_method}}">{{ $groups->cat_name }} ({{ $groups->name }})</option>
                            
                        @endforeach
                    </select>
                  </div>
                  
                  
                </div>
                <!-- <div class="form-row">
                <div class="col-md-6 mb-3">
                  <label for="validationTooltipUsername">Courses</label>
                  <div class="input-group">
                   
                    <select style="height: 200px" name="course_id[]" multiple="multiple" class="form-control" id="courses"  required>
                     
                  </select>
                  </div>
                </div>
              </div> -->

              <div class="form-row">
                <div class="col-md-6 mb-3">
                  <label for="validationTooltipUsername">Courses</label>
                  <div class="input-group">
                    <table id="courses" class="table">
                      
                    </table>
                    <!-- <select style="height: 200px" name="course_id[]" multiple="multiple" class="form-control" id="courses"  required> -->
                     
                  <!-- </select> -->
                  </div>
                </div>
              </div>


                <div class="form-row">
                    <div class="col-md-6 mb-3">
                      <label for="validationTooltip02">Test Qty</label>
                      <table id="" class="table">
                                     <tr><td> <button class="btn btn-xs btn-success" > + </button> </td>
                                     <td> 
                                     <input type="number" name="price" class="form-control" id="validationTooltip02" required>
                                      </td>

                            </tr>
                            </table>
                    </div>
                  </div>
                <!-- <button class="btn btn-primary" type="submit">Add To Invoice</button> -->
              </form>
        </div>
    </div>
</div>
</div>
</div>
</div>

@endsection

@section('javascript')

<!-- Stack array for including inline js or scripts -->

<script type="text/javascript">
   
$(document).ready(function()
{

$('#group').change(function (e) {
e.preventDefault();
var group_id = $(this).val();
// var group_type = $(this).data('group_type');
// var group_type = $(this).find(':selected').attr('group_type');
var group_type = $(this).find(':selected').data('group_type');

console.log(group_type);
// var course = $(this).data('course');
// var course_id = $(this).closest('.course_data').find('.course_id').val();


// alert(course_id);


$.ajaxSetup({
    headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    }
});

$.ajax({
    method:"POST",
    url: "{{Route('course.getCourseListAgainstGroup')}}",
    dataType: "json",
    data:{
        'group_id':group_id,
        // 'course_id':course_id,

    },
    success:function(response){
      // console.log(response.courses);
      var courses='';
        if(response.result=='true')
        {

          $.each( response.courses, function( key, value ) {
            if(group_type=='whole')
            {
              if(key==0)
              courses+=`<tr><td> <button class="btn btn-xs btn-danger" > + </button> </td><td> 
               `+value.course_title+` By `+value.first_name+`

              </td></tr>`;
            }
            else
            {

              
              courses+=`<tr><td> <button class="btn btn-xs btn-success" > + </button> </td><td> 
              `+value.course_title+` By `+value.first_name+`
              
              </td></tr>`;
            }
            // courses+='<option>'+value.course_title+' By '+value.first_name+'</option>';
          });
          $('#courses').empty();
          $('#courses').append(courses);
          // console.log(courses);
        }
        else
        message('error',response.message);

        // swal()
    }
});
});
});


</script>
@endsection

