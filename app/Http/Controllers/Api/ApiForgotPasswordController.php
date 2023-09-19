<?php
namespace App\Http\Controllers\Api;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Password;
use Illuminate\Auth\Events\PasswordReset;
use Illuminate\Validation\Rules\Password as RulesPassword;
use App\Models\ResetCodePassword;
use App\Mail\SendCodeResetPassword;
use Mail;
use Illuminate\Support\Facades\Validator;
use App\Models\User;

class ApiForgotPasswordController extends Controller
{
    
        public function sendMail(Request $request)
        {
            
            $validator = Validator::make($request->all(), [
                'email' => 'required|email|exists:users',
            ]);
    
            if ($validator->fails()) return sendError('Validation Error.', $validator->errors(), 422);
            // Delete all old code that user send before.
            ResetCodePassword::where('email', $request->email)->delete();
            // Generate random code
            $data['code'] = mt_rand(1000,9999);
            $data['email'] = $request->email;
            // Create a new code
            $codeData = ResetCodePassword::create($data);
            // print_r($codeData->code);
            // die;
            // Send email to user
            Mail::to($request->email)->send(new SendCodeResetPassword($codeData->code));
            // return response(['message' => trans('passwords.sent')], 200);
            return success('We have emailed your password reset code !');
        }

        public function checkCode(Request $request)
        {
           
            $validator = Validator::make($request->all(), [
                'code' => 'required|string|exists:reset_code_passwords',
            ]);
    
            if ($validator->fails()) return error('Validation Error.', $validator->errors(), 422);
            // find the code
            $passwordReset = ResetCodePassword::firstWhere('code', $request->code);
            // check if it does not expired: the time is one hour
            if ($passwordReset->created_at > now()->addHour()) {
                $passwordReset->delete();
                // return response(['message' => trans('passwords.code_is_expire')], 422);
                return success('Code Expired', [], 422);
            }
            
            return success(['code'=>$passwordReset->code], 'Code is valid');
        }
        public function resetPasswordProcess(Request $request)
        {
           
            $validator = Validator::make($request->all(), [
                'code' => 'required|string|exists:reset_code_passwords',
                'password' => 'required|string|min:6|confirmed',
            ]);
    
            if ($validator->fails()) return error('Validation Error.', $validator->errors(), 422);
            // find the code
            $passwordReset = ResetCodePassword::firstWhere('code', $request->code);
            // check if it does not expired: the time is one hour
            if ($passwordReset->created_at > now()->addHour()) {
                $passwordReset->delete();
                return error('Code Expired', [], 422);
            }
            $user = User::firstWhere('email', $passwordReset->email);
            $user->update($request->only('password'));
            $user->update(['password'=>bcrypt($request->password)]);
            $passwordReset->delete();
            return success([], 'password has been successfully reset');
        }

}