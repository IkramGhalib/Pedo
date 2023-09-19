@extends('layouts.frontend.index')
@section('content')
<style> 
.table th, .table td
{
    border-top:0px solid white;
}
</style>


<!-- content start -->
<div class="container-fluid p-0 home-content">
    <!-- banner start -->
    <div class="subpage-slide-blue">
        <div class="container">
            <h1>Cart</h1>
        </div>
    </div>
    <!-- banner end -->

    <!-- breadcrumb start -->
        <!-- <div class="breadcrumb-container">
            <div class="container">
              <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="index.php">Home</a></li>
                <li class="breadcrumb-item active" aria-current="page">Cart</li>
              </ol>
            </div>
        </div> -->
    
    <!-- breadcrumb end -->


    <div class="container text-center">
        <div class="row">
            <div class="col-md-12">
                @php
                    $total=0;
                @endphp
                @if($cart->IsEmpty())
                    <div class="text-danger mt-5 mb-5"> <h3>Cart Is Empty  </h3></div>
                @else

                   
                <table class="table table-hover checkout_data" > 
                    <thead>
                      <tr>
                        <th scope="col" colspan="4"> Cart Items</th>
                        
                        
                      </tr>

                   <!--     <tr>
                        <th scope="col">S.No</th>
                        <th scope="col">Group</th>
                        <th scope="col">Price</th>
                        <th scope="col">Delete</th>
                        
                      </tr> -->
                    </thead>
                    <tbody>
                        
                        
                        <?php 
                        
                       
                        ?>
                         @foreach ( $cart_group as $pkey=>$prow )
                         @if($prow->fee_type=='course')
                         <tr>
                                
                                <td colspan="1">{{$prow->category->masterCategory->name}} ({{ $prow->groups->name }})</td>
                                <!-- <td> </td> -->
                                <!-- <td> </td> -->
                                <td>
                                    <div>
                                        @php $course_total=0; @endphp
                                        @foreach ( $cart as $key=>$cartitem )
                                            @if($cartitem->group_id==$prow->group_id)
                                               
                                                <p>{{$cartitem->course->masterCourse->course_title}} @if($prow->groups->registration_method !='whole') -  (Rs.{{ $cartitem->price }}) @endif</p>
                                                
                                                    {{-- <a style="font-size: 16px" href="{{ route('delete.cart',$cartitem->id) }}"><i class="text-danger fa fa-trash"></i></a> --}}
                                                
                                                {{-- <input type="hidden" value="{{ $cartitem->group_id }}" class="cart_group_id"> --}}
                                                
                                                @php
                                                    $total+=$cartitem->price;
                                                     $course_total+=$cartitem->price; 
                                                @endphp
                                            @endif
                                        @endforeach
                                    </div>
                                           
                                </td>
                                
                               
                                <td style="text-align:middle !important;">
                                    {{$course_total}}
                                </td>


                                

                                <td> <a style="font-size: 16px" href="{{ route('delete.cart', ['group_id' => $prow->group_id,'fee_type'=>'course']) }}"><i class="text-danger fa fa-trash"></i></td>
                                
                                {{-- <td> <a style="font-size: 16px" href="{{ route('delete.cart',$prow->id) }}"><i class="text-danger fa fa-trash"></i></td> --}}
                                
                            </tr>
                            @else
                            <td colspan="1">Test</td>
                            <td>
                                <div>
                                    
                                           
                                            <p>{{$prow->qty}} * {{ $prow->price }} </p>
                                            @php
                                                $total+=($prow->price*$prow->qty);
                                                $row_total=$prow->price*$prow->qty;
                                            @endphp
                                        
                                </div>
                                       
                            </td>
                            
                           
                            <td style="text-align:middle !important;">
                                {{$row_total}}
                            </td>

                            <td> <a style="font-size: 16px" href="{{ route('delete.cart', ['group_id' => $prow->id,'fee_type'=>'test']) }}"><i class="text-danger fa fa-trash"></i></td>

                            @endif
                            
                        @endforeach
                    
                        
                    </tbody>
                        <tr>
                            <th colspan="2">Total</th>
                            <th>RS: {{ $total }} </th>
                            <th></th>
                        </tr>

                        <tr>
                            <th colspan="1"></th>
                            <th colspan="1"></th>
                            <th>
                           
                           

                        </th>
                        </tr>
                  </table>
                  <button style="border-radius: 10px 10px;font-size:13px"  class="checkoutBtn btn btn-success text-right"  >Create Invoice</button>

                  @endif
                </div>
        </div>
    </div>

@endsection

@section('javascript')
<script type="text/javascript">

$('.checkoutBtn').click(function (e) {
    e.preventDefault();
    // var cart_group_id = $(this).closest('.checkout_data').find('.cart_group_id').val();
    // var total_price = $(this).closest('.checkout_data').find('.total_price').val();

    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });

    $.ajax({
        method: "POST",
        url: "/checkout",
        data: {
            // 'cart_group_id': cart_group_id,
            // 'total_price': total_price,
        },
        success: function(response) {
            if (response.success === 'true') {
                message('success',response.message);
                window.location.href = "/getUserInvoice/"+response.data.invoice_id;
            } else if (response.success === 'false') {
                message('error',response.message);
            }
        }
    });
});



</script>
@endsection