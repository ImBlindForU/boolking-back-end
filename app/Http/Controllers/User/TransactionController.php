<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\Estate;
use App\Models\Sponsor;
use Illuminate\Http\Request;
use Braintree\Gateway;

class TransactionController extends Controller
{
    public function index(Estate $estate){
        $gateway = new Gateway([
            'environment' => 'sandbox',
            'merchantId' => env('BRAINTREE_MERCHANT_ID'),
            'publicKey' => env('BRAINTREE_PUBLIC_KEY'),
            'privateKey' => env('BRAINTREE_PRIVATE_KEY')
        ]);

        $clientToken = $gateway->clientToken()->generate();

        $sponsors = Sponsor::all();

        return view('user.transactions.index', compact('estate', 'clientToken', 'sponsors'));
    }

    public function process(Request $request){
        $payment_method_nonce = $request->payment_method_nonce;
        $sponsor = Sponsor::find($request->sponsors);

        $gateway = new Gateway([
            'environment' => 'sandbox',
            'merchantId' => env('BRAINTREE_MERCHANT_ID'),
            'publicKey' => env('BRAINTREE_PUBLIC_KEY'),
            'privateKey' => env('BRAINTREE_PRIVATE_KEY')
        ]);

        $result = $gateway->transaction()->sale([
            'amount' => $sponsor->price,
            'paymentMethodNonce' => $payment_method_nonce,
            'options' => [
                'submitForSettlement' => true
            ]
        ]);

    }
}
