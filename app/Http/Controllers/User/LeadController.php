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

        $estates->join('leads', 'leads.estate_id', '=', 'estates.id');

        return view('user.emails.index', compact('estates'));
    }
}
