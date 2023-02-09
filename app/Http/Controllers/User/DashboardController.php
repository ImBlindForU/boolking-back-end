<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
    public function index(){
        if(Auth::user()->name){
            $user_name = Auth::user()->name;
            $user_surname = Auth::user()->surname;
        } else {
            $user_name = 'Utente';
            $user_surname = 'Registrato';
        }
        return view('user.dashboard', compact('user_name', 'user_surname'));
    }
}
