<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\Contact;

class AjaxContactController extends Controller
{
    public function index()
    {
        return view('view_admin.ajax-contact-us-form');
    }

    public function store(Request $request)
    {

        $validatedData = $request->validate([
            'name' => 'required',
            'email' => 'required|unique:contacts|max:255',
            'message' => 'required'
        ]);
        //$save = Contact::create(all);
        $save = new Contact;

        $save->name = $request->name;
        $save->email = $request->email;
        $save->message = $request->message;

        $save->save();
        return back()->with('status', 'Ajax Form Data Has Been validated and store into your database');
        //return redirect('form')->with('status', 'Ajax Form Data Has Been validated and store into database');

    }
}
