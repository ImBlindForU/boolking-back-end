<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\Estate;
use Illuminate\Http\Request;

class TransactionController extends Controller
{
    public function index(Estate $estate){
        return view('user.transactions.index', compact('estate'));
    }
}
