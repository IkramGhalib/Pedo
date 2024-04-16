<?php

namespace App\Http\Controllers\Admin;

// use App\Models\GeneralTax;
use App\Models\Bank;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use DB;
use App\Http\Controllers\Controller;

class BankController extends Controller
{
    public function index(Request $request)
    {

        $paginate_count = 10;
        if($request->has('search')){
            $search = $request->input('search');
            $list = Bank::where('title', 'LIKE', '%' . $search . '%')
                           ->paginate($paginate_count);
        }
        else {
            $list = Bank::paginate($paginate_count);

        }
        // pr($list);


        // $test=Test::all();
        return view('admin.bank.index',compact('list'));
    }
    public function create()
    {
        // $courses=Division::all();
        return view('admin.bank.create');
    }

    public function store(Request $request)
    {

        $request->validate([
            // 'charges' => 'required|numeric',
            'title' => 'required|string',
            'status' => 'required',
           
        ]);    

        $record=new Bank();
        $record->is_active=$request->status;
        // $record->charges=$request->charges;
        $record->title=$request->title;
        // dd($test);
        $record->save();
        return $this->return_output('flash', 'success', 'successfully added', 'admin/bank-list', '200');

    }
// edit function
    public function edit($id)
    {
        $record=Bank::find($id);
        // $courses = Course::all();
        return view('admin.bank.edit',compact('record'));
    }

    public function update($id,Request $request)
    {
        $record=Bank::find($id);
        // $record->charges=$request->charges;
        $record->title=$request->title;
       
        $record->is_active=$request->status;
        // dd($test);
        $record->save();
        return $this->return_output('flash', 'success', 'successfully updated', 'admin/bank-list', '200');
    }

    // public function destroy($id)
    // {
    //     ConsumerCategory::destroy($id);
    //     return $this->return_output('flash', 'success', 'deleted successfully', 'admin/consumer-category-list', '200');
    // }
}
