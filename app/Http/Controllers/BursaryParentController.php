<?php

namespace App\Http\Controllers;

use App\Models\BursaryParent;
use Illuminate\Http\Request;

class BursaryParentController extends Controller
{
    public function store(Request $request)
    {
       $validated =  $request->validate([
        'bursary_id'=>'required|integer|exists:bursaries,id',
        'name'=>'required|string|min:3|max:250',
        'id_number'=>'required|string|min:3',
        'gender'=> 'required|in:male,female',
        'membership_number'=> 'required|string|min:3',
        'type'=> 'required|in:parent,guardian',
        'location'=>'required|string|min:3',
        'lat'=> 'required|string|min:3',
        'long'=> 'required|string|min:3',
        'region_id'=> 'required|integer|exists:categories,id',
        'branch_id'=> 'required|integer|exists:categories,id',
        'occupation'=> 'required|string|min:3',
    ]);

        $burs = BursaryParent::create($validated);

        return response()->json(['status'=>true,'message' => 'Bursary Parent created successfully.'], 201);
    }
}
