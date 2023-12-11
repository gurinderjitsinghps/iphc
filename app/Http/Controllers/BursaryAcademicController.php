<?php

namespace App\Http\Controllers;

use App\Models\BursaryAcademic;
use Illuminate\Http\Request;

class BursaryAcademicController extends Controller
{
    public function store(Request $request)
    {
        
       $validated =  $request->validate([
        'bursary_id'=>'required|integer|exists:bursaries,id',
        'program_name'=>'required|string|min:3|max:250',
        'institution_name'=>'required|string|min:3|max:250',
        'student_number'=>'required|string|min:3|max:250',
        'study_year'=>'required|date_format:Y-m-d',
        'tution_costs'=>'required|numeric',
        'meal_costs'=>'required|numeric',
        'resident_costs'=>'required|numeric',
        'material_costs'=>'required|numeric',
        'online_study_material'=>'required|string|min:3|max:320',
        'previously_awarded_financial_assist'=>'required|string|min:3|max:320',
        'financial_assist_discontinued'=>'required|string|min:3|max:320',
        'current_school_institute'=>'required|string|min:3|max:320',
        'school_institute_program_of_study'=>'required|string|min:3|max:320',
        'school_institute_study_year'=>'required|date_format:Y-m-d',
        'current_gpa'=>'required|numeric',
    ]);

        $burs = BursaryAcademic::create($validated);

        return response()->json(['status'=>true,'message' => 'Bursary Academic created successfully.'], 201);
    }
}
