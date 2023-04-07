<?php

namespace App\Http\Controllers;

// use App\Admin;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Models\Admin;
use Illuminate\Contracts\Session\Session;

class AdminController extends Controller
{
    public function showRegistrationForm()
    {
        return view('admin.register');
    }
    public function login()
    {
        return view('admin.login');
    }
    public function register(Request $request)
    {

        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:admin',
            'password' => 'required|string|min:8|confirmed',
        ]);

        $admin = Admin::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => bcrypt($request->password),
        ]);

        Auth::guard('admin')->login($admin);
        session()->put('logadmin',$request->name);
        return redirect('/admin/dashboard');
    }

    public function adminlogin(Request $request)
    {

        $user = Admin::where('email', '=', $request->email)->first();
    // return $user;
        if ($user) {
            if (Hash::check($request->password, $user->password)) {
                
                session()->put('logadmin',$user->name);
                
                return redirect('/admin/dashboard');
            } else {
                return redirect()->back()->with('error', 'Incorrect password');
            }
        } else {
            return redirect()->back()->with('error', 'User not found');
        }
    }
    


}
