<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Models\User;
// use App\Models\Course;
// use App\Models\Category;
use App\Models\Role;
use App\Models\Config;
// use App\Models\Consumer;
use App\Models\ConsumerSubCategory;
// use App\Models\Division;
use App\Models\SubCategoryCharges;
use App\Models\GeneralTax;
// use App\Models\SubDivision;
use App\Models\BillGenerate;
use App\Models\ConsumerBill;
use App\Models\ConsumerLedger;
use App\Models\Reading;
use App\Models\ConsumerMeter;
use App\Models\MeterReaderGroup;
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


// use App\Mail\ContactInstructor;

class ReaderGroupController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        
    }

    public function show()
    {
        $paginate_count = 8;
        $list =MeterReaderGroup::with('bUser')->paginate($paginate_count);
        // $list = DB::table('meter_reader_groups')->select('users.first_name','meter_reader_groups.*')->join('users','users.id','=','meter_reader_groups.user_id')->orderBy('meter_reader_groups.id','DESC')->paginate($paginate_count);
        // dd($list);
        return view('admin.reader_group.index', compact('list'));
    }
    public function form(Request $request, $id='')
    {
        // $roles=Role::where('id',3)->get();
        if($id) {
            $user = MeterReaderGroup::find($id);
        }else{
            $user = $this->getColumnTable('meter_reader_groups');
        }



        
        $list = User::whereHas('RoleUser', function ($query) {
            $query->where('role_id', '=', 1);
        })->get();

        // dd($list);
        return view('admin.reader_group.form',compact('user','list'));
    }
    
    public function save(Request $request)
    {
        $id = $request->input('record_id');
        $validation_rules=[
            'ref_start' => 'required',
            'ref_end' => 'required',
            'user' => 'required',
        ];

        $validator = Validator::make($request->all(),$validation_rules);
        // Stop if validation fails
        if ($validator->fails()) {
            return $this->return_output('error', 'error', $validator, 'back', '422');
        }


        if ($validator->fails()) {
            return $this->return_output('error', 'error', $validator, 'back', '422');
        }



        if ($id) {
            $user = MeterReaderGroup::find($id);
            $success_message = 'User updated successfully';
        } else {
            $user = new MeterReaderGroup();
            $success_message = 'User added successfully';
        }

        $user->ref_start=$request->ref_start;
        $user->ref_end=$request->ref_end;
        $user->user_id=$request->user;
        $user->save();
        // dd($request->all());
    //    $reading_record=BillGenerate::where('month_year',$month_year)->first();
    //    $list =MeterReaderGroup::where('ref_start',$requst->ref_start)->where('ref_end',$requst->ref_end)->where('user_id',$requst->user)->first();
    //    if($list)
    //    {
    //     return redirect()->back()->with(['error'=>'Record Already Exits']);
    //    }else
    //    {
               
    //             $data= new MeterReaderGroup();
                                            
                
    //             return redirect()->back()->with(['success'=>'Action Completed']); 
                
    //    }

       return $this->return_output('flash', 'success', $success_message, 'reader-group-lists', '200');
    }

    
    public function edit($id)
    {
        
        $record=Reading::find($id);
        return view('admin.reader_group.edit',compact('record'));
    }

    

    public function update(Request $request ,$id)
    {
        // pr($request->all());
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


    public function disable($id)
    {
        $record=Reading::where('id',$id)->delete();
        return $this->return_output('flash', 'success', 'Action Completed successfully', 'reader-group-lists', '200');

    }   


    // public function reading_approve(Request $request)
    // {
        
    //     $record=Reading::where('id',$request->id)->update(['is_verified'=>1,'varifier'=>Auth::id()]);
    //     if($record)
    //     echo json_encode(['success'=>'true','message'=>'Action Completed']);
    //     else
    //     echo json_encode(['success'=>'false','message'=>'Action Failed']);
    //     // return $this->return_output('flash', 'success', 'Action Completed successfully', 'meter-reading-lists', '200');

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
