<?php

namespace App\Http\Controllers;

use App\Mail\UserCredentials;
use App\Models\BranchReport;
use App\Models\Category;
use App\Models\User;
use App\Traits\UserRole;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Str;

class AdministrationRoleController extends Controller
{
    use UserRole;
    public function index(Request $request)
    {   
        // $currentCategory = User::;
        // if($currentCategory){
        //     $currentCategory= $currentCategory->first();
        // }else{
        //     $currentCategory= null;
        // }
        if ($request->ajax()) {
            return $this->adminstrationRolesDatatable();
        }else{
            $roles = config('roles');
            $categories = Category::where('type','region')->orWhere('type','branch')->get();
            $categories->each(function ($cat){
                if($cat->type_id && $cat->type=='branch'){
                    $catp = Category::find($cat->type_id); 
                    $cat->name = $catp->name .' > '. $cat->name;
                }
            });
            $roles = config('roles');
        return view('superadmin.administration_roles.index',compact('roles','categories'));
        }
    }
    public function store(Request $request)
    {
        $configRoles = config('roles');
        $configRoles = array_keys($configRoles);
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'role_level' => 'required|in:national,regional,branch',
            'role' => ['required','in:'.implode(',', $configRoles).''],
            'category_id' => 'sometimes|required|exists:categories,id',
           
            'phone' => [
                'required',
                'string',
                'regex:/^(\+[0-9]{1,3})?[0-9\s-]+$/',
                'min:10', // Adjust the minimum length as needed
                'max:15', // Adjust the maximum length as needed
            ],
        ],[
           
            'phone.regex' => 'Please enter a valid phone number with digits, spaces, hyphens, and an optional plus sign.',

        ]);
        $userCheck = User::where('role',$request->role)->where('category_id',$request->category_id)->count();
        if($userCheck){
            return response()->json(['status'=>false,'message' => 'User Role Already Exists.'], 201);
        }
        $password = Str::random(10); 
        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($password),
            'phone' => $request->phone,
            'is_phone_verified' => true,
            'role_level' => $request->role_level,
            'role' => $request->role,
            'category_id' => $request->category_id,
        ]);
            $user->rpassword = $password;
        Mail::to($request->email)->send(new UserCredentials($user));

        return response()->json(['status'=>true,'message' => 'Registration Successful '], 201);
  
    }
    public function show(Request $request,$id)
    {  $user = User::find($id);
        if(!$user){
            return redirect()->route('superadmin.administration_roles');
        }
        $configRoles = config('roles');
        $user->role_name = $configRoles[$user->role];
        $category =  Category::find($user->category_id);
        if($category->type == 'branch'){
         $category->region =  Category::find($category->type_id);
        }else{
            $category->region = $category;
        }
        if ($request->ajax()) {
            // if($id){
            //     $data = Category::where('type_id',$id)->get();
            // }else{
            $data = BranchReport::where('user_id',$user->id)->get();
            // }
            // $data = Buyer::select(['id', 'name', 'email','phone'])->get();
            return datatables()->of($data)
                ->addColumn('actions',function ($data){
                    return '<a href="'.route('superadmin.administration_roles.show',$data->id).'" class="d-flex align-items-center justify-content-center acCont">
                    <div class="ml-1 cp viewReport" ><span class="zmdi zmdi-delete icon-eye icons text-success"></span></a>

                  </div> ';})
                  ->addColumn('number', function ($data) {
                    return 1;
                  })->addColumn('report_type', function ($data) {
                    $category =  Category::find($data->category_id);
                    return $category ? $category->name :'--';
                  })
                  ->addColumn('region', function ($data) {
                   $category =  Category::find($data->region_id);
                   if($category->type == 'branch'){
                    $category =  Category::find($category->branch_id);
                   }
                   return $category->name;
                  })
                ->rawColumns(['actions'])
                ->make(true);
        }
        return view('superadmin.administration_roles.view',compact('user','category'));
    }
    public function destroy(User $user)
    {
        $user->delete();

        return response()->json(['status'=>true,'message' => 'User deleted successfully']);
    }
    public function block(Request $request,User $user)
    {

        $validated = $request->validate(['is_blocked'=>'required|boolean']);
        // $user->is_blocked = $validated['is_blocked'];
        // dd((boolean)$validated['is_blocked']);
        $user->update(['is_blocked'=>(int)$validated['is_blocked']]);
            if($validated['is_blocked']){
                $bs = 'blocked';
            }else{
                $bs = 'unblocked';
            }
        return response()->json(['status'=>true,'message' => 'User '.$bs.' successfully']);
    }
}
