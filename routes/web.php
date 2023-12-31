<?php

use App\Http\Controllers\Admin\BlogController;
use App\Http\Controllers\Admin\GroupController;
use App\Http\Controllers\Admin\CategoryController;
use App\Http\Controllers\Admin\ConfigController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\SubDivisionController;
use App\Http\Controllers\Admin\DivisionController;
use App\Http\Controllers\Admin\FeederController;
use App\Http\Controllers\Admin\SlabController;
use App\Http\Controllers\Admin\MeterController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\HomeController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\UserController;
// use App\Http\Controllers\CartController;
// use App\Http\Controllers\CourseController;
use App\Http\Controllers\ConsumerController;
use App\Http\Controllers\ConsumerCategoryController;
use App\Http\Controllers\Admin\ConsumerSubCategoryController;
use App\Http\Controllers\GeneralController;
use App\Http\Controllers\Admin\GeneralTaxController;
use App\Http\Controllers\PaymentController;
use App\Http\Controllers\Admin\ReadingController;
use App\Http\Controllers\Admin\BillGenerateController;
use App\Http\Controllers\Admin\ReaderGroupController;
use App\Http\Controllers\Admin\ChargesController;
use App\Http\Controllers\Admin\ChargesTypeController;
use App\Http\Controllers\Admin\TaxTypeController;
use App\Http\Controllers\Admin\ReportController;
use App\Http\Controllers\Admin\ReceivePaymentController;
// use App\Http\Controllers\QuestionController;
// use App\Http\Controllers\ResultController;
// use App\Http\Controllers\TestController;
use App\Models\Role;
use LDAP\Result;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/
Route::post('paymentGateWay/return_url', [PaymentController::class, 'gateWayRetrunUrl'])->middleware('auth');
Route::post('paymentGateWay/posting_url', [PaymentController::class, 'gateWayPostingUrl']);

Route::get('/', [HomeController::class, 'index'])->name('home');
Route::get('/single_bill/{id?}', [HomeController::class, 'single_bill'])->name('single.bill');
Auth::routes();
Route::get('logout', [LoginController::class, 'logout'])->name('logOut');
Route::get('/login/{social}',[LoginController::class,'socialLogin'])->where('social','twitter|facebook|linkedin|google|github|bitbucket');

Route::get('/login/{social}/callback',[LoginController::class,'handleProviderCallback'])->where('social','twitter|facebook|linkedin|google|github|bitbucket');

// Route::get('/home', 'HomeController@index')->name('home');

Route::get('about', [HomeController::class,'pageAbout'])->name('page.about');
Route::get('contact', [HomeController::class,'pageContact'])->name('page.contact');

Route::get('getCheckTime', [HomeController::class,'getCheckTime']);

Route::get('checkUserEmailExists', [HomeController::class, 'checkUserEmailExists']);


Route::get('course-breadcrumb', [CourseController::class, 'saveBreadcrumb'])->name('course.breadcurmb');

// Route::get('instructors', [InstructorController::class,'instructorList'])->name('instructor.list');
Route::post('contact-instructor', [InstructorController::class,'contactInstructor'])->name('contact.instructor');

Route::post('contact-admin', [HomeController::class,'contactAdmin'])->name('contact.admin');

Route::get('blogs', [HomeController::class,'blogList'])->name('blogs');
Route::get('blog/{blog_slug}', [HomeController::class,'blogView'])->name('blog.view');

 

//cart

Route::post('add-to-cart',[CartController::class,'addcart']);
Route::get('cart',[CartController::class,'cartview']);


//count cart





