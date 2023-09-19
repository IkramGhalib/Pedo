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
// use App\Http\Sitehelpers;
use SiteHelpers;

class ApiDashboardController extends Controller
{
    /**
     * User login API method
     *
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function index(Request $request)
    {

         
            $category['category']= SiteHelpers::active_categories_master();
            $category['slides']= SiteHelpers::get_slides();
            return success('success',$category, '');
    }

      
    
    // public function groupCourses(Request $request)
    // {
       

    //         return success([], 'Password changed successfully.');
        
    // }

    // public function myExam(Request $request)
    // {
    //     $validator = Validator::make($request->all(), [
    //         'old_password' => 'required',
    //         'new_password' => 'required|min:3',
    //         'confirm_password' => 'required|same:new_password'
    //     ]);

    //     if ($validator->fails()) return error('Validation Error.', $validator->errors(), 422);

    //     $user = Auth::user();

    //     if (password_verify($request->old_password, $user->password)) {
    //         $user->password = bcrypt($request->new_password);
    //         $user->save();

    //         return success([], 'Password changed successfully.');
    //     } else {
    //         return error('Password unmatched', ['error' => 'Password did not matched'], 401);
    //     }
    // }


   

}
