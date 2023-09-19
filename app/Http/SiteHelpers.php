<?php
// namespace App\Http;
use Illuminate\Support\Facades\Storage;
use App\Models\Category;
use App\Models\Group;
use App\Models\MasterCategory;
use App\Models\Config;
use App\Models\Course;
use App\Models\Slide;
// use DB;
class SiteHelpers
{
    public static function getCoursecompletedStatus($lecture_id)
    {
        return Course::getCoursecompletedStatus($lecture_id);
    }

    public static function checkFileName($path, $filename) 
    {
        $res = "$path/$filename";
        if (!Storage::exists($res)) {
            return $filename;
        }

        $fnameNoExt = pathinfo($filename,PATHINFO_FILENAME);
        $ext = pathinfo($filename, PATHINFO_EXTENSION);

        $i = 1;
        while(Storage::exists("$path/$fnameNoExt($i).$ext")) $i++;
        return "$fnameNoExt($i).$ext";
    }

    public static function active_categories()
    {
        return Category::where('is_active', 1)->get();
    }

    public static function get_slides()
    {
        return Slide::get();
    }

    public static function active_categories_master()
    {
        return DB::table('groups')
                ->select('groups.*','categories.name as cat_name','categories.icon_class','categories.slug','master_categories.id as mscat_id')
                ->join('categories', 'categories.group_id', '=', 'groups.id')
                ->join('master_categories', 'master_categories.id', '=', 'categories.master_category_id')
                // ->where('categories.id',$category_search)
                ->where('groups.is_active',1)
                ->groupBy('master_categories.id')
                ->get();
    }

    public static function get_option($code = '', $option_key = '')
    {
        return Config::get_option($code, $option_key);
    }

    public static function encrypt_decrypt( $string, $action = 'e' ) {
        
        if($string == '' || $string == null)
        {
            return '';
        }
        // you may change these values to your own
        $secret_key = '4Iuy7JB9qMCstxiIj1wIOyMeC9Hesa2vxclg6';
        $secret_iv = '4Iuy7JB9qMCstxiIj1wIOyMeC9Hesa2vxclg6';
     
        $output = false;
        $encrypt_method = "AES-256-CBC";
        $key = hash( 'sha256', $secret_key );
        $iv = substr( hash( 'sha256', $secret_iv ), 0, 16 );
     
        if( $action == 'e' ) {
            $output = base64_encode( openssl_encrypt( $string, $encrypt_method, $key, 0, $iv ) );
        }
        else if( $action == 'd' ){
            $output = openssl_decrypt( base64_decode( $string ), $encrypt_method, $key, 0, $iv );
        }
     
        return $output;
    }

    
}
