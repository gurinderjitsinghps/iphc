<?php

namespace App\Http\Controllers;

use App\Models\Donation;
use App\Models\Transaction;
use Illuminate\Http\Request;

class DonationController extends Controller
{
    public function store(Request $request)
    {
       $validated =  $request->validate([
        'firstname'=> 'required|string|min:3',
        'lastname'=> 'required|string|min:3',
        'amount'=> 'required|numeric',
        'email'=> 'required|string|email|max:255',
        'phone' => ['required','string','regex:/^(\+[0-9]{1,3})?[0-9\s-]+$/','min:10','max:15',],
        'receive_donation_receipt'=> 'required|boolean',
        'recurring'=> 'required|in:one,monthly',
    ]);

        $flgc = Donation::create($validated);
        $user_id = auth('frontuser')->id();
        $data = [  'front_user_id' => $user_id,
        'amount'=>$validated['amount'],
        'type'=>'donation',
        'type_id'=>$flgc->id,
        'reference'=>'Flg Empire',];
        $subCreate= Transaction::create($data);
        return response()->json(['status'=>true,'message' => 'Donation created successfully.'], 201);
    }
    public function adminGraph(Request $request)
    {
            $query = Donation::selectRaw('MONTH(created_at) as month, SUM(amount) as total')
            ->groupBy('month');
            if ($request->has('dyear')) {
                $query->whereYear('created_at', $request->input('dyear', date('Y')));
            }
       
            if ($request->has('dregion')) {
                $query->where('region_id', $request->input('dregion'));
            }
        $data = $query->get();
        return response()->json(['status'=>true,'data'=>$data], 201);

    }
    
}
