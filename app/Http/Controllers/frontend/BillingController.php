<?php

namespace App\Http\Controllers\frontend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class BillingController extends Controller
{
    public function billing()
    {
        if(session('cart')){
            return view('frontend.payment.billing');
        }else{
            return abort(404);
        }
        
    }

    public function store_session(Request $request)
    {
        $request->validate([
            'name' => 'required|max:225',
            'phone' => 'required|numeric',
            'address' => 'required'

        ]);
        $billing = session()->get('billing', []);

        if(isset($billing['key'])) {
            // $billing['key']['quantity']++;
        } else {
            $billing['key'] = [
                "name" => $request->name,
                "phone" => $request->phone,
                "state" => $request->state,
                "city" => $request->city,
                "address" => $request->address,
                "payment" => 1,
            ];
        }

        session()->put('billing', $billing);

        return redirect('/payment');
        
    }
}
