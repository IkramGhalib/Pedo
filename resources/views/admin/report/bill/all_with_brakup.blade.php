@include('admin.report.partial.head')
<div class="header">

</div>

<table class="printTable">
  <tr class="top-row">
    <td colspan="17"> <img src="{{asset(env('LOGO'))}}" width="100px;" height="100px;"></td>
  </tr>
  <tr class="top-row">
    <td colspan="17"> <h4> <u>Billing Total Assesment (With All Breakup)</u></h4></td>
  </tr>
  <tr class="top-row">
    <td colspan="17"> <b>{{app_month_format($fields['month'])}} </b></td>
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
    <td class="headingTd ">Tarrif</td>
    <td class="headingTd ">Tarrif Category</td>
    <td class="headingTd ">Units </td>
    <td class="headingTd ">E.cost </td>
    {{-- <td class="headingTd ">PAID FROM</td> --}}
    <td class="headingTd">Arear</td>
    <td class="headingTd">Q.T Adjustment</td>
    <td class="headingTd">F.S Surcharge</td>
    <td class="headingTd">F.P.A</td>
    <td class="headingTd">E.D</td>
    <td class="headingTd">E.D on FPA	</td>
    {{-- <td class="headingTd">	</td> --}}
    {{-- <td class="headingTd">c.bill</td> --}}
   {{-- @foreach ($charges_types as $ctkey => $ctrow )
   <td class="headingTd">{{$ctrow->title}}</td>
   @endforeach --}}

   {{-- @foreach ($tax_types as $ttkey => $ttrow )
   <td class="headingTd">{{$ttrow->title}}</td>
   @endforeach --}}
    {{-- <td class="headingTd">Amount </td> --}}
    {{-- <td class="headingTd">l.p.surchage</td> --}}
    <td class="headingTd"> S.Charg</td>
    <td class="headingTd"> Adjustment</td>
    <td class="headingTd"> Amount</td>

    <td class="headingTd"> L.P.Charg</td>
    <td class="headingTd">Amount after Due Date </td>
  </tr>
  <?php $c=1; 
  $n_b_total=0;
  $l_p_total=0;
  $a_total=0;
  $sur_total=0;
  $adj_total=0;
  $wd_total=0;
  $af_total=0;
  $u_total=0;

  $ed_total=0;
  $fpa_total=0;
  $ed_fpa_total=0;

  $f_s_sur_total=0;
  $q_t_total=0;
  
?>
  @foreach ($record as $k => $row )
    
  

  <tr>
    <td class="">{{$c}}</td>
    <td class="">{{$row->bConsumerMeter->ref_no}}</td>
    <td class="">{{$row->tarrif_code}}</td>
    <td class="">{{$row->hOSubCategory->name}}</td>
    <td class="">{{$row->offpeak_units}}</td>
    <td class="">{{$row->currentbill}}</td>
    {{-- <td class="">{{app_month_format($row->billing_month_year)}}</td> --}}
    {{-- <td class=""> {{$row->offpeak_units}}</td> --}}
    
    <td class="">{{$row->arrears}}</td>
    {{--  changes breakup start here  --}}
    @php 
        $charges_breakup=json_decode($row->charges_breakup);
        $qtrta=0;
        $fssurcharge=0;
        // $l.psurcharge=0;
    @endphp
    @foreach ($charges_breakup as $ck => $crow )
            @if($crow->code=='QTRTA')
            @php $qtrta=$crow->calculated_charges; 
              $q_t_total+=$qtrta;
            @endphp
            @endif

            @if($crow->charges_type=='F.S Surcharge')
            @php $fssurcharge=$crow->calculated_charges; 
            
            $f_s_sur_total+=$fssurcharge;
            @endphp
            @endif
    @endforeach
          
          <td class="">{{$qtrta}}</td>
          <td class="">{{$fssurcharge}}</td>

    {{-- changes breakup end  --}}
    {{-- taxes breakup start --}}
    @php 
      $tax_breakup=json_decode($row->taxes_breakup);
       $fpa=0;
       $ed=0;
       $edfpa=0;
    @endphp
    
    @foreach ( $tax_breakup as $tk => $trow )
           @if($trow->code=='FPA')
               @php $fpa= $trow->calculated_tax;
                    $fpa_total+=$fpa;
               @endphp
            @endif

            @if($trow->code=='ED')
              @php $ed= $trow->calculated_tax; 
              $ed_total+=$ed;
              @endphp
            @endif

            @if($trow->code=='EDFPA')
                 @php $edfpa=$trow->calculated_tax;
                      $fpa_total+=$edfpa;
                  @endphp
            @endif
   
    @endforeach
    
    <td class="">{{$fpa}}</td>
    <td class="">{{$ed}}</td>
    <td class="">{{$edfpa}}</td>
    {{-- taxes breakup end  --}}
      
    {{-- <td class="">{{$row->net_bill}}</td> --}}
   
    <td class="">{{$row->service_charges}}</td>
    <td class="">{{$row->adjustment}}</td>
    <td class="">{{$row->WithinDuedate}}</td>

    <td class="">{{$row->l_p_surcharge}}</td>
    <td class="">{{$row->AfterdueDate}}</td>
  </tr>
  <?php $c++;  
                $u_total+=$row->offpeak_units;
                $n_b_total+=$row->currentbill;
                $a_total+=$row->arrears; 
                $sur_total+=$row->service_charges; 
                $adj_total+=$row->adjustment; 
                $wd_total+=$row->WithinDuedate; 
                $l_p_total+=$row->l_p_surcharge;
                $af_total+=$row->AfterdueDate; ?>
  @endforeach
  <tr class="headingTr" style="font-weight:bold">
    <td class="headingTd " colspan="3"></td>
    <td class="headingTd  ">TOTAL</td>
    <td class="headingTd  ">  <?= $u_total ?></td>
    <td class="headingTd  "><?= $n_b_total ?></td>
   
    <td class="headingTd  "><?= $a_total ?></td>
    <td class="headingTd  "><?= $q_t_total ?></td>
    <td class="headingTd  "><?= $f_s_sur_total ?></td>
    <td class="headingTd  "> <?= $fpa_total ?></td>
    <td class="headingTd  "> <?= $ed_total ?></td>
    <td class="headingTd  "><?= $ed_fpa_total ?></td>
    <td class="headingTd  "> <?= $sur_total ?></td>
    <td class="headingTd  "><?= $adj_total ?></td>
    <td class="headingTd  "> <?= $wd_total ?></td>
    <td class="headingTd  "> <?= $l_p_total ?></td>
    <td class="headingTd  "> <?= $af_total ?></td>
  </tr>
  
</table>
@include('admin.report.partial.footer')