<!DOCTYPE html>
<html lang="en">
<head>
 <meta charset="UTF-8">
 <meta name="viewport" content="width=device-width, initial-scale=1.0">
 <title>Bill</title>
<style>

@media print
{    
    .noprint
    {
      
        display: none !important;
    }
    @page {
        
        /* size:A4; */
        /* text-align: center; */
        /* margin-right:100px; */
        /* size: A4; */
        size: letter;
    margin: 80px 10px 0px 0px;

    /* padding: 12px; */

       
    }
    .page_div {
        page-break-before: always;
        
    }
}
/*! normalize.css v4.1.1 | MIT License | github.com/necolas/normalize.css */

/**
 * 1. Change the default font family in all browsers (opinionated).
 * 2. Prevent adjustments of font size after orientation changes in IE and iOS.
 */

 html {
  font-family: sans-serif; /* 1 */
  -ms-text-size-adjust: 100%; /* 2 */
  -webkit-text-size-adjust: 100%; /* 2 */
}

/**
 * Remove the margin in all browsers (opinionated).
 */
/* 
body {
  margin: 0;
  
} */

/* HTML5 display definitions
   ========================================================================== */

/**
 * Add the correct display in IE 9-.
 * 1. Add the correct display in Edge, IE, and Firefox.
 * 2. Add the correct display in IE.
 */

article,
aside,
details, /* 1 */
figcaption,
figure,
footer,
header,
main, /* 2 */
menu,
nav,
section,
summary { /* 1 */
  display: block;
}

/**
 * Add the correct display in IE 9-.
 */

audio,
canvas,
progress,
video {
  display: inline-block;
}

/**
 * Add the correct display in iOS 4-7.
 */

audio:not([controls]) {
  display: none;
  height: 0;
}

/**
 * Add the correct vertical alignment in Chrome, Firefox, and Opera.
 */

progress {
  vertical-align: baseline;
}

/**
 * Add the correct display in IE 10-.
 * 1. Add the correct display in IE.
 */

template, /* 1 */
[hidden] {
  display: none;
}

/* Links
   ========================================================================== */

/**
 * 1. Remove the gray background on active links in IE 10.
 * 2. Remove gaps in links underline in iOS 8+ and Safari 8+.
 */

a {
  background-color: transparent; /* 1 */
  -webkit-text-decoration-skip: objects; /* 2 */
}

/**
 * Remove the outline on focused links when they are also active or hovered
 * in all browsers (opinionated).
 */

a:active,
a:hover {
  outline-width: 0;
}

/* Text-level semantics
   ========================================================================== */

/**
 * 1. Remove the bottom border in Firefox 39-.
 * 2. Add the correct text decoration in Chrome, Edge, IE, Opera, and Safari.
 */

abbr[title] {
  border-bottom: none; /* 1 */
  text-decoration: underline; /* 2 */
  text-decoration: underline dotted; /* 2 */
}

/**
 * Prevent the duplicate application of `bolder` by the next rule in Safari 6.
 */

b,
strong {
  font-weight: inherit;
}

/**
 * Add the correct font weight in Chrome, Edge, and Safari.
 */

b,
strong {
  font-weight: bolder;
}

/**
 * Add the correct font style in Android 4.3-.
 */

dfn {
  font-style: italic;
}

/**
 * Correct the font size and margin on `h1` elements within `section` and
 * `article` contexts in Chrome, Firefox, and Safari.
 */

h1 {
  font-size: 2em;
  margin: 0.67em 0;
}

/**
 * Add the correct background and color in IE 9-.
 */

mark {
  background-color: #ff0;
  color: #000;
}

/**
 * Add the correct font size in all browsers.
 */

small {
  font-size: 80%;
}

/**
 * Prevent `sub` and `sup` elements from affecting the line height in
 * all browsers.
 */

sub,
sup {
  font-size: 75%;
  line-height: 0;
  position: relative;
  vertical-align: baseline;
}

sub {
  bottom: -0.25em;
}

sup {
  top: -0.5em;
}

/* Embedded content
   ========================================================================== */

/**
 * Remove the border on images inside links in IE 10-.
 */

img {
  border-style: none;
}

/**
 * Hide the overflow in IE.
 */

svg:not(:root) {
  overflow: hidden;
}

/* Grouping content
   ========================================================================== */

/**
 * 1. Correct the inheritance and scaling of font size in all browsers.
 * 2. Correct the odd `em` font sizing in all browsers.
 */

code,
kbd,
pre,
samp {
  font-family: monospace, monospace; /* 1 */
  font-size: 1em; /* 2 */
}

/**
 * Add the correct margin in IE 8.
 */

figure {
  margin: 1em 40px;
}

