@extends('layouts.frontend.index')
@section('content')
<style>
/* ======================== */
/*   Syed Sahar Ali Raza   	*/
/* ========================	*/
@import url(https://fonts.googleapis.com/css?family=Lato:400,100,100italic,300,300italic,400italic,700italic,700,900italic,900);
@import url(https://fonts.googleapis.com/css?family=Raleway:400,100,200,300,500,600,700,800,900);
@import url(https://fonts.googleapis.com/css?family=Raleway:400,100,200,300,500,600,700,800,900);
body{background-color:#eee;}

#generic_price_table{
	background-color: #f0eded;
}

/*PRICE COLOR CODE START*/
#generic_price_table .generic_content{
	background-color: #fff;
}

#generic_price_table .generic_content .generic_head_price{
	background-color: #f6f6f6;
}

#generic_price_table .generic_content .generic_head_price .generic_head_content .head_bg{
	border-color: #e4e4e4 rgba(0, 0, 0, 0) rgba(0, 0, 0, 0) #e4e4e4;
}

#generic_price_table .generic_content .generic_head_price .generic_head_content .head span{
	color: #525252;
}

#generic_price_table .generic_content .generic_head_price .generic_price_tag .price .sign{
    color: #414141;
}

#generic_price_table .generic_content .generic_head_price .generic_price_tag .price .currency{
    color: #414141;
}

#generic_price_table .generic_content .generic_head_price .generic_price_tag .price .cent{
    color: #414141;
}

#generic_price_table .generic_content .generic_head_price .generic_price_tag .month{
    color: #414141;
}

#generic_price_table .generic_content .generic_feature_list ul li{	
	color: #a7a7a7;
    text-align:left;
    padding-left:15px !important;
    /* border-left: 5px solid #2ECC71; */
}

#generic_price_table .generic_content .generic_feature_list ul li span{
	color: Green;
    font-waight:bold;
}
#generic_price_table .generic_content .generic_feature_list ul li:hover{
	background-color: #E4E4E4;
	border-left: 5px solid #2ECC71;
    /* text-align:left; */
    /* padding-left:10px; */
}

#generic_price_table .generic_content .generic_price_btn a{
	border: 1px solid #2ECC71; 
    color: #2ECC71;
} 

#generic_price_table .generic_content.active .generic_head_price .generic_head_content .head_bg,
#generic_price_table .generic_content:hover .generic_head_price .generic_head_content .head_bg{
	border-color: #2ECC71 rgba(0, 0, 0, 0) rgba(0, 0, 0, 0) #2ECC71;
	color: #fff;
}

#generic_price_table .generic_content:hover .generic_head_price .generic_head_content .head span,
#generic_price_table .generic_content.active .generic_head_price .generic_head_content .head span{
	color: #fff;
}

#generic_price_table .generic_content:hover .generic_price_btn a,
#generic_price_table .generic_content.active .generic_price_btn a{
	background-color: #2ECC71;
	color: #fff;
} 
#generic_price_table{
	margin: 50px 0 50px 0;
    font-family: 'Raleway', sans-serif;
}
.row .table{
    padding: 28px 0;
}

/*PRICE BODY CODE START*/

#generic_price_table .generic_content{
	overflow: hidden;
	position: relative;
	text-align: center;
}

#generic_price_table .generic_content .generic_head_price {
	margin: 0 0 0px 0;
}

#generic_price_table .generic_content .generic_head_price .generic_head_content{
	margin: 0 0 50px 0;
}

#generic_price_table .generic_content .generic_head_price .generic_head_content .head_bg{
    border-style: solid;
    border-width: 90px 1411px 23px 399px;
	position: absolute;
}

#generic_price_table .generic_content .generic_head_price .generic_head_content .head{
	padding-top: 40px;
	position: relative;
	z-index: 1;
}

#generic_price_table .generic_content .generic_head_price .generic_head_content .head span{
    font-family: "Raleway",sans-serif;
    font-size: 28px;
    font-weight: 400;
    letter-spacing: 2px;
    margin: 0;
    padding: 0;
    text-transform: uppercase;
}

