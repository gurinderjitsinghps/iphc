<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules;
use Illuminate\Support\Facades\Validator;
use Tymon\JWTAuth\Facades\JWTAuth;
use Illuminate\Support\Str;


class ProfileController extends Controller
{
    /**
     * Display the registration view.
     */
    public function index()
    {
       
        $user = auth('user')->user();
        $events = $user->events;
        return response()->json(['status'=>true,'user'=>$user,'events' => $events], 201); 
    }

    /**
     * Handle an incoming registration request.
     *
     * @throws \Illuminate\Validation\ValidationException
     */
    public function changePassword(Request $request)
    {
     $user = auth('user');

     $request->validate([
        'current_password' => 'required',
        'password' => [
            'required',
            'string',
            'min:8',
            'regex:/^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)(?=.*[@$!%*?&])/',
            'confirmed',
            Rules\Password::defaults()
        ],
        // 'password' => ['required', 'confirmed', Rules\Password::defaults()],
    ],[
        'password.regex' => 'The password must contain at least one lowercase letter, one uppercase letter, one number, and one special character.',

    ]);

     if (!Hash::check($request->input('current_password'), $user->user()->password)) {

        return response()->json(['status'=>false,'message' => 'The current password is incorrect.']);

     }

     $user->user()->forceFill([
        'password' => Hash::make($request->password),
        'remember_token' => Str::random(60),
    ])->save();

        return response()->json(['status'=>true,'message' => 'Password Changed successfully.'], 201);
    }

public function getDetails(Request $request){
    $user = auth('user')->user();
    return response()->json(['status'=>true,'data' => $user], 201);

}
public function updateProfile(Request $request){
     $user = auth('user');

        $validation = [
            'name' => 'required|string|min:3|max:255',
            'bio' => 'string',
            ];
     if($request->has('profile_image')){
        $validation['profile_image'] = 'image|mimes:jpeg,png,jpg|max:2048';
     }
    
     $validated = $request->validate($validation);
    $dataToFill = [
        'name' => $validated['name'],
        'bio' => $validated['bio'],
    ];
    if($request->profile_image){
    $photoPath = $request->profile_image->store('user/'.$user->id().'/photos','public'); 
    $dataToFill['profile_image'] = $photoPath;
    }
     $user->user()->forceFill($dataToFill)->save();

        return response()->json(['status'=>true,'message' => 'Profile Updated successfully.'], 201);
    }

}