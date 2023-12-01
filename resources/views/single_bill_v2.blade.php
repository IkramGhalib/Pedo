

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<!-- saved from url=(0061)http://210.56.23.106:888/pescobill/general/dcn/13264240100100 -->
<html xmlns="http://www.w3.org/1999/xhtml"><head id="Head1"><meta http-equiv="Content-Type" content="text/html; charset=UTF-8"><meta name="robots" content="noindex, nofollow"><meta name="googlebot" content="noindex"><title>
	
       
</title>
<head>
    <meta charset="utf-16">
    
    <meta name="keywords" content="iescobill, mepcobill, pescobill, hescobill, sepcobill, qescobill, gepcobill, fescobill, tescobill">
    <meta name="description" content="Consumer electricity bills">

    <title>Pakhtunkhwa Energy Development Organization</title>

    <!-- <link href="/styles/gbPrint.css" rel="stylesheet" type="text/css">
    <link href="/styles/normalize.css" rel="stylesheet" type="text/css">
    <link href="/styles/genbill.css" rel="stylesheet" type="text/css">
    <link href="/styles/img-zoom/multizoom.css" rel="stylesheet" type="text/css"> -->
    <link href="{{asset('frontend/css')}}/bill_sample_files/gbPrint.css" rel="stylesheet" type="text/css">
<link href="{{asset('frontend/css')}}/bill_sample_files/normalize.css" rel="stylesheet" type="text/css">
<link href="{{asset('frontend/css')}}/bill_sample_files/genbill.css" rel="stylesheet" type="text/css">
<link href="{{asset('frontend/css')}}/bill_sample_files/multizoom.css" rel="stylesheet" type="text/css"></head>

    <script src="/js/JsBarcode.all.min.js"></script>
<style type="text/css">.featuredimagezoomerhidden {visibility: hidden!important;}
</style>
<body cz-shortcut-listen="true" data-new-gr-c-s-check-loaded="14.1126.0" data-gr-ext-installed="">

    <div id="printBtn" class="noprint">
        <br>
        <!-- <form method="post" action="#" id="0x"> -->
<div class="aspNetHidden">
<input type="hidden" name="__VIEWSTATE" id="__VIEWSTATE" value="OPkKXZQIV8WRGTdt0PzoHkeCKyK358klvNBvjC9WFwd3Nt3fxvJt3pDEK25+WzEeubFWHnR01KzVg8bHYzjum1rhev+8RZq602sUg885u7jf/J/IN/yRkAeGRKZL0BNcD54B/880vXNsnZQZJNrMpJxxXnRFT0OzWR3HrgrH1EiOSNan99uZ4A7LPwYGdsUOHKDxlBkMzO9WOpn7rhAqFAefbXC78UBoez7quxuh8PslpE1Pmlvt2mHsH7eSN11huYFSQTzp4vB6/EV0yNuetGXn8XDQy3zBKsDfT8IvR2bAvYXqyl0ScQuPihtJNFq73/1kajIv0T9bEEJyoXLC/Q==">
</div>

<div class="aspNetHidden">

	<input type="hidden" name="__VIEWSTATEGENERATOR" id="__VIEWSTATEGENERATOR" value="34C80342">
	<input type="hidden" name="__EVENTVALIDATION" id="__EVENTVALIDATION" value="cEk+pgyPGUEF+AGULmHJ6IbkvHRKPHPuJYvjKxFizGp5H7rKWTI9yhbQ3TzFAPE834Tbew4ubYQ1p1Rz96/AzaFb6Ls/c4jPYbU89P8LoKaxjzks+gQh9rGGUEJjypDm">