/**
 * 1. Add the correct box sizing in Firefox.
 * 2. Show the overflow in Edge and IE.
 */

hr {
  box-sizing: content-box; /* 1 */
  height: 0; /* 1 */
  overflow: visible; /* 2 */
}

/* Forms
   ========================================================================== */

/**
 * 1. Change font properties to `inherit` in all browsers (opinionated).
 * 2. Remove the margin in Firefox and Safari.
 */

button,
input,
select,
textarea {
  font: inherit; /* 1 */
  margin: 0; /* 2 */
}

/**
 * Restore the font weight unset by the previous rule.
 */

optgroup {
  font-weight: bold;
}

/**
 * Show the overflow in IE.
 * 1. Show the overflow in Edge.
 */

button,
input { /* 1 */
  overflow: visible;
}

/**
 * Remove the inheritance of text transform in Edge, Firefox, and IE.
 * 1. Remove the inheritance of text transform in Firefox.
 */

button,
select { /* 1 */
  text-transform: none;
}

/**
 * 1. Prevent a WebKit bug where (2) destroys native `audio` and `video`
 *    controls in Android 4.
 * 2. Correct the inability to style clickable types in iOS and Safari.
 */

button,
html [type="button"], /* 1 */
[type="reset"],
[type="submit"] {
  -webkit-appearance: button; /* 2 */
}

/**
 * Remove the inner border and padding in Firefox.
 */

button::-moz-focus-inner,
[type="button"]::-moz-focus-inner,
[type="reset"]::-moz-focus-inner,
[type="submit"]::-moz-focus-inner {
  border-style: none;
  padding: 0;
}

/**
 * Restore the focus styles unset by the previous rule.
 */

button:-moz-focusring,
[type="button"]:-moz-focusring,
[type="reset"]:-moz-focusring,
[type="submit"]:-moz-focusring {
  outline: 1px dotted ButtonText;
}

/**
 * Change the border, margin, and padding in all browsers (opinionated).
 */

fieldset {
  border: 1px solid black;
  margin: 0 2px;
  padding: 0.35em 0.625em 0.75em;
}

/**
 * 1. Correct the text wrapping in Edge and IE.
 * 2. Correct the color inheritance from `fieldset` elements in IE.
 * 3. Remove the padding so developers are not caught out when they zero out
 *    `fieldset` elements in all browsers.
 */

legend {
  box-sizing: border-box; /* 1 */
  color: inherit; /* 2 */
  display: table; /* 1 */
  max-width: 100%; /* 1 */
  padding: 0; /* 3 */
  white-space: normal; /* 1 */
}

/**
 * Remove the default vertical scrollbar in IE.
 */

textarea {
  overflow: auto;
}

/**
 * 1. Add the correct box sizing in IE 10-.
 * 2. Remove the padding in IE 10-.
 */

[type="checkbox"],
[type="radio"] {
  box-sizing: border-box; /* 1 */
  padding: 0; /* 2 */
}

/**
 * Correct the cursor style of increment and decrement buttons in Chrome.
 */

[type="number"]::-webkit-inner-spin-button,
[type="number"]::-webkit-outer-spin-button {
  height: auto;
}

/**
 * 1. Correct the odd appearance in Chrome and Safari.
 * 2. Correct the outline style in Safari.
 */

[type="search"] {
  -webkit-appearance: textfield; /* 1 */
  outline-offset: -2px; /* 2 */
}

/**
 * Remove the inner padding and cancel buttons in Chrome and Safari on OS X.
 */

[type="search"]::-webkit-search-cancel-button,
[type="search"]::-webkit-search-decoration {
  -webkit-appearance: none;
}

/**
 * Correct the text style of placeholders in Chrome, Edge, and Safari.
 */

::-webkit-input-placeholder {
  color: inherit;
  opacity: 0.54;
}

/**
 * 1. Correct the inability to style clickable types in iOS and Safari.
 * 2. Change font properties to `inherit` in Safari.
 */

::-webkit-file-upload-button {
  -webkit-appearance: button; /* 1 */
  font: inherit; /* 2 */
}


body
{
    text-align: center;
    font-family: sans-serif,arial;
    color:black;
}
.content
{
    color:Black;
}
.maincontent
{
    /*width: 730pt;*/
    width: 753pt;
    min-width: 920px;
    margin: 10pt auto;
    border: 1px solid black;
    height: auto;
    overflow: hidden;
}
.maincontentnf
{
    width: 50%; /* min-width : 920px;*/
    margin-left: 300px;
    border: 4px solid black;
    height: 100%;
    overflow: hidden;
    position: absolute;
}
.innercontentnf
{
    padding-top: 300px;
    width: 100%;
    height: 100%;
}
h1
{
    margin: 0;
    /*height: 20px;*/
}

