<?php 

    
  ?>


<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<!-- saved from url=(0061)http://210.56.23.106:888/pescobill/general/dcn/13264240100100 -->
<html xmlns="http://www.w3.org/1999/xhtml"><head id="Head1"><meta http-equiv="Content-Type" content="text/html; charset=UTF-8"><meta name="robots" content="noindex, nofollow"><meta name="googlebot" content="noindex"><title>
	
{{env('APP_NAME')}}
</title>
<link href="{{asset('frontend/css')}}/bill_sample_files/gbPrint.css" rel="stylesheet" type="text/css">
<link href="{{asset('frontend/css')}}/bill_sample_files/normalize.css" rel="stylesheet" type="text/css">
<link href="{{asset('frontend/css')}}/bill_sample_files/genbill.css" rel="stylesheet" type="text/css">
<link href="{{asset('frontend/css')}}/bill_sample_files/multizoom.css" rel="stylesheet" type="text/css"></head>
<body cz-shortcut-listen="true" data-new-gr-c-s-check-loaded="14.1000.0" data-gr-ext-installed="">

    <div id="printBtn" class="noprint">
        <br>
        <button style="background-color: floralwhite" onclick="window.print()">Print Bill</button>
        <br>
        <br>
    </div>

    <form method="post" action="http://210.56.23.106:888/pescobill/general/dcn/13264240100100" id="form1">
<div class="aspNetHidden">
<input type="hidden" name="__VIEWSTATE" id="__VIEWSTATE" value="cy2hzntzUpNXLSNWl/VnHjjOxnKSKVwy7mYzjg2df6/a44Obuy+R3v44B0EKEctcWV3rEpprj021Z5rgZieDw8gYcKUSoPD/VvD0KW99egAuo/rZZPI5CeqwXrGi0TTgswluR7bRLuOSWhjFtT5udkGXsfCd76hnOR3N+HvKAnV/FzR8OJwuOExQ3lHyXB6XsCMEIc439w0XIF1uCcrcDdlnEyhHsbKi9ed3Lth8F7MdBTaWFnYG/3B7PS7EZxIaYzxzDRK6T7SiuTjN02d4yikdHN/4mjZ3wfnXGw6IRYqvBCs6pUsbmYEDfKkSq58XUwAFPama4pxh7c5/s1seSuK76lS/PmJVLT0EAOziCwA=">
</div>

<div class="aspNetHidden">

	<input type="hidden" name="__VIEWSTATEGENERATOR" id="__VIEWSTATEGENERATOR" value="6F97D67C">
