@include('admin.report.partial.head')

<table class="printTable">
<tr class="top-row">
  <td colspan="9"> <img src="{{asset(env('LOGO'))}}" width="100px;" height="100px;"></td>
</tr>
<tr class="top-row">
  <td colspan="9"> <h4> <u>Consumer  Report </u></h4></td>
</tr>

</table>
@if($record)
<table class="printTable">
  <tr class="titleTr">
    {{-- <td class="titleTd" colspan='3'> @if($fields) Report Type:  {{$fields}} @endif <br/>
    </td> --}}

    <td class="titleTd" colspan='3'> 
    </td>
    <!-- <td class="titleTd col4 text-right" colspan=2>Reporting Period</td> -->
    <td class="titleTd col4 text-right" colspan='1'></td>
  </tr>
  <tr class="subtitleTr">
    <td class="titleTd" colspan=2 >  
      <table class="inner-table">
        <tr><td colspan="2"><b> PERSONAL INFO </b></td></tr>
        <tr>
          <td> Consumer Name </td>
          <td>:  {{$record->full_name}}</td>
        </tr>

        <tr>
          <td> FName </td>
          <td>:  {{$record->father_name}}</td>
        </tr>

        <tr>
          <td> CNIC </td>
          <td>:  {{$record->cnic}}</td>
        </tr>

        <tr>
          <td> Mobile </td>
          <td>:  {{$record->mobile}}</td>
        </tr>

        <tr>
          <td> C-Status </td>
          <td>:  {{$record->status}}</td>
        </tr>
        

      </table>

      
    </td>
    <td class="titleTd" colspan=2 >
      <table class="inner-table"  >
        <tr><td colspan="2"><b> LOCATION INFO </b></td></tr>
        <tr>
          <td> Category </td>
          <td>:  {{$record->bConsumerCategory->name}}</td>
        </tr>
        <tr>
          <td> Divison </td>
          <td>:  {{$record->bFeeder->bSubDivision->bDivision->division_code}} -{{$record->bFeeder->bSubDivision->bDivision->name}}</td>
        </tr>

        <tr>
          <td> Sub Division </td>
          <td>:  {{$record->bFeeder->bSubDivision->sub_division_code}} -{{$record->bFeeder->bSubDivision->name}}</td>
        </tr>

        <tr>
          <td> Feeder </td>
          <td>:  {{$record->bFeeder->feeder_code}} -{{$record->bFeeder->name}}</td>
        </tr>

        <tr>
          <td> Address </td>
          <td>: 
            {{$record->address}}
          </td>
        </tr>

        {{-- <tr style="border:1px solid white;">
          <td style="border:1px solid white;"> &nbsp; </td>
          <td style="border:1px solid white;">  &nbsp;</td>
        </tr> --}}

      </table>
    </td>
    <td class="titleTd" colspan=2 >
      <table class="inner-table"  >
        <tr><td colspan="2"><b> METER INFO </b></td></tr>
        <tr>
          <td> Ref No </td>
          <td>:  {{$record->meters[0]->ref_no}}</td>
        </tr>
        <tr>
          <td> Meter No </td>
          <td>:  {{$record->meters[0]->meter_no}}</td>
        </tr>

        <tr>
          <td> Consumer No </td>
          <td>:  {{$record->meters[0]->consumer_id}}</td>
        </tr>

        <tr>
          <td> Connection Date </td>
          <td>:  {{$record->meters[0]->connection_date}}</td>
        </tr>

        <tr>
          <td> Defination Date </td>
          <td>: 
            {{$record->meters[0]->definition_date}}
          </td>
        </tr>

        {{-- <tr style="border:1px solid white;">
          <td style="border:1px solid white;"> &nbsp; </td>
          <td style="border:1px solid white;">  &nbsp;</td>
        </tr> --}}

      </table>
    </td>
    {{-- <td class="titleTd col1" colspan=2>:  ss</td> --}}
    {{-- <td class="titleTd col4" colspan=2> &nbsp;  &nbsp; ff </td> --}}
  </tr>
