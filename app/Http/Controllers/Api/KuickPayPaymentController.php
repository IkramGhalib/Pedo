<?php
namespace App\Http\Controllers\Api;
use Exception;
use App\Models\User;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use App\Http\Controllers\Controller;
use App\Models\Invoice;
use App\Models\PaymentGatewayHistory;
use App\Models\CourseTaken;
use App\Models\InvoiceDetail;
use App\Models\Course;
use App\Models\Receipt;

class KuickPayPaymentController extends Controller
{
    // when Payment Gateway want to retrive invoice ---------------------------------------
    public function getInquiryResponseFormat($array)
    {
       $data=['response_Code'=>'',
                "consumer_Detail" => '',    
                'bill_status'=> ''  ,
                'due_date'=>   '',
                'amount_within_dueDate'=>   '',
                'amount_after_dueDate'=>   '',
                'date_paid'=>   '',
                "billing_month"=> '',
                'amount_paid'=>   '', 
                'reserved'=>''   
        ];
        if(!empty($array)){
            foreach ($array as $key => $value) {
                $data[$key]=$value;
            }
        }
        return  response()->json($data);
    }
    public function getPaymentResponseFormat($array)
    {
       $data=['response_Code'=>'',
             "Identification_parameter" => '',    
             'reserved'=>''   
             ];
       
        if(!empty($array)){

            foreach ($array as $key => $value) {
                $data[$key]=$value;
            }
        }
        return  response()->json($data);
    }
    public function getInvoiceData(Request $request)
    {
        
        $validator = Validator::make($request->all(), [
            'consumer_number' => 'required|string',
            'bank_mnemonic' => 'required|string',
        ]);

        if ($validator->fails()) 
        return   $this->getInquiryResponseFormat(['response_Code'=>'04','reserved'=>'Consumer number or bank mnemonic is Required a valid String' ]);
        $cn=$request->consumer_number;
        $cn_array=str_split($cn, 5); 
        $inv=Invoice::with('invoiceDetil','user')->find((int)$cn_array[1]);
        // pr($inv);
        if (!$inv) 
        return $this->getInquiryResponseFormat(['response_Code'=>'01','reserved'=>'Vocher Does Not Exits' ]);
        $inv_price=$inv->invoice_total_amount; 
        if($inv)
        {
            if ($inv->status=='un-paid') 
            {
                $charges=DB::table('payment_gateway_charges')->where('payment_gateway','KuickPay')->where('charges','<=',(int)$inv_price)->orderBy('bill_amout','ASC')->first();
                if($charges)
                $inv_price=$charges->charges+$inv_price;
                $response=[
                    'response_Code'=>'00',
                    "consumer_Detail" => $inv->user->first_name,    
                    'bill_status'=> 'U'  ,
                    'due_date'=>   date('Ymd'),
                    'amount_within_dueDate'=>   '+'.sprintf('%011d', $inv_price).'00',
                    'amount_after_dueDate'=>   '+'.sprintf('%011d', $inv_price).'00',
                    'date_paid'=>   date('Ymd'),
                    "billing_month"=> date('ym'),
                    'amount_paid'=>   sprintf('%010d', $inv_price).'00',
                    'reserved'=> 'TEST APi Inquery '
                    ];  
                 return    $this->getInquiryResponseFormat($response);
            }
            elseif($inv->status=='paid')
                return $this->getInquiryResponseFormat(['response_Code'=>'02','reserved'=>'Voucher Already paid' ]);
            else
                return $this->getInquiryResponseFormat(['response_Code'=>'02','reserved'=>'Vocher Expired' ]);
            
           
        }    
       
       
        // return success('',$inv);
    }

    public function updateInvoiceData(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'consumer_number' => 'required|string',
            'tran_auth_id' => 'required|string',
            'bank_mnemonic' => 'required|string',
            'transaction_amount' => 'required|string',
            'tran_date' => 'required|string',
            'tran_time' => 'required|string',
        ]);

        if ($validator->fails()) 
        return $this->getPaymentResponseFormat(['response_Code'=>'04','reserved'=>'Request Does Not have Correct Data' ]);
        
        $cn=$request->consumer_number;
        $cn_array=str_split($cn, 5);    
        $inv=Invoice::with('invoiceDetil','user')->find((int)$cn_array[1]);
        if ($inv)
        {
            $inv_price=$inv->invoice_total_amount;
                if ($inv->status=='un-paid') 
                {
                    $other_charges=0;
                    $charges=DB::table('payment_gateway_charges')->where('payment_gateway','KuickPay')->where('charges','<=',(int)$inv_price)->orderBy('bill_amout','ASC')->first();
                    if($charges)
                    {
                        $other_charges=$charges->charges;
                        // $inv_price=$other_charges+$inv_price;
                    }

                    $response=[
                        'response_Code'=>'00',
                        "Identification_parameter" => sprintf('%011d', $inv->id),    
                        'reserved'=> 'TEST APi Inquery '
                        ];  

                        $courses=[];
                        $tests=[];
                        foreach ($inv->invoiceDetil as $key => $value) {
                            if($value->fee_type=='course')
                            $courses[]=['course_id'=>$value->course_id,'user_id'=>$inv->user->id,'created_at'=>date('Y-m-d H:i:s')]  ;    
                            else
                            $test=['amount'=>$value->price*$value->qty,'remarks'=>'Test Fee inv#'.$inv->id,'user_id'=>$inv->user->id,'created_at'=>date('Y-m-d H:i:s')]  ;    

                            }
                            if(!empty($courses))
                            CourseTaken::insert($courses);
                            if(!empty($test))
                            DB::table('user_balance')->insert($test);
                            
                            $inv->other_charges=$other_charges;
                            $inv->other_charges_desc='QuickPay Charges';
                            $inv->status="paid";
                            $inv->save();

                            PaymentGatewayHistory::insert(['payment_method'=>'kuickPay','order_details'=>json_encode($request->all())]);
                            Receipt::insert(['invoice_id'=>$inv->id,'receive_amount'=>$inv_price+$other_charges,'received_from'=>'KuickPay']);
                            return    $this->getPaymentResponseFormat($response);
                }
                else if($inv->status=='paid')
                {
                    
                    $response=[
                        'response_Code'=>'02',
                        "Identification_parameter" => sprintf('%011d', $inv->id),    
                         'reserved'=>'Voucher Already paid'   
                        ]; 

                        return    $this->getPaymentResponseFormat($response);
                }
                else
                {
                        return $this->getPaymentResponseFormat(['response_Code'=>'02','reserved'=>'Vocher Expired' ]);
                }
        }
        else
        {    
                return $this->getPaymentResponseFormat(['response_Code'=>'01','reserved'=>'Vocher Does Not Exits' ]);

            
        }           
    }
    // when Payment Gateway want to retrive invoice ---------------------------------------
}
