<?php

namespace App\Models;
use Illuminate\Database\Eloquent\Model;
use File;
use Illuminate\Support\Facades\Storage;
use SiteHelpers;

class MasterCourse extends Model
{
    protected $table = 'master_courses';
    protected $guarded = array();

    // public static function is_subscribed($course_slug, $user_id)
    // {
    //     $course = \DB::table('master_courses')->where('course_slug', $course_slug)->first();
    //     return \DB::table('course_taken')
    //       ->where('course_taken.course_id',$course->id)
    //       ->where('course_taken.user_id',$user_id)
    //       ->first();
    // }

    // public function students_count($course_id)
    // {
    //     return \DB::table('course_taken')->where('course_id', $course_id)->count();
    // }

    // public function instructor()
    // {
    //     return $this->belongsTo('App\Models\Instructor', 'instructor_id', 'id');
    // }

    // public function category()
    // {
    //     return $this->belongsTo('App\Models\Category', 'category_id', 'id');
    // }

    // public function ratings()
    // {
    //     return $this->hasMany('App\Models\CourseRating', 'course_id', 'id');
    // }
}
