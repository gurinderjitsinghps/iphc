<?php

namespace App\Http\Controllers;

use App\Models\FlgMembership;
use App\Models\FlgMembershipPlan;
use App\Models\Transaction;
use Illuminate\Http\Request;

class FlgMembershipController extends Controller
{
    public function cardDetails(Request $request)
    {
        $user = auth('frontuser')->user();
        $card = FlgMembership::where('email',$user->email);
        if($card->count()){
            $card = $card->latest()->first();
        }

        return response()->json(['status'=>true,'data' =>$card], 201);
    }   
    public function store(Request $request)
    {
       $validated =  $request->validate([
        'firstname'=> 'required|string|min:4|max:250',
        'lastname'=> 'required|string|min:4|max:250',
        'address'=> 'required|string|min:4|max:250',
        'lat'=> 'sometimes|string',
        'long'=> 'sometimes|string',
        'region_id'=> 'required|exists:categories,id',
        'branch_id'=> 'required|exists:categories,id',
        'postcode' => 'required|string',
        'phone' => 'required|numeric',
        'email' => 'required|string',
        'employment_status'=> 'required|string',
        'profession'=> 'required|string',
        'team_category_id'=> 'required|integer',
        'certificate_type'=> 'required|string',
        'membership_plan_id'=> 'required|integer|exists:flg_membership_plans,id',
        ]);
       
        $flgm = FlgMembership::create($validated);
        $flgmp = FlgMembershipPlan::find($validated['membership_plan_id']);
        // dd($flgmp);
        $amount = $flgmp ? $flgmp->amount_min : 0;
        $user_id = auth('frontuser')->id();
        $data = [  'front_user_id' => $user_id,
        'amount'=>$amount,
        'type'=>'membership',
        'type_id'=>$flgm->id,
        'reference'=>'Flg Empire',];
        $subCreate= Transaction::create($data);
        return response()->json(['status'=>true,'message' => 'Flg Membership created successfully'], 201);
    }
}
