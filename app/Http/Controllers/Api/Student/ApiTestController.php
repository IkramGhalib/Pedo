<?php

namespace App\Http\Controllers\Api\Student;

use Exception;
use App\Models\User;
use App\Models\RoleUser;
use App\Models\Question;
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

class ApiTestController extends Controller
{
    /**
     * User login API method
     *
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
     public function myTests(Request $request)
    {
        $user_id = \Auth::user()->id;
        $courses = DB::table('courses')
                    ->select('courses.*', 'instructors.first_name', 'instructors.last_name')
                    ->join('instructors', 'instructors.id', '=', 'courses.instructor_id')
                    ->join('course_taken', 'course_taken.course_id', '=', 'courses.id')
                    ->where('course_taken.user_id',$user_id)->get();
        
        // return view('site.course.my-courses', compact('courses'));
                    return success('',$courses);
    }
    public function getCourseTests(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'course_id' => 'required|integer',
        ]);
        if ($validator->fails()) return error('Validation Error.', $validator->errors(), 422);

        $id=$request->course_id;
        $courses = DB::table('courses')
                    ->select('tests.*')
                    ->join('tests', 'tests.course_id', '=', 'courses.id')
                    // ->join('groups', 'groups.id', '=', 'categories.group_id')
                    // ->join('master_courses', 'master_courses.id', '=', 'courses.master_course_id')
                    // ->join('course_taken', 'course_taken.course_id', '=', 'courses.id')
                    ->where('courses.id',$id)->get();
        return success('',$courses);            
    }
    public function getTestQuestions(Request $request)
    {
        // pr($request->all());
        $validator = Validator::make($request->all(), [
            'test_id' => 'required|integer',
        ]);
        if ($validator->fails()) return error('Validation Error.', $validator->errors(), 422);
        
        $id=$request->test_id;
        $question_no=1;
        if($request->question_no)
        $question_no=$request->question_no;
        $result = DB::table('questions')
                    // ->join('tests', 'tests.course_id', '=', 'courses.id')
                    // ->join('groups', 'groups.id', '=', 'categories.group_id')
                    // ->join('master_courses', 'master_courses.id', '=', 'courses.master_course_id')
                    // ->join('course_taken', 'course_taken.course_id', '=', 'courses.id')
                    ->where('test_id',$id)
                    ->where('question_no',$question_no)
                    ->first();

        return success('',$result);            
    }

    public function postAnswers(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'test_id' => 'required|integer',
        ]);
        if ($validator->fails()) return error('Validation Error.', $validator->errors(), 422);
        
        $row=[];
        foreach ($request->q_id as $key => $value) {
            $row[]=array('user_id'=>\Auth::user()->id,'q_id'=>$value,'given_answer'=>$request->given_answer[$key],'corrected_answer'=>$request->corrected_answer[$key]);
        }
        Answer::where('test_id',$request->test_id)->delete();
        Answer::create($row);
        return success('',$result);            
    }


}
