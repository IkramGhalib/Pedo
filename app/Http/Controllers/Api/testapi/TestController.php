<?php

namespace App\Http\Controllers\Api\testapi;

use App\Http\Controllers\Controller;
use App\Models\Test;
use Illuminate\Http\Request;

class TestController extends Controller
{
    //

    public function index()
    {
        $tests = Test::all(); 

        return response()->json(['tests' => $tests], 200);
    }

    public function store(Request $request)
    {
        $request->validate([
            'course_id' => 'required|exists:courses,id', 
            'test_title' => 'required|string',
            'test_start' => 'required|date',
            'test_end' => 'required|date|after_or_equal:test_start',
            'time_start' => 'required|date_format:H:i:s',
            'time_end' => 'required|date_format:H:i:s|after:time_start',
            'user_id' => 'required|string',
            'status' => 'nullable|in:0,1',
        ]);

    
        $test = Test::create($request->all());

        return response()->json(['message' => 'Test created successfully', 'test' => $test], 201);
    }
}