#generic_price_table .generic_content .generic_head_price .generic_price_tag{
	padding: 0 0 20px;
}

#generic_price_table .generic_content .generic_head_price .generic_price_tag .price{
	display: block;
}

#generic_price_table .generic_content .generic_head_price .generic_price_tag .price .sign{
    display: inline-block;
    font-family: "Lato",sans-serif;
    font-size: 28px;
    font-weight: 400;
    vertical-align: middle;
}

#generic_price_table .generic_content .generic_head_price .generic_price_tag .price .currency{
    font-family: "Lato",sans-serif;
    font-size: 40px;
    font-weight: 300;
    letter-spacing: -2px;
    line-height: 50px;
    padding: 0;
    vertical-align: middle;
}

#generic_price_table .generic_content .generic_head_price .generic_price_tag .price .cent{
    display: inline-block;
    font-family: "Lato",sans-serif;
    font-size: 24px;
    font-weight: 400;
    vertical-align: bottom;
}

#generic_price_table .generic_content .generic_head_price .generic_price_tag .month{
    font-family: "Lato",sans-serif;
    font-size: 18px;
    font-weight: 400;
    letter-spacing: 3px;
    vertical-align: bottom;
}

#generic_price_table .generic_content .generic_feature_list ul{
	list-style: none;
	padding: 0;
	margin: 0;
}

#generic_price_table .generic_content .generic_feature_list ul li{
	font-family: "Lato",sans-serif;
	font-size: 16px;
	padding: 10px 0;
    border-width: thin;
    border-top:0.1px solid lightgray;
	transition: all 0.3s ease-in-out 0s;
}
#generic_price_table .generic_content .generic_feature_list ul li:hover{
	transition: all 0.3s ease-in-out 0s;
	-moz-transition: all 0.3s ease-in-out 0s;
	-ms-transition: all 0.3s ease-in-out 0s;
	-o-transition: all 0.3s ease-in-out 0s;
	-webkit-transition: all 0.3s ease-in-out 0s;

}
#generic_price_table .generic_content .generic_feature_list ul li .fa{
	padding: 0 10px;
}
#generic_price_table .generic_content .generic_price_btn{
	margin: 20px 0 20px;
}

#generic_price_table .generic_content .generic_price_btn a{
    border-radius: 15px;
	-moz-border-radius: 15px;
	-ms-border-radius: 15px;
	-o-border-radius: 15px;
	-webkit-border-radius: 15px;
    display: inline-block;
    font-family: "Lato",sans-serif;
    font-size: 15px;
    outline: medium none;
    padding: 5px 30px;
    text-decoration: none;
    text-transform: uppercase;
}

#generic_price_table .generic_content,
#generic_price_table .generic_content:hover,
#generic_price_table .generic_content .generic_head_price .generic_head_content .head_bg,
#generic_price_table .generic_content:hover .generic_head_price .generic_head_content .head_bg,
#generic_price_table .generic_content .generic_head_price .generic_head_content .head h2,
#generic_price_table .generic_content:hover .generic_head_price .generic_head_content .head h2,
#generic_price_table .generic_content .price,
#generic_price_table .generic_content:hover .price,
#generic_price_table .generic_content .generic_price_btn a,
#generic_price_table .generic_content:hover .generic_price_btn a{
	transition: all 0.3s ease-in-out 0s;
	-moz-transition: all 0.3s ease-in-out 0s;
	-ms-transition: all 0.3s ease-in-out 0s;
	-o-transition: all 0.3s ease-in-out 0s;
	-webkit-transition: all 0.3s ease-in-out 0s;
} 
@media (max-width: 320px) {	
}

@media (max-width: 767px) {
	#generic_price_table .generic_content{
		margin-bottom:75px;
	}
}
@media (min-width: 768px) and (max-width: 991px) {
	#generic_price_table .col-md-3{
		float:left;
		width:50%;
	}
	
	#generic_price_table .col-md-4{
		float:left;
		width:50%;
	}
	
	#generic_price_table .generic_content{
		margin-bottom:75px;
	}
}
@media (min-width: 992px) and (max-width: 1199px) {
}
@media (min-width: 1200px) {
}
#generic_price_table_home{
	 font-family: 'Raleway', sans-serif;
}

