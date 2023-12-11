<?php

namespace App\Http\Controllers;

use App\Models\UserQA;
use Illuminate\Http\Request;

class UserQAController extends Controller
{
    public function qaslist()
    {
       $qas = UserQA::get();
    
        return response()->json(['status'=>true,'data' => $qas]);
    
    }
    public function store(Request $request)
    {
       $validated =  $request->validate([
            'question' => 'required|string|min:4|max:250',
        ]);
        $user_id = auth('frontuser')->id();
        $data = array('user_id'=>$user_id,'question'=>$validated['question'] );
        $question = UserQA::create($data);

        return response()->json(['status'=>true,'message' => 'Question created successfully'], 201);
    }

    public function indexAdmin(Request $request) {
        if ($request->ajax()) {
            $data =  UserQA::with(['user'])->get();
            // dd($data);
            return datatables()->of($data)
                ->addColumn('actions',function ($data){
                 
                    return '  <div class="d-flex justify-content-center" >
                    <div class="ml-1 cp editqa" qid="'.$data->id.'"  ><span class="zmdi zmdi-delete  ti-comments  text-success"></span></div>
                    <div class="ml-1 cp deleteqa"  qid="'.$data->id.'"><span class="zmdi zmdi-delete text-danger icon-trash icons"></span></div></div>';})
                // ->addColumn('actions', function ($testimonial) {
                //     return view('testimonial.actions', compact('testimonial'));
                // })
                ->rawColumns(['actions'])
                ->make(true);
        }
        return view('superadmin.cms.qas');
    
    }


    public function update(Request $request)
    {
       $validated =  $request->validate([
            'id' => 'exists:user_q_a_s,id',
            'answer' => 'required|string|min:4|max:250',
        ]);
    
        $question = UserQA::find($validated['id']);
        $question->answer = $validated['answer'];
        $question->save();
        return response()->json(['status'=>true,'message' => 'Answer Added successfully'], 201);
    }
    public function destroy(UserQA $userqa)
    {
        $userqa->delete();
        return response()->json(['status'=>true,'message' => 'QA Deleted successfully'], 201);
    }
}
