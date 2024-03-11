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
  font-size: 1.3em;
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

/* .printTable .col1 {
  width: 10%;
} */

/* .printTable .col2 {
  width: 20%;
} */

/* .printTable .col3 {
  /* text-align: right; 
  width: 60%;
} */

/* .printTable .col4 {
  /* text-align: right; 
  width: 15%;
} */
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
  <p>Payments Report</p>
  <p style="font-size:18px !important;">{{app_month_format($fields['month'])}}</p>
</div>

<table class="printTable">
 
  <tr class="subtitleTr">
    <td class="titleTd col1" colspan=2></td>
    <td class="titleTd col4 text-right" colspan=2> &nbsp;  &nbsp; </td>
  </tr>

  <tr></tr>

  <tr class="headingTr">
  <td class="text-center strong" colspan="6"> Records</td>
  </tr>
  <tr class="headingTr">
    <td class="headingTd col1">#</td>
    <td class="headingTd col2">Refrence No</td>
    <td class="headingTd col2">Tarrif Category</td>
    {{-- <td class="headingTd col3">Month </td> --}}
     <td class="headingTd col1">Payment Date </td> 
     <td class="headingTd col1">Bank</td> 
    <td class="headingTd col4 text-right">Paid Amount</td>
  </tr>
  <?php $c=1; 
  $total=0;
?>
  @foreach ($record as $k => $row )
    
    @foreach ($banks as $bk => $brow )
      <tr>
        <td class="col1" colspan="6"> <b> {{$brow->code.' - '.$brow->title}}</b></td>
      </tr>
        @if($row->bank_id==$brow->id) 
        <tr>
          <td class="col1">{{$c}}</td>
          <td class="col2">{{$row->bConsumerMeter->ref_no}}</td>
          <td class="col2">{{$row->bConsumerBill->hOSubCategory->name}}</td>
          {{-- <td class="col3">{{app_month_format($row->payment_month)}}</td> --}}
          <td class="col1"> {{$row->payment_date}}</td> 
          <td class="col1"> {{$row->bBank->code.' - '.$row->bBank->title}}</td> 
          <td class="col1 text-right">{{$row->payment_amount}}</td>
        </tr>
        @endif
    
    <?php $c++; $total+=$row->payment_amount ?>
    @endforeach
  @endforeach
  
 

  <tr class="headingTr">
    <td class="headingTd col1" colspan="4"></td>
    <td class="headingTd col3 text-right">TOTAL</td>
    <td class="headingTd col4 text-right">
      <?= $total ?></td>
  </tr>
  
</table>

  

       
  

<div class="footer">
  Generated by  {{Auth::user()->first_name}}  on {{date('Y-m-d')}} <a href="#">{{env('APP_URL')}}</a>
</div>