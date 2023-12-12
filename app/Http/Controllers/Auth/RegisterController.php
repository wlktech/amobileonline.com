<?php

namespace App\Http\Controllers\Auth;


use App\Models\User;
use Illuminate\Http\Request;
use App\Models\EmailVerified;
use Illuminate\Support\Carbon;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;
use Illuminate\Auth\Events\Registered;
use App\Providers\RouteServiceProvider;
use Illuminate\Support\Facades\Validator;
use Illuminate\Foundation\Auth\RegistersUsers;

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
        return Validator::make($data, [
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => ['required', 'string', 'min:8', 'confirmed'],
        ]);
    }
    protected function check_mail(Request $request)
    {
        $this->validator($request->all())->validate();
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
            $user = session()->get('register', []);
            $user['key'] = [
                "name" => $request->name,
                "email" =>$request->email,
                "password" => $request->password,
            ];
            session()->put('register', $user);
        }
        return view('auth.verify_code',['data' => $data]);
    }

    public function verified(Request $request)
    {
        $tocheck=EmailVerified::where([['email','=',$request->email],['code','=',$request->code],['expired','>',Carbon::now()]]);
        if($tocheck->count() > 0){
            $user = session()->get('register', []);
            if(isset($user['key'])){
                foreach(Session('register') as $key => $val){
                   event(new Registered($user = $this->create($val)));
                   $this->guard()->login($user);
                }
            }
            session()->forget('register');
            return response()->json(['Success']);
        }else{
            return response()->json(['Invalid Code']);
        }
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
            'role' => 0,
            'password' => Hash::make($data['password']),
        ]);
    }
}
