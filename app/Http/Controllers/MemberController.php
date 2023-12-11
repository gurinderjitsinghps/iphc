<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Member;
use App\Traits\UserRole;
use Illuminate\Http\Request;

class MemberController extends Controller
{
    use UserRole;

    function indexAdmin(Request $request) {
        if ($request->ajax()) {
        $data = Member::get();
        // }
        // $data = Buyer::select(['id', 'name', 'email','phone'])->get();
        return datatables()->of($data)
            ->addColumn('actions',function ($data){
                if($data->is_blocked){
                    $blockCls ='zmdi zmdi-lock-open text-success'; 
                    $blockTtl ='Unblock Member'; 
                    $act = 0;
                }else{
                    $blockCls ='zmdi zmdi-lock-outline text-warning'; 
                    $blockTtl ='Block Member'; 
                    $act = 1;
                }
                return '<div class="d-flex align-items-center justify-content-center acCont"><a href="'.route('superadmin.members.show',$data->id).'"  >
                <span class="zmdi zmdi-delete icon-eye icons text-success"></span></a>
                <div class="ml-1 cp deletemember"  uid="'.$data->id.'"><span class="zmdi zmdi-delete text-danger icon-trash icons"></span></div>
                <div class="ml-1 cp blockmember" title="'.$blockTtl.'" uid="'.$data->id.'" act="'.$act.'"><span class="'.$blockCls.' "></span></div>
              </div> ';})
              ->addColumn('type', function ($data) {
                $category =  Category::find($data->user_type_id);
                return $category->name;
               })
              ->addColumn('branch', function ($data) {
               $category =  Category::find($data->branch_id);
               return $category->name;
              })
         
            ->rawColumns(['actions'])
            ->make(true);
            }else{
            return view('superadmin.members.index');
            }
    }
    public function show(Request $request,$id)
    {  $member = Member::find($id);
        if(!$member){
            return redirect()->route('superadmin.members');
        }
    
        $branch =  Category::find($member->branch_id);
         $member->branch = $branch;
        $type =  Category::find($member->user_type_id);
         $member->type = $type;
       
        return view('superadmin.members.view',compact('member'));
    }
    function index(Request $request) {
        $rbDt = $this->getRegionBranch();
        $query = Member::query();
        if ($request->has('search')) {
            $keyword = $request->input('search');
        $query->where('name', 'like', '%' . $keyword . '%')->orWhere('email', 'like', '%' . $keyword . '%')->orWhere('city', 'like', '%' . $keyword . '%');
                           
        }
       
        if(!empty($rbDt)){
            foreach($rbDt as $k => $r){
                if($r !== 0){
                $query->where($k,$r);
                }
            }
        }
    //    dd($query->toSql());
        $query->orderBy('created_at', 'desc');
        $members = $query->paginate(10);
        return response()->json(['status'=>true,'data' => $members], 201); 
    
    }
    public function store(Request $request)
    {
        // Validate the request data
        $validated = $request->validate([
            'name' => 'required|string',
            'email' => 'required|string',
            'address' => 'required|string',
            'city' => 'required|string',
            'state' => 'required|string',
            'zipcode' => 'required|string',
            'user_type_id' => 'required|exists:categories,id',
            'contribution_as' => 'required|in:donation,staff,volunteer,staff,elder',
            'email' => 'required|string',
            'dob' => 'required|date_format:Y-m-d',
            'gender' => 'required|in:male,female',
            'phonecode' => 'required|string',
            'phone' => [
                'required',
                'string',
                // 'regex:/^(\+[0-9]{1,3})/',
                'min:10', // Adjust the minimum length as needed
                'max:15', // Adjust the maximum length as needed
            ],
            'profile_image' => 'required|image|mimes:jpeg,png,jpg|max:2048',
        ],[
            'phone.regex' => 'Please enter a valid phone number with digits, spaces, hyphens.',

        ]);
        if($request->profile_image){
            $profile_image = $request->profile_image->store('members/','public'); 
            $validated['profile_image'] = $profile_image;
            }
        $user = auth('user')->user();
        $validated['user_id'] = $user->id;
        $rbDt = $this->getRegionBranch();
        $validated = array_merge($validated,$rbDt);
        // dd($validated);

        $member = Member::create($validated);
        return response()->json(['status'=>true,'message' => 'Member created successfully'], 201);
    }

    public function block(Request $request,Member $member)
    {
        $validated = $request->validate(['is_blocked'=>'required|boolean']);
        // $member->is_blocked = $validated['is_blocked'];
        // dd((boolean)$validated['is_blocked']);
        $member->update(['is_blocked'=>(int)$validated['is_blocked']]);
            if($validated['is_blocked']){
                $bs = 'blocked';
            }else{
                $bs = 'unblocked';
            }
        return response()->json(['status'=>true,'message' => 'Member '.$bs.' successfully']);
    }

    public function destroy(Member $member)
    {
        $member->delete();

        return response()->json(['status'=>true,'message' => 'Member deleted successfully']);
    }
}
