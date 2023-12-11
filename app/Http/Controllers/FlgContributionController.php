<?php

namespace App\Http\Controllers;

use App\Models\FlgContribution;
use Illuminate\Http\Request;

class FlgContributionController extends Controller
{
    public function store(Request $request)
    {
       $validated =  $request->validate([
        'payment_reference'=> 'required|string',
        'amount'=> 'required|numeric'
        ]);

        $user_id = auth('frontuser')->id();
        $validated['front_user_id'] = $user_id;
        $flgc = FlgContribution::create($validated);

        return response()->json(['status'=>true,'message' => 'Flg Contribution created successfully'], 201);
    }
}
