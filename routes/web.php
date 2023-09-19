<?php

use App\Http\Controllers\Admin\BlogController;
use App\Http\Controllers\Admin\GroupController;
use App\Http\Controllers\Admin\CategoryController;
use App\Http\Controllers\Admin\ConfigController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\HomeController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\CartController;
use App\Http\Controllers\CourseController;
use App\Http\Controllers\InstructorController;
use App\Http\Controllers\InvoiceController;
use App\Http\Controllers\PaymentController;
use App\Http\Controllers\QuestionController;
use App\Http\Controllers\ResultController;
use App\Http\Controllers\TestController;
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
Auth::routes();
Route::get('logout', [LoginController::class, 'logout'])->name('logOut');
Route::get('/login/{social}',[LoginController::class,'socialLogin'])->where('social','twitter|facebook|linkedin|google|github|bitbucket');

Route::get('/login/{social}/callback',[LoginController::class,'handleProviderCallback'])->where('social','twitter|facebook|linkedin|google|github|bitbucket');

// Route::get('/home', 'HomeController@index')->name('home');

Route::get('about', [HomeController::class,'pageAbout'])->name('page.about');
Route::get('contact', [HomeController::class,'pageContact'])->name('page.contact');
Route::get('instructor/{instructor_slug}', [InstructorController::class,'instructorView'])->name('instructor.view');

Route::get('getCheckTime', [HomeController::class,'getCheckTime']);

Route::get('checkUserEmailExists', [HomeController::class, 'checkUserEmailExists']);

Route::get('course-view/{course_slug}', [CourseController::class, 'courseView'])->name('course.view');
Route::get('courses', [CourseController::class, 'courseList'])->name('course.list');
Route::post('getCourseListAgainstGroup', [CourseController::class, 'getCourseListAgainstGroup'])->name('course.getCourseListAgainstGroup');
Route::get('checkout/{course_slug}', [CourseController::class, 'checkout'])->name('course.checkout');
Route::get('course-breadcrumb', [CourseController::class, 'saveBreadcrumb'])->name('course.breadcurmb');

Route::post('become-instructor', [InstructorController::class,'becomeInstructor'])->name('become.instructor');

