@include('admin.report.partial.head')
<table class="printTable">
  <tr class="top-row">
    <td colspan="10"> <img src="{{asset(env('LOGO'))}}" width="100px;" height="100px;"></td>
  </tr>
  <tr class="top-row">
    <td colspan="10"> <h4> <u>Arear list Summary Report </u></h4></td>
  </tr>
  <tr class="top-row">
    <td colspan="10"> <b>{{app_month_format($fields['month'])}}</b></td>
  </tr>
  {{-- <tr class="titleTr">
    <td class="titleTd" colspan='3'>  <br/>
    </td>
    <!-- <td class="titleTd col4 text-right" colspan=2>Reporting Period</td> -->
    <td class="titleTd col4 text-right" colspan='1'></td>
  </tr>
  <tr class="subtitleTr">
    <td class="titleTd col1" colspan=2></td>
    <td class="titleTd col4 text-right" colspan=2> &nbsp;  &nbsp; </td>
  </tr>

  <tr></tr> --}}

  
  <tr class="headingTr">
    <td class="headingTd ">#</td>
    <td class="headingTd ">Refrence No</td>
    <td class="headingTd ">Consumer Name</td>
    <td class="headingTd ">Tarrif</td>
    <td class="headingTd ">Tarrif Category</td>
   
    <td class="headingTd">Total Arrear </td>
    {{-- <td class="headingTd">Due Date</td> --}}
    {{-- <td class="headingTd">Amount after Due Date </td> --}}
  </tr>
  <?php $c=1; 
  $total_lp=0;
  $total=0;
  $total_old_a=0; 
  $total_curr_a=0; 

  $pre_record_collect_list=collect($pre_record);

  $arrears=0;
  $consider_amount=0;
  $paid_amount=0;
  $net_bill=0;
  $adjustment=0;
  $service_charges=0;
  $l_p_surcharge=0;
  $IsPayed=0;
  
?>
  @foreach ($record as $k => $row )
      @php
        
        $pre_record_collect_row=$pre_record_collect_list->where('cm_id',$row->cm_id)->first();
        // dd($pre_record_collect_row);
        if($pre_record_collect_row)
        {
          $arrears=$pre_record_collect_row['arrears'];
          $consider_amount=$pre_record_collect_row['consider_amount'];
          $paid_amount=$pre_record_collect_row['paid_amount'];
          $net_bill=$pre_record_collect_row['net_bill'];
          $adjustment=$pre_record_collect_row['adjustment'];

          $service_charges=$pre_record_collect_row['service_charges'];
          $l_p_surcharge=$pre_record_collect_row['l_p_surcharge'];
          $IsPayed=$pre_record_collect_row['IsPayed'];
        }
        else {
          $arrears=0;
          $consider_amount=0;
          $paid_amount=0;
          $net_bill=0;
          $adjustment=0;
          $service_charges=0;
          $l_p_surcharge=0;

          $IsPayed=0;
        }
      @endphp
  <tr>
    <td class="">{{$c}}</td>
    <td class="">{{$row->bConsumerMeter->ref_no}}</td>
    <td class="">{{$row->bConsumerMeter->bConsumer->full_name}}</td>
    <td class="">{{$row->tarrif_code}}</td>
    <td class="">{{$row->hOSubCategory->name}}</td>
    
    <td class="">
      @if($IsPayed==1)
      {{$consider_amount-$paid_amount+$l_p_surcharge}}
      @else
      {{$l_p_surcharge+$arrears+$net_bill+$adjustment+$service_charges}}
      @endif
    </td>
  </tr>
  <?php $c++;   
                $total+=$l_p_surcharge+$arrears+$net_bill+$adjustment+$service_charges; 
                ?>
  @endforeach
  <tr class="headingTr">
    <td class="headingTd " colspan="4"></td>
    <td class="headingTd  "><b>TOTAL</b></td>
        <td class="headingTd  "> <b><?= $total ?></b></td>
   
   
    
  </tr>
  
</table>
@include('admin.report.partial.footer')