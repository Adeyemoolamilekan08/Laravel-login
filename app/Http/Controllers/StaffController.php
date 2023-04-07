<?php

namespace App\Http\Controllers;

// use App\Admin;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Models\Staff;
use Illuminate\Contracts\Session\Session;
use App\Http\Middleware\RedirectIfAuthenticated;

class StaffController extends Controller
{
    // public function __construct()
   
    // {
    //     $this->middleware()
    // }
    public function showRegistrationForm()
    {
        return view('staff.register');
    }

    public function login()
    {
        return view('staff.login');
    }

    public function register(Request $request)
    {

        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:staffs',
            'password' => 'required|string|min:8|confirmed',
        ]);

        $staff = Staff::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => bcrypt($request->password),
        ]);

        Auth::guard('staff')->login($staff);
        session()->put('loguser',$request->name);
        return redirect('/staff/dashboard');
    }


public static function logins(Request $request)
{

    $user = Staff::where('email', '=', $request->email)->first();
// return $user;
    if ($user) {
        if (Hash::check($request->password, $user->password)) {
            // $request->session()->put('username', $user['name']);

            // Auth::guard('staff')->login($staff);

            // Auth::guard('staff')->login($user);
            
            session()->put('loguser',$user->name);
            
            return redirect('/staff/dashboard');
        } else {
            return redirect()->back()->with('error', 'Incorrect password');
        }
    } else {
        return redirect()->back()->with('error', 'User not found');
    }
}




}