h2
{
    margin-top: 0;
    margin-left: 50px;
}

.zeroMargin 
{
    margin : 0pt;
}
h3
{
    margin: 0;
    color: blue;
}
h4
{
    margin:5px 5px;
    font-size:11px;    
}
.headp
{
    margin: 0;
    margin-left: 50px;
}
span
{
    font-size: small;
}
.header
{
    width: 100%;
    height: 70pt;
    display: inline block;
    float: left;
}
.headerimg
{
    width: 15%; /* margin-top:19px;*/
    float: left;
    position: relative;
    height: 100%;
}

.heading
{
    float: left; /*position:relative;*/
    padding: 0;
    width: 85%;
    height: 100%;
}
.maintable
{
    width: 100%;
    table-layout: fixed;
    height: auto;
    border-top: 1px solid black;
    font-family: sans-serif;
    border-collapse: collapse;
    font-size: .8;
    -moz-box-sizing: border-box;
    
}
.nestable1
{
    width: 100%;
    height: 44px;
    border-spacing: 0px;
}
.border-rb
{
    border-right: 1px solid black;
    border-bottom: 1px solid black;
}
.border-r
{
    border-right: 1px solid black;
}
.border-b
{
    border-bottom: 1px solid black;
}
.border-t
{
    border-top: 1px solid black;
}
.border-rt
{
    border-top: 1px solid black;
    border-right: 1px solid black;
}
.border-tb
{
    border-top: 1px solid black;
    border-bottom: 1px solid black;
}
.nesttable3
{
    border-collapse: collapse;
    width: 100%;
    height: 96px;
    border-spacing: 0px;
    -moz-box-sizing: border-box;
}
.nested4
{
    border-collapse: collapse;
    width: 100%;
    height: 150pt;
}



.fontsize
{
    font-family: sans-serif;
    font-size: .8em;
}
.nested5
{
    border-collapse: collapse;
    width: 100%;
    height: 100%;
    border-spacing: 0px;
    padding-top: 0;
    -moz-box-sizing: border-box;
}

.nested6
{
    border-collapse: collapse;
    width: 100%;
    height: 100%;
    border-spacing: 0px;
    -moz-box-sizing: border-box;
}
.nested7
{
    border-collapse: collapse;
    width: 100%;
    height: 458px;
    border-spacing: 0px;
    padding-top: 0;
    -moz-box-sizing: border-box;
}
.nested8
{
    border-collapse: collapse;
    width: 100%;
    height: 450px;
    border-spacing: 0px;
    padding-top: 0;
    -moz-box-sizing: border-box;
}
.nestedwidth1
{
    background-color: #EBFA48;
    width: 25%;
}
.nestedtdwidth
{
    width: 25%;
}
.nestedtd2width
{
    width: 50%;
}
.footer1
{
    width: 100%;
    height: 270px;
    float: left;
}
.footerimg
{
    width: 15%; /* margin-top:19px;*/
    float: left;
    position: relative;
    height: 20%;
    margin-top: 2px;
}
.footertext
{
    float: right;
    width: 85%;
    height: 20%;
}
.billno
{
    float: right;
}
.footerconsumerid
{
    height: 20px;
    border: 1px solid black;
    width: 40%;
    float: right;
    margin-right: 100px;
}
.footercontent
{
    margin-top: 180px;
    border: 1px solid black;
    width: 95%;
    height: 70px;
    margin-left: 20px;
}

/******************* COLORS **********************/
.color-red {
    color: red;
}

.color-black {
    color: #161414;
}


.magnifyarea { /* CSS to add shadow to magnified image. Optional */
	box-shadow: 5px 5px 7px #818181;
	-webkit-box-shadow: 5px 5px 7px #818181;
	-moz-box-shadow: 5px 5px 7px #818181;
	filter: progid:DXImageTransform.Microsoft.dropShadow(color=#818181, offX=5, offY=5, positive=true);
	background: white;
}

.targetarea { /* CSS for container div(s) of the zoomable image */
	width: 325px; /* wide or wider than the widest zoomable image */
	height: 338px; /* high or higher than the tallest zoomable image */
	margin-top:3px;
}

#two { /* Added CSS for second target div of zoomable images */
	height: 243px; /* high or higher than the tallest zoomable image */
}

.targetarea img { /* zoomable image */
	margin: auto; /* for horizontal centering */
	display: block; /* also for horizontal centering */
	position: relative; /* along with on the fly calculations in script, for vertical centering */
	border-width: 0;
}

.thumbs { /* divs holding the trigger links - styles optional, used here to center their links below their respective zoomable image */
	padding-top: 25px;
	width: 325px;
	text-align: center;
}

