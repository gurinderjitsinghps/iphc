<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Password;
use Illuminate\Validation\ValidationException;
use Inertia\Response;

class PasswordResetLinkController extends Controller
{


    /**
     * Handle an incoming password reset link request.
     *
     * @throws \Illuminate\Validation\ValidationException
     */
    public function store(Request $request)
    {
        $routeName = $request->route()->getName();
        if($routeName){
        $parts = explode('.', $routeName);

        if (count($parts) > 0) {
            $routeFrom = $parts[0].'s';
        } else {
            $routeFrom ='users';
        }
        }else{
            $routeFrom ='users';
        }
        // dd($request->route()->getName());
        $request->validate([
            'email' => 'required|email',
        ]);

        // We will send the password reset link to this user. Once we have attempted
        // to send the link, we will examine the response then see the message we
        // need to show to the user. Finally, we'll send out a proper response.
        $status = Password::broker($routeFrom)->sendResetLink(
            $request->only('email')
        );

        if ($status == Password::RESET_LINK_SENT) {
            if(request()->expectsJson()){
            return response()->json(['status'=> __($status)], 201);
            }else{
                return redirect()->route('superadmin.forgot-password')->with( ['pass_sent_email'=> __($status)] );
            }
        }

        throw ValidationException::withMessages([
            'email' => [trans($status)],
        ]);
    }
}