.text-center h1,
.text-center h1 a{
	color: #7885CB;
	font-size: 30px;
	font-weight: 300;
	text-decoration: none;
}
.demo-pic{
	margin: 0 auto;
}
.demo-pic:hover{
	opacity: 0.7;
}

#generic_price_table_home ul{
	margin: 0 auto;
	padding: 0;
	list-style: none;
	display: table;
}
#generic_price_table_home li{
	float: left;
}
#generic_price_table_home li + li{
	margin-left: 10px;
	padding-bottom: 10px;
}
#generic_price_table_home li a{
	display: block;
	width: 50px;
	height: 50px;
	font-size: 0px;
}
#generic_price_table_home .blue{
	background: #3498DB;
	transition: all 0.3s ease-in-out 0s;
}
#generic_price_table_home .emerald{
	background: #2ECC71;
	transition: all 0.3s ease-in-out 0s;
}
#generic_price_table_home .grey{
	background: #7F8C8D;
	transition: all 0.3s ease-in-out 0s;
}
#generic_price_table_home .midnight{
	background: #34495E;
	transition: all 0.3s ease-in-out 0s;
}
#generic_price_table_home .orange{
	background: #E67E22;
	transition: all 0.3s ease-in-out 0s;
}
#generic_price_table_home .purple{
	background: #9B59B6;
	transition: all 0.3s ease-in-out 0s;
}
#generic_price_table_home .red{
	background: #E74C3C;
	transition:all 0.3s ease-in-out 0s;
}
#generic_price_table_home .turquoise{
	background: #1ABC9C;
	transition: all 0.3s ease-in-out 0s;
}

#generic_price_table_home .blue:hover,
#generic_price_table_home .emerald:hover,
#generic_price_table_home .grey:hover,
#generic_price_table_home .midnight:hover,
#generic_price_table_home .orange:hover,
#generic_price_table_home .purple:hover,
#generic_price_table_home .red:hover,
#generic_price_table_home .turquoise:hover{
	border-bottom-left-radius: 50px;
    border-bottom-right-radius: 50px;
    border-top-left-radius: 50px;
    border-top-right-radius: 50px;
	transition: all 0.3s ease-in-out 0s;
}
#generic_price_table_home .divider{
	border-bottom: 1px solid #ddd;
	margin-bottom: 20px;
	padding: 20px;
}
#generic_price_table_home .divider span{
	width: 100%;
	display: table;
	height: 2px;
	background: #ddd;
	margin: 50px auto;
	line-height: 2px;
}
#generic_price_table_home .itemname{
	text-align: center;
	font-size: 50px ;
	padding: 50px 0 20px ;
	border-bottom: 1px solid #ddd;
	margin-bottom: 40px;
	text-decoration: none;
    font-weight: 300;
}
#generic_price_table_home .itemnametext{
    text-align: center;
    font-size: 20px;
    padding-top: 5px;
    text-transform: uppercase;
    display: inline-block;
}
#generic_price_table_home .footer{
	padding:40px 0;
}

.price-heading{
    text-align: center;
}
.price-heading h1{
	color: #666;
	margin: 0;
	padding: 0 0 50px 0;
}
.demo-button {
    background-color: #333333;
    color: #ffffff;
    display: table;
    font-size: 20px;
    margin-left: auto;
    margin-right: auto;
    margin-top: 20px;
    margin-bottom: 50px;
    outline-color: -moz-use-text-color;
    outline-style: none;
    outline-width: medium ;
    padding: 10px;
    text-align: center;
    text-transform: uppercase;
}
.bottom_btn{
	background-color: #333333;
    color: #ffffff;
    display: table;
    font-size: 28px;
    margin: 60px auto 20px;
    padding: 10px 25px;
    text-align: center;
    text-transform: uppercase;
}
.demo-button:hover{
	background-color: #666;
	color: #FFF;
	text-decoration:none;
	
}
.bottom_btn:hover{
	background-color: #666;
	color: #FFF;
	text-decoration:none;
}


