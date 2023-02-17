<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\Estate;
use App\Models\Lead;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LeadController extends Controller
{
    public function index()
    {
        $leads = [];

        $estates = Estate::all()->where('user_id', Auth::user()->id);

        foreach ($estates as $estate) {
            if (Lead::where('estate_id', '=', $estate->id)->count() > 0) {
                $var = Lead::all()->where('estate_id', $estate->id)->toArray();
                array_push($leads, $var);
            }
        }

        //dd($estatesFiltered);
        //$leads = Lead::all()->whereIn('estate_id', $estatesFiltered->id);
        //dd($leads);
        return view('user.emails.index', compact('leads'));
    }
}
