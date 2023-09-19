@extends('layouts.frontend.index')
@section('content')

<style>

body{
    margin-top:20px;
    color: #484b51;
}
.text-secondary-d1 {
    color: #728299!important;
}
.page-header {
    margin: 0 0 1rem;
    padding-bottom: 1rem;
    padding-top: .5rem;
    border-bottom: 1px dotted #e2e2e2;
    display: -ms-flexbox;
    display: flex;
    -ms-flex-pack: justify;
    justify-content: space-between;
    -ms-flex-align: center;
    align-items: center;
}
.page-title {
    padding: 0;
    margin: 0;
    font-size: 1.75rem;
    font-weight: 300;
}
.brc-default-l1 {
    border-color: #dce9f0!important;
}

.ml-n1, .mx-n1 {
    margin-left: -.25rem!important;
}
.mr-n1, .mx-n1 {
    margin-right: -.25rem!important;
}
.mb-4, .my-4 {
    margin-bottom: 1.5rem!important;
}

hr {
    margin-top: 1rem;
    margin-bottom: 1rem;
    border: 0;
    border-top: 1px solid rgba(0,0,0,.1);
}

.text-grey-m2 {
    color: #888a8d!important;
}

.text-success-m2 {
    color: #86bd68!important;
}

.font-bolder, .text-600 {
    font-weight: 600!important;
}

.text-110 {
    font-size: 110%!important;
}
.text-blue {
    color: #478fcc!important;
}
.pb-25, .py-25 {
    padding-bottom: .75rem!important;
}

.pt-25, .py-25 {
    padding-top: .75rem!important;
}
/* .bgc-default-tp1 { */
    /* background-color: rgba(121,169,197,.92)!important; */
/* } */
.bgc-default-l4, .bgc-h-default-l4:hover {
    background-color: #f3f8fa!important;
}
.page-header .page-tools {
    -ms-flex-item-align: end;
    align-self: flex-end;
}

.btn-light {
    color: #757984;
    background-color: #f5f6f9;
    border-color: #dddfe4;
}
.w-2 {
    width: 1rem;
}

.text-120 {
    font-size: 120%!important;
}
.text-primary-m1 {
    color: #4087d4!important;
}

.text-danger-m1 {
    color: #dd4949!important;
}
.text-blue-m2 {
    color: #01a85a!important;
}
.text-150 {
    font-size: 150%!important;
}
.text-60 {
    font-size: 60%!important;
}
.text-grey-m1 {
    color: #7b7d81!important;
}
.align-bottom {
    vertical-align: bottom!important;
}








</style>

{{-- invoice start --}}


<link href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet" />

