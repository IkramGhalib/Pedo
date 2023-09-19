@extends('layouts.frontend.index')
@section('content')
<link rel="stylesheet" href="{{ asset('frontend/vendor/rating/rateyo.css') }}">
<style> 
.modal-dialog {
  width: 98%;
  height: 92%;
  padding: 0;
}

.modal-content {
  height: 99%;
}


</style>
<!-- content start -->
<div class="container-fluid p-0 home-content">
    <!-- banner start -->
    <div class="subpage-slide-blue">
        <div class="container">
            <h1>Course</h1>
        </div>
    </div>
    <!-- banner end -->
    <div class="modal" id="videoModal">
        <div class="modal-dialog">
          <div class="modal-content">
      
            <!-- Modal Header -->
            <div class="modal-header">
                <h4 class="modal-title">Course Intro</h4>
              <button type="button" class="close" data-dismiss="modal">&times;</button>
            </div>
      
            <!-- Modal body -->
            <div class="modal-body">
              Modal body..
            </div>
      
            <!-- Modal footer -->
            <div class="modal-footer">
              <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
            </div>
      
          </div>
        </div>
      </div>
    <!-- breadcrumb start -->
        <div class="breadcrumb-container">
            <div class="container">
              <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{ route('home') }}">Home</a></li>
                <li class="breadcrumb-item"><a href="{{ route('my.courses') }}">My Courses</a></li>
                <li class="breadcrumb-item active" aria-current="page">{{ $course->course_title }}</li>
              </ol>
            </div>
        </div>
    
    <!-- breadcrumb end -->
    
    <div class="container">
        <div class="row mt-4">
            <!-- course block start -->
            <div class="col-xl-9 col-lg-9 col-md-8">
                    <div class="cv-course-container">
                    <h4>{{ $course->course_title }}</h4>
                    <div class="instructor-clist m-0">
                        <div class="col-md-12 p-0 m-0">
                            <i class="fa fa-chalkboard-teacher"></i>&nbsp;
                            <span>Created by <b>{{ $course->instructor->first_name.' '.$course->instructor->last_name }}</b></span>
                        </div>
                    </div>
                    <div class="row cv-header">
                        
                        <div class="col-xl-3 col-lg-3 col-md-6 col-sm-6  col-6">
                            <div class="cv-category-icon">
                                <i class="far fa-bookmark"></i>
                            </div>
                            <div class="cv-category-detail">
                                <span>Category</span>
                                <br>
                                {{ $course->category->name }}
                            </div>
                        </div>

                        <div class="col-xl-3 col-lg-3 col-md-6 col-sm-6  col-6">
                            <div class="cv-category-detail cv-rating float-lg-left float-md-right float-sm-right">
                                <span>{{ $course->ratings->count('rating') }} Reviews</span>
                                <br>
                                <star class="course-rating">
                                    @for($r=1;$r<=5;$r++)
                                        <span class="fa fa-star {{ $r <= $course->ratings->avg('rating') ? 'checked-vpage' : ''}}"></span>
                                    @endfor
                                </star>
                            </div>
                        </div>

                        <div class="col-xl-3 col-lg-3 col-md-6 col-sm-6 col-6">
                            <div class="cv-category-detail cv-price">
                            	@php $course_price = $course->price ? $course->price : '0.00'; @endphp
                                <h4>{{  config('config.default_currency').$course_price }}</h4>
                            </div>
                        </div>
                        <div class="col-xl-3 col-lg-3 col-md-6 float-md-right col-sm-6 float-sm-right col-6">
                            <div class="cv-category-detail cv-enroll float-lg-right float-md-right float-sm-right">
                                <a href="javascript::void(0);" class="btn btn-ulearn-cview mt-1" data-toggle="modal" data-target="#rateModal">RATE COURSE</a>
                            </div>
                        </div>
                    </div>

                    @if($video)
                    {{-- <h6 class="underline-heading mt-3">COURSE INTRO</h6> --}}
                    {{-- <section class="course_preview_video mt-3">
                        <div class="aligncenter overlay">
                            <iframe width="420" height="315"     src="{{$video->video_name}}">
                            </iframe>
                        </div>
                    </section> --}}
                    @endif

                    @if($video)
                    <h6 class="underline-heading mt-3">COURSE INTRO</h6>
                    {{-- <section class="course_preview_video mt-3"> --}}
                        {{-- <div class="aligncenter overlay"> --}}
                            
                              @php
                                $file_name = 'course/'.$video->course_id.'/'.$video->video_title.'.'.$video->video_type;
                                $file_image_name = 'course/'.$video->course_id.'/'.$video->image_name;
                              @endphp
                             <div class="thumbnail">
                                <a href="#" class="videoPlay" data-url="{{$video->video_name}}"><img src="{{ asset('frontend/img/intro.png') }}" /></a>
                                <div class='lbOverlay'>
                                    <div  id="lbContent">
                                    </div>
                                </div>
                            </div>
                            {{-- <a href="#myVideo" class="btn-play far fa-play-circle lightbox"></a> --}}
                            
                            {{-- <img src="@if(Storage::exists($file_image_name)){{ Storage::url($file_image_name) }}@else{{ asset('backend/assets/images/course_detail.jpg') }}@endif" alt="image description"> --}}
                        {{-- </div> --}}
                    {{-- </section> --}}
                    @else
                            @if($course->course_image)
                                <img src="{{asset('course/'.$course->course_image)}}" width="600px" height="300px;">
                            @endif
                    @endif

                   
                </div>
            </div>
            <!-- course block end -->

            <!-- course sidebar start -->
            <div class="col-xl-3 col-lg-3 col-md-4 d-none d-md-block">
                <section class="course-feature">
                    <header>
                        <h6>COURSE FEATURES</h6>
                    </header>

                    <div class="cf-pricing">
                        <span>PRICING:</span>
                        <button class="cf-pricing-btn btn">{{ $course->price == '' || $course_price == 0.00 ? 'FREE' : 'PAID' }}</button>
                    </div>

                    <ul class="list-unstyled cf-pricing-li">
                        <li><i class="far fa-user"></i>{{ $students_count }} Student(s)</li>
                        <li><i class="far fa-clock"></i>Duration: {{ $course->duration ? $course->duration : '-' }}</li>
                        <li><i class="fas fa-bullhorn"></i>Lectures: {{ $lectures_count }}</li>
                        <li><i class="far fa-play-circle"></i>Videos: {{ $videos_count }}</li>
                        <li><i class="far fa-address-card"></i>Certificate of Completion</li>
                        <li><i class="fas fa-file-download"></i>Downloadable Resources</li>
                    </ul>
                </section>
               
                {{--
                @if($video)
                <h6 class="underline-heading mt-3">COURSE INTRO</h6>
                <section class="course_preview_video mt-3">
                    <div class="aligncenter overlay">
                    	
	                      @php
	                        $file_name = 'course/'.$video->course_id.'/'.$video->video_title.'.'.$video->video_type;
	                        $file_image_name = 'course/'.$video->course_id.'/'.$video->image_name;
	                      @endphp
	                     
                        <a href="#myVideo" class="btn-play far fa-play-circle lightbox"></a>
                        <video controls id="myVideo" style="display:none;">
						    <source src="{{ Storage::url($file_name) }}" type="video/mp4">
						    Your browser doesn't support HTML5 video tag.
						</video>
                        <img src="@if(Storage::exists($file_image_name)){{ Storage::url($file_image_name) }}@else{{ asset('backend/assets/images/course_detail.jpg') }}@endif" alt="image description">
                    </div>
                </section>
                @endif
                --}}
                {{--
                <h6 class="mt-4 underline-heading">COURSE CATEGORIES</h6>
                <ul class="ul-no-padding">
                	@php $categories = SiteHelpers::active_categories(); @endphp
                    @foreach ($categories as $category)
			            <li class="my-1">
			                {{ $category->name}}
			            </li>
			        @endforeach
                </ul>
                --}}

                @if($course->keywords)
                <section class="tags-container mt-3">
                    <h6 class="underline-heading">TAGS</h6>
                    <ul class="list-unstyled tag-list mt-3">
                    @php
                    	$tags = explode(',', $course->keywords);
                    @endphp
                    @foreach($tags as $tag)
                        <li><a href="javascript:void();">{{ $tag }}</a></li>
                    @endforeach
                    </ul>
                </section>
                @endif
            </div>
            <!-- course sidebar end -->
        </div>
    </div>
    
