<?php
/**
 * PHP Version 7.1.7-1
 * Functions for users
 *
 * @category  File
 * @package   Config
 * @author    Mohamed Yahya
 * @copyright ULEARN  
 * @license   BSD Licence
 * @link      Link
 */
namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Config;
use App\Models\InstructionLevel;
use App\Models\Instructor;
use App\Models\MasterCategory;
use App\Models\MasterCourse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use DB;
use Illuminate\Support\Facades\Request as Input;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use Image;
use SiteHelpers;

/**
 * Class contain functions for admin
 *
 * @category  Class
 * @package   Config
 * @author    Mohamed Yahya
 * @copyright ULEARN
 * @license   BSD Licence
 * @link      Link
 */
class ConfigController extends Controller
{
   
    public function saveConfig(Request $request)
    {
        $files = Input::file();

        //get the input values from form
        $input = $request->all();
        $code = $request->input('code');

        unset($input['_token']);
        unset($input['code']);

        foreach($files as $file_key => $file_array) {
            //delete old file
            if (Storage::exists($input['old_'.$file_key])) {
                Storage::delete($input['old_'.$file_key]);
            }
            unset($input['old_'.$file_key]);
            //save the file in original name
            $file_name = $request->file($file_key)->getClientOriginalName();
            // create path
            $path = "config";

            //check if the file name is already exists
            $new_file_name = SiteHelpers::checkFileName($path, $file_name);

            $path = $request->file($file_key)->storeAs($path, $new_file_name);
            
            //upload the image and save the image name in array, to save it in DB
            $input[$file_key] = $path;
        }

        //save the 
        Config::save_options($code, $input);
        return $this->return_output('flash', 'success', 'saved', 'back', '200');
    }

    public function pageHome(Request $request)
    {
        $config = Config::get_options('pageHome');
        return view('admin.config.page_home', compact('config'));
    }

    public function pageAbout(Request $request)
    {
        $config = Config::get_options('pageAbout');
        return view('admin.config.page_about', compact('config'));
    }

    public function pageContact(Request $request)
    {
        $config = Config::get_options('pageContact');
        return view('admin.config.page_contact', compact('config'));
    }

    public function settingGeneral(Request $request)
    {
        $config = Config::get_options('settingGeneral');
        return view('admin.config.setting_general', compact('config'));
    }

    public function settingPayment(Request $request)
    {
        $config = Config::get_options('settingPayment');
        return view('admin.config.setting_payment', compact('config'));
    }


     public function settingCharge(Request $request)
    {
        $config = Config::get_options('settingCharges');
        // dd($config);
        return view('admin.config.setting_charge', compact('config'));
    }

    public function settingEmail(Request $request)
    {
        $config = Config::get_options('settingEmail');
        return view('admin.config.setting_email', compact('config'));
    }

    //category work


    public function categoryIndex(Request $request)
    {
        $paginate_count = 10;
        if($request->has('search')){
            $search = $request->input('search');
            $categories = MasterCategory::where('name', 'LIKE', '%' . $search . '%')
                           ->paginate($paginate_count);
        }
        else {
            $categories = MasterCategory::paginate($paginate_count);
        }
        
        return view('admin.config.master_category_index', compact('categories'));
    }



    public function categorygetForm(Request $request,$category_id='')
    {
        if($category_id) {
            $category = MasterCategory::find($category_id);
        }else{
            $category = $this->getColumnTable('categories');
        }
        return view('admin.config.setting_category', compact('category'));
    }


    public function saveMasterCategory(Request $request)
    {
        
        $category_id = $request->input('category_id');

        $validation_rules = ['name' => 'required|string|max:50'];

        $validator = Validator::make($request->all(),$validation_rules);

        // Stop if validation fails
        if ($validator->fails()) {
            return $this->return_output('error', 'error', $validator, 'back', '422');
        }

        if ($category_id) {
            $category = MasterCategory::find($category_id);
            $success_message = 'Category updated successfully';
        } else {
            $category = new MasterCategory();
            $success_message = 'Category added successfully';

            //create slug only while add
            $slug = $request->input('name');
            $slug = str_slug($slug, '-');

            $results = DB::select(DB::raw("SELECT count(*) as total from master_categories where slug REGEXP '^{$slug}(-[0-9]+)?$' "));

            $finalSlug = ($results['0']->total > 0) ? "{$slug}-{$results['0']->total}" : $slug;
            $category->slug = $finalSlug;
        }

        $category->name = $request->input('name');
        $category->icon_class = $request->input('icon_class');
        
        $category->is_active = $request->input('is_active');
        $category->save();
        return redirect('admin/config/setting-category')->with('success',$success_message);
        // return $this->return_output('flash', 'success', $success_message, 'admin/config/setting-course', '200');
    }

    public function deleteMasterCategory($category_id)
    {
        MasterCategory::destroy($category_id);
        return redirect()->back()->with('success','Category deleted successfully');

    }


    //course work

