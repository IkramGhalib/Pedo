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
    public function get_list_for_reading(Request $request)
    {

        $groups=DB::table('meter_reader_groups')->select('ref_start','ref_end')->where('user_id',auth()->user()->id)->get();
        if($groups)
        {
            foreach($groups as $key => $grow)
            {

                    $list=DB::table('consumer_meters')->select('ref_no','previous_reading_off_peak as pre_reading','cm_id','meter_no');
                    $list= $list->where('ref_no','>=',$grow->ref_start)->where('ref_no','<=',$grow->ref_end);
                    $list= $list->groupBy('ref_no')->get();
                    if($list){
                        $grow->list=$list;
                    }
                    else
                    {
                        $grow->list=[];
                    }

            }
            
        }
        if($groups)
                return  success('Record Found',  $groups, 200);
            else
                return  error('Record Not Found',  $groups, 404);
    
    }    

    public function get_month(Request $request)
    {
        $last_date=DB::table('reading_approve')->orderBy('id','desc')->first();
        $data=[];
        if($last_date)
        {
            $data['month']=date('Y-m',strtotime($last_date->month_year.'+1 month'));
        }
        else
        {
            $data['month']='not-set';
        }

        // $list=DB::table('consumer_meters')->select('ref_no')->groupBy('ref_no')->get();
        if($data)
        return  success('Record Found',  $data, 200);
        else
        return  error('Record Not Found',  $data, 404);

    }    
    public function reading_save(Request $request)
    {
        

        $validator = Validator::make($request->all(), [
            'cm_id' => 'required',
            'month_year' => 'required',
            'offpeak' => 'required_without|integer',
            // 'status' => 
            // 'offpeak' => 'required_without:peak',
            // 'off_peak_image' =>Rule::when($request->offpeak != null, 'required'),
            // 'peak_image' =>Rule::when($request->peak != null, 'required')
        ]);
        
        if ($validator->fails()) return error('Validation Error.', $validator->errors(), 422);

    //    $mont_year_array=explode('-',$request->month_year);
        $reading_record=Reading::where('cm_id',$request->cm_id)->where('month_year',$request->month_year.'-01')->first();
       if($reading_record)
       {
        return  error('Record Already Exits', [], 422);
       }else
       {
                $rec=DB::table('consumer_meters')->where('cm_id',$request->cm_id)->first(); 
                // pr($rec);
                if($rec->previous_reading_off_peak>$request->offpeak)
                {
                    return  error('Current Reading can not less from previous reading', [], 422);
                }
                else
                {

                
                        $record=new Reading();
                        $record->month_year=$request->month_year.'-01';
                        $record->offpeak=$request->offpeak;
                        $record->cm_id=$request->cm_id;
                        $record->offpeak_units=$request->offpeak-$rec->previous_reading_off_peak;
                        $record->offpeak_prev=$rec->previous_reading_off_peak;
                        $record->peak=$request->peak;
                        $record->status=$request->status;
                        // $record->added_date=date('Y-m-d');
                        $record->add_by=auth()->user()->id;
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
    }


        

    









    // when Payment Gateway want to retrive invoice ---------------------------------------
}
