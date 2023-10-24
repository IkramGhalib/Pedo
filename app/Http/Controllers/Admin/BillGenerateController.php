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
    public function form()
    {
        return view('admin.bill_generate.form');
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

    function find_consumer_category_slab_charges($record)
    {
            $current_cons_type= ConsumerMeter::with('bConsumer.bConsumerCategory.hMConSubCategory.hMSlabs')->where('ref_no',$record->ref_no)
            ->first();

            // dd($current_cons_type);

            $data=$current_cons_type->bConsumer->bConsumerCategory->hMConSubCategory;
            $data_with_slab=$data->where('category_conditon_start','<=',$record->offpeak_units) ->where('category_conditon_end','>=',$record->offpeak_units)->first();

            // dd($data);
            $charges=SubCategoryCharges::with('bChargesType')->where('sub_cat_id',$data_with_slab->id)->get();
            $charges_data=[];
            $total_charges_data=0;
            if($charges)
            {
                foreach ($charges as $ky => $chgrow) {
                    $charges_data[]=['charges'=>$chgrow->charges,'calculated_charges'=>$record->offpeak_units*$chgrow->charges,'charges_type'=>$chgrow->bChargesType->title];
                    $total_charges_data+=$record->offpeak_units*$chgrow->charges;
                }
            }

            $new_data = array();
            $units=$record->offpeak_units;
            $total_electricity_charges=0;

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
            else
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
            $bill_data['total_electricity_charges']=$total_electricity_charges;
            $bill_data['sub_cat_finded_id']=$data_with_slab->id;

            $bill_data['slab_wise_charges']=$new_data;
            $bill_data['charges']=$charges_data;
            $bill_data['total_charges_data']=$total_charges_data;
            return $bill_data;
    }
    public function find_taxes($row,$finded_cateogry_slab_chareges)
    {
        $g_tax=ConsumerMeter::with(['bConsumer.bConsumerCategory','bConsumer.bConsumerCategory.hMtax'=>function($q){
            return $q->where('is_active',1);
        },'bConsumer.bConsumerCategory.hMtax.bTaxType'])->first();
        // dd($g_tax->bConsumer->bConsumerCategory->hMtax);
        // $g_tax=GeneralTax::where('is_active',1)->get();
        $g_total_taxes=[];
        foreach ($g_tax->bConsumer->bConsumerCategory->hMtax as $key => $value) {
            if($value->applicable_on=='units')
                $g_total_taxes[]=['tax_type'=>$value->bTaxType->title,'percentage'=>$value->tax_percentage,'calculated_tax'=>($value->tax_percentage/100)*$row->offpeak_units];
            else
                $g_total_taxes[]=['tax_type'=>$value->bTaxType->title,'percentage'=>$value->tax_percentage,'calculated_tax'=>($value->tax_percentage/100)*$finded_cateogry_slab_chareges['total_electricity_charges']];

        }

        // pr($g_total_taxes);
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
    public function save(Request $request)
    {
        $request->validate([
            'month_year' => 'required',
            'due_date' => 'required',
        ]);
       $month_year=$request->month_year.'-01';
        $reading_record=BillGenerate::where('month_year',$month_year)->first();
        
        $l_p_surcharge_percentage=0;
        $config=Config::get_option('settingCharges','late_fee_surcharge');
        if($config)
        $l_p_surcharge_percentage=$config;
       if($reading_record)
       {
        return redirect()->back()->with(['error'=>'Record Already Exits']);
       }else
       {
                
                $record=new BillGenerate();
                $record->month_year=$month_year.'-01';
                $record->due_date=$request->due_date;
                $record->generated_by=Auth::id();
                $record->save();
                $reading=Reading::where('is_verified',1)->where('month_year',$month_year)->get();
                foreach ($reading as $key => $value) {
                    $finded_cateogry_slab_chareges=$this->find_consumer_category_slab_charges($value);
                    // dd($finded_cateogry_slab_chareges);

                    $finded_taxes=$this->find_taxes($value,$finded_cateogry_slab_chareges);
                    $total_taxes=0;
                    foreach ($finded_taxes as $tk => $tv) {
                        $total_taxes+=$tv['calculated_tax'];
                    }
                    $currnt_offpeak_unit=$value->offpeak_units;
                    $l_p_surcharge_value=$finded_cateogry_slab_chareges['total_electricity_charges']*($l_p_surcharge_percentage/100);
                    $reading_record=ConsumerBill::insert(
                                                                [
                                                                    'generate_bill_id'=>$record->id,
                                                                    'reading_id'=>$value->id,
                                                                    'ref_no'=>$value->ref_no,
                                                                    'billing_month_year'=>$month_year,
                                                                    'offpeak_units'=>$value->offpeak_units,
                                                                    'currentbill'=>round($finded_cateogry_slab_chareges['total_electricity_charges']),
                                                                    'total_taxes'=>round($total_taxes),
                                                                    'total_charges'=>round($finded_cateogry_slab_chareges['total_charges_data']),
                                                                    'off_peak_bill_breakup'=>json_encode($finded_cateogry_slab_chareges['slab_wise_charges']),
                                                                    'charges_breakup'=>json_encode($finded_cateogry_slab_chareges['charges']),
                                                                    'taxes_breakup'=>json_encode($finded_taxes),
                                                                    'WithinDuedate'=>round($finded_cateogry_slab_chareges['total_electricity_charges']+$total_taxes+$finded_cateogry_slab_chareges['total_charges_data']),
                                                                    'net_bill'=>round($finded_cateogry_slab_chareges['total_electricity_charges']+$total_taxes+$finded_cateogry_slab_chareges['total_charges_data']),
                                                                    'GTotal'=>round($finded_cateogry_slab_chareges['total_electricity_charges']+$total_taxes+$finded_cateogry_slab_chareges['total_charges_data']),
                                                                    'DueDate'=>$request->due_date,
                                                                    'AfterdueDate'=>round($l_p_surcharge_value+$finded_cateogry_slab_chareges['total_electricity_charges']+$total_taxes+$finded_cateogry_slab_chareges['total_charges_data']),
                                                                    'l_p_surcharge'=>round($l_p_surcharge_percentage/100*$finded_cateogry_slab_chareges['total_electricity_charges']),
                                                                    'sub_cat_finded_id'=>$finded_cateogry_slab_chareges['sub_cat_finded_id']
                                                                ]
                                                        );
                }
                return redirect()->back()->with(['success'=>'Action Completed']); 
                
       }
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