</style>
<?php 
    $get = '';
    $link = Request::url();
    $i = $j = 0;
    // echo '<pre>';print_r($_GET);
    foreach ($_GET as $key => $value):
      if($key != 'sort_price' && $key != 'sort_rating')
      {
        if(is_array($value))
        {
            foreach ($value as $inner_value):
                $get .= ($i == 0) ? '?'.$key.'[]='.$inner_value : '&'.$key.'[]='.$inner_value;
            $i++;
            endforeach;
        }
        else
        {
            $get .= ($i == 0) ? '?'.$key.'='.$value : '&'.$key.'='.$value;    
        }
        
      }
        if(is_array($value))
        {
            foreach ($value as $inner_value):
                $link .= ($j == 0) ? '?'.$key.'[]='.$inner_value : '&'.$key.'[]='.$inner_value;
            $j++;
            endforeach;
        }
        else
        {
            $link .= ($j == 0) ? '?'.$key.'='.$value : '&'.$key.'='.$value;   
        }
      
    $i++;
    $j++;
    endforeach;
?>
<!-- content start -->
    <div class="container-fluid p-0 home-content">
        <!-- banner start -->
        <div class="subpage-slide-blue">
            <div class="container">
                <h1>Course List</h1>
            </div>
        </div>
        <!-- banner end -->

        <!-- breadcrumb start -->
            <!-- <div class="breadcrumb-container">
                <div class="container">
                  <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="index.php">Home</a></li>
                    <li class="breadcrumb-item active" aria-current="page">Course List</li>
                  </ol>
                </div>
            </div> -->
        
        <!-- breadcrumb end -->
       
    <div style="font-size: 16px" class="container mt-3">

    
<div class="row">
    <div class="col-lg-12">
<div id="generic_price_table">   
<section>
        <!-- <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <div class="price-heading clearfix">
                        <h1>Bootstrap Pricing Table</h1>
                    </div>
                </div>
            </div>
        </div> -->
        <div class="container">
            
            <!--BLOCK ROW START-->
            <div class="row">
            @foreach($groups as $row)
                <?php
                   $courses_list=collect($row->courses);
                //    dd($courses_list);
                   $t_price=$courses_list->sum('price');
                ?>
            <?php $reg_method=$row->registration_method ?>
                <div class="col-md-5">
                
                	<!--PRICE CONTENT START-->
                    <div class="generic_content clearfix">
                        
                        <!--HEAD PRICE DETAIL START-->
                        <div class="generic_head_price clearfix">
                        
                            <!--HEAD CONTENT START-->
                            <div class="generic_head_content clearfix">
                            
                            	<!--HEAD START-->
                                <div class="head_bg"></div>
                                <div class="head">
                                    <span> {{$row->name}}</span>
                                </div>
                                <!--//HEAD END-->
                                
                            </div>
                            <!--//HEAD CONTENT END-->
                            
                            <!--PRICE START-->
                            <div class="generic_price_tag clearfix">	
                                <span class="price">
                                    <!-- <span class="cent">.99</span> -->
                                    @if($row->registration_method=='single')
                                    <span class="month">Subject Wise</span>
                                    @else
                                    <span class="sign">Rs</span>
                                    <span class="currency">{{$t_price}}</span>
                                    <span class="month">/Whole Course</span>

                                    @endif

                                </span>
                            </div>
                            <!--//PRICE END-->
                            
                        </div>                            
                        <!--//HEAD PRICE DETAIL END-->
                        
                        <!--FEATURE LIST START-->
                        <div class="generic_feature_list">
                        	<ul>
                                <?php $i=1; ?>
                            @foreach($row->courses as $course)
                            	<li>
                                    <div class="row">
                                        <div class="col-md-8">
                                    <span>{{$i}}. {{ $course->course_title }} <span style="float:right; padding-right:5px;">RS. 2000 </span></span> <br/>By : {{ $course->first_name.' '.$course->last_name }} </div>
                                    <div
                                     class="col-md-4"> @if($row->registration_method=='single') <button class="btn btn-success btn-outline btn-sm">
                                     Add  <i class="fas fa-shopping-cart"></i>
                                    
                                       </button> @endif</div>
                                    </div>
                            </li>
                            <?php $i++; ?>
                            @endforeach    
                               
                            </ul>
                        </div>
                        <!--//FEATURE LIST END-->
                        
                        <!--BUTTON START-->
                        @if($row->registration_method=='whole')
                        <input type="hidden" value="{{ $row->id }}" class="group_id">
                        <input type="hidden" value="{{$t_price }}" class="price">
                        <input type="hidden" value="{{$t_price }}" class="category_id">
                        <input type="hidden" value="{{$t_price }}" class="">
                        <div class="generic_price_btn clearfix">
                        	<a class="#" href="" class="addToCartBtn">Add To Cart</a>
                        </div>
                        @endif
                        <!--//BUTTON END-->
                        
                    </div>
                    <!--//PRICE CONTENT END-->
                        
                </div>
            @endforeach    
                
                
            </div>	
            <!--//BLOCK ROW END-->
            
        </div>
    </section>             
	
