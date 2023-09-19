@extends('layouts.backend.index')
@section('content')
<style> 
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
.modal {
  padding: 0 !important; // override inline padding-right added from js
}
.modal .modal-dialog {
  width: 100%;
  max-width: none;
  height: 100%;
  margin: 0;
}
.modal .modal-content {
  height: 100%;
  border: 0;
  border-radius: 0;
}
.modal .modal-body {
  overflow-y: auto;
}
</style>
<div class="page-header">
  <ol class="breadcrumb">
    <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Dashboard</a></li>
    <li class="breadcrumb-item active">invoice</li>
  </ol>
   <!-- <h1 class="page-title">Invoice</h1> -->
</div>

<div class="page-content">

<div class="panel">
        <div class="panel-heading">
            <div class="panel-title">
              <a href="{{ route('admin.invoice') }}" class="btn btn-success btn-sm"><i class="icon wb-plus" aria-hidden="true"></i> Add Invoice </a>
                
            </div>
          
          <div class="panel-actions">
          <form method="GET" action="{{ route('admin.invoice.list') }}">
              <div class="input-group">
                <input type="text" class="form-control" name="search" placeholder="Search..." value="{{ Request::input('search') }}">
                <span class="input-group-btn">
                  <button type="submit" class="btn btn-primary" data-toggle="tooltip" data-original-title="Search"><i class="icon wb-search" aria-hidden="true"></i></button>
                  <a href="{{ route('admin.invoice.list') }}" class="btn btn-danger" data-toggle="tooltip" data-original-title="Clear Search"><i class="icon wb-close" aria-hidden="true"></i></a>
                </span>
              </div>
          </form>
          </div>
        </div>
        
        <div class="panel-body">
          <table class="table table-hover table-striped w-full">
            <thead>
              <tr>
                <th>#</th>
                <th>Inv #</th>
                <th>Invoice for</th>
                <!-- <th>Group</th> -->
                <th>Create date </th>
                <th>Status</th>
                <th>amount</th>
                <th>Attachment</th>

                <th>Actions</th>
              </tr>
            </thead>
            <tbody>
              @foreach($invoice as $key=>$invoices)
             
              <tr>
                <td>{{{ $key+1 }}}</td>
                {{-- <td><i class="fas {{ $category->icon_class }}"></i></td> --}}
                <td>{{ $invoices->id }} </td>
                <td>{{ $invoices->user->first_name }} </td>
                <td>{{ $invoices->created_at }} </td>
               
                {{--<td>{{ $invoices->groups->name }}</td>
                
                <td>{{ $invoices->category->name }}</td>
                <td>{{ $invoices->course->course_title}}</td>
                <td>{{ $invoices->invoice->status}}</td>
                --}}    
                
                
                <td>
                  <?php $status_class='badge-danger'?>
                  @if($invoices->status=='paid')
                  <?php $status_class='badge-success' ?>
                  @endif
                  <span class="badge {{$status_class}}">{{$invoices->status}}</span>
                </td>
                <td>
                  <?php
                    
                    $inv_total_amount=$invoices->invoice_total_amount+$invoices->other_charges;
                    echo $inv_total_amount;
                    ?>
                </td>
                <td>@if($invoices->uploaded_receipt) <a href="{{asset($invoices->uploaded_receipt)}}"> view </a>  @endif</td>
                <td>
                  {{-- <a href="{{ url('admin/invoice-form-edit/'.$invoices->id) }}" class="btn btn-xs btn-icon btn-inverse btn-round" data-toggle="tooltip" data-original-title="Edit" >
                    <i class="icon wb-pencil" aria-hidden="true"></i>
                  </a> --}}
                  <a href="#" class="btn btn-xs btn-icon btn-inverse btn-round btn-approve-invoice" data-toggle="tooltip" data-original-title="Approve" data-invdetails="{{json_encode($invoices)}}">
                    <i class="icon wb-payment" aria-hidden="true"> </i>
                    
                  </a>
                  {{--
                  <a href="{{ url('admin/invoice-delete/'.$invoices->id) }}" class="delete-record btn btn-xs btn-icon btn-inverse btn-round" data-toggle="tooltip" data-original-title="Delete" >
                    <i class="icon wb-trash" aria-hidden="true"></i>
                    
                  </a>
                  --}}
                  {{-- <a href="#" class="btn btn-xs btn-icon btn-inverse btn-round" data-toggle="tooltip" data-original-title="Approve" >
                    <i class="icon wb-pencil" aria-hidden="true"> </i>
                    
                  </a>
                   --}}
                
                </td>
              </tr>
              @endforeach
            </tbody>
          </table>
          
          <div class="float-right">
            {{-- {{ $invoices->appends(['search' => Request::input('search')])->links() }} --}}
          </div>
          
          
        </div>
      </div>
      <!-- End Panel Basic -->
