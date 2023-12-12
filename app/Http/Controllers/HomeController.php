<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Favourite;
use Illuminate\Http\Request;
use App\Models\EmailVerified;
use Illuminate\Support\Carbon;
use App\Rules\MatchOldPassword;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        if(Auth::check() && session()->get('wishlist')){
            foreach(session()->get('wishlist') as $key){
                $wishlists =  Favourite::where('user_id',Auth::id())->where('user_id',Auth::id())->get();
                if(isset($wishlists)){
                    $wishlist = new Favourite();
                    $wishlist->product_id = $key;
                    $wishlist->user_id = Auth::id();
                    $wishlist->save();
                }
              
            }
          
        }
 
        if(Auth::user()->role == 2 || Auth::user()->role == 1){
            return redirect('/store-admin/dashboard');
        }else{
            return view('frontend.profile.home');
        }
      
        
    }

    public function change_password()
    {
        return view('frontend.profile.change_password');
    }

    public function change_password_store(Request $request)
    {
        $request->validate([

            'current_password' => ['required', new MatchOldPassword],

            'new_password' => ['required'],

            'new_confirm_password' => ['same:new_password'],

        ]);

   

        User::find(auth()->user()->id)->update(['password'=> Hash::make($request->new_password)]);
        Session::flash('message', 'Password Updated Successfully');
        return redirect()->back()->with('success','Password Updated Successfully');
    }

    public function user_update(Request $request)
    {
        $user = User::findOrFail($request->id);
        if($user->name == $request->name && $user->email == $request->email && $request->phone == $user->phone){
            return redirect()->back()->withErrors(['not_data_changes'=>'No Data Changes!']);
        }
        $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', Rule::unique('users')->ignore($user->id),],

         ]);
         if($user->email != $request->email){
            $toomanyattemp = EmailVerified::where([['email', '=', $request->email], ['expired', '>', Carbon::now()]]);
            if($toomanyattemp->count() > 5){
                return redirect()->back()->withErrors(['attempt_error'=>'Too Many Attempt']);
            }else{
                $generate_code = rand(1000, 9999);
                $input['name'] = $request->name;
                $input['email'] = $request->email;
                $input['code'] = $generate_code;
                $input['expired'] = Carbon::now()->addMinutes(120);
                $data = EmailVerified::create($input);
                $session_user = session()->get('update_user', []);
                $session_user['key'] = [
                    "id" => $request->id,
                    "name" => $request->name,
                    "email" =>$request->email,
                    "phone" =>$request->phone,
                ];
                session()->put('update_user', $session_user);
            }
            return view('auth.email_update_verify',['data' => $data,'user' => $user]);
         }else{
             $user->name = $request->name;
             $user->email = $request->email;
             if($request->phone){
                $user->phone = $request->phone;
             }
             $user->update();
             Session::flash('message', 'Profile was updated Successfully');
             return redirect()->back();
         }
 
    }
    public function verified(Request $request)
    {
        $user = User::findOrFail($request->id);
        $tocheck=EmailVerified::where([['email','=',$request->email],['code','=',$request->code],['expired','>',Carbon::now()]]);
        if($tocheck->count() > 0){
            $user_session = session()->get('update_user', []);
            if(isset($user_session['key'])){
                foreach(Session('update_user') as $val){
                    $user->name = $val['name'];
                    $user->email = $val['email'];
                    $user->phone = $val['phone'];
                    $user->update();
                }
            }
            session()->forget('update_user');
            Session::flash('message', 'Profile was updated Successfully');
            return response()->json(['Success']);
        }else{
            return response()->json(['Invalid Code']);
        }
    }

    public function admin_update(Request $request,$id)
    {
        $user = User::findOrFail($id);

         $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', Rule::unique('users')->ignore($user->id),],

         ]);

         $user = User::findOrFail($id);
         $user->name = $request->name;
         $user->email = $request->email;
         if($request->phone){
            $user->phone = $request->phone;
         }
         $user->update();
         Session::flash('message', 'User was updated Successfully');
        return redirect()->route('store_admin.admin.list');


    }

    public function admin_change_password_store(Request $request)
    {
        $request->validate([

            'current_password' => ['required', new MatchOldPassword],

            'new_password' => ['required'],

            'new_confirm_password' => ['same:new_password'],

        ]);

   

        User::find(auth()->user()->id)->update(['password'=> Hash::make($request->new_password)]);
        Session::flash('message', 'Password was updated Successfully');
        return redirect()->route('store_admin.admin.list');
    }

    public function user_ban(Request $request)
    {
        User::find($request->id)->delete();
        Session::flash('message', 'User was banned Successfully');
        return redirect()->back();
    }

    public function user_ban_restore(Request $request)
    {
        User::onlyTrashed()->findOrFail($request->id)->restore();
        Session::flash('message', 'User was unbanned Successfully');
        return redirect()->back();
    }

    public function address()
    {
        return view('frontend.profile.address');
    }

    public function store_address(Request $request,User $user)
    {
        $user->address = $request->address;
        $user->update();
        return redirect()->back()->with('success','Address Create Successfully');
    }

    public function wishlist()
    {

        $wishlists = Favourite::where('user_id',Auth::id())->get();
        return view('frontend.profile.wishlists',compact('wishlists'));
    }
}
