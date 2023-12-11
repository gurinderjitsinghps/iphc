<?php

namespace App\Http\Controllers;

use App\Models\Event;
use App\Models\Submission;
use App\Traits\UserRole;
use Illuminate\Http\Request;

class EventController extends Controller
{ use UserRole;
    function indexFront(Request $request) {
        $query = Event::query();
        // $level =  $request->has('level')? $request->input('level') : false;
        $query->whereRaw('now() <= end_date');
        // if ($request->has('date')) {
        //     $query->where('start_date', $request->input('type'));
        // }
        $query->orderBy('created_at', 'desc');
        $events = $query->paginate(10);
        return response()->json(['status'=>true,'data' => $events], 201); 
    
    }
    function index(Request $request) {
        $user = auth('user')->user();
        $query = Event::query();
        $query->with(['submission']);

        $rbDt = $this->getRegionBranch();
        // dd($rbDt);
        $level =  $request->has('level')? $request->input('level') : false;
        if($level == 'national' || $level=='all'){
            $rbDt =[];
        }
        if(!empty($rbDt)){
            if($level == 'branch'){
                if($user->role_level =='regional'){
                    unset($rbDt['branch_id']);
                }else{
                unset($rbDt['region_id']);
                }
            }
            if($level == 'region'){
                $rbDt['branch_id'] =0;
                // unset($rbDt['branch_id']);
            }
            foreach($rbDt as $k => $r){
                if($r !== 0){      
                $query->where($k,$r);
                }
            }
        } 
        if ($request->has('status')) {
            $status = $request->input('status');
            $query->whereHas('submissions', function ($queryy) use ($status) {
                // dd($queryy->from);
                    $queryy->where('submissions.status', $status);
            });
            
        }
        // if ($request->has('type')) {
        //     $query->where('type', $request->input('type'));
        // }
        if ($request->has('is_approved')) {
            $query->where('is_approved', $request->input('is_approved'));
        }
        if ($request->has('search')) {
            $search = $request->input('search');
            $query->where('title', 'LIKE', "%$search%")
            ->orWhere('description', 'like', "%$search%")
            ->orWhere('venue', 'like', "%$search%")
            ->orWhere('host_name', 'like', "%$search%");
        }
        $currentTimestamp = now();

        // $query->where('start_date', '<=', $currentTimestamp)
        // ->where('end_date', '>', $currentTimestamp);
        $query->orderBy('created_at', 'desc');
        $events = $query->paginate(10);
        return response()->json(['status'=>true,'data' => $events], 201); 
    
    }
    public function store(Request $request)
    {
        // Validate the request data
        $validated = $request->validate([
            'title' => 'required|string',
            'email' => 'required|email',
            
            'description' => 'required|string',
            'approx_attending'=>'required|integer',
            'venue'=>'required|string|min:2',
            'host_name'=>'required|string|min:2',
            'event_purpose'=>'required|string|min:6',
            'type'=> 'required|in:branch,regional,national',
            'budget_price'=>'required|numeric',
            'start_date' => 'required|date_format:Y-m-d H:i:s',
            'end_date' => 'required|date_format:Y-m-d H:i:s|after:start_date',
            'cover_photo' => 'required|image|mimes:jpeg,png,jpg|max:2048',
        ],[
            'end_date.after' => 'The end date must be after the start date.',
            'start_date.date_format' => 'The start date should be in the format YYYY-MM-DD HH:MM:SS.',
            'end_date.date_format' => 'The end date should be in the format YYYY-MM-DD HH:MM:SS.',
        ]);
        $user = auth('user')->user();
        $validated['user_id'] = $user->id;
        $rbDt = $this->getRegionBranch();
        $validated = array_merge($validated,$rbDt);
        // dd($validated);
        if ($request->hasFile('cover_photo')) {
            $filePath = $request->file('cover_photo')->store('events/photos','public'); 
            $validated['cover_photo'] = $filePath;
        }
        $event = Event::create($validated);
        $subCreate = $this->submissionableUpdate($event->id,'Event');
        return response()->json(['status'=>true,'message' => 'Event Created successfully'], 201);
    } 

    public function show(Request $request, $id)
    {
        $rbDt = $this->getRegionBranch();
        $event = Event::where('id',$id);
// dd($rbDt);
        if(!empty($rbDt)){
            foreach($rbDt as $k => $r){
                if($r !== 0){
                $event->where($k,$r);
                }
            }
        }
        // dd($event->toSql());
        if(!$event){
            return response()->json(['status'=>false,'message' => 'Event Not Found.']); 
        }
        return response()->json(['status'=>true,'data' => $event->first()]);

    }
    public function showFront(Request $request, $id)
    {
        $event = Event::find($id);
        if(!$event){
            return response()->json(['status'=>false,'message' => 'Event Not Found.']); 
        }
        return response()->json(['status'=>true,'data' => $event]);

    }
}
