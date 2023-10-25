<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Models\User;
// use App\Models\Course;
// use App\Models\Category;
use App\Models\Role;
// use App\Models\Consumer;
// use App\Models\ConsumerCategory;
// use App\Models\Division;
// use App\Models\SubDivision;
// use App\Models\Reading;
use App\Models\PaymentReceive;
use App\Models\ReadingApprove;
use App\Models\ConsumerLedger;
// use App\Models\Feeder;
// use App\Models\Credit;
// use App\Models\WithdrawRequest;
use Illuminate\Support\Facades\Validator;
use DB;
use Illuminate\Support\Facades\Input;
// use Illuminate\Support\Facades\Storage;
// use Image;
// use SiteHelpers;
// use Crypt;
use URL;
use Session;
// use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Auth;
// use Controller;
use App\Http\Controllers\Controller;
use Illuminate\Validation\Rule;


use App\Mail\ContactInstructor;

class ReceivePaymentController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        
    }

    public function show(Request $request)
    {
        $paginate_count = 5000;
        if($request->has('search')){
            $search = $request->input('search');
            $list = PaymentReceive::where('ref_no', 'LIKE', '%' . $search . '%')
                           ->paginate($paginate_count);
        }
        else {
            $list = PaymentReceive::paginate($paginate_count);
        }
        // $list =PaymentReceive::orderBy('id')->paginate($paginate_count);
        return view('admin.receive_payment.index', compact('list'));
    }

    // public function reading_approve_show()
    // {
    //     $paginate_count = 8;
        
    //     $list = DB::table('reading_approve')->orderBy('id')->paginate($paginate_count);
    //     return view('admin.receive_payment.approve_index', compact('list'));
    //     // return view('admin.reading.approve_index');
    // }

    // public function reading_approve_form()
    // {
    //     // $paginate_count = 8;
        
    //     // $list = DB::table('meter_readings')->orderBy('id')->where('is_verified',0)->paginate($paginate_count);
    //     return view('admin.receive_payment.reading_approval_form');
    // }


    public function add_form()
    {
        // $category=ConsumerCategory::where('is_active',1)->get();
        // $previous_no=Consumer::orderBy('id','desc')->first();
        // if($previous_no)
        //     $new_consumer_no=$previous_no->id+1;
        // else
        //     $new_consumer_no=1;

        // $divisions=Division::where('is_active',1)->get();
        // $meters=DB::table('meters')->where('status','free')->get();
        // dd($divisions);
        // return view('admin.reading.form',compact('category','divisions','new_consumer_no','meters'));
        $banks=DB::table('banks')->get();
        return view('admin.receive_payment.form',compact('banks'));
    }

    public function save(Request $request)
    {
        // $request->validate([
        //     'ref_no' => 'required',
        //     'month_year' => 'required',
        //     'offpeak' => 'required_without:peak',
        //     // 'off_peak_image' =>Rule::when($request->offpeak != null, 'required'),
        //     // 'peak_image' =>Rule::when($request->peak != null, 'required')
        // ]);
        
        $validator = Validator::make($request->all(), [
            'ref_no' => 'required',
            'payment_month' => 'required',
            'payment_date' => 'required',
            'bank' => 'required',
            'amount' => 'required',
            // 'payment_date' => 'required_without:peak',
            // 'bank' =>Rule::when($request->offpeak != null, 'required'),
            // 'amount' =>Rule::when($request->peak != null, 'required')
        ]);
        
        if ($validator->fails()) return error('Validation Error.', $validator->errors(), 422);
        
        //    $payment_month=explode('-',$request->month_year);
        // pr($request->all());
       $payment_month=date('Y-m-d',strtotime($request->payment_month));
    //    pr($payment_month);
        $data=PaymentReceive::where('ref_no',$request->ref_no)->where('payment_month',$payment_month)->first();
        $bill_data=ConsumerBill::where('ref_no',$request->ref_no)->where('payment_month',$payment_month)->first();
        // pr($record);
       if($data)
       {
        return response()->json(['success'=>'false','message'=>'Record Exits. Cant not Add Again']);
       }else
       {
                $rec=DB::table('consumer_meters')->select('consumer_id')->where('ref_no',$request->ref_no)->first();
                $record=new PaymentReceive();
                $record->ref_no=$request->ref_no;
                $record->payment_month=$payment_month;
                $record->payment_date=$request->payment_date;
                $record->bank_id=$request->bank;
                $record->payment_amount=$request->amount;
                $record->conumer_id=$rec->consumer_id;
                $record->bill_id=$bill_data->id;
                $record->save();


                ConsumerLedger::insert(['consumer_id'=>$rec->consumer_id,'amount'=> -($request->amount),'payment_id'=>$record->id]);
                // return redirect()->back()->with(['success'=>'Action Completed']); 
                return response()->json(['success'=>'true','message'=>'Action Completed']); 

                
       }
    }

    
    public function reading_edit($id)
    {
        
        $record=PaymentReceive::find($id);
        return view('admin.receive_payment.edit',compact('record'));
    }

    

    // public function reading_update(Request $request ,$id)
    // {
    //     $request->validate([
    //         'ref_no' => 'required',
    //         'month_year' => 'required',
    //         'offpeak' => 'required_without:peak',
    //         // 'off_peak_image' =>Rule::when($request->offpeak != null, 'required'),
    //         // 'peak_image' =>Rule::when($request->peak != null, 'required')
    //     ]);
        
    //    $mont_year_array=explode('-',$request->month_year);
    //     // $reading_record=Reading::where('ref_no',$request->ref_no)->where('year',$mont_year_array[0])->where('month',$mont_year_array[1])->first();
    //     //    if($reading_record)
    //     //    {
    //         // return redirect()->back()->with(['error'=>'Record Already Exits']);
    //     //    }else
    //     //    {
    //             $record =Reading::find($id);
    //             $record->ref_no=$request->ref_no;
    //             $record->year=$mont_year_array[0];
    //             $record->month=$mont_year_array[1];
    //             $record->month_year=$request->month_year.'-01';
    //             $record->offpeak=$request->offpeak;
    //             $record->peak=$request->peak;
    //             if($request->hasFile('peak_image'))
    //                 {
    //                     $food_image = time().'p'. '.' . $request->peak_image->getClientOriginalExtension();
    //                     $request->peak_image->move(public_path('reading/'), $food_image);
    //                     $record->pkimage=$food_image;
    //                 }

    //             if($request->hasFile('off_peak_image'))
    //                 {
    //                     $food_image = time().'op'. '.' . $request->off_peak_image->getClientOriginalExtension();
    //                     $request->off_peak_image->move(public_path('reading/'), $food_image);
    //                     $record->offpkimage=$food_image;
    //                 }
    //             $record->save();
    //             return redirect()->back()->with(['success'=>'Action Completed']); 
    // }


    public function receive_payment_disable($id)
    {
        $record=PaymentReceive::where('id',$id)->delete();
        return $this->return_output('flash', 'success', 'Action Completed successfully', 'receive-payment-lists', '200');

    }   


    // public function reading_approve(Request $request)
    // {
    //     // $record=Reading::where('id',$request->id)->first();
    //     DB::beginTransaction();
    //     try {
    //             $approve_record=DB::table('reading_approve')->where('month_year',date('y-m-d ',strtotime($request->month_year)))->first();
    //             if($approve_record)
    //             return back()->withError('Already Approved ! Cant be Apporve Again');
    //             else
    //             {
    //                 $approve_record= new ReadingApprove();
    //                 $approve_record->month_year= date('y-m-d ',strtotime($request->month_year));
    //                 $approve_record->is_verified= 1;
    //                 $approve_record->save();
    //             }

    //             $current_record=Reading::where('month_year',(date('y-m-d ',strtotime($approve_record->month_year))))->first();
    //             foreach ($current_record as $key => $value) 
    //             {
    //                 $pre_record=Reading::where('month_year',(date('y-m-d ',strtotime($current_record->month_year.' -1 month' ))))->first();
    //                 $off_peak_units=0;
    //                 $peak_units=0;
                
    //                 if($pre_record)
    //                 {
    //                     $off_peak_units=abs($pre_record->offpeak-$current_record->offpeak );
    //                     $peak_units=abs($pre_record->peak-$current_record->peak );
    //                 }
    //                 else
    //                 {
    //                     $off_peak_units=abs($current_record->offpeak);
    //                     $peak_units=abs($current_record->peak);
    //                 }
    //                 Reading::where('id',$current_record->id)->update(['is_verified'=>1,'varifier'=>Auth::id(),'offpeak_units'=>$off_peak_units,'peak_units'=>$peak_units]);
    //             }
    //             DB::table('reading_approve')->where('id',$request->id)->update(['is_verified'=>1]);
    //             DB::commit();
    //             // echo json_encode(['success'=>'true','message'=>'Action Completed']);
    //             return $this->return_output('flash', 'success', 'Record Add successfully', 'meter-reading-approve-lists', '200');
    //     } catch (\Exception $e) {  
    //             DB::rollback();
    //             return back()->withError('Try Again Later');

    //             // echo json_encode(['success'=>'false','message'=>$e->getMessage()]);
    //             // echo json_encode(['success'=>'false','message'=>'Action Failed']);
    //             // return $this->return_output('flash', 'error', 're', 'admin/group', '200');
    //     }  
    // }   

    // public function readingList()
    // {
    //     $paginate_count = 8;
        
    //     $instructors = DB::table('instructors')->groupBy('instructors.id')->paginate($paginate_count);
    //     return view('site.consumer', compact('instructors'));
        
    // }

    // public function readingView($instructor_slug = '', Request $request)
    // {
    //     $instructor = Instructor::where('instructor_slug', $instructor_slug)->first();
    //     $metrics = Instructor::metrics($instructor->id);
    //     return view('site.instructor_view', compact('instructor', 'metrics'));
    // }

}
