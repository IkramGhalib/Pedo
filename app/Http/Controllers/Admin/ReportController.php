<?php
/**
 * PHP Version 7.1.7-1
 * Functions for users
 *
 * @category  File
 * @package   Category
 * @author    Mohamed Yahya
 * @copyright ULEARN  
 * @license   BSD Licence
 * @link      Link
 */
namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;
use DB;
use Illuminate\Support\Facades\DB as FacadesDB;
use App\Models\Reading;
use App\Models\PaymentReceive;
use App\Models\ConsumerBill;
use App\Models\Consumer;
use App\Models\ConsumerCategory;
class ReportController extends Controller
{
    // -------------------------------Reading Report -------------------------------------------------------
    public function reading_report_form( Request $request,$category_id='')
    {
        return view('admin.report.reading.form');
    }

    function reading_report_process(Request $request)
	{
		$validatedData = $request->validate([
            'month' => 'required',
        ]);
        $reading=Reading::where('month_year',$request->month.'-01');
        if($request->condition && $request->unit)
        $reading=$reading->where('offpeak_units',$request->condition,$request->unit);
    
    $record=$reading->get();
    $fields=$request->all();
    // dd($record);
        if($request->report_style=='v')
        {

            return view('admin.report.reading.index',compact('record','fields'));
        }
        else
        {
            
            $record=$reading=Reading::where('month_year',$request->month.'-01')->count();
            $total_consumer=Consumer::where('status','active')->count();
            // pr($total_consumer);
            // dd($total_consumer);
            return view('admin.report.reading.index_chart',compact('record','fields','total_consumer'));
        }
    }
    // ------------------------------- Report -------------------------------------------------------


    // -------------------------------payment Report -------------------------------------------------------
    public function payment_report_form( Request $request,$category_id='')
    {
        return view('admin.report.payment.form');
    }

    function payment_report_process(Request $request)
	{
		$validatedData = $request->validate([
            'month' => 'required',
        ]);
        
        $fields=$request->all();
        if($request->report_style=='v')
        {
            $reading=PaymentReceive::where('payment_month',$request->month.'-01');
            $record=$reading->get();

            return view('admin.report.payment.index',compact('record','fields'));
        }
        else
        {
            $req_month=$request->month.'-01';
            $months[date('M-Y',strtotime($req_month))]=PaymentReceive::where('payment_month',$req_month)->sum('payment_amount');
            $pre_1_m=date('Y-m-d', strtotime(date($req_month)." -1 month"));
            // pr($pre_1_m);
            $months[date('M-Y',strtotime($pre_1_m))]=PaymentReceive::where('payment_month',$pre_1_m)->sum('payment_amount');
            $months[date('M-Y', strtotime(date($req_month)." -2 month"))]=PaymentReceive::where('payment_month',date('Y-m-d', strtotime(date($req_month)." -2 month")))->sum('payment_amount');
            $months[date('M-Y', strtotime(date($req_month)." -3 month"))]=PaymentReceive::where('payment_month',date('Y-m-d', strtotime(date($req_month)." -3 month")))->sum('payment_amount');
            $months[date('M-Y', strtotime(date($req_month)." -4 month"))]=PaymentReceive::where('payment_month',date('Y-m-d', strtotime(date($req_month)." -4 month")))->sum('payment_amount');
            $months[date('M-Y', strtotime(date($req_month)." -5 month"))]=PaymentReceive::where('payment_month',date('Y-m-d', strtotime(date($req_month)." -5 month")))->sum('payment_amount');
            $months[date('M-Y', strtotime(date($req_month)." -6 month"))]=PaymentReceive::where('payment_month',date('Y-m-d', strtotime(date($req_month)." -6 month")))->sum('payment_amount');
            // $total_consumer=Consumer::where('status','active')->count();
            // pr($total_consumer);

            
            // dd($months);
            return view('admin.report.payment.index_chart',compact('fields','months'));
        }
    }
    // ------------------------------- Report -------------------------------------------------------

     // -------------------------------Bill Report -------------------------------------------------------
     public function bill_report_form( Request $request,$category_id='')
     {
         return view('admin.report.bill.form');
     }
 
     function bill_report_process(Request $request)
     {
         $validatedData = $request->validate([
             'month' => 'required',
             'condition' => 'required',
         ]);
        //  $record=ConsumerBill::where('billing_month_year',$request->month.'-01');
        //  if($request->start_refrence )
        //  $record=$record->where('ref_no','>=',$request->start_refrence);
        // if($request->end_refrence )
        // $record=$record->where('ref_no','<=',$request->end_refrence);
        
        // $record=$record->get();
        $fields=$request->all();
        // dd($fields);
        if($request->condition=='bill-summary')
        {
            $record=ConsumerCategory::with('hMConSubCategory')->where('is_active',1)->get();
            
            // dd($cc);
            return view('admin.report.bill.summary',compact('record','fields'));
        }
        else
        {
            $record=ConsumerBill::with('hOSubCategory')->where('billing_month_year',$request->month.'-01');
            // dd($record->get());
            if($request->start_refrence )
            $record=$record->where('ref_no','>=',$request->start_refrence);
            if($request->end_refrence )
            $record=$record->where('ref_no','<=',$request->end_refrence);
            
            $record=$record->get();
            // $fields=$request->all();
            return view('admin.report.bill.index',compact('record','fields'));
        }
     }
     // -------------------------------Group Report -------------------------------------------------------

     // -------------------------------Bill Report -------------------------------------------------------
     public function consumer_report_form( Request $request,$category_id='')
     {
         return view('admin.report.consumer.form');
     }
 
     function consumer_report_process(Request $request)
     {
         $validatedData = $request->validate([
             'report_type' => 'required',
         ]);
         if($request->report_type !='all' )
         $record=Consumer::where('status',$request->report_type)->get();
         else
         $record=Consumer::get();
        $fields=$request->report_type;
         return view('admin.report.consumer.index',compact('record','fields'));
     }
     // -------------------------------Group Report -------------------------------------------------------
}
