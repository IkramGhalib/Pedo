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
use App\Models\Reading;
use App\Models\ReadingApprove;
// use App\Models\Feeder;
// use App\Models\Credit;
// use App\Models\WithdrawRequest;
use Illuminate\Support\Facades\Validator;
use DB;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Storage;
use Image;
// use SiteHelpers;
// use Crypt;
use URL;
use Session;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Auth;
// use Controller;
use App\Http\Controllers\Controller;
use Illuminate\Validation\Rule;


use App\Mail\ContactInstructor;

class ReadingController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        
    }

    public function reading_show()
    {
        $paginate_count = 50;
        
        $list = DB::table('meter_readings')->orderBy('id')->where('is_verified',0)->paginate($paginate_count);
        return view('admin.reading.index', compact('list'));
    }

    public function reading_approve_show()
    {
        $paginate_count = 13;
        
        $list = DB::table('reading_approve')->orderBy('id','desc')->paginate($paginate_count);
        return view('admin.reading.approve_index', compact('list'));
        // return view('admin.reading.approve_index');
    }

    public function reading_approve_form()
    {
        // $paginate_count = 8;
        
        // $list = DB::table('meter_readings')->orderBy('id')->where('is_verified',0)->paginate($paginate_count);
        $last_date=DB::table('reading_approve')->orderBy('id','desc')->first();
        return view('admin.reading.reading_approval_form',compact('last_date'));
    }


    public function reading_form()
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
        $last_date=DB::table('reading_approve')->orderBy('id','desc')->first();
        return view('admin.reading.form',compact('last_date'));
    }

    public function reading_save(Request $request)
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
            'month_year' => 'required',
            'offpeak' => 'required_without:peak',
            // 'off_peak_image' =>Rule::when($request->offpeak != null, 'required'),
            // 'peak_image' =>Rule::when($request->peak != null, 'required')
        ]);
        if ($validator->fails()) return error('Fill Required Filed.', $validator->errors(), 422);

        // dd($request->all());
    //    $mont_year=explode('-',$request->month_year.'-01');
       $mont_year=date('y-m-d ',strtotime($request->month_year));
        $reading_record=Reading::where('ref_no',$request->ref_no)->where('month_year',$mont_year)->first();
        if($reading_record)
       {
        //    return redirect()->back()->with(['error'=>'Record Already Exits']);
           return error('Record Already Exits', [], 422);
        }else
        {
           $rec=DB::table('consumer_meters')->select('consumer_id')->where('ref_no',$request->ref_no)->first();
        //  --------------------------------------------------------------
        // offpeak_prev
        // $current_record=Reading::where('month_year',(date('y-m-d ',strtotime($approve_record->month_year))))->first();
          
        // {
            
            // Reading::where('id',$reading_record->id)->update(['is_verified'=>1,'varifier'=>Auth::id(),'offpeak_units'=>$off_peak_units,'peak_units'=>$peak_units]);
        // }
        //  --------------------------------------------------------------


                $record=new Reading();
                $record->ref_no=$request->ref_no;
                $record->year=(date('y',strtotime($mont_year)));
                $record->month=(date('m',strtotime($mont_year)));
                $record->month_year=$mont_year;
                $record->offpeak=$request->offpeak;
                $record->peak=$request->peak;
                $record->consumer_id=$rec->consumer_id;

                $pre_record=Reading::where('month_year',(date('y-m-d ',strtotime($mont_year.' -1 month' ))))->where('ref_no',$request->ref_no)->first();
                $off_peak_units=0;
                $peak_units=0;
                $offpeak_pre=0;
            
                if($pre_record)
                {
                    $off_peak_units=$request->offpeak-$pre_record->offpeak;
                    if($off_peak_units<0)
                    return error('Reading is Wrong', [], 422);

                    $peak_units=abs($pre_record->peak-$request->peak );

                    $offpeak_pre=abs($pre_record->offpeak );
                }
                else
                {
                    $off_peak_units=abs($request->offpeak);
                    $peak_units=abs($request->peak);
                    $offpeak_pre=0;
                }

                $record->peak_units=$peak_units;
                $record->offpeak_units=$off_peak_units;
                $record->offpeak_prev=$offpeak_pre;


                if($request->hasFile('peak_image'))
                    {
                        $food_image = time().'p'. '.' . $request->peak_image->getClientOriginalExtension();
                        $request->peak_image->move(public_path('reading/'), $food_image);
                        $record->pkimage=$food_image;
                    }

                if($request->hasFile('off_peak_image'))
                    {
                        $food_image = time().'op'. '.' . $request->off_peak_image->getClientOriginalExtension();
                        $request->off_peak_image->move(public_path('reading/'), $food_image);
                        $record->offpkimage=$food_image;
                    }
                $record->save();
                // return redirect()->back()->with(['success'=>'Action Completed']); 
                return success('Action Completed',[] );
                
       }
    }

    public function get_data_agaist_reading(Request $request)
    {
    //    $m= date('Y-m-d',strtotime($request->month_year));
        $record=DB::table('meter_readings')
        // ->join('consumers','consumers.id','=','consumer_meters.consumer_id')
        ->where('ref_no',$request->ref_no)
        ->where('month_year',date('y-m-d ',strtotime($request->month_year.'-01'.' -1 month' )))
        ->first();
        // echo json_encode($record);
        return success('right',$record );
           
            // echo json_encode(ConsumerSubCategory::where('is_active',1)->where('consumer_category_id',$request->parent_id)->where('name','like',$request->search.'%')->get());
    }
    public function reading_edit($id)
    {
        
        $record=Reading::find($id);
        return view('admin.reading.edit',compact('record'));
    }

    

    public function reading_update(Request $request ,$id)
    {
        $request->validate([
            'ref_no' => 'required',
            'month_year' => 'required',
            'offpeak' => 'required_without:peak',
            // 'off_peak_image' =>Rule::when($request->offpeak != null, 'required'),
            // 'peak_image' =>Rule::when($request->peak != null, 'required')
        ]);
        
       $mont_year_array=explode('-',$request->month_year);
        // $reading_record=Reading::where('ref_no',$request->ref_no)->where('year',$mont_year_array[0])->where('month',$mont_year_array[1])->first();
        //    if($reading_record)
        //    {
            // return redirect()->back()->with(['error'=>'Record Already Exits']);
        //    }else
        //    {
                $record =Reading::find($id);
                $record->ref_no=$request->ref_no;
                $record->year=$mont_year_array[0];
                $record->month=$mont_year_array[1];
                $record->month_year=$request->month_year.'-01';
                $record->offpeak=$request->offpeak;
                $record->peak=$request->peak;

                $rec=DB::table('consumer_meters')->select('consumer_id')->where('ref_no',$request->ref_no)->first();

                $record->consumer_id=$rec->consumer_id;

                $pre_record=Reading::where('month_year',(date('y-m-d ',strtotime($request->month_year.'-01'.' -1 month' ))))->where('ref_no',$request->ref_no)->first();
                $off_peak_units=0;
                $peak_units=0;
                $offpeak_pre=0;
            
                if($pre_record)
                {
                    $off_peak_units=abs($pre_record->offpeak-$request->offpeak );
                    $peak_units=abs($pre_record->peak-$request->peak );

                    $offpeak_pre=abs($pre_record->offpeak );
                }
                else
                {
                    $off_peak_units=abs($reading_record->offpeak);
                    $peak_units=abs($reading_record->peak);
                    $offpeak_pre=0;
                }

                $record->peak_units=$peak_units;
                $record->offpeak_units=$off_peak_units;
                $record->offpeak_pre=$offpeak_pre;


                if($request->hasFile('peak_image'))
                    {
                        $food_image = time().'p'. '.' . $request->peak_image->getClientOriginalExtension();
                        $request->peak_image->move(public_path('reading/'), $food_image);
                        $record->pkimage=$food_image;
                    }

                if($request->hasFile('off_peak_image'))
                    {
                        $food_image = time().'op'. '.' . $request->off_peak_image->getClientOriginalExtension();
                        $request->off_peak_image->move(public_path('reading/'), $food_image);
                        $record->offpkimage=$food_image;
                    }
                $record->save();
                return redirect()->back()->with(['success'=>'Action Completed']); 
    }


    public function reading_disable($id)
    {
        $record=Reading::where('id',$id)->delete();
        return $this->return_output('flash', 'success', 'Action Completed successfully', 'meter-reading-lists', '200');

    }   


    public function reading_approve(Request $request)
    {
        // $record=Reading::where('id',$request->id)->first();
        DB::beginTransaction();
        try {
                $approve_record=DB::table('reading_approve')->where('month_year',date('y-m-d ',strtotime($request->month_year)))->first();
                if($approve_record)
                return back()->withError('Already Approved ! Cant be Apporve Again');
                else
                {
                    $approve_record= new ReadingApprove();
                    $approve_record->month_year= date('y-m-d',strtotime($request->month_year));
                    $approve_record->is_verified= 1;
                    $approve_record->varify_by= auth()->user()->id;
                    
                    $approve_record->save();
                }

                $current_record=Reading::where('month_year',$approve_record->month_year)->get();
                // foreach ($current_record as $key => $value) 
                // {
                    // $pre_record=Reading::where('month_year',(date('y-m-d ',strtotime($current_record->month_year.' -1 month' ))))->first();
                    // $off_peak_units=0;
                    // $peak_units=0;
                
                    // if($pre_record)
                    // {
                    //     $off_peak_units=abs($pre_record->offpeak-$current_record->offpeak );
                    //     $peak_units=abs($pre_record->peak-$current_record->peak );
                    // }
                    // else
                    // {
                    //     $off_peak_units=abs($current_record->offpeak);
                    //     $peak_units=abs($current_record->peak);
                    // }
                    // Reading::where('id',$current_record->id)->update(['is_verified'=>1,'varifier'=>Auth::id(),'offpeak_units'=>$off_peak_units,'peak_units'=>$peak_units]);
                    // Reading::where('id',$value->id)->update(['is_verified'=>1,'varifier'=>Auth::id()]);
                // }
                Reading::where('month_year',$approve_record->month_year)->update(['is_verified'=>1]);

                // DB::table('reading_approve')->where('id',$request->id)->update(['is_verified'=>1]);
                DB::commit();
                // echo json_encode(['success'=>'true','message'=>'Action Completed']);
                return $this->return_output('flash', 'success', 'Record Add successfully', 'meter-reading-approve-lists', '200');
        } catch (\Exception $e) {  
                DB::rollback();
                return back()->withError('Try Again Later');

                // echo json_encode(['success'=>'false','message'=>$e->getMessage()]);
                // echo json_encode(['success'=>'false','message'=>'Action Failed']);
                // return $this->return_output('flash', 'error', 're', 'admin/group', '200');
        }  
    }   

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
