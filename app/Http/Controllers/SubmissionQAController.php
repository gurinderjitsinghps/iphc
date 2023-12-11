<?php

namespace App\Http\Controllers;

use App\Models\SubmissionQA;
use Illuminate\Http\Request;

class SubmissionQAController extends Controller
{
    public function index()
    {
       $qas = SubmissionQA::get();
    
        return response()->json(['status'=>true,'data' => $qas]);
    
    }
    public function store(Request $request)
    {
       $validated =  $request->validate([
            'question' => 'required|string|min:4|max:250',
            'submission_id' => 'required|exists:submissions,id',
        ]);
        $user_id = auth('user')->id();
        $validated['user_id'] = $user_id;
        $question = SubmissionQA::create($validated);

        return response()->json(['status'=>true,'message' => 'Question created successfully'], 201);
    }

    public function update(Request $request)
    {
       $validated =  $request->validate([
            'id' => 'exists:submission_q_a_s,id',
            'answer' => 'required|string|min:4|max:250',
        ]);
    
        $question = SubmissionQA::find($validated['id']);
        $question->answer = $validated['answer'];
        $question->save();
        return response()->json(['status'=>true,'message' => 'Answer Added successfully'], 201);
    }
    public function destroy(SubmissionQA $submissionqa)
    {
        $submissionqa->delete();
        return response()->json(['status'=>true,'message' => 'QA Deleted successfully'], 201);
    }
}
