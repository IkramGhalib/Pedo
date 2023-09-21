<?php
namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Feeder;
class FeederController extends Controller
{
    /**
     * Function to display the dashboard contents for admin
     *
     * @param array $request All input values from form
     *
     * @return contents to display in dashboard
     */
    
    // public function instructorDashboard(Request $request)
    // {
    //     return view('instructor.dashboard');
    // }

    public function getFeedersAgainstSubDivision(Request $request)
    {
       $feeder= Feeder::where('sub_division_id',$request->id)->get();
       return response()->json($feeder);
       // return view('instructor.dashboard');
    }
    
}
