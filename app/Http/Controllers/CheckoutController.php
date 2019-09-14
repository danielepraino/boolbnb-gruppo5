<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Braintree\Gateway;
use Auth;
use App\Sponsorship;

class CheckoutController extends Controller
{
  public function index(Request $request) {
    $gateway = new Gateway([
        'environment' => config('services.braintree.environment'),
        'merchantId' => config('services.braintree.merchantId'),
        'publicKey' => config('services.braintree.publicKey'),
        'privateKey' => config('services.braintree.privateKey')
    ]);

    $amount = $request->amount;
    $nonce = $request->payment_method_nonce;

    $result = $gateway->transaction()->sale([
        'amount' => $amount,
        'paymentMethodNonce' => $nonce,
        'customer' => [
          'firstName' => Auth::user()->name ? Auth::user()->name : Auth::user()->email,
          'lastName' => Auth::user()->surname,
          'email' => Auth::user()->email,
        ],
        'options' => [
            'submitForSettlement' => true
        ]
    ]);

    if ($result->success) {
        $transaction = $result->transaction;

        $newSponsorship = new Sponsorship;
        $newSponsorship->price = $request->amount;
        $newSponsorship->duration = $request->duration;
        $newSponsorship->flat_id = $request->flat_id;
        $newSponsorship->save();

        //header("Location: " . $baseUrl . "transaction.php?id=" . $transaction->id);
        return back()->with('success_message', 'Transaction successful. The ID is:' .$transaction->id);
    } else {
        $errorString = "";

        foreach($result->errors->deepAll() as $error) {
            $errorString .= 'Error: ' . $error->code . ": " . $error->message . "\n";
        }

        // $_SESSION["errors"] = $errorString;
        // header("Location: " . $baseUrl . "index.php");
        return back()->withErrors('An error occurred with the message:' .$result->message);
    }


    return view('/checkout');
  }
}
