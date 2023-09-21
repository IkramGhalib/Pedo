<?php
/**
 * PHP Version 7.1.7-1
 * Functions for dashboard
 *
 * @category  File
 * @package   Dashboard
 * @author    Mohamed Yahya
 * @copyright ULEARN  
 * @license   BSD Licence
 * @link      Link
 */
namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\SubDivision;

/**
 * Class contain functions for admin
 *
 * @category  Class
 * @package   Dashboard
 * @author    Mohamed Yahya
 * @copyright ULEARN
 * @license   BSD Licence
 * @link      Link
 */
class SubDivisionController extends Controller
{
    /**
     * Function to display the dashboard contents for admin
     *
     * @param array $request All input values from form
     *
     * @return contents to display in dashboard
     */
    
     public function getSubDivisionsAgainstDivision(Request $request)
     {
        $sub_division= SubDivision::where('division_id',$request->id)->get();
        return response()->json($sub_division);
        // return view('instructor.dashboard');
     }
    
}
