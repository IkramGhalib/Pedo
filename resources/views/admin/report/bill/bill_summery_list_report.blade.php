@include('admin.report.partial.head')
<div class="header">

</div>

<table class="printTable">
  <tr class="top-row">
    <td colspan="9"> <img src="{{asset(env('LOGO'))}}" width="100px;" height="100px;"></td>
  </tr>
  <tr class="top-row">
    <td colspan="9"> <h4> <u>Bill Summery list </u></h4></td>
  </tr>
  <tr class="top-row">
    <td colspan="9"> <b>{{app_month_format($fields['month'])}} </b></td>
  </tr>
  <tr class="titleTr">
    <td class="titleTd" colspan='3'> @if($fields['start_refrence'] && $fields['end_refrence'])  Condition:  {{'Refrence '.$fields['start_refrence'].' To '.$fields['end_refrence']}} @endif <br/>
    </td>
    <!-- <td class="titleTd col4 text-right" colspan=2>Reporting Period</td> -->
    <td class="titleTd col4 text-right" colspan='1'></td>
  </tr>
  <tr class="headingTr">
    <td class="headingTd ">#</td>
    <td class="headingTd ">Refrence No</td>
    <td class="headingTd ">Consumer Name</td>
   
    <td class="headingTd">Amount </td>
    <td class="headingTd">Due Date</td>
    <td class="headingTd">Amount after Due Date </td>
  </tr>
  <?php $c=1; 
  $WithinDuedate_total=0;
  $AfterdueDate_total=0;
  
?>
  @foreach ($record as $k => $row )
    
  

  <tr>
    <td class="">{{$c}}</td>
    <td class="">{{$row->bConsumerMeter->ref_no}}</td>
    <td class="">{{$row->bConsumerMeter->bConsumer->full_name}}</td>
    {{-- <td class="">{{$row->hOSubCategory->name}}</td> --}}
    {{-- <td class="">{{app_month_format($row->billing_month_year)}}</td> --}}
    {{-- <td class=""> {{$row->offpeak_units}}</td> --}}

    {{-- <td class="">{{$row->net_bill}}</td> --}}
   
    <td class="">{{$row->WithinDuedate}}</td>
    <td class="">{{$row->bBillGenerate->due_date}}</td>

    <td class="">{{$row->AfterdueDate}}</td>
  </tr>
  <?php $c++;  $WithinDuedate_total+=$row->WithinDuedate;  $AfterdueDate_total+=$row->AfterdueDate; ?>
  @endforeach
  <tr class="headingTr">
    <td class="headingTd " colspan="2"></td>
    <td class="headingTd  ">TOTAL</td>
    <td class="headingTd  "> <?= $WithinDuedate_total ?></td>
    <td class="headingTd  "> </td>
   
    <td class="headingTd  "><?= $AfterdueDate_total ?></td>
  </tr>
  
</table>
@include('admin.report.partial.footer')