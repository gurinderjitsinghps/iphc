<?php

namespace App\Http\Controllers;

use App\Models\PolokanoPremium;
use Illuminate\Http\Request;

class PolokanoPremiumController extends Controller
{
    public function store(Request $request)
    {
       $validated =  $request->validate([
        'polokano_id'=> 'required|integer|exists:polokanos,id',
        'firstname'=> 'required|string|min:3',
        'lastname'=> 'required|string|min:3',
        'number'=> 'required|integer|min:3',
        'type'=>'required|string|min:3',
        'category'=>'required|string|min:3',
        'premium_monthly'=>'required|string|min:3',
       ]);
    $polokano = PolokanoPremium::create($validated);    
        return response()->json(['status'=>true,'message' => 'Polokano Premium created successfully.'], 201);
    }
}