<!-- content end -->

<!-- The Modal start -->
<div class="modal" id="rateModal">
  <div class="modal-dialog">
    <div class="modal-content">
    <div class="modal-header bi-header ">
        <h5 class="col-12 modal-title text-center bi-header-seperator-head">Rate the Course</h5>
        <button type="button" class="close" data-dismiss="modal">&times;</button>
    </div>
       
    <div class="becomeInstructorForm">
       <form id="rateCourseForm" class="form-horizontal" method="POST" action="{{ route('course.rate') }}">
        {{ csrf_field() }}
        <input type="hidden" name="course_id" value="{{ $course->id }}">
        <input type="hidden" name="rating" id="rating" value="{{ $course_rating->rating }}">
        <input type="hidden" name="rating_id" value="{{ $course_rating->id }}">
            <div class="px-4 py-2">
                <div class="form-group">
                    <label>Your Rating</label>
                    <div class="row">
                        <div class="col-7 pl-2">
                            <div id="rateYo"></div>
                        </div>
                        <div class="col-5">
                            @if($course_rating->id)
                                <a class="btn btn-sm btn-block delete-review delete-record" href="{{ route('delete.rating', $course_rating->id) }}">Delete Review</a>
                            @endif
                        </div>
                    </div>
                </div>

                <div class="form-group">
                    <label>Your Review</label>
                    <textarea class="form-control form-control" placeholder="Comments" name="comments">{{ $course_rating->comments }}</textarea>
                </div>

                <div class="form-group mt-4">
                    <button type="submit" class="btn btn-lg btn-block login-page-button">{{ $course_rating->id ? 'Update' : 'Add' }} Review</button>
                </div>

            </div>
            </form>
        </div>
    </div>
  </div>
