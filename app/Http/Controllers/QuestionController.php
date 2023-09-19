<?php

namespace App\Http\Controllers;

use App\Models\Question;
use App\Models\Test;
use Illuminate\Http\Request;

class QuestionController extends Controller
{

    public function index(Request $request)
    {
        $paginate_count = 10;
        if($request->has('search')){
            $search = $request->input('search');
            $categories = Test::where('test_title', 'LIKE', '%' . $search . '%')
                           ->paginate($paginate_count);
        }
        else {
            $questions = Question::paginate($paginate_count);
        }

        return view('admin.question.index',compact('questions'));
    }
    public function create()
    {
        $test=Test::all();
        return view('admin.question.form',compact('test'));
    }
    public function store(Request $request)
    {
        // dd($request->all());
        $question=new Question();
        $question->test_id=$request->test_id;

        // $question->question_no=$request->question_no;

        $unique_no=1;
        #Store Unique Order/Product Number
        $check = Question::orderBy('id', 'DESC')->where('test_id',$request->test_id)->first();
        if($check ){
        #If Table is Empty
            $unique_no = $chec->question_no+1;
        }
        else{
        #If Table has Already some Data
        // $unique_no = $unique_no + 1;
      }
     $question->question_no = $unique_no;
        $question->question_name=$request->question_name;
        $question->opt_1=$request->opt_1;
        $question->opt_2=$request->opt_2;
        $question->opt_3=$request->opt_3;
        $question->opt_4=$request->opt_4;
        $question->correct_answer=$request->correct_answer;
        // dd($question);
        $question->save();
        return $this->return_output('flash', 'success', 'Question successfully add', 'admin/question-list', '200');

    }



    public function edit($id)
    {
        $question=Question::find($id);
        $test = Test::all();
        return view('admin.question.edit',compact('test','question'));
    }


    
    public function update($id,Request $request)
    {
        $question=Question::find($id);
        $question->test_id=$request->test_id;
        $question->question_no=$request->question_no;
        $question->question_name=$request->question_name;
        $question->opt_1=$request->opt_1;
        $question->opt_2=$request->opt_2;
        $question->opt_3=$request->opt_3;
        $question->opt_4=$request->opt_4;
        $question->correct_answer=$request->correct_answer;
        // dd($test);
        $question->save();
        return $this->return_output('flash', 'success', 'Question successfully updated', 'admin/question-list', '200');
    }
//ck editor functions
    public function question_image(Request $request){
        if ($request->hasFile('upload')) {
        $originName = $request->file('upload')->getClientOriginalName();
         $fileName = pathinfo($originName, PATHINFO_FILENAME);
        $extension = $request->file('upload')->getClientOriginalExtension();
         $fileName = $fileName . '_' . time() . '.' . $extension;
        $request->file('upload')->move(public_path('media'), $fileName);
        $url = asset('media/' .$fileName);
        return response()->json(['fileName' => $fileName, 'uploaded' => 1, 'url' => $url]);
        }
    }
// editor option 1
    public function question_option_1(Request $request){
        if ($request->hasFile('upload')) {
        $originName = $request->file('upload')->getClientOriginalName();
         $fileName = pathinfo($originName, PATHINFO_FILENAME);
        $extension = $request->file('upload')->getClientOriginalExtension();
         $fileName = $fileName . '_' . time() . '.' . $extension;
        $request->file('upload')->move(public_path('media'), $fileName);
        $url = asset('media/' .$fileName);
        return response()->json(['fileName' => $fileName, 'uploaded' => 1, 'url' => $url]);
        }
    }
// editor option 2
    public function question_option_2(Request $request){
        if ($request->hasFile('upload')) {
        $originName = $request->file('upload')->getClientOriginalName();
         $fileName = pathinfo($originName, PATHINFO_FILENAME);
        $extension = $request->file('upload')->getClientOriginalExtension();
         $fileName = $fileName . '_' . time() . '.' . $extension;
        $request->file('upload')->move(public_path('media'), $fileName);
        $url = asset('media/' .$fileName);
        return response()->json(['fileName' => $fileName, 'uploaded' => 1, 'url' => $url]);
        }
    }


    // editor option 3
    public function question_option_3(Request $request){
        if ($request->hasFile('upload')) {
        $originName = $request->file('upload')->getClientOriginalName();
         $fileName = pathinfo($originName, PATHINFO_FILENAME);
        $extension = $request->file('upload')->getClientOriginalExtension();
         $fileName = $fileName . '_' . time() . '.' . $extension;
        $request->file('upload')->move(public_path('media'), $fileName);
        $url = asset('media/' .$fileName);
        return response()->json(['fileName' => $fileName, 'uploaded' => 1, 'url' => $url]);
        }
    }


    
    // editor option 4
    public function question_option_4(Request $request){
        if ($request->hasFile('upload')) {
        $originName = $request->file('upload')->getClientOriginalName();
         $fileName = pathinfo($originName, PATHINFO_FILENAME);
        $extension = $request->file('upload')->getClientOriginalExtension();
         $fileName = $fileName . '_' . time() . '.' . $extension;
        $request->file('upload')->move(public_path('media'), $fileName);
        $url = asset('media/' .$fileName);
        return response()->json(['fileName' => $fileName, 'uploaded' => 1, 'url' => $url]);
        }
    }


    public function destroy($id)
    {
        Question::destroy($id);
        return $this->return_output('flash', 'success', 'Question deleted successfully', 'admin/question-list', '200');
    }

    
}
