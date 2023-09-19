<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class IsAllowed
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
     * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
     */
    public function handle(Request $request, Closure $next)
    {
        // pr($request->header('username'));
        // pr($request->header('password'));
        if ($request->header('username') == '' || $request->header('password') == '') {
            return response()->json(['Response_Code'=>'03','message'=>'Wrong Credientials']);
        }

        else if ($request->header('username') != env('KUICKPAY_USERNAME') || $request->header('password') != env('KUICKPAY_PASSWORD')) {
            return response()->json(['Response_Code'=>'03','message'=>'Wrong Credientials']);
        }
        else{
            
        }

  
        return $next($request);
    }
}
