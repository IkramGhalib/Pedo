<?php

namespace App\Http\Controllers\Admin;

use App\Models\Division;
use App\Models\SubDivision;
use App\Models\Feeder;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use DB;
use App\Http\Controllers\Controller;

class FeederController extends Controller
{
    public function index(Request $request)
    {

        $paginate_count = 10;
        if($request->has('search')){
            $search = $request->input('search');
            $list = Feeder::where('name', 'LIKE', '%' . $search . '%')
                           ->paginate($paginate_count);
        }
        else {
            $list = Feeder::paginate($paginate_count);
        }

        // $test=Test::all();
        return view('admin.feeder.index',compact('list'));
    }
    public function create()
    {
        // $courses=Division::all();
        return view('admin.feeder.create');
    }

    public function store(Request $request)
    {

        $request->validate([
            'name' => 'required|string',
            'feeder_code' => 'required|string',
            'sub_division' => 'required|string',
            'status' => 'required',
           
        ]);     
        $record=new Feeder();
        $record->is_active=$request->status;
        $record->feeder_code=$request->feeder_code;
        $record->sub_division_id=$request->sub_division;
        $record->name=$request->name;
        // dd($test);
        $record->save();
        return $this->return_output('flash', 'success', 'successfully added', 'admin/feeder-list', '200');

    }

    public function edit($id)
    {
        $record=SubDivision::find($id);
        dd($record);
        $parant_record=Division::find($record->division_id);

        // $courses = Course::all();
        return view('admin.feeder.edit',compact('record','parant_record'));
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
