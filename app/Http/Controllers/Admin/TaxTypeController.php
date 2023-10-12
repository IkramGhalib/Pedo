<?php

namespace App\Http\Controllers\Admin;

// use App\Models\GeneralTax;
use App\Models\TaxType;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use DB;
use App\Http\Controllers\Controller;

class TaxTypeController extends Controller
{
    public function index(Request $request)
    {

        $paginate_count = 10;
        if($request->has('search')){
            $search = $request->input('search');
            $list = TaxType::where('title', 'LIKE', '%' . $search . '%')
                           ->paginate($paginate_count);
        }
        else {
            $list = TaxType::paginate($paginate_count);

        }
        // pr($list);


        // $test=Test::all();
        return view('admin.tax_types.index',compact('list'));
    }
    public function create()
    {
        // $courses=Division::all();
        return view('admin.tax_types.create');
    }

    public function store(Request $request)
    {

        $request->validate([
            // 'charges' => 'required|numeric',
            'title' => 'required|string',
            'status' => 'required',
           
        ]);    

        $record=new TaxType();
        $record->is_active=$request->status;
        // $record->charges=$request->charges;
        $record->title=$request->title;
        // dd($test);
        $record->save();
        return $this->return_output('flash', 'success', 'successfully added', 'admin/tax-type-list', '200');

    }
// edit function
    public function edit($id)
    {
        $record=TaxType::find($id);
        // $courses = Course::all();
        return view('admin.tax_types.edit',compact('record'));
    }

    public function update($id,Request $request)
    {
        $record=TaxType::find($id);
        // $record->charges=$request->charges;
        $record->title=$request->title;
       
        $record->is_active=$request->status;
        // dd($test);
        $record->save();
        return $this->return_output('flash', 'success', 'successfully updated', 'admin/tax-type-list', '200');
    }

    // public function destroy($id)
    // {
    //     ConsumerCategory::destroy($id);
    //     return $this->return_output('flash', 'success', 'deleted successfully', 'admin/consumer-category-list', '200');
    // }
}
