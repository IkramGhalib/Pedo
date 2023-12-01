<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Blog;
use DB;
use Illuminate\Support\Facades\Mail;
use App\Mail\ContactAdmin;
use App\Models\Cart;
use App\Models\Config;
use Illuminate\Support\Facades\Auth;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        // $this->middleware('auth', ['except' => ['checkUserEmailExists']]);
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
      
    //    pr($request->all());
       $bill=[];
       if($request->keyword)
       {
            $bill = DB::table('consumer_bills')
                    ->select('consumer_bills.*', 'bill_generates.*', 'consumer_meters.*','consumer_bills.id as bill_id','consumers.*')
                    // ->selectRaw('AVG(course_ratings.rating) AS average_rating')
                    ->Join('bill_generates', 'bill_generates.id', '=', 'consumer_bills.generate_bill_id')
                    ->Join('consumer_meters', 'consumer_meters.cm_id', '=', 'consumer_bills.cm_id')
                    ->join('consumers', 'consumers.id', '=', 'consumer_meters.consumer_id')
                    ->where('consumer_meters.ref_no',$request->keyword)
                    // ->groupBy('courses.id')
                    // ->limit(8)
                    ->orderBy('consumer_bills.id', 'desc')
                    ->first();
                    // dd($bill);
                }


       
        
        // $latestTab_courses = DB::table('courses')
        //             ->select('courses.*', 'instructors.first_name', 'instructors.last_name')
        //             ->selectRaw('AVG(course_ratings.rating) AS average_rating')
        //             ->leftJoin('course_ratings', 'course_ratings.course_id', '=', 'courses.id')
        //             ->join('instructors', 'instructors.id', '=', 'courses.instructor_id')
        //             ->where('courses.is_active',1)
        //             ->groupBy('courses.id')
        //             ->limit(8)
        //             ->orderBy('courses.updated_at', 'desc')
        //             ->get();
        
        // $freeTab_courses = DB::table('courses')
        //             ->select('courses.*', 'instructors.first_name', 'instructors.last_name')
        //             ->selectRaw('AVG(course_ratings.rating) AS average_rating')
        //             ->leftJoin('course_ratings', 'course_ratings.course_id', '=', 'courses.id')
        //             ->join('instructors', 'instructors.id', '=', 'courses.instructor_id')
        //             ->where('courses.is_active',1)
        //             ->groupBy('courses.id')
        //             ->limit(8)
        //             ->where('courses.price', 0)
        //             ->get();

        // $discountTab_courses = DB::table('courses')
        //             ->select('courses.*', 'instructors.first_name', 'instructors.last_name')
        //             ->selectRaw('AVG(course_ratings.rating) AS average_rating')
        //             ->leftJoin('course_ratings', 'course_ratings.course_id', '=', 'courses.id')
        //             ->join('instructors', 'instructors.id', '=', 'courses.instructor_id')
        //             ->where('courses.is_active',1)
        //             ->groupBy('courses.id')
        //             ->limit(8)
        //             ->where('courses.strike_out_price', '<>' ,null)
        //             ->get();

        // $instructors = DB::table('instructors')
        //                 ->select('instructors.*')
        //                 ->join('users', 'users.id', '=', 'instructors.user_id')
        //                 ->where('users.is_active',1)
        //                 ->groupBy('instructors.id')
        //                 ->limit(8)
        //                 ->get();
            //  dd($bill);  
             
            //  die('testing');         
        return view('site/home', compact('bill') );
    }

    /**
     * Function to check whether the email already exists
     *
     * @param array $request All input values from form
     *
     * @return true or false
     */

     public function checkUserEmailExists(Request $request)
     {
         $email = $request->input('email');
         
         $users = User::where('email',$email)->first();
         
         echo $users ? "false" : "true";
     }
    public function single_bill($bill_id,Request $request)
    {
        // pr($request->all());
        // $email = $request->input('email');
        
        // $users = User::where('email',$email)->first();
        
        // echo $users ? "false" : "true";
        // return view('single_bill');


           
                $bill_data = DB::table('consumer_bills')
                ->select('meter_readings.offpeak_prev as prev_offpeak_reading','meter_readings.offpeak as offpeak_current_reading','meter_readings.datetime as reading_date','consumer_bills.*', 'bill_generates.*',  'bill_generates.created_at as bill_generate_date','consumer_meters.connection_date as meter_connection_date','consumer_meters.*','consumer_bills.id as bill_id','consumers.*','feeders.name as feeder_name','sub_divisions.name as sub_division_name','divisions.name as division_name','meters.meter_no')
                // ->selectRaw('AVG(course_ratings.rating) AS average_rating')
                ->Join('meter_readings', 'meter_readings.id', '=', 'consumer_bills.reading_id')
                ->Join('bill_generates', 'bill_generates.id', '=', 'consumer_bills.generate_bill_id')
                ->Join('consumer_meters', 'consumer_meters.cm_id', '=', 'consumer_bills.cm_id')
                ->join('consumers', 'consumers.id', '=', 'consumer_meters.consumer_id')
                ->join('feeders', 'feeders.id', '=', 'consumers.feeder_id')
                ->join('sub_divisions', 'sub_divisions.id', '=', 'feeders.sub_division_id')
                ->join('divisions', 'divisions.id', '=', 'sub_divisions.division_id')
                ->join('meters', 'meters.meter_id', '=', 'consumer_meters.meter_id')
                // ->join('consumer_meters', 'meters.meter_id', '=', 'consumer_meters.meter_id')
                
                ->where('consumer_bills.id',$bill_id)
                // ->groupBy('courses.id')
                // ->limit(8)
                ->orderBy('consumer_bills.id', 'desc')
                ->first();
                // pr($bill_data);

                // $payment_and_bill = DB::table('consumer_bills')
                // ->select('consumer_bills.*','payment_receives.payment_amount as pay_amount')
                // ->leftJoin('payment_receives', 'payment_receives.bill_id', '=', 'consumer_bills.id')
                // ->where('consumer_bills.cm_id',$bill_data->cm_id)
                // ->where('consumer_bills.id','!=',$bill_id)
                // ->orderBy('consumer_bills.id', 'desc')
                // ->limit(12)->get();
                $payment_and_bill = DB::table('consumer_bills')
                ->select('consumer_bills.*','payment_receives.payment_amount as pay_amount')
                ->leftJoin('payment_receives', 'payment_receives.bill_id', '=', 'consumer_bills.id')
                ->where('consumer_bills.cm_id',$bill_data->cm_id)
                ->where('consumer_bills.id','!=',$bill_data->bill_id)
                ->where('consumer_bills.billing_month_year','<',$bill_data->billing_month_year)
                ->orderBy('consumer_bills.id', 'desc')
                ->limit(12)->get();

                // dd($payment_and_bill);


        return view('single_bill_v2',compact('bill_data','payment_and_bill'));
    }

    public function blogList(Request $request)
    {
     

        $paginate_count = 3;
        $blogs =  Blog::where('is_active',1)
                    ->paginate($paginate_count);

        $archieves = DB::table('blogs')
                ->select(DB::raw('YEAR(created_at) year, MONTH(created_at) month, MONTHNAME(created_at) month_name, COUNT(*) blog_count'))
                ->groupBy('year')
                ->groupBy('month')
                ->orderBy('year', 'desc')
                ->orderBy('month', 'desc')
                ->get();
        
        return view('site.blogs.list', compact('blogs', 'archieves'));
    }

    public function blogView($blog_slug = '', Request $request)
    {
        
        
      

        $paginate_count = 1;
        $blog =  Blog::where('blog_slug',$blog_slug)->first();

        $archieves = DB::table('blogs')
                ->select(DB::raw('YEAR(created_at) year, MONTH(created_at) month, MONTHNAME(created_at) month_name, COUNT(*) blog_count'))
                ->groupBy('year')
                ->groupBy('month')
                ->orderBy('year', 'desc')
                ->orderBy('month', 'desc')
                ->get();

        return view('site.blogs.view', compact('blog', 'archieves'));
    }

    public function pageAbout(Request $request)
    {
        return view('site.pages.about');
    }

    public function pageContact(Request $request)
    {
        return view('site.pages.contact');
    }

    public function contactAdmin(Request $request)
    {   
        $admin_email = Config::get_option('settingGeneral', 'admin_email');
        Mail::to($admin_email)->send(new ContactAdmin($request));
        return $this->return_output('flash', 'success', 'Thanks for your message, will contact you shortly', 'back', '200');
    }

    public function getCheckTime()
	{
		$reset_site_at = Config::get_option('lastResetTime', 'lastResetTime');
		
		$reset_minutes = 60 * 60;
        
        if(($reset_site_at+$reset_minutes) - time() > 0)
		{
			echo ($reset_site_at+$reset_minutes) - time();
		}
		else
		{
			echo $reset_minutes;
		}
		
	}
}
