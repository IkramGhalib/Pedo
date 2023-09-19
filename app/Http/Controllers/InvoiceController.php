<?php

namespace App\Http\Controllers;

use App\Models\Cart;
use App\Models\Category;
use App\Models\Course;
use App\Models\Group;
use App\Models\Instructor;
use App\Models\Invoice;
use App\Models\InvoiceDetail;
use App\Models\CourseTaken;
use App\Models\PayemntCollectionMethod;
use App\Models\User;
use App\Models\Receipt;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class InvoiceController extends Controller
{

    // public function index()
    // {
       
    //     if(Auth::check()){
    //         $invoice = InvoiceDetail::groupBy('invoice_id')->get();
            
    //     }
    //     $group=Group::all();
    //     return view('layouts.frontend.invoice.invoice',compact('invoice','group'));
    // }

    public function getUserInvoice($id)
    {
        // pr($id);
        // die;
        $p_methods=PayemntCollectionMethod::where('status',1)->get();
        if(Auth::check()){
            $invoice = Invoice::with('invoiceDetil')->where('id',$id)->where('user_id',Auth::id())->first();
            // $cart_group=Cart::where('user_id',Auth::id())->groupBy('group_id')->get();
        }
        else{
            $invoice=[];
        }
        // pr($invoice);/
        // $group=Group::all();
        return view('layouts.frontend.invoice.invoice',compact('invoice','p_methods'));
    }

    public function upload_file(Request $request)
    {
        // pr('testing');
        // die;
        if($request->hasFile('file')){
            $image_name = $request->invoice_id.'.'.$request->file->getClientOriginalExtension();
              $request->file->move(public_path('uploads_receipt_evidance'), $image_name);
              $created_name='uploads_receipt_evidance/'.$image_name;
          
            Invoice::where(['id'=>$request->invoice_id])->update(['uploaded_receipt'=>$created_name,'uploaded_receipt_date'=>date('Y-m-d H:i:s')]);
            return  response()->json(['success'=>'true']);
        }
        else
        {
            return  response()->json(['success'=>'false']);
        }
    }


    public function store(Request $request)
    {
        // pr(Auth::id());
        // die;

        $count=Invoice::where('user_id',Auth::id())->where('status','un-paid')->count();
        // pr($count);
        // $cart_group_id = $request->input('cart_group_id');
        if($count>4)
        return response()->json(['success' => 'false','message'=>'Too Many Pending Invoices']);
        
        
        // $cart=Cart::whhere('user_id',Auth::id())->get();
        //  same group Id exists
        // $existingInvoice = InvoiceDetail::where('group_id', $cart_group_id)->first();
    
        // if ($existingInvoice) {
        //     return response()->json(['status' => 'exists']);
        // }
    
        // $total_price = $request->input('total_price');
        // $cart=Cart::whhere('user_id',Auth::id())->get();
        // pr($cart)  
        try {
                DB::beginTransaction(); 
                $invoice = new Invoice();
            
                $invoice->user_id = Auth::id();
                $invoice->created_by = Auth::id();
                $invoice->create_from_place = 'FEP';
                $invoice->status = "un-paid";
                $invoice->save();
                $total_price=0;
                $cartitem = Cart::where('user_id', Auth::id())->get();
                $inv_details=[];
                foreach ($cartitem as $cartItem) {
                    $inv_details[]= [
                        'invoice_id' => $invoice->id,
                        'group_id' =>  $cartItem->group_id,
                        'category_id' => $cartItem->category_id ,
                        'course_id' => $cartItem->course_id ,
                        'qty' => $cartItem->qty ,
                        'fee_type' => $cartItem->fee_type ,
                        'price' => $cartItem->price 
                    ];
                    $total_price+=($cartItem->qty*$cartItem->price);
                }
                $invoice->invoice_total_amount= $total_price;
                $invoice->save();

                // pr($inv_details);
                if(!empty($inv_details))
                InvoiceDetail::insert($inv_details);
            
                $cartitem = Cart::where('user_id', Auth::id())->get();
                Cart::destroy($cartitem);
            
                DB::commit();
                return response()->json(['success' => 'true','message'=>'Action Completed Successfully','data'=>['invoice_id'=>$invoice->id]]);
              
        } catch (Exception $e) {
  
           
            DB::rollback();
            return response()->json(['success' => 'false','message'=>$e->getMessage()]);
        }
    }
    

    public function admin_invoice()
    {
       
        $user=User::all();
        // $group=Group::all();
        // $course=Course::all();
        $category=Category::all();

        $group = DB::table('groups')
                    ->select('groups.*','categories.name as cat_name')
                    ->join('categories', 'categories.group_id', '=', 'groups.id')
                    ->join('master_categories', 'master_categories.id', '=', 'categories.master_category_id')
                    // ->where('master_categories.id',)
                    ->where('groups.is_active',1)
                    ->get();

        // pr($group);            

        // foreach ($groups as $key => $value) {
        //     $value->courses = DB::table('courses')
        //     ->select('courses.*', 'instructors.first_name', 'instructors.last_name','instructors.instructor_slug')
        //     // ->selectRaw('AVG(course_ratings.rating) AS average_rating')
        //     // ->leftJoin('course_ratings', 'course_ratings.course_id', '=', 'courses.id')
        //     ->join('instructors', 'instructors.id', '=', 'courses.instructor_id')
        //     ->join('categories', 'categories.id', '=', 'courses.category_id')
        //     // ->join('categories', 'categories.id', '=', 'courses.category_id')
        //     ->where('categories.group_id',$value->id) ->get();

        // }



        return view('admin.invoice.form',compact('user','group','category'));
    }


    public function admin_invoice_list(Request $request)
    {

        $paginate_count = 10;
        if($request->has('search')){
            $search = $request->input('search');
            $invoice = Invoice::with('user','invoiceDetil','invoiceDetil.groups','invoiceDetil.category','invoiceDetil.category.masterCategory','invoiceDetil.course','invoiceDetil.course.masterCourse')->where('id', 'LIKE', '%' . $search . '%')->orderBy('id','DESC')
                           ->paginate($paginate_count);
        }
        else {
            $invoice = Invoice::with('user','invoiceDetil','invoiceDetil.category.masterCategory','invoiceDetil.groups','invoiceDetil.category','invoiceDetil.course','invoiceDetil.course.masterCourse')->orderBy('id','DESC')->paginate($paginate_count);
        }
        // dd($invoice);
        // $invoice = InvoiceDetail::groupBy('invoice_id')->get();
        // $invoice = InvoiceDetail::all();


        return view('admin.invoice.index',compact('invoice'));
    }

    public function makeReceipt(Request $request)
    {

        $inv = Invoice::with('user','invoiceDetil')->where('id',$request->invoice_id)->first();
        if($inv->status=='paid')
        {
            return redirect()->back()->withSuccess('Invoice Already Paid'); 
        }
        $courses=[];
        $tests=[];
        foreach ($inv->invoiceDetil as $key => $value) {
            if($value->fee_type=='course')
            $courses[]=['course_id'=>$value->course_id,'user_id'=>$inv->user->id,'created_at'=>date('Y-m-d H:i:s')]  ;    
            else
            $test=['amount'=>$value->price*$value->qty,'remarks'=>'Test Fee inv#'.$inv->id,'user_id'=>$inv->user->id,'created_at'=>date('Y-m-d H:i:s')]  ;    

            }


        // $courses=[];
        // foreach ($invoice->invoiceDetil as $key => $value) {
        //     $courses[]=['course_id'=>$value->course_id,'user_id'=>$invoice->user->id,'created_at'=>date('Y-m-d H:i:s')]  ;    
        // }
        if(empty($courses) && empty($courses) )
        {
            return redirect()->withError('Action Failed. contact System Admin');
            
        }
        else
        {
            try {
                    DB::beginTransaction(); 
                    if(!empty($courses))
                    CourseTaken::insert($courses);
                    if(!empty($test))
                    DB::table('user_balance')->insert($test);
                    $inv->status="paid";
                    $inv->save();

                    Receipt::insert(['invoice_id'=>$inv->id,'receive_amount'=>$inv->invoice_total_amount,'receive_by'=>auth()->user()->id,'received_from'=>'Admin Panel']);
            
                    DB::commit();
                    return redirect()->back()->withSuccess('Action Completed');

            } catch (Exception $e) {
  
           
                DB::rollback();
                return response()->json(['success' => 'false','message'=>$e->getMessage()]);
            }
            
        }
        // dd($invoice);
        // $invoice = InvoiceDetail::groupBy('invoice_id')->get();
        // $invoice = InvoiceDetail::all();


        // return view('admin.invoice.index',compact('invoice'));
    }

    public function admin_send_invoice(Request $request)
    {
        // dd($request->all());
        $invoiceData = [
            'user_id' => Auth::id(),
            'status' => "paid",
            'created_at' => now(),
            'updated_at' => now(),
        ];

        $invoiceId = DB::table('invoices')->insertGetId($invoiceData);

        $courseIds = implode(',', $request->input('course_id'));

        $invoiceItemData = [
            'invoice_id' => $invoiceId,
            'group_id' => $request->input('group_id'),
            'category_id' => $request->input('category_id'),
             'course_id' => $courseIds,
            'price' => $request->input('price'),
            'created_at' => now(),
            'updated_at' => now(),
        ];

        DB::table('invoice_details')->insert($invoiceItemData);

        return redirect('admin/invoice-list')->with('success', 'Invoice created successfully');
    }

//     public function admin_invoice_edit($id)
// {
//     $user=User::all();
//     $group=Group::all();
//     $course=Course::all();
//     $category=Category::all();

//     $invoice = DB::table('invoices')->where('id', $id)->first();
//     $invoiceItem = DB::table('invoice_details')->where('invoice_id', $id)->first();

//     return view('admin.invoice.edit', compact('invoice', 'invoiceItem','user','group','category'));
// }


// public function admin_invoice_update(Request $request, $id)
// {
//     $invoiceData = [
//         'user_id' => Auth::id(),
//         'status' => $request->input('status'),
//         'updated_at' => now(),
//     ];
//     $invoiceId = DB::table('invoices')->insertGetId($invoiceData);

//     DB::table('invoices')->where('id', $id)->update($invoiceData);

//     $invoiceItemData = [
//         'invoice_id' => $invoiceId,

//         'group_id' => $request->input('group_id'),
//         'category_id' => $request->input('category_id'),
//         'course_id' => $request->input('course_id'),
//         'price' => $request->input('price'),
//         'updated_at' => now(),
//     ];

//     DB::table('invoice_details')->where('invoice_id', $id)->update($invoiceItemData);

//     return redirect()->route('admin_invoice_list')->with('success', 'Invoice updated successfully');
// }



    public function admin_invoice_delete($id)
    {
        $data=InvoiceDetail::find($id);
        if(!is_null($data)){
            $data->delete();
            return redirect()->back()->with('success','Item delete Successfully');
        }
        return redirect()->with('failed','Item already deleted');
    }
    

}
