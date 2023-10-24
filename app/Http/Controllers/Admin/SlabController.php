<?php

namespace App\Http\Controllers\Admin;

// use App\Models\Division;
// use App\Models\SubDivision;
use App\Models\ConsumerSubCategory;
use App\Models\ConsumerCategory;
use App\Models\Slab;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use DB;
use App\Http\Controllers\Controller;

class SlabController extends Controller
{
    public function index(Request $request)
    {

        $paginate_count = 10;
        if($request->has('search')){
            $search = $request->input('search');
            $list = Slab::where('name', 'LIKE', '%' . $search . '%')
                           ->paginate($paginate_count);
        }
        else {
            $list = Slab::paginate($paginate_count);
        }

        // $test=Test::all();
        return view('admin.slab.index',compact('list'));
    }
    public function create()
    {
        // $courses=Division::all();
        return view('admin.slab.create');
    }

    public function store(Request $request)
    {
        // pr($request->all());

        $request->validate([
            // 'name' => 'required|string',
            'slab_start_unit' => 'required|integer',
            'slab_end_unit' => 'required|integer',
            'sub_type' => 'required|integer',
            'type' => 'required|integer',
            'status' => 'required',
            'price' => 'required|numeric',
           
        ]);     
        $record=new Slab();
        $record->is_active=$request->status;

        $record->slab_start_unit=$request->slab_start_unit;
        $record->slab_end_unit=$request->slab_end_unit;
        $record->total_units=$request->slab_end_unit-$request->slab_start_unit+1;

        $record->sub_cat_id=$request->sub_type;
        $record->charges=$request->price;
        // dd($test);
        $record->save();
        return $this->return_output('flash', 'success', 'successfully added', 'admin/slab-list', '200');

    }

    public function edit($id)
    {
        $record=Slab::find($id);
        $parant_record_l2=ConsumerSubCategory::find($record->sub_cat_id);
        $parant_record_l1=ConsumerCategory::find($record->sub_cat_id);

        // $courses = Course::all();
        return view('admin.slab.edit',compact('record','parant_record_l1','parant_record_l2'));
    }

    public function update($id,Request $request)
    {
        $request->validate([
            // 'name' => 'required|string',
            'slab_start_unit' => 'required|integer',
            'slab_end_unit' => 'required|integer',
            'sub_type' => 'required|integer',
            'type' => 'required|integer',
            'status' => 'required',
            'price' => 'required|numeric',
           
        ]);    

        $record=Slab::find($id);
        $record->sub_cat_id=$request->sub_type;
        $record->slab_start_unit=$request->slab_start_unit;
        $record->slab_end_unit=$request->slab_end_unit;
        $record->total_units=$request->slab_end_unit-$request->slab_start_unit+1;
        $record->charges=$request->price;
        $record->is_active=$request->status;
        $record->save();
        return $this->return_output('flash', 'success', 'successfully updated', 'admin/slab-list', '200');
    }

    // public function destroy($id)
    // {
    //     ConsumerCategory::destroy($id);
    //     return $this->return_output('flash', 'success', 'deleted successfully', 'admin/consumer-category-list', '200');
    // }
}
