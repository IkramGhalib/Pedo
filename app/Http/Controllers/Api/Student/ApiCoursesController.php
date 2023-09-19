<?php

namespace App\Http\Controllers\Api\Student;

use Exception;
use App\Models\User;
use App\Models\RoleUser;
use App\Models\Role;
use App\Models\Course;
use App\Models\CourseRating;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Validator;
use App\Http\Controllers\Controller;

class ApiCoursesController extends Controller
{
    public function __construct()
    {
        $this->model = new Course();
    }
    /**
     * User login API method
     *
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    // show login user register courses
     public function myCourses(Request $request)
    {
        $user_id = \Auth::user()->id;
        $courses = DB::table('courses')
                    ->select('courses.id as course_id','groups.*','categories.*','master_courses.course_title', 'instructors.first_name', 'instructors.last_name')
                    ->join('instructors', 'instructors.id', '=', 'courses.instructor_id')
                    ->join('categories', 'categories.id', '=', 'courses.category_id')
                    ->join('groups', 'groups.id', '=', 'categories.group_id')
                    ->join('master_courses', 'master_courses.id', '=', 'courses.master_course_id')
                    ->join('course_taken', 'course_taken.course_id', '=', 'courses.id')
                    ->where('course_taken.user_id',$user_id)->get();
                    // pr($user_id);
        
        // return view('site.course.my-courses', compact('courses'));
        return success('',$courses);
    }

    public function getCourseById(Request $request)
    { 
        $validator = Validator::make($request->all(), [
            'course_id' => 'required|integer',
        ]);

        if ($validator->fails()) return error('Validation Error.', $validator->errors(), 422);

        $id=$request->course_id;
        $course=Course::where('id', $id)->first();
        $c['course'] = $course;

        $c['students_count'] = $this->model->students_count($course->id);
        $curriculum = $this->model->getcurriculum($course->id);
        $c['curriculum'] = $curriculum;
        $c['curriculum_sections'] = $curriculum['sections'];
        $c['lectures_count'] = $curriculum['lectures_count'];
        $c['videos_count'] = $curriculum['videos_count'];
        $c['is_curriculum'] = $curriculum['is_curriculum'];
        $video = null;
        // dd($course->course_video);
        if($course->course_video)
        {
            $c['video'] = $this->model->getvideoinfoFirst($course->course_video); 
        }
        $course_rating = CourseRating::where('course_id', $course->id)->where('user_id', \Auth::user()->id)->first();
        $c['course_rating']=$course_rating;
        if(!$course_rating) {
            $c['course_rating'] = $this->getColumnTable('course_ratings');
        }
        return success('',$c);
        // return view('site.course.learn', compact('course', 'curriculum_sections', 'lectures_count', 'videos_count', 'video', 'course_breadcrumb', 'is_curriculum', 'course_rating', 'students_count'));
    }

    public function getCourseVideos(Request $request)
    { 
        $validator = Validator::make($request->all(), [
            'course_id' => 'required|integer',
        ]);

        if ($validator->fails()) return error('Validation Error.', $validator->errors(), 422);
        $c=$this->model->getCourseVideos($request->course_id);
        // $id=$request->course_id;
        // $course=Course::where('id', $id)->first();
        // $c['course'] = $course;

        // $c['students_count'] = $this->model->students_count($course->id);
        // $curriculum = $this->model->getcurriculum($course->id);
        // $c['curriculum'] = $curriculum;
        // $c['curriculum_sections'] = $curriculum['sections'];
        // $c['lectures_count'] = $curriculum['lectures_count'];
        // $c['videos_count'] = $curriculum['videos_count'];
        // $c['is_curriculum'] = $curriculum['is_curriculum'];
        // $video = null;
        // // dd($course->course_video);
        // if($course->course_video)
        // {
        //     $c['video'] = $this->model->getvideoinfoFirst($course->course_video); 
        // }
        // $course_rating = CourseRating::where('course_id', $course->id)->where('user_id', \Auth::user()->id)->first();
        // $c['course_rating']=$course_rating;
        // if(!$course_rating) {
        //     $c['course_rating'] = $this->getColumnTable('course_ratings');
        // }
        return success('',$c);
        // return view('site.course.learn', compact('course', 'curriculum_sections', 'lectures_count', 'videos_count', 'video', 'course_breadcrumb', 'is_curriculum', 'course_rating', 'students_count'));
    }


    
    public function courseList(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'category_id' => 'required|integer',
        ]);

        if ($validator->fails()) return error('Validation Error.', $validator->errors(), 422);

        $category_search = $request->input('category_id');
        $groups = DB::table('groups')
                    ->select('groups.*','categories.name as cat_name')
                    ->join('categories', 'categories.group_id', '=', 'groups.id')
                    ->join('master_categories', 'master_categories.id', '=', 'categories.master_category_id')
                    ->where('master_categories.id',$category_search)
                    ->where('groups.is_active',1)
                    ->get();

        foreach ($groups as $key => $value) {
            $value->courses = DB::table('courses')
            ->select('courses.*', 'instructors.first_name', 'instructors.last_name')
            ->join('instructors', 'instructors.id', '=', 'courses.instructor_id')
            ->join('categories', 'categories.id', '=', 'courses.category_id')
            ->where('categories.group_id',$value->id) ->get();
        }
        return success('',$groups);
        // return view('site.course.list', compact('groups'));
    }

    // public function register_course(Request $request)
    // {
          
    // }
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

    // public function myCourse(Request $request)
    // {
    //     $validator = Validator::make($request->all(), [
    //         'old_password' => 'required',
    //         'new_password' => 'required|min:3',
    //         'confirm_password' => 'required|same:new_password'
    //     ]);

    //     if ($validator->fails()) return error('Validation Error.', $validator->errors(), 422);

    //     $user = Auth::user();

    //     if (password_verify($request->old_password, $user->password)) {
    //         $user->password = bcrypt($request->new_password);
    //         $user->save();

    //         return success([], 'Password changed successfully.');
    //     } else {
    //         return error('Password unmatched', ['error' => 'Password did not matched'], 401);
    //     }
    // }

    public function myExam(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'old_password' => 'required',
            'new_password' => 'required|min:3',
            'confirm_password' => 'required|same:new_password'
        ]);

        if ($validator->fails()) return error('Validation Error.', $validator->errors(), 422);

        $user = Auth::user();

        if (password_verify($request->old_password, $user->password)) {
            $user->password = bcrypt($request->new_password);
            $user->save();

            return success([], 'Password changed successfully.');
        } else {
            return error('Password unmatched', ['error' => 'Password did not matched'], 401);
        }
    }


   

}
