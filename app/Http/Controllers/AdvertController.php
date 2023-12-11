<?php

namespace App\Http\Controllers;

use App\Models\Advert;
use App\Models\AdvertAttachment;
use Carbon\Carbon;
use Illuminate\Http\Request;

class AdvertController extends Controller
{
    public function index(Request $request)
    {   
      
        if ($request->ajax()) {
          
            $data = Advert::get();
            // }
            // $data = Buyer::select(['id', 'name', 'email','phone'])->get();
            return datatables()->of($data)
                ->addColumn('actions',function ($data){
                    // if($data->is_blocked){
                    //     $blockCls ='zmdi zmdi-lock-open text-success'; 
                    //     $blockTtl ='Unblock User'; 
                    // }else{
                    //     $blockCls ='zmdi zmdi-lock-outline text-warning'; 
                    //     $blockTtl ='Block User'; 
                    // }
                    return '<div class="d-flex justify-content-center"><a href="'.route('superadmin.adverts.show',$data->id).'" class="d-flex align-items-center justify-content-center acCont" >
                    <div class="ml-1 cp editadvert" ><span class="zmdi zmdi-delete icon-eye icons text-success"></span></div></a>
                    <div class="ml-1 cp editadvert" aid="'.$data->id.'"><span class="zmdi zmdi-delete icon-pencil icons text-warning"></span></div>
                    <div class="ml-1 cp deleteadvert"  aid="'.$data->id.'"><span class="zmdi zmdi-delete text-danger icon-trash icons"></span></div>
                    </div>';})
                  ->addColumn('number', function ($data) {
                   return '';
                  })
           
                ->rawColumns(['actions'])
                ->make(true);
        }else{

        return view('superadmin.adverts.index');
        }
    }
    public function store(Request $request)
    {
        // Validate the request data
        $validated = $request->validate([
            'cost' => 'required|numeric',
            'title' => 'required|string',
            'seller' => 'required|string',
            'details' => 'required|string',
            'email' => 'required|string',
            'phone' => [
                'required',
                'string',
                'regex:/^(\+[0-9]{1,3})?[0-9\s-]+$/',
                'min:10', // Adjust the minimum length as needed
                'max:15', // Adjust the maximum length as needed
            ],
            'url' => 'required|string',
            'start_date' => 'required|date_format:Y-m-d',
            'end_date' => 'required|date_format:Y-m-d|after:start_date',       
            'attachments.*' => 'image|mimes:jpeg,png,jpg|max:2048',
        ],[
            'phone.regex' => 'Please enter a valid phone number with digits, spaces, hyphens, and an optional plus sign.',

            'end_date.after' => 'The end date must be after the start date.',
            'start_date.date_format' => 'The start date should be in the format YYYY-MM-DD HH:MM:SS.',
            'end_date.date_format' => 'The end date should be in the format YYYY-MM-DD HH:MM:SS.',
        ]);
        // $user = auth('user')->user();
        // $validated['user_id'] = $user->id;
        // $rbDt = $this->getRegionBranch();
        // $validated = array_merge($validated,$rbDt);

        // Create a new withdrawal
        $advert = Advert::create($validated);

        if ($request->hasFile('attachments')) {
            foreach($request->attachments as $document) {
                $documentPath = $document->store('adverts/attachments','public'); 
                $fileName = basename($documentPath);
                $documentCreate = [
                    'advert_id'=> $advert->id,
                    'file_name'=> $fileName,
                    'file_path'=> $documentPath,
                    'file_size'=> $document->getSize(),
                    'file_type'=> $document->getMimeType(),
                ];
                $documentModel = AdvertAttachment::create($documentCreate);
               
            }
        }

        return response()->json(['status'=>true,'message' => 'Advert created successfully'], 201);
    }
    public function update(Request $request,$id)
    {
        // Validate the request data
        $validated = $request->validate([
            'cost' => 'required|numeric',
            'title' => 'required|string',
            'seller' => 'required|string',
            'details' => 'required|string',
            'email' => 'required|string',
            'phone' => [
                'required',
                'string',
                'regex:/^(\+[0-9]{1,3})?[0-9\s-]+$/',
                'min:10', // Adjust the minimum length as needed
                'max:15', // Adjust the maximum length as needed
            ],
            'url' => 'required|string',
            'start_date' => 'required|date_format:Y-m-d',
            'end_date' => 'required|date_format:Y-m-d|after:start_date',       
            'attachments.*' => 'sometimes|image|mimes:jpeg,png,jpg|max:2048',
        ],[
            'phone.regex' => 'Please enter a valid phone number with digits, spaces, hyphens, and an optional plus sign.',

            'end_date.after' => 'The end date must be after the start date.',
            'start_date.date_format' => 'The start date should be in the format YYYY-MM-DD HH:MM:SS.',
            'end_date.date_format' => 'The end date should be in the format YYYY-MM-DD HH:MM:SS.',
        ]);
      
        $advert = Advert::find($id);
        $advert->update($validated);
        if ($request->hasFile('attachments')) {
            foreach($request->attachments as $document) {
                $documentPath = $document->store('adverts/attachments','public'); 
                $fileName = basename($documentPath);
                $documentCreate = [
                    'advert_id'=> $advert->id,
                    'file_name'=> $fileName,
                    'file_path'=> $documentPath,
                    'file_size'=> $document->getSize(),
                    'file_type'=> $document->getMimeType(),
                ];
                $documentModel = AdvertAttachment::create($documentCreate);
               
            }
        }

        return response()->json(['status'=>true,'message' => 'Advert Updated successfully'], 201);
    }
    public function show(Request $request, $id)
    {
       $advert = Advert::with('attachments')->find($id);
       if ($request->ajax()) {
        return response()->json(['status'=>true,'advert' => $advert], 201);
       }
       return view('superadmin.adverts.view',compact('advert'));

    }
    public function advertGet(Request $request)
    {
       $advert = Advert::with('attachments')->find($request->id);
       $advert->start_date = Carbon::parse($advert->start_date)->format('Y-m-d');
       $advert->end_date = Carbon::parse($advert->end_date)->format('Y-m-d');
        return response()->json(['status'=>true,'data' => $advert], 201);

    }
    public function destroy(Advert $advert)
    {
        $advert->delete();

        return response()->json(['status'=>true,'message' => 'Advert deleted successfully']);
    }
}
