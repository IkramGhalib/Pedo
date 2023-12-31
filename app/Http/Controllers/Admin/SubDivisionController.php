<?php

namespace App\Http\Controllers\Admin;

use App\Models\Division;
use App\Models\SubDivision;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use DB;
use App\Http\Controllers\Controller;

class SubDivisionController extends Controller
{
    public function index(Request $request)
    {

        $paginate_count = 10;
        if($request->has('search')){
            $search = $request->input('search');
            $list = SubDivision::where('name', 'LIKE', '%' . $search . '%')
                           ->paginate($paginate_count);
        }
        else {
            $list = SubDivision::paginate($paginate_count);
        }

        // $test=Test::all();
        return view('admin.sub_division.index',compact('list'));
    }
    public function create()
    {
        // $courses=Division::all();
        return view('admin.sub_division.create');
    }

    public function store(Request $request)
    {

        $request->validate([
            'name' => 'required|string',
            'sub_division_code' => 'required|string',
            'division' => 'required|string',
            'status' => 'required',
           
        ]);     
        $record=new SubDivision();
        $record->is_active=$request->status;
        $record->sub_division_code=$request->sub_division_code;
        $record->division_id=$request->division;
        $record->name=$request->name;
        // dd($test);
        $record->save();
        return $this->return_output('flash', 'success', 'successfully added', 'admin/sub-division-list', '200');

    }

    public function edit($id)
    {
        $record=SubDivision::find($id);
        $parant_record=Division::find($record->division_id);

        // $courses = Course::all();
        return view('admin.sub_division.edit',compact('record','parant_record'));
    }

    public function update($id,Request $request)
    {
        $record=SubDivision::find($id);
        $record->name=$request->name;
        $record->sub_division_code=$request->sub_division_code;
       
        $record->is_active=$request->status;
        // dd($test);
        $record->save();
        return $this->return_output('flash', 'success', 'successfully updated', 'admin/sub-division-list', '200');
    }

    // public function destroy($id)
    // {
    //     ConsumerCategory::destroy($id);
    //     return $this->return_output('flash', 'success', 'deleted successfully', 'admin/consumer-category-list', '200');
    // }
}
