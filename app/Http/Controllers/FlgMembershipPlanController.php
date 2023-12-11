<?php

namespace App\Http\Controllers;

use App\Models\FlgMembershipPlan;
use Carbon\Carbon;
use Illuminate\Http\Request;

class FlgMembershipPlanController extends Controller
{
    public function show(Request $request)
    {
       $flgmp = FlgMembershipPlan::where('team_category_id',$request->id);
        if($flgmp){
            $flgmp->date = Carbon::createFromFormat('Y-m-d H:i:s', $flgmp->date)->toDateString();
        }
        return response()->json(['status'=>true,'data' => $flgmp], 201);

    }
    public function destroy(FlgMembershipPlan $flgMembershipPlan)
    {
        $flgMembershipPlan->delete();

        return response()->json(['status'=>true,'message' => 'Flg Membership Plan deleted successfully']);
    }
}
