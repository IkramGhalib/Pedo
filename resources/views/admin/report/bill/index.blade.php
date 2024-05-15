@include('admin.report.partial.head')
<div class="header">
{{-- <p><img src="{{asset(env('LOGO'))}}" width="100px;" height="100px;"></p> --}}
  {{-- <p>Bill Report</p>
  <p style="font-size:18px !important;">{{app_month_format($fields['month'])}}</p> --}}
</div>

<table class="printTable" id="printTable">
  <tr class="top-row">
    <td colspan="9"> <img src="{{asset(env('LOGO'))}}" width="100px;" height="100px;"></td>
  </tr>
  <tr class="top-row">
    <td colspan="9"> <h4> <u>Bill Report </u></h4></td>
  </tr>
  <tr class="top-row">
    <td colspan="9"> <b>{{app_month_format($fields['month'])}} </b></td>
  </tr>
  <tr class="titleTr">
    <td class="titleTd" colspan='6'> @if($fields['start_refrence'] && $fields['end_refrence'])  Condition:  {{'Refrence '.$fields['start_refrence'].' To '.$fields['end_refrence']}} @endif <br/>
    </td>
    <!-- <td class="titleTd col4 text-right" colspan=2>Reporting Period</td> -->
    <td class="titleTd col4 text-right" colspan='1'></td>
  </tr>
  


  
  <tr class="headingTr">
    <td class="headingTd ">#</td>
    <td class="headingTd ">Refrence No</td>
    <td class="headingTd ">Bill Gen Category</td>
    {{-- <td class="headingTd ">Month </td> --}}
    {{-- <td class="headingTd ">PAID FROM</td> --}}
    <td class="headingTd">c.bill</td>
   
    <td class="headingTd">Arear</td>
    <td class="headingTd">Adjustment</td>
    <td class="headingTd">Amount </td>
    <td class="headingTd">l.p.surchage</td>
    <td class="headingTd">Amount after Due Date </td>
  </tr>
  <?php $c=1; 
  $n_b_total=0;
  $l_p_total=0;
  $a_total=0;
  $wd_total=0;
  $ad_total=0;
  $t_adjustment=0;
?>
  @foreach ($record as $k => $row )
    
  

  <tr>
    <td class="">{{$c}}</td>
    <td class="">{{$row->bConsumerMeter->ref_no}}</td>
    <td class="">{{$row->hOSubCategory->name}}</td>
    {{-- <td class="">{{app_month_format($row->billing_month_year)}}</td> --}}
    {{-- <td class=""> {{$row->offpeak_units}}</td> --}}

    <td class="">{{$row->net_bill}}</td>
   
    <td class="">{{$row->arrears}}</td>
    <td class="">{{$row->adjustment}}</td>
    <td class="">{{$row->WithinDuedate}}</td>
    <td class="">{{$row->l_p_surcharge}}</td>
    <td class="">{{$row->AfterdueDate}}</td>
  </tr>
  <?php $c++;  $n_b_total+=$row->net_bill;$l_p_total+=$row->l_p_surcharge;$a_total+=$row->arrears; $wd_total+=$row->WithinDuedate;  $ad_total+=$row->AfterdueDate; $t_adjustment+=$row->adjustment;?>
  @endforeach
  <tr class="headingTr">
    <td class="headingTd " colspan="2"></td>
    <td class="headingTd  ">TOTAL</td>
    <td class="headingTd  "> <?= $n_b_total ?></td>
   
    <td class="headingTd  "> <?= $a_total ?></td>
    <td class="headingTd  "> <?= $t_adjustment ?></td>
    <td class="headingTd  "> <?= $wd_total ?></td>
    <td class="headingTd  "> <?= $l_p_total ?></td>
    <td class="headingTd  "><?= $ad_total ?></td>
  </tr>
  
</table>
@include('admin.report.partial.footer')