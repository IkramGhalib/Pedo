@include('admin.report.partial.head')
<table class="printTable">
  <tr class="top-row">
    <td colspan="10"> <img src="{{asset(env('LOGO'))}}" width="100px;" height="100px;"></td>
  </tr>
  <tr class="top-row">
    <td colspan="10"> <h4> <u>Payments Report </u></h4></td>
  </tr>
  <tr class="top-row">
    <td colspan="10"> <b>{{app_month_format($fields['month'])}}</b></td>
  </tr>
  

  
  <tr class="headingTr">
    <td class="headingTd col1">#</td>
    <td class="headingTd col2">Refrence No</td>
    <td class="headingTd col1">Month </td>
     <td class="headingTd col1">Payment Date </td> 
     <td class="headingTd col1">Bank</td> 
    <td class="headingTd col4 text-right">Amount</td>
  </tr>
  <?php $c=1; 
  $total=0;
?>
  @foreach ($record as $k => $row )
    
  

  <tr>
    <td class="col1">{{$c}}</td>
    <td class="col2">{{$row->bConsumerMeter->ref_no}}</td>
    <td class="col1">{{app_month_format($row->payment_month)}}</td>
    <td class="col1"> {{$row->payment_date}}</td> 
    <td class="col1"> {{$row->bBank->code.' - '.$row->bBank->title}}</td> 
    
    <td class="col1 text-right">{{$row->payment_amount}}</td>
  </tr>
  <?php $c++; $total+=$row->payment_amount ?>
  @endforeach
  
 

  <tr class="headingTr">
    <td class="headingTd col1" colspan="4"></td>
    <td class="headingTd col3 text-right">TOTAL</td>
    <td class="headingTd col4 text-right">
      <?= $total ?></td>
  </tr>
  
</table>
@include('admin.report.partial.footer')