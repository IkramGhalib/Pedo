@include('admin.report.partial.head')
<table class="printTable">
  <tr class="top-row">
    <td colspan="10"> <img src="{{asset(env('LOGO'))}}" width="100px;" height="100px;"></td>
  </tr>
  <tr class="top-row">
    <td colspan="10"> <h4> <u>Reading Report (Reader Wise) </u></h4></td>
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
    {{-- <td class="headingTd ">Month </td> --}}
    <td class="headingTd ">Consumer Name </td>
    <td class="headingTd ">Feeder</td>
    <td class="headingTd ">Prev.Reading </td>
    <td class="headingTd ">Cur.Reading </td>
    {{-- <td class="headingTd ">PAID FROM</td> --}}
    <td class="headingTd  text-right">Units</td>
  </tr>
  <?php         $c=1; 
               $gtotal=0;
  
    ?>
  @foreach ($record as $k => $row )
       @php $total=0; @endphp
      @if(!$row->hManyReading->isEmpty())
              <tr>
                <td colspan="7"><b>Reader Name: {{$row->first_name}}</b></td>
              </tr>
                @foreach ($row->hManyReading as $rk => $rrow )
                    {{-- @if ($rrow->id== $row->add_by) --}}
                        <tr>
                          <td class="">{{$c}}</td>
                          <td class="">{{$rrow->bConsumerMeter->ref_no}}</td>
                          <td class="">{{$rrow->bConsumerMeter->bConsumer->full_name}}</td>
                          <td class="">{{$rrow->bConsumerMeter->bConsumer->bFeeder->name}}</td>
                          {{-- <td class="">{{app_month_format($row->month_year)}}</td> --}}
                          {{-- <td class=""> {{$row->offpeak_units}}</td> --}}
                          <td >{{$rrow->offpeak_prev}}</td>
                          <td >{{$rrow->offpeak}}</td>
                          <td class=" text-right">{{$rrow->offpeak_units}}</td>
                        </tr>
                        
                        <?php $c++; $total+=$rrow->offpeak_units ?>
                    {{-- @endif --}}
                @endforeach
                <tr>
                  <td colspan="7" class="text-right"><b>Total : {{$total+=$rrow->offpeak_units}}</b></td>
                </tr>
      @endif          
  @endforeach
  <tr class="headingTr">
    <td class="headingTd " colspan="5"></td>
    <td class="headingTd  text-right">TOTAL</td>
    <td class="headingTd  text-right">
      <?= $gtotal ?></td>
  </tr>
  
</table>
@include('admin.report.partial.footer')