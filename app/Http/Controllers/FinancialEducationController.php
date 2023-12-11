<?php

namespace App\Http\Controllers;

use App\Models\FinancialEducation;
use Illuminate\Http\Request;

class FinancialEducationController extends Controller
{
   public function index(Request $request) {
        $query = FinancialEducation::query();
      
        if ($request->has('search')) {
            $search = $request->input('search');
            $query->where('title', 'LIKE', "%$search%")
            ->orWhere('description', 'like', "%$search%");
        }
        $query->orderBy('created_at', 'desc');
        $financial_education = $query->paginate(10);
        return response()->json(['status'=>true,'data' => $financial_education], 201); 

    }
    public function store(Request $request)
    {
       $validated =  $request->validate([
        'title'=> 'required|string|min:3',
        'description'=> 'required|string|min:3|max:400',
        'video' => 'required|file|mimes:mp4,mov,avi|max:10240'
    ]);

        $user_id = auth('frontuser')->id();
        $validated['front_user_id'] = $user_id;
        if($request->video){
            $validated['video'] = $request->video->store('financial_education/videos','public'); 
        }

        $flgc = FinancialEducation::create($validated);

        return response()->json(['status'=>true,'message' => 'Financial Education video saved successfully.'], 201);
    }
    public function show(Request $request, $id)
    {
        
       $fe = FinancialEducation::find($id);
        if(!$fe){
            return response()->json(['status'=>false,'message' => 'Financial Education Not Found.']); 
        }
        return response()->json(['status'=>true,'data' => $fe]);

    }
}
