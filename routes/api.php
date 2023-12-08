<?php
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\Auth\LoginController;
use App\Http\Controllers\Api\ApiDashboardController;
use App\Http\Controllers\Api\Student\ApiCoursesController;
use App\Http\Controllers\Api\ApiForgotPasswordController;
// use App\Http\Controllers\Api\ApiPaymentController;
use App\Http\Controllers\Api\KuickPayPaymentController;
use App\Http\Controllers\Api\ApiReadingController;
// use App\Http\Controllers\Api\Student\ApiTestController;
// use App\Http\Controllers\Api\Student\ApiResultController;
// use App\Http\Controllers\Api\testapi\TestController;
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
    Route::post('login', [LoginController::class, 'login']);
    // Route::post('register', [LoginController::class, 'register']);
   
    
    // Route::post('forgot-password', [LoginController::class, 'forgot_password']);
    // Route::get('/dashboard', [ApiDashboardController::class, 'index']);
    // Route::post('/courseList', [ApiCoursesController::class, 'courseList']);

    //student routes



    Route::middleware('auth:api')->group(function () {
        Route::post('logout', [LoginController::class, 'logout']);

        Route::get('get_month', [ApiReadingController::class, 'get_month']);
        Route::get('get_list_for_reading', [ApiReadingController::class, 'get_list_for_reading']);
        Route::post('reading_save', [ApiReadingController::class, 'reading_save']);
        // Student  side api
        Route::group(['prefix'=>'student'], function(){

            // courses related routes  ------------------------------------------------
            // Route::get('/myCourses', [ApiCoursesController::class, 'myCourses']);
            // same as web course-learn/{course_slug} web.php route
            // Route::post('/getCourseById', [ApiCoursesController::class, 'getCourseById']);
            // Route::post('/getCourseVideos', [ApiCoursesController::class, 'getCourseVideos']);
            // courses related routes  ------------------------------------------------


             // Payments routes --------------------------------------------------------
             //Similar to web route myPayments CartController::class, 'myPayments'
            //  Route::get('/myPayments', [ApiPaymentController::class, 'myPayments']);
            //  Route::post('/getInvoiceById', [ApiPaymentController::class, 'getInvoiceById']);

            // Route::post('/createInvoice', [ApiPaymentController::class, 'createInvoice']);
            // Route::post('/uploadReceipt', [ApiPaymentController::class, 'upload_file']);
            // similar to web uploadReceipt
            // Payments routes --------------------------------------------------------
        


            // Tests  routes  --------------------------------------------------------
            // Route::get('/myTests', [ApiTestController::class, 'myTests']);
            // Route::post('/getCourseTests', [ApiTestController::class, 'getCourseTests']);
            // Route::post('/getTestQuestions', [ApiTestController::class, 'getTestQuestions']);
            // Route::post('/postAnswers', [ApiTestController::class, 'postAnswers']);
            // Tests  routes  --------------------------------------------------------



            // Result routes --------------------------------------------------------
            // Route::get('/myResultsCourses', [ApiResultController::class, 'myResultsCourses']);
            // Route::post('/myResultsTests', [ApiResultController::class, 'myResultsTests']);
            // Route::post('/myFinalResults', [ApiResultController::class, 'myFinalResults']);
            // Result routes --------------------------------------------------------

        });
    });


    //  Route::group(['prefix'=>'request'], function(){
          Route::post('/BillInquiry', [KuickPayPaymentController::class, 'getInvoiceData'])->middleware(['IsAllowed']);
          Route::post('/BillPayment', [KuickPayPaymentController::class, 'updateInvoiceData'])->middleware(['IsAllowed']);

    //  });
    // Route::post('/userInfoUpdate/{id}', [LoginController::class, 'userInfoUpdate']);
    // Route::post('/userInfoUpdate', [LoginController::class, 'userInfoUpdate']);
    // Route::post('/userAddressUpdate', [LoginController::class, 'userAddressUpdate']);
    // Route::post('/fcmTokenUpdate', [LoginController::class, 'fcmTokenUpdate']);
    // Route::post('change-password', [LoginController::class, 'change_password']);
    //get cureent User To update Token
    Route::get('/getUser', [LoginController::class, 'getUser']);
    // Route::post('/getUser', [LoginController::class, 'getUser']);
    // Route::post('/feedback', [GlobalController::class, 'feedback']);
    // Route::post('/store_feedback', [GlobalController::class, 'store_feedback'])->middleware('auth:api');
    // Route::post('change_order_status', [GlobalController::class, 'changeOrderStatus'])->name('change_order_status');



    Route::post('password/email',  [ApiForgotPasswordController::class,'sendMail']);
    Route::post('password/code/check', [ApiForgotPasswordController::class,'checkCode']);
    Route::post('password/reset', [ApiForgotPasswordController::class,'resetPasswordProcess']);


   

});


