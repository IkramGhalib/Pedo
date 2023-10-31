<?php

namespace App\Http\Controllers\Admin;

use App\Models\GeneralTax;
use App\Models\TaxType;
use App\Models\ConsumerCategory;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use DB;
use App\Http\Controllers\Controller;

class GeneralTaxController extends Controller
{
    public function index(Request $request)
    {

        $paginate_count = 10;
        if($request->has('search')){
            $search = $request->input('search');
            $list = GeneralTax::with('bTaxType')->where('tax_name', 'LIKE', '%' . $search . '%')
                           ->paginate($paginate_count);
        }
        else {
            $list = GeneralTax::with('bTaxType')->paginate($paginate_count);

        }
        // dd($list);


        // $test=Test::all();
        return view('admin.general_tax.index',compact('list'));
    }
    public function create()
    {
        $record=TaxType::all();
        return view('admin.general_tax.create',compact('record'));
    }

    public function store(Request $request)
    {

        $request->validate([
            'charges' => 'required|numeric',
            'tax_title' => 'required|integer',
            'type' => 'required|integer',
            'status' => 'required',
            'applicable' => 'required|in:units,cost',
           
        ]); 
        $check_rec=GeneralTax::where(['con_cat_id'=>$request->tax_title,'tax_type_id'=>$request->type])->first();    
        if($check_rec)
        return back()->withError('Record Already Exits');
        // return $this->return_output('flash', 'error', 'Record Already Exits. Need Updation', 'admin/general-tax-list', '200');

        $record=new GeneralTax();
        $record->is_active=$request->status;
        $record->tax_percentage=$request->charges;
        $record->tax_type_id=$request->tax_title;
        $record->con_cat_id=$request->type;
        $record->applicable_on=$request->applicable;
        $record->code=$request->code;
        // dd($test);
        $record->save();
        return $this->return_output('flash', 'success', 'successfully added', 'admin/general-tax-list', '200');

    }
// edit function
    public function edit($id)
    {
        $record=GeneralTax::find($id);
        $consumer_category=ConsumerCategory::find($record->con_cat_id);
        // dd($consumer_category);
        $record_list=TaxType::all();
        // $courses = Course::all();
        return view('admin.general_tax.edit',compact('record','record_list','consumer_category'));
    }

    public function update($id,Request $request)
    {
        $request->validate([
            'charges' => 'required|numeric',
            'tax_title' => 'required|integer',
            'type' => 'required|integer',
            'status' => 'required',
            'applicable' => 'required|in:units,cost',
           
        ]); 
        $record=GeneralTax::find($id);
       
        $record->is_active=$request->status;
        $record->tax_percentage=$request->charges;
        $record->tax_type_id=$request->tax_title;
        $record->con_cat_id=$request->type;
        $record->applicable_on=$request->applicable;
       
        $record->is_active=$request->status;
        $record->code=$request->code;
        $record->save();
        return $this->return_output('flash', 'success', 'successfully updated', 'admin/general-tax-list', '200');
    }

    // public function destroy($id)
    // {
    //     ConsumerCategory::destroy($id);
    //     return $this->return_output('flash', 'success', 'deleted successfully', 'admin/consumer-category-list', '200');
    // }
}
