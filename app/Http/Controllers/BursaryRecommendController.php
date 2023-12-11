<?php

namespace App\Http\Controllers;

use App\Models\BursaryRecommend;
use Illuminate\Http\Request;

class BursaryRecommendController extends Controller
{
    public function indexAdmin(Request $request)
    {   
      
        if ($request->ajax()) {
          
            $data = BursaryRecommend::latest()->get();
            // }
            // $data = Buyer::select(['id', 'name', 'email','phone'])->get();
            return datatables()->of($data)
                ->addColumn('actions',function ($data){
                    return '
                    <div class="d-flex justify-content-center" >
                    <div class="ml-1 cp editbr" bid="'.$data->id.'"><span class="zmdi zmdi-delete icon-pencil icons text-warning"></span></div>
                    <div class="ml-1 cp deletebr"  bid="'.$data->id.'"><span class="zmdi zmdi-delete text-danger icon-trash icons"></span></div></div>
                    ';})
                ->addColumn('title',function ($data){
                    return '<a href="'.route('superadmin.bursaries.index',$data->id).'" >'.$data->title.'</a>';
                 })
                ->addColumn('total',function ($data){
                    return $data->bursaries->count();
                 })
           
                ->rawColumns(['actions','title'])
                ->make(true);
        }else{

        return view('superadmin.cms.bursary_recommends');
        }
    }
    public function index(Request $request) {
        $query = BursaryRecommend::query();
      
        if ($request->has('search')) {
            $search = $request->input('search');
            $query->where('title', 'LIKE', "%$search%")
            ->orWhere('location', 'like', "%$search%");
        }
        $query->orderBy('created_at', 'desc');
        $bursary_recommend = $query->paginate(10);
        return response()->json(['status'=>true,'data' => $bursary_recommend], 201); 

    }
    public function store(Request $request)
    {
       $validated =  $request->validate([
        'title'=> 'required|string|min:3',
        'location'=> 'required|string|min:3|max:400',
        'closing_date' => 'required|date_format:Y-m-d|after:today',  
    ]);

        $flgc = BursaryRecommend::create($validated);

        return response()->json(['status'=>true,'message' => 'Bursary Recommend created successfully.'], 201);
    }

    public function update(Request $request,$id)
    {
        // Validate the request data
        $validated = $request->validate([
            'title'=> 'required|string|min:3',
            'location'=> 'required|string|min:3|max:400',
            'closing_date' => 'required|date_format:Y-m-d|after:today',  
        ]);
      
        $br = BursaryRecommend::find($id)->update($validated);
        return response()->json(['status'=>true,'message' => 'Bursary Recommend Updated successfully'], 201);
    }

    public function show(Request $request)
    {
       $bursaryr = BursaryRecommend::find($request->id);
        return response()->json(['status'=>true,'data' => $bursaryr], 201);

    }

    public function destroy(BursaryRecommend $bursary_recommend)
    {
        $bursary_recommend->delete();

        return response()->json(['status'=>true,'message' => 'Bursary Recommend deleted successfully']);
    }
}