</div>
            <!-- <input type="submit" name="id_btn_print" value="Print Bill" onclick="window.print();" id="id_btn_print" class="auto-center btn btn-secondary" style="font-size: 14px; padding: 5px; width: 75px;"> -->
        <!-- </form> -->
        <button type='button' class="auto-center btn btn-secondary" onclick="window.print();"    style="font-size: 14px; padding: 5px; width: 75px;"> Print Bill </button>
    </div>

    <?php 
        $offpeak_units= $bill_data->offpeak_units;
        $billing_month_year=date('M Y',strtotime($bill_data->billing_month_year));
        $ref_no=$bill_data->ref_no;
        $bill_no=$bill_data->bill_id;
        // $due_date=date('d M y');
        $due_date=date('d M y',strtotime($bill_data->due_date));
        $issue_date=date('d M y',strtotime($bill_data->bill_generate_date));
        // $issue_date=date('d M y');

        $cost_of_electricity=$bill_data->currentbill;
        $arrear=$bill_data->arrears;
        $payable=$bill_data->WithinDuedate;
        $payable_after_due_date=$bill_data->AfterdueDate;
        $lp_surcharge=$bill_data->l_p_surcharge;
        $previous_reading=$bill_data->prev_offpeak_reading;
        $current_reading=$bill_data->offpeak_current_reading;
        $total_units=0;
        $meter_connection_date=date('d M y',strtotime($bill_data->meter_connection_date));

        $current_bill=0;

    ?>

    <div class="maincontent fontsize">
        

        <div class="header">
            <div class="headerimg">
                <img style="margin-left: 10px; margin-top: 5px; max-width: 100%; max-height: 85%"  src="{{asset('frontend/img/learning.png')}}" alt="PESCO">
            </div>
            <div class="heading">
                <h1 style="margin: 10px 10px 10px 35px" >
                PAKHTUNKHWA ENERGY DEVELOPMENT ORGANIZATION
                    <span style="color: #1a75ff; float: right;">
                         GST No.<br>21-00-2716-001-46<br>
                    </span>
                </h1>
                <div>
                    <b style="color: #1a75ff;">YOUR BETTER SERVICE - OUR PRIDE</b>
                    <b style="float: right; margin-right: 10px;"><a style="text-decoration: none; color: #1a75ff;" href="{{env('APP_URL')}}">pedokp.gov.pk</a></b>
                    <b style="color: #1a75ff; float: right; margin-right: 60px">
                        ELECTRICITY CONSUMER BILL</b>
                </div>
            </div>
        </div>
        <table class="maintable" cellpadding="0" cellspacing="0">
            <tbody><tr class="font-size" style="height: 15px; width: 100%;">
                <td class="border-rb" style="width: 206px">
                    <h4>CONNECTION DATE</h4>
                </td>
                <td class="border-rb">
                    <h4>CONNECTED LOAD</h4>
                </td>
                <td class="border-rb" style="width: 53px">
                    
                        <h4>ED@</h4>
                    
                </td>
                <td class="border-rb" style="width: 129px">
                    <h4>BILL MONTH</h4>
                </td>
                <td class="border-rb" style="width: 157px">
                    <h4>READING DATE</h4>
                </td>
                <td class="border-rb" style="width: 104px">
                    <h4>ISSUE DATE</h4>
                </td>
                <td class="border-b" style="color: Red;">
                    <h4>DUE DATE</h4>
                </td>
            </tr>
            <tr style="height: 26px; width: 100%; font-size: .8em;" class="content">
                <td class="border-rb" style="text-align: center;">
                   {{$meter_connection_date}}
                </td>
                <td class="border-rb" style="text-align: center;">
                    
                </td>
                <td class="border-rb" style="text-align: center;">
                    
                    @foreach (json_decode($bill_data->taxes_breakup) as $kk =>$roww )
                            @if($roww->code=='ED')
                                {{$roww->percentage}} %
                            @endif
                    @endforeach
                    
                </td>
                <td class="border-rb" style="text-align: center;">
                {{$billing_month_year}}
                </td>
                <td class="border-rb" style="text-align: center;">
                    {{date('d M y',strtotime($bill_data->reading_date))}}
                </td>
                <td class="border-rb" style="text-align: center;">
                {{$due_date}}
                </td>
                <td class="border-b" style="text-align: center;">
                    {{$due_date}}
                </td>
            </tr>
        </tbody></table>
        <div style="height: auto; width: 453pt; float: left">
            <table class="nestable1" style="width: 100%">
                <tbody><tr style="height: 27px;" class="fontsize">
                    <td class="border-rb">
                        <h4>CONSUMER ID</h4>
                    </td>
                    <td class="border-rb">
                        <h4>TARIFF</h4>
                    </td>
                    <td class="border-rb">
                        <h4>LOAD</h4>
                    </td>
                    <td class="border-rb">
                        <h4>OLD A/C NUMBER</h4>
                    </td>
                </tr>
                <tr style="height: 27px;" class="fontsize content">
                    <td class="border-rb" style="text-align: center;">
                    {{$bill_data->consumer_id}} 
                    </td>
                    <td class="border-rb" style="text-align: center;">
                    {{$bill_data->tarrif_code}} 
                    </td>
                    <td class="border-rb" style="text-align: center;">
                        
                    </td>
                    <td class="border-rb" style="text-align: center;">
                        
                    </td>
                </tr>
                <tr style="height: 27px; padding-top: 0;" class="fontsize">
                    <td class="border-rb">
                        <h4>REFERENCE NO</h4>
                    </td>
                    <td class="border-rb">
                        <h4>LOCK AGE</h4>
                    </td>
                    <td class="border-rb">
                        <h4>NO of ACs
                        </h4>
                    </td>
                    <td class="border-rb">
                        <h4>UN-BILL-AGE</h4>
                    </td>
                </tr>
                <tr style="height: 27px;" class="fontsize content">
                    <td class="border-r" style="text-align: center;">
                       {{$ref_no}} R
                        
                    </td>
                    <td class="border-r ">
                        
                    </td>
                    <td class=" border-r" style="text-align: center;">
                        
                    </td>
                    <td class=" border-r" style="text-align: center;">
                        
                    </td>
                </tr>
            </tbody></table>
        </div>
        <div style="height: auto; width: 400px; float: right;">
            <table style="width: 100%" cellpadding="0" cellspacing="0">
                <tbody><tr style="height: 27px;" class="fontsize">
                    <td class="border-rb">
                        <b>DIVISION</b>
                    </td>
                    <td style="text-align: center;" class="content border-b">
                    {{$bill_data->division_name}}
                    </td>
                </tr>
                <tr style="height: 27px; width: 100%;" class="fontsize">
                    <td class="border-rb" style="width: 40%;">
                        <b>SUB DIVISION</b>
                    </td>
                    <td colspan="3" style="text-align: center;" class="content border-b">
                    {{$bill_data->sub_division_name}}
                    </td>
                </tr>
                <tr style="height: 27px; width: 100%;" class="fontsize">
                    <td class="border-rb" style="width: 40%;">
                        <b>FEEDER NAME</b>
                    </td>
                    <td colspan="3" style="text-align: center;" class="content border-b">
                        {{$bill_data->feeder_name}}
                    </td>
                </tr>
                <tr style="height: 27px; width: 100%;" class="fontsize">
                    <td colspan="1">
                        <h3>Web Generated Bill</h3>
                    </td>
                </tr>
            </tbody></table>
        </div>
        <table class="maintable" cellpadding="0" cellspacing="0">
            <tbody><tr style="height: auto;" class="fontsize">

                <td colspan="4" style="width: 453pt" class="border-r">
                    <table class="nested4">
                        <tbody><tr>
                            <td colspan="3">
                                <p style="margin: 0; text-align: left; padding-left: 20px">
                                    <span>NAME &amp; ADDRESS</span>
                                    <br>
                                    <span>{{$bill_data->full_name}}</span>
                                    <br>
                                    <span>{{$bill_data->father_name}}</span>
                                    <br>
                                    <span>{{$bill_data->address}}</span>
                                    <br>
                                    <!-- <span>CHD</span> -->
                                    <!-- <br> -->
                                    <!-- <span></span> -->
                                    
                                    
                                </p>

                            </td>
                            {{-- <td colspan="1">
                                <h2 class="zeroMargin" id="govtMsg" visible="false"></h2>
                            </td> --}}
                            <td colspan="2">
                                <h2 class="zeroMargin display-none"> Net Metering Conn. </h2>
                            </td>
                            <td colspan="2">
                                <h2 class="zeroMargin" hidden=""> Life Line Consumer</h2>
                            </td>
                        </tr>
                        <tr>
                            <td colspan="2">
                                {{-- <p style="margin: 0; text-align: left; padding-left: 20px">
                                    <span>NAME &amp; ADDRESS</span>
                                    <br>
                                    <span>{{$bill_data->full_name}}</span>
                                    <br>
                                    <span>{{$bill_data->father_name}}</span>
                                    <br>
                                    <span>{{$bill_data->address}}</span>
                                    <br>
                                    <!-- <span>CHD</span> -->
                                    <!-- <br> -->
                                    <!-- <span></span> -->
                                    
                                    
                                </p> --}}
                            </td>
                            <td colspan="3" style="text-align: left;">
                                <h2 class="color-red">Say No To Corruption</h2>
                                

                                

                                <span style="font-size: 8pt; color: #78578e"> </span>
                                <br>

                                

                            </td>
                            <td>
                                
                                <h3 style="font-size: 14pt;"> </h3>
                                <h2>  <br> </h2>
                            </td>
                        </tr>
                        <tr>
                            <td style="margin-top: 0;" class="border-b">
                                
                                
                                <div></div>
                            </td> 
                            <td colspan="5" style="margin-top: 0;" class="border-b">
                                <strong lang="ur" dir="rtl" style="font-size: 16px">
                                    &nbsp;
                                                                        {{-- معزز صارف : بجلی کے بل میں ایندھن کی قیمت کا فرق   (FPA)دو ماہ بعد شامل کیا جاتا ہے آپ کے  اس بل میں JUL 23 کے صرف شدہ 161 یونٹس کے ایندھن کی قیمت کے  469.54 روپے بھی شامل ہیں --}}
                                </strong>
                            </td>
                        </tr>
                        <tr style="height: 7%;" class="border-tb">
                            <td style="width: 130px" class="border-r">
                                <h4>METER NO</h4>
                            </td>
                            <td style="width: 90px" class="border-r">
                                <h4>PREVIOUS READING</h4>
                            </td>
                            <td style="width: 90px" class="border-r">
                                <h4>PRESENT READING</h4>
                            </td>
                            <td style="width: 60px" class="border-r">
                                <h4>MF</h4>
                            </td>
                            <td style="width: 60px" class="border-r">
                                <h4>UNITS</h4>
                            </td>
                            <td>
                                <h4>STATUS</h4>
                            </td>
                        </tr>
                        <tr style="height: 30px" class="content">
                            <td class="border-r">
                               {{$bill_data->meter_no}}<br>
                            </td>
                            <td class="border-r">
                                {{$previous_reading}}<br>
                            </td>
                            <td class="border-r">
                            {{$current_reading}}<br>
                            </td>
                            <td class="border-r">
                                <br>
                            </td>
                            <td class="border-r">
                                {{$offpeak_units}}<br>
                            </td>
                            <td>
                                
                            </td>
                        </tr>
                        
                    </tbody></table>
                </td>

                <td style="float: right; width: 300pt; height: 200pt">
                    <table style="height: 200pt" class="nested6 ">
                        <tbody><tr style="margin-top: -1px; height: 25px">
                            <td class="border-b " style="width: 25%;">
                                <h4>MONTH</h4>
                            </td>
                            <td class="border-b" style="width: 25%;">
                                <h4>UNITS</h4>
                            </td>
                            <td class="border-b" style="width: 25%;">
                                <h4>BILL</h4>
                            </td>
                            <td class="border-b" style="width: 25%;">
                                <h4>PAYMENT</h4>
                            </td>
                        </tr>
                       
                      
                        @foreach ($payment_and_bill as $pabkey => $rpnb )
                        <tr style="height: 17px" class="content">
                                
                            <td class="border-r">
                                {{date('M,y',strtotime($rpnb->billing_month_year))}}
                            </td>
                           
                            <td class="border-r">
                                  {{$rpnb->offpeak_units}}
                               
                            </td>
                            <td class="border-r">
                                {{$rpnb->WithinDuedate-$rpnb->arrears}}
                            </td>
                            <td>
                                {{$rpnb->pay_amount}}
                            </td>
                        </tr>
                        @endforeach
                        
                        
                        
                        
                        
                    </tbody></table>
                </td>
            </tr>
        </tbody></table>
        <div class="border-t" style="width: 755pt; height: 430pt">
            <table class="nested7" style="width: 454pt; height: 411pt; float: left">
                <tbody><tr class="fontsize" style="height: 28px; width: 100%">
                    <td colspan="2" class="border-rb" style="text-align: center; font-size: 16px; background-color: #B2E6FF">
                        <b>
                            PEDO
                            CHARGES
                        </b>
                    </td>
                    <td colspan="2" class="border-rb" style="text-align: center; font-size: 16px; background-color: #FFB2B2;">
                        <b>GOVT CHARGES</b>
                    </td>
                </tr>
                <tr style="border-bottom:1px solid gray;">
                    <?php $pesco_total=0;?>
                    <?php $gov_total=0;?>
                    <td colspan="2" style="vertical-align: top;">
                        <table width="100%">
                            <tr class="fontsize" style="height: 24px;">
                                <td class="border-rb nestedtdwidth" style="background-color: #B2E6FF">UNITS CONSUMED</td>
                                <td class="border-rb nestedtdwidth content">{{$offpeak_units}} </td>
                            </tr>

                            <tr class="fontsize" style="height: 24px;">
                                <td class="border-rb nestedtdwidth" style="background-color: #B2E6FF">COST OF ELECTRICITY</td>
                                <td class="border-rb nestedtdwidth content">{{$cost_of_electricity}} </td>
                                <?php $pesco_total+=$cost_of_electricity ?>
                            </tr>
                            @foreach (json_decode($bill_data->charges_breakup) as $chbkey => $charges_b_row )
                            <tr class="fontsize" style="height: 24px;">
                                <td class="border-rb nestedtdwidth" style="background-color: #B2E6FF">{{$charges_b_row->charges_type}}</td>
                                <td class="border-rb nestedtdwidth content">{{$charges_b_row->calculated_charges}} </td>
                            </tr>
                            <?php $pesco_total+=$charges_b_row->calculated_charges; ?>
                            @endforeach

                            <tr class="fontsize" style="height: 24px;">
                                <td class="border-rb nestedtdwidth" style="background-color: #B2E6FF">TOTAL</td>
                                <td class="border-rb nestedtdwidth content">{{$pesco_total}} </td>
                            </tr>


                        </table>
                    </td>
                    <td colspan="2" style="vertical-align: top;">
                        <table width="100%">
                            <!-- <tr class="fontsize" style="height: 24px;">
                                <td class="border-rb nestedtdwidth" style="background-color: #FFB2B2;">T1 td1</td>
                                <td class="border-rb nestedtdwidth content">T1 td 2 </td>
                            </tr> -->
                            @foreach (json_decode($bill_data->taxes_breakup) as $tbkey => $tb_row )
                            <tr class="fontsize" style="height: 24px;">
                                <td class="border-rb nestedtdwidth" style="background-color: #FFB2B2;">{{$tb_row->tax_type}}</td>
                                <td class="border-rb nestedtdwidth content">{{$tb_row->calculated_tax}} </td>
                            </tr>
                            <?php $gov_total+=$tb_row->calculated_tax; ?>
                            @endforeach
                            <tr class="fontsize" style="height: 24px;">
                                <td class="border-rb nestedtdwidth" style="background-color: #FFB2B2;">TOTAL</td>
                                <td class="border-rb nestedtdwidth content">{{$gov_total}} </td>
                            </tr>
                            
                        </table>
                    </td>
                </tr>
                
                
                
                
               
                
                
                
                
                
                <tr class="fontsize" style="height: 24px;">
                    <td class="border-r" colspan="2">
                        <h3>BILL CALCULATION</h3>
                    </td>
                    <td class="border-rb" style="background-color: #FFB2B2;" rowspan="3">
                        
                        
                        
                    </td>
                    <td class="border-rb content" rowspan="3">
                        
                        
                        <br>
                        
                        <br>
                        
                                
                        <br>
                        
                        <br>
                        
                        <br>
                        
                        <br>
                        &ensp;&ensp; &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;

                        
                    </td>
                </tr>
                <tr class="border-b fontsize" style="height: 24px;">
                    <td class="border-rb" colspan="2" rowspan="3">
                        <table style="width: 100%;">
                            
                            <tbody><tr>
                                <td>GOP Tariff &nbsp; &nbsp; x  &nbsp;&nbsp; Units
                                </td>
                                <td></td>
                                <td></td>
                            </tr>
                            <tr class="content">
                                <td>
                                    @foreach (json_decode($bill_data->off_peak_bill_breakup) as $ofpkkey => $off_peak_bil_breakup_row )
                                        <?php echo $off_peak_bil_breakup_row->units ?> X <?php  echo $off_peak_bil_breakup_row->charges;  echo "="; echo $off_peak_bil_breakup_row->charges*$off_peak_bil_breakup_row->units;   echo "<br/>" ?> 
                                    @endforeach
                                     {{-- 27.1400 X {{ $offpeak_units}}<br><br> --}}
                                </td>
                            </tr>
                            <tr style="font-size: 14pt" class="content display-none">
                                <td>
                                    اس بل میں وزیراعظم پاکستان کی جانب سے  <b><u>0</u></b>   روپے کا ریلیف دیا گیا ہے۔
                                </td>
                            </tr>
                        </tbody></table>

                        
                    </td>
                </tr>
                <tr style="height: 24px;" class="fontsize">
                </tr>
                <tr style="height: 24px;" class="fontsize">
                    <td class="border-rb" style="background-color: #FFB2B2;"></td>
                    <td class="border-rb content"></td>
                </tr>
                <tr style="height: 32px;" class="fontsize">
                    <td class="border-rb" rowspan="2" colspan="1">
                        <table class="display-none" id="impExpt" style="width: 115pt;">
                            <tbody><tr>
                                <td></td>
                                <td><b>Off Peak</b></td>
                                <td><b>Peak</b></td>
                            </tr>
                            <tr>
                                <td><b>Export(kWh) : </b></td>
                                <td>0</td>
                                <td>0 </td>
                            </tr>
                            <tr>
                                <td><b>Import(kWh) : </b></td>
                                <td>0</td>
                                <td>0 </td>
                            </tr>
                            <tr>
                                <td><b>Net(kWh) : </b></td>
                                <td>0</td>
                                <td>0 </td>
                            </tr>
                        </tbody></table>
                    </td>
                    <td class="border-rb" rowspan="2" colspan="1">
                        <table class="display-none" style="width: 150pt;">
                            <tbody><tr>
                                <td></td>
                                <td><b>Previous</b></td>
                                <td><b>Present</b></td>
                            </tr>
                            <tr>
                                <td><b>Month Count = </b></td>
                                <td>0/0 / 0</td>
                                <td></td>
                            </tr>
                            <tr>
                                <td><b>Remaining kWh (O)</b></td>
                                <td>0</td>
                                <td>0</td>
                            </tr>
                            <tr>
                                <td><b>Remaining kWh (P)  </b></td>
                                <td>0</td>
                                <td>0</td>
                            </tr>
                        </tbody></table>
                    </td>
                    <td class="border-rb" style="background-color: #FFB2B2;">
                        <b>TOTAL</b>
                    </td>
                    <td class="border-rb content" style="text-align: center">
                        {{$gov_total}}
                    </td>
                </tr>
                <tr style="height: 32px;" class="fontsize">
                    <td class="border-rb" style="background-color: yellow;">
                        <b>DEFFERRED AMOUNT</b>

                    </td>
                    <td class="border-rb content" style="text-align: center">
                        
                            
                    </td>
                </tr>
                <tr style="height: 32px;" class="fontsize">
                    <td class="border-rb content" colspan="2">
                        Fuel Price Adjustment for Jul-23 @  1.4630/KWH
                        

                        
                    </td>
                    <td class="border-rb" style="background-color: yellow;">
                        <b>OUTSTANDING INST. AMOUNT</b>
                    </td>
                    <td class="border-rb content" style="text-align: center">
                        
                    </td>
                </tr>
                <tr style="height: 24px;" class="fontsize">
                    <td class="border-rb" style="background-color: #efeff5;">
                        <b>PROG. GST PAID F-Y</b>
                    </td>
                    <td class="border-rb content">
                        
                    </td>
                    <td class="border-rb" style="background-color: #efeff5;">
                        <b>PROG. IT PAID F-Y</b>
                    </td>
                    <td class="border-rb content">
                        
                    </td>
                </tr>
            </tbody></table>
            <table class="nested7" style="width: 295pt; height: 411pt">
                <tbody><tr class="fontsize" style="height: 28px; background-color: #7ADEFF; text-align: center">
                    <td colspan="4" class="border-b" style="font-size: 16px">
                        <b>TOTAL CHARGES</b>
                    </td>
                </tr>
                <tr class="fontsize" style="height: 24px;">
                    <td class="border-rb nestedtd2width" style="background-color: #7ADEFF;">
                        <b>ARREAR/AGE</b>
                    </td>
                    <td colspan="3" class="border-b  nestedtd2width content">
                        {{$arrear}}
                    </td>
                </tr>
                <tr class="fontsize" style="height: 24px;">
                    <td class="border-rb nestedtd2width" style="background-color: #7ADEFF;">
                        <b>CURRENT BILL</b>
                    </td>
                    <td colspan="3" class="border-b  nestedtd2width content">
                       <?php  $current_bill=(int)($pesco_total+$gov_total);
                                // $payable=$current_bill;
                                $payable_after_due_date=$payable+$lp_surcharge;
                                echo $current_bill; 
                       ?>
                    </td>
                </tr>
                <tr class="fontsize" style="height: 24px;">
                    <td class="border-rb nestedtd2width" style="background-color: #7ADEFF;">
                        <b>BILL ADJUSTMENT
                            </b>
                    </td>
                    <td colspan="3" class="border-b  nestedtd2width content">
                        <br>
                    </td>
                </tr>
                <tr class="fontsize" style="height: 24px;">
                    <td class="border-rb nestedtd2width" style="background-color: #7ADEFF;">
                        <b>
                            INSTALLEMENT
                            
                        </b>
                        <br>
                        <b class="display-none">
                            
                        </b>
                    </td>
                    <td colspan="3" class="border-b  nestedtd2width content">
                        
                        <br>
                        <b class="display-none">
                            
                        </b>
                    </td>
                </tr>
                <tr class="fontsize" style="height: 25px;">
                    <td class="border-rb nestedtd2width" style="background-color: #7ADEFF;">
                        <div id="subsidiesId"><b>SUBSIDIES </b></div>
                        <div id="releifMsgTitleId"><b> </b></div>
                    </td>
                    <td colspan="3" class="border-b nestedtd2width content">
                        <div id="releifMsgContentId">
                            </div>
                    </td>
                </tr>
                <tr class="fontsize" style="height: 24px;">
                    <td class="border-rb nestedtd2width" style="background-color: #7ADEFF;">
                        <div>
                            <b>TOTAL FPA</b>
                        </div>
                        <div hidden="">
                            <b>NET FPA</b>
                        </div>
                        <div class="display-none">
                            <b></b> 
                        </div>
                        <div class="display-none">
                            <b> </b>
                        </div>
                    </td>
                    <td colspan="3" class="border-b  nestedtd2width content">
                        
                        <div>
                            0
                        </div>
                        <div hidden="">
                            
                        </div>
                        <div class="display-none">
                            <b></b>  
                        </div>
                        <div class="display-none">
                           <b>0</b>  
                        </div>
                    </td>
                </tr>
                <tr class="fontsize" style="height: 24px;">
                    <td class="border-rb nestedtd2width" style="color: Red; background-color: #7ADEFF">
                        <b>PAYABLE WITHIN DUE DATE</b>
                    </td>
                    <td colspan="3" class="border-b nestedtd2width content">
                        {{$payable}}
                        
                        <br>
                        <span></span>
                    </td>
                </tr>
                <tr class="fontsize" style="height: 24px;">
                    <td class="border-rb nestedtd2width" style="background-color: #7ADEFF;">
                        <b>L.P.SURCHARGE</b>
                    </td>
                    <td colspan="3" class="border-b  nestedtd2width content">
                       {{$lp_surcharge}}
                    </td>
                </tr>
                <tr class="fontsize" style="height: 24px;">
                    <td class="border-rb nestedtd2width" style="color: Red; background-color: #7ADEFF">
                        <b>PAYABLE AFTER DUE DATE</b>
                    </td>
                    <td colspan="3" class="border-b  nestedtd2width content">
                        {{$payable_after_due_date}}
                        
                        <br>
                        <span> </span>
                    </td>
                </tr>
                <tr class="fontsize border-b" style="height: 145px;">
                    <td colspan="2">
                        <table style="width: 100%">
                            <tbody><tr>
                            <td id="idmtr1img" style="height: 142px;">
                                    
                                    <!-- <img id="mtr1img" src="http://snaps.pitc.com.pk/26000/26100/26140/202309-08/202309082614203919041E.jpg" style="height:100%;width:95%;"> -->
                                </td>

                                
                                
                                
                                
                            </tr>
                        </tbody></table>
                    </td>

                </tr>

                <tr id="idComplaint" class="fontsize border-b" style="border: none; height: 18px;">
