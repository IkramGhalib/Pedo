@include('admin.report.partial.head')
<div class="header">

</div>

<table class="printTable">
  <tr class="top-row">
    <td colspan="9"> <img src="{{asset(env('LOGO'))}}" width="100px;" height="100px;"></td>
  </tr>
  <tr class="top-row">
    <td colspan="9"> <h4> <u>Bill Summary Report </u></h4></td>
  </tr>
  <tr class="top-row">
    <td colspan="9"> <b>{{app_month_format($fields['month'])}} </b></td>
  </tr>
  

  
  <tr class="headingTr">
    <td class="headingTd col1"></td>
    <td class="headingTd col2">Bill Category</td>
    <td class="headingTd col3">Bill Sub Category </td>
     <td class="headingTd col1">No of Bills</td> 
    <!-- <td class="headingTd col4 text-right">Amount</td> -->
  </tr>
  <?php $c=1; 
  $total=0;
?>
  @foreach ($record as $k => $row )
  <tr>
    <td class="col1"></td>
    <td class="col2" colspan="3">{{$row->name}}</td>
    
  </tr>
    @foreach ($row->hMConSubCategory as $k2 => $row2 )
    <tr>
    <td class="col1"></td>
    <td class="col1"></td>
    <td class="col2" colspan="">{{$row2->name}}</td>
    <td class="col1">{{$row2->hMbills->count()}}</td>
    
  </tr>
    @php $total+=$row2->hMbills->count(); @endphp
    @endforeach
  
  @endforeach

  <tr class="headingTr">
    <td class="headingTd col1" colspan="2"></td>
    <td class="headingTd col3 text-right"><b>TOTAL<b></td>
    <td class="headingTd col4">
     <b> {{$total}}</b>
    </td>
  </tr>
  
</table>
@include('admin.report.partial.footer')