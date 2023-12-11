<?php

namespace App\Http\Controllers;

use App\Models\DonationRegistration;
use Illuminate\Http\Request;

class DonationRegistrationController extends Controller
{
    public function store(Request $request)
    {
       $validated =  $request->validate([
        'firstname'=> 'required|string|min:3',
        'lastname'=> 'required|string|min:3',
        'region_id'=> 'required|integer|exists:categories,id',
        'branch_id'=> 'required|integer|exists:categories,id',
        'phone' => ['required','string','regex:/^(\+[0-9]{1,3})?[0-9\s-]+$/','min:10','max:15',
    ],  'metric'=> 'required|boolean',
        'grade'=> 'required_if:metric,true',
        'school'=>'required|string|min:3',
    ]);

        $flgc = DonationRegistration::create($validated);

        return response()->json(['status'=>true,'message' => 'Donation Registration created successfully.'], 201);
    }
}
