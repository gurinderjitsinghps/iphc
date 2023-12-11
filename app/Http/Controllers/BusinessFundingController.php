<?php

namespace App\Http\Controllers;

use App\Models\BusinessFunding;
use Illuminate\Http\Request;

class BusinessFundingController extends Controller
{
    public function store(Request $request)
    {
       $validated =  $request->validate([
        'oragnization_name'=> 'required|string|min:4|max:250',
        'oragnization_address'=> 'required|string|min:4|max:250',
        'ssn_tin'=> 'required|string|min:4|max:250',
        'oragnization_website'=> 'required|string|min:4|max:250',
        'oragnization_president'=> 'required|string|min:4|max:250',
        'business_funding_category_id'=> 'required|exists:business_funding_categories,id',
        'region_id'=> 'required|exists:categories,id',
        'branch_id'=> 'required|exists:categories,id',
        'phone' => 'required|numeric',
        'email' => 'required|string',
        'project_name'=> 'required|string|min:3',
        'total_budget'=> 'required|numeric',
        'requested_amount'=> 'required|numeric',
        'total_budget_percentage'=> 'required|numeric',
        'grant_from'=>'required|date_format:Y-m-d',
        'grant_to'=>'required|date_format:Y-m-d',
        'area_served'=> 'required|string|min:3', 
        'recent_funder_name'=> 'required|string|min:3', 
        'recent_funder_amount'=> 'required|string|min:3',
        'recent_funder_date'=>'required|date_format:Y-m-d',
        'recent_funder_description'=> 'required|string|min:3',
        ]);
        $user_id = auth('frontuser')->id();
        $validated['front_user_id']= $user_id;
        $flgm = BusinessFunding::create($validated);
        return response()->json(['status'=>true,'message' => 'Business Funding created successfully'], 201);
    }
}
