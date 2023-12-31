<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <title>{{env('APP_NAME')}}</title>
        <meta name="description" content="">
        <meta name="csrf-token" content="{{ csrf_token() }}">
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
        <meta name="robots" content="all,follow">
        <link rel="apple-touch-icon" href="{{ asset('backend/assets/images/favicon.png') }}">
  <link rel="shortcut icon" href="{{ asset('backend/assets/images/favicon.png') }}">
        <!-- Bootstrap CSS-->
        <link rel="stylesheet" href="{{ asset('frontend/css/bootstrap.css') }}">
        <link rel="stylesheet" href="{{ asset('frontend/css/style.css') }}">
        <link rel="stylesheet" href="{{ asset('frontend/css/fancybox.css') }}">
        <link rel="stylesheet" href="{{ asset('frontend/css/font-awesome.css') }}">
        <link rel="stylesheet" href="{{ asset('backend/fonts/web-icons/web-icons.min599c.css?v4.0.2') }}">
        <link rel="stylesheet" href="{{ asset('backend/vendor/toastr/toastr.min599c.css?v4.0.2') }}">
        <style> 
        /* for print preview  */
        .for-screen {display: block;}
        .for-print {display: none;}
        @media print {
            .for-screen {display: none;}
            .for-print {display: block;}
        }

        .crt{
            padding-left: 2px;
            color:red;
            font-size: 0px;
        }
        </style>
    </head>
    <body>
    <div class="se-pre-con"></div>
    <!-- Header -->
    <nav  class="navbar navbar-expand-lg fixed-top navbar-light bg-white " style="font-size: 16px">
        <a class="navbar-brand" href="{{ route('home') }}"><img src="{{ asset('frontend/img/learning.png') }}" width="100%" height="50" /></a>
        
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
          <span class="navbar-toggler-icon"></span>
        </button>
      
        <div class="collapse navbar-collapse" id="navbarSupportedContent">
          <ul class="navbar-nav mr-auto">
            <li class="nav-item active ">
              <a class="nav-link" href="{{ route('home') }}">Home </a>
            </li>
            {{--
            <li class="nav-item dropdown">
              <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                Offer Courses
              </a>
              <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                <?php 
                //$categories = SiteHelpers::active_categories_master();
            ?>
             @foreach ($categories as $category)
             <a class="dropdown-item" href="{{ route('course.list','category_id[]='.$category->mscat_id) }}">
               
                 <i class="fa fa-list category-menu-icon"></i>{{ $category->cat_name}}
             </a>
         @endforeach

        
                
              </div>
            </li>

            --}}
            

            

            <li class="nav-item">
                <a class="nav-link" href="{{ route('page.about') }}">About Us</a>
              </li>

              <li class="nav-item">
                <a class="nav-link" href="{{ route('page.contact') }}">Contact Us</a>
              </li>
          </ul>

          <div class="form-inline  my-2 my-lg-0">
            {{-- <li class="nav-item"> --}}
              {{-- </li> --}}
              {{--
                    <a class="nav-item mr-2">
                        @if(Auth::check() && !Auth::user()->hasRole('instructor') && !Auth::user()->hasRole('admin'))
                        <span class="become-instructor" href="{{ route('login') }}" data-toggle="modal" data-target="#myModal">Become Instructor</span>
                        @endif
                    </a>
                --}}
            @guest
            <a class="btn btn-learna" href="{{ route('login') }}">Login </a>
            @else
            <div class="dropdown float-xl-left float-sm-right float-right ml-4">
              <span id="dropdownMenuButtonRight" data-toggle="dropdown">{{ Auth::user()->first_name }} &nbsp;<i class="fa fa-caret-down"></i></span>
                
             <div class="dropdown-menu dropdown-menu-right" aria-labelledby="dropdownMenuButtonRight">
                
              

                @if(Auth::user()->hasAnyRole(['instructor', 'admin']))
                <a class="dropdown-item" href="{{ route('admin.dashboard') }}" >
                    <i class="fa fa-sign-out-alt"></i> Dashboard
                </a>
            @endif
                <a class="dropdown-item" href="{{ route('logOut') }}" >
                    <i class="fa fa-sign-out-alt"></i> Logout
                </a>
              </div>
            </div>
            @endguest
        </div>
        </div>  
      </nav>
    @yield('content')

    <!-- footer start -->
    <footer id="main-footer" class="for-screen">
        <div class="row m-0">
            <div class="col-lg-2 col-md-4 col-sm-4 col-6 mt-3">
                <ul>
                    <li class="mb-1"><b>Quick Links</b></li>
                    <li><a href="{{ route('home') }}">Home Page</a></li>
                    <!-- <li><a href="">Courses List</a></li> -->
                    <!-- <li><a href="">Instructors List</a></li> -->
                    <li><a href="{{ route('blogs') }}">Blogs List</a></li>
                </ul>
            </div>
            <div class="col-lg-2 col-md-4 col-sm-4 col-6 mt-3">
                <ul>
                    <li class="mb-1"><b>Resources</b></li>
                    <li><a href="{{ route('page.about') }}">About Us</a></li>
                    <li><a href="{{ route('page.contact') }}">Contact Us</a></li>
                    <!-- <li><a href="{{ route('register') }}">Register Page</a></li> -->
                    <li><a href="{{ route('login') }}">Login Page</a></li>
                </ul>
            </div>
            <div class="col-lg-2 col-md-4 col-sm-4 mt-3 d-none d-sm-block">
                <ul>
                    {{-- <li class="mb-1"><b>Top Categories</b></li> --}}
                    {{--
                    @foreach ($categories as $category)
                        @if($loop->iteration <= 4)
                            <li><a href="{{ route('course.list','category_id[]='.$category->id) }}">{{ $category->cat_name}}</a></li>
                        @endif
                    @endforeach
                    --}}
                    
                </ul>
            </div>
            <div class="col-lg-6 col-md-12 col-sm-12 text-center mt-4">
                <!-- <img src=" asset('frontend/img/learning.png') }}" class="img-fluid" width="210" height="48"> -->
                <!-- <br> -->
                <span id="c-copyright">
                    Copyright © {{date('Y')}}, {{env('APP_NAME')}}. All rights reserved.
                </span>
            </div>
        </div>
    </footer>
    <!-- footer end -->

    <!-- The Modal start -->
    <div class="modal" id="myModal">
      <div class="modal-dialog">
        <div class="modal-content">
        <div class="modal-header bi-header ">
            <h5 class="col-12 modal-title text-center bi-header-seperator-head">Become an Instructor</h5>
            <button type="button" class="close" data-dismiss="modal">&times;</button>
        </div>
           
        <div class="becomeInstructorForm">
           <form id="becomeInstructorForm" class="form-horizontal" method="POST" action="">
            {{ csrf_field() }}
                <div class="px-4 py-2">
                    <div class="form-group">
                        <div class="row">
                            <div class="col-6">
                                <label>First Name</label>
                                <input type="text" class="form-control form-control-sm" placeholder="First Name" name="first_name">
                            </div>
                            <div class="col-6">
                                <label>Last Name</label>
                                <input type="text" class="form-control form-control-sm" placeholder="Last Name" name="last_name">
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <label>Contact Email</label>
                        <input type="text" class="form-control form-control-sm" placeholder="Contact Email" name="contact_email">
                    </div>

                    <div class="form-group">
                        <label>Telephone</label>
                        <input type="text" class="form-control form-control-sm" placeholder="Telephone" name="telephone">
                    </div>

                    <div class="form-group">
                        <label>Paypal ID</label>
                        <input type="text" class="form-control form-control-sm" placeholder="Paypal ID" name="paypal_id">
                    </div>

                    <div class="form-group">
                        <label>Biography</label>
                        <textarea class="form-control form-control" placeholder="Biography" name="biography"></textarea>
                    </div>

                    <div class="form-group mt-4">
                        <button type="submit" class="btn btn-lg btn-block login-page-button">Submit</button>
                    </div>

                </div>
                </form>
            </div>
        </div>
      </div>
    </div>
    <!-- The Modal end -->
    </body>
    <script src="{{ asset('frontend/js/jquery-3.3.1.min.js') }}"></script>
    <script src="{{ asset('frontend/js/bootstrap.min.js') }}"></script>
    <script src="{{ asset('frontend/js/fancybox.min.js') }}"></script>
    <script src="{{ asset('frontend/js/modernizr.js') }}"></script>
    <script src="{{ asset('frontend/js/jquery.validate.js') }}"></script>
    
    <!-- Toastr -->
    <script src="{{ asset('backend/vendor/toastr/toastr.min599c.js?v4.0.2') }}"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/2.1.0/sweetalert.min.js"></script>