</div>
</div>
</div>
{{--
   
<div class="row">
    
    foreach($groups as $row)
    <?php $reg_method=$row->registration_method ?>
    
    <div class="col-md-4">
        
    <div class="card text-center course_data">
        <div class="card-header">
            {{$row->name}}
        </div>
        <div class="card-body">
          <p class="card-title">
            <?php $group_price=0; ?>
            <ul class="list-unstyled cf-pricing-li">
                @foreach($row->courses as $course)
                <?php $group_price+=$course->price; ?>
                 
                <a href="{{ route('course.view', $course->course_slug) }}">
                    <li><i class="fas fa-file-download"></i>{{ $course->course_title }} By: {{ $course->first_name.' '.$course->last_name }}  @if($row->registration_method=='single') Price: {{$course->price}} @endif</li>
                 </a>
         
                    
                @endforeach
            </ul>
            
          </p>
          {{-- <input type="text" value="{{ $course->id }}" class="course_id"> --}}
          
          <input type="hidden" value="{{ $row->id }}" class="group_id">
          <input type="hidden" value="{{$group_price }}" class="price">
          <input type="hidden" value="{{$group_price }}" class="category_id">
          <input type="hidden" value="{{$group_price }}" class="">

          <h5 class="card-text"> @if($row->registration_method !='single') RS:{{$group_price}} @endif</h5>
          
        </div>
        <button class="addToCartBtn card-footer btn btn-ulearn-cview">
         
            Add to cart
  
          </button>
      </div>
    </div>
    endforeach
    

                 </div>
</div>
--}}

@endsection

@section('javascript')
<script type="text/javascript">







$(document).ready(function()
{

    //cart




$('.addToCartBtn').click(function (e) {
e.preventDefault();
var group_id = $(this).closest('.course_data').find('.group_id').val();
var price = $(this).closest('.course_data').find('.price').val();
// var course_id = $(this).closest('.course_data').find('.course_id').val();


// alert(course_id);


$.ajaxSetup({
    headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    }
});

$.ajax({
    method:"POST",
    url: "/add-to-cart",
    data:{
        'group_id':group_id,
        'price':price,
        // 'course_id':course_id,

    },
    success:function(response){
        alert(response.status);
    }
});
});



    $('.filter-results').change(function()
    {
        $('#courseList').submit();
    });

    $('.sort-by').change(function()
    {
        var search = '{{ url("courses") }}';
        var get = '<?php echo $get;?>';
        var sort = $(this).val();
        var operand = '<?php echo empty($get) ? "?" : "&";?>';
        window.location = search + get + operand + sort;
    });

    $('.c-view').click(function()
    {
         var link = '{{ $link }}';
         var page_link = $(this).attr('href');
         $.ajax({
                type:  'get',
                cache:  false ,
                url:  '{{ route("course.breadcurmb") }}',
                data:  {link:link},
                success: function(data)
                {
                    window.location = page_link;
                }
            });
         return false;
    });
});
</script>
@endsection