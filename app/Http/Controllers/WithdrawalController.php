<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Submission;
use App\Models\Withdrawal;
use App\Models\WithdrawalAttachment;
use App\Traits\UserRole;
use Illuminate\Http\Request;

class WithdrawalController extends Controller
{
    use UserRole;
    function indexAdmin(Request $request) {
        if ($request->ajax()) {
            $data = Withdrawal::get();
            // }
            // $data = Buyer::select(['id', 'name', 'email','phone'])->get();
            return datatables()->of($data)
                ->addColumn('actions',function ($data){
                
                    return '<div class="d-flex align-items-center justify-content-center acCont"><a href="'.route('superadmin.transactions.show',$data->id).'"  >
                    <span class="zmdi zmdi-delete icon-eye icons text-success"></span></a>
                   
                    
                  </div> ';})
                //   ->addColumn('type', function ($data) {
                //     $category =  Category::find($data->user_type_id);
                //     return $category->name;
                //    })
                  ->addColumn('branch', function ($data) {
                   $category =  Category::find($data->branch_id);
                   return $category ? $category->name :'';
                  })
             
                ->rawColumns(['actions'])
                ->make(true);
                }else{
                return view('superadmin.transactions.index');
                }
    
    }
    function index(Request $request) {
        $rbDt = $this->getRegionBranch();
        $query = Withdrawal::query();
        $query->with(['attachments','submission']);
        // if ($request->has('type')) {
        //     $query->where('type', $request->input('type'));
        // }
        if(!empty($rbDt)){
            foreach($rbDt as $k => $r){
                if($r !== 0){
                $query->where($k,$r);
                }
            }
        }
        if ($request->has('status')) {
            $status = $request->input('status');
            $query->whereHas('submissions', function ($queryy) use ($status) {
                // dd($queryy->from);
                    $queryy->where('submissions.status', $status);
            });
            
        }
        // if ($request->has('is_approved')) {
        //     $query->where('is_approved', $request->input('is_approved'));
        // }
        // dd($query->toSql());
        $query->orderBy('created_at', 'desc');
        $events = $query->paginate(10);
        return response()->json(['status'=>true,'data' => $events], 201); 
    
    }
    public function store(Request $request)
    {
        // Validate the request data
        $validated = $request->validate([
            'name' => 'required|string',
            'amount' => 'required|numeric',
        
            'type_id' => 'required|integer',
            'request_for_approval_id' => 'required|integer',
            'justification' => 'required|string|min:20',
            'service_date' => 'required|date_format:Y-m-d',
            'attachments.*' => 'file|mimes:docx,pdf|max:2048',
        ]);
        $user = auth('user')->user();
        $validated['user_id'] = $user->id;
        $rbDt = $this->getRegionBranch();
        $validated = array_merge($validated,$rbDt);
        // return response()->json(['message' => $validated], 201);

        // Create a new withdrawal
        $withdrawal = Withdrawal::create($validated);

        if ($request->hasFile('attachments')) {
            foreach($request->attachments as $document) {
                $documentPath = $document->store('withdrawals/attachments','public'); 
                $fileName = basename($documentPath);
                $documentCreate = [
                    'withdrawal_id'=> $withdrawal->id,
                    'file_name'=> $fileName,
                    'file_path'=> $documentPath,
                    'file_size'=> $document->getSize(),
                    'file_type'=> $document->getMimeType(),
                ];
                $documentModel = WithdrawalAttachment::create($documentCreate);
               
            }
        }
        $subCreate = $this->submissionableUpdate($withdrawal->id,'Withdrawal');
        return response()->json(['status'=>true,'message' => 'Withdrawal created successfully'], 201);
    }
    public function showAdmin(Request $request, $id)
    {
        $transaction = Withdrawal::find($id);
        if(!$transaction){
            return redirect()->route('superadmin.transactions');
        }
    
        $branch =  Category::find($transaction->branch_id);
         $transaction->branch = $branch;
        $type =  Category::find($transaction->user_type_id);
         $transaction->type = $type;
       
        return view('superadmin.transactions.view',compact('transaction'));

    }
    public function show(Request $request, $id)
    {
        $rbDt = $this->getRegionBranch();
       $withdrawal = Withdrawal::where('id',$id);
       if(!empty($rbDt)){
        foreach($rbDt as $k => $r){
            if($r !== 0){
            $withdrawal->where($k,$r);
            }
        }
    }
        if(!$withdrawal){
            return response()->json(['status'=>false,'message' => 'Withdrawal Not Found.']); 
        }
        return response()->json(['status'=>true,'data' => $withdrawal->first()]);

    }

    public function adminGraph(Request $request)
    {
            $query = Withdrawal::selectRaw('MONTH(created_at) as month, SUM(amount) as total')
            ->groupBy('month');
            if ($request->has('eyear') && $request->input('eyear') != '') {
                $query->whereYear('created_at', $request->input('eyear', date('Y')));
            }
       
            if ($request->has('eregion') && ($request->input('eregion') != '')) {
                $query->where('region_id', $request->input('eregion'));
            }
        $data = $query->get();
        return response()->json(['status'=>true,'data'=>$data], 201);

    }
}
