<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use App\Models\User;
use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class RegisterController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Register Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles the registration of new users as well as their
    | validation and creation. By default this controller uses a trait to
    | provide this functionality without requiring any additional code.
    |
    */

    use RegistersUsers;

    /**
     * Where to redirect users after registration.
     *
     * @var string
     */
    protected $redirectTo = RouteServiceProvider::HOME;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest');
    }

    /**
     * Get a validator for an incoming registration request.
     *
     * @param  array  $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function validator(array $data)
    {
        if(!$this->validateOtp()){
         return response()->json(['status'=>false,'message' => 'Invalid OTP'], 422);
        }
         
        return Validator::make($data, [
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'role' => ['required','in:a,b,c'],
            'password' => ['required','unique:users', 'string', 'min:8', 'confirmed',
            'regex:/^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)(?=.*[@$!%*?&])/',],
            'phone' => [
                'required',
                'string',
                'regex:/^(\+[0-9]{1,3})?[0-9\s-]+$/',
                'min:10', // Adjust the minimum length as needed
                'max:15', // Adjust the maximum length as needed
            ],
        ])->setCustomMessages([
            'password.regex' => 'The password must contain at least one lowercase letter, one uppercase letter, one number, and one special character.',
            'phone.regex' => 'Please enter a valid phone number with digits, spaces, hyphens, and an optional plus sign.',

        ]);
    }

    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     * @return \App\Models\User
     */
    protected function create(array $data)
    {
        return User::create([
            'name' => $data['name'],
            'email' => $data['email'],
            'password' => Hash::make($data['password']),
            'phone' => $data['phone'],
        ]);
    }

    protected function generateOtp(Request $request)
    {
        $otp = rand(1000, 9999);

        $request->session()->put('otp', $otp);

        return response()->json(['otp' => $otp]);
    }
    protected function validateOtp()
    {
        $otp = request()->input('otp');
        if(!$otp) return false;
        $sessionOtp = request()->session()->get('otp');

        if ($otp != $sessionOtp) {
            return false;
            // return response()->json(['error' => 'Invalid OTP'], 422);
        }
return true;
        // return response()->json(['success' => true]);
    }
}
