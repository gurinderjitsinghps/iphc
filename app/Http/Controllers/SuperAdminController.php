<?php

namespace App\Http\Controllers;

use App\Http\Requests\SuperAdminLoginRequest;
use App\Models\BranchReport;
use App\Models\Category;
use App\Models\Donation;
use App\Models\Member;
use App\Models\Submission;
use App\Models\Withdrawal;
use App\Traits\UserRole;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules;
class SuperAdminController extends Controller
{
    use UserRole;
    public function login()
    {
        // dd(bcrypt('password'));
        return view('superadmin.login');
    }

    public function dashboard()
    {
        if (request()->ajax()) {
           return $this->adminstrationRolesDatatable();
        }
        $reports_count = BranchReport::count();
        $total_expenditure = Withdrawal::sum('amount');
        $donations = Donation::sum('amount');

        $regions = Category::where('type','region')->get();
        // dd($regions);
        $monthlyDonations = Donation::selectRaw('MONTH(created_at) as month, SUM(amount) as total')
            ->groupBy('month')
            ->get();
     $monthlyExpenditures = Withdrawal::selectRaw('MONTH(created_at) as month, SUM(amount) as total')
            ->groupBy('month')
            ->get();
        $visitors = Member::count();
        $regions = Category::where('type','region')->get();
        $branches = Category::where('type','branch')->get();
        $roles = config('roles');
        return view('superadmin.dashboard',compact('reports_count','total_expenditure','regions','branches','visitors','roles','donations','monthlyDonations','monthlyExpenditures'));
    }
   
    public function reports_analytics()
    {
        $reports_count = BranchReport::count();
        $total_expenditure = Withdrawal::sum('amount');
        $donations = Donation::sum('amount');

        $regions = Category::where('type','region')->get();
        // dd($regions);
        $monthlyDonations = Donation::selectRaw('MONTH(created_at) as month, SUM(amount) as total')
            ->groupBy('month')
            ->get();
     $monthlyExpenditures = Withdrawal::selectRaw('MONTH(created_at) as month, SUM(amount) as total')
            ->groupBy('month')
            ->get();
        $branches = Category::where('type','branch')->get();
        $visitors = Member::count();
        return view('superadmin.reports_analytics.index',compact('reports_count','total_expenditure','regions','branches','visitors','donations','monthlyDonations','monthlyExpenditures'));
    }
   
    /**
     * Handle an incoming authentication request.
     */
    public function store(SuperAdminLoginRequest $request): RedirectResponse
    {
        // Attempt to log in the buyer
        $request->authenticate();

        $request->session()->regenerate();

            return redirect()->route('superadmin.dashboard');
        // return redirect()->intended(RouteServiceProvider::SUPERADMIN_HOME);
    }

    /**
     * Destroy an authenticated session.
     */
    public function destroy(Request $request): RedirectResponse
    {
        Auth::guard('superadmin')->logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        return redirect()->route('superadmin.login');

    }
 public function profile()
    {
        $superadmin = auth('superadmin')->user();
        return view('superadmin.profile',compact('superadmin'));
    }
 public function changePassword()
    {
        return view('superadmin.change-password');
    }
 public function updateProfile(Request $request)
    {
     $superadmin = auth('superadmin');

     $validated = $request->validate([
        'name' => 'required|string|min:3|max:255',
        'phonecode' => 'required|string|min:1|max:4',
        'phone' => [
            'required',
            'string',
            'regex:/^(\+[0-9]{1,3})?[0-9\s-]+$/',
            'min:10', // Adjust the minimum length as needed
            'max:15', // Adjust the maximum length as needed
        ],
        // 'email' => 'required|string|email|max:255',
        'profile_image' => 'image|mimes:jpeg,png,jpg|max:2048',
     ],[
        'phone.regex' => 'Please enter a valid phone number with digits, spaces, hyphens, and an optional plus sign.',

    ]);
if($request->has('profile_image')){
    $validated['profile_image'] = $validated['profile_image']->store('superadmin/'.$superadmin->id().'/photos','public'); 
}
    $validated['phone'] = $validated['phone']; 
unset($validated['phonecode']);

     $superadmin->user()->forceFill($validated)->save();
     

        return response()->json(['status'=>true,'message' => 'Profile Updated successfully.'], 201);
    }
 public function updatePassword(Request $request)
    {
     $superadmin = auth('superadmin');

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

     if (!Hash::check($request->input('current_password'), $superadmin->user()->password)) {

        return response()->json(['status'=>false,'message' => 'The current password is incorrect.']);

     }

     $superadmin->user()->forceFill([
        'password' => Hash::make($request->password),
    ])->save();

        return response()->json(['status'=>true,'message' => 'Password Changed successfully.'], 201);
    }

    public function forgotPassword()
    {
  
        return view('superadmin.forgot-password');
    }

}
