<?php

namespace App\Http\Controllers;

use App\Models\BusinessCategory;
use App\Models\BusinessFundingCategory;
use App\Models\Category;
use App\Models\User;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    public function index(Request $request,$id=null)
    {   
        $currentCategory = Category::where('id',$id);
        if($currentCategory){
            $currentCategory= $currentCategory->first();
        }else{
            $currentCategory= null;
        }
        if ($request->ajax()) {
            if($id){
                $data = Category::where('type_id',$id)->get();
            }else{
            $data = Category::where('type_id',null)->get();
            }
            // $data = Buyer::select(['id', 'name', 'email','phone'])->get();
            return datatables()->of($data)
                ->addColumn('actions',function ($data){
                    return '<div typ="main" cid="'.$data->id.'" class="d-flex align-items-center justify-content-center acCont">
                    <div class="ml-1 cp editcategory" ><span class="zmdi zmdi-delete icon-pencil icons text-warning"></span></div>
                    <div class="ml-1 cp deletecategory" ><span class="zmdi zmdi-delete text-danger icon-trash icons"></span></div>
                  </div> ';})
                  ->addColumn('cname', function ($data) {
                    $tpArr = ['main','region'];
                    // $tpwArr = ['withdrawal','contribution','user'];
                    $colD = $data->name;
                    if(in_array($data->type,$tpArr)){
                      $colD = '<a href="'.route('superadmin.categories',$data->id).'">'.$data->name.'</a>';
                    }
                    if($data->slug=='business_categories'){
                        $colD = '<a href="'.route('superadmin.business_categories').'">'.$data->name.'</a>';
                    }elseif($data->slug=='business_funding'){
                        $colD = '<a href="'.route('superadmin.business_funding_categories').'">'.$data->name.'</a>';
                    }
                    return $colD;
                  })
                  ->addColumn('index', function ($data) {
                    return 1;
                  })
                  ->addColumn('total', function ($data) {
                    $categoryCount = Category::where('type_id',$data->id)->count();
                    if($data->slug=='business_categories'){
                        $categoryCount = BusinessCategory::count();
                    }elseif($data->slug=='business_funding'){
                        $categoryCount = BusinessFundingCategory::count();
                    }
                    return $categoryCount;
                  })
                // ->addColumn('actions', function ($testimonial) {
                //    <div class="col-1 d-flex align-items-center justify-content-between acbtnCont" type="buyer" uid='.$data->id.'>
            //     <img class="cursor-pointer viewuser"  src="../images/eye_blue.png" alt="">
            //     <img class="cursor-pointer blockuser" src="../images/stop_yellow.png" alt="">
            //     <img class="cursor-pointer deleteuser" src="../images/delete.png" alt="">
            // </div>
                // })
                ->rawColumns(['actions','cname'])
                ->make(true);
        }else{

        return view('superadmin.categories.index',compact('currentCategory'));
        }
    }
    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string',
            'type_id' => 'sometimes|integer|exists:categories,id',
            'type' => 'required|string|in:main,region,branch,withdrawal,contribution,user',
            'action' => 'required|string',
            'id' => 'sometimes|required|exists:categories,id',
        ]);
        if($validated['action'] =='add'){
        $categoryCreate = Category::create($validated);
        }elseif($validated['id'] && ($validated['action'] =='edit')){
            $category = Category::find($validated['id']);
            $categoryCreate = $category->update($validated);
            }

       

        return response()->json(['status'=>true,'message' => 'Category '.ucfirst($validated['action']).'ed successfull.'], 201);
    }
    public function destroy(Category $category)
    {
        $category->delete();

        return response()->json(['status'=>true,'message' => 'Category deleted successfully']);
    }
    public function getByType(Request $request)
    {
        $validated = $request->validate([
            'type' => 'required|in:region,branch,withdrawal,contribution,user'
        ]);
        if($request->has('type')){
            $categories = Category::where('type',$validated['type'])->get();
            return response()->json(['status'=>true,'data' => $categories]);
        }
        return response()->json(['status'=>false,'message' => 'No data.']);

        
    }
    public function getRegionBranches(Request $request)
    {
        $validated = $request->validate([
            'type_id' => 'required|exists:categories,type_id'
        ]);
        if($request->has('type_id')){
            $categories = Category::where('type_id',$validated['type_id'])->get();
            return response()->json(['status'=>true,'data' => $categories]);
        }
        return response()->json(['status'=>false,'message' => 'No data.']);
        
    }
    public function get_branch_secretary_by_region(Request $request)
    {
        $validated = $request->validate([
            'region_id' => 'required|exists:categories,id'
        ]);
        if($request->has('region_id')){
            $categoriesIds = Category::where('type_id',$validated['region_id'])->pluck('id')->toArray();
            $users = User::where('role','branch_secretary')->whereIn('category_id', $categoriesIds)->get();

            // dd($users);
            return response()->json(['status'=>true,'data' => $users]);
        }
        return response()->json(['status'=>false,'message' => 'No data.']);
        
    }
}