Route::get('instructors', [InstructorController::class,'instructorList'])->name('instructor.list');
Route::get('applyTest', [TestController::class,'applyTest'])->name('test.applyTest');
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
        Route::get('instructor-dashboard', [InstructorController::class, 'dashboard'])->name('instructor.dashboard');

        Route::get('instructor-profile', [InstructorController::class, 'getProfile'])->name('instructor.profile.get');
        Route::post('instructor-profile', [InstructorController::class, 'saveProfile'])->name('instructor.profile.save');

        Route::get('course-create', [CourseController::class, 'createInfo'])->name('instructor.course.create');
        // Route::get('instructor-course-list', [CourseController::class, 'instructorCourseList'])->name('instructor.course.list');
        // Route::get('instructor-course-info', [CourseController::class, 'instructorCourseInfo'])->name('instructor.course.info');
        // Route::get('instructor-course-info/{course_id}', [CourseController::class, 'instructorCourseInfo'])->name('instructor.course.info.edit');
        // Route::post('instructor-course-info-save', [CourseController::class, 'instructorCourseInfoSave'])->name('instructor.course.info.save');

        // Route::get('instructor-course-image', [CourseController::class, 'instructorCourseImage'])->name('instructor.course.image');
        // Route::get('instructor-course-image/{course_id}', [CourseController::class, 'instructorCourseImage'])->name('instructor.course.image.edit');
        // Route::post('instructor-course-image-save', [CourseController::class, 'instructorCourseImageSave'])->name('instructor.course.image.save');

        // Route::get('instructor-course-video/{course_id}', [CourseController::class, 'instructorCourseVideo'])->name('instructor.course.video.edit');
        // Route::post('instructor-course-video-save', [CourseController::class, 'instructorCourseVideoSave'])->name('instructor.course.video.save');

        // Route::get('instructor-course-curriculum/{course_id}', [CourseController::class, 'instructorCourseCurriculum'])->name('instructor.course.curriculum.edit');
        // Route::post('instructor-course-curriculum-save', [CourseController::class, 'instructorCourseCurriculumSave'])->name('instructor.course.curriculum.save');

        //instructor side 
        




        Route::get('instructor-credits', [InstructorController::class, 'credits'])->name('instructor.credits');

        Route::post('instructor-withdraw-request', [InstructorController::class, 'withdrawRequest'])->name('instructor.withdraw.request');

        Route::get('instructor-withdraw-requests', [InstructorController::class, 'listWithdrawRequests'])->name('instructor.list.withdraw');

        // Save Curriculum
        Route::post('courses/section/save', [CourseController::class, 'postSectionSave']);
        Route::post('courses/section/delete', [CourseController::class, 'postSectionDelete']);
        Route::post('courses/lecture/save', [CourseController::class, 'postLectureSave']);
        Route::post('courses/video', [CourseController::class, 'postVideo']);

        Route::post('courses/lecturequiz/delete', [CourseController::class, 'postLectureQuizDelete']);
        Route::post('courses/lecturedesc/save', [CourseController::class, 'postLectureDescSave']);
        Route::post('courses/lecturepublish/save', [CourseController::class, 'postLecturePublishSave']);
        Route::post('courses/lecturevideo/save/{lid}', [CourseController::class, 'postLectureVideoSave']);
        Route::post('courses/lectureaudio/save/{lid}', [CourseController::class, 'postLectureAudioSave']);
        Route::post('courses/lecturepre/save/{lid}', [CourseController::class, 'postLecturePresentationSave']);
        Route::post('courses/lecturedoc/save/{lid}', [CourseController::class, 'postLectureDocumentSave']);
        Route::post('courses/lectureres/save/{lid}', [CourseController::class, 'postLectureResourceSave']);
        Route::post('courses/lecturetext/save', [CourseController::class, 'postLectureTextSave']);
        Route::post('courses/lectureres/delete', [CourseController::class, 'postLectureResourceDelete']);
        Route::post('courses/lecturelib/save', [CourseController::class, 'postLectureLibrarySave']);
        Route::post('courses/lecturelibres/save', [CourseController::class, 'postLectureLibraryResourceSave']);
        Route::post('courses/lectureexres/save', [CourseController::class, 'postLectureExternalResourceSave']);

        // Sorting Curriculum
        Route::post('courses/curriculum/sort', [CourseController::class, 'postCurriculumSort']);
    });


    //Functions accessed by only admin users
    Route::group(['middleware' => 'role:admin'], function () {
        // Route::get('my-courses', [CourseController::class, 'myCourses'])->name('my.courses');

        // instructor module
        Route::get('instructor-lists', [InstructorController::class, 'instructor_show'])->name('instructor.lists');
        Route::get('instructor-form', [InstructorController::class, 'instructor_form'])->name('instructor.form');
        Route::post('instructor-form', [InstructorController::class, 'instructor_save'])->name('instructor.save');
        Route::get('instructor-form-edit/{id}', [InstructorController::class, 'instructor_edit'])->name('instructor.edit');
        Route::post('instructor-form-update/{id}', [InstructorController::class, 'instructor_update'])->name('instructor.update');
        Route::get('instructor-disable/{id}', [InstructorController::class, 'instructor_disable'])->name('instructor.disable');



        Route::get('admin/dashboard', DashboardController::class)->name('admin.dashboard');

        Route::get('admin/users', [UserController::class, 'index'])->name('admin.users');
        Route::get('admin/user-form', [UserController::class, 'getForm'])->name('admin.getForm');
        Route::get('admin/user-form/{user_id}', [UserController::class, 'getForm']);
        Route::post('admin/save-user', [UserController::class, 'saveUser'])->name('admin.saveUser');
        Route::get('admin/users/getData', [UserController::class, 'getData'])->name('admin.users.getData');

        Route::get('admin/categories', [CategoryController::class, 'index'])->name('admin.categories');
        Route::get('admin/category-form/{Category_id}', [CategoryController::class, 'getForm']);
        Route::get('admin/category-form', [CategoryController::class, 'getForm'])->name('admin.categoryForm');
        Route::post('admin/save-category', [CategoryController::class, 'saveCategory'])->name('admin.saveCategory');
        Route::get('admin/delete-category/{Category_id}', [CategoryController::class, 'deleteCategory']);

        Route::get('admin/group', [GroupController::class, 'index'])->name('admin.groups');
        // Route::get('admin/group-form/{Category_id}', [GroupController::class, 'getForm']);
        Route::get('admin/group-form', [GroupController::class, 'getForm'])->name('admin.groupForm');
        Route::post('admin/save-group', [GroupController::class, 'saveGroup'])->name('admin.saveGroup');
        Route::get('admin/view-courses/{id}', [GroupController::class, 'viewcourses'])->name('admin.view.courses');
 
        //course test
        Route::get('admin/view-course-test/{id}', [GroupController::class, 'viewcoursestest'])->name('admin.view.courses.test');


        // Route::get('admin/group-category/{Category_id}', [GroupController::class, 'deleteGroup']);

        // courses
        Route::get('instructor-course-list', [CourseController::class, 'instructorCourseList'])->name('instructor.course.list');
        Route::get('instructor-course-info', [CourseController::class, 'instructorCourseInfo'])->name('instructor.course.info');
        Route::get('instructor-course-info/{course_id}', [CourseController::class, 'instructorCourseInfo'])->name('instructor.course.info.edit');
        Route::post('instructor-course-info-save', [CourseController::class, 'instructorCourseInfoSave'])->name('instructor.course.info.save');

        Route::get('instructor-course-image', [CourseController::class, 'instructorCourseImage'])->name('instructor.course.image'); // used
        Route::get('instructor-course-image/{course_id}', [CourseController::class, 'instructorCourseImage'])->name('instructor.course.image.edit');
        Route::post('instructor-course-image-save', [CourseController::class, 'instructorCourseImageSave'])->name('instructor.course.image.save'); // used

        Route::get('instructor-course-video/{course_id}', [CourseController::class, 'instructorCourseVideo'])->name('instructor.course.video.edit'); // used
        Route::post('instructor-course-video-save', [CourseController::class, 'save_youtube_link'])->name('instructor.course.video.save');
        Route::post('instructor-course-video-delete/', [CourseController::class, 'instructorCourseVideoDelete'])->name('instructor.course.video.delete');
        // Route::post('instructor-course-video-save', [CourseController::class, 'instructorCourseVideoSave'])->name('instructor.course.video.save');


        Route::get('instructor-course-curriculum/{course_id}', [CourseController::class, 'instructorCourseCurriculum'])->name('instructor.course.curriculum.edit');
        Route::post('instructor-course-curriculum-save', [CourseController::class, 'instructorCourseCurriculumSave'])->name('instructor.course.curriculum.save');


        
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
        Route::get('admin/invoice-list', [InvoiceController::class, 'admin_invoice_list'])->name('admin.invoice.list');
        Route::post('admin/makeReceipt', [InvoiceController::class, 'makeReceipt'])->name('admin.invoice.makeReceipt');
        Route::get('admin/invoice-form', [InvoiceController::class, 'admin_invoice'])->name('admin.invoice');
        Route::post('admin/invoice-form', [InvoiceController::class, 'admin_send_invoice'])->name('admin.send.invoice');
        Route::get('admin/invoice-delete/{id}', [InvoiceController::class, 'admin_invoice_delete'])->name('admin.invoice.delete');
        Route::get('admin/invoice-form-edit/{id}', [InvoiceController::class, 'admin_invoice_edit'])->name('admin.invoice.edit');
        Route::post('admin/invoice-form-update/{id}', [InvoiceController::class, 'admin_invoice_update'])->name('admin.invoice.update');

        //admin test creation
        Route::get('admin/test-form', [TestController::class, 'create'])->name('admin.test');
        Route::post('admin/test-form', [TestController::class, 'store'])->name('admin.send.test');
        Route::get('admin/test-list', [TestController::class, 'index'])->name('admin.test.list');
        Route::get('admin/test-delete/{id}', [TestController::class, 'destroy'])->name('admin.test.delete');
        Route::get('admin/test-edit{id}', [TestController::class, 'edit'])->name('admin.test.edit');
        Route::post('admin/test-update/{id}', [TestController::class, 'update'])->name('admin.test.update');

        //admin question creation
        Route::get('admin/question-form', [QuestionController::class, 'create'])->name('admin.question');

        Route::post('admin/question-form', [QuestionController::class, 'store'])->name('admin.send.question');
        //ck editors images
        Route::post('admin/question-name', [QuestionController::class, 'question_image'])->name('question_name.image');
        Route::post('admin/question-option-1', [QuestionController::class, 'question_option_1'])->name('question_option_1.image');
        Route::post('admin/question-option-2', [QuestionController::class, 'question_option_2'])->name('question_option_2.image');
        Route::post('admin/question-option-3', [QuestionController::class, 'question_option_3'])->name('question_option_3.image');
        Route::post('admin/question-option-4', [QuestionController::class, 'question_option_4'])->name('question_option_4.image');
        //
        Route::get('admin/question-list', [QuestionController::class, 'index'])->name('admin.question.list');
        Route::get('admin/question-delete/{id}', [QuestionController::class, 'destroy'])->name('admin.question.delete');
        Route::get('admin/question-edit{id}', [QuestionController::class, 'edit'])->name('admin.question.edit');
        Route::post('admin/question-update/{id}', [QuestionController::class, 'update'])->name('admin.question.update');
    
        //admin result
        Route::get('admin/result-list', [ResultController::class, 'index'])->name('admin.result.list');

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
