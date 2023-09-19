<?php

namespace App\Http\Controllers\Api\resultapi;

use App\Http\Controllers\Controller;
use App\Models\Result;
use Illuminate\Http\Request;

class ResultController extends Controller
{
    public function index()
    {
        $results = Result::all(); // Retrieve all test records

        return response()->json(['results' => $results], 200);
    }

    public function store(Request $request)
    {
        $request->validate([
            'user_id' => 'required|string',
            'group_id' => 'required|string',
            'course_id' => 'required|string',
            'test_id' => 'required|string',
            'question_id' => 'required|string',
            'correct' => 'required|integer',
            'wrong' => 'required|integer',
            'obtn_marks' => 'required|numeric',
            'total_score' => 'required|numeric',
            'percentage' => 'required|integer',
            'rank' => 'required|integer',
        ]);

        $result = Result::create($request->all());

        return response()->json(['message' => 'Result created successfully', 'result' => $result], 201);
    }
}
