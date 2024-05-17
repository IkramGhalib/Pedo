@include('admin.report.partial.head')
<table class="printTable">
  <tr class="top-row">
    <td colspan="15"> <img src="{{asset(env('LOGO'))}}" width="100px;" height="100px;"></td>
  </tr>
  <tr class="top-row">
    <td colspan="15"> <h4> <u>Consumer  Report </u></h4></td>
  </tr>
  <tr class="titleTr">
    <td class="titleTd" colspan='8'> @if($fields) Report Type:  {{$fields}} @endif <br/>
    </td>
    <!-- <td class="titleTd col4 text-right" colspan=2>Reporting Period</td> -->
    <td class="titleTd col4 text-right" colspan='1'></td>
  </tr>
  <tr class="subtitleTr">
    <td class="titleTd col1" colspan=2></td>
    <td class="titleTd col4 text-right" colspan=2> &nbsp;  &nbsp; </td>
  </tr>
 
  <tr class="headingTr">
    <td class="headingTd ">#</td>
    <td class="headingTd ">Name</td>
    <td class="headingTd ">FName   </td>
    <td class="headingTd ">CNIC   </td>
    <td class="headingTd "> MOBILE  </td>
    {{-- <td class="headingTd col1">PAID FROM</td> --}}
    <td class="headingTd ">C-status</td>
    <td class="headingTd ">Category</td>
    <td class="headingTd ">Divison</td>
    <td class="headingTd ">Sub Division</td>
    <td class="headingTd ">Feeder</td>
    <td class="headingTd ">Address</td>

    <td class="headingTd ">Ref No</td>
    <td class="headingTd ">Meter No</td>
    <td class="headingTd ">Consumer No</td>
    <td class="headingTd ">Connec.Date</td>
    <td class="headingTd ">Def.Date</td>
  </tr>
  <?php $c=0; 
  $total=0;
?>
  @foreach ($record as $k => $row )
    
  
  <?php $c++;  ?>

  <tr>
    <td >{{$c}}</td>
    <td >{{$row->full_name}}</td>
    <td >{{$row->father_name}}</td>
    <td >{{$row->cnic}}</td>
    <td >{{$row->mobile}}</td>
    <td >{{$row->status}}</td>

    <td >{{$row->bConsumerCategory->name}}</td>
    <td >{{$row->bFeeder->bSubDivision->bDivision->division_code}} -{{$row->bFeeder->bSubDivision->bDivision->name}}</td>
    <td >{{$row->bFeeder->bSubDivision->sub_division_code}} -{{$row->bFeeder->bSubDivision->name}}</td>
    <td >{{$row->bFeeder->feeder_code}} -{{$row->bFeeder->name}}</td>
    <td >{{$row->address}}</td>

    <td >{{$row->meters[0]->ref_no}}</td>
    <td >{{$row->meters[0]->meter_no}}</td>
    <td >{{$row->meters[0]->consumer_id}}</td>
    <td >{{$row->meters[0]->connection_date}}</td>
    <td >{{$row->meters[0]->definition_date}}</td>
  </tr>
  @endforeach
  
 

  <tr class="headingTr">
    <td class="headingTd col1" colspan="2"></td>
    <td class="headingTd  text-right">TOTAL</td>
    <td class="headingTd  text-right" colspan="13">
      <?= $c ?></td>
  </tr>
  
</table>
@include('admin.report.partial.footer')