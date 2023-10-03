<?php

namespace App\Http\Controllers\Admin;

// use App\Models\GeneralTax;
use App\Models\Charges;
use App\Models\ConsumerCategory;
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
            $list = Charges::where('title', 'LIKE', '%' . $search . '%')
                           ->paginate($paginate_count);
        }
        else {
            $list = Charges::paginate($paginate_count);

        }
        // pr($list);


        // $test=Test::all();
        return view('admin.charges.index',compact('list'));
    }
    public function create()
    {
        $charges=Charges::where('is_active',1)->get();
        $types=ConsumerCategory::where('is_active',1)->get();
        return view('admin.charges.create',compact('charges','types'));
    }

    public function store(Request $request)
    {
        // dd($request->all());
        $request->validate([
            'charges' => 'required|numeric',
            'charges_type' => 'required',
            'consumer_type' => 'required',
            'status' => 'required',
           
        ]);    
        $record=SubCategoryCharges::where('charges_id',$request->charges_type)->where('sub_cat_id',$request->consumer_type)->first();
        
        if($record)
        {
            $record=SubCategoryCharges::where('scc_id ',$record->scc_id )->update(['is_active'=>$request->status,
                'charges_id'=>$request->charges_type,'sub_cat_id'=>$request->consumer_type,'charges'=>$request->charges]);

        }
        else
        {

            $record=new SubCategoryCharges();
            $record->is_active=$request->status;
            $record->charges_id=$request->charges_type;
            $record->sub_cat_id=$request->consumer_type;
            $record->charges=$request->charges;
            // dd($test);
            $record->save();
        }
        return $this->return_output('flash', 'success', 'successfully added', 'admin/charges-list', '200');

    }
// edit function
    public function edit($id)
    {
        $record=Charges::find($id);
        // $courses = Course::all();
        return view('admin.charges.edit',compact('record'));
    }

    public function update($id,Request $request)
    {
        $record=Charges::find($id);
        $record->charges=$request->charges;
        $record->title=$request->title;
       
        $record->is_active=$request->status;
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
