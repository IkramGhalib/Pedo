@include('admin.report.partial.head')


<table class="printTable">
  <tr class="top-row">
    <td colspan="10"> <img src="{{asset(env('LOGO'))}}" width="100px;" height="100px;"></td>
  </tr>
  <tr class="top-row">
    <td colspan="10"> <h4> <u>Reading Report </u></h4></td>
  </tr>
  <tr class="top-row">
    <td colspan="10"> <b>{{app_month_format($fields['month'])}}</b></td>
  </tr>
  @if($fields['unit'])
  <tr class="titleTr">
    <td class="titleTd" colspan='3'>   Condition:  {{'Units '.$fields['condition'].' '.$fields['unit']}} 
    </td>
    <!-- <td class="titleTd col4 text-right" colspan=2>Reporting Period</td> -->
    <td class="titleTd col4 text-right" colspan='1'></td>
  </tr>
  @endif 
  <tr class="headingTr">
    <td class="headingTd ">#</td>
    <td class="headingTd ">Refrence No</td>

    <td class="headingTd ">Prev.Reading </td>
    <td class="headingTd ">Cur.Reading </td>
    {{-- <td class="headingTd ">PAID FROM</td> --}}
    <td class="headingTd  text-right">Units</td>
  </tr>
  <?php $c=1; 
  $total=0;
?>
  @foreach ($record as $k => $row )
    
  

  <tr>
    <td class="">{{$c}}</td>
    <td class="">{{$row->bConsumerMeter->ref_no}}</td>
    {{-- <td class="">{{$row->bConsumerMeter->bConsumer->full_name}}</td> --}}
    {{-- <td class="">{{app_month_format($row->month_year)}}</td> --}}
    {{-- <td class=""> {{$row->offpeak_units}}</td> --}}
    <td >{{$row->offpeak_prev}}</td>
    <td >{{$row->offpeak}}</td>
    <td class=" text-right">{{$row->offpeak_units}}</td>
  </tr>
  <?php $c++; $total+=$row->offpeak_units ?>
  @endforeach
  
 

  <tr class="headingTr">
    <td class="headingTd " colspan="3"></td>
    <td class="headingTd  text-right">TOTAL</td>
    <td class="headingTd  text-right">
      <?= $total ?></td>
  </tr>
  
</table>
@include('admin.report.partial.footer')