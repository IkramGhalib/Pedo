<?php

namespace App\Http\Controllers;

use App\Models\Cart;
use App\Models\Course;
use App\Models\Group;
use App\Models\Invoice;
use App\Models\Category;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CartController extends Controller
{
    public function addcart(Request $request)
    {
        // pr($request->all());

        // $course_id=$request->input('course_id');



        if(Auth::check())
        {
            // ----------------test will be add to card ------------------------------------------------
            if($request->input('fee_type') && $request->input('fee_type')=='test')
            {
                
                $record=Cart::where('fee_type','test')->where('user_id',Auth::id())->first();
                if($record)
                {
                   $testrecord= DB::table('options')->where('code','testFee')->where('option_key','onlineFee')->first();
                   $test_fee=500;
                   if($testrecord)
                   $test_fee=(float)$testrecord->option_value;
                    Cart::where('id',$record->id)->update(['qty'=>$record->qty+$request->qty,'price'=>$test_fee]);
                    return response()->json(['success'=>'true', 'message'=>"Test Qty Increase"]);
                }
                else
                {
                   $testrecord= DB::table('options')->where('code','testFee')->where('option_key','onlineFee')->first();
                   $test_fee=500;
                   if($testrecord)
                   $test_fee=(float)$testrecord->option_value;
                    $cc=Cart::create(['user_id'=>Auth::id(),'qty'=>$request->qty,'price'=>$test_fee,'fee_type'=>'test']);
                    return response()->json(['success'=>'true', 'message'=>"Test Added Succesfully"]);
                }
            }
            // ------------------------------------------------------------------------------------------

            $group_id=$request->input('group_id');
            $group_check=Group::where('id',$group_id)->first();
           
            if($group_check)
            {
                $cat=Category::where('group_id',$group_check->id)->first();
                // check card if already have course or group id -----------------------------------------
                if($group_check->registration_method=='whole')
                {
                   
                    // if it is already exits
                    if(Cart::where('group_id',$group_id)->where('user_id',Auth::id())->exists())
                    return response()->json(['success'=>'false', 'message'=>$group_check->name." Already Exists"]);


                        // will be swith to relationship later
                        $subjects=Course::where('category_id',$cat->id)->get();
                       
                        $courses_l=[];
                        foreach ($subjects as $key => $value) {
                        $courses_l[]=['group_id'=>$group_check->id,'fee_type'=> 'course','category_id'=>$cat->id,'course_id'=>$value->id,'price'=>$value->price,'user_id'=>Auth::id()];
                            
                        }
                        if(!empty($courses_l))
                        $cart=Cart::insert($courses_l);
                        // pr($courses_l);
                         return response()->json(['success'=>'true','message'=>"Successfully Added"]);
                }
                else
                {
                    // if it is already exits
                    $subject=Course::where('id',$request->course_id)->first();
                    // pr($subject->price);
                    if(Cart::where('group_id',$group_id)->where('user_id',Auth::id())->where('category_id',$cat->id)->where('course_id',$subject->id)->exists())
                    return response()->json(['success'=>'false', 'message'=>" Record Already Exists in Cart"]);


                    // $subject=Course::where('category_id',$request->course_id)->get();
                    $cartitem=new Cart();
                    $cartitem->group_id=$group_id;
                    $cartitem->category_id=$cat->id;
                    $cartitem->user_id=Auth::id();
                    $cartitem->price= $subject->price;
                    $cartitem->fee_type= 'course';
                    $cartitem->course_id= $subject->id;
                    $cartitem->save();
                    return response()->json(['success'=>'true','message'=>"Successfully Added"]);
                }
                // ---------------------------------------------------------------------------------------
            }
            else
            {
                 return response()->json(['success'=>'false','message'=>"Gropu Not Found"]);
            }
        }
        else
        {
            return response()->json(['success'=>'false','message'=>"Please Login First"]);
        }

    }

    public function cartview()
    {
        $cart=Cart::where('user_id',Auth::id())->get();
        $cart_group=Cart::where('user_id',Auth::id())->groupBy('group_id')->get();
        // dd($cart_group);
       
        // dd($cart_group);
        return view('layouts.frontend.cart.cart',compact('cart','cart_group'));
    }


   public function cartcount()
   {
    $cartcount=Cart::all()->count();
    return response()->json(['count'=>$cartcount]);
   }
   

    

    

    // public function deletecart($id)

    // {
    //     $data=Cart::find($id);
    //     if(!is_null($data)){
    //         $data->delete();
    //         return redirect()->back()->with('success','Item delete Successfully');
    //     }
    //     return redirect()->with('failed','Item already deleted');
    
    // }

    public function deletecart($group_id,$fee_type)
{
    if($fee_type=='test')
    {
        $userId = Auth::id();
        $deletedCount = Cart::where('user_id', $userId)
        ->where('id', $group_id)
        ->delete();
        
        if ($deletedCount > 0) {
            return redirect()->back()->with('success', 'Items deleted Successfully');
        }
        
        return redirect()->back()->with('failed', 'No items found');
    }
    else{

        
        $userId = Auth::id();
        $deletedCount = Cart::where('user_id', $userId)
        ->where('group_id', $group_id)
        ->delete();
        
        if ($deletedCount > 0) {
            return redirect()->back()->with('success', 'Items in the group are deleted Successfully');
        }
        
        return redirect()->back()->with('failed', 'No items found in the group');
    }
}

    function myPayments(Request $request)
	{
		// pr($request->all());
		// list.blade
		$invoices = Invoice::with('user','invoiceDetil','invoiceDetil.category.masterCategory','invoiceDetil.groups','invoiceDetil.category','invoiceDetil.course','invoiceDetil.course.masterCourse')->where('user_id',Auth::id())->orderBy('id','DESC')->paginate();
		return view('site.my-payments.list',compact('invoices'));


	}
    // public function upload_file(Request $request)
    // {
    //     // print_r($request->all());
    //     // die;
    //     if($request->hasFile('file')){
    //         $image_name = $request->invoice_id.'.'.$request->file->getClientOriginalExtension();
    //           $request->file->move(public_path('uploads_receipt_evidance'), $image_name);
    //           $created_name='uploads_receipt_evidance/'.$image_name;
          
    //         Invoice::where(['id'=>$request->invoice_id])->update(['uploaded_receipt'=>$created_name,'uploaded_receipt_date'=>date('Y-m-d H:i:s')]);
    //         return  response()->json(['success'=>'true']);
    //     }
    //     else
    //     {
            
    //         return  response()->json(['success'=>'false']);
    //     }
    //     // $result = Exam::with('manySubject','manySubject.hasOneSubject')->find($id);
    //     //  $this->notify_paython_script();
    //     // dd($result);
    // }

}
