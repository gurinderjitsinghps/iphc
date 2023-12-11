<?php

namespace App\Http\Controllers;

use App\Models\Bursary;
use Illuminate\Http\Request;

class BursaryController extends Controller
{
    public function indexAdmin(Request $request,$id)
    {   
      
        if ($request->ajax()) {
          
            $data = Bursary::where('bursary_recommend_id',$id)->latest()->get();
            // }
            // $data = Buyer::select(['id', 'name', 'email','phone'])->get();
            return datatables()->of($data)
                ->addColumn('actions',function ($data){
                    return '--';})
                // ->addColumn('actions',function ($data){
                //     return '
                //     <div class="d-flex justify-content-center" >
                //     <div class="ml-1 cp editbr" bid="'.$data->id.'"><span class="zmdi zmdi-delete icon-pencil icons text-warning"></span></div>
                //     <div class="ml-1 cp deletebr"  bid="'.$data->id.'"><span class="zmdi zmdi-delete text-danger icon-trash icons"></span></div>
                //     </div>
                //     ';})
                // ->addColumn('total',function ($data){
                //     return $data->bursaries->count();
                //  })
           
                ->rawColumns(['actions'])
                ->make(true);
        }else{

        return view('superadmin.cms.bursaries');
        }
    }
    public function store(Request $request)
    {
     
       $validated =  $request->validate([
        'bursary_recommend_id'=> 'required|integer|exists:bursary_recommends,id',
        'name'=> 'required|string|min:3',
        'location'=> 'required|string|min:3|max:400',
        'id_number'=> 'required|string|min:3',
        'gender'=> 'required|in:male,female',
        'lat'=> 'required|string|min:3',
        'long'=> 'required|string|min:3',
        'region_id'=> 'required|integer|exists:categories,id',
        'branch_id'=> 'required|integer|exists:categories,id',
        'phone' => ['required','string','regex:/^(\+[0-9]{1,3})?[0-9\s-]+$/','min:10','max:15',
        ],
        'email' => 'required|string|email|max:255',
        'dob'=>'required|date_format:Y-m-d|before:today',  
    ]);
    
    $user_id = auth('frontuser')->id();
    $validated['front_user_id'] = $user_id;
    $burs = Bursary::create($validated);   
       
        return response()->json(['status'=>true,'data'=>$burs,'message' => 'Bursary created successfully.'], 201);
    }
    public function storeSignature(Request $request)
    {
       $validated =  $request->validate([
        'id' => 'required|integer|exists:bursaries,id',
        'signature' => 'required|file|mimes:doc,docx,pdf,png,jpg,jpeg|max:8240'
        ]);
        
    $burs = Bursary::find($validated['id']);
    if($request->signature){
        $validated['signature'] = $request->signature->store('bursaries/signatures','public'); 
    }
    $burs = $burs->update($validated);   
       
        return response()->json(['status'=>true,'data'=>$burs,'message' => 'Bursary Signature Added successfully.'], 201);
    }
}