</tr>

                <tr class="fontsize border-b" style="height: 44px;">


                    <td class="border-b" colspan="1" style="text-align: left;">

                        <div>
                            <b>SDO : </b>6644479 / 03309970142
                        </div>

                        <div class="">
                            <div>
                            <b>XEN : </b>9220051 / 03309970140
                        </div>

                        <div>
                            <b>SE # : </b>2113100 / 03309970101
                        </div>
                        </div>
                        
                    </td>

                    
                    <td class="border-b display-none" colspan="2" style="text-align: left">
                        <div>
                            <b>Center Name : </b>
                        </div>
                        <div>
                            <b>  </b>
                        </div>
                    </td>
                    <td id="idCallCenterNoMsg" colspan="1" style="text-align: center" class="border-b">
                        <b>FOR COMPLAINTS DIAL: 118 /SMS: 8118</b>
                    </td>

                    

                    
                    <td colspan="1" style="text-align: center" class="border-b">
                        
                    </td>
                    
                </tr>
            </tbody></table>
        </div>
        <div class="border-b" style="margin-top:30px; width: 100%; height: 25px" id="Tr1">
            <img src="{{asset('frontend/img')}}/cuthere.gif" alt="cuthere" id="Img2">
        </div>
        <div class="headertable fontsize">
            <div>
                <div style="height: 100%; width: 100px; float: left; display: inline-block; margin: 15px 0 0 15px">
                    <img style="margin: auto; max-width: 100%; max-height: 100%;" src="{{asset('frontend/img/learning.png')}}" alt="PEDO" id="Img1">
                                                    <span><b>
                                                        pedokp.gov.pk</b></span>
                </div>
                <div style="width: 670px; display: inline-block">
                    <table style="width: 100%; text-align: right;">
                        <tbody><tr>
                            <td colspan="3">
                                <h2 style="float: left; font-weight: 800; margin-left: 0px; margin-bottom: 0px;">
                                PAKHTUNKHWA ENERGY DEVELOPMENT ORGANIZATION
                                <BR/>
                                    
                                    ELECTRICITY CONSUMER BILL
                                </h2>
                            </td>
                        </tr>
                        <tr>
                            <td style="text-align: left; width: 215px; color: #1a75ff;">
                                <span style="font-size: 11px; color: #1a75ff;"><b>YOUR BETTER SERVICE - OUR PRIDE</b> </span>
                            </td>
                            <td style="text-align: left; width: 170px; color: #1a75ff;">
                                <h3 style="font-size: 14pt; margin-left: 6px;">  </h3> 
                            </td>
                            <td>
                                <table style="width: 230px; margin-right: 20px; float: right; border-collapse: collapse; text-align: center">
                                    <tbody><tr>
                                        <td class="border-rb border-t" style="border-left: 1px solid #78578e; color: #78578e;">
                                            <h4>CONSUMER ID</h4>
                                        </td>
                                        <td class="border-rb border-t content">
                                            {{$bill_data->consumer_id}} 
                                        </td>
                                    </tr>
                                    
                                </tbody></table>
                            </td>
                        </tr>
                    </tbody></table>
                </div>

                <div style="width: 15%; margin-top: 20px; float: right; display: inline-block">
                    <span>BILL NO <br> {{$bill_no}}</span>
                    
                </div>

            </div>
            <div style="display: inline-block; border: 1px solid #1a75ff; color: #1a75ff; padding: 20px; border-radius: 100%; width: 35px;">BANK
                <br>
                STAMP
            </div>
            

            <div style="float: right; margin-right: 206px; height: 70px; margin-bottom: 15px;">
                
                
                    <svg id="normal_bill_barcode" width="331px" height="60px" x="0px" y="0px" viewBox="0 0 331 60" xmlns="http://www.w3.org/2000/svg" version="1.1" style="transform: translate(0,0)"><rect x="0" y="0" width="331" height="60" style="fill:#ffffff;"></rect><g transform="translate(5, 5)" style="fill:#000000;"><rect x="0" y="0" width="2" height="50"></rect><rect x="3" y="0" width="1" height="50"></rect><rect x="6" y="0" width="1" height="50"></rect><rect x="11" y="0" width="1" height="50"></rect><rect x="15" y="0" width="2" height="50"></rect><rect x="18" y="0" width="1" height="50"></rect><rect x="22" y="0" width="1" height="50"></rect><rect x="25" y="0" width="3" height="50"></rect><rect x="29" y="0" width="2" height="50"></rect><rect x="33" y="0" width="1" height="50"></rect><rect x="35" y="0" width="3" height="50"></rect><rect x="39" y="0" width="4" height="50"></rect><rect x="44" y="0" width="1" height="50"></rect><rect x="47" y="0" width="1" height="50"></rect><rect x="50" y="0" width="4" height="50"></rect><rect x="55" y="0" width="2" height="50"></rect><rect x="59" y="0" width="1" height="50"></rect><rect x="64" y="0" width="1" height="50"></rect><rect x="66" y="0" width="1" height="50"></rect><rect x="68" y="0" width="2" height="50"></rect><rect x="71" y="0" width="3" height="50"></rect><rect x="77" y="0" width="1" height="50"></rect><rect x="80" y="0" width="1" height="50"></rect><rect x="83" y="0" width="2" height="50"></rect><rect x="88" y="0" width="4" height="50"></rect><rect x="93" y="0" width="2" height="50"></rect><rect x="96" y="0" width="2" height="50"></rect><rect x="99" y="0" width="2" height="50"></rect><rect x="102" y="0" width="4" height="50"></rect><rect x="107" y="0" width="2" height="50"></rect><rect x="110" y="0" width="2" height="50"></rect><rect x="115" y="0" width="1" height="50"></rect><rect x="117" y="0" width="1" height="50"></rect><rect x="121" y="0" width="1" height="50"></rect><rect x="123" y="0" width="1" height="50"></rect><rect x="125" y="0" width="4" height="50"></rect><rect x="132" y="0" width="2" height="50"></rect><rect x="137" y="0" width="2" height="50"></rect><rect x="140" y="0" width="2" height="50"></rect><rect x="143" y="0" width="1" height="50"></rect><rect x="145" y="0" width="2" height="50"></rect><rect x="151" y="0" width="1" height="50"></rect><rect x="154" y="0" width="1" height="50"></rect><rect x="156" y="0" width="1" height="50"></rect><rect x="158" y="0" width="4" height="50"></rect><rect x="165" y="0" width="2" height="50"></rect><rect x="168" y="0" width="2" height="50"></rect><rect x="171" y="0" width="2" height="50"></rect><rect x="176" y="0" width="2" height="50"></rect><rect x="179" y="0" width="2" height="50"></rect><rect x="183" y="0" width="2" height="50"></rect><rect x="187" y="0" width="2" height="50"></rect><rect x="190" y="0" width="2" height="50"></rect><rect x="194" y="0" width="2" height="50"></rect><rect x="198" y="0" width="4" height="50"></rect><rect x="203" y="0" width="2" height="50"></rect><rect x="206" y="0" width="2" height="50"></rect><rect x="209" y="0" width="2" height="50"></rect><rect x="214" y="0" width="2" height="50"></rect><rect x="217" y="0" width="2" height="50"></rect><rect x="220" y="0" width="2" height="50"></rect><rect x="223" y="0" width="2" height="50"></rect><rect x="227" y="0" width="2" height="50"></rect><rect x="231" y="0" width="2" height="50"></rect><rect x="234" y="0" width="2" height="50"></rect><rect x="238" y="0" width="2" height="50"></rect><rect x="242" y="0" width="2" height="50"></rect><rect x="246" y="0" width="1" height="50"></rect><rect x="249" y="0" width="1" height="50"></rect><rect x="253" y="0" width="1" height="50"></rect><rect x="256" y="0" width="4" height="50"></rect><rect x="262" y="0" width="1" height="50"></rect><rect x="264" y="0" width="3" height="50"></rect><rect x="269" y="0" width="1" height="50"></rect><rect x="272" y="0" width="2" height="50"></rect><rect x="275" y="0" width="3" height="50"></rect><rect x="279" y="0" width="1" height="50"></rect><rect x="281" y="0" width="4" height="50"></rect><rect x="286" y="0" width="1" height="50"></rect><rect x="290" y="0" width="2" height="50"></rect><rect x="293" y="0" width="1" height="50"></rect><rect x="297" y="0" width="1" height="50"></rect><rect x="300" y="0" width="2" height="50"></rect><rect x="304" y="0" width="1" height="50"></rect><rect x="308" y="0" width="2" height="50"></rect><rect x="313" y="0" width="3" height="50"></rect><rect x="317" y="0" width="1" height="50"></rect><rect x="319" y="0" width="2" height="50"></rect></g></svg>
                    
                
                <div>SEP 23 - 08 26142 0391904 - 000009132 - 27 SEP 23 - 6</div>

                <script>
                    
                    let nor_barcode_encoded_txt = 'E0826142039190409232709230000091320000098526E';
                    JsBarcode("#normal_bill_barcode", nor_barcode_encoded_txt, {
                        width: 1,
                        height: 50,
                        margin: 5,
                        displayValue: false
                    });
                    
                </script>

                
            </div>
            <div style="width: 98%; margin: 0 auto 10px;">
                <table style="text-align: center; width: 100%; border-collapse: collapse;">
                    <tbody><tr style="height: 30px;">
                        <td class="border-rb border-t" style="width: 15%; color: #78578e; border-left: 1px solid #78578e;">
                            <h4>BILL MONTH</h4>
                        </td>
                        <td class="border-rb border-t" style="width: 15%; color: #78578e;">
                            <h4>DUE DATE</h4>
                        </td>
                        <td class="border-rb border-t" style="width: 25%; color: #78578e;">
                            <h4>REFERENCE NO</h4>
                        </td>
                        <td class="border-rb border-t" style="width: 25%; color: red">
                            <h4>PAYABLE WITHIN DUE DATE</h4>
                        </td>
                        <td class="border-b border-t border-r content" style="width: 20%;">
                            {{$payable}}
                            
                            <br>
                            <span></span>
                        </td>
                    </tr>
                    <tr style="height: 40px;">
                        <td class="border-rb content" style="width: 15%; text-align: center; border-left: 1px solid #78578e;">
                            <!-- SEP 23 -->
                            {{$billing_month_year}}
                        </td>
                        <td class="border-rb content" style="width: 15%; text-align: center;">
                           {{$due_date}}
                        </td>
                        <td class="font-size border-rb content" style="width: 25%; text-align: Center;">
                           {{$ref_no}} R
                            
                        </td>
                        <td class="border-rb" style="width: 25%; color: red;">
                            <h4>PAYABLE AFTER DUE DATE</h4>
                        </td>
                        <td class="font-size border-rb border-r content" style="width: 15%;">
                            {{$payable_after_due_date}}
                            
                            <br>
                            <span></span>
                        </td>
                    </tr>
                </tbody></table>
            </div>
        </div>
        
        
    </div>
    

    <script src="/js/jquery-3.6.0.min.js"></script>
    <script type="text/javascript" src="/js/disable_inspect_element.js"></script>
    <script type="text/javascript" src="/js/implementation_zoomJs.js"></script>
    <script type="text/javascript" src="/js/multizoom.js"></script>




<script src="chrome-extension://hhojmcideegachlhfgfdhailpfhgknjm/web_accessible_resources/index.js"></script></body>
</head>
</html>