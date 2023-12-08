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
        $reading=Reading::with(['bConsumerMeter'=>function($q){
            $q->orderBy('mannual_ref_no','ASC');
        }])->where('month_year',$request->month.'-01');
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
            $reading=PaymentReceive::with(['bConsumerMeter'=>function($q){
                $q->orderBy('mannual_ref_no','ASC');
            }])->where('payment_month',$request->month.'-01');
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
            $record=ConsumerCategory::with(['hMConSubCategory','hMConSubCategory.hMbills'=>function($q) use ($request){
                $q->where('billing_month_year',$request->month.'-01');
            }])->where('is_active',1)->get();
            return view('admin.report.bill.summary',compact('record','fields'));
        }

        else if($request->condition=='design')
        {
            
            // $record=ConsumerBill::with('hOSubCategory')->where('billing_month_year',$request->month.'-01');
            // // dd($record->get());
            // if($request->start_refrence )
            // $record=$record->where('ref_no','>=',$request->start_refrence);
            // if($request->end_refrence )
            // $record=$record->where('ref_no','<=',$request->end_refrence);
            
            // $record=$record->get();
            // $fields=$request->all();

            $record = DB::table('consumer_bills')
            ->select('meter_readings.offpeak_prev as prev_offpeak_reading','meter_readings.offpeak as offpeak_current_reading','meter_readings.datetime as reading_date','consumer_bills.*', 'bill_generates.*',  'bill_generates.created_at as bill_generate_date','consumer_meters.connection_date as meter_connection_date','consumer_meters.*','consumer_bills.id as bill_id','consumers.*','feeders.name as feeder_name','sub_divisions.name as sub_division_name','divisions.name as division_name')
            ->Join('meter_readings', 'meter_readings.id', '=', 'consumer_bills.reading_id')
            ->Join('bill_generates', 'bill_generates.id', '=', 'consumer_bills.generate_bill_id')
            ->Join('consumer_meters', 'consumer_meters.cm_id', '=', 'consumer_bills.cm_id')
            ->join('consumers', 'consumers.id', '=', 'consumer_meters.consumer_id')
            ->join('feeders', 'feeders.id', '=', 'consumers.feeder_id')
            ->join('sub_divisions', 'sub_divisions.id', '=', 'feeders.sub_division_id')
            ->join('divisions', 'divisions.id', '=', 'sub_divisions.division_id')
            // ->join('meters', 'meters.meter_id', '=', 'consumer_meters.meter_id')
            
            // ->where('consumer_bills.id',$bill_id)
            ->where('consumer_bills.billing_month_year',$request->month.'-01')
            ->orderBy('consumer_meters.mannual_ref_no', 'ASC')
            // ->limit(1)
            ->get();

            // if($request->start_refrence )
            //         $record=$q->where('ref_no','>=',$request->start_refrence);
            //     if($request->end_refrence )
            //         $record=$q->where('ref_no','<=',$request->end_refrence);

            // $payment_and_bill = DB::table('consumer_bills')
            // ->select('consumer_bills.*','payment_receives.payment_amount as pay_amount')
            // ->leftJoin('payment_receives', 'payment_receives.bill_id', '=', 'consumer_bills.id')
            // ->where('consumer_bills.consumer_id',$bill_data->consumer_id)
            // ->where('consumer_bills.id','!=',$bill_id)
            // ->orderBy('consumer_bills.id', 'desc')
            // ->limit(12)->get();

            // dd($record);


    // return view('single_bill_v2',compact('bill_data','payment_and_bill'));


            // dd($record);
            return view('admin.report.bill.bill_v2_list',compact('record','fields'));
        }
        else if($request->condition=='all-breakup')
        {
            // dd('testing');
            $record=ConsumerBill::with(['hOSubCategory','bConsumerMeter'=>function($q) use ($request){
                if($request->start_refrence )
                    $record=$q->where('ref_no','>=',$request->start_refrence);
                if($request->end_refrence )
                    $record=$q->where('ref_no','<=',$request->end_refrence);
                $q->orderBy('mannual_ref_no','ASC');
            }])->where('billing_month_year',$request->month.'-01');
            // dd($record->get());

           $charges_types= DB::Table('charges_types')->get();
           $tax_types= DB::Table('tax_types')->get();
           
            
            $record=$record->get();
            // $fields=$request->all();
            return view('admin.report.bill.all_with_brakup',compact('record','fields','charges_types','tax_types'));
        }
        else
        {
            // dd('testing');
            $record=ConsumerBill::with(['hOSubCategory','bConsumerMeter'=>function($q) use ($request){
                if($request->start_refrence )
                    $record=$q->where('ref_no','>=',$request->start_refrence);
                if($request->end_refrence )
                    $record=$q->where('ref_no','<=',$request->end_refrence);
                $q->orderBy('mannual_ref_no','ASC');
            }])->where('billing_month_year',$request->month.'-01');
            // dd($record->get());
           
            
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
