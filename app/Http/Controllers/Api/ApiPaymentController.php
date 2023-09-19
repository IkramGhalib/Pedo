<?php

namespace App\Http\Controllers\Api;

use Exception;
use App\Models\User;
use App\Models\RoleUser;
use App\Models\Role;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Validator;
use App\Http\Controllers\Controller;
use App\Models\Invoice;
use App\Models\InvoiceDetail;
use App\Models\Course;

class ApiPaymentController extends Controller
{
    
     public function myPayments(Request $request)
    {
        $invoices = Invoice::with('user','invoiceDetil','invoiceDetil.category.masterCategory')->where('user_id',Auth::id())->orderBy('id','DESC')->get();
       return success('',$invoices);
    }


     public function getInvoiceById(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'invoice_id' => 'required|integer',
        ]);

        if ($validator->fails()) return error('Validation Error.', $validator->errors(), 422);
        //    $inv=Invoice::with('details')->where('id',$request->id)->first();
       $inv = Invoice::with('user','invoiceDetil','invoiceDetil.category.masterCategory','invoiceDetil.groups','invoiceDetil.category','invoiceDetil.course','invoiceDetil.course.masterCourse')->where('id',$request->invoice_id)->where('user_id',Auth::id())->first();
       return success('',$inv);
    }



    public function createInvoice(Request $request)
    {
        
        // pr(Auth::id());
        $count=Invoice::where('user_id',Auth::id())->where('status','un-paid')->count();
        // $cart_group_id = $request->input('cart_group_id');
        if($count>4)
        return error('Too Many Pending Invoices');
    
        // $total_price = $request->input('total_price');
        // $cart=Cart::whhere('user_id',Auth::id())->get();
        // pr($cart)  
        try {
                DB::beginTransaction(); 
                $invoice = new Invoice();
                $invoice->user_id = Auth::id();
                $invoice->created_by = Auth::id();
                $invoice->create_from_place = 'MOBILEAPP';
                $invoice->status = "un-paid";
                $invoice->save();
            
                // $cartitem = Cart::where('user_id', Auth::id())->get();
                $inv_details=[];
                for ($i=0; $i < sizeof($request->course_id); $i++) { 
                    # code...
                // }
                $cdata = Course::where('category_id',$request->category_id[$i])->where('id',$request->course_id[$i])->first();
                // foreach ($cartitem as $cartItem) {
                    $inv_details[]= [
                        'invoice_id' => $invoice->id,
                        'group_id' =>  $request->group_id[$i],
                        'category_id' => $request->category_id[$i],
                        'course_id' => $request->course_id[$i],
                        'price' => $cdata->price 
                    ];
                }
                // pr($inv_details);
                if(!empty($inv_details))
                InvoiceDetail::insert($inv_details);
            
                DB::commit();
                return response()->json(['success' => 'true','message'=>'Action Completed Successfully','data'=>['invoice_id'=>$invoice->id]]);
              
        } catch (Exception $e) {
  
           
            DB::rollback();
            throw $e;
        }

        
    
    }

    









    // when Payment Gateway want to retrive invoice ---------------------------------------
    public function getInvoiceData(Request $request)
    {
        
        $validator = Validator::make($request->all(), [
            'invoice_id' => 'required|integer',
        ]);

        if ($validator->fails()) return error('Validation Error.', $validator->errors(), 422); 

        $inv=Invoice::find($request->id)->first();
       
        return success('',$inv);
    }

    public function updateInvoiceData(Request $request)
    {
         $inv=Invoice::find($request->id)->update($request->all());
        return success('',$inv);
    }

    public function upload_file(Request $request)
    {
        // die;
        if($request->hasFile('file')){
            $image_name = $request->invoice_id.'.'.$request->file->getClientOriginalExtension();
              $request->file->move(public_path('uploads_receipt_evidance'), $image_name);
              $created_name='uploads_receipt_evidance/'.$image_name;
          
            Invoice::where(['id'=>$request->invoice_id])->update(['uploaded_receipt'=>$created_name,'uploaded_receipt_date'=>date('Y-m-d H:i:s')]);
            return success('Upload Successfully');
        }
        else
        {
            return error('Attach file not found');
        }
    }
    // when Payment Gateway want to retrive invoice ---------------------------------------
}
