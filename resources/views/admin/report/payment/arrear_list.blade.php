<style>
  * {
  margin: 0;
  padding: 0;
  font-family: 'AvenirNext-Light', 'Avenir Next Light', 'Avenir Next', sans-serif;
}

@page {
  size: A4;
  @bottom-right {
    content: "Page " counter(page) " of " counter(pages);
  }
  @bottom-left {
    content: string(footerTitle);
  }
}

body {
  font-size: 100%;
  padding: 50px;
  background: #fff;
}

.header {
  width: 100%;
  float: left;
  font-size: 2em;
  text-align:center;
}

.printTable {
  width: 100%;
  min-width: 37em;
  border-collapse: collapse;
  font-size: 0.9em;
  font-weight: normal;
}

.printTable tr {
  height: 1em;
}

.printTable td {
  font-size: 0.8em;
  padding-top: 0.4em;
  padding-bottom: 0.4em;
  padding-left: 0.4em;
  padding-right: 0.4em;
  box-sizing: border-box;
  border-bottom: #ccc 0.125em solid;
}

.printTable .titleTr {
  font-size: 1.4em;
}

.printTable .titleTd {
  padding-bottom: 0;
  padding-left: 0px;
  padding-right: 0px;
  border: 0px solid;
}

.printTable .subtitleTr {
  font-size: 1.1em;
  border: 0px solid;
}

.printTable .headingTr {
  font-size: 0.9em;
  font-weight: 500;
  background: #d3ebfd;
}

.printTable .headingTd {
  border-bottom: #000 0.125em solid;
  border-top: #000 0.125em solid;
}

/* .printTable .sectionTr {
  background: #f6f3f7;
} */

.printTable .sectionTd {
  font-weight: 500;
}

.printTable .col1 {
  width: 10%;
}

.printTable .col2 {
  width: 20%;
}

.printTable .col3 {
  /* text-align: right; */
  width: 60%;
}

.printTable .col4 {
  /* text-align: right; */
  width: 15%;
}
.text-right{
  text-align: right;
}

.footer {
  string-set: footerTitle content() width: 100%;
  float: left;
  height: 1em;
  padding-right: 0;
  font-size: 0.6em;
  padding-top: 0.4em;
}
a {
  text-decoration:none;
  color:black;
}
@media print{
  #print_section{display: none;}
}
@media screen{
  #print_section{display: inline-block;}

}
.text-center{text-align:center}
.strong{
  font-weight: bold;
  font-size:14px;
}

.right-align {display: -webkit-box; display: -webkit-flex; display: flex; justify-content: flex-end; -webkit-justify-content: flex-end; text-align:right;}
  </style>
  <div id="print_section"><a href="{{route('admin.report.payment.form')}}"  style="background-color:#3e8ef7;padding:5px;color:white"> &nbsp;&nbsp;Back&nbsp;&nbsp; </a> &nbsp; <a href="#" style="background-color:#3e8ef7;padding:5px;color:white" onclick="window.print();return false;" > &nbsp;&nbsp;Print&nbsp;&nbsp; </a> </div>
<div class="header">
<p><img src="{{asset(env('LOGO'))}}" width="100px;" height="100px;"></p>
  <p>Arear list</p>
  <p style="font-size:18px !important;">{{app_month_format($fields['month'])}}</p>
</div>

<table class="printTable">
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
   
    <td class="headingTd">P.Month Arrear </td>
    <td class="headingTd">C.Month Arrear </td>
    <td class="headingTd">C.Month L.P Surcharge </td>
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
        }
        else {
          $arrears=0;
          $consider_amount=0;
          $paid_amount=0;
          $net_bill=0;
          $adjustment=0;
          $service_charges=0;
          $l_p_surcharge=0;
        }
      @endphp
  <tr>
    <td class="">{{$c}}</td>
    <td class="">{{$row->bConsumerMeter->ref_no}}</td>
    <td class="">{{$row->bConsumerMeter->bConsumer->full_name}}</td>
    <td class="">{{$row->tarrif_code}}</td>
    <td class="">{{$row->hOSubCategory->name}}</td>
    <td class="">{{$arrears}}</td>
    @if($pre_record_collect_row['IsPayed']==1)
      <td class=""> {{$consider_amount-$paid_amount}}</td>
    @else
      <td class=""> {{($net_bill+$adjustment+$service_charges)}}</td>

    @endif
    <td class="">{{$l_p_surcharge}}</td>
    
    <td class="">
      @if($row->IsPayed==1)
      {{$row->consider_amount-$row->paid_amount+$row->l_p_surcharge}}
      @else
      {{-- {{$l_p_surcharge+$arrears+$net_bill+$adjustment+$service_charges}} --}}
      {{$l_p_surcharge+$arrears+$net_bill+$adjustment+$service_charges}}
      @endif
    </td>
    
    {{-- <td class="">{{$row->bBillGenerate->due_date}}</td> --}}

    {{-- <td class="">{{$row->AfterdueDate}}</td> --}}

  </tr>
  <?php $c++;   $total_old_a+=$arrears; 
                $total_curr_a+=$net_bill+$adjustment+$service_charges; 
                $total_lp+=$l_p_surcharge; 
                $total+=$l_p_surcharge+$arrears+$net_bill+$adjustment+$service_charges; 
                // $total+=$row->arrears; 
                ?>
  @endforeach
  <tr class="headingTr">
    <td class="headingTd " colspan="4"></td>
    <td class="headingTd  "><b>TOTAL</b></td>
    <td class="headingTd  "><b> <?= $total_old_a ?></b></td>
    <td class="headingTd  "><b> <?= $total_curr_a ?></b></td>
      <td class="headingTd  "><b> <?= $total_lp ?></b></td>
        <td class="headingTd  "> <b><?= $total ?></b></td>
   
   
    
  </tr>
  
</table>

  

       
  

<div class="footer">
  Generated by  {{Auth::user()->first_name}}  on {{date('Y-m-d')}} <a href="#">{{env('APP_URL')}}</a>
</div>