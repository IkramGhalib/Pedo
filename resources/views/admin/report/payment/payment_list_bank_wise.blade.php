@include('admin.report.partial.head')
<table class="printTable">
  <tr class="top-row">
    <td colspan="12"> <img src="{{asset(env('LOGO'))}}" width="100px;" height="100px;"></td>
  </tr>
  <tr class="top-row">
    <td colspan="12"> <h4> <u>Payments Report(Bank Wise) </u></h4></td>
  </tr>
  <tr class="top-row">
    <td colspan="12"> <b>{{app_month_format($fields['month'])}}</b></td>
  </tr>
 
  {{-- <tr class="subtitleTr">
    <td class="titleTd col1" colspan=2></td>
    <td class="titleTd col4 text-right" colspan=2> &nbsp;  &nbsp; </td>
  </tr>

  <tr></tr> --}}

 
  <tr class="headingTr">
    <td class="headingTd col1">#</td>
    <td class="headingTd col2">Refrence No</td>
    <td class="headingTd col2">Tarrif Category</td>
    {{-- <td class="headingTd col3">Month </td> --}}
     <td class="headingTd col1">Payment Date </td> 
     <td class="headingTd col3">Bank</td> 
     <td class="headingTd col1">Page No</td> 
    <td class="headingTd col1 text-right">Paid Amount</td>
  </tr>
  <?php $c=1; 
  $total=0;
  $page=0;
  $pageTotal=0;
?>
  @foreach ($record as $k => $row )
         @php $banks=0; @endphp
        
        @if(!$row->hMPaymentReceive->isEmpty())
       
           
        <tr>
          <td></td>
          <td class="col1" colspan="6"> <b> {{$row->code.' - '.$row->title}}</b></td>
        </tr>
            @foreach ($row->hMPaymentReceive as $k2 => $row2 )
            @php
             $pageTotal+=$row2->payment_amount;
            if($page==0) // if first iteration of loop
            {
              if($page!=$row2->page_no) // on first iteration of loop just change page no
                      $page=$row2->page_no;
            }
            else {

              if($page!=$row2->page_no) // if its not first iteration and page no it not same with iteration page no. means page changed and show page total
                  {
                      $pageTotal+=(-$row2->payment_amount);
                      echo "<tr style='font-weight:bold'><td></td><td class='col1 ' colspan='5'> Page ".$page." Total </td> <td class='text-right'> ".$pageTotal." </td></tr>";
                      $page=$row2->page_no;
                      $pageTotal=0;
                      $pageTotal+=$row2->payment_amount;
                  }
             
            
            }
                 
          @endphp
            <tr>
                  <td class="col1">{{$c}}</td>
                  <td class="col2">{{$row2->bConsumerMeter->ref_no}}</td>
                  <td class="col2">{{$row2->bConsumerBill->hOSubCategory->name}}</td>
                 
                  {{-- <td class="col3">{{app_month_format($row->payment_month)}}</td> --}}
                  <td class="col1"> {{$row2->payment_date}}</td> 
                  <td class="col1"> {{$row->title}} </td> 
                  <td class="col1"> {{$row2->page_no}}</td> 
                  <td class="col1 text-right">{{$row2->payment_amount}}</td>
                </tr>
                <?php  $banks+=$row2->payment_amount ?>
                <?php  $total+=$row2->payment_amount ?>
                <?php $c++;  ?>


            @php
               if($loop->last) // if loop last then also show page total beacuse there is no futher entry for page no  change 
              {
                      echo "<tr style='font-weight:bold'><td></td><td class='col1 ' colspan='5'> Page ".$page." Total </td> <td class='text-right'> ".$pageTotal." </td></tr>";
                      $pageTotal=0;
              }
            @endphp    
            @endforeach
            <tr class="headingTr">
              <td class="headingTd col1" colspan="5"></td>
              <td class="headingTd col3 text-right">Bank Total </td>
              <td class="headingTd col4 text-right">
                <?= $banks ?></td>
            </tr>
        @endif
    
   
    @endforeach
  
 

  <tr class="headingTr">
    <td class="headingTd col1" colspan="5"></td>
    <td class="headingTd col3 text-right"><b>TOTAL</b></td>
    <td class="headingTd col4 text-right">
    <b>  <?= $total ?></b></td>
  </tr>
  
</table>
@include('admin.report.partial.footer')