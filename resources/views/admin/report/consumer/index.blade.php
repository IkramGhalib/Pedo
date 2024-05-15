@include('admin.report.partial.head')
<table class="printTable">
  <tr class="top-row">
    <td colspan="9"> <img src="{{asset(env('LOGO'))}}" width="100px;" height="100px;"></td>
  </tr>
  <tr class="top-row">
    <td colspan="9"> <h4> <u>Consumer  Report </u></h4></td>
  </tr>
  <tr class="titleTr">
    <td class="titleTd" colspan='3'> @if($fields) Report Type:  {{$fields}} @endif <br/>
    </td>
    <!-- <td class="titleTd col4 text-right" colspan=2>Reporting Period</td> -->
    <td class="titleTd col4 text-right" colspan='1'></td>
  </tr>
  <tr class="subtitleTr">
    <td class="titleTd col1" colspan=2></td>
    <td class="titleTd col4 text-right" colspan=2> &nbsp;  &nbsp; </td>
  </tr>
 
  <tr class="headingTr">
    <td class="headingTd col1">#</td>
    <td class="headingTd col2">Name</td>
    <td class="headingTd col3">FName / CNIC / MOBILE  </td>
    {{-- <td class="headingTd col1">PAID FROM</td> --}}
    <td class="headingTd col4 text-right">status</td>
  </tr>
  <?php $c=1; 
  $total=0;
?>
  @foreach ($record as $k => $row )
    
  

  <tr>
    <td class="col1">{{$c}}</td>
    <td class="col2">{{$row->full_name}}</td>
    <td class="col3">{{$row->father_name.' / '.$row->cnic.' / '.$row->mobile}}</td>
    {{-- <td class="col1"> {{$row->offpeak_units}}</td> --}}
    <td class="col4 text-right">{{$row->status}}</td>
  </tr>
  <?php $c++;  ?>
  @endforeach
  
 

  <tr class="headingTr">
    <td class="headingTd col1" colspan="2"></td>
    <td class="headingTd col3 text-right">TOTAL</td>
    <td class="headingTd col4 text-right">
      <?= $c ?></td>
  </tr>
  
</table>
@include('admin.report.partial.footer')