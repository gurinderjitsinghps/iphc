<?php

namespace App\Http\Controllers;

use App\Models\Sermon;
use Carbon\Carbon;
use Illuminate\Http\Request;

class SermonController extends Controller
{
    public function index(Request $request)
    {   
      
        if ($request->ajax()) {
          
            $data = Sermon::get();
            // }
            // $data = Buyer::select(['id', 'name', 'email','phone'])->get();
            return datatables()->of($data)
                ->addColumn('actions',function ($data){
                    return '
                    <div class="d-flex justify-content-center" >
                    <div class="ml-1 cp editSermon" sid="'.$data->id.'"><span class="zmdi zmdi-delete icon-pencil icons text-warning"></span></div>
                    <div class="ml-1 cp deleteSermon"  sid="'.$data->id.'"><span class="zmdi zmdi-delete text-danger icon-trash icons"></span></div></div>
                    ';})
                  ->addColumn('number', function ($data) {
                   return 1;
                  })
                  ->addColumn('date', function ($data) {
                   return Carbon::createFromFormat('Y-m-d H:i:s', $data->date)->toDateString();
                })
                  ->addColumn('thumbnailH', function ($data) {
                   return '<video width="80" controls="controls" preload="metadata">
                   <source src="/storage/'.$data->thumbnail.'#t=20" type="video/mp4">
                 </video>';
                  })
           
                ->rawColumns(['thumbnailH','actions'])
                ->make(true);
        }else{

        return view('superadmin.sermons.index');
        }
    }
    public function indexFront(Request $request)
    { 
        $query = Sermon::query();
        // if ($request->has('search')) {
        //     $search = $request->input('search');
        //     $query->where('invoice_no', 'LIKE', "%$search%")
        //     ->orWhere('branch_name', 'like', "%$search%")
        //     ->orWhere('brought_by', 'like', "%$search%")
        //     ->orWhere('grand_total', 'like', "%$search%");
        // }
        $query->orderBy('created_at', 'desc');
        $sermons = $query->paginate(10);
        return response()->json(['status'=>true,'data' => $sermons], 201); 
    }
    public function store(Request $request)
    {
        // Validate the request data
        $validated = $request->validate([
            'title' => 'required|string',
            'date' => 'required|date_format:Y-m-d',
            'thumbnail' => 'file|mimes:mp4,avi,mov|max:204800',
        ]);
        if($request->thumbnail){
            $thumbnail = $request->thumbnail->store('sermons/','public'); 
            $validated['thumbnail'] = $thumbnail;
            }
        $Sermon = Sermon::create($validated);
        return response()->json(['status'=>true,'message' => 'Sermon created successfully'], 201);
    }
    public function update(Request $request,$id)
    {
        // Validate the request data
        $validated = $request->validate([
            'title' => 'required|string',
            'date' => 'required|date_format:Y-m-d',
            'thumbnail' => 'file|mimes:mp4,avi,mov|max:204800',
        ]);
        if($request->thumbnail){
            $thumbnail = $request->thumbnail->store('sermons/','public'); 
            $validated['thumbnail'] = $thumbnail;
            }
        $Sermon = Sermon::find($id)->update($validated);
        return response()->json(['status'=>true,'message' => 'Sermon UPdated successfully'], 201);
    }

    public function show(Request $request)
    {
       $sermon = Sermon::find($request->id);
       if ($request->isMethod('post')) {
        if($sermon){
            $sermon->date = Carbon::createFromFormat('Y-m-d H:i:s', $sermon->date)->toDateString();
        }
        return response()->json(['status'=>true,'data' => $sermon], 201);
       }
       return view('superadmin.sermons.view',compact('sermon'));

    }

    public function destroy(Sermon $sermon)
    {
        $sermon->delete();

        return response()->json(['status'=>true,'message' => 'Sermon deleted successfully']);
    }
}
