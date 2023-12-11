<?php

namespace App\Http\Controllers;

use App\Models\Transaction;
use Illuminate\Http\Request;

class TransactionController extends Controller
{
    public function index(Request $request) {
        $query = Transaction::query();
      
        if ($request->has('search')) {
            $search = $request->input('search');
            $query->where('type', 'LIKE', "%$search%")
            ->orWhere('amount', 'like', "%$search%")
            ->orWhere('reference', 'like', "%$search%");
        }
        $query->orderBy('created_at', 'desc');
        $transactions = $query->paginate(10);
        return response()->json(['status'=>true,'data' => $transactions], 201); 

    }
 
}
