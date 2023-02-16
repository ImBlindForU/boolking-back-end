<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\Estate;
use App\Models\Sponsor;
use Illuminate\Http\Request;
use Braintree\Gateway;
use Carbon\Carbon;

class TransactionController extends Controller
{
    public function index($id){
        $estate = Estate::findOrFail($id);

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

    public function process(Request $request, $id){
        $payment_method_nonce = $request->payment_method_nonce;
        $sponsor = Sponsor::find($request->sponsors);
        $estate = Estate::findOrFail($id);

        $start = Carbon::now()->toDateTimeString();
        $end = Carbon::now()->addHour($sponsor->duration)->toDateTimeString();

        $estate_sponsor = Estate::with('sponsors')->where('id', $estate->id)->whereHas('sponsors', function($q) use($sponsor){
            $q->where('id', $sponsor->id);
        })->get()->toArray();

        $placeholder = false;

        foreach($estate->sponsors as $_sponsor){
            if(strtotime($_sponsor->pivot->end_date) > strtotime(Carbon::now()->toDateTimeString()) && $_sponsor->type == $sponsor->type ){
                return redirect()->route('user.estates.index')->with('wrong_address', "Hai già una sponsorizzazione da $sponsor->duration h attiva su $estate->title");
            }

            if(strtotime($_sponsor->pivot->end_date) < strtotime(Carbon::now()->toDateTimeString()) && $_sponsor->type == $sponsor->type){
                $placeholder = true;
            }

            if(strtotime($_sponsor->pivot->end_date) > strtotime(Carbon::now()->toDateTimeString())){
                $start = $_sponsor->pivot->end_date;
                $end = Carbon::parse($start)->addHour($sponsor->duration)->toDateTimeString();
            }
        }
        
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
            
        if(count($estate_sponsor) === 0){
            
            $estate->sponsors()->attach([ $sponsor->id => [
                'estate_id' => $estate->id,
                'start_date' => $start,
                'end_date' => $end
                ]
            ]);

        } else {
            if($placeholder){
                $estate->sponsors()->syncWithoutDetaching([ $sponsor->id => [
                    'estate_id' => $estate->id,
                    'start_date' => $start,
                    'end_date' => $end
                    ]
                ]);
            }
            
        }
        

        return redirect()->route('user.estates.index')->with('message', "La sponsorizzazione di $sponsor->type per $estate->title è andata a buon fine.");
    }
}
