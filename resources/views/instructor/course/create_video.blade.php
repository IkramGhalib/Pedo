@extends('layouts.backend.index')
@section('content')
<style type="text/css">
label.cabinet{
    display: block;
    cursor: pointer;
}

.cabinet.center-block{
    margin-bottom: -1rem;
}

#upload-demo{
    width: 825px;
    height: 325px;
  padding-bottom:25px;
}

.course-image-container{
    width: 435px;
    height: 246px;
    border: 1px solid #e4eaec;;
    position: relative;
}

.custom-blockquote{
  margin-top: 85px;
}
</style>
<div class="page-header">
  <ol class="breadcrumb">
    <li class="breadcrumb-item"><a href="{{ route('instructor.dashboard') }}">Dashboard</a></li>
    <li class="breadcrumb-item"><a href="{{ route('instructor.course.list') }}">Courses</a></li>
    <li class="breadcrumb-item active">Course</li>
  </ol>
  {{-- <h1 class="page-title">Add Course</h1> --}}
</div>

<div class="page-content">

<div class="panel">
  <div class="panel-body">

    
    @include('instructor/course/tabs')
    

    <form  action="{{ route('instructor.course.video.save') }}" id="courseForm" name="frmupload" method="post" enctype="multipart/form-data">
        {{ csrf_field() }}
      <input type="hidden" name="course_id" value="{{ $course->id }}">
      <div class="row">
      
        <div class="col-md-4">
          <input type="text" placeholder="Vidoe Title" class="form-control" name="video_title">
        </div>  
          <div class="col-md-6">

            {{-- <label class="cabinet center-block"> --}}

              <input type="text" placeholder="Insert Youtube link" class="form-control" name="course_video">
                {{-- <figure class="course-image-container">
                    <div class="video-preview">
                    @if($video)
                      @php
                        $file_name = 'course/'.$video->course_id.'/'.$video->video_title.'.'.$video->video_type;
                      @endphp
                      @if(Storage::exists($file_name))
                        <video width="100%" height="100%" controls preload="auto"><source src="{{ Storage::url($file_name) }}" type="video/mp4"></video>
                      @else
                        <blockquote class="blockquote custom-blockquote blockquote-success mt-4">
                        <p class="mb-0">Promo video not yet uploaded</p>
                        </blockquote>
                      @endif
                    @else
                        <blockquote class="blockquote custom-blockquote blockquote-success">
                        <p class="mb-0">Promo video not yet uploaded</p>
                        </blockquote>
                    @endif
                    
                    </div>
                </figure> --}}
            {{-- </label> --}}
        </div>
                <div class="col-md-2">
                    <input type="submit" class="btn btn-primary" value="Save"/>
                </div>
            </div>
          
           <hr/>
              <table class="table table-hover table-striped w-full">
                <thead>
                  <tr>
                    <th>#</th>
                    <th>Title</th>
                    <th>link</th>
                    <th>Actions</th>
                  </tr>
                </thead>
                <tbody>
                  @if($videos->isNotEmpty())
                  
                      @foreach($videos as $k => $v)
                    
                      <tr>
                        <td>{{ $k+1 }}</td>
                        
                        <td>{{$v->video_title}} </td>
                        <td>{{$v->video_name}} </td>
                        <td>
                          {{-- <a href="#" class="btn btn-xs btn-icon btn-inverse btn-round btn-approve-invoice" data-toggle="tooltip" data-original-title="Approve" data-invdetails="">
                            <i class="icon wb-pencil" aria-hidden="true"> </i>
                          </a> --}}
                          <a href="#" data-v-id="{{$v->id}}"  class="btn btn-xs btn-icon btn-danger btn-round deleteBtn" data-toggle="tooltip" data-original-title="delete record" >
                            <i class="icon wb-trash" aria-hidden="true"> </i>
                          </a>
                        
                        </td>
                      </tr>
                      @endforeach
                  @else
                  <tr> <td colspan="4" class="text-center text-danger"> Record Not Found </td></tr>
                  @endif
                </tbody>
              </table>
              
             
              
              
           

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

$(document).on('click', '.deleteBtn', function(event) {
            event.preventDefault();
            // $('#statusUpdateModel').modal('show');

            let v_id = $(this).data('v-id');

            var row=$(this).closest('tr');;

            $.ajax({
                method: 'post',
                url: '{{route('instructor.course.video.delete')}}',
                data: {
                    'id': v_id,
                    // _token: token,
                    // 'addFormId': $('#addFormId').serialize(),
                },

                success: function(result) {
                  if(result.success=='true')
                  {
                   
                    row.remove();
                    message('success',result.message);
                  }
                  else
                 message('error',result.message);
                
                },
                // complete: function() {
                //     $('#loader').hide();
                // }
            });
        });

        



</script>
@endsection