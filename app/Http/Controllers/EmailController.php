<?php

namespace App\Http\Controllers;

//use Illuminate\Http\Request;

use App\Email;

use App\Http\Requests\EmailRequest;

// OR 2
//use App\Repositories\EmailRepository;

class EmailController extends Controller
{
	public function getForm()
	{
		return view('email');
	}
    public function postForm(EmailRequest $request)
    {
    	$email = new Email;
    	$email->email = $request->input('email');
    	$email->save();
    	return view('email_ok');
    }
    //OR
    /*
    public function postForm(
		EmailRequest $request,
		Email $email)
	{
		$email->email = $request->input('email');
		$email->save();
		
		return view('email_ok');
	}
	*/

	//OR
	/*
	public function postForm(
		EmailRequest $request,
		EmailRepository $emailRepository)
	{
		$emailRepository->save($request->input('email'));
		
		return view('email_ok');
	}
	*/
}
