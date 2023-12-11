<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Member;
use App\Models\Submission;
use App\Traits\UserRole;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

class SubmissionController extends Controller
{
    use UserRole;
    public function index(Request $request)
    {
        $rbd = $this->getRegionBranch();
        $user = auth('user')->user();
        $query = Submission::with('submissionable');
        
        // Filter by submissionable_type (multiple checkboxes)
        // $query;
        // dd($rbd);
        if(!empty($rbd)){
            if($user->role_level =='regional'){
                $rbDt['branch_id']=0;
            }
            foreach($rbd as $k => $r){
                if($r !== 0){
                $query->where($k,$r);
                }
            }
        }
        if($user->role_level =='branch' ||$user->role_level =='regional'){
            $query->where('status_level', 'branch');
        }elseif($user->role_level =='national'){
                $query->where('status_level', 'regional');
        }

        if($user->role_level =='regional'|| $user->role_level =='national'){
            if ($request->has('branch_id')) {
                $query->where('branch_id', $request->input('branch_id'));
            }
            if ($request->has('year')) {
                $query->whereYear('created_at', $request->input('year'));
            }
        }
        if($user->role_level =='national'){
            if ($request->has('region_id')) {
                $query->where('region_id', $request->input('region_id'));
            }
        }
        if ($request->has('search')) {
            $keyword = $request->input('search');
            $query->whereHas('submissionable', function ($queryy) use ($keyword) {
                // dd($queryy->from);
                if ($queryy->from == 'events') {
                    $queryy->where('events.title', 'like', '%' . $keyword . '%')->orWhere('events.description', 'like', '%' . $keyword . '%')->orWhere('events.event_purpose', 'like', '%' . $keyword . '%');
                }    
                if ($queryy->from == 'withdrawals') {
                    $queryy->where('withdrawals.name', 'like', '%' . $keyword . '%')->orWhere('withdrawals.justification', 'like', '%' . $keyword . '%');
                }    
                
               
             
            });
            // })->orWhere('body', 'like', '%' . $keyword . '%');
            
        }
        if ($request->has('type')) {
            $query->whereIn('type', $request->input('type'));
        }

        // Filter by from_date and to_date
        if ($request->has('from_date') && $request->has('to_date')) {
            $query->whereBetween('created_at', [$request->input('from_date'), $request->input('to_date')]);
        }
        $query->orderBy('created_at', 'desc');
        $submissions = $query->get();
        $members = Member::query();
        if ($request->has('branch_id')) {
            $members = $members->where('branch_id',$request->input('branch_id'));
            $tbm = $members->count();
        }else{
            $tbm =0;
        }
        if ($request->has('year')) {
            $members = $members->whereYear('created_at',$request->input('year'));
        }
        $members = $members->get();
       $submissionsGraphData =     $submissions->groupBy(function ($submission) {
        // Group submissions by year and month
        return $submission->created_at->format('Y');
    })
    ->map(function ($submissionsByYear, $year)use($tbm) {
        return
         $submissionsByYear->groupBy(function ($submission) {
                return $submission->created_at->format('M');
            })->map(function ($submissionsByMonth, $month)use($tbm) {
                // dd($submissionsByMonth);
                $dg = ['total_branch_submissions'=>$submissionsByMonth->count()];
                $dg['total_branch_members']= $tbm;                
                return $dg;
                // return  $submissionsByMonth;
            });
    })
    ->toArray();
        $jsonData = ['status'=>true,'data' => $submissions];
        if($user->role_level =='regional'|| $user->role_level =='national'){
            $jsonData['submissionsGraphData'] = $submissionsGraphData;
            $jsonData['members'] = $members;
        }
        // $jsonData['summary'] = $this->submissions_summary();
        return response()->json($jsonData, 201);
    }
    public function submissions_summary_report()
    {
    $result = [];
    $year =  date('Y');
    foreach (range(1, 12) as $month) {
        $query = Submission::query();
        if (request()->has('year')) {
            $year = request()->input('year');
            $query->whereYear('created_at', request()->input('year'));
        }else{
            $query->whereYear('created_at', date('Y'));
        }
        if (request()->has('from_date') && request()->has('to_date')) {
            $query->whereBetween('created_at', [request()->input('from_date'), request()->input('to_date')]);
        }
           $submissions= $query->whereMonth('created_at', $month)
            ->select('branch_id', DB::raw('COUNT(*) as submisson_count'))
            ->groupBy('branch_id')
            ->get();

        foreach ($submissions as $sub) {
            if($sub->branch_id != 0){
            $result[$year][$month][$sub->branch_id] = $sub;
            }
        }
    }
    $rbd = $this->getRegionBranch();
    $branches =[];
    if($rbd['region_id'] != 0){
    $branches = Category::where('type','branch')->where('type_id',$rbd['region_id'])->get();
    }
    return response()->json(['status'=>true,'data'=>$result,'branches'=>$branches], 201);
}
    public function show(Request $request,$id)
    {
        $rbd = $this->getRegionBranch();
        $submission = Submission::with('submissionable')->where('id',$id);
        if(!empty($rbd)){
            foreach($rbd as $k => $r){
                if($r !== 0){
                $submission->where($k,$r);
                }
            }
        }
        if(!$submission) return response()->json(['status'=>false,'message' =>'Invalid Submission'], 201);
       
        return response()->json(['status'=>true,'data' => $submission->first()], 201);
    }
    public function update(Request $request,Submission $submission)
    {
        if(!$submission) return response()->json(['status'=>false,'message' =>'Invalid Submission'], 201);
        $validated = $request->validate([
            'status' => 'required|in:accepted,rejected,final'
        ]);
        $user = auth('user')->user();
        
        $submission->update([
            'status_update_by_id'=> $user->id,
            'status_level'=> $user->role_level,
            'status'=>$validated['status'],
        ]);

    

        return response()->json(['status'=>true,'message' => 'Submission Updated.'], 201);
    }

    public function adminSubmissionsGraph(Request $request)
    {
            $query = Submission::selectRaw('MONTH(created_at) as month,branch_id, COUNT(id) as total')
            ->groupBy('month', 'branch_id');

            if ($request->has('syear') && $request->input('syear') != '') {
                $query->whereYear('created_at', $request->input('syear', date('Y')));
            }
       
            if ($request->has('sregion') && ($request->input('sregion') != '')) {
                $query->where('region_id', $request->input('sregion'));
            }
        $data = $query->get();
        return response()->json(['status'=>true,'data'=>$data], 201);

    }
}
