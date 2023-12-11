<?php

namespace App\Http\Controllers;

use App\Models\FlgMembershipPlan;
use App\Models\TeamCategory;
use Carbon\Carbon;
use Illuminate\Http\Request;
use PHPUnit\TextUI\XmlConfiguration\Logging\TeamCity;

class TeamCategoryController extends Controller
{
    public function index(Request $request) {
        if ($request->ajax()) {
            $data =  TeamCategory::get();
            // dd($data);
            return datatables()->of($data)
                ->addColumn('actions',function ($data){
                 
                    return '  <div class="d-flex justify-content-center" >
                    <div class="ml-1 cp edittc" tid="'.$data->id.'"  title="Edit Team and Membership Plans" ><span class="zmdi zmdi-delete ti-pencil-alt  text-success"></span></div>
                   
                    <div class="ml-1 cp deletetc"  tid="'.$data->id.'"><span class="zmdi zmdi-delete text-danger icon-trash icons"></span></div></div>';})
                ->addColumn('plans', function ($data) {
                    return $data->membership_plans()->count();
                })
                ->rawColumns(['actions'])
                ->make(true);
        }
        return view('superadmin.cms.team_categories');
    
    }
    public function store(Request $request)
    {
       $validated =  $request->validate([
            'name' => 'required|string|min:4|max:250',
        ]);
        $data = array('name'=>$validated['name']);
        $name = TeamCategory::create($data);

        return response()->json(['status'=>true,'message' => 'Team Category created successfully'], 201);
    }
    public function update(Request $request,$id)
    {
        // Validate the request data
        // dd($request->plans);
        $validated = $request->validate([
            'name' => 'required|string|min:3',
            'plans' => 'required|array',
            'plans.*.month' => 'required|integer',
            'plans.*.amount_min' => 'required|numeric',
            'plans.*.amount_max' => 'required|numeric',
        ]);
        $teamcategory = TeamCategory::find($id);
        if($teamcategory){
            $teamcategory->update(['name'=>$request->name]);
            
            foreach ($request->plans as $plan) {
                $plan['team_category_id']=$teamcategory->id;
                FlgMembershipPlan::updateOrCreate(['month'=>$plan['month'],'team_category_id'=>$teamcategory->id],$plan);
            }
        }
        return response()->json(['status'=>true,'message' => 'Team Category and Membership Pans Udated successfully'], 201);
    }
    public function show(Request $request)
    {
       $team_category = TeamCategory::with('membership_plans')->find($request->id);
        // if($team_category){
        //     $team_category->date = Carbon::createFromFormat('Y-m-d H:i:s', $team_category->date)->toDateString();
        // }
        return response()->json(['status'=>true,'data' => $team_category], 201);

    }
    public function destroy(TeamCategory $teamcategory)
    {
        $teamcategory->delete();

        return response()->json(['status'=>true,'message' => 'Team Catrgory deleted successfully']);
    }
}
