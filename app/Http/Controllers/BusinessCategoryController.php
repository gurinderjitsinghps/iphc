<?php

namespace App\Http\Controllers;

use App\Models\Business;
use App\Models\BusinessCategory;
use Illuminate\Http\Request;

class BusinessCategoryController extends Controller
{
    public function index(Request $request,$id=null)
    {   
        $currentCategory = BusinessCategory::where('id',$id);
        if($currentCategory){
            $currentCategory= $currentCategory->first();
        }else{
            $currentCategory= null;
        }
        if ($request->ajax()) {
            if($id){
                $data = BusinessCategory::where('parent_id',$id)->get();
            }else{
            $data = BusinessCategory::where('parent_id',null)->get();
            }
            // $data = Buyer::select(['id', 'name', 'email','phone'])->get();
            return datatables()->of($data)
                ->addColumn('actions',function ($data){
                    return '<div typ="main" bid="'.$data->id.'" class="d-flex align-items-center justify-content-center acCont">
                    <div class="ml-1 cp editcategory" ><span class="zmdi zmdi-delete icon-pencil icons text-warning"></span></div>
                    <div class="ml-1 cp deletecategory" ><span class="zmdi zmdi-delete text-danger icon-trash icons"></span></div>
                  </div> ';})
                  ->addColumn('cname', function ($data) {
                    // $colD = $data->name;
                    if($data->parent_id != null){
                      $colD = '<a href="'.route('superadmin.business_categories.businesses',$data->id).'">'.$data->name.'</a>';
                    }else{
                        $colD = '<a href="'.route('superadmin.business_categories',$data->id).'">'.$data->name.'</a>';
                    }
                    return $colD;
                  })
                  ->addColumn('index', function ($data) {
                    return 1;
                  })
                  ->addColumn('total', function ($data) {
                    if($data->parent_id != null){
                        $categoryCount = Business::where('category_id',$data->id)->count();
                      }else{
                    $categoryCount = BusinessCategory::where('parent_id',$data->id)->count();
                      }
                    return $categoryCount;
                  })
                
                ->rawColumns(['actions','cname'])
                ->make(true);
        }else{

        return view('superadmin.business_categories.index',compact('currentCategory'));
        }
    }
    public function indexBusinesses(Request $request,$id=null)
    {    if(!$id)return false;
        $currentCategory = BusinessCategory::where('id',$id);
        if($currentCategory){
            $currentCategory= $currentCategory->first();
        }else{
            return false;
        }
        if ($request->ajax()) {
                $data = Business::where('category_id',$id)->get();
            // $data = Buyer::select(['id', 'name', 'email','phone'])->get();
            return datatables()->of($data)
                ->make(true);
        }else{

        return view('superadmin.business_categories.businesses',compact('currentCategory'));
        }
    }
    public function indexFront(Request $request,$id=null)
    {   
        $currentCategory = BusinessCategory::where('id',$id);
        if($currentCategory){
            $currentCategory= $currentCategory->first();
        }else{
            $currentCategory= null;
        }
            if($id){
                $data = BusinessCategory::where('parent_id',$id)->get();
            }else{
            $data = BusinessCategory::where('parent_id',null)->get();
            }
            return response()->json(['status'=>true,'data' => $data,'current_category'=>$currentCategory], 201);
    }
    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string',
            'parent_id' => 'sometimes|integer|exists:business_categories,id',
            'action' => 'required|string',
            'image' => 'sometimes|file|mimes:png,jpg,jpeg|max:2048',
            'id' => 'sometimes|required|exists:business_categories,id',
        ]);
        if($request->image){
            $image = $request->image->store('business_categories/','public'); 
            $validated['image'] = $image;
            }
        if($validated['action'] =='add'){
        $categoryCreate = BusinessCategory::create($validated);
        }elseif($validated['id'] && ($validated['action'] =='edit')){
            $category = BusinessCategory::find($validated['id']);
            $categoryCreate = $category->update($validated);
        }


        return response()->json(['status'=>true,'message' => 'Category '.ucfirst($validated['action']).'ed successfull.'], 201);
    }
    public function destroy(BusinessCategory $category)
    {
        $category->delete();

        return response()->json(['status'=>true,'message' => 'Category deleted successfully']);
    }
}
