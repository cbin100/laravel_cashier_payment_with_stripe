<?php

namespace App\Http\Controllers;

use Mail;

use App\Http\Requests\ContactRequest;

//namespace App\Http\Requests;
//use App\Http\Requests\Request;

//use Illuminate\Http\Request;

class ContactController extends Controller
{
    //
    public function getForm()
    {
    	return view('contact');
    }

    public function postForm(ContactRequest $request)
    {
    	/*
		SEND EMAIL
    	Mail::send('emails.contact', $request->all(), function($message)
    	{
    		$message->to('charlesjasho@gmail.com')->subject('Contact');
    	});
    	*/
    	return view('confirm');
    }

}