//Functions accessed by only authenticated users
Route::group(['middleware' => 'auth'], function () {

    Route::get('get_all_division_where',[GeneralController::class,'get_all_division_where'])->name('get_all_division_where');
    Route::get('get_all_sub_division_where',[GeneralController::class,'get_all_sub_division_where'])->name('get_all_sub_division_where');
    Route::get('get_all_feeder_where',[GeneralController::class,'get_all_feeder_where'])->name('get_all_feeder_where');
    
    Route::get('get_all_consumer_category_where',[GeneralController::class,'get_all_consumer_category_where'])->name('get_all_consumer_category_where');
    Route::get('get_all_consumer_sub_category_where',[GeneralController::class,'get_all_consumer_sub_category_where'])->name('get_all_consumer_sub_category_where');



    Route::get('load-cart-data',[CartController::class,'cartcount']);
    Route::get('cart-delete/{group_id}/{fee_type}',[CartController::class,'deletecart'])->name('delete.cart');

    //front invoices
    Route::post('checkout',[InvoiceController::class,'store']);
    // Route::get('invoice-detail',[InvoiceController::class,'index']);
    Route::get('getUserInvoice/{id?}',[InvoiceController::class,'getUserInvoice'])->name('getUserInvoice');
    Route::post('uploadReceipt/{id?}',[InvoiceController::class,'upload_file'])->name('upload_file');

    

    Route::post('delete-photo', [CourseController::class, 'deletePhoto']);
    Route::post('payment-form', [PaymentController::class, 'paymentForm'])->name('payment.form');

    Route::get('payment/success', [PaymentController::class, 'getSuccess'])->name('payment.success');
    Route::get('payment/failure', [PaymentController::class, 'getFailure'])->name('payment.failure');

    Route::get('my-courses', [CourseController::class, 'myCourses'])->name('my.courses');

    //Functions accessed by only students
    Route::group(['middleware' => 'role:student'], function () {

        Route::get('course-enroll-api/{course_slug}/{lecture_slug}/{is_sidebar}', [CourseController::class, 'courseEnrollAPI']);
        Route::get('readPDF/{file_id}', [CourseController::class, 'readPDF']);
        Route::get('update-lecture-status/{course_id}/{lecture_id}/{status}', [CourseController::class, 'updateLectureStatus']);

        Route::get('download-resource/{resource_id}/{course_slug}', [CourseController::class, 'getDownloadResource']);

        // Route::get('my-courses', [CourseController::class, 'myCourses'])->name('my.courses');
        // Route::get('course-learn/{course_slug}', [CourseController::class, 'courseLearn'])->name('course.learn');

        Route::post('course-rate', [CourseController::class, 'courseRate'])->name('course.rate');
        Route::get('delete-rating/{raing_id}', [CourseController::class, 'deleteRating'])->name('delete.rating');

        Route::get('course-enroll-api/{course_slug}/{lecture_slug}/{is_sidebar}', [CourseController::class, 'courseEnrollAPI']);
        Route::get('readPDF/{file_id}', [CourseController::class, 'readPDF']);

        Route::get('myPayments', [CartController::class, 'myPayments'])->name('myPayments');
        Route::post('upload_file', [InvoiceController::class, 'upload_file'])->name('upload_file');
        
    });

    //Functions accessed by both student and instructor
    // Route::group(['middleware' => 'role:student,instructor'], function () {
    Route::group(['middleware' => 'role:instructor'], function () {
        Route::get('consumer-dashboard', [ConsumerController::class, 'dashboard'])->name('consumer.dashboard');
     
    });


    //Functions accessed by only admin users
    Route::group(['middleware' => 'role:admin'], function () {
        // Route::get('my-courses', [CourseController::class, 'myCourses'])->name('my.courses');

        //consumer_categories routes
        Route::get('admin/consumer-category-list', [ConsumerCategoryController::class, 'index'])->name('admin.ccategory.list');
        Route::get('admin/consumer-category-form', [ConsumerCategoryController::class, 'create'])->name('admin.ccategory.form');
        Route::post('admin/consumer-category-store', [ConsumerCategoryController::class, 'store'])->name('admin.ccategory.store');
        Route::get('admin/consumer-category-edit/{id}', [ConsumerCategoryController::class, 'edit'])->name('admin.ccategory.edit');
        Route::post('admin/consumer-category-update/{id}', [ConsumerCategoryController::class, 'update'])->name('admin.ccategory.update');


         //Consumer Sub Category routes
         Route::get('admin/cons-sub-category-list', [ConsumerSubCategoryController::class, 'index'])->name('admin.cons-sub-category.list');
         Route::get('admin/cons-sub-category-form', [ConsumerSubCategoryController::class, 'create'])->name('admin.cons-sub-category.form');
         Route::post('admin/cons-sub-category-store', [ConsumerSubCategoryController::class, 'store'])->name('admin.cons-sub-category.store');
         Route::get('admin/cons-sub-category-edit/{id}', [ConsumerSubCategoryController::class, 'edit'])->name('admin.cons-sub-category.edit');
         Route::post('admin/cons-sub-category-update/{id}', [ConsumerSubCategoryController::class, 'update'])->name('admin.cons-sub-category.update');

         //Slabs routes
         Route::get('admin/slab-list', [SlabController::class, 'index'])->name('admin.slab.list');
         Route::get('admin/slab-form', [SlabController::class, 'create'])->name('admin.slab.form');
         Route::post('admin/slab-store', [SlabController::class, 'store'])->name('admin.slab.store');
         Route::get('admin/slab-edit/{id}', [SlabController::class, 'edit'])->name('admin.slab.edit');
         Route::post('admin/slab-update/{id}', [SlabController::class, 'update'])->name('admin.slab.update');


         //Division routes
         Route::get('admin/division-list', [DivisionController::class, 'index'])->name('admin.division.list');
         Route::get('admin/division-form', [DivisionController::class, 'create'])->name('admin.division.form');
         Route::post('admin/division-store', [DivisionController::class, 'store'])->name('admin.division.store');
         Route::get('admin/division-edit/{id}', [DivisionController::class, 'edit'])->name('admin.division.edit');
         Route::post('admin/division-update/{id}', [DivisionController::class, 'update'])->name('admin.division.update');

         //GeneralTax routes
         Route::get('admin/general-tax-list', [GeneralTaxController::class, 'index'])->name('admin.general-tax.list');
         Route::get('admin/general-tax-form', [GeneralTaxController::class, 'create'])->name('admin.general-tax.form');
         Route::post('admin/general-tax-store', [GeneralTaxController::class, 'store'])->name('admin.general-tax.store');
         Route::get('admin/general-tax-edit/{id}', [GeneralTaxController::class, 'edit'])->name('admin.general-tax.edit');
         Route::post('admin/general-tax-update/{id}', [GeneralTaxController::class, 'update'])->name('admin.general-tax.update');

        // Charges list
         Route::get('admin/charges-type-list', [ChargesTypeController::class, 'index'])->name('admin.charges.type.list');
         Route::get('admin/charges-type-form', [ChargesTypeController::class, 'create'])->name('admin.charges.type.form');
         Route::post('admin/charges-type-store', [ChargesTypeController::class, 'store'])->name('admin.charges.type.store');
         Route::get('admin/charges-type-edit/{id}', [ChargesTypeController::class, 'edit'])->name('admin.charges.type.edit');
         Route::post('admin/charges-type-update/{id}', [ChargesTypeController::class, 'update'])->name('admin.charges.type.update');

         // Tax Type Route
         Route::get('admin/tax-type-list', [TaxTypeController::class, 'index'])->name('admin.tax.type.list');
         Route::get('admin/tax-type-form', [TaxTypeController::class, 'create'])->name('admin.tax.type.form');
         Route::post('admin/tax-type-store', [TaxTypeController::class, 'store'])->name('admin.tax.type.store');
         Route::get('admin/tax-type-edit/{id}', [TaxTypeController::class, 'edit'])->name('admin.tax.type.edit');
         Route::post('admin/tax-type-update/{id}', [TaxTypeController::class, 'update'])->name('admin.tax.type.update');

         Route::get('admin/charges-list', [ChargesController::class, 'index'])->name('admin.charges.list');
         Route::get('admin/charges-form', [ChargesController::class, 'create'])->name('admin.charges.form');
         Route::post('admin/charges-store', [ChargesController::class, 'store'])->name('admin.charges.store');
         Route::get('admin/charges-edit/{id}', [ChargesController::class, 'edit'])->name('admin.charges.edit');
         Route::post('admin/charges-update/{id}', [ChargesController::class, 'update'])->name('admin.charges.update');

        //  meter routes

        Route::get('admin/meter-list', [MeterController::class, 'index'])->name('admin.meter.list');
        Route::get('admin/meter-form', [MeterController::class, 'create'])->name('admin.meter.form');
        Route::post('admin/meter-store', [MeterController::class, 'store'])->name('admin.meter.store');
        Route::get('admin/meter-edit/{id}', [MeterController::class, 'edit'])->name('admin.meter.edit');
        Route::post('admin/meter-update/{id}', [MeterController::class, 'update'])->name('admin.meter.update');



          //Sub Division routes
          Route::get('admin/sub-division-list', [SubDivisionController::class, 'index'])->name('admin.sub_division.list');
          Route::get('admin/sub-division-form', [SubDivisionController::class, 'create'])->name('admin.sub_division.form');
          Route::post('admin/sub-division-store', [SubDivisionController::class, 'store'])->name('admin.sub_division.store');
          Route::get('admin/sub-division-edit/{id}', [SubDivisionController::class, 'edit'])->name('admin.sub_division.edit');
          Route::post('admin/sub-division-update/{id}', [SubDivisionController::class, 'update'])->name('admin.sub_division.update');

          //Feeder routes
          Route::get('admin/feeder-list', [FeederController::class, 'index'])->name('admin.feeder.list');
          Route::get('admin/feeder-form', [FeederController::class, 'create'])->name('admin.feeder.form');
          Route::post('admin/feeder-store', [FeederController::class, 'store'])->name('admin.feeder.store');
          Route::get('admin/feeder-edit/{id}', [FeederController::class, 'edit'])->name('admin.feeder.edit');
          Route::post('admin/feeder-update/{id}', [FeederController::class, 'update'])->name('admin.feeder.update');



        // consumer module
        Route::get('consumer-lists', [ConsumerController::class, 'consumer_show'])->name('consumer.lists');
        Route::get('consumer-form', [ConsumerController::class, 'consumer_form'])->name('consumer.form');
        Route::get('consumer-import-form', [ConsumerController::class, 'consumer_import_form'])->name('consumer.import.form');
        Route::post('consumer-import-form-process', [ConsumerController::class, 'consumer_import_form_process'])->name('consumer.import.form.process');
        Route::post('consumer-form', [ConsumerController::class, 'consumer_save'])->name('consumer.save');
        Route::get('consumer-form-edit/{id}', [ConsumerController::class, 'consumer_edit'])->name('consumer.edit');
        Route::post('consumer-form-update/{id}', [ConsumerController::class, 'consumer_update'])->name('consumer.update');
        Route::get('consumer-disable/{id}', [ConsumerController::class, 'consumer_disable'])->name('consumer.disable');

         // Bill Generate Routes
         Route::get('bill-generate-lists', [BillGenerateController::class, 'show'])->name('bill.generate.lists');
         Route::get('bill-generate-form', [BillGenerateController::class, 'form'])->name('bill.generate.form');
         Route::post('bill-generate-form', [BillGenerateController::class, 'save'])->name('bill.generate.save');

         Route::post('bill-generate-load_statistics_view', [BillGenerateController::class, 'load_statistics_view'])->name('bill.generate.load_statistics_view');
         
         Route::get('bill-generate-form-edit/{id}', [BillGenerateController::class, 'edit'])->name('bill.generate.edit');
         Route::post('bill-generate-form-update/{id}', [BillGenerateController::class, 'update'])->name('bill.generate.update');
         Route::get('bill-generate-disable/{id}', [BillGenerateController::class, 'reading_disable'])->name('bill.generate.disable');

         Route::get('reader-group-lists', [ReaderGroupController::class, 'show'])->name('reader.group.lists');
         Route::get('reader-group-form/{id?}', [ReaderGroupController::class, 'form'])->name('reader.group.form');
         Route::post('reader-group-form', [ReaderGroupController::class, 'save'])->name('reader.group.save');

        // Bill Adjustment
        Route::get('bill-adjustment-lists', [BillGenerateController::class, 'adjustment_show'])->name('bill.adjustment.lists');
        Route::get('bill-adjustment-form', [BillGenerateController::class, 'adjustment_form'])->name('bill.adjustment.form');
        Route::post('bill-adjustment-save', [BillGenerateController::class, 'adjustment_save'])->name('bill.adjustment.save');
        
        // Reading Routes
        Route::get('meter-reading-lists', [ReadingController::class, 'reading_show'])->name('reading.lists');
        Route::get('meter-reading-form', [ReadingController::class, 'reading_form'])->name('reading.form');
        Route::post('meter-reading-form', [ReadingController::class, 'reading_save'])->name('reading.save');

        Route::get('get_data_agaist_reading', [ReadingController::class, 'get_data_agaist_reading'])->name('get_data_agaist_reading');
        

        Route::get('meter-reading-edit/{id}', [ReadingController::class, 'reading_edit'])->name('reading.edit');
        Route::post('meter-reading-update/{id}', [ReadingController::class, 'reading_update'])->name('reading.update');
        Route::get('meter-reading-disable/{id}', [ReadingController::class, 'reading_disable'])->name('reading.disable');

        Route::get('get_meter_info_against_ref_no', [GeneralController::class, 'get_meter_info_against_ref_no'])->name('get_meter_info_against_ref_no');
        

        Route::get('meter-reading-approve-lists', [ReadingController::class, 'reading_approve_show'])->name('reading.approve.lists');
        Route::get('meter-reading-approve-form', [ReadingController::class, 'reading_approve_form'])->name('reading.approve.form');
        // Route::get('meter-reading-approve-form', [ReadingController::class, 'reading_approve_form'])->name('reading.approve.form');
        // Route::post('meter-reading-approve-form', [ReadingController::class, 'reading_approve_save'])->name('reading.save');
        // Route::get('meter-reading-approve-form-edit/{id}', [ReadingController::class, 'reading_approve_edit'])->name('reading.edit');
        // Route::post('meter-reading-approve-form-update/{id}', [ReadingController::class, 'reading_update'])->name('reading.update');
        Route::post('meter-reading-approve', [ReadingController::class, 'reading_approve'])->name('reading.approve');

        // Route::get('get_meter_info_against_ref_no', [GeneralController::class, 'get_meter_info_against_ref_no'])->name('get_meter_info_against_ref_no');
        // Route::get('assignMeter/{consumer_id}', [ConsumerController::class, 'assignMeter'])->name('consumer.assignMeter');
        
        Route::get('getSubDivisionsAgainstDivision', [SubDivisionController::class, 'getSubDivisionsAgainstDivision'])->name('subDivision.getSubDivisionsAgainstDivision');
        Route::get('getFeedersAgainstSubDivision', [FeederController::class, 'getFeedersAgainstSubDivision'])->name('feeder.getFeedersAgainstSubDivision');

        // payment Routes
        Route::get('receive-payment-lists', [ReceivePaymentController::class, 'show'])->name('receive.payment.lists');
        Route::get('receive-payment-form', [ReceivePaymentController::class, 'add_form'])->name('receive.payment.form');
        Route::get('get-user-bill', [ReceivePaymentController::class, 'get_user_bill'])->name('get_user_bill');
        Route::post('receive-payment-save', [ReceivePaymentController::class, 'save'])->name('receive.payment.save');
        // Route::get('meter-reading-edit/{id}', [ReceivePaymentController::class, 'reading_edit'])->name('reading.edit');
        // Route::post('meter-reading-update/{id}', [ReceivePaymentController::class, 'reading_update'])->name('reading.update');
        Route::get('receive-payment-disable/{id}', [ReceivePaymentController::class, 'receive_payment_disable'])->name('receive.payment.disable');

        Route::get('admin/dashboard', DashboardController::class)->name('admin.dashboard');

        Route::get('admin/users', [UserController::class, 'index'])->name('admin.users');
        Route::get('admin/user-form', [UserController::class, 'getForm'])->name('admin.getForm');
        Route::get('admin/user-form/{user_id}', [UserController::class, 'getForm']);
        Route::post('admin/save-user', [UserController::class, 'saveUser'])->name('admin.saveUser');
        Route::get('admin/users/getData', [UserController::class, 'getData'])->name('admin.users.getData');

        // Route::get('admin/categories', [CategoryController::class, 'index'])->name('admin.categories');
        // Route::get('admin/category-form/{Category_id}', [CategoryController::class, 'getForm']);
        // Route::get('admin/category-form', [CategoryController::class, 'getForm'])->name('admin.categoryForm');
        // Route::post('admin/save-category', [CategoryController::class, 'saveCategory'])->name('admin.saveCategory');
        // Route::get('admin/delete-category/{Category_id}', [CategoryController::class, 'deleteCategory']);

        // Route::get('admin/group', [GroupController::class, 'index'])->name('admin.groups');
        // // Route::get('admin/group-form/{Category_id}', [GroupController::class, 'getForm']);
        // Route::get('admin/group-form', [GroupController::class, 'getForm'])->name('admin.groupForm');
        // Route::post('admin/save-group', [GroupController::class, 'saveGroup'])->name('admin.saveGroup');
        // Route::get('admin/view-courses/{id}', [GroupController::class, 'viewcourses'])->name('admin.view.courses');
 
        //course test
        Route::get('admin/view-course-test/{id}', [GroupController::class, 'viewcoursestest'])->name('admin.view.courses.test');
        
        Route::get('admin/blogs', [BlogController::class, 'index'])->name('admin.blogs');
        Route::get('admin/blog-form', [BlogController::class, 'getForm'])->name('admin.blogForm');
        Route::get('admin/blog-form/{blog_id}', [BlogController::class, 'getForm']);
        Route::post('admin/save-blog', [BlogController::class, 'saveBlog'])->name('admin.saveBlog');
        Route::get('admin/delete-blog/{blog_id}', [BlogController::class, 'deleteBlog']);

        Route::get('admin/withdraw-requests', [DashboardController::class, 'withdrawRequests'])->name('admin.withdraw.requests');
        Route::get('admin/approve-withdraw-request/{request_id}', [DashboardController::class, 'approveWithdrawRequest'])->name('admin.approve.withdraw.request');

        Route::post('admin/config/save-config', [ConfigController::class, 'saveConfig'])->name('admin.saveConfig');
        Route::get('admin/config/page-home', [ConfigController::class, 'pageHome'])->name('admin.pageHome');
        Route::get('admin/config/page-about', [ConfigController::class, 'pageAbout'])->name('admin.pageAbout');
        Route::get('admin/config/page-contact', [ConfigController::class, 'pageContact'])->name('admin.pageContact');

        Route::get('admin/config/setting-general', [ConfigController::class, 'settingGeneral'])->name('admin.settingGeneral');
        Route::get('admin/config/setting-payment', [ConfigController::class, 'settingPayment'])->name('admin.settingPayment');
        Route::get('admin/config/setting-charge', [ConfigController::class, 'settingCharge'])->name('admin.settingCharge');
        //category
        
        Route::get('admin/config/setting-category', [ConfigController::class, 'categoryIndex'])->name('admin.categoryIndex');
        Route::get('admin/config/setting-categoryform', [ConfigController::class, 'categorygetForm'])->name('admin.categoryform');;
        Route::post('admin/config/setting-categoryform', [ConfigController::class, 'saveMasterCategory'])->name('admin.saveMasterCategory');
        Route::get('admin/config/setting-category/{Category_id}', [ConfigController::class, 'categorygetForm']);
        Route::get('admin/config/delete-category/{Category_id}', [ConfigController::class, 'deleteMasterCategory']);
        //course
        Route::get('admin/config/course-list', [ConfigController::class, 'instructorCourseList'])->name('admin.course.list');
        Route::get('admin/config/setting-course', [ConfigController::class, 'instructorCourseInfo'])->name('admin.settingCourse');
        Route::post('admin/config/setting-course', [ConfigController::class, 'instructorCourseInfoSave'])->name('admin.settingCourse.save');
        Route::get('admin/config/delete-course/{course_id}', [ConfigController::class, 'deleteMasterCourse']);
        Route::get('admin/config/course-edit/{course_id}', [ConfigController::class, 'instructorCourseInfo'])->name('admin.settingCourse.edit');
        Route::get('admin/config/setting-email', [ConfigController::class, 'settingEmail'])->name('admin.settingEmail');
        
        //admin side invoice 
        // Route::get('admin/invoice-list', [InvoiceController::class, 'admin_invoice_list'])->name('admin.invoice.list');
        // Route::post('admin/makeReceipt', [InvoiceController::class, 'makeReceipt'])->name('admin.invoice.makeReceipt');
        // Route::get('admin/invoice-form', [InvoiceController::class, 'admin_invoice'])->name('admin.invoice');
        // Route::post('admin/invoice-form', [InvoiceController::class, 'admin_send_invoice'])->name('admin.send.invoice');
        // Route::get('admin/invoice-delete/{id}', [InvoiceController::class, 'admin_invoice_delete'])->name('admin.invoice.delete');
        // Route::get('admin/invoice-form-edit/{id}', [InvoiceController::class, 'admin_invoice_edit'])->name('admin.invoice.edit');
        // Route::post('admin/invoice-form-update/{id}', [InvoiceController::class, 'admin_invoice_update'])->name('admin.invoice.update');

        Route::get('admin/report/reading_report_form', [ReportController::class, 'reading_report_form'])->name('admin.report.reading.form');
        Route::post('admin/report/reading_report_process', [ReportController::class, 'reading_report_process'])->name('admin.report.reading.process');

        Route::get('admin/report/payment_report_form', [ReportController::class, 'payment_report_form'])->name('admin.report.payment.form');
        Route::post('admin/report/payment_report_process', [ReportController::class, 'payment_report_process'])->name('admin.report.payment.process');

        Route::get('admin/report/bill_report_form', [ReportController::class, 'bill_report_form'])->name('admin.report.bill.form');
        Route::post('admin/report/bill_report_process', [ReportController::class, 'bill_report_process'])->name('admin.report.bill.process');

        Route::get('admin/report/consumer_report_form', [ReportController::class, 'consumer_report_form'])->name('admin.report.consumer.form');
        Route::post('admin/report/consumer_report_process', [ReportController::class, 'consumer_report_process'])->name('admin.report.consumer.process');

});

    Route::group(['middleware' => 'subscribed'], function () {
        //Route for react js
        Route::get('course-enroll/{course_slug}/{lecture_slug}', function () {
            // dd('testings');
            return view('site/course/course_enroll');
        });
        Route::get('course-learn/{course_slug}', [CourseController::class, 'courseLearn'])->name('course.learn');
    });

   
});
