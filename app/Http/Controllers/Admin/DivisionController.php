<?php

namespace App\Http\Controllers\Admin;

use App\Models\Division;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use DB;
use App\Http\Controllers\Controller;

class DivisionController extends Controller
{
    public function index(Request $request)
    {

        $paginate_count = 10;
        if($request->has('search')){
            $search = $request->input('search');
            $list = Division::where('name', 'LIKE', '%' . $search . '%')
                           ->paginate($paginate_count);
        }
        else {
            $list = Division::paginate($paginate_count);
        }

        // $test=Test::all();
        return view('admin.division.index',compact('list'));
    }
    public function create()
    {
        // $courses=Division::all();
        return view('admin.division.create');
    }

    public function store(Request $request)
    {

        $request->validate([
            'name' => 'required|string',
            'division_code' => 'required|string',
            'status' => 'required',
           
        ]);     
        $record=new Division();
        $record->is_active=$request->status;
        $record->division_code=$request->division_code;
        $record->name=$request->name;
        // dd($test);
        $record->save();
        return $this->return_output('flash', 'success', 'successfully added', 'admin/division-list', '200');

    }

    public function edit($id)
    {
        $record=Division::find($id);
        // $courses = Course::all();
        return view('admin.division.edit',compact('record'));
    }

    public function update($id,Request $request)
    {
        $record=Division::find($id);
        $record->name=$request->name;
       
        $record->is_active=$request->status;
        // dd($test);
        $record->save();
        return $this->return_output('flash', 'success', 'successfully updated', 'admin/division-list', '200');
    }

    // public function destroy($id)
    // {
    //     ConsumerCategory::destroy($id);
    //     return $this->return_output('flash', 'success', 'deleted successfully', 'admin/consumer-category-list', '200');
    // }
}
