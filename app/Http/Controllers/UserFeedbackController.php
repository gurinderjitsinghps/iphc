<?php

namespace App\Http\Controllers;

use App\Models\UserFeedback;
use Database\Factories\UserFactory;
use Illuminate\Http\Request;

class UserFeedbackController extends Controller
{
    public function store(Request $request)
    {
        // Validate the request data
        $validated = $request->validate([
            'questions.*.question_id' => 'required|string|in:1,2,3,4,5,6',
            'questions.*.answer' => 'required|string',
        ]);
        $user = auth('frontuser')->user();
        if(isset($validated['questions'])){
            foreach($validated['questions'] as $question) {
                $question['front_user_id'] = $user->id;
                $bquestion = UserFeedback::updateOrCreate(['question_id'=>$question['question_id'],'front_user_id'=>$user->id],$question);
        }
    }

        return response()->json(['status'=>true,'message' => 'Feedback submitted  successfully.'], 201);
    }
}
