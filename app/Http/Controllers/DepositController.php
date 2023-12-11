<?php

namespace App\Http\Controllers;

use App\Models\Deposit;
use App\Models\DepositAttachment;
use App\Traits\UserRole;
use Illuminate\Http\Request;

class DepositController extends Controller
{
    use UserRole;
    function index(Request $request) {
        $rbd = $this->getRegionBranch();
        $query = Deposit::query();
        $query->with('attachments');
        // if ($request->has('type')) {
        //     $query->where('type', $request->input('type'));
        // }
        if(!empty($rbd)){
            foreach($rbd as $k => $r){
                if($r !== 0){
                $query->where($k,$r);
                }
            }
        }
        if ($request->has('is_approved')) {
            $query->where('is_approved', $request->input('is_approved'));
        }
        $query->orderBy('created_at', 'desc');
        $events = $query->paginate(10);
        return response()->json(['status'=>true,'data' => $events], 201); 
    
    }
    public function store(Request $request)
    {
        // Validate the request data
        $validated = $request->validate([
            'amount' => 'required|numeric',
            'summary_amount' => 'required|numeric',
            'type_id' => 'required|integer',
            'region_id' => 'required|integer',
            'branch_id' => 'required|integer',
            'request_for_approval_id' => 'required|integer',
            'justification' => 'required|string|min:20',
            'date' => 'required|date_format:Y-m-d',
            'attachments.*' => 'file|mimes:docx,pdf|max:2048',
        ]);
        $user = auth('user')->user();
        $validated['user_id'] = $user->id;
        $rbDt = $this->getRegionBranch();
        $validated = array_merge($validated,$rbDt);

        // Create a new withdrawal
        $deposit = Deposit::create($validated);

        if ($request->hasFile('attachments')) {
            foreach($request->attachments as $document) {
                $documentPath = $document->store('deposits/attachments','public'); 
                $fileName = basename($documentPath);
                $documentCreate = [
                    'deposit_id'=> $deposit->id,
                    'file_name'=> $fileName,
                    'file_path'=> $documentPath,
                    'file_size'=> $document->getSize(),
                    'file_type'=> $document->getMimeType(),
                ];
                $documentModel = DepositAttachment::create($documentCreate);
               
            }
        }

        return response()->json(['status'=>true,'message' => 'Deposit created successfully'], 201);
    }

    public function show(Request $request, $id)
    {
        $rbDt = $this->getRegionBranch();
       $deposit = Deposit::where('id',$id);
       if(!empty($rbDt)){
        foreach($rbDt as $k => $r){
            if($r !== 0){
            $deposit->where($k,$r);
            }
        }
    }
        if(!$deposit){
            return response()->json(['status'=>false,'message' => 'Deposit Not Found.']); 
        }
        return response()->json(['status'=>true,'data' => $deposit->first()]);

    }
}
