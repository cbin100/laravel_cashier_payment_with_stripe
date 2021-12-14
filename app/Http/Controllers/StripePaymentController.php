<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class StripePaymentController extends Controller
{
    //
    public function stripe()
    {
        return view('stripe');
    }

    /**
     * success response method.
     *
     * @return \Illuminate\Http\Response
     */
    public function stripePost(Request $request)
    {
        \Stripe\Stripe::setApiKey(env('STRIPE_SECRET'));
        \Stripe\Charge::create ([
            //"amount" => 100 * 100,
            "amount" => 200 * 100,
            "currency" => "usd",
            "source" => $request->stripeToken,
            "description" => "Test payment from Pelo Group."
        ]);

       // Session::flash('success', 'Payment successful!');
        return back()->with('success', 'Payment successful!');


        //return back();
    }
}
