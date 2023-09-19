<?php
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\Auth\LoginController;
use App\Http\Controllers\Api\testapi\TestController;
use App\Http\Controllers\Api\resultapi\ResultController;


/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

// Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
//     return $request->user();
// });


/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

// Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
//     return $request->user();
// });

Route::prefix('v1')->group(function () {

 


    Route::middleware('auth:api')->group(function () {
      //test api
    Route::get('gettest',[TestController::class,'index']);
    Route::post('gettest',[TestController::class,'store']);
// result api
    Route::get('Result',[ResultController::class,'index']);
    Route::post('Result',[ResultController::class,'store']);
    



        // Student  side api
        // Route::group(['prefix'=>'student'], function(){






        //     // Result routes --------------------------------------------------------
            
        //     // Result routes --------------------------------------------------------

        // });
        

    });
});

