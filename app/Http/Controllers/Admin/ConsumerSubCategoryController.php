<?php

namespace App\Http\Controllers\Admin;

// use App\Models\Division;
use App\Models\ConsumerCategory;
use App\Models\ConsumerSubCategory;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use DB;
use App\Http\Controllers\Controller;

class ConsumerSubCategoryController extends Controller
{
    public function index(Request $request)
    {
        // pr('teitng');
        $paginate_count = 10;
        if($request->has('search')){
            $search = $request->input('search');
            $list = ConsumerSubCategory::where('name', 'LIKE', '%' . $search . '%')
                           ->paginate($paginate_count);
        }
        else {
            $list = ConsumerSubCategory::paginate($paginate_count);
        }

        // $test=Test::all();
        return view('admin.con_sub_category.index',compact('list'));
    }
    public function create()
    {
        // $courses=Division::all();
        return view('admin.con_sub_category.create');
    }

    public function store(Request $request)
    {
        // pr($request->all());
        $request->validate([
            'type' => 'required|integer',
            'name' => 'required|string',
            'unit_from' => 'required|integer',
            'unit_to' => 'required|integer',
            'months' => 'required|integer',
            'status' => 'required|integer',
           
        ]);     
        $record=new ConsumerSubCategory();
        $record->is_active=$request->status;
        $record->name=$request->name;
        $record->last_slab_apply=($request->last_slab_apply) ? $request->last_slab_apply : 0 ;
        $record->consumer_category_id=$request->type;

        $record->category_conditon_start=$request->unit_from;
        $record->category_conditon_end=$request->unit_to;
        $record->check_months=$request->months;
        // dd($test);
        $record->save();
        return $this->return_output('flash', 'success', 'successfully added', 'admin/cons-sub-category-list', '200');

    }

    public function edit($id)
    {
        $record=ConsumerSubCategory::find($id);
        $parant_record=ConsumerCategory::find($record->consumer_category_id);
        // pr($record);

        // $courses = Course::all();
        return view('admin.con_sub_category.edit',compact('record','parant_record'));
    }

    public function update($id,Request $request)
    {
        $record=ConsumerSubCategory::find($id);
        $record->is_active=$request->status;
        $record->name=$request->name;
        $record->consumer_category_id=$request->type;
        $record->last_slab_apply=($request->last_slab_apply) ? $request->last_slab_apply : 0 ;

        $record->category_conditon_start=$request->unit_from;
        $record->category_conditon_end=$request->unit_to;
        $record->check_months=$request->months;
        // dd($test);
        $record->save();
        return $this->return_output('flash', 'success', 'successfully updated', 'admin/cons-sub-category-list', '200');
    }

    // public function destroy($id)
    // {
    //     ConsumerCategory::destroy($id);
    //     return $this->return_output('flash', 'success', 'deleted successfully', 'admin/consumer-category-list', '200');
    // }
}
