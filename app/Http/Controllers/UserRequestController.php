<?php

namespace App\Http\Controllers;

use App\Models\UserRequest;
use Illuminate\Http\Request;

class UserRequestController extends Controller
{
    function index(Request $request) {
        $query = UserRequest::query();
        if ($request->has('status')) {
            $query->where('status', $request->input('status'));
        }

        $query->orderBy('created_at', 'desc');
        $reqs = $query->paginate(10);
        return response()->json(['status'=>true,'data' => $reqs], 201); 
    
    }
}