</div>
        <div class="maincontent fontsize">
            <div class="header">
                <div class="headerimg">
                    <!-- <img style="margin-left: 10px; margin-top: 5px; max-width: 100%; max-height: 85%" src="" alt="PESCO"> -->
                </div>
                <div class="heading">
                    <h1 style="margin: 15px 0 15px -15%;" text-align: center;>
                    <font color="black">Electricity Consumer Bill <br>{{env('APP_NAME')}} </font><br>
                        <!-- <img height="75px" src="images/mes_logo_new.png" style="float: right"><br> -->

                    </h1>
                    <h4>
                       
                    </h4>
                </div>
            </div>
            <table class="maintable" cellpadding="0" cellspacing="0">
                <tbody><tr style="height: 15px; width: 100%; font-size: 1.0em;">
                    <td class="border-rb" style="color:black;width: 220px">
                        <h4>CONNECTION DATE</h4>
                    </td>
                    <td class="border-rb" style="color:black">
                        <h4>CONNECTED LOAD</h4>
                    </td>
                    <td class="border-rb" style="color:black;width: 53px">
                        <h4>ED@</h4>
                    </td>
                    <td class="border-rb" style="color:black;width: 129px">
                        <h4>BILL MONTH</h4>
                    </td>
                    <td class="border-rb" style="color:black;width: 157px">
                        <h4>READING DATE</h4>
                    </td>
                    <td class="border-rb" style="color:black;width: 104px" >
                        <h4>ISSUE DATE</h4>
                    </td>
                    <td class="border-b" style="color: black;">
                        <h4>DUE DATE</h4>
                    </td>
                </tr>
                
                <tr style="color:black;height: 26px; width: 100%; font-size: 1.0em;" class="content">
                    <td class="border-rb" style="text-align: center;">
                         
                    </td>
                    <td class="border-rb" style="text-align: center;">
                        0
                    </td>
                    <td class="border-rb" style="text-align: center;">
                        1.5
                    </td>
                    <td class="border-rb" style="text-align: center;">
                        
                    </td>
                    <td class="border-rb" style="text-align: center;">
                       
                    </td>
                    <td class="border-rb" style="text-align: center;">
                        
                    </td>
                     <td class="border-b" style="text-align: center;">
                        
                    </td>
                    <td class="border-b" style="text-align: center;">
                        
                    </td>
                </tr>
            </tbody></table>
            <div style="height: auto; width: 453pt; float: left">
                <table class="nestable1" style="color:black;width: 100%">
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
                        <td class="border-rb" style="font-size:12px;text-align: center;">
                            <?php echo '1' ?> 
                        </td>
                        <td class="border-rb" style="font-size:12px;text-align: center;">
                             A-1a(01)
                        </td>
                        <td class="border-rb" style="font-size:12px;text-align: center;">
                            1
                        </td>
                        <td class="border-rb" style="font-size:12px;text-align: center;">
                            
                        </td>
                    </tr>
                  
                    
                </tbody></table>
            </div>
            
            <div style="height: auto; width: 400px; float: right;">
                <table style="width: 100%" cellpadding="0" cellspacing="0">
                    <tbody><tr style="font-size:12px;color:black;height: 27px;" class="fontsize">
                        <td class="border-rb">
                          <b>  Division </b>
                        </td>
                        <td style="font-size:12px;text-align: center;" class="content border-b">
                         
                      
                        </td>
                    </tr>
                    <tr style="height: 27px; width: 100%;" class="fontsize">
                        <td class="border-r" style="font-size:12px;color:black;width: 40%;">
                            <b>Sub-Division</b>
                        </td>
                        <td colspan="3" style="font-size:12px;text-align: center;" class="content border">
                                              
                        </td>
                    </tr>
                   
                </tbody></table>
            </div>

            <div style="height: auto; width: 453pt; float: left">
                <table class="nestable1" style="color:black;width: 100%">
                    <tbody><tr style="height: 27px;" class="fontsize">
                        <td class="border-rb">
                            <h4>REFRENCE NO</h4>
                        </td>
                        <td class="border-rb">
                            <h4>LOCKAGE</h4>
                        </td>
                        <td class="border-rb">
                            <h4>NO OF ACs</h4>
                        </td>
                        <td class="border-rb">
                            <h4>UN-BILL-AGE</h4>
                        </td>
                       
                    </tr>
                    <tr style="height: 27px;" class="fontsize content">
                        <td class="border-r" style="font-size:12px;text-align: center;">
                            <?php echo '1' ?> 
                        </td>
                        <td class="border-r" style="font-size:12px;text-align: center;">
                             A-1a(01)
                        </td>
                        <td class="border-r" style="font-size:12px;text-align: center;">
                            1
                        </td>
                        <td class="border-r" style="font-size:12px;text-align: center;">
                            
                        </td>
                    </tr>
                  
                    
                </tbody></table>
            </div>
            
            <div style="height: auto; width: 400px; float: right;">
                <table style="width: 100%" cellpadding="0" cellspacing="0">
                    <tbody><tr style="font-size:12px;color:black;height: 27px;" class="fontsize">
                        <td class="border-rb">
                          <b>  FEEDER </b>
                        </td>
                        <td style="font-size:12px;text-align: center;" class="content border-b">
                         
                      
                        </td>
                    </tr>
                    <tr style="height: 27px; width: 100%;" class="fontsize">
                        <td class="border-r" style="font-size:12px;color:black;width: 40%;">
                            
                        </td>
                        <td colspan="3" style="font-size:12px;text-align: center;" class="content border">
                                WEB  GENERATED BILL
                        </td>
                    </tr>
                   
                </tbody></table>
            </div>


            <table class="maintable" cellpadding="0" cellspacing="0">
                <tbody><tr style="height: auto;" class="fontsize">

                    <td colspan="4" style="width: 453pt" class="border-rt">
                        <table class="nested4">
                            <tbody>
                            <tr style="height: 5%">
                                <td colspan="5">
                                    <p style="font-weight: bold;color:black;margin: 0; text-align: left">
                                        <span>NAME &amp; ADDRESS</span>
                                    </p>
                                </td>
                                <td colspan="2" style="text-align: left">
                                    
                                </td>
                            </tr>
                            <tr style="height: 10%">
                                <td colspan="2" style="font-weight: bold;color:black;margin-top: 0; text-align: left; font-size: 9pt;" class="border-b content">
                                    <p style="margin: 0;">
                                        
                                        <br>
                                        
                                      
                                        <br>
                                        
                        
                                         
                                    </p>
                                </td>
                                <td style="margin-top: 0;" class="border-b">
                                     
                                     
                                     <br>
                                     <br>
                                     
                                </td>
                                <td colspan="1" style="margin-top: 0;" class="border-b">
                                    
                                </td>
                              
                            </tr>
                            <tr style="height: 7%;font-weight: bold;color:black;" class="border-t">
                                <td style="font-weight: bold;color:black;width: 95px" class="border-r">
                                    <h4>METER NO</h4>
                                </td>
                                <td style="font-weight: bold;color:black;width: 95px" class="border-r">
                                    <h4>PREVIOUS</h4>
                                </td>
                                <td style="font-weight: bold;color:black;width: 95px" class="border-r">
                                    <h4>PRESENT</h4>
                                </td>
                                <td style="font-weight: bold;color:black;width: 95px" class="border-r">
                                    <h4>FREE UNITS</h4>
                                </td>
                                <td style="font-weight: bold;color:black;width: 71px" class="border-r">
                                    <h4>UNITS</h4>
                                </td>
                                <td style="font-weight: bold;color:black;">
                                    <h4>STATUS</h4>
                                </td>
                            </tr>
                            <tr style="font-weight: normal;color:black;height: 20px" class="content border-t">
                                <td class="border-r" >
                                    
                       
                                </td>
                                <td class="border-r">
                                      
                                </td>
                                <td class="border-r">
                                      
                                </td>
                                <td class="border-r">
                                       
                                </td>
                                <td class="border-r">
                                    
                                </td>
                                <td class="border-r">
                                   
                                </td>
                            </tr>
                            
                            
                        </tbody></table>
                    </td>

                    <td style="float: right; width: 300pt; height: 243pt">
                        <table style="height: 250pt" class="nested6 ">
                            <tbody><tr style="margin-top: -1px; height: 25px">
                                <td class="border-rb " style="width: 25%;">
                                    <h4>MONTH</h4>
                                </td>
                                <td class="border-rb" style="width: 25%;">
                                    <h4>UNITS</h4>
                                </td>
                                <td class="border-rb" style="width: 25%;">
                                    <h4>BILL</h4>
                                </td>
                                <td class="border-b" style="width: 25%;">
                                    <h4>PAYMENT</h4>
                                </td>
                            </tr>
                            <tr style="height: 17px" class="content">
                                <td class="border-r">
                                    
                                </td>
                                <td class="border-r">
                                    
                                    
                                </td>
                                <td class="border-r">
                                    
                                </td>
                                <td>
                                    
                                </td>
                            </tr>
                            <tr style="height: 17px" class="content">
                                <td class="border-r">
                                    
                                </td>
                                <td class="border-r">
                                    
                                    
                                </td>
                                <td class="border-r">
                                    
                                </td>
                                <td>
                                    
                                </td>
                            </tr>
                            <tr style="height: 17px" class="content">
                                <td class="border-r">
                                    
                                </td>
                                <td class="border-r">
                                    
                                    
                                </td>
                                <td class="border-r">
                                    
                                </td>
                                <td>
                                    
                                </td>
                            </tr>
                            <tr style="height: 17px" class="content">
                                <td class="border-r">
                                    
                                </td>
                                <td class="border-r">
                                    
                                    
                                </td>
                                <td class="border-r">
                                    
                                </td>
                                <td>
                                    
                                </td>
                            </tr>
                            <tr style="height: 17px" class="content">
                                <td class="border-r">
                                    
                                </td>
                                <td class="border-r">
                                    
                                    
                                </td>
                                <td class="border-r">
                                    
                                </td>
                                <td>
                                    
                                </td>
                            </tr>
                            <tr style="height: 17px" class="content">
                                <td class="border-r">
                                    
                                </td>
                                <td class="border-r">
                                    
                                    
                                </td>
                                <td class="border-r">
                                    
                                </td>
                                <td>
                                    
                                </td>
                            </tr>
                            <tr style="height: 17px" class="content">
                                <td class="border-r">
                                    
                                </td>
                                <td class="border-r">
                                    
                                    
                                </td>
                                <td class="border-r">
                                    
                                </td>
                                <td>
                                    
                                </td>
                            </tr>
                            <tr style="height: 17px" class="content">
                                <td class="border-r">
                                    
                                </td>
                                <td class="border-r">
                                    
                                    
                                </td>
                                <td class="border-r">
                                    
                                </td>
                                <td>
                                    
                                </td>
                            </tr>
                            <tr style="height: 17px" class="content">
                                <td class="border-r">
                                    
                                </td>
                                <td class="border-r">
                                    
                                    
                                </td>
                                <td class="border-r">
                                    
                                </td>
                                <td>
                                    
                                </td>
                            </tr>
                            <tr style="height: 17px" class="content">
                                <td class="border-r">
                                    
                                </td>
                                <td class="border-r">
                                    
                                    
                                </td>
                                <td class="border-r">
                                    
                                </td>
                                <td>
                                    
                                </td>
                            </tr>
                            <tr style="height: 17px" class="content">
                                <td class="border-r">
                                    
                                </td>
                                <td class="border-r">
                                    
                                    
                                </td>
                                <td class="border-r">
                                    
                                </td>
                                <td>
                                    
                                </td>
                            </tr>
                            <tr style="height: 17px" class="content">
                                <td class="border-r">
                                    
                                </td>
                                <td class="border-r">
                                    
                                   
                                </td>
                                <td class="border-r">
                                    
                                </td>
                                <td>
                                    
                                </td>
                            </tr>
                        </tbody></table>
                    </td>
                </tr>
            </tbody></table>
            <div class="border-t" style="width:755pt; height: 415pt">
                <table class="nested7" style="font-weight: bold;color:black;width: 350pt; height: 386pt; float: left">
                    <tbody>
                    <tr class="fontsize" style="height: 24px;">
                        <td class="border-rb nestedtdwidth">
                            <b>UNITS CONSUMED</b>
                        </td>
                        <td class="border-rb nestedtdwidth content">
                            
                        </td>
                        <td class="border-rb nestedtdwidth">
                            <b>ELECTRICITY DUTY</b>
                        </td>
                        <td class="border-rb nestedtdwidth content">
                            8.97
                        </td>
                    </tr>
                    <tr class="fontsize" style="height: 15px;">
                        <td class="border-rb nestedtdwidth">
                            <b>COST OF ELECTRICITY</b>
                        </td>
                        <td class="border-rb nestedtdwidth content">
                            4590
                        </td>
                        <td class="border-rb nestedtdwidth">
                            <b>TV FEE</b>
                        </td>
                        <td class="border-rb nestedtdwidth content">
                            0
                        </td>
                    </tr>
                    <tr class="fontsize" style="height: 24px;">
                        <td class="border-rb nestedtdwidth">
                            <b>METER RENT FIX CHARGES</b>
                        </td>
                        <td class="border-rb nestedtdwidth content">
                           
                               0
                            
                        </td>
                        <td class="border-rb nestedtdwidth">
                            <b>GST</b>
                        </td>
                        <td class="border-rb nestedtdwidth content">
                            
                              0
                            
                        </td>
                    </tr>
                    <tr class="fontsize" style="height: 24px;">
                        <td class="border-rb nestedtdwidth">
                            <b>SERVICE RENT</b>
                        </td>
                        <td class="border-rb nestedtdwidth content">
                            0
                        </td>
                        <td class="border-rb nestedtdwidth">
                          <b> INCOME TAX </b>
                        </td>
                        <td class="border-rb nestedtdwidth content">

                                                  </td>
                    </tr>
                    <tr style="height: 15px;" class="fontsize">
                        <td class="border-rb nestedtdwidth">
                          <b> FUEL PRICE ADJUSTMENT </b>
                        </td>
                        <td class="border-rb nestedtdwidth content">
                          812   </td>
                        
                        <td class="border-rb nestedtdwidth">
                            <b>EXTRA TAXES</b>
                        </td>
                        <td class="border-rb nestedtdwidth content">
                        
                        </td>
                    </tr>
                    <tr style="height: 24px;" class="fontsize">
                        <td class="border-rb nestedtdwidth">
                            <b>F.C SURCHARGES</b>
                        </td>
                        <td class="border-rb nestedtdwidth content">
                            
                            
                            
                        </td> 
                        <td class="border-rb nestedtdwidth">
                            <b>FURTHER TAXES</b>
                        </td>
                        <td class="border-rb nestedtdwidth content">
                            
                             
                            
                        </td>
                    </tr>
                    <tr style="font-weight: bold;color:black;height: 15px;" class="fontsize">
                        <td class="border-rb nestedtdwidth" style="font-weight: bold;color:black;">
                            <b>QURTER TERRIF ADJUSTMENT</b>
                        </td>
                        <td class="border-rb nestedtdwidth content">
                          249
                        </td>
                        <td class="border-rb nestedtdwidth">
                            <b>RETAILER TAX</b>
                        </td>
                        <td class="border-rb nestedtdwidth content">
                            
                        </td>
                    </tr>
                    <tr style="height: 15px;" class="fontsize">
                        <td class="border-rb nestedtdwidth">
                            <b>TOTAL</b>
                        </td>
                        <td class="border-rb nestedtdwidth content">
                          5737.0
                        </td>
                        <td class="border-rb nestedtdwidth">
                        </td>
                        <td class="border-rb nestedtdwidth content">
                            
                        </td>
                    </tr>
                 
                  
                
                </tbody></table>
                <table class="nested7" style="font-weight: bold;color:black;width: 405pt; height: 420pt">
                    <tbody><tr class="fontsize" style="height: 28px; text-align: center">
                        <td colspan="2" class="border-b" style="font-size: 16px">
                            <b>TOTAL CHARGES</b>
                        </td>
                    </tr>
                    <tr class="fontsize" style="font-weight: bold;color:black;height: 24px;">
                        <td class="border-rb nestedtd2width">
                            <b>ARREAR/AGE</b>
                        </td>
                        <td class="border-b  nestedtd2width content">
                         
                        </td>
                    </tr>
                    <tr class="fontsize" style="height: 24px;">
                        <td class="border-rb nestedtd2width">
                            <b>WITH IN DUE DATE</b>
                        </td>
                        <td class="border-b  nestedtd2width content">
                            
                        </td>
                    </tr>
                    <tr class="fontsize" style="height: 24px;">
                        <td class="border-rb nestedtd2width">
                            <b>AFTER DUE DATE</b>
                        </td>
                        <td class="border-b  nestedtd2width content">
                            
                        </td>
                    </tr>
                  
                    <tr class="fontsize" style="height: 24px;">
                        <td class="border-rb nestedtd2width">
                            <b>PAYABLE AFTER DUE DATE</b>
                        </td>
                        <td class="border-b  nestedtd2width content">
                            2425
                            <br>
                            <span></span>
                        </td>
                    </tr> 
                   

                    <tr class="fontsize border-b" style="height: 130px;vertical-align:top">
                        <td id="idmtr1img" style="height: 142px;" >
                          <h2>  Previous Readings</h2>
                          
                        </td>

                        
                         <tr class="fontsize " style="height: 145px;">
                        <td id="idmtr1img" style="height: 142px;" >
                            <h2>Current Readings</h2>
                            
                        </td>

                        
                    </tr>
                    </tr>
                    <tr class="fontsize border-b" style="height: 44px;">
                        

                        <td id="idSubDivWisePhoneNo" colspan="1" style="text-align: center" class="border-b">
                            <b>FOR COMPLAINT CONTACT</b>
                            <br>
                            <br>
                            <b>SDO</b>
                            <br>
                            3459-366356
                        </td> 

                        
                        
                        
                        

                        
                        <td colspan="1" style="text-align: center" class="border-b">
                            
                        </td>
                        
                    </tr>
                </tbody></table>
            </div>
            <div class="border-b" style="width: 100%; height: 25px" id="Tr1">
                <img src="{{asset('frontend/css')}}/bill_sample_files/cuthere.gif" alt="cuthere" id="Img2">
            </div>
            <div class="headertable fontsize">
                <div>
                    <div style="height: 100px; width: 15%; float: left">
                        <!-- <img style="margin: auto; max-width: 100%; max-height: 100%;" src=" alt="PESCO" id="Img1"> -->
                    </div>
                    <div style="height: 100px; width: 77.6%; float: right; margin-right: 60px;">
                        <table style="width: 100%; text-align: right;">
                            <tbody><tr>
                                <td colspan="3">
                                    <h2 style="font-weight: bold;color:black;float: left; font-weight: 800; margin-left: 0px; margin-bottom: 0px;">
                                        Electricity  Consumer Bill
                                
                                   
                                    </h2>
                                </td>
                            </tr>
                            <tr>
                                <td style="width: 170px; color: #1a75ff;">
                                    <span><b>
                                        <!-- www.pesco.com.pk --></b></span>
                                </td>
                                <td>
                                    <table style="font-weight: bold;color:black;width: 78%; border-collapse: collapse; text-align: center">
                                        <tbody><tr class="border-tb">
                                            <td class="border-r" style="border-left: 1px solid #78578e; font-weight: bold;color:black;">
                                                <h4>Name</h4>
                                            </td>
                                            <td class="border-r content">
                                             
                                            </td>
                                        </tr>
                                        <tr class="border-tb">
                                            <td class="border-r" style="font-weight: bold;color:black;border-left: 1px solid #78578e; font-weight: bold;color:black;">
                                                <h4>Address</h4>
                                            </td>
                                            <td class="border-r content">
                                               
                                            </td>
                                        </tr>

                                    </tbody></table>
                                </td>
                            </tr>
                            
                        </tbody></table>
                    </div>
                </div>
                <div style="float: right; margin-right: 177px; height: 70px; margin-bottom: 15px; overflow: hidden;">
                    <img src="{{asset('frontend/img')}}/barcode.png" id="LinearBarcode1" style="background-color:White;font-family:Times New Roman;font-size:10pt;font-weight:normal;font-style:normal;text-decoration:none;height:89px;width:336px;">
                    
                </div>
                <div style="width: 98%; margin: 0 auto 10px;">
                    <table style="text-align: center; width: 100%; border-collapse: collapse;">
                        <tr style="height: 30px;">
                            <td class="border-rb border-t" style="width: 15%; font-weight: bold;color:black;border-left: 1px solid #78578e;">
                                <h4>CONSUMER ID</h4>
                            </td>
                            <td class="border-rb border-t" style="width: 15%; font-weight: bold;color:black;border-left: 1px solid #78578e;">
                                <h4>Due Date</h4>
                            </td>
                            <td class="border-rb border-t" style="width: 15%; font-weight: bold;color:black;">
                                <h4>METER NO</h4>
                            </td>
                          
                           <td class="border-rb border-t" style="width: 15%; font-weight: bold;color:black;">
                                <h4>PREVIOUS READING</h4>
                            </td>
                          <td class="border-rb border-t" style="width: 15%; font-weight: bold;color:black;">
                                <h4>CURRENT READING</h4>
                            </td>
                          
                            <td class="border-rb border-t" style="width: 15%; font-weight: bold;color:black;">
                                <h4>UNIT CONSUMED</h4>
                            </td>
                            <td class="border-rb border-t" style="width: 15%; font-weight: bold;color:black;">
                                <h4>WITH IN DUE DATE</h4>
                            </td>
                           
                           <td class="border-rb border-t" style="width: 15%; font-weight: bold;color:black;">
                                <h4>AFTER DUE DATE</h4>
                            </td>
                           
                            
                                <br/> 
                                <span> </span>
                            </td>
                        </tr>
                        <tr style="height: 40px;">
                            <td class="border-rb content" style="width: 15%; text-align: center; border-left: 1px solid #78578e;">
                       
                            </td>
                            <td class="border-rb content" style="width: 15%; text-align: center; border-left: 1px solid #78578e;">
                      
                            </td>
                            <td class="border-rb content" style="width: 15%; text-align: center;">
                               
                            </td>
                        
                            <td class="border-rb border-r content" style="font-weight: bold;color:black;width: 15%;">
                                
                            </td>
                            <td class="border-rb border-r content" style="font-weight: bold;color:black;width: 15%;">
                                
                                <br/> 
                                <span> </span>
                            </td>
                            <td class="border-rb border-r content" style="font-weight: bold;color:black;width: 15%;">
                              
                                <br/> 
                                <span> </span>
                            </td>
                            <td class="border-rb border-r content" style="font-weight: bold;color:black;width: 15%;">
                                
                                <br/> 
                                <span> </span>
                            </td>
                            
                            <td class="border-rb border-r content" style="font-weight: bold;color:black;width: 15%;">
                            
                                <br/> 
                                <span> </span>
                            </td>
                            
                           
                            
                            
                        </tr>
                    </table>
                </div>
                <div style="width: 98%; margin: 0 auto 10px;">
                    </div></div></div></form></body></html>