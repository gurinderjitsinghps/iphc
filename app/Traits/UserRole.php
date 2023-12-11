<?php
namespace App\Traits;

use App\Models\Category;
use App\Models\Submission;
use App\Models\User;
use Illuminate\Http\Request;


trait UserRole
{
    public function getInteractedBy()
    {
        $user =  auth('user')->user();
        if(!$user) return false;
        if($user->role =='branch_secretary'){
            $ibUser = User::where('category_id',$user->category_id)->where('role','branch_chairman');
            if($ibUser->count()) $ibUser = $ibUser->first();
        }elseif($user->role =='branch_chairman'){
            $ibUser = User::where('category_id',$user->category_id)->where('role','branch_chairman');
            if($ibUser->count()) $ibUser = $ibUser->first();
        }

    }
    public function getRegionBranch(){
        $user = auth('user')->user();
        $rbData =array();
    if(isset($user->role_level) && $user->role_level =='branch'){
            $category = Category::find($user->category_id);
            // dd($category->type);
            if($category->type =='branch'){
               
                $rbData['region_id'] =  $category->type_id;
                $rbData['branch_id'] =  $category->id;
                 }
            if($category->type =='region'){
                $rbData['region_id'] =  $category->type_id;
                $rbData['branch_id'] =  0;
                 }
                }else if(isset($user->role_level) && $user->role_level =='regional'){
                $category = Category::find($user->category_id);
                    if($category->type =='region'){
                        $rbData['region_id'] =  $category->id;
                        $rbData['branch_id'] =  0;
                }else{
                    if(request()->has('region_id') && request()->has('branch_id')){
                        $rbData['region_id'] =  request()->input('region_id');
                        $rbData['branch_id'] =  request()->input('branch_id');
                    }else{
                    $rbData['region_id'] =  0;
                    $rbData['branch_id'] =  0;
                    }

                }
       
        }else{
            $rbData['region_id'] =  0;
            $rbData['branch_id'] =  0;
        }
    
    return $rbData;
    }
    public function submissionableUpdate($id,$type){
        $rbDt = $this->getRegionBranch();
        $user = auth('user')->user();
        $typeClass = 'App\Models\\'.$type;
        $data = ['submissionable_id' => $id,'submissionable_type'=>$typeClass,'type'=>$type];
        // 'status_level'=>$user->role_level
        $subCreate= Submission::updateOrCreate(
            array_merge($data,$rbDt),
                ['submissionable_id' => $id,'type'=>$type]
            );
            return $subCreate;
    }
    public function adminstrationRolesDatatable(){

// if($id){
            //     $data = Category::where('type_id',$id)->get();
            // }else{
                $data = User::query();
                // }
                if (request()->has('role') && request()->input('role') != null) {
                    $data->where('role', request()->input('role'));
                }
                $data = $data->get();
                // $data = Buyer::select(['id', 'name', 'email','phone'])->get();
                return datatables()->of($data)
                    ->addColumn('actions',function ($data){
                        if($data->is_blocked){
                            $blockCls ='zmdi zmdi-lock-open text-success'; 
                            $blockTtl ='Unblock User'; 
                            $act = 0;
                        }else{
                            $blockCls ='zmdi zmdi-lock-outline text-warning'; 
                            $blockTtl ='Block User'; 
                            $act = 1;
                        }
                        return '<div class="d-flex align-items-center justify-content-center acCont"><a href="'.route('superadmin.administration_roles.show',$data->id).'"  >
                        <span class="zmdi zmdi-delete icon-eye icons text-success"></span></a>
                        <div class="ml-1 cp deleteuser"  uid="'.$data->id.'"><span class="zmdi zmdi-delete text-danger icon-trash icons"></span></div>
                        <div class="ml-1 cp blockuser" title="'.$blockTtl.'" uid="'.$data->id.'" act="'.$act.'"><span class="'.$blockCls.' "></span></div>
                      </div> ';})
                      ->addColumn('role', function ($data) {
                        $configRoles = config('roles');
                        $role = $configRoles[$data->role];
                         return $role;
                      })
                      ->addColumn('region', function ($data) {
                       $category =  Category::find($data->category_id);
                       if($category->type == 'branch'){
                        $category =  Category::find($category->type_id);
                       }
                       return $category ? $category->name : '';
                      })
                 
                    ->rawColumns(['actions'])
                    ->make(true);
    }
    public function getGuard(){
        $url = request()->url();
        if (request()->is('api/*') && request()->wantsJson()) {
            $pattern = '/\/api\/(\w+)\//';
            if (preg_match($pattern, $url, $matches)) {
               return $matches[1]; // 'buyer'
            } else {
                return false;
            }
        } else {
            $segments = explode('/', $url);
           
            if (count($segments) >= 2) {
                // dd($segments);
               return $segments[3]; // 'superadmin'
            } else {
                return false;
            }
        }
       
    }


}
