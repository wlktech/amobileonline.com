<?php

namespace App\Http\Controllers\frontend;

use App\Models\Contact;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Session;

class ContactController extends Controller
{
    public function contact()
    {
        return view('frontend.contact.contact');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|max:225',
            'phone' => 'required|numeric',
            'email' => 'required|email|max:255',
            'message' => 'required',
        ]);

        Contact::create($validated);
        Session::flash('message', 'Message sent Successfully');
        return redirect()->back();
    }
}
