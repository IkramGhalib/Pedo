<?php

namespace App\Http\Controllers\Api\Student;

use Exception;
use App\Models\User;
use App\Models\RoleUser;
use App\Models\Role;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Validator;
use App\Http\Controllers\Controller;

class ApiResultController extends Controller
{
    /**
     * User login API method
     *
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    //  public function myResults(Request $request)
    // {
    //     $user_id = \Auth::user()->id;
    //     $courses = DB::table('courses')
    //                 ->select('courses.*', 'instructors.first_name', 'instructors.last_name')
    //                 ->join('instructors', 'instructors.id', '=', 'courses.instructor_id')
    //                 ->join('course_taken', 'course_taken.course_id', '=', 'courses.id')
    //                 ->where('course_taken.user_id',$user_id)->get();
        
    //     // return view('site.course.my-courses', compact('courses'));
    //                 return success('',$courses);
    // }
    public function myResultsCourses(Request $request)
    {
       
        // \Auth::user()->id
        // $category_search = $request->input('category_id');
        $groups = DB::table('groups')
                    ->select('groups.name','categories.name as cat_name','courses.*')
                    ->join('categories', 'categories.group_id', '=', 'groups.id')
                    ->join('master_categories', 'master_categories.id', '=', 'categories.master_category_id')
                    ->join('courses', 'courses.category_id', '=', 'categories.id')
                    ->join('tests', 'tests.course_id', '=', 'courses.id')
                    ->join('test_answers', 'test_answers.test_id', '=', 'tests.id')
                    ->where('test_answers.user_id',\Auth::user()->id)
                    
                    // ->where('master_categories.id',$category_search)
                    ->groupBy('courses.id')
                    ->where('groups.is_active',1)
                    ->get();

        // foreach ($groups as $key => $value) {
        //     $value->courses = DB::table('courses')
        //     ->select('courses.*', 'instructors.first_name', 'instructors.last_name')
        //     ->join('instructors', 'instructors.id', '=', 'courses.instructor_id')
        //     ->join('categories', 'categories.id', '=', 'courses.category_id')
        //     ->where('categories.group_id',$value->id) ->get();
        // }
        return success('',$groups);
        // return view('site.course.list', compact('groups'));
    }

    public function myResultsTests(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'course_id' => 'required|integer',
        ]);
        if ($validator->fails()) return error('Validation Error.', $validator->errors(), 422);
        $groups = DB::table('courses')
                    ->select('courses.course_title','tests.*')
                    ->join('tests', 'tests.course_id', '=', 'courses.id')
                    ->join('test_answers', 'test_answers.test_id', '=', 'tests.id')
                    ->where('test_answers.user_id',\Auth::user()->id)
                    ->where('courses.id',$request->course_id)
                    
                    // ->where('master_categories.id',$category_search)
                    ->groupBy('tests.id')
                    ->get();

     
        return success('',$groups);
    }

    public function myFinalResults(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'test_id' => 'required|integer',
        ]);
        if ($validator->fails()) return error('Validation Error.', $validator->errors(), 422);
        $groups = DB::table('tests')
                    ->select('questions.*','test_answers.*')
                    // ->join('tests', 'tests.course_id', '=', 'courses.id')
                    ->join('questions', 'questions.test_id', '=', 'tests.id')
                    ->join('test_answers', 'test_answers.q_id', '=', 'questions.id')
                    ->where('test_answers.user_id',\Auth::user()->id)
                    ->where('tests.id',$request->test_id)
                    
                    // ->where('master_categories.id',$category_search)
                    // ->groupBy('tests.id')
                    ->get();

     
        return success('',$groups);
    }
    // public function login(Request $request)
    // {
         
    //     $validator = Validator::make($request->all(), [
    //         'email'    => 'required|email',
    //         'password' => 'required'
    //     ]);

    //     if ($validator->fails()) return error('Validation Error.', $validator->errors(), 422);

    //     $credentials = $request->only('email', 'password');

    //     if (Auth::attempt($credentials)) {
           
    //         $user=User::with('roles')->where('id',Auth::user()->id)->first();
    //         if($user->device_imei=='not-set')
    //             User::where('id',$user->id)->update(['device_imei'=>$request->device_imei]);
    //         else
    //         {
    //             if($request->device_imei!=$user->device_imei)
    //             {
    //                     return error('Unauthorised Device', ['error' => 'Unauthorised'], 401);
    //             }
    //         }
    //         // pr($user);
    //         $success['name']  = $user->first_name.' '.$user->last_name ;
    //         $success['email']  = $user->email;
    //         $success['roles']= $user->roles;
    //         $success['token'] = $user->createToken('accessToken')->accessToken;

    //         return success($success, 'You are successfully logged in.');
    //     } else {
    //         return error('Unauthorised', ['error' => 'Unauthorised'], 401);
    //     }
    // }
}