</div>
          <div class="modal" id="approveModel">
            <div class="modal-dialog ">
              <div class="modal-content">

                <!-- Modal Header -->
                <div class="modal-header">
                  <!-- <h4 class="modal-title">Invoice</h4> -->
                  <!-- <button type="button" class="btn btn-danger close" data-dismiss="modal">Close</button> -->
                  <button type="button" class="close" data-dismiss="modal" style="background-color:red;color:white;">&nbsp; &times; &nbsp;</button>
                </div>

                <!-- Modal body -->
                <div class="modal-body ">
                      <div class="invoice_section"> </div>
                </div>

                <!-- Modal footer -->
                <div class="modal-footer">
                  <button type="button" class="btn btn-danger  for-screen" data-dismiss="modal">Close</button>
                  <a class="btn bg-white btn-light mx-1px text-95 for-screen" href="#" data-title="Print" id="printButton" >
                    <i class="mr-1 fa fa-print text-primary-m1 text-120 w-2"></i>
                    Print
                </a>
                <form action="{{route('admin.invoice.makeReceipt')}}" method="POST" >
                  @csrf
                      <input type="hidden" name="invoice_id" id="receipt_invoice_id" >
                      <button class="btn btn-success  for-screen"  id="makeReceiptButton" >
                        {{-- <i class="mr-1 fa fa-print text-primary-m1 text-120 w-2"></i> --}}
                        Make Receipt
                      </button>
                </form>
                </div>

              </div>
            </div>
          </div>

@endsection