    public function instructorCourseList(Request $request)
    {
        $paginate_count = 10;

        
        // $instructor_id = \Auth::user()->instructor->id;
        if($request->has('search')){
            $search = $request->input('search');

            $courses = DB::table('master_courses')
                        ->select('master_courses.*', 'master_categories.name as category_name')
                        ->leftJoin('master_categories', 'master_categories.id', '=', 'master_courses.category_id')
                        // ->where('courses.instructor_id', $instructor_id)
                        ->where('master_courses.course_title', 'LIKE', '%' . $search . '%')
                        ->orWhere('master_courses.course_slug', 'LIKE', '%' . $search . '%')
                        ->orWhere('master_categories.name', 'LIKE', '%' . $search . '%')
                        ->paginate($paginate_count);
        }
        else {
            $courses = DB::table('master_courses')
                        ->select('master_courses.*', 'master_categories.name as category_name')
                        ->leftJoin('master_categories', 'master_categories.id', '=', 'master_courses.category_id')
                        // ->where('courses.instructor_id', $instructor_id)
                        ->paginate($paginate_count);
        }
        // echo '<pre>';print_r($courses);exit;
        return view('admin.config.master_course_index', compact('courses'));
    }

    public function instructorCourseInfo(Request $request, $course_id = '')
    {   
        $categories = MasterCategory::where('is_active', 1)->get();
        $instruction_levels = InstructionLevel::get();
        $instructor= Instructor::get();

        if($course_id) {
            $course = MasterCourse::find($course_id);
        }else{
            $course = $this->getColumnTable('courses');
        }
        return view('admin.config.setting_course', compact('course', 'categories', 'instruction_levels','instructor'));
    }

    public function instructorCourseInfoSave(Request $request)
    {
        // dd($request->all());
        $course_id = $request->input('course_id');
        // echo '<pre>';print_r($_POST);exit;
        $validation_rules = [
            'course_title' => 'required|string|max:50',
            'is_active' => 'required|integer'
            // 'category_id' => 'required',
            // 'instruction_level_id' => 'required',
            // 'instructor_id'=>'required',
            // 'course_video' => 'required|file|mimetypes:video/mp4',
        ];

        $validator = Validator::make($request->all(),$validation_rules);

        // Stop if validation fails
        if ($validator->fails()) {
            return $this->return_output('error', 'error', $validator, 'back', '422');
        }

        

        if ($course_id) {
            $course = MasterCourse::find($course_id);
            $success_message = 'Course updated successfully';
        } else {
            $course = new MasterCourse();
            $success_message = 'Course added successfully';

            //create slug only while add
            $slug = $request->input('course_title');
            $slug = Str::slug($slug);

            $results = DB::select(DB::raw("SELECT count(*) as total from master_courses where course_slug REGEXP '^{$slug}(-[0-9]+)?$' "));

            $finalSlug = ($results['0']->total > 0) ? "{$slug}-{$results['0']->total}" : $slug;
            $course->course_slug = $finalSlug;
        }

        $course->course_title = $request->input('course_title');
        $course->instructor_id = $request->input('instructor_id');
        $course->category_id = $request->input('category_id');
        $course->instruction_level_id = $request->input('instruction_level_id');
        $course->keywords = $request->input('keywords');
        $course->overview = $request->input('overview');

       

        if ($request->hasFile('course_image')) {
           
            if ($course->course_image) {
                unlink(public_path($course->course_image));
            }
            
            $image = $request->file('course_image');
            $imagePath = 'course_images/courses/';
            $imageName = time() . '_' . $image->getClientOriginalName();
            $image->move(public_path($imagePath), $imageName);
    
            $course->course_image = $imagePath . $imageName;
        }

        //thumb image

        if ($request->hasFile('thumb_image')) {
           
            if ($course->course_image) {
                unlink(public_path($course->course_image));
            }
            
            $image = $request->file('thumb_image');
            $imagePath = 'thumb_images/courses/';
            $imageName = time() . '_' . $image->getClientOriginalName();
            $image->move(public_path($imagePath), $imageName);
    
            $course->thumb_image = $imagePath . $imageName;
        }

        // video

        if ($request->hasFile('course_video')) {
            // Delete the old video if it exists
            if ($course->course_video) {
                unlink(public_path($course->course_video));
            }
            
            $video = $request->file('course_video');
            $videoPath = 'videos/courses/';
            $videoName = time() . '_' . $video->getClientOriginalName();
            $video->move(public_path($videoPath), $videoName);
    
            $course->course_video = $videoPath . $videoName;
        }

        $course->duration = $request->input('duration');
        $course->price = $request->input('price');
        $course->strike_out_price = $request->input('strike_out_price');
        
        $course->is_active = $request->input('is_active');
        $course->save();

        $course_id = $course->id;

        return redirect('admin/config/course-list')->with('success',$success_message);


        // return $this->return_output('flash', 'success', $success_message, 'instructor-course-info/'.$course_id, '200');
    }

    public function deleteMasterCourse($course_id)
    {
        MasterCourse::destroy($course_id);
        return redirect()->back()->with('success','Course deleted successfully');

    }


}
