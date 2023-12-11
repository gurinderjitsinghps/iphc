<?php

namespace App\Http\Controllers;

use App\Models\News;
use Carbon\Carbon;
use Illuminate\Http\Request;

class NewsController extends Controller
{
    public function index(Request $request)
    {   
      
        if ($request->ajax()) {
          
            $data = News::get();
            // }
            // $data = Buyer::select(['id', 'name', 'email','phone'])->get();
            return datatables()->of($data)
                ->addColumn('actions',function ($data){
                    return '
                    <div class="d-flex justify-content-center" >
                    <div class="ml-1 cp editNews" sid="'.$data->id.'"><span class="zmdi zmdi-delete icon-pencil icons text-warning"></span></div>
                    <div class="ml-1 cp deleteNews"  sid="'.$data->id.'"><span class="zmdi zmdi-delete text-danger icon-trash icons"></span></div></div>
                    ';})
                  ->addColumn('number', function ($data) {
                   return 1;
                  })
                  ->addColumn('posted_at', function ($data) {
                   return Carbon::createFromFormat('Y-m-d H:i:s', $data->posted_at)->toDateString();
                })
                  ->addColumn('thumbnailH', function ($data) {
                   return '<img width="46" src="/storage/'.$data->thumbnail.'" />';
                  })
           
                ->rawColumns(['thumbnailH','actions'])
                ->make(true);
        }else{

        return view('superadmin.news.index');
        }
    }

    public function store(Request $request)
    {
        // Validate the request data
        $validated = $request->validate([
            'title' => 'required|string',
            'description' => 'required|string',
            'posted_at' => 'required|date_format:Y-m-d',
            'thumbnail' => 'image|mimes:jpeg,png,jpg|max:2048',
        ]);
        if($request->thumbnail){
            $thumbnail = $request->thumbnail->store('news/','public'); 
            $validated['thumbnail'] = $thumbnail;
            }
        $Sermon = News::create($validated);
        return response()->json(['status'=>true,'message' => 'News created successfully'], 201);
    }
    public function update(Request $request,$id)
    {
        // Validate the request data
        $validated = $request->validate([
            'title' => 'required|string',
            'description' => 'required|string',
            'posted_at' => 'required|date_format:Y-m-d',
            'thumbnail' => 'sometimes|image|mimes:jpeg,png,jpg|max:2048',
        ]);
        if($request->thumbnail){
            $thumbnail = $request->thumbnail->store('news/','public'); 
            $validated['thumbnail'] = $thumbnail;
            }
        $Sermon = News::find($id)->update($validated);
        return response()->json(['status'=>true,'message' => 'News Updated successfully'], 201);
    }

    public function show(Request $request)
    {
       $news = News::find($request->id);
       if ($request->isMethod('post')) {
        if($news){
            $news->posted_at = Carbon::createFromFormat('Y-m-d H:i:s', $news->posted_at)->toDateString();
        }
        return response()->json(['status'=>true,'data' => $news], 201);
       }
       return view('superadmin.news.view',compact('news'));

    }

    public function destroy(News $news)
    {
        $news->delete();

        return response()->json(['status'=>true,'message' => 'News deleted successfully']);
    }
}
