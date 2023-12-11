<?php

namespace App\Http\Controllers;

use App\Models\Business;
use Illuminate\Http\Request;

class BusinessController extends Controller
{
    public function index(Request $request) {
        $query = Business::query();
      
        if ($request->has('search')) {
            $search = $request->input('search');
            $query->where('name', 'LIKE', "%$search%")
            ->orWhere('address', 'like', "%$search%");
        }
        $query->orderBy('created_at', 'desc');
        $businesses = $query->paginate(10);
        return response()->json(['status'=>true,'data' => $businesses], 201); 

    }
    public function store(Request $request)
    {
       $validated =  $request->validate([
        'cover_photo'=>'required|file|mimes:png,jpg,jpeg|max:2240',
        'name'=> 'required|string|min:3',
        'type'=> 'required|string|min:3',
        'phone' => ['required','string','regex:/^(\+[0-9]{1,3})?[0-9\s-]+$/','min:10','max:15',],
        'email' => 'required|string|email|max:255',
        'address'=>'required|string|min:3',
        'services_offered'=>'required|string|min:3',
        'owner_firstname'=>'required|string|min:3',
        'owner_lastname'=>'required|string|min:3',
        'owner_address'=>'required|string|min:3',
        'owner_lat'=>'required|string|min:3',
        'owner_long'=>'required|string|min:3',
        'region_id'=> 'required|integer|exists:categories,id',
        'branch_id'=> 'required|integer|exists:categories,id',
        'ssn_tin'=>'required|string|min:3',
        'ownership_percentage'=>'sometimes|numeric',
        'start_date'=>'required|date_format:Y-m-d',
        'tax_information'=>'required|string|min:3',
        'website'=>'required|string|min:4',
        'payment_information'=>'required|string|min:4',
        'insurance_information'=>'required|string|min:4',
        'terms_conditions'=>'required|string|min:4',
        'privacy_policy'=>'required|string|min:4',
        'category_id'=>'required|integer|exists:business_categories,id',
    ]);
    if($request->cover_photo){
        $validated['cover_photo'] = $request->cover_photo->store('businesses','public'); 
    }
        $flgc = Business::create($validated);

        return response()->json(['status'=>true,'message' => 'Business Registration created successfully.'], 201);
    }
}
