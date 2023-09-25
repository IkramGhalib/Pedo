<?php

namespace App\Http\Controllers\Admin;

use App\Models\GeneralTax;
use App\Models\MeterAdd;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use DB;
use App\Http\Controllers\Controller;

class MeterController extends Controller
{
    public function index(Request $request)
    {

        $paginate_count = 10;
        if($request->has('search')){
            $search = $request->input('search');
            $list = MeterAdd::where('meter_no', 'LIKE', '%' . $search . '%')
                           ->paginate($paginate_count);
        }
        else {
            $list = MeterAdd::paginate($paginate_count);

        }
        // pr($list);


        // $test=Test::all();
        return view('admin.meter_stock.index',compact('list'));
    }
    public function create()
    {
        // $courses=Division::all();
        return view('admin.meter_stock.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            // 'tax_percent' => 'required|integer',
            'meter' => 'required|string',
            'status' => 'required',   
        ]);     
        $record=new MeterAdd();
        $record->status=$request->status;
        // $record->tax_percentage=$request->tax_percent;
        $record->meter_no=$request->meter;
        // dd($record);
        $record->save();
        return $this->return_output('flash', 'success', 'successfully added', 'admin/meter-list', '200');

    }
// edit function
    public function edit($id)
    {
        $record=MeterAdd::find($id);
        // $courses = Course::all();
        return view('admin.meter.edit',compact('record'));
    }

    public function update($id,Request $request)
    {
        $record=new MeterAdd();
        $record->status=$request->status;
        // $record->tax_percentage=$request->tax_percent;
        $record->meter_no=$request->meter;;
        // dd($test);
        $record->save();
        return $this->return_output('flash', 'success', 'successfully updated', 'admin/meter.list', '200');
    }

    // public function destroy($id)
    // {
    //     ConsumerCategory::destroy($id);
    //     return $this->return_output('flash', 'success', 'deleted successfully', 'admin/consumer-category-list', '200');
    // }
}
