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
 
  {{-- <tr class="subtitleTr">
    <td class="titleTd col1" colspan=2></td>
    <td class="titleTd col4 text-right" colspan=2> &nbsp;  &nbsp; </td>
  </tr>

  <tr></tr> --}}

  <tr class="headingTr">
  <td class="text-center strong" colspan="7"> Records</td>
  </tr>
  <tr class="headingTr">
    <td class="headingTd col1">#</td>
    <td class="headingTd col2">Refrence No</td>
    <td class="headingTd col2">Tarrif Category</td>
    {{-- <td class="headingTd col3">Month </td> --}}
     <td class="headingTd col1">Payment Date </td> 
     <td class="headingTd col1">Bank</td> 
     <td class="headingTd col1">Page No</td> 
    <td class="headingTd col4 text-right">Paid Amount</td>
  </tr>
  <?php $c=1; 
  $total=0;
  $page=0;
  $pageTotal=0;
?>
  @foreach ($record as $k => $row )
         @php $banks=0; @endphp
        
        @if(!$row->hMPaymentReceive->isEmpty())
       
           
        <tr>
          <td></td>
          <td class="col1" colspan="6"> <b> {{$row->code.' - '.$row->title}}</b></td>
        </tr>
            @foreach ($row->hMPaymentReceive as $k2 => $row2 )
            @php
             $pageTotal+=$row2->payment_amount;
            if($page==0) // if first iteration of loop
            {
              if($page!=$row2->page_no) // on first iteration of loop just change page no
                      $page=$row2->page_no;
            }
            else {

              if($page!=$row2->page_no) // if its not first iteration and page no it not same with iteration page no. means page changed and show page total
                  {
                      $pageTotal+=(-$row2->payment_amount);
                      echo "<tr style='font-weight:bold'><td></td><td class='col1 ' colspan='5'> Page ".$page." Total </td> <td class='text-right'> ".$pageTotal." </td></tr>";
                      $page=$row2->page_no;
                      $pageTotal=0;
                      $pageTotal+=$row2->payment_amount;
                  }
             
            
            }
                 
          @endphp
            <tr>
                  <td class="col1">{{$c}}</td>
                  <td class="col2">{{$row2->bConsumerMeter->ref_no}}</td>
                  <td class="col2">{{$row2->bConsumerBill->hOSubCategory->name}}</td>
                 
                  {{-- <td class="col3">{{app_month_format($row->payment_month)}}</td> --}}
                  <td class="col1"> {{$row2->payment_date}}</td> 
                  <td class="col1"> {{$row->title}} </td> 
                  <td class="col1"> {{$row2->page_no}}</td> 
                  <td class="col1 text-right">{{$row2->payment_amount}}</td>
                </tr>
                <?php  $banks+=$row2->payment_amount ?>
                <?php  $total+=$row2->payment_amount ?>
                <?php $c++;  ?>


            @php
               if($loop->last) // if loop last then also show page total beacuse there is no futher entry for page no  change 
              {
                      echo "<tr style='font-weight:bold'><td></td><td class='col1 ' colspan='5'> Page ".$page." Total </td> <td class='text-right'> ".$pageTotal." </td></tr>";
                      $pageTotal=0;
              }
            @endphp    
            @endforeach
            <tr class="headingTr">
              <td class="headingTd col1" colspan="5"></td>
              <td class="headingTd col3 text-right">Bank Total </td>
              <td class="headingTd col4 text-right">
                <?= $banks ?></td>
            </tr>
        @endif
    
   
    @endforeach
  
 

  <tr class="headingTr">
    <td class="headingTd col1" colspan="5"></td>
    <td class="headingTd col3 text-right"><b>TOTAL</b></td>
    <td class="headingTd col4 text-right">
    <b>  <?= $total ?></b></td>
  </tr>
  
</table>

  

       
  

<div class="footer">
  Generated by  {{Auth::user()->first_name}}  on {{date('Y-m-d')}} <a href="#">{{env('APP_URL')}}</a>
</div>