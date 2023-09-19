<?php

namespace App\Http\Controllers\Api\Auth;

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
// use Laravel\Passport\Token;

class LoginController extends Controller
{
    /**
     * User login API method
     *
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function login(Request $request)
    {
            Artisan::call('config:clear');
            Artisan::call('view:clear');
            Artisan::call('route:clear');
            Artisan::call('cache:clear');

        $validator = Validator::make($request->all(), [
            'email'    => 'required|email',
            'password' => 'required'
        ]);

        if ($validator->fails()) return error('Validation Error.', $validator->errors(), 422);

        $credentials = $request->only('email', 'password');

        if (Auth::attempt($credentials)) {
           
            $user=User::with('roles')->where('id',Auth::user()->id)->first();
            if($user->device_imei=='not-set')
                User::where('id',$user->id)->update(['device_imei'=>$request->device_imei]);
            else
            {
                if($request->device_imei!=$user->device_imei)
                {
                        return error('Unauthorised Device', ['error' => 'Unauthorised'], 401);
                }
            }
            // pr($user);
            $success['name']  = $user->first_name ;
            $success['email']  = $user->email;
            $success['roles']= $user->roles;
            $success['token'] = $user->createToken('accessToken')->accessToken;

            return success($success, 'You are successfully logged in.');
        } else {
            return error('Unauthorised', ['error' => 'Unauthorised'], 401);
        }
    }
    public function logout(Request $request)
    {
        // student/getInvoiceById
        // pr(Auth::user());
        // die;
        $accessToken = Auth::user()->token();
        DB::table('oauth_refresh_tokens')
            ->where('access_token_id', $accessToken->id)
            ->update([
                'revoked' => true
            ]);

        $accessToken->revoke();
        return success('Logout Successfully');
    }

    public function change_password(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'old_password' => 'required',
            'new_password' => 'required|min:3',
            'confirm_password' => 'required|same:new_password'
        ]);

        if ($validator->fails()) return error('Validation Error.', $validator->errors(), 422);

        $user = Auth::user();

        if (password_verify($request->old_password, $user->password)) {
            $user->password = bcrypt($request->new_password);
            $user->save();

            return success([], 'Password changed successfully.');
        } else {
            return error('Password unmatched', ['error' => 'Password did not matched'], 401);
        }
    }

    public function forgot_password(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'email' => 'required|email'
        ]);

        if ($validator->fails()) return error('Validation Error.', $validator->errors(), 422);

        $user = User::where('email', $request->email)->first();

        if ($user) {
            $token = Str::random(60);

            DB::table('password_resets')->insert([
                'email' => $request->email,
                'token' => $token,
                'created_at' => Carbon::now()
            ]);

            $data = [
                'name' => $user->name,
                'email' => $user->email,
                'token' => $token
            ];

            Mail::send('email.forgot_password', $data, function ($message) use ($data) {
                // $message->from('sulaimanbarki@gmail.com', 'Sulaiman Barki');
                $message->to($data['email'], $data['name'])->subject('Forgot Password');
            });

            return success([], 'Password reset link has been sent to your email.');
        } else {
            return error('Email not found', ['error' => 'Email not found'], 401);
        }
    }

    /**
     * User registration API method
     *
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function register(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name'     => 'required',
            'email'    => 'required|email|unique:users',
            'password' => 'required|min:6|confirmed'
        ]);

        if ($validator->fails()) return error($validator->errors());

        try {
            $user = User::create([
                'first_name'     => $request->name,
                'email'    => $request->email,
                'contact_no'    => $request->contact_no,
                'password' => bcrypt($request->password),
                // 'user_type_id' => 4
            ]);
            $role_user = RoleUser::create([
                'user_id'     => $user->id,
                'role_id'     => 1,
            ]);

            $user=User::with('roles')->where('id',$user->id)->first();
            $success['name']  = $user->first_name ;
            $success['email']  = $user->email;
            $success['roles']= $user->roles;
            $message          = 'user has been successfully created.';
            $success['token'] = $user->createToken('accessToken')->accessToken;
        } catch (Exception $e) {

            // $success['token'] = [];
            // $message          = 'Oops! Unable to create a new user.';
             return success($e->getLine().' - '.$e->getMessage(),'');
        }

        return success($message,$success);
    }
     public function getUser(Request $request)
    {
       $user=User::find(Auth::user()->id);
        return success($user, '');
    }
    public function getRestInfo(Request $request)
    {
        $user=User::with('restuarant')->where('id',Auth::user()->id)->first();
       return $user;

    //    $user=User::find(Auth::user()->id);
        // return success($user, '');
    }

    public function delete_account(Request $request)
    {
        User::where('id',Auth::user()->id)->update(['email'=>Auth::user()->id.'delete@ce.com','lat'=>null,'lng'=>null,'image'=>null,'contact_number'=>null,'status'=>0]);
        return success([], 'Delete successfully');

    //    $user=User::find(Auth::user()->id);
        // return success($user, '');
    }
    public function userInfoUpdate(Request $request)
    {
        // isset($request->image_name) ? $request->image_name : null,
        //  return $request->all();
        if($request->hasFile('image')){
            $image_name = time().'.'.$request->image->getClientOriginalExtension();
              $request->image->move(public_path('/app/users/'), $image_name);
        }
        else{
            $image_name="";
        }


        $user=User::find(Auth::user()->id);
        $user->name=$request->name;
        $user->email=$request->email;
        $user->image=isset($request->image_name) ? $request->image_name : null;
        $user->contact_number=$request->contact_number;
        $user->save();
        return success($user, 'User Updated SuccessFully!');
    }
    public function userAddressList()
    {
        $user=User::find(Auth::user()->id);

        $recrod=DB::table('user_addresses')->where(['user_id'=>$user->id])->get();
        // return $recrod;
        return success($recrod,'');
    }
    public function userAddressUpdate(Request $request)
    {
        // $user=User::find();
        $userid=Auth::user()->id;
        $recrod=DB::table('user_addresses')->where(['user_id'=>$userid,'type'=>$request->type])->first();
        if($recrod)
        {
            // return "exist";
            DB::table('user_addresses')->where(['user_id'=>$userid,'type'=>$request->type])->update([
                'user_id'=>$userid,
                'address'=>$request->address,
                'type'=>$request->type,
                'lat'=>$request->lat,
                'lang'=>$request->lang
               ]);
        }
        else

        {
            // return "not exist";
            $address=DB::table('user_addresses')->insert([
                'user_id'=>$userid,
                'address'=>$request->address,
                'type'=>$request->type,
                'lat'=>$request->lat,
                'lang'=>$request->lang
               ]);
        }



       return success([], 'User Address Updated SuccessFully!');
    }

    public function fcmTokenUpdate(Request $request)
    {
        $user=User::find(Auth::user()->id);
        $user->fcm_token=$request->fcm_token;
        $user->save();
        return success([],'User fcm Updated SuccessFully!');
    }

}
