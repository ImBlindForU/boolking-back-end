<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class FrontEndController extends Controller
{
    public function index()
    {
        return redirect()->away(env('FRONT_END_LINK'));
    }
}
