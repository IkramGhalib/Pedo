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
  <div id="print_section"><a href="{{route('admin.report.bill.form')}}"  style="background-color:#3e8ef7;padding:5px;color:white"> &nbsp;&nbsp;Back&nbsp;&nbsp; </a> &nbsp; <a href="#" style="background-color:#3e8ef7;padding:5px;color:white" onclick="window.print();return false;" > &nbsp;&nbsp;Print&nbsp;&nbsp; </a> </div>
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
  
?>
  @foreach ($record as $k => $row )
    
  

  <tr>
    <td class="">{{$c}}</td>
    <td class="">{{$row->bConsumerMeter->ref_no}}</td>
    <td class="">{{$row->bConsumerMeter->bConsumer->full_name}}</td>
    <td class="">{{$row->tarrif_code}}</td>
    <td class="">{{$row->hOSubCategory->name}}</td>
    {{-- <td class="">{{$row->hOSubCategory->name}}</td> --}}
    {{-- <td class="">{{app_month_format($row->billing_month_year)}}</td> --}}
    {{-- <td class=""> {{$row->offpeak_units}}</td> --}}

    {{-- <td class="">{{$row->net_bill}}</td> --}}
   
    <td class="">{{$row->arrears}}</td>
    <td class="">{{$row->net_bill+$row->adjustment+$row->sevice_charges}}</td>
    <td class="">{{$row->l_p_surcharge}}</td>
    <td class="">{{$row->l_p_surcharge+$row->arrears+$row->net_bill+$row->adjustment+$row->sevice_charges}}</td>
    
    {{-- <td class="">{{$row->bBillGenerate->due_date}}</td> --}}

    {{-- <td class="">{{$row->AfterdueDate}}</td> --}}

  </tr>
  <?php $c++;   $total_old_a+=$row->arrears; 
                $total_curr_a+=$row->net_bill+$row->adjustment+$row->sevice_charges; 
                $total_lp+=$row->l_p_surcharge; 
                $total+=$row->l_p_surcharge+$row->arrears+$row->net_bill+$row->adjustment+$row->sevice_charges; ?>
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