<div style="margin-top: 100px" class="page-content container">
    
        
   
    <div class="page-header text-blue-d2 for-screen" style="border-bottom:0px solid white !important;">
        <!-- <h1 class="page-title text-secondary-d1">
            Invoice
            <small class="page-info">
                <i class="fa fa-angle-double-right text-80"></i>
                ID: #$invoices->invoice_id
               
            </small>
        </h1> -->

        <div class="page-tools for-screen">
            <div class="action-buttons">
                <a class="btn bg-white btn-light mx-1px text-95" href="#" data-title="Print" id="printButton" >
                    <i class="mr-1 fa fa-print text-primary-m1 text-120 w-2"></i>
                    Print
                </a>
                <!-- <a class="btn bg-white btn-light mx-1px text-95" href="#" data-title="PDF">
                    <i class="mr-1 fa fa-file-pdf-o text-danger-m1 text-120 w-2"></i>
                    Export
                </a> -->
            </div>
        </div>
    </div>

    <div class="container px-0">
        <div class="row mt-4">
            <div class="col-12 col-lg-12">
                 <div class="row">
                    <div class="col-12">
                        <div class="text-center text-150">
                            <!-- <i class="fa fa-book fa-2x text-success-m2 mr-1"></i> -->
                            <img src="{{ asset('frontend/img/learning.png') }}" width="100Px;" height="100%"><br/>
                            {{--<span class="text-default-d3 mt-3">{{env('APP_NAME')}}</span>--}}
                        </div>
                    </div>
                </div> 
                <!-- .row -->

                <hr class="row brc-default-l1 mx-n1 mb-4" />

                <div class="row">
                    

                    <div class="col-sm-6">
                            
                       
                        <div>
                            <span class="text-sm text-grey-m2 align-middle">To:</span>
                            <span class="text-600 text-110 text-blue align-middle"> </span>
                        </div>
                        <div class="text-grey-m2">
                            <div class="my-1">
                                 
                               Reg:  {{get_reg_no($invoice->user->id) }} 
                            </div>
                            <div class="my-1">
                                Name : {{ $invoice->user->first_name }}
                            </div>
                            <div class="my-1">
                                Email : {{ $invoice ->user->email }}
                            </div>
                            {{-- <div class="my-1"><i class="fa fa-phone fa-flip-horizontal text-secondary"></i> <b class="text-600">111-111-111</b></div> --}}
                        </div>
                    </div>
                    <!-- /.col -->

                    <div class="text-95 col-sm-6 align-self-start d-sm-flex justify-content-end">
                        <hr class="d-sm-none" />
                        <div class="text-grey-m2">
                            <div class="mt-1 mb-2 text-secondary-m1 text-600 text-125">
                                Invoice
                            </div>

                            <div class="my-2"><i class="fa fa-circle text-blue-m2 text-xs mr-1"></i> <span class="text-600 text-90">Consumer No/KuickPay Id :</span> <b>88888{{$invoice->id}} </b></div>
                            
                            <div class="my-2"><i class="fa fa-circle text-blue-m2 text-xs mr-1"></i> <span class="text-600 text-90">INV No :</span> <b>{{$invoice->id}} </b></div>

                            <div class="my-2"><i class="fa fa-circle text-blue-m2 text-xs mr-1"></i> <span class="text-600 text-90">Issue Date:</span> {{$invoice->created_at->format('Y-m-d')}}</div>

                            <div class="my-2"><i class="fa fa-circle text-blue-m2 text-xs mr-1"></i> <span class="text-600 text-90 ">Status:</span> <span class="badge @if($invoice->status=='un-paid') {{'badge-danger'}} else {{'badge-success'}} @endif  badge-pill px-25">{{$invoice->status}}</span></div>
                        </div>
                    </div>
                    <!-- /.col -->
                </div>

                <div class="mt-4">
                    <div class="row text-600 text-white bgc-default-tp1 py-25 bg-success">
                        <div class="d-none d-sm-block col-1">#</div>
                        <div class="col-9 col-sm-5">Group</div>
                        {{-- <div class="d-none d-sm-block col-4 col-sm-2">Qty</div> --}}
                        <div class="d-none d-sm-block col-sm-4">Subject</div>
                        <div class="col-2">Price</div>
                    </div>

                    <div class="text-95 text-secondary-d3">
                        <?php
                        $i=1;
                        $total_price=0;
                        // dd($invoice->invoiceDetil);
                       ?>

                    @foreach ($invoice->invoiceDetil as $key=>$invrow)
                        <div class="row mb-2 mb-sm-0 py-25">
                            <div class="d-none d-sm-block col-1">{{$i}}</div>
                            <div class="col-9 col-sm-5">{{($invrow->category) ? $invrow->category->masterCategory->name : ''}} -  {{($invrow->groups) ? $invrow->groups->name : ''}}</div>
                           
                            <div class="d-none d-sm-block col-4 text-95">
                                {{($invrow->course) ? $invrow->course->masterCourse->course_title : 'Test ('.$invrow->qty.' * '.$invrow->price.')'}}
                            
                            </div>
                            <div class="col-2 text-secondary-d2">{{$invrow->qty*$invrow->price}}</div>
                        </div>
                        <?php
                             $total_price+=$invrow->qty*$invrow->price;
                        $i++;
                        ?>
                        @endforeach

                       

                       
                    </div>

                    <div class="row border-b-2 brc-default-l2"></div>

                    <!-- or use a table instead -->
                    <!--
            <div class="table-responsive">
                <table class="table table-striped table-borderless border-0 border-b-2 brc-default-l1">
                    <thead class="bg-none bgc-default-tp1">
                        <tr class="text-white">
                            <th class="opacity-2">#</th>
                            <th>Description</th>
                            <th>Qty</th>
                            <th>Unit Price</th>
                            <th width="140">Amount</th>
                        </tr>
                    </thead>

                    <tbody class="text-95 text-secondary-d3">
                        <tr></tr>
                        <tr>
                            <td>1</td>
                            <td>Domain registration</td>
                            <td>2</td>
                            <td class="text-95">$10</td>
                            <td class="text-secondary-d2">$20</td>
                        </tr> 
                    </tbody>
                </table>
            </div>
            -->
                    {{--
                    <div class="row mt-3 ">
                        <div class="col-12 col-sm-7 text-grey-d2 text-95 mt-2 mt-lg-0">
                             Extra note such as company or payment information... 
                        </div>

                        <div class="col-12 col-sm-5 text-grey text-90 order-first order-sm-last">
                            <div class="row my-2">
                                <div class="col-7 text-right">
                                     SubTotal 
                                </div>
                                <div class="col-5">
                                     <span class="text-120 text-secondary-d1">$2,250</span> 
                                </div>
                            </div>

                            <div class="row my-2">
                                <div class="col-7 text-right">
                                     Tax (10%) 
                                </div>
                                <div class="col-5">
                                     <span class="text-110 text-secondary-d1">$225</span> 
                                </div>
                            </div>

                            <div class="row my-2 align-items-center bgc-primary-l3 p-2">
                                <div class="col-7 text-right">
                                    Total Amount
                                </div>
                                <div class="col-5">
                                    <span class="text-150 text-success-d3 opacity-2">Rs: {{ $total_price }} </span>
                                </div>
                            </div>
                        </div>
                    </div>
                    --}}
                    <hr />    
                    <div class="row mb-2 mb-sm-0 py-25 bt-1">
                            <div class="d-none d-sm-block col-1"></div>
                            <div class="col-9 col-sm-5"></div>
                           
                            <div class="d-none d-sm-block col-4 text-95"><b>Total</b></div>
                            <div class="col-2 text-secondary-d2"><b>Rs: {{ $total_price }}</b></div>
                        </div>
                        <div class="row mb-2 mb-sm-0 py-25 bt-1">
                            <div class="d-none d-sm-block col-1"></div>
                            <div class="col-9 col-sm-5"></div>
                           
                            <div class="d-none d-sm-block col-4 text-95"><b>Other Charges</b></div>
                            <div class="col-2 text-secondary-d2"><b>Rs: {{ $invoice->other_charges }}</b></div>
                        </div>
                        <div class="row mb-2 mb-sm-0 py-25 bt-1">
                            <div class="d-none d-sm-block col-1"></div>
                            <div class="col-9 col-sm-5"></div>
                           
                            <div class="d-none d-sm-block col-4 text-95"><b>Payable Amount</b></div>
                            <div class="col-2 text-secondary-d2"><b>Rs: {{ $total_price+$invoice->other_charges }}</b></div>
                        </div>

                    <hr />
                    <span class="text-secondary-d1 text-105">Thank you for using our service</span>
                    @if($invoice->status!='paid')
                    @foreach ($p_methods as $pkey=>$prow)
                   
                    <div class="modal" id="paymentModal{{$pkey}}">
                        <div class="modal-dialog">
                          <div class="modal-content">
                      
                            <div class="modal-header">
                              <h4 class="modal-title">Information for {{$prow->payment_title}}</h4>
                              <button type="button" class="close" data-dismiss="modal">&times;</button>
                            </div>
                      
                            <div class="modal-body ">
                                <div class=""> 
                                <?php echo $prow->description ?>
                                </div>
                                    <div class="paymentModelBodyDynamicText{{$pkey}}"> 


                                    </div>
                                
                               
                            </div>
                      
                            <div class="modal-footer">
                              <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
                            </div>
                      
                          </div>
                        </div>
                      </div>
                      <button type="button" class="btn payment_button metod-button btn-success btn-bold px-4 float-right mt-3 mt-lg-0 mr-1 for-screen" data-payment-code="{{$prow->unique_code}}"  data-model-key="{{$pkey}}">
                        Pay  ({{$prow->payment_title}})
                      </button>
                        {{-- <button href="#" class="btn metod-button btn-success btn-bold px-4 float-right mt-3 mt-lg-0 mr-1 for-screen mt{{$prow->pay_method}}" >Pay  ({{$prow->payment_title}})</button> --}}
                   
                    @endforeach
                    @endif
                </div>
            </div>
        </div>
    </div>
    
</div>



@endsection

@section('javascript')

<script>
    $(document).ready(function(){

        $("#printButton").click(function(){
            window.print();
        });
        $(".payment_button").click(function(e){
                e.preventDefault();
                var paymentCode=$(this).data('payment-code');
                console.log($(this).data('model-key'));
                var key=$(this).data('model-key');
                var total_invoice_price='{{ $total_price }}';
                var grand_total_price=80+parseInt(total_invoice_price);
                if(paymentCode=='KuickPay')
                {
                    $(".paymentModelBodyDynamicText"+key).empty();
                    $(".paymentModelBodyDynamicText"+key).append('<p class="text-danger"> Additional 40-80 Rs Bank/Wallet Payment charges will be Apply </p> <p class="text-danger"><b>Payable Amount:'+grand_total_price+' </b>  </p>');
                }
                $("#paymentModal"+key).modal('show');
        });
    });
    
     

</script>


@endsection