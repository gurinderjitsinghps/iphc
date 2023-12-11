<?php

namespace App\Http\Controllers;

use App\Models\Cms;
use Illuminate\Http\Request;

class CmsController extends Controller
{
    public function index(Request $request)
    {   
      if($request->has('t')){
        if($request->get('t') =='user'){
            return view('superadmin.cms.user_end');
        }
        if($request->get('t') =='admin'){
            return view('superadmin.cms.admin_end');
        }
      }
        return view('superadmin.cms.index');
    }

    public function show(Request $request, $id)
    {
       $advert = Cms::with('attachments')->find($id);
       if ($request->ajax()) {
        return response()->json(['status'=>true,'advert' => $advert], 201);
       }
       return view('superadmin.adverts.view',compact('advert'));

    }
    public function update(Request $request)
    {
        $validated = $request->validate([
           'text1' => 'sometimes|string|max:255',
           'text2' => 'sometimes|string|max:400',
           'type' => 'required|in:advertisement,code_conduct,education_trust,polocano,splash_screen,admin_terms_policy,help_center,intro_screen1,intro_screen2,intro_screen3,intro_screen4,intro_screen5,intro_screen6',
           'attachment' => 'sometimes|file|mimes:doc,docx,pdf,jpeg,png,jpg|max:2048',    
           ]);
           if($request->attachment){
            $validated['attachment'] = $request->attachment->store('cms/'.$validated['type'],'public'); 
            }
         Cms::updateOrCreate(
           ['type' => $validated['type']],
           $validated 
       );
         return response()->json(['status'=>true,'message' => 'Operation Success.'], 201);
    }
    public function editAdvertisement(Request $request)
    {      
       $advert = Cms::where('type','advertisement')->first();
       return view('superadmin.cms.advertisement',compact('advert'));
    }
    public function codeOfConduct(Request $request)
    {      
       $code_conduct = Cms::where('type','code_conduct')->first();
       return response()->json(['status'=>true,'data' => $code_conduct], 201);

    }
    public function editCodeConduct(Request $request)
    {      
       $code_conduct = Cms::where('type','code_conduct')->first();
       return view('superadmin.cms.code_conduct',compact('code_conduct'));
    }
    public function editSplashScreen(Request $request)
    {      
       $splash = Cms::where('type','splash_screen')->first();
       return view('superadmin.cms.iphc_admin.splash_screen',compact('splash'));
    }
    public function introScreens(Request $request)
    {  
       return view('superadmin.cms.iphc_admin.intro_screens');
    }
    public function editIntroScreen(Request $request,$id)
    {  
      if(!$id) return false;
       $intro = Cms::where('type','intro_screen'.$id.'')->first();
       return view('superadmin.cms.iphc_admin.edit_intro_screen',compact('intro','id'));
    }
    public function editTermsPolicy(Request $request)
    {      
       $terms = Cms::where('type','admin_terms_policy')->first();
       return view('superadmin.cms.iphc_admin.terms_policy',compact('terms'));
    }
    public function editHelpCenter(Request $request)
    {      
       $help = Cms::where('type','help_center')->first();
       return view('superadmin.cms.iphc_admin.help_center',compact('help'));
    }
    public function editEducationTrust(Request $request)
    {      
       $education_trust = Cms::where('type','education_trust')->first();
       return view('superadmin.cms.education_trust',compact('education_trust'));
    }
    public function editPolocano(Request $request)
    {      
       $polocano = Cms::where('type','polocano')->first();
       return view('superadmin.cms.polocano',compact('polocano'));
    }
}
