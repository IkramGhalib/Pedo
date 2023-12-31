<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Course;
use App\Models\Category;
use App\Models\Role;
use App\Models\Consumer;
use App\Models\ConsumerMeter;
use App\Models\ConsumerCategory;
use App\Models\Division;
use App\Models\SubDivision;
use App\Models\Feeder;
// use App\Models\Credit;
use App\Models\WithdrawRequest;
use Illuminate\Support\Facades\Validator;
use DB;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Storage;
use Image;
use SiteHelpers;
use Crypt;
use URL;
use Session;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Auth;
use Excel;


use App\Mail\ContactInstructor;

class ConsumerController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        
    }

    public function consumer_show()
    {
        $paginate_count = 10;
        
        $instructors = Consumer::with('meters')->orderBy('consumers.id')->paginate($paginate_count);
        // dd($instructors);
        return view('admin.consumer.index', compact('instructors'));
    }


    public function consumer_form()
    {
        $category=ConsumerCategory::where('is_active',1)->get();
        $previous_no=Consumer::orderBy('id','desc')->first();
        if($previous_no)
            $new_consumer_no=$previous_no->id+1;
        else
            $new_consumer_no=1;

        $divisions=Division::where('is_active',1)->get();
        // $meters=DB::table('meters')->where('status','free')->get();
        // dd($divisions);
        return view('admin.consumer.form',compact('category','divisions','new_consumer_no'));
    }
    public function consumer_import_form()
    {
       
        return view('admin.consumer.import_form');
    }
    public function consumer_import_form_process(Request $request)
    {
    //    pr($request->all());
       $this->validate($request, [
        'excel_file'  => 'required|mimes:xls,xlsx'
       ]);
       $theArray = Excel::toArray(new \stdClass(), $request->file('excel_file'));
       DB::beginTransaction();
       try {
                //    dd($theArray);
                foreach ($theArray[0] as $key => $value) {
                    // dd($value);
                    if($value[2] && $value[4] && $value[11] && $value[7]) // if all row is empty
                    {
                        if($key!=0  )
                        {
                           $cc_date= \PhpOffice\PhpSpreadsheet\Shared\Date::excelToDateTimeObject($value[6]);
                           $connection_date= $cc_date->format('Y-m-d');


                           $df_date= \PhpOffice\PhpSpreadsheet\Shared\Date::excelToDateTimeObject($value[4]);
                           $definition_date= $df_date->format('Y-m-d');
                          
                            $data=['full_name'=>$value[2],
                                    'father_name'=>$value[3],
                                    'address'=>$value[5],
                                ];
                            $check= DB::table('consumers')->where($data)->first();
                            if(!$check)
                            {
                                //get feeder id first here 
                                $feeder=['name'=>$value[11],
                                        'feeder_code'=>$value[10],
                                        ];
                                        // dd($feeder);
                                $feeder_data=Feeder::where($feeder)->first();
                                if(!$feeder_data)
                                {
                                    DB::rollback();
                                    return redirect()->back()->with(['error'=>'Failed. Feeder Data not found']); 
                                }

                                //consumer category checking        
                                $cc=['tarrif_code'=>$value[13]];
                                $cc_data=ConsumerCategory::where($cc)->first();
                                if(!$cc_data)
                                {
                                    DB::rollback();
                                    return redirect()->back()->with(['error'=>'Failed. Consumer Category Data not found']); 
                                }
                                //consumer entry code 
                                $consumer=['full_name'=>$value[2],
                                            'father_name'=>$value[3],
                                            'address'=>$value[4],
                                            'consumer_code'=>$value[0],
                                            'connection_date'=>$connection_date ,
                                            'consumer_category_id'=>$cc_data->id,
                                            'feeder_id'=>$feeder_data->id
                                            ];
                                $c_id=DB::table('consumers')->insertGetId($consumer);

                                    $meter=['meter_no'=>$value[7],
                                            'status'=>'assigned',
                                            ];
                                $m_id=DB::table('meters')->insertGetId($meter);
                                    $consumer_meter=[
                                            'meter_id'=>$m_id,
                                            'ref_no'=>$value[1],
                                            'mannual_ref_no'=>$value[1],
                                            'definition_date'=>$definition_date,
                                            'connection_date'=>$connection_date,
                                            'previous_reading_off_peak'=>$value[19],
                                            'arrear'=>$value[18],
                                            'consumer_id'=>$c_id
                                            ];        
                                
                                    
                                $cm_id=DB::table('consumer_meters')->insertGetId($consumer_meter);
                            }
                        }
                    }    
                    // dd($value);
                }

            DB::commit();
            return redirect()->back()->with(['success'=>'Action Completed']); 
        } catch (\Exception $e) {  
        // dd($e->getMessage());
        DB::rollback();
        return redirect()->back()->with(['error'=>'Action Failed '.$e->getMessage()]); 
        }  
    //    dd($theArray);
        // return view('admin.consumer.import_form');
    }

    public function consumer_save(Request $request)
    {
    
        $request->validate([
            'consumer_type' => 'required|integer',
            'division' => 'required|integer',
            'sub_division' => 'required|integer',
            'feeder' => 'required|integer',
            'full_name' => 'required|string',
            'father_name' => 'required|string',
            // 'cnic' => 'required|string|unique:consumers',
            'mobile' => 'required|string',
            'consumer_code' => 'required|string',
            'ref_no' => 'required|unique:consumer_meters',
            'address' => 'required|string',
            'connection_date' => 'required|string',
            'meter_no' => 'required',
           
           
        ], [
            'cnic.unique' => 'CNIC Already Used'
        ]);
       
        // pr($request->all());

        DB::beginTransaction();
        try {
        $division=Division::find($request->division);
        $subDivision=SubDivision::find($request->sub_division);
        $feeder=Feeder::find($request->feeder);

        // $new_ref_no=$division->division_code.$subDivision->sub_division_code.$feeder->feeder_code.$request->mannual_ref_no;
        $new_ref_no=  sprintf('%08d', $request->ref_no);
      

        $check_data=DB::table('consumer_meters')->where('mannual_ref_no',$new_ref_no)->first();
        if($check_data)
        return redirect()->back()->with(['error'=>'Ref No Already Exits']);

        // pr($new_ref_no);

        $cousumer=new Consumer();
        $cousumer->full_name=$request->full_name;
        $cousumer->father_name=$request->father_name;
        $cousumer->cnic=$request->cnic;
        $cousumer->mobile=$request->mobile;
        $cousumer->consumer_code=$request->consumer_code;
        $cousumer->address=$request->address;
        $cousumer->consumer_category_id=$request->consumer_type;
        $cousumer->feeder_id=$request->feeder;
        // $data=[feeder_id
        //     // 'full_name'=>$request->full_name,
        //         // 'father_name'=>$request->father_name,
        //         'cnic'=>$request->cnic,
        //         'mobile'=>$request->mobile,
        //         'consumer_id'=>0000,
        //         // 'ref_no'=>$request->ref_no,
        //         'address'=>$request->address,
        //         'consumer_category_id'=>$request->consumer_type,
               
        //         // ''=>$request->,
        //         ];


        $cousumer->save();
       
        // $meter_data= DB::table('meters')->where('meter_id',$request->meter_no)->update(['status'=>'assigned']);

        // pr($meter_data);
       
        DB::table('consumer_meters')->insert(
        [
            'mannual_ref_no'=>(int)$new_ref_no,
            'ref_no'=>$new_ref_no,
            // $cm->ref_no=(int)$request->mannual_ref_no[$key];
            // $cm->mannual_ref_no=$request->mannual_ref_no[$key];
            'consumer_id'=>$cousumer->id,
            'meter_no'=>$request->meter_no,
            'connection_date'=>db_date_format($request->connection_date),
            'definition_date'=>db_date_format($request->definition_date),
            'previous_reading_off_peak'=>$request->previous_reading,
            'arrear'=>$request->arrear
        ] );
        
                // pr($cousumer->id);
                
                DB::commit();
                return redirect()->back()->with(['success'=>'Action Completed']); 
        } catch (\Exception $e) {  
            // dd($e->getMessage());
            DB::rollback();
            return redirect()->back()->with(['error'=>'Action Failed '.$e->getMessage()]); 
        }  

       
    }

    // public function assignMeter(Request $request)
    // {
    //     pr(Session::get('consumser_id'));
    //     pr($request->all());
    //     $instructor=Instructor::find($id);
    //     return view('admin.consumer.edit',compact('instructor'));
    // }
    public function consumer_edit($id)
    {
        $category=ConsumerCategory::where('is_active',1)->get();

        // $previous_no=Consumer::orderBy('id','desc')->first();
        // if($previous_no)
        //     $new_consumer_no=$previous_no->id+1;
        // else
        //     $new_consumer_no=1;
        
        $divisions=Division::where('is_active',1)->get();
        // $meters=DB::table('meters')->where('status','free')->get();
        
        
        $instructor=Consumer::find($id);
        $area_data_all= DB::table('feeders')->select('feeders.*','sub_divisions.*','divisions.*','feeders.id as feeder_id','divisions.id as division_id','sub_divisions.id as sub_dev_id')
                        // ->from('feeders')
                        ->join('sub_divisions', 'sub_divisions.id', '=', 'feeders.sub_division_id')
                        ->join('divisions', 'divisions.id', '=', 'sub_divisions.division_id')
                        ->where('feeders.id',$instructor->feeder_id)->first();

                        
                        $sub_divisions= DB::table('sub_divisions')->where('division_id',$area_data_all->division_id)->get();
                        // pr($sub_divisions);                             

        $feeders= DB::table('feeders')->where('sub_division_id',$area_data_all->sub_dev_id)->get();


        return view('admin.consumer.edit',compact('instructor','category','divisions','sub_divisions','feeders','area_data_all'));
    }

    public function consumer_update(Request $request ,$id)
    {
        // dd($request->all());
        if($request->update_section && $request->update_section='meter')
        {
            foreach ($request->transection_id as $key => $row) {
                $cm=ConsumerMeter::find($row);
               
                // $cm->ref_no=$request->ref_no[$key];
                $cm->ref_no=sprintf('%08d', $request->ref_no[$key]);
                $cm->mannual_ref_no=(int)$request->ref_no[$key];
                // $cm->mannual_ref_no= sprintf('%08d', $request->mannual_ref_no[$key]);
                $cm->meter_no=$request->meter_no[$key];
                $cm->connection_date=$request->connection_date[$key];
                $cm->definition_date=$request->definition_date[$key];
                $cm->previous_reading_off_peak=$request->previous_reading[$key];
                $cm->save();
                // pr($cm);



                return redirect(route('consumer.lists'))->with(['success'=>'Action Completed']); 
            }
        }
        else
        {

                    $request->validate([
                        'consumer_type' => 'required|integer',
                        'division' => 'required|integer',
                        'sub_division' => 'required|integer',
                        'feeder' => 'required|integer',
                        'full_name' => 'required|string',
                        'father_name' => 'required|string',
                        // 'cnic' => 'required|string',
                        'mobile' => 'required|string',
                        'consumer_code' => 'required|string',
                        'address' => 'required|string',
                    ]);
                
                    // pr($request->all());

                    DB::beginTransaction();
                    try {
                    // $division=Division::find($request->division);
                    // $subDivision=SubDivision::find($request->sub_division);
                    // $feeder=Feeder::find($request->feeder);

                    // $new_ref_no=$feeder->feeder_code.' '.$subDivision->sub_division_code.' '.$division->division_code.' '.$request->ref_no;

                    // $check_data=DB::table('consumer_meters')->where('ref_no',$new_ref_no)->first();
                    // if($check_data)
                    // return redirect()->back()->with(['error'=>'Ref No Already Exits']);

                    // pr($new_ref_no);

                    $cousumer=Consumer::find($id);
                    $cousumer->full_name=$request->full_name;
                    $cousumer->father_name=$request->father_name;
                    $cousumer->cnic=$request->cnic;
                    $cousumer->mobile=$request->mobile;
                    $cousumer->consumer_code=$request->consumer_code;
                    $cousumer->address=$request->address;
                    $cousumer->consumer_category_id=$request->consumer_type;
                    $cousumer->feeder_id=$request->feeder;
                    $cousumer->save();
                            
                            DB::commit();
                            return redirect(route('consumer.lists'))->with(['success'=>'Action Completed']); 
                    } catch (\Exception $e) {  
                        DB::rollback();
                        return redirect()->back()->with(['error'=>'Action Failed']); 
                    }  

        }

       
    
    }


    public function consumer_disable($id)
    {
        
        $instructor=Consumer::find($id);
        if($instructor->status=='Disable')
        $instructor->status='active';
        else
        $instructor->status='Disable';

        $instructor->save();
        return $this->return_output('flash', 'success', 'Status Changed successfully', 'consumer-lists', '200');

    }   

    public function consumerList()
    {
        $paginate_count = 8;
        
        $instructors = DB::table('instructors')->groupBy('instructors.id')->paginate($paginate_count);
        return view('site.consumer', compact('instructors'));
        
    }

    // public function consumerView($instructor_slug = '', Request $request)
    // {
    //     $instructor = Instructor::where('instructor_slug', $instructor_slug)->first();
    //     $metrics = Instructor::metrics($instructor->id);
    //     return view('site.instructor_view', compact('instructor', 'metrics'));
    // }

    // public function dashboard(Request $request)
    // {
    //     $instructor_id = \Auth::user()->instructor->id;
    //     $courses = DB::table('courses')
    //                     ->select('courses.*', 'categories.name as category_name')
    //                     ->leftJoin('categories', 'categories.id', '=', 'courses.category_id')
    //                     ->where('courses.instructor_id', $instructor_id)
    //                     ->paginate(5);
    //     $metrics = Instructor::metrics($instructor_id);
    //     return view('instructor.dashboard', compact('courses', 'metrics'));
    // }

    // public function contactInstructor(Request $request)
    // {
    //     $instructor_email = $request->instructor_email;
    //     Mail::to($instructor_email)->send(new ContactInstructor($request));
    //     return $this->return_output('flash', 'success', 'Thanks for your message, will contact you shortly', 'back', '200');
    // }
    // public function becomeInstructor(Request $request)
    // {
    //     if(!\Auth::check()){
    //         return $this->return_output('flash', 'error', 'Please login to become an Instructor', 'back', '422');
    //     }

    //     $instructor = new Instructor();

    //     $instructor->user_id = \Auth::user()->id;
    //     $instructor->first_name = $request->input('first_name');
    //     $instructor->last_name = $request->input('last_name');
    //     $instructor->contact_email = $request->input('contact_email');

    //     $first_name = $request->input('first_name');
    //     $last_name = $request->input('last_name');

    //     //create slug only while add
    //     $slug = $first_name.'-'.$last_name;
    //     $slug = str_slug($slug, '-');

    //     $results = DB::select(DB::raw("SELECT count(*) as total from instructors where instructor_slug REGEXP '^{$slug}(-[0-9]+)?$' "));

    //     $finalSlug = ($results['0']->total > 0) ? "{$slug}-{$results['0']->total}" : $slug;
    //     $instructor->instructor_slug = $finalSlug;

    //     $instructor->telephone = $request->input('telephone');
    //     $instructor->paypal_id = $request->input('paypal_id');
    //     $instructor->biography = $request->input('biography');
    //     $instructor->save();

    //     $user = User::find(\Auth::user()->id);

    //     $role = Role::where('name', 'instructor')->first();
    //     $user->roles()->attach($role);
        
    //     return redirect()->route('instructor.dashboard') ;
    // }

    // public function getProfile(Request $request)
    // {
    //     $instructor = Instructor::where('user_id', \Auth::user()->id)->first();
    //     // echo '<pre>';print_r($instructor);exit;
    //     return view('instructor.profile', compact('instructor'));
    // }

    // public function saveProfile(Request $request)
    // {
    //     // echo '<pre>';print_r($_FILES);exit;
    //     $validation_rules = [
    //         'first_name' => 'required|string|max:255',
    //         'last_name' => 'required|string|max:255',
    //         'contact_email' => 'required|string|email|max:255',
    //         'telephone' => 'required|string|max:255',
    //         'paypal_id' => 'required|string|email|max:255',
    //         'biography' => 'required',            
    //     ];

    //     $validator = Validator::make($request->all(),$validation_rules);

    //     // Stop if validation fails
    //     if ($validator->fails()) {
    //         return $this->return_output('error', 'error', $validator, 'back', '422');
    //     }

    //     $instructor = Instructor::where('user_id', \Auth::user()->id)->first();
    //     $instructor->first_name = $request->input('first_name');
    //     $instructor->last_name = $request->input('last_name');
    //     $instructor->contact_email = $request->input('contact_email');

    //     $instructor->telephone = $request->input('telephone');
    //     $instructor->mobile = $request->input('mobile');

    //     $instructor->link_facebook = $request->input('link_facebook');
    //     $instructor->link_linkedin = $request->input('link_linkedin');
    //     $instructor->link_twitter  = $request->input('link_twitter');
    //     $instructor->link_googleplus = $request->input('link_googleplus');

    //     $instructor->paypal_id = $request->input('paypal_id');
    //     $instructor->biography = $request->input('biography');


    //     if (Input::hasFile('course_image') && Input::has('course_image_base64')) {
    //         //delete old file
    //         $old_image = $request->input('old_course_image');
    //         if (Storage::exists($old_image)) {
    //             Storage::delete($old_image);
    //         }

    //         //get filename
    //         $file_name   = $request->file('course_image')->getClientOriginalName();

    //         // returns Intervention\Image\Image
    //         $image_make = Image::make($request->input('course_image_base64'))->encode('jpg');

    //         // create path
    //         $path = "instructor/".$instructor->id;
            
    //         //check if the file name is already exists
    //         $new_file_name = SiteHelpers::checkFileName($path, $file_name);

    //         //save the image using storage
    //         Storage::put($path."/".$new_file_name, $image_make->__toString(), 'public');

    //         $instructor->instructor_image = $path."/".$new_file_name;
            
    //     }

    //     $instructor->save();

    //     return $this->return_output('flash', 'success', 'Profile updated successfully', 'instructor-profile', '200');

    // }

    // public function credits(Request $request)
    // {
    //     $credits = Credit::where('instructor_id', \Auth::user()->instructor->id)
    //                     ->where('credits_for', 1)
    //                     ->orderBy('created_at', 'desc')
    //                     ->paginate(10);

    //     return view('instructor.credits', compact('credits'));
    // }

    // public function withdrawRequest(Request $request)
    // {
    //     $withdraw_request = new WithdrawRequest();

    //     $withdraw_request->instructor_id = \Auth::user()->instructor->id;
    //     $withdraw_request->paypal_id = $request->input('paypal_id');
    //     $withdraw_request->amount = $request->input('amount');
    //     $withdraw_request->save();

    //     return $this->return_output('flash', 'success', 'Withdraw requested successfully', 'instructor-credits', '200');
    // }

    // public function listWithdrawRequests(Request $request)
    // {
    //     $withdraw_requests = WithdrawRequest::where('instructor_id', \Auth::user()->instructor->id)
    //                         ->paginate(10);

    //     return view('instructor.withdraw_requests', compact('withdraw_requests'));
    // }
    
}
