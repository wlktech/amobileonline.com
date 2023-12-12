<?php

namespace App\Http\Controllers\Auth\super_admin;

use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Validator;

class SuperAdminRegisterController extends Controller
{
    public function index()
    {
        return view('backend.superadmin.auth.register');
    }
    

    public function create(Request $request)
    {
        $request->validate( [
            'name' => ['required', 'string', 'max:50'],
            'email' => ['required', 'string', 'email', 'max:50', 'unique:users'],
            'password' => ['required', 'string', 'min:8'],
            'password_confirmation' => 'required|min:8|same:password'
        ]);

        $user = new User();
        $user->name = $request->name;
        $user->email = $request->email;
        $user->role = $request->role;
        $user->password = Hash::make($request->password);
        $user->save();
        Session::flash('message', 'User was created Successfully');
        return redirect()->route('store_admin.admin.list');
    }
}
