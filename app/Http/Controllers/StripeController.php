<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Session;
use Stripe;



class StripeController extends Controller
{
    public function stripePost(Request $request)
    {
        Stripe\Stripe::setApiKey(env('STRIPE_SECRET'));
        Stripe\Charge::create ([
            "amount" => 100*100,
            "currency" => "INR",
            "source" => $request->stripeToken,
            "description" => "This is test payment",
        ]);

        Session::flash('success', 'Payment Successful !');

        return response()->json([
           'status' => 200
        ]);
    }
}
