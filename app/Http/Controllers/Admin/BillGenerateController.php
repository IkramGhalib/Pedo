<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Models\User;
// use App\Models\Course;
// use App\Models\Category;
use App\Models\Role;
use App\Models\Config;
// use App\Models\Consumer;
use App\Models\ConsumerSubCategory;
// use App\Models\Division;
use App\Models\SubCategoryCharges;
use App\Models\GeneralTax;
// use App\Models\SubDivision;
use App\Models\BillGenerate;
use App\Models\ConsumerBill;
use App\Models\ConsumerLedger;
use App\Models\Adjustment;
use App\Models\Reading;
use App\Models\ConsumerMeter;
// use App\Models\Feeder;
// use App\Models\Credit;
// use App\Models\WithdrawRequest;
use Illuminate\Support\Facades\Validator;
use DB;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Storage;
use Image;
// use SiteHelpers;
// use Crypt;
use URL;
use Session;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Auth;
// use Controller;
use App\Http\Controllers\Controller;
use Illuminate\Validation\Rule;


// use App\Mail\ContactInstructor;

class BillGenerateController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        
    }

    public function show()
    {
        $paginate_count = 8;
        
        $list = DB::table('bill_generates')->select('users.first_name','bill_generates.*')->join('users','users.id','=','generated_by')->orderBy('bill_generates.id','DESC')->paginate($paginate_count);
        // dd($list);
        return view('admin.bill_generate.index', compact('list'));
    }

    public function adjustment_show()
    {
        $paginate_count = 12;
        $list = Adjustment::with('bConsumerMeter')->paginate($paginate_count);
        // dd($list);
        return view('admin.bill_generate.adjustment_index', compact('list'));
    }
    public function form()
    {
        $last_date=DB::table('bill_generates')->where('status','generated')->orderBy('id','desc')->first();
        return view('admin.bill_generate.form',compact('last_date'));
    }

    public function adjustment_form()
    {
        $last_date=DB::table('bill_generates')->orderBy('id','desc')->first();
        return view('admin.bill_generate.adjustment_form',compact('last_date'));
    }
    // function find_consumer_category_slab_charges($record)
    // {
    //         $current_cons_type= ConsumerMeter::with('bConsumer.bConsumerCategory.hMConSubCategory.hMSlabs')->where('ref_no',$record->ref_no)
    //         ->first();

    //         $data=$current_cons_type->bConsumer->bConsumerCategory->hMConSubCategory;
    //         $data_with_slab=$data->where('category_conditon_start','<=',$record->offpeak_units) ->where('category_conditon_end','>=',$record->offpeak_units)->first();

    //         $charges=SubCategoryCharges::with('bChargesType')->where('sub_cat_id',$data_with_slab->id)->get();
    //         $charges_data=[];
    //         if($charges)
    //         {
    //             foreach ($charges as $ky => $chgrow) {
    //                 $charges_data[]=['charges'=>$chgrow->charges,'calculated_charges'=>$record->offpeak_units*$chgrow->charges,'charges_type'=>$chgrow->bChargesType->title];
    //             }
    //         }

    //         $new_data = array();
    //         $units=$record->offpeak_units;
    //         $slab_total_units=0;
    //         $total_electricity_charges=0;
    //         $previou_end_unit=0;
    //         foreach ($data_with_slab->hMSlabs as $key => $value) {
    //             if($key==0)
    //             {
    //                 $slab_total_units=$value->slab_end_unit;
    //                 $previou_end_unit=$value->slab_end_unit;
    //             }
    //             else
    //             {
    //                 $slab_total_units=$value->slab_end_unit-$previou_end_unit;
    //                 $previou_end_unit=$value->slab_end_unit;
    //             }
    //                 if( $units >= $slab_total_units)
    //                 {
    //                     $units=$units-$slab_total_units;
    //                     $total_electricity_charges+=($slab_total_units*$value->charges);
    //                     $new_data[]=['units'=>$slab_total_units,'charges'=>$value->charges];
    //                 }
    //                 else
    //                 {
    //                     $new_data[]=['units'=>$units,'charges'=>$value->charges];
    //                     $total_electricity_charges+=($units*$value->charges);
    //                     break;
    //                 }
    //         }
    //         $bill_data['total_electricity_charges']=$total_electricity_charges;
    //         $bill_data['slab_wise_charges']=$new_data;
    //         $bill_data['charges']=$charges_data;
    //         return $bill_data;
    // }

    function find_consumer_category_slab_charges_backup_before_month_dynamic($record)
    {
       
            $units=$record->offpeak_units;
            
            $c_bill_data=ConsumerBill::where('cm_id',$record->bConsumerMeter->cm_id)->limit(12)->orderBy('id','desc')->get();
            //  dd($c_bill_data);
         
            $current_cons_type= ConsumerMeter::with('bConsumer.bConsumerCategory.hMConSubCategory.hMSlabs')->where('ref_no',$record->bConsumerMeter->ref_no)
            ->first();
            // dd($current_cons_type);
            
            // dd($current_cons_type);
            
            $data=$current_cons_type->bConsumer->bConsumerCategory->hMConSubCategory;
         
            // for getting consumer type logic start here  -----------------------------------------------------
            $count_record=$c_bill_data->count(); // get number of bills generated
            // dd($count_record);
            if($count_record < 7) // if new user and under 6 months
            {
                $data_with_slab=$data->where('priority',1)->first();
               
               
            }
            else
            { 
                if($data->count()==1)// for those category who have only one category like commercial 
                {
                    $data_with_slab=$data->where('priority',1)->first();
                }
                else // if not commercial
                {
                        // if consumer have more then 6 months bills
                        $c_bill_all_record= collect($c_bill_data);
                        // $c_bill_6month_record=$c_bill_all_record->limit(6)->get();
                        $c_bill_6month_record=array_slice($c_bill_all_record->toArray(), 0, 5);

                        $check_6month_max_units=collect($c_bill_6month_record)->max('offpeak_units');
                        if($check_6month_max_units >200) // un-protected consumer
                        $data_with_slab=$data->where('priority',1)->first();
                        elseif($c_bill_all_record->max('offpeak_units') <=100 &&   $count_record==12) // lifeline consumer
                        $data_with_slab=$data->where('priority',3)->first();
                        else  // protected
                        $data_with_slab=$data->where('priority',2)->first();

                        // if($c_bill_all_record->max('offpeak_units')<=100 && $count_record >= 12) // life line consumer
                        //     $data_with_slab=$data->where('priority',3)->first();
                        // elseif($check_6month_max_units >=101 && $check_6month_max_units<=200 ) // protected consumer
                        //     $data_with_slab=$data->where('priority',2)->first();
                        // else  // un-protected
                        //     $data_with_slab=$data->where('priority',1)->first();
                }    
            }
            //find catgory
            // $data_with_slab=$data->where('category_conditon_start','<=',$record->offpeak_units) ->where('category_conditon_end','>=',$record->offpeak_units)->first();
            // if($record->ref_no=='1682261')
            // dd($data_with_slab);
            // dd($data_with_slab);
            // if($record->ref_no=='42261812')
            // dd($data_with_slab);
            $charges=SubCategoryCharges::with('bChargesType')->where('sub_cat_id',$data_with_slab->id)->get();
           
            // dd($charges);
            $new_data = array();
            $total_electricity_charges=0;
            // if last slab is not applicable category
            if($data_with_slab->last_slab_apply==0)
            {
                // $new_data = array();
                // $units=$record->offpeak_units;
                $slab_total_units=0;
                // $total_electricity_charges=0;
                $previou_end_unit=0;
                foreach ($data_with_slab->hMSlabs as $key => $value) {
                    if($key==0)
                    {
                        $slab_total_units=$value->slab_end_unit;
                        $previou_end_unit=$value->slab_end_unit;
                    }
                    else
                    {
                        $slab_total_units=$value->slab_end_unit-$previou_end_unit;
                        $previou_end_unit=$value->slab_end_unit;
                    }
                        if( $units >= $slab_total_units)
                        {
                            $units=$units-$slab_total_units;
                            $total_electricity_charges+=($slab_total_units*$value->charges);
                            $new_data[]=['units'=>$slab_total_units,'charges'=>$value->charges];
                        }
                        else
                        {
                            $new_data[]=['units'=>$units,'charges'=>$value->charges];
                            $total_electricity_charges+=($units*$value->charges);
                            break;
                        }
                }
            }
            else // if last slab is applicable category
            {

            
                // $slab_total_units=0;
                // $previou_end_unit=0;
                foreach ($data_with_slab->hMSlabs as $key => $value) {
                        if( $units >= $value->slab_start_unit && $units <= $value->slab_end_unit )
                        {
                            // $units=$units-$slab_total_units;
                            $total_electricity_charges+=($units*$value->charges);
                            $new_data[]=['units'=>$units,'charges'=>$value->charges];
                        }
                        
                }
            }
            $bill_data['total_electricity_charges']=round($total_electricity_charges,2);
            $bill_data['sub_cat_finded_id']=$data_with_slab->id;
            $bill_data['slab_wise_charges']=$new_data;

            $charges_data=[];
            $total_charges_data=0;
            if($charges) // find charges
            {
                foreach ($charges as $ky => $chgrow) {
                    if($chgrow->code==='FPA')
                    {
                        // get 2 months prevous reading
                        $record->month_year;
                        $previous_reading=DB::table('meter_readings')->where('cm_id',$record->bConsumerMeter->cm_id)->where('month_year',(date('y-m-d ',strtotime($record->month_year.' -2 month' ))))->first();
                        if($previous_reading)
                        {
                                $charges_data[]=['code'=>$chgrow->code,'charges'=>$chgrow->charges,'calculated_charges'=>round($previous_reading->offpeak_units*($chgrow->charges),2),'charges_type'=>$chgrow->bChargesType->title];
                                $total_charges_data+=$previous_reading->offpeak_units*($chgrow->charges);
                            
                        }
                    }
                    else
                    {
                        if($chgrow->applicable_on==='units')
                            {
                                $charges_data[]=['code'=>$chgrow->code,'charges'=>$chgrow->charges,'calculated_charges'=>round($record->offpeak_units*($chgrow->charges),2),'charges_type'=>$chgrow->bChargesType->title];
                                $total_charges_data+=$record->offpeak_units*($chgrow->charges);
                            }  
                            else
                            {
                                $charges_data[]=['code'=>$chgrow->code,'charges'=>$chgrow->charges,'calculated_charges'=>round($total_electricity_charges*($chgrow->charges/100),2),'charges_type'=>$chgrow->bChargesType->title];
                                $total_charges_data+=$total_electricity_charges*($chgrow->charges/100);
                            }
                    }
                }
            }

            // dd($charges_data);


            $bill_data['charges']=$charges_data;
            $bill_data['total_charges_data']=round($total_charges_data,2);
            $bill_data['minimum_charges_limit']=round($total_charges_data,2);


             // if bill is less then current consumer type minimum bill limit  then apply minimum limit 
            //  if($finded_cateogry_slab_chareges['total_electricity_charges']<= 75 )
            //  {
               $check_minimum_bill= DB::table('consumers')
                     ->join('options','options.ref_id','=','consumers.consumer_category_id')
                     ->where('consumers.id',$record->bConsumerMeter->consumer_id)->first();
                 if($check_minimum_bill)
                 {
                     if($total_electricity_charges<=(float)$check_minimum_bill->option_value)
                     {
                        $bill_data['total_electricity_charges']=(float)$check_minimum_bill->option_value;
                      
                        $bill_data['minimum_charges_limit']=(float)$check_minimum_bill->option_value;
                        $bill_data['slab_wise_charges']=[];
                     }

                 }
            //  }

            $bill_data['tarrif_code']=$current_cons_type->bConsumer->bConsumerCategory->tarrif_code;
            
            return $bill_data;
    }
    function find_consumer_category_slab_charges($record)
    {
       
            $units=$record->offpeak_units;
            
            $c_bill_data=ConsumerBill::where('cm_id',$record->bConsumerMeter->cm_id)->limit(12)->orderBy('id','desc')->get();
            //  dd($c_bill_data);
         
            $current_cons_type= ConsumerMeter::with('bConsumer.bConsumerCategory.hMConSubCategory.hMSlabs')->where('ref_no',$record->bConsumerMeter->ref_no)
            ->first();
            // dd($current_cons_type);
            
            // dd($current_cons_type);
            
            $data=$current_cons_type->bConsumer->bConsumerCategory->hMConSubCategory;
         
            // for getting consumer type logic start here  -----------------------------------------------------
            $count_record=$c_bill_data->count(); // get number of bills generated
            // dd($count_record);

            // ------------------This code is commented for removel of month checking in slab . need to uncomment after 6months------------------------
            // if($count_record < 7) // if new user and under 6 months
            // {
            //     $data_with_slab=$data->where('priority',1)->first();
               
               
            // }
            // else
            // { 
            //     if($data->count()==1)// for those category who have only one category like commercial 
            //     {
            //         $data_with_slab=$data->where('priority',1)->first();
            //     }
            //     else // if not commercial
            //     {
            //             // if consumer have more then 6 months bills
            //             $c_bill_all_record= collect($c_bill_data);
            //             // $c_bill_6month_record=$c_bill_all_record->limit(6)->get();
            //             $c_bill_6month_record=array_slice($c_bill_all_record->toArray(), 0, 5);

            //             $check_6month_max_units=collect($c_bill_6month_record)->max('offpeak_units');
            //             if($check_6month_max_units >200) // un-protected consumer
            //             $data_with_slab=$data->where('priority',1)->first();
            //             elseif($c_bill_all_record->max('offpeak_units') <=100 &&   $count_record==12) // lifeline consumer
            //             $data_with_slab=$data->where('priority',3)->first();
            //             else  // protected
            //             $data_with_slab=$data->where('priority',2)->first();

            //             // if($c_bill_all_record->max('offpeak_units')<=100 && $count_record >= 12) // life line consumer
            //             //     $data_with_slab=$data->where('priority',3)->first();
            //             // elseif($check_6month_max_units >=101 && $check_6month_max_units<=200 ) // protected consumer
            //             //     $data_with_slab=$data->where('priority',2)->first();
            //             // else  // un-protected
            //             //     $data_with_slab=$data->where('priority',1)->first();
            //     }    
            // }

            // --------------------------------------------------------------------------------------------------------------------------------------
            //find catgory
            $data_with_slab=$data->where('category_conditon_start','<=',$record->offpeak_units) ->where('category_conditon_end','>=',$record->offpeak_units)->first();
            // --------------------------------------------------------------------------------------------------------------------------------------
            // if($record->ref_no=='1682261')
            // dd($data_with_slab);
            // dd($data_with_slab);
            // if($record->ref_no=='42261812')
            // dd($data_with_slab);
            $charges=SubCategoryCharges::with('bChargesType')->where('sub_cat_id',$data_with_slab->id)->get();
           
            // dd($charges);
            $new_data = array();
            $total_electricity_charges=0;
            // if last slab is not applicable category
            if($data_with_slab->last_slab_apply==0)
            {
                // $new_data = array();
                // $units=$record->offpeak_units;
                $slab_total_units=0;
                // $total_electricity_charges=0;
                $previou_end_unit=0;
                foreach ($data_with_slab->hMSlabs as $key => $value) {
                    if($key==0)
                    {
                        $slab_total_units=$value->slab_end_unit;
                        $previou_end_unit=$value->slab_end_unit;
                    }
                    else
                    {
                        $slab_total_units=$value->slab_end_unit-$previou_end_unit;
                        $previou_end_unit=$value->slab_end_unit;
                    }
                        if( $units >= $slab_total_units)
                        {
                            $units=$units-$slab_total_units;
                            $total_electricity_charges+=($slab_total_units*$value->charges);
                            $new_data[]=['units'=>$slab_total_units,'charges'=>$value->charges];
                        }
                        else
                        {
                            $new_data[]=['units'=>$units,'charges'=>$value->charges];
                            $total_electricity_charges+=($units*$value->charges);
                            break;
                        }
                }
            }
            else // if last slab is applicable category
            {

            
                // $slab_total_units=0;
                // $previou_end_unit=0;
                foreach ($data_with_slab->hMSlabs as $key => $value) {
                        if( $units >= $value->slab_start_unit && $units <= $value->slab_end_unit )
                        {
                            // $units=$units-$slab_total_units;
                            $total_electricity_charges+=($units*$value->charges);
                            $new_data[]=['units'=>$units,'charges'=>$value->charges];
                        }
                        
                }
            }
            $bill_data['total_electricity_charges']=round($total_electricity_charges,2);
            $bill_data['sub_cat_finded_id']=$data_with_slab->id;
            $bill_data['slab_wise_charges']=$new_data;

            $charges_data=[];
            $total_charges_data=0;
            if($charges) // find charges
            {
                foreach ($charges as $ky => $chgrow) {
                    if($chgrow->code==='FPA')
                    {
                        // get 2 months prevous reading
                        $record->month_year;
                        $previous_reading=DB::table('meter_readings')->where('cm_id',$record->bConsumerMeter->cm_id)->where('month_year',(date('y-m-d ',strtotime($record->month_year.' -2 month' ))))->first();
                        if($previous_reading)
                        {
                                $charges_data[]=['code'=>$chgrow->code,'charges'=>$chgrow->charges,'calculated_charges'=>round($previous_reading->offpeak_units*($chgrow->charges),2),'charges_type'=>$chgrow->bChargesType->title];
                                $total_charges_data+=$previous_reading->offpeak_units*($chgrow->charges);
                            
                        }
                    }
                    else
                    {
                        if($chgrow->applicable_on==='units')
                            {
                                $charges_data[]=['code'=>$chgrow->code,'charges'=>$chgrow->charges,'calculated_charges'=>round($record->offpeak_units*($chgrow->charges),2),'charges_type'=>$chgrow->bChargesType->title];
                                $total_charges_data+=$record->offpeak_units*($chgrow->charges);
                            }  
                            else
                            {
                                $charges_data[]=['code'=>$chgrow->code,'charges'=>$chgrow->charges,'calculated_charges'=>round($total_electricity_charges*($chgrow->charges/100),2),'charges_type'=>$chgrow->bChargesType->title];
                                $total_charges_data+=$total_electricity_charges*($chgrow->charges/100);
                            }
                    }
                }
            }

            // dd($charges_data);


            $bill_data['charges']=$charges_data;
            $bill_data['total_charges_data']=round($total_charges_data,2);
            $bill_data['minimum_charges_limit']=round($total_charges_data,2);


             // if bill is less then current consumer type minimum bill limit  then apply minimum limit 
            //  if($finded_cateogry_slab_chareges['total_electricity_charges']<= 75 )
            //  {
               $check_minimum_bill= DB::table('consumers')
                     ->join('options','options.ref_id','=','consumers.consumer_category_id')
                     ->where('consumers.id',$record->bConsumerMeter->consumer_id)->first();
                 if($check_minimum_bill)
                 {
                     if($total_electricity_charges<=(float)$check_minimum_bill->option_value)
                     {
                        $bill_data['total_electricity_charges']=(float)$check_minimum_bill->option_value;
                      
                        $bill_data['minimum_charges_limit']=(float)$check_minimum_bill->option_value;
                        $bill_data['slab_wise_charges']=[];
                     }

                 }
            //  }

            $bill_data['tarrif_code']=$current_cons_type->bConsumer->bConsumerCategory->tarrif_code;
            
            return $bill_data;
    }
    public function find_taxes($row,$finded_cateogry_slab_chareges)
    {
       
        $g_tax=ConsumerMeter::with(['bConsumer.bConsumerCategory','bConsumer.bConsumerCategory.hMtax'=>function($q){
            return $q->where('is_active',1);
        },'bConsumer.bConsumerCategory.hMtax.bTaxType'])->where('cm_id',$row->cm_id)->first();
        
        // dd($g_tax);
        // $g_tax=GeneralTax::where('is_active',1)->get();
        $g_total_taxes=[];
        foreach ($g_tax->bConsumer->bConsumerCategory->hMtax as $key => $value) {
               
                if($value->applicable_on=='units')
                $g_total_taxes[]=['code'=>$value->code,'tax_type'=>$value->bTaxType->title,'percentage'=>$value->tax_percentage,'calculated_tax'=>round(($value->tax_percentage/100)*$row->offpeak_units,2)];
            else
                $g_total_taxes[]=['code'=>$value->code,'tax_type'=>$value->bTaxType->title,'percentage'=>$value->tax_percentage,'calculated_tax'=>round(($value->tax_percentage/100)*$finded_cateogry_slab_chareges['total_electricity_charges'],2)];
            
            

        }
        // dd($g_total_taxes);
        // calculate some tax on already calculated charges
        foreach ($g_total_taxes as $key2 => $value2) {
            if($value2['code']==='ED')
            {
                // filter charges array for QTRTA code charges. ED = % electricity charges+ Qurter Adjust
                $arr = array_filter($finded_cateogry_slab_chareges['charges'], function($ar) {
                    if($ar['code'] == 'QTRTA')
                    return ['calculated_charges'=>$ar['calculated_charges']];
                    else
                    return [];
                    });

                    // dd($arr);
                    if(empty($arr))
                        $g_total_taxes[$key2]['calculated_tax']=round(($value2['percentage']/100)* ($finded_cateogry_slab_chareges['total_electricity_charges']),2);
                    else
                    {
                        $re_index_array=array_values($arr); 
                        $g_total_taxes[$key2]['calculated_tax']=round(($value2['percentage']/100)*($finded_cateogry_slab_chareges['total_electricity_charges'] + $re_index_array[0]['calculated_charges'] ),2);
                        
                    }
                
            }
            else if($value2['code']==='EDFPA')
            {
                $arr = array_filter($finded_cateogry_slab_chareges['charges'], function($ar) {
                    if($ar['code'] == 'FPA')
                    return ['calculated_charges'=>$ar['calculated_charges']];
                    else
                    return [];
                    });

                    // dd($arr);

                    // dd($arr);
                    if(empty($arr))
                        $g_total_taxes[$key2]['calculated_tax']=0 ;
                    else
                    {
                        $re_index_array=array_values($arr); 
                        $g_total_taxes[$key2]['calculated_tax']=round(($value2['percentage']/100)* $re_index_array[0]['calculated_charges'],2) ;
                        
                    }
            }
        }

        // dd($g_total_taxes);
       

        return $g_total_taxes;

    }
    // public function find_charges($row)
    // {
    //     $g_tax=GeneralTax::where('is_active',1)->get();
    //     $g_total_taxes=[];
    //     foreach ($g_tax as $key => $value) {
    //         $g_total_taxes[]=['tax_type'=>$value->tax_name,'percentage'=>$value->tax_percentage,'calculated_tax'=>($value->tax_percentage/100)*$row->offpeak_units];
    //     }
    //     return $g_total_taxes;

    // }
    public function load_statistics_view(Request $request){
        $request->validate([
            'month_year' => 'required',
            'due_date' => 'required',
        ]);
        $all_inputs=$request->all();
        $month_year=$request->month_year.'-01';
        // dd($request->all());
        $all_reading=Reading::where('is_verified',1)->where('month_year',$month_year)->count();
        if($all_reading==0)
        return back()->withError('Error ! Reading Not Available');

        $reading_record=BillGenerate::where('month_year',$month_year)->first();
        if($reading_record)
        {
            // if($reading_record->status=='generated')
            // {
            //     return back()->withError('Record Already Exits');
            // }
            // else
            // {
                // return view('admin.bill_generate.statistics_view',compact('all_inputs'));
            // }
        }
        else
        {
                $reading_record=new BillGenerate();
                $reading_record->month_year=$month_year;
                $reading_record->due_date=date('Y-m-d',strtotime($request->due_date));
                $reading_record->generated_by=Auth::id();
                $reading_record->status='generating';
                $reading_record->save();
        }
        // $all_reading=Reading::where('is_verified',1)->where('month_year',$month_year)->count();
        // $reading=Reading::where('is_verified',1)->where('month_year',$month_year)->where('is_bill_generated',0)->count();
        $generated_bills_reading=Reading::where('is_verified',1)->where('month_year',$month_year)->where('is_bill_generated',1)->count();
        // dd($reading);
        return view('admin.bill_generate.statistics_view',compact('reading_record','all_inputs','all_reading','generated_bills_reading'));
    }
    public function save(Request $request)
    {
       $request->validate([
            'id' => 'required',
        ]);
        // $request->validate([
        //     'month_year' => 'required',
        //     'due_date' => 'required',
        // ]);
        // dd($request->all());
    //    $month_year=$request->month_year.'-01';
    //    $reading_record=BillGenerate::where('month_year',$month_year)->first();
       $reading_record=BillGenerate::where('id',$request->id)->first();
       $month_year=$reading_record->month_year;
        
       if($reading_record)
       {
        if($reading_record->status=='generated')
        // return redirect()->back()->with(['error'=>'Record Already Exits']);
        return  error('record Already exits',  [], 200);
       }
    //    else
    //    {

               

                // if approve reading is not present
                $check_reading=Reading::where('is_verified',1)->where('month_year',$month_year)->count();
                if($check_reading==0)
                return  error('Reading Not Available',  [], 200);
                // return back()->withError('Error ! Reading Not Available');

                 // geting late charges 
                 $l_p_surcharge_percentage=0;
                 $config=Config::get_option('settingCharges','late_fee_surcharge');
                 if($config)
                 $l_p_surcharge_percentage=$config;
                 try {
                 
                $record=BillGenerate::find($request->id);
                // $record=new BillGenerate();
                // $record->month_year=$month_year.'-01';
                // $record->due_date=date('Y-m-d',strtotime($request->due_date));
                // $record->generated_by=Auth::id();
                // $record->save();
                // dd($record);
                $reading=Reading::with('bConsumerMeter')->where('is_verified',1)->where('month_year',$month_year)->where('is_bill_generated',0)->limit(100)->get();
                // dd($reading);
                foreach ($reading as $key => $value) {
                    
                    $cm_id=$value->bConsumerMeter->cm_id;
                    $ref_no=$value->bConsumerMeter->ref_no;
                    $finded_cateogry_slab_chareges=$this->find_consumer_category_slab_charges($value);
                    // dd($finded_cateogry_slab_chareges);

                    $finded_taxes=$this->find_taxes($value,$finded_cateogry_slab_chareges);
                    
                    $total_taxes=0;
                    foreach ($finded_taxes as $tk => $tv) {
                        $total_taxes+=$tv['calculated_tax'];
                    }
                    $currnt_offpeak_unit=$value->offpeak_units;
                    $l_p_surcharge_value=$finded_cateogry_slab_chareges['total_electricity_charges']*($l_p_surcharge_percentage/100);

                    $adj=DB::table('adjustments')->where('cm_id',$cm_id)->where('is_used',0)->orderBy('id','DESC')->first();
                    $adj_amount=0;
                    if($adj)
                    {
                        $adj_amount=$adj->amount;
                        DB::table('consumer_ledgers')->insert(['cm_id'=>$cm_id,'amount'=>$adj_amount,'remarks'=>'Adjustment Amount. id= '.$adj->id]);
                    }
                    // dd($adj);
                    // $arrear=round(ConsumerLedger::where('consumer_id',$value->consumer_id)->sum('amount'),2);
                    // $arrear=round(ConsumerLedger::select(DB::raw('sum(amount+late_fee) AS total_amount'))->where('consumer_id',$value->consumer_id)->sum('total_amount'),2);
                    $check_arrear=DB::table('consumer_ledgers')
                    ->select(DB::raw('sum(amount+late_fee) AS total_amount'))
                    ->where('cm_id',$cm_id)
                   
                    ->first();
                    $arrear=0;
                    if($check_arrear->total_amount)
                    $arrear=$check_arrear->total_amount;
                    // pr($arrear);


                    $bill_array=[
                        'generate_bill_id'=>$record->id,
                        'reading_id'=>$value->id,
                        // 'consumer_id'=>$value->bConsumerMeter->consumer_id,
                        'ref_no_for_bill'=>$ref_no,
                        'cm_id'=>$cm_id,
                        'billing_month_year'=>$month_year,
                        'offpeak_units'=>$value->offpeak_units,
                        'arrears'=>$arrear,
                        'currentbill'=>$finded_cateogry_slab_chareges['total_electricity_charges'],
                        'total_taxes'=>round($total_taxes),
                        'total_charges'=>$finded_cateogry_slab_chareges['total_charges_data'],
                        'off_peak_bill_breakup'=>json_encode($finded_cateogry_slab_chareges['slab_wise_charges']),
                        'charges_breakup'=>json_encode($finded_cateogry_slab_chareges['charges']),
                        'taxes_breakup'=>json_encode($finded_taxes),
                        'adjustment'=>$adj_amount,
                        'WithinDuedate'=>round($finded_cateogry_slab_chareges['total_electricity_charges']+$total_taxes+$finded_cateogry_slab_chareges['total_charges_data']+$arrear,0),
                        'net_bill'=>round($finded_cateogry_slab_chareges['total_electricity_charges']+$total_taxes+$finded_cateogry_slab_chareges['total_charges_data'],2),
                        'GTotal'=>round($finded_cateogry_slab_chareges['total_electricity_charges']+$total_taxes+$finded_cateogry_slab_chareges['total_charges_data']+$arrear,0),
                        'DueDate'=> $record->due_date,
                        'AfterdueDate'=>round($l_p_surcharge_value+$finded_cateogry_slab_chareges['total_electricity_charges']+$total_taxes+$finded_cateogry_slab_chareges['total_charges_data']+$arrear,0),
                        'l_p_surcharge'=>round($l_p_surcharge_value,2),
                        'sub_cat_finded_id'=>$finded_cateogry_slab_chareges['sub_cat_finded_id'],
                        'tarrif_code'=>$finded_cateogry_slab_chareges['tarrif_code'],
                        'consider_amount'=>round($l_p_surcharge_value+$finded_cateogry_slab_chareges['total_electricity_charges']+$total_taxes+$finded_cateogry_slab_chareges['total_charges_data']+$arrear,0)
                    ];

                   
                    $id=ConsumerBill::insertGetId($bill_array);
                    if($adj)
                    DB::table('adjustments')->where('id',$adj->id)->update(['is_used'=>1,'bill_id'=>$id]);
                    DB::table('meter_readings')->where('id',$value->id)->update(['is_bill_generated'=>1]);
                                                                
                    // add in ledger of consumer
                    ConsumerLedger::insert(['cm_id'=>$cm_id,'amount'=>round($l_p_surcharge_value+$finded_cateogry_slab_chareges['total_electricity_charges']+$total_taxes+$finded_cateogry_slab_chareges['total_charges_data'],0),'bill_id'=>$id]);                            
                }
                
                // return redirect()->back()->with(['success'=>'Action Completed']); 
                $generated_bills=Reading::where('month_year',$month_year)->where('is_bill_generated',1)->count();
                $remaining_bills_generation=Reading::where('month_year',$month_year)->where('is_bill_generated',0)->count();
                // if all bill generate then status will be change
                if($remaining_bills_generation==0)
                {
                    $record->status='generated';
                    // BillGenerate::where('id',$request->id)->update(['status'=>'generated']);
                    $record->save();
                }   
                DB::commit(); 
                return  success('generation running',  ['generated_record'=>$generated_bills,'remaining_record'=>$remaining_bills_generation,'status'=>$record->status], 200);
                //  return $this->return_output('flash', 'success', 'Record Add successfully', 'admin/group', '200');
                 } catch (\Exception $e) {
                     DB::rollback();
                    //  return redirect()->back()->with(['error'=>$e->getMessage()]); 
                     return  success($e->getMessage(),  [], 200);
                    //  return redirect()->back()->with(['error'=>$e->getMessage()]); 
                    //  return $this->return_output('error', 'error', [$e->getMessage()], 'back', '422');
                 }
                
    //    }
    }

    public function adjustment_save(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'ref_no' => 'required',
            'amount' => 'required',
        ]);
        if ($validator->fails()) return error('Fill Required Filed.', $validator->errors(), 422);

       $rec=DB::table('consumer_meters')->where('ref_no',$request->ref_no)->first();  
        //  --------------------------------------------------------------
        $check=Adjustment::where('cm_id',$rec->cm_id)->where('is_used',0)->first();
        if($check)
        return error('Pending Record already Exits',[] );

        $c_l= new Adjustment();
        $c_l->cm_id=$rec->cm_id;
        $c_l->amount=$request->amount;
        $c_l->remarks=$request->remarks;
        $c_l->created_by=auth()->user()->id;
        $c_l->save();
        return success('Action Completed',[] );
    }
    public function edit($id)
    {
        $record=Reading::find($id);
        return view('admin.bill_generate.edit',compact('record'));
    }

    

    public function update(Request $request ,$id)
    {
        // pr($request->all());
        $request->validate([
            'ref_no' => 'required',
            'month_year' => 'required',
            'offpeak' => 'required_without:peak',
            // 'off_peak_image' =>Rule::when($request->offpeak != null, 'required'),
            // 'peak_image' =>Rule::when($request->peak != null, 'required')
        ]);
        
       $mont_year_array=explode('-',$request->month_year);
        // $reading_record=Reading::where('ref_no',$request->ref_no)->where('year',$mont_year_array[0])->where('month',$mont_year_array[1])->first();
    //    if($reading_record)
    //    {
        // return redirect()->back()->with(['error'=>'Record Already Exits']);
    //    }else
    //    {
                $record =Reading::find($id);
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
                return redirect()->back()->with(['success'=>'Action Completed']); 
    }


    public function disable($id)
    {
        $record=Reading::where('id',$id)->delete();
        return $this->return_output('flash', 'success', 'Action Completed successfully', 'meter-reading-lists', '200');

    }   


    // public function reading_approve(Request $request)
    // {
        
    //     $record=Reading::where('id',$request->id)->update(['is_verified'=>1,'varifier'=>Auth::id()]);
    //     if($record)
    //     echo json_encode(['success'=>'true','message'=>'Action Completed']);
    //     else
    //     echo json_encode(['success'=>'false','message'=>'Action Failed']);
    //     // return $this->return_output('flash', 'success', 'Action Completed successfully', 'meter-reading-lists', '200');

    // }   

    // public function readingList()
    // {
    //     $paginate_count = 8;
        
    //     $instructors = DB::table('instructors')->groupBy('instructors.id')->paginate($paginate_count);
    //     return view('site.consumer', compact('instructors'));
        
    // }

    // public function readingView($instructor_slug = '', Request $request)
    // {
    //     $instructor = Instructor::where('instructor_slug', $instructor_slug)->first();
    //     $metrics = Instructor::metrics($instructor->id);
    //     return view('site.instructor_view', compact('instructor', 'metrics'));
    // }

}
