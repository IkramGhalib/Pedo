<?php

namespace App\Http\Controllers;

use App\Models\Course;
use App\Models\Test;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use DB;

class TestController extends Controller
{
    // front End Test page will shows
    public function applyTest()
    {
        $charges = DB::table('options')->where('code','testFee')->where('option_key','onlineFee')->first();
        return view('site.apply_test', compact('charges'));
    }

    public function index(Request $request)
    {

        $paginate_count = 10;
        if($request->has('search')){
            $search = $request->input('search');
            $categories = Test::where('test_title', 'LIKE', '%' . $search . '%')
                           ->paginate($paginate_count);
        }
        else {
            $tests = Test::paginate($paginate_count);
        }

        // $test=Test::all();
        return view('admin.tests.index',compact('tests'));
    }
    public function create()
    {
        $courses=Course::all();
        return view('admin.tests.create',compact('courses'));
    }

    public function store(Request $request)
    {
        
        $test=new Test();
        $test->course_id=$request->course_id;
        $test->test_title=$request->test_title;
        $test->test_start=$request->test_start;
        $test->test_end=$request->test_end;
        $test->time_start=$request->time_start;
        $test->time_end=$request->time_end;
        $test->user_id=Auth::id();
        $test->status=$request->status;
        // dd($test);
        $test->save();
        return $this->return_output('flash', 'success', 'Test successfully add', 'admin/test-list', '200');

    }

    public function edit($id)
    {
        $test=Test::find($id);
        $courses = Course::all();
        return view('admin.tests.edit',compact('test','courses'));
    }

    public function update($id,Request $request)
    {
        $test=Test::find($id);
        $test->course_id=$request->course_id;
        $test->test_title=$request->test_title;
        $test->test_start=$request->test_start;
        $test->test_end=$request->test_end;
        $test->time_start=$request->time_start;
        $test->time_end=$request->time_end;
        $test->user_id=Auth::id();
        $test->status=$request->status;
        // dd($test);
        $test->save();
        return $this->return_output('flash', 'success', 'Test successfully updated', 'admin/test-list', '200');
    }

    public function destroy($id)
    {
        Test::destroy($id);
        return $this->return_output('flash', 'success', 'Test deleted successfully', 'admin/test-list', '200');
    }
}