@section('javascript')
<script type="text/javascript">
  
    $(document).ready(function()
    { 
      $("#printButton").click(function(){
            window.print();
        });

      $(document).on('click','.btn-approve-invoice',function(){
        var invDeatils=$(this).data('invdetails');
        $('#receipt_invoice_id').val(invDeatils.id);  
        if(invDeatils.status=='paid')
        {
          $("#makeReceiptButton").hide();
          
        }
        else
        {
          $("#makeReceiptButton").show();

        }
        
        console.log(invDeatils);
        var html=` <div class="container px-0">
        <div class="row mt-4">
            <div class="col-12 col-lg-12">
                 <div class="row">
                    <div class="col-12">
                        <div class="text-center text-150">
                            <!-- <i class="fa fa-book fa-2x text-success-m2 mr-1"></i> -->
                            <img src=" {{asset('frontend/img/learning.png') }}" width="100Px;" height="100%"><br/>
                            <!-- <span class="text-default-d3 mt-3">env('APP_NAME')</span> -->
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
                                Reg# :  GCA/Reg/`+invDeatils.user.id+` 
                            </div>
                            <div class="my-1">
                                Name :  `+invDeatils.user.first_name+` 
                            </div>
                            <div class="my-1">
                                Email :  `+invDeatils.user.email+` 
                            </div>
                            
                            
                        </div>
                    </div>
                    <!-- /.col -->

                    <div class="text-95 col-sm-6 align-self-start d-sm-flex justify-content-end">
                        <hr class="d-sm-none" />
                        <div class="text-grey-m2">
                            <div class="mt-1 mb-2 text-secondary-m1 text-600 text-125">
                                Invoice
                            </div>

                            <div class="my-2"><i class="fa fa-circle text-blue-m2 text-xs mr-1"></i> <span class="text-600 text-90">INV No :</span> <b>`+invDeatils.id+` </b></div>

                            <div class="my-2"><i class="fa fa-circle text-blue-m2 text-xs mr-1"></i> <span class="text-600 text-90">Issue Date:</span>`+invDeatils.created_at.substr(0, 10)+`</div>

                            <div class="my-2"><i class="fa fa-circle text-blue-m2 text-xs mr-1"></i> <span class="text-600 text-90">Status:</span>`; 
                            if(invDeatils.status=='un-paid')
                             html+=`<span class="badge  badge-danger   badge-pill px-25">`+invDeatils.status+`</span></div>`;
                            else
                              html+=`<span class="badge badge-success   badge-pill px-25">`+invDeatils.status+`</span></div>`;
                         
                            html+=`
                            </div>
                    </div>
                    <!-- /.col -->
                </div>

                <div class="mt-4">
                    <div class="row text-600 text-white bgc-default-tp1 py-25 bg-success">
                        <div class="d-none d-sm-block col-1">#</div>
                        <div class="col-9 col-sm-5">Group</div>
                         <div class="d-none d-sm-block col-4 col-sm-4">Subject</div> 
                         
                         <div class="d-none d-sm-block col-sm-2">Price</div>
                    </div>

                    <div class="text-95 text-secondary-d3">`;
                    var total_price=0;
                    $.each(invDeatils.invoice_detil, function(i, item) {
                      
                      // console.log(item.category.master_category);
                      total_price+=parseFloat(item.price*item.qty);
                      if(item.fee_type=='test')
                      {
                        html+=` <div class="row mb-2 mb-sm-0 py-25">
                          <div class="d-none d-sm-block col-1">`+ (i+1) +`</div>
                            <div class="col-9 col-sm-5">QCA</div>
                            <div class="col-4 text-secondary-d2">Test (`+item.qty+` * `+item.price+`)</div>
                            <div class="d-none d-sm-block col-2 text-95">`+(item.price*item.qty)+`</div>
                            </div>`;
                          
                      }
                      else
                      
                      {

                        html+=` <div class="row mb-2 mb-sm-0 py-25">
                          <div class="d-none d-sm-block col-1">`+ (i+1) +`</div>
                            <div class="col-9 col-sm-5">`+item.category.master_category.name+` - `+item.groups.name+`</div>
                            <div class="col-4 text-secondary-d2">`+item.course.master_course.course_title+`</div>
                            <div class="d-none d-sm-block col-2 text-95">`+item.price+`</div>
                            </div>`;
                          
                          
                        }
                    });
                       

                       

                       
                   html+=` </div>
                   <hr/>
                   <div class="row text-600  bgc-default-tp1 py-25">
                        <div class="d-none d-sm-block col-1"></div>
                        <div class="col-9 col-sm-5"></div>
                       
                         <div class="col-4"><b>Total Amount</b></div>
                         <div class="d-none d-sm-block col-sm-2"><b>Rs:  `+total_price+`</b></div>
                    </div>

                    <div class="row text-600  bgc-default-tp1 py-25">
                        <div class="d-none d-sm-block col-1"></div>
                        <div class="col-9 col-sm-5"></div>
                       
                         <div class="col-4"><b>Other Charges</b></div>
                         <div class="d-none d-sm-block col-sm-2"><b>Rs:  `+invDeatils.other_charges+`</b></div>
                    </div>

                    <div class="row text-600  bgc-default-tp1 py-25">
                        <div class="d-none d-sm-block col-1"></div>
                        <div class="col-9 col-sm-5"></div>
                       
                         <div class="col-4"><b>Payable Amount</b></div>
                         <div class="d-none d-sm-block col-sm-2"><b>Rs:  `+(total_price+invDeatils.other_charges)+`</b></div>
                    </div>
                    <div class="row border-b-2 brc-default-l2"></div>
                    <hr />
                    <div>
                        <span class="text-secondary-d1 text-105">Thank you for using our service</span>
                      
                      
                        
                    </div>
                </div>
            </div>
        </div>
    </div>`
             
                    $('#approveModel').modal('show');
                    $('.invoice_section').empty();
                    $('.invoice_section').append(html);
                      // if(response.success=='true')
                      // message('success',response.message);
                      // else0
                      // message('error',response.message);

                      // swal()
                 
      });
      

    });
</script>
@endsection