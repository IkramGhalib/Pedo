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
use App\Models\ConsumerBill;
use App\Models\Consumer;
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
        return view('admin.report.reading.index',compact('record','fields'));
    }
    // -------------------------------Group Report -------------------------------------------------------

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
         $record=ConsumerBill::where('billing_month_year',$request->month.'-01');
         if($request->start_refrence )
         $record=$record->where('ref_no','>=',$request->start_refrence);
        if($request->end_refrence )
        $record=$record->where('ref_no','<=',$request->end_refrence);
        
        $record=$record->get();
        $fields=$request->all();
        // dd($fields);
         return view('admin.report.bill.index',compact('record','fields'));
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
