<?php

namespace App\Http\Controllers\Auth\super_admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class SuperAdminLoginController extends Controller
{
    public function index()
    {
        return view('backend.superadmin.auth.login');
    }

    public function login(Request $request)
    {
     
        $request->validate([
            'email' => ['required', 'string', 'email', 'max:50'],
            'password' => ['required', 'string', 'min:8'],
        ]);

      
        if(Auth::guard('super_admin')->attempt(['email' => $request->email, 'password' => $request->password])){
            return redirect()->route('store_admin.dashboard');
        }else{
            return redirect()->back()->withErrors(['login_error' => 'Password Or Email does not match! ']);
        }
        

    }

    public function logout()
    {
        Auth::guard('super_admin')->logout();
        return redirect()->route('store_admin.login'); 
    }
}
