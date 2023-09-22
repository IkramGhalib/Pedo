<?php
/**
 * PHP Version 7.1.7-1
 * Functions for users
 *
 * @category  File
 * @package   Category
 * @author    Mohamed Yahya
 * @copyright ULEARN  
 * @license   BSD Licence
 * @link      Link
 */
namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Division;
use App\Models\SubDivision;
use App\Models\Feeder;

use App\Models\ConsumerCategory;
use App\Models\ConsumerSubCategory;





use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;
use DB;
use Illuminate\Support\Facades\DB as FacadesDB;

/**
 * Class contain functions for admin
 *
 * @category  Class
 * @package   Category
 * @author    Mohamed Yahya
 * @copyright ULEARN
 * @license   BSD Licence
 * @link      Link
 */
class GeneralController extends Controller
{
    /**
     * Function to display the categories for admin
     *
     * @param array $request All input values from form
     *
     * @return contents to display in categories page
     */
    public function get_all_division_where(Request $request)
    {
        // pr($request->all());

            echo json_encode(Division::where('is_active',1)->where('name','like',$request->search.'%')->get());
    }

    public function get_all_sub_division_where(Request $request)
    {
           
            echo json_encode(SubDivision::where('is_active',1)->where('division_id',$request->division_id)->where('name','like',$request->search.'%')->get());
    }

    public function get_all_feeder(Request $request)
    {
            echo json_encode(Feeder::where('is_active',1) ->get());
    }

    


    public function get_all_consumer_category_where(Request $request)
    {
            echo json_encode(ConsumerCategory::where('is_active',1)->where('name','like',$request->search.'%')->get());
    }

    public function get_all_consumer_sub_category_where(Request $request)
    {
           
            echo json_encode(ConsumerSubCategory::where('is_active',1)->where('consumer_category_id',$request->parent_id)->where('name','like',$request->search.'%')->get());
    }



    public function saveGroup(Request $r)
    {
        $validation_rules = [
            'name' => 'required|string|max:50',
            'total_seat' => 'required',
            'category_id' => 'required',
            // 'no_of_test' => 'required',
            'registration_method' => 'required',
        ];
        
        $validator = Validator::make($r->all(),$validation_rules);
        
        // Stop if validation fails
        if ($validator->fails()) {
            return $this->return_output('error', 'error', $validator, 'back', '422');
        }
        // echo '<pre>';print_r($_POST);exit;
        // dd($r->all());
        DB::beginTransaction();

        try {
        $master_category=MasterCategory::find($r->category_id);
        
        // dd($master_category);
        $gid=Group::insertGetId(['name'=>$r->name,'total_seat'=>$r->total_seat,'is_active'=>$r->is_active,'registration_method'=>$r->registration_method]);
        $cid=Category::insertGetId(['name'=>$master_category->name,'group_id'=>$gid,'master_category_id'=>$r->category_id,'is_active'=>$r->is_active,'slug'=>$master_category->slug,'icon_class'=>$r->icon_class]);
        // $subject_array=array();
        foreach($r->subject_id as $key => $row)
        {
            $master_course=MasterCourse::find($r->subject_id[$key]);
            $slug =  $master_course->course_title;
            $slug = Str::slug($slug);
            $results = DB::select(DB::raw("SELECT count(*) as total from courses where course_slug REGEXP '^{$slug}(-[0-9]+)?$' "));
            $finalSlug = ($results['0']->total > 0) ? "{$slug}-{$results['0']->total}" : $slug;
            $course_slug = $finalSlug;


            $subject_array=['instructor_id'=>$r->instructor_id[$key],'category_id'=>$cid,'master_course_id'=>$master_course->id,'course_title'=>$master_course->course_title,'course_slug'=> $course_slug,'price'=>$r->price[$key]];
            $new_course=Course::create($subject_array);
            // pr($r->no_of_test);
            if($r->no_of_test[$key] && $r->no_of_test[$key]>0)
            for ($i=0; $i < $r->no_of_test[$key]; $i++) { 
                $tt=$i+1;
                $test_array=array('course_id'=>$new_course->id,'test_title'=>'Test - '.$tt,'user_id'=>auth()->user()->id,'test_start'=>date('Y-m-d'),'test_end'=>date('Y-m-d'),'time_start'=>date('H:i:s'),'time_end'=>date('H:i:s'));
                Test::insert($test_array);
            }

        }

        DB::commit();
        return $this->return_output('flash', 'success', 'Record Add successfully', 'admin/group', '200');
        } catch (\Exception $e) {
            // dd($e->getMessage());
            // die;
            return $this->return_output('error', 'error', [$e->getMessage()], 'back', '422');
            DB::rollback();
            // something went wrong
        }

        // if ($category_id) {
        //     $category = Category::find($category_id);
        //     $success_message = 'Category updated successfully';
        // } else {
        //     $category = new Category();
        //     $success_message = 'Category added successfully';

        //     //create slug only while add
        //     $slug = $request->input('name');
        //     $slug = str_slug($slug, '-');

        //     $results = DB::select(DB::raw("SELECT count(*) as total from categories where slug REGEXP '^{$slug}(-[0-9]+)?$' "));

        //     $finalSlug = ($results['0']->total > 0) ? "{$slug}-{$results['0']->total}" : $slug;
        //     $category->slug = $finalSlug;
        // }

        // $category->name = $request->input('name');
        // $category->icon_class = $request->input('icon_class');
        
        // $category->is_active = $request->input('is_active');
        // $category->save();

        
    }

    public function deleteCategory($category_id)
    {
        Category::destroy($category_id);
        return $this->return_output('flash', 'success', 'Category deleted successfully', 'admin/categories', '200');
    }

    public function viewcourses($id)
    { 
      
                $courses = DB::table('courses')
                ->join('master_courses', 'courses.master_course_id', '=', 'master_courses.id')
                ->join('categories', 'courses.category_id', '=', 'categories.id')
                ->where('categories.group_id', '=', $id)
                ->select('courses.id','master_courses.course_title','courses.price')
                ->get();
    //    dd($courses);

   return view('admin.groups.viewcourses', compact('courses'));
    }



public function viewcoursestest($id)
{
    $tests = DB::table('courses')
    ->join('tests', 'courses.id', '=', 'tests.course_id')
    ->select('courses.course_title', 'tests.*')
    ->where('course_id',$id)
    ->paginate(100);
    // ->get();
// dd($tests);
   

    return view('admin.tests.index',compact('tests'));

}





}