.thumbs a { /* trigger links on the thumbnail images */
	text-decoration: none; /* avoid underlines of images, text or spaces in these links */
}

.thumbs img { /* trigger images - the thumbnails used to load new zoomable images into the targetarea */
	border-width: 0; /* avoid default borders in some browsers */
}

#description, #description2 {
	position: absolute; /* required for description folows image bottom (descpos: true) */
	width: 325px; /* should be width of zoomable image container (.targetarea) */
	text-align: center;
	font: bold 95% sans-serif;
	margin-top: 3px; /* when following image bottom, this sets a fixed distance for that */
	color: #222;
	background-color: #fff;
}

/* tr{
    border : 1px solid black;
} */
</style>

</head>

<body >
@foreach($record  as $kk => $bill_data)
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
<div class="page_div"  >
<div class="maincontent fontsize">
        <div class="header " >
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
                    
                        <h4>ED</h4>
                    
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
                    {{$ref_no}}  
                        
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

            <!-- i change width here  -->
                <td colspan="4" style="width: 603px" class="border-r">
                    <table class="nested4">
                        <tbody><tr>
                            <td colspan="3">
                                <p style="margin: 0; text-align: left; padding-left: 20px">
                                    <span>NAME &amp; ADDRESS</span>
                                    <br>
                                    <span>{{$bill_data->full_name}} </span>
                                    <br>
                                    <span>{{$bill_data->father_name}} </span>
                                    <br>
                                    <span>{{$bill_data->address}} </span>
                                    <br>
                                    <!-- <span>CHD</span> -->
                                    <!-- <br> -->
                                    <!-- <span></span> -->
                                    
                                    
                                </p>

                            </td>
                            <td colspan="1">
                                <h2 class="zeroMargin" id="govtMsg" visible="false"></h2>
                            </td> 
                            <!-- <td colspan="2">
                                <h2 class="zeroMargin display-none"> Net Metering Conn. </h2>
                            </td> -->
                            <td colspan="2">
                                <h2 class="zeroMargin" hidden=""> Life Line Consumer</h2>
                            </td>
                        </tr>
                        <!-- <tr>
                            <td colspan="2">
                                <p style="margin: 0; text-align: left; padding-left: 20px">
                                    <span>NAME &amp; ADDRESS</span>
                                    <br>
                                    <span>fahad ali </span>
                                    <br>
                                    <span>xyz </span>
                                    <br>
                                    <span>charsadda </span>
                                    <br>
                                     <span>CHD</span> 
                                     <br>
                                   <span></span> 
                                    
                                    
                                </p> 
                            </td>
                            <td colspan="3" style="text-align: left;">
                            <h2 class="color-black">Net Metering Conn.</h2>
                                <h2 class="color-red">Say No To Corruption</h2>
                                

                                

                                <span style="font-size: 8pt; color: black"> </span>
                                <br>

                                

                            </td>
                            <td>
                                
                                <h3 style="font-size: 14pt;"> </h3>
                                <h2>  <br> </h2>
                            </td>
                        </tr> -->
                        <tr>
                            <td style="margin-top: 0;" class="border-b">
                                
                                
                                <div></div>
                            </td> 
                            <td colspan="5" style="margin-top: 0;" class="border-b">
                                <strong lang="ur" dir="rtl" style="font-size: 16px">
                                    &nbsp;
                                                                        <!-- -- معزز صارف : بجلی کے بل میں ایندھن کی قیمت کا فرق   (FPA)دو ماہ بعد شامل کیا جاتا ہے آپ کے  اس بل میں JUL 23 کے صرف شدہ 161 یونٹس کے ایندھن کی قیمت کے  469.54 روپے بھی شامل ہیں   -->
                                </strong>
                            </td>
                        </tr>
                        <tr style="height: 7%;" class="border-tb">
                            <td style="width: 130px" class="border-r">
                                <h4>METER NO</h4>
                            </td>
                            <td style="width: 140px" class="border-r">
                                <h4>PREV.READING</h4>
                            </td>
                            <td style="width: 130px" class="border-r">
                                <h4>CUR.READING</h4>
                            </td>
                            <!-- <td style="width: 60px" class="border-r">
                                <h4>MF</h4>
                            </td> -->
                            <td style="width: 90px" class="border-r">
                                <h4>UNITS</h4>
                            </td>
                             <td>
                                <h4>STATUS</h4>
                            </td> 
                        </tr>
                        <tr style="height: 30px" class="content">
                            <td class="border-r">
                            {{$bill_data->meter_no}} <br>
                            </td>
                            <td class="border-r">
                            {{$previous_reading}} <br>
                            </td>
                            <td class="border-r">
                            {{$current_reading}} <br>
                            </td>
                            <td class="border-r">
                            {{$offpeak_units}} <br>
                            </td>
                             <td class="">
                                 @if($bill_data->reading_status) {{$bill_data->reading_status}} @endif
                            </td>
                           
                        </tr>
                        
                    </tbody></table>
                </td>

                <td style="float: right; width: 300pt; height: 20pt">
                    <table style="height: 10pt" class="nested6 ">
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
                       
                      <?php
                        $payment_and_bill = DB::table('consumer_bills')
                        ->select('consumer_bills.*','payment_receives.payment_amount as pay_amount')
                        ->leftJoin('payment_receives', 'payment_receives.bill_id', '=', 'consumer_bills.id')
                        ->where('consumer_bills.cm_id',$bill_data->cm_id)
                        ->where('consumer_bills.id','!=',$bill_data->bill_id)
                        ->where('consumer_bills.billing_month_year','<',$bill_data->billing_month_year)
                        ->orderBy('consumer_bills.id', 'desc')
                        ->limit(12)->get();
                      ?>
                      
                      @if($payment_and_bill)
                      
                            @foreach ($payment_and_bill as $pabkey => $rpnb )
                                <tr style="height: 17px" class="content">
                                        
                                    <td class="border-r">
                                        {{date('M,y',strtotime($rpnb->billing_month_year))}}
                                    </td>
                                    <td class="border-r">
                                        {{$rpnb->offpeak_units}}
                                    </td>
                                    <td class="border-r">
                                        {{-- @if ($rpnb->is_payed_on_date)
                                                {{$rpnb->net_bill}}
                                        @else
                                                {{$rpnb->net_bill+$rpnb->l_p_surcharge}}
                                        @endif --}}
                                        {{$rpnb->WithinDuedate}}
                                    </td>
                                    <td>
                                        {{$rpnb->pay_amount}}
                                    </td>
                                </tr>
                            @endforeach
                    @endif

                        
                       
                        
                        
                      
                        
                    </tbody></table>
                </td>
            </tr>
        </tbody></table>
        <div class="border-t" style="width: 755pt; height: 430pt">
            <table class="nested7" style="width: 454pt; height: 100pt; float: left">
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
                <tr style="border-bottom:1px solid black;">
                
               
                    <td colspan="2" style="vertical-align: top;">
                        <table width="101%">
                            <tr class="fontsize" style="height: 24px;">
                                <td class="border-rb nestedtdwidth" style="background-color: #B2E6FF; "  >UNITS CONSUMED</td>
                                <td class="border-rb nestedtdwidth content">{{$offpeak_units}} </td>
                            </tr>

                            <tr class="fontsize" style="height: 24px;">
                                <td class="border-rb nestedtdwidth" style="background-color: #B2E6FF">COST OF ELECTRICITY</td>
                                <td class="border-rb nestedtdwidth content">{{$cost_of_electricity}}  </td>
                          
                            </tr>
                            <?php $pesco_total=0;?>
                            <?php $pesco_total+=$cost_of_electricity ?>
                            @foreach (json_decode($bill_data->charges_breakup) as $chbkey => $charges_b_row )
                            <tr class="fontsize" style="height: 24px;">
                                <td class="border-rb nestedtdwidth" style="background-color: #B2E6FF">{{$charges_b_row->charges_type}} </td>
                                <td class="border-rb nestedtdwidth content">{{$charges_b_row->calculated_charges}}  </td>
                            </tr>
                            <?php $pesco_total+=$charges_b_row->calculated_charges; ?>
                            @endforeach
                           

                            <tr class="fontsize" style="height: 24px;">
                                <td class="border-rb nestedtdwidth" style="background-color: #B2E6FF">TOTAL</td>
                                <td class="border-rb nestedtdwidth content">{{$pesco_total}}  </td>
                            </tr>

                        </table>
                    </td>
                    <td colspan="2" style="vertical-align: top;">
                        <table width="100%">
                            <?php $gov_total=0; ?>
                        @foreach (json_decode($bill_data->taxes_breakup) as $tbkey => $tb_row )
                            <tr class="fontsize" style="height: 24px;">
                                <td class="border-rb nestedtdwidth" style="background-color: #FFB2B2;"> {{$tb_row->tax_type}}</td>
                                <td class="border-rb nestedtdwidth content">{{$tb_row->calculated_tax}}</td>
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
                    {{-- <td class="border-rb" style="background-color: #FFB2B2;" rowspan="3">
                        
                        
                        
                    </td> --}}
                    {{-- <td class="border-rb content" rowspan="3">
                        
                        
                        <br>
                        
                        <br>
                        
                                
                        <br>
                        
                        <br>
                        
                        <br>
                        
                        <br>
                        &ensp;&ensp; &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;

                        
                    </td> --}}
                </tr>
                <tr class="border-b fontsize" style="height: 24px;">
                    <td class="border-rb" colspan="2" rowspan="3">
                        <table style="width: 100%;">
                            
                            <tbody>
                                <tr>
                                <td>GOP Tariff &nbsp; &nbsp; x  &nbsp;&nbsp; Units
                                </td>
                                {{-- <td></td> --}}
                                {{-- <td></td> --}}
                            </tr>
                            <tr class="content">
                                <td>
                                    @foreach (json_decode($bill_data->off_peak_bill_breakup) as $ofpkkey => $off_peak_bil_breakup_row )
                                        <?php echo $off_peak_bil_breakup_row->units ?> X <?php  echo $off_peak_bil_breakup_row->charges;  echo "="; echo $off_peak_bil_breakup_row->charges*$off_peak_bil_breakup_row->units;   echo "<br/>" ?> 
                                    @endforeach
                                </td>
                            </tr>
                            {{-- <tr style="font-size: 14pt" class="content display-none">
                                <td>
                                   
                                </td>
                            </tr> --}}
                        </tbody>
                    </table>

                        
                    </td>
                </tr>
                {{--
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
                </tr> --}}
                {{--<tr style="height: 32px;" class="fontsize">
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
                --}}
            </tbody></table>

            <!-- total charges table section -->
            <!-- margin-top : -20px -->
            <table class="nested7" style="width: 300pt; height: 319pt;">
                <tbody><tr class="fontsize" style="height: 27px; background-color: #7ADEFF; text-align: center;border:1px solid black ">
                    <td colspan="5" class="border-b" style="font-size: 16px; ">
                        <b>TOTAL CHARGES</b>
                    </td>
                </tr>
                <tr class="fontsize" style="height: 24px;">
                    <td class="border-rb nestedtd2width" style="background-color: #7ADEFF; border-left:1px solid black;">
                        <b>ARREAR/AGE</b>
                    </td>
                    <td colspan="3" class="border-b  nestedtd2width content">
                    {{$arrear}}
                    </td>
                </tr>
                <tr class="fontsize" style="height: 24px;">
                    <td class="border-rb nestedtd2width" style="background-color: #7ADEFF; border-left:1px solid black;">
                        <b>CURRENT BILL</b>
                    </td>
                    <td colspan="3" class="border-b  nestedtd2width content">
                    <?php  $current_bill=($pesco_total+$gov_total);
                                // $payable=$current_bill;
                                $payable_after_due_date=$payable+$lp_surcharge;
                                echo $current_bill; 
                       ?>
                    </td>
                </tr>
                <tr class="fontsize" style="height: 24px;">
                    <td class="border-rb nestedtd2width" style="background-color: #7ADEFF; border-left:1px solid black;">
                        <b>BILL ADJUSTMENT
                            </b>
                    </td>
                    <td colspan="3" class="border-b  nestedtd2width content">
                        {{$bill_data->adjustment}} 
                    </td>
                </tr>
                <tr class="fontsize" style="height: 24px;">
                    <td class="border-rb nestedtd2width" style="background-color: #7ADEFF; border-left:1px solid black;">
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
                    <td class="border-rb nestedtd2width" style="background-color: #7ADEFF; border-left:1px solid black;">
                        <div id="subsidiesId"><b>SERVICES CHARGES </b></div>
                        <div id="releifMsgTitleId"><b>  </b></div>
                    </td>
                    <td colspan="3" class="border-b nestedtd2width content">
                        {{$bill_data->service_charges}}
                    </td>
                </tr>
                <tr class="fontsize" style="height: 24px;">
                    <td class="border-rb nestedtd2width" style="background-color: #7ADEFF; ">
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
                <!-- <tr class="fontsize border-b" style="height: 145px;"> -->
                    <!-- <td colspan="2"> -->
                        <!-- <table style="width: 100%"> -->
                            <!-- <tbody><tr> -->
                            <!-- <td id="idmtr1img" style="height: 142px;"> -->
                                    
                                    <!-- <img id="mtr1img" src="learning.png" style="height:100%;width:95%;"> -->
                                <!-- </td> -->

                                
                                
                                
                                
                            <!-- </tr> -->
                        <!-- </tbody></table> -->
                    <!-- </td> -->

                </tr>

                <!-- <tr id="idComplaint" class="fontsize border-b" style="border: none; height: 18px;">
                    </tr> -->

                <tr class="fontsize" style="height: 44px;">


                    <td class="" colspan="1" style="text-align: left;">

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

                    
                    <td class=" display-none" colspan="2" style="text-align: left">
                        <div>
                            <b>Center Name : </b>
                        </div>
                        <div>
                            <b>  </b>
                        </div>
                    </td>
                    <td id="idCallCenterNoMsg" colspan="1" style="text-align: center" >
                        <b>FOR COMPLAINTS DIAL: 118 /SMS: 8118</b>
                    </td>

                    

                    
                    <td colspan="1" style="text-align: center" class="border-b">
                        
                    </td>
                    
                </tr>
            </tbody></table>
        </div>
        <div class="border-b" style="margin-top:-100px; width: 100%; height: 25px" id="Tr1">
           
            <img src="{{asset('frontend/img')}}/cuthere.gif" alt="cuthere" id="Img2">
        </div>
        <div class="headertable fontsize " >
            <div>
                <div style="height: 100%; width: 100px; float: left; display: inline-block; margin: 15px 0 0 15px">
                    <img style="margin: auto; max-width: 100%; max-height: 85%;" src="{{asset('frontend/img/learning.png')}}" alt="PEDO" id="Img1">
                                                    <span><b>
                                                        pedokp.gov.pk</b></span>
                </div>
                <div style="width: 670px; display: inline-block">
                    <table style="width: 100%; text-align: right;">
                        <tbody><tr>
                            <td colspan="3">
                                <h2 style="float: left; font-weight: 800; margin-left: 100px; margin-bottom: 0px;">
                                PAKHTUNKHWA ENERGY DEVELOPMENT ORGANIZATION</h2>
                                <BR/>
                                    
                                <h2 style="float: left; font-weight: 800; margin-left: 200px; margin-bottom: 0px;">  ELECTRICITY CONSUMER BILL </h2>
                                
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
                                        <td class="border-rb border-t" style="border-left: 1px solid black; color: black;">
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
                    <span>BILL NO <br> {{$bill_no}} </span>
                    
                </div>

            </div>
            <div style="display: inline-block; border: 1px solid #1a75ff; color: #1a75ff; padding: 20px; border-radius: 100%; width: 35px;">BANK
                <br>
                STAMP
            </div>
            

            <div style="float: right; margin-right: 206px; height: 70px; margin-bottom: 15px;">
                
                
                    {{-- <svg id="normal_bill_barcode" width="331px" height="60px" x="0px" y="0px" viewBox="0 0 331 60" xmlns="http://www.w3.org/2000/svg" version="1.1" style="transform: translate(0,0)"><rect x="0" y="0" width="331" height="60" style="fill:#ffffff;"></rect><g transform="translate(5, 5)" style="fill:#000000;"><rect x="0" y="0" width="2" height="50"></rect><rect x="3" y="0" width="1" height="50"></rect><rect x="6" y="0" width="1" height="50"></rect><rect x="11" y="0" width="1" height="50"></rect><rect x="15" y="0" width="2" height="50"></rect><rect x="18" y="0" width="1" height="50"></rect><rect x="22" y="0" width="1" height="50"></rect><rect x="25" y="0" width="3" height="50"></rect><rect x="29" y="0" width="2" height="50"></rect><rect x="33" y="0" width="1" height="50"></rect><rect x="35" y="0" width="3" height="50"></rect><rect x="39" y="0" width="4" height="50"></rect><rect x="44" y="0" width="1" height="50"></rect><rect x="47" y="0" width="1" height="50"></rect><rect x="50" y="0" width="4" height="50"></rect><rect x="55" y="0" width="2" height="50"></rect><rect x="59" y="0" width="1" height="50"></rect><rect x="64" y="0" width="1" height="50"></rect><rect x="66" y="0" width="1" height="50"></rect><rect x="68" y="0" width="2" height="50"></rect><rect x="71" y="0" width="3" height="50"></rect><rect x="77" y="0" width="1" height="50"></rect><rect x="80" y="0" width="1" height="50"></rect><rect x="83" y="0" width="2" height="50"></rect><rect x="88" y="0" width="4" height="50"></rect><rect x="93" y="0" width="2" height="50"></rect><rect x="96" y="0" width="2" height="50"></rect><rect x="99" y="0" width="2" height="50"></rect><rect x="102" y="0" width="4" height="50"></rect><rect x="107" y="0" width="2" height="50"></rect><rect x="110" y="0" width="2" height="50"></rect><rect x="115" y="0" width="1" height="50"></rect><rect x="117" y="0" width="1" height="50"></rect><rect x="121" y="0" width="1" height="50"></rect><rect x="123" y="0" width="1" height="50"></rect><rect x="125" y="0" width="4" height="50"></rect><rect x="132" y="0" width="2" height="50"></rect><rect x="137" y="0" width="2" height="50"></rect><rect x="140" y="0" width="2" height="50"></rect><rect x="143" y="0" width="1" height="50"></rect><rect x="145" y="0" width="2" height="50"></rect><rect x="151" y="0" width="1" height="50"></rect><rect x="154" y="0" width="1" height="50"></rect><rect x="156" y="0" width="1" height="50"></rect><rect x="158" y="0" width="4" height="50"></rect><rect x="165" y="0" width="2" height="50"></rect><rect x="168" y="0" width="2" height="50"></rect><rect x="171" y="0" width="2" height="50"></rect><rect x="176" y="0" width="2" height="50"></rect><rect x="179" y="0" width="2" height="50"></rect><rect x="183" y="0" width="2" height="50"></rect><rect x="187" y="0" width="2" height="50"></rect><rect x="190" y="0" width="2" height="50"></rect><rect x="194" y="0" width="2" height="50"></rect><rect x="198" y="0" width="4" height="50"></rect><rect x="203" y="0" width="2" height="50"></rect><rect x="206" y="0" width="2" height="50"></rect><rect x="209" y="0" width="2" height="50"></rect><rect x="214" y="0" width="2" height="50"></rect><rect x="217" y="0" width="2" height="50"></rect><rect x="220" y="0" width="2" height="50"></rect><rect x="223" y="0" width="2" height="50"></rect><rect x="227" y="0" width="2" height="50"></rect><rect x="231" y="0" width="2" height="50"></rect><rect x="234" y="0" width="2" height="50"></rect><rect x="238" y="0" width="2" height="50"></rect><rect x="242" y="0" width="2" height="50"></rect><rect x="246" y="0" width="1" height="50"></rect><rect x="249" y="0" width="1" height="50"></rect><rect x="253" y="0" width="1" height="50"></rect><rect x="256" y="0" width="4" height="50"></rect><rect x="262" y="0" width="1" height="50"></rect><rect x="264" y="0" width="3" height="50"></rect><rect x="269" y="0" width="1" height="50"></rect><rect x="272" y="0" width="2" height="50"></rect><rect x="275" y="0" width="3" height="50"></rect><rect x="279" y="0" width="1" height="50"></rect><rect x="281" y="0" width="4" height="50"></rect><rect x="286" y="0" width="1" height="50"></rect><rect x="290" y="0" width="2" height="50"></rect><rect x="293" y="0" width="1" height="50"></rect><rect x="297" y="0" width="1" height="50"></rect><rect x="300" y="0" width="2" height="50"></rect><rect x="304" y="0" width="1" height="50"></rect><rect x="308" y="0" width="2" height="50"></rect><rect x="313" y="0" width="3" height="50"></rect><rect x="317" y="0" width="1" height="50"></rect><rect x="319" y="0" width="2" height="50"></rect></g></svg> --}}
                    
                
                {{-- <div>SEP 23 - 08 26142 0391904 - 000009132 - 27 SEP 23 - 6</div>

                <script>
                    
                    let nor_barcode_encoded_txt = 'E0826142039190409232709230000091320000098526E';
                    JsBarcode("#normal_bill_barcode", nor_barcode_encoded_txt, {
                        width: 1,
                        height: 50,
                        margin: 5,
                        displayValue: false
                    });
                    
                </script> --}}

                
            </div>

            
            <div style="width: 98%; margin: 0 auto 10px;">
                <table style="text-align: center; width: 100%; border-collapse: collapse;">
                    <tbody><tr style="height: 10px;">
                        <td class="border-rb border-t" style="width: 15%; color: black; border-left: 1px solid black;">
                            <h4>BILL MONTH</h4>
                        </td>
                        <td class="border-rb border-t" style="width: 15%; color: black;">
                            <h4>DUE DATE</h4>
                        </td>
                        <td class="border-rb border-t" style="width: 25%; color: black;">
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
                        <td class="border-rb content" style="width: 15%; text-align: center; border-left: 1px solid black;">
                            <!-- SEP 23 -->
                            {{$billing_month_year}}
                        </td>
                        <td class="border-rb content" style="width: 15%; text-align: center;">
                        {{$due_date}}
                        </td>
                        <td class="font-size border-rb content" style="width: 25%; text-align: Center;">
                        {{$ref_no}} 
                            
                        </td>
                        <td class="border-rb" style="width: 25%; color: red;">
                            <h4>PAYABLE AFTER DUE DATE</h4>
                        </td>
                        <td class="font-size border-rb border-r content" style="width: 15%;">
                        {{$payable_after_due_date}}
                            
                            <br>
                            <!-- <span></span> -->
                        </td>
                    </tr>
                </tbody></table>
            </div>
        </div>
        
        
    </div>



    </div>
    @endforeach
   
</body>



 </html>