<!-- <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/js/toastr.min.js"></script> -->

    

    <script>
        $(window).on("load", function (e){
        
        // Animate loader off screen
        $(".se-pre-con").fadeOut("slow");
        // laodcart();
    });
//         $(document).ready(function()
//         { 
            
    
// });
    </script>
    <script type="text/javascript">
         function message(type,message_text)
        {
            
            if(type=='error')
            toastr.error(message_text);
            else if(type=='success')
            toastr.success(message_text);
        }
        
        function swal(event) {
        //   var form =  $(this).closest("form");
        //   var name = $(this).data("name");
          event.preventDefault();
          swal({
              title: `Are you sure to delete?`,
              text: "If you delete this, it will be gone forever.",
              icon: "warning",
              buttons: true,
              dangerMode: true,
          })
          .then((willDelete) => {
            // if (willDelete) {
            //   form.submit();
            // }
          });
        }

        $(document).ready(function()
        {   
            

            // end count
            /* Delete record */
            $('.delete-record').click(function(event)
            {
                var url = $(this).attr('href');
                event.preventDefault();
                
                if(confirm('Are you sure want to delete this record?'))
                {
                    window.location.href = url;
                } else {
                    return false;
                }

            });

            /* Toastr messages */
            toastr.options.closeButton = true;
            toastr.options.timeOut = 5000;
            @if(session()->has('success'))
                toastr.success("{{ session('success') }}");
            @endif
            @if(session()->has('status'))
                toastr.success("{{ session('status') }}");
            @endif
            @if(session()->has('error'))
                toastr.error("{{ session('error') }}");
            @endif
            @if(session()->has('info'))
                toastr.info("{{ session('info') }}");
            @endif

            $('.mobile-nav').click(function()
            {
                $('#sidebar').toggleClass('active');
                
                $(this).toggleClass('fa-bars');
                $(this).toggleClass('fa-times');
            });

         
        });
    </script>
    @yield('javascript')
</html>