<?php

namespace App\Http\Controllers\Api;

use Exception;
use App\Models\User;
// use App\Models\RoleUser;
// use App\Models\Role;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
// use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
// use Illuminate\Support\Facades\Mail;
// use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Validator;
use App\Http\Controllers\Controller;
// use App\Models\Invoice;
// use App\Models\InvoiceDetail;
// use App\Models\Course;
use App\Models\Reading;
// use App\Models\Role;
use Illuminate\Validation\Rule;

class ApiReadingController extends Controller
{
    public function get_ref_no_list(Request $request)
    {
        $list=DB::table('consumer_meters')->select('ref_no')->groupBy('ref_no')->get();
        if($list)
        return  success('Record Found',  $list, 200);
        else
        return  error('Record Not Found',  $list, 404);

    }    
    public function reading_save(Request $request)
    {
        

        $validator = Validator::make($request->all(), [
            'ref_no' => 'required',
            'month_year' => 'required',
            'offpeak' => 'required_without:peak',
            'off_peak_image' =>Rule::when($request->offpeak != null, 'required'),
            'peak_image' =>Rule::when($request->peak != null, 'required')
        ]);
        
        if ($validator->fails()) return error('Validation Error.', $validator->errors(), 422);
        
        // pr( $validator->errors());



       $mont_year_array=explode('-',$request->month_year);
        $reading_record=Reading::where('ref_no',$request->ref_no)->where('year',$mont_year_array[0])->where('month',$mont_year_array[1])->first();
       if($reading_record)
       {
        return  error('Record Already Exits', [], 422);
       }else
       {
                $record=new Reading();
                $record->ref_no=$request->ref_no;
                $record->year=$mont_year_array[0];
                $record->month=$mont_year_array[1];
                $record->offpeak=$request->offpeak;
                $record->peak=$request->peak;
                if($request->hasFile('peak_image'))
                    {
                        $food_image = time().'p'. '.' . $request->peak_image->getClientOriginalExtension();
                        $request->peak_image->move(public_path('reading/'), $food_image);
                        $record->pkimage=$food_image;
                    }

                if($request->hasFile('off_peak_image'))
                    {
                        $food_image = time().'op'. '.' . $request->off_peak_image->getClientOriginalExtension();
                        $request->off_peak_image->move(public_path('reading/'), $food_image);
                        $record->offpkimage=$food_image;
                    }
                $record->save();
                return  success('Action Completed Successfully',  $record, 200);
                
       }
    }


        

    









    // when Payment Gateway want to retrive invoice ---------------------------------------
}
