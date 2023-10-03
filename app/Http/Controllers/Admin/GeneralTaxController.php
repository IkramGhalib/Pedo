<?php

namespace App\Http\Controllers\Admin;

use App\Models\GeneralTax;
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
            $list = GeneralTax::where('tax_name', 'LIKE', '%' . $search . '%')
                           ->paginate($paginate_count);
        }
        else {
            $list = GeneralTax::paginate($paginate_count);

        }
        // pr($list);


        // $test=Test::all();
        return view('admin.general_tax.index',compact('list'));
    }
    public function create()
    {
        // $courses=Division::all();
        return view('admin.general_tax.create');
    }

    public function store(Request $request)
    {

        $request->validate([
            'charges' => 'required|numeric',
            'name' => 'required|string',
            'status' => 'required',
           
        ]);     
        $record=new GeneralTax();
        $record->is_active=$request->status;
        $record->tax_percentage=$request->charges;
        $record->tax_name=$request->name;
        // dd($test);
        $record->save();
        return $this->return_output('flash', 'success', 'successfully added', 'admin/general-tax-list', '200');

    }
// edit function
    public function edit($id)
    {
        $record=GeneralTax::find($id);
        // $courses = Course::all();
        return view('admin.general_tax.edit',compact('record'));
    }

    public function update($id,Request $request)
    {
        $record=GeneralTax::find($id);
        $record->tax_name=$request->name;
        $record->tax_percentage=$request->charges;
       
        $record->is_active=$request->status;
        // dd($test);
        $record->save();
        return $this->return_output('flash', 'success', 'successfully updated', 'admin/general-tax-list', '200');
    }

    // public function destroy($id)
    // {
    //     ConsumerCategory::destroy($id);
    //     return $this->return_output('flash', 'success', 'deleted successfully', 'admin/consumer-category-list', '200');
    // }
}
