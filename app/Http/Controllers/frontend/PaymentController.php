<?php

namespace App\Http\Controllers\frontend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class PaymentController extends Controller
{
    public function payment()
    {
      if(session('cart')){
        return view('frontend.payment.payment');
      }else{
        return abort(404);
      }
      
    }
    
    public function review()
    {
      if(session('cart')){
        return view('frontend.payment.review');
      }else{
        return abort(404);
      }
      
    }

    public function store_session(Request $request)
    {
      $request->validate([
        'flexRadioDefault' => 'required',
      

    ]);

        $billing = session()->get('billing', []);
        if(isset($billing['key'])) {
            $billing['key']['payment'] = $request->flexRadioDefault;
     
        } 
        // session()->put('billing', $billing);
        return redirect('/review');
        
    }
}
