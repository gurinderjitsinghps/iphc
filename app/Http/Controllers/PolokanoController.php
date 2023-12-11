<?php

namespace App\Http\Controllers;

use App\Models\Polokano;
use App\Models\PolokanoBeneficiary;
use App\Models\PolokanoDependent;
use App\Models\PolokanoSpouse;
use App\Traits\UserRole;
use Illuminate\Http\Request;

class PolokanoController extends Controller
{
    use UserRole;
    public function store(Request $request)
    {
       $validated =  $request->validate([
        'plan'=> 'required|in:individual,family',
        'region_id'=> 'required|integer|exists:categories,id',
        'branch_id'=> 'required|integer|exists:categories,id',
        'title'=> 'required|string|min:3',
        'firstname'=> 'required|string|min:3',
        'lastname'=> 'required|string|min:3',
        'id_number'=> 'required|string|min:3',
        'dob'=>'required|date_format:Y-m-d',
        'phone' => ['required','string','regex:/^(\+[0-9]{1,3})?[0-9\s-]+$/','min:10','max:15',],
        'email' => 'required|string|email|max:255',
        'address'=>'required|string|min:3',
        'lat'=>'required|string|min:3',
        'long'=>'required|string|min:3',
        'funeral_benefits'=>'required|string|min:3',
        'cash_plan'=>'required|string|min:3',
        'main_member_id_attachment'=>'required|file|mimes:pdf,doc,docx,png,jpg,jpeg|max:2240',
        'dependents.*.firstname' => 'required|string|min:3',
        'dependents.*.lastname' => 'required|string|min:3',
        'dependents.*.id_number' => 'required|string',
        'dependents.*.relationship' => 'required|string|min:6',
        'beneficiaries.*.firstname' => 'required|string|min:3',
        'beneficiaries.*.lastname' => 'required|string|min:3',
        'beneficiaries.*.id_number' => 'required|string',
        'beneficiaries.*.phone' => ['required','string','regex:/^(\+[0-9]{1,3})?[0-9\s-]+$/','min:10','max:15',],
        'spouses.*.firstname' => 'required|string|min:3',
        'spouses.*.lastname' => 'required|string|min:3',
        'spouses.*.id_number' => 'required|string',
    ]);
    if($request->main_member_id_attachment){
        $validated['main_member_id_attachment'] = $request->main_member_id_attachment->store('polokano/funeral','public'); 
    }
    $user_id = auth('frontuser')->id();
    $validated['front_user_id'] = $user_id;
    $polokano = Polokano::create($validated);
    $subCreate = $this->submissionableUpdate($polokano->id,'Polokano');
        if(isset($validated['dependents'])){
            foreach($validated['dependents'] as $dependent) {
                $dependent['polokano_id'] = $polokano->id;
                $bdependent = PolokanoDependent::create($dependent);
        }
    }
        if(isset($validated['spouses'])){
            foreach($validated['spouses'] as $spouse) {
                $spouse['polokano_id'] = $polokano->id;
                $bspouse = PolokanoSpouse::create($spouse);
        }
    }
        if(isset($validated['beneficiaries'])){
            foreach($validated['beneficiaries'] as $beneficiary) {
                $beneficiary['polokano_id'] = $polokano->id;
                $bbeneficiary = PolokanoBeneficiary::create($beneficiary);
        }
    }
        return response()->json(['status'=>true,'message' => 'Polokano created successfully.'], 201);
    }
}