</table>
  <table class="printTable" style="margin-top:15px !important;">

    {{-- <tr></tr> --}}
    
    <tr class="headingTr" >
    <td class="text-center strong"  colspan="10"> CONSUMER BILLS</td>
    </tr>
    <tr class="headingTr">
      <td class="headingTd ">#</td>
      <td class="headingTd ">Bill No</td>
      <td class="headingTd ">Bill Month</td>
      <td class="headingTd ">Bill Gen Category</td>
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
            
            $b=1; 
            $p=1; 
            $btotal=0;
            $ptotal=0;
    ?>
    {{-- @foreach ($record as $k => $row ) --}}

    @foreach ($record->meters[0]->hManyBills as $k => $row )
    <tr>
      <td class="">{{$b}}</td>
      <td class="">{{$row->id}}</td>
      <td class="">{{app_month_format($row->bBillGenerate->month_year)}}</td>
      <td class="">{{$row->hOSubCategory->name}}</td>
      <td class="">{{$row->net_bill}}</td>
      <td class="">{{$row->arrears}}</td>
      <td class="">{{$row->adjustment}}</td>
      <td class="">{{$row->WithinDuedate}}</td>
      <td class="">{{$row->l_p_surcharge}}</td>
      <td class="">{{$row->AfterdueDate}}</td>
    </tr>
    <?php $b++;  $n_b_total+=$row->net_bill;$l_p_total+=$row->l_p_surcharge;$a_total+=$row->arrears; $wd_total+=$row->WithinDuedate;  $ad_total+=$row->AfterdueDate; $t_adjustment+=$row->adjustment;?>
    @endforeach
    <tr class="headingTr">
      <td class="headingTd " colspan=3></td>
      <td class="headingTd  ">TOTAL</td>
      <td class="headingTd  "> <?= $n_b_total ?></td>
    
      <td class="headingTd  "> <?= $a_total ?></td>
      <td class="headingTd  "> <?= $t_adjustment ?></td>
      <td class="headingTd  "> <?= $wd_total ?></td>
      <td class="headingTd  "> <?= $l_p_total ?></td>
      <td class="headingTd  "><?= $ad_total ?></td>
    </tr>
  
  
 
  </table>
<table class="printTable" style="margin-top:15px;">

      
      <tr class="headingTr">
      <td class="text-center strong" colspan="6"> CONSUMER PAYMENTS</td>
      </tr>
      <tr class="headingTr">
        <td class="headingTd col1">#</td>
        <td class="headingTd ">Bill No</td>
        <td class="headingTd col2">Month </td>
        <td class="headingTd col2">Payment Date </td> 
        <td class="headingTd col1">Bank</td> 
        <td class="headingTd col4 ">Amount</td>
      </tr>
      
      @foreach ($record->meters[0]->hManyPayments as $k => $row2 )
      <tr>
        <td class="col1">{{$p}}</td>
        <td class="col1 ">{{$row2->bConsumerBill->id}}</td>
        <td class="col2">{{app_month_format($row2->payment_month)}}</td>
        <td class="col2"> {{$row2->payment_date}}</td> 
        <td class="col1"> {{$row2->bBank->code.' - '.$row2->bBank->title}}</td> 
        <td class="col1">{{$row2->payment_amount}}</td>
      </tr>
      
      <?php $p++; $ptotal+=$row2->payment_amount; ?>
      @endforeach
      <tr class="headingTr">
        <td class="headingTd col1" colspan="4"></td>
        <td class="headingTd col3 text-right">TOTAL</td>
        <td class="headingTd col4">
          <?= $ptotal ?></td>
      </tr>
  
</table>
  @else
    <p style="color:red"> Record Not Found</p>
  @endif

  @include('admin.report.partial.footer')