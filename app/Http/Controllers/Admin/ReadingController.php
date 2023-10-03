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
        $paginate_count = 8;
        
        $list = DB::table('meter_readings')->orderBy('id')->paginate($paginate_count);
        return view('admin.reading.index', compact('list'));
    }

    public function reading_approve_show()
    {
        $paginate_count = 8;
        
        $list = DB::table('meter_readings')->orderBy('id')->where('is_verified',0)->paginate($paginate_count);
        return view('admin.reading.approve_index', compact('list'));
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
        return view('admin.reading.form');
    }

    public function reading_save(Request $request)
    {
        $request->validate([
            'ref_no' => 'required',
            'month_year' => 'required',
            'offpeak' => 'required_without:peak',
            // 'off_peak_image' =>Rule::when($request->offpeak != null, 'required'),
            // 'peak_image' =>Rule::when($request->peak != null, 'required')
        ]);
       $mont_year_array=explode('-',$request->month_year);
        $reading_record=Reading::where('ref_no',$request->ref_no)->where('year',$mont_year_array[0])->where('month',$mont_year_array[1])->first();
       if($reading_record)
       {
        return redirect()->back()->with(['error'=>'Record Already Exits']);
       }else
       {
                $record=new Reading();
                $record->ref_no=$request->ref_no;
                $record->year=$mont_year_array[0];
                $record->month=$mont_year_array[1];
                $record->month_year=$request->month_year.'-01';
                $record->offpeak=$request->offpeak;
                $record->peak=$request->peak;
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
    }

    
    public function reading_edit($id)
    {
        
        $record=Reading::find($id);
        return view('admin.reading.edit',compact('record'));
    }

    

    public function reading_update(Request $request ,$id)
    {
        // pr($request->all());
        $request->validate([
            'ref_no' => 'required',
            'month_year' => 'required',
            'offpeak' => 'required_without:peak',
            // 'off_peak_image' =>Rule::when($request->offpeak != null, 'required'),
            // 'peak_image' =>Rule::when($request->peak != null, 'required')
        ]);
        // pr($request->all());
        
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
        
        $record=Reading::where('id',$request->id)->first();
        $off_peak_units=0;
        $peak_units=0;
        $pre_record=Reading::where('month_year',(date('y-m-d ',strtotime($record->month_year.' -1 month' ))))->first();
        if($pre_record)
        {
            $off_peak_units=abs($pre_record->offpeak-$record->offpeak );
            $peak_units=abs($pre_record->peak-$record->peak );
        }
        else
        {
            $off_peak_units=abs($record->offpeak);
            $peak_units=abs($record->peak);
        }
        
        $record=Reading::where('id',$request->id)->update(['is_verified'=>1,'varifier'=>Auth::id(),'offpeak_units'=>$off_peak_units,'peak_units'=>$peak_units]);
        if($record)
        echo json_encode(['success'=>'true','message'=>'Action Completed']);
        else
        echo json_encode(['success'=>'false','message'=>'Action Failed']);
        // return $this->return_output('flash', 'success', 'Action Completed successfully', 'meter-reading-lists', '200');

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
