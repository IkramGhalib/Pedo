<?php

namespace App\Http\Controllers\Admin;

// use App\Models\GeneralTax;
use App\Models\ChargesType;
use App\Models\ConsumerSubCategory;
use App\Models\SubCategoryCharges;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use DB;
use App\Http\Controllers\Controller;

class ChargesController extends Controller
{
    public function index(Request $request)
    {

        $paginate_count = 10;
        if($request->has('search')){
            $search = $request->input('search');
            $list = SubCategoryCharges::where('title', 'LIKE', '%' . $search . '%')
                           ->paginate($paginate_count);
        }
        else {
            $list = SubCategoryCharges::with('bChargesType','bConSubCat')->paginate($paginate_count);

        }
        // dd($list);


        // $test=Test::all();
        return view('admin.sub_category_charges.index',compact('list'));
    }
    public function create()
    {
        $charges=ChargesType::where('is_active',1)->get();
        $types=ConsumerSubCategory::where('is_active',1)->get();
        return view('admin.sub_category_charges.create',compact('charges','types'));
    }

    public function store(Request $request)
    {
        // dd($request->all());
        $request->validate([
            'charges' => 'required|numeric',
            'charges_type' => 'required',
            'consumer_type' => 'required',
            'status' => 'required',
            'applicable' => 'required|in:units,charges',
           
        ]);    
        $record=SubCategoryCharges::where('charges_type_id',$request->charges_type)->where('sub_cat_id',$request->consumer_type)->first();
        
        if($record)
        {
            $record=SubCategoryCharges::where('scc_id ',$record->scc_id )->update(['is_active'=>$request->status,
                'charges_type_id'=>$request->charges_type,'sub_cat_id'=>$request->consumer_type,'charges'=>$request->charges]);
                return $this->return_output('flash', 'success', 'successfully Updated', 'admin/charges-list', '200');
        }
        else
        {

            $record=new SubCategoryCharges();
            $record->is_active=$request->status;
            $record->charges_type_id=$request->charges_type;
            $record->sub_cat_id=$request->consumer_type;
            $record->charges=$request->charges;
            $record->applicable_on=$request->applicable;
            // dd($test);
            $record->save();
        }
        return $this->return_output('flash', 'success', 'successfully added', 'admin/charges-list', '200');

    }
// edit function
    public function edit($id)
    {
        $charges=ChargesType::where('is_active',1)->get();
        $types=ConsumerSubCategory::where('is_active',1)->get();

        $record=SubCategoryCharges::find($id);
        // $courses = Course::all();
        return view('admin.sub_category_charges.edit',compact('record','charges','types'));
    }

    public function update($id,Request $request)
    {
        $request->validate([
            'charges' => 'required|numeric',
            'charges_type' => 'required',
            'consumer_type' => 'required',
            'status' => 'required',
            'applicable' => 'required|in:units,charges',
           
        ]);    
        $record=SubCategoryCharges::find($id);
        $record->is_active=$request->status;
        $record->charges_type_id=$request->charges_type;
        $record->sub_cat_id=$request->consumer_type;
        $record->charges=$request->charges;
        $record->applicable_on=$request->applicable;
        // dd($test);
        $record->save();
        return $this->return_output('flash', 'success', 'successfully updated', 'admin/charges-list', '200');
    }

    // public function destroy($id)
    // {
    //     ConsumerCategory::destroy($id);
    //     return $this->return_output('flash', 'success', 'deleted successfully', 'admin/consumer-category-list', '200');
    // }
}
