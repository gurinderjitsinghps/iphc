<?php

namespace App\Http\Controllers;

use App\Models\BusinessFunding;
use App\Models\BusinessFundingCategory;
use Illuminate\Http\Request;

class BusinessFundingCategoryController extends Controller
{
    public function index(Request $request,$id=null)
    {   
        $currentCategory = BusinessFundingCategory::where('id',$id);
        if($currentCategory){
            $currentCategory= $currentCategory->first();
        }
        if ($request->ajax()) {
            $data = BusinessFundingCategory::get();
                return datatables()->of($data)
                ->addColumn('actions',function ($data){
                    return '<div cid="'.$data->id.'" class="d-flex align-items-center justify-content-center acCont">
                    <div class="ml-1 cp editcategory" ><span class="zmdi zmdi-delete icon-pencil icons text-warning"></span></div>
                    <div class="ml-1 cp deletecategory" ><span class="zmdi zmdi-delete text-danger icon-trash icons"></span></div>
                  </div> ';})
                  ->addColumn('cname', function ($data) {
                    // $colD = $data->name;
                    // if($data->parent_id != null){
                      $colD = '<a href="'.route('superadmin.business_funding_categories.fundings',$data->id).'">'.$data->name.'</a>';
                    // }
                    return $colD;
                  })
                  ->addColumn('image', function ($data) {
                    return '<img width="46" src="/storage/'.$data->image.'" />';
                   })
                  ->addColumn('total', function ($data) {
                    $categoryCount = BusinessFunding::where('business_funding_category_id',$data->id)->count();
                    return $categoryCount;
                  })
                
                ->rawColumns(['actions','cname','image'])
                ->make(true);
        }else{

        return view('superadmin.business_funding_categories.index',compact('currentCategory'));
        }
    }
    public function indexFundings(Request $request,$id=null)
    {    if(!$id)return false;
        $currentCategory = BusinessFundingCategory::find($id);
        if(!$currentCategory){
            return false;
        }
        if ($request->ajax()) {
                $data = BusinessFunding::where('business_funding_category_id',$id)->get();
            // $data = Buyer::select(['id', 'name', 'email','phone'])->get();
            return datatables()->of($data)
                ->make(true);
        }else{

        return view('superadmin.business_funding_categories.fundings',compact('currentCategory'));
        }
    }
    public function indexFront(Request $request,$id=null)
    {   
        $currentCategory = BusinessFundingCategory::where('id',$id);
        if($currentCategory){
            $currentCategory= $currentCategory->first();
        }else{
            $currentCategory= null;
        }
            if($id){
                $data = BusinessFundingCategory::where('parent_id',$id)->get();
            }else{
            $data = BusinessFundingCategory::where('parent_id',null)->get();
            }
            return response()->json(['status'=>true,'data' => $data,'current_category'=>$currentCategory], 201);
    }
    public function store(Request $request)
    { 
        $validated = $request->validate([
            'name' => 'required|string|min:3',
            'size' => 'required|string|min:2',
            'interests' => 'required|string|min:3',
            'inclusions' => 'required|string|min:3',
            'other' => 'required|string|min:3',
            'action' => 'required|string|in:add,edit',
            'image' => 'sometimes|file|mimes:png,jpg,jpeg|max:2048',
            'id' => 'sometimes|required|exists:business_funding_categories,id',
        ]);
        if($request->image){
            $image = $request->image->store('business_funding_categories/','public'); 
            $validated['image'] = $image;
         }
         $randomNumber = random_int(1000, 99999);
         $validated['registered_number'] = $randomNumber;
        if($validated['action'] =='add'){
        $categoryCreate = BusinessFundingCategory::create($validated);
        }elseif($validated['id'] && ($validated['action'] =='edit')){
            $category = BusinessFundingCategory::find($validated['id']);
            $categoryCreate = $category->update($validated);
        }


        return response()->json(['status'=>true,'message' => 'Business Funding Category '.ucfirst($validated['action']).'ed successfull.'], 201);
    }
    public function show(Request $request)
    {
       $cat = BusinessFundingCategory::find($request->id);
        return response()->json(['status'=>true,'data' => $cat], 201);

    }
    public function destroy(BusinessFundingCategory $category)
    {
        $category->delete();

        return response()->json(['status'=>true,'message' => 'Business Funding Category deleted successfully']);
    }
}