</div>
<!-- The Modal end -->
@endsection

@section('javascript')
<script src="{{ asset('frontend/vendor/rating/rateyo.js') }}"></script>
<script type="text/javascript">
$(document).ready(function(){
   $(".videoPlay").click(function(){
    var youtube_url=$(this).data('url');
    var url = youtube_url.replace("watch?v=", "embed/");
    $("#videoModal").modal('show');
    $('.modal-body').empty();
    $('.modal-body').html('<iframe  src=' + url + '?rel=0&autoplay=1" frameborder="0" allowfullscreen height="100%" width="100%"></iframe>');
    // document.getElementById('lbContent').innerHTML = '<iframe width="420" height="315" src=' + url + '?rel=0&autoplay=1" frameborder="0" allowfullscreen style="float:right; margin-left:20px;"></iframe>';
   });

   $("#videoModal").on('hidden.bs.modal', function (e) {
    $("#videoModal iframe").attr("src", $("#videoModal iframe").attr("src"));
});
});

function toggleIcon(e) 
{
    $(e.target)
        .prev('.card-header')
        .find(".accordian-icon")
        .toggleClass('fa-plus fa-minus');
}
$('.accordion').on('hidden.bs.collapse', toggleIcon);
$('.accordion').on('shown.bs.collapse', toggleIcon);

// lightbox init
function initFancybox() {
"use strict";

$('a.lightbox, [data-fancybox]').fancybox({
  parentEl: 'body',
  margin: [50, 0]
});
}

$(document).ready(function()
{
    initFancybox();

    $("#rateYo").rateYo({
        @if($course_rating->id)
            rating: '{{ $course_rating->rating }}',
        @endif
        halfStar: true,
        ratedFill: "#00a500",
        starWidth: "25px",
        onChange: function (rating, rateYoInstance) {
            $('#rating').val(rating);
        }
    });
});
</script>
@endsection