<?php

namespace App\Http\Controllers;

use App\Models\Course;
use App\Models\ConsumerCategory;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use DB;

class ConsumerCategoryController extends Controller
{
    // front End Test page will shows
    

    public function index(Request $request)
    {

        $paginate_count = 10;
        if($request->has('search')){
            $search = $request->input('search');
            $list = ConsumerCategory::where('name', 'LIKE', '%' . $search . '%')
                           ->paginate($paginate_count);
        }
        else {
            $list = ConsumerCategory::paginate($paginate_count);
        }

        // $test=Test::all();
        return view('admin.consumer_category.index',compact('list'));
    }
    public function create()
    {
        // $courses=ConsumerCategory::all();
        return view('admin.consumer_category.create');
    }

    public function store(Request $request)
    {

        $request->validate([
            'name' => 'required|string',
            'tarrif_code' => 'required|string',
            'status' => 'required',
           
        ]);     
        $record=new ConsumerCategory();
        $record->is_active=$request->status;

        $record->name=$request->name;
        $record->tarrif_code=$request->tarrif_code;
        // dd($test);
        $record->save();
        return $this->return_output('flash', 'success', 'successfully added', 'admin/consumer-category-list', '200');

    }

    public function edit($id)
    {
        $record=ConsumerCategory::find($id);
        // $courses = Course::all();
        return view('admin.consumer_category.edit',compact('record'));
    }

    public function update($id,Request $request)
    {
        $record=ConsumerCategory::find($id);
        $record->name=$request->name;
        $record->tarrif_code=$request->tarrif_code;
       
        $record->is_active=$request->status;
        // dd($test);
        $record->save();
        return $this->return_output('flash', 'success', 'successfully updated', 'admin/consumer-category-list', '200');
    }

    // public function destroy($id)
    // {
    //     ConsumerCategory::destroy($id);
    //     return $this->return_output('flash', 'success', 'deleted successfully', 'admin/consumer-category-list', '200');
    // }
}
