<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Estate;
use Illuminate\Http\Request;

class EstateController extends Controller
{
    public function index()
    {
        $estates = Estate::with('images', 'services', 'address', 'user')->get();
        return response()->json([
            'success' => true,
            'results' => $estates,
        ]);
    }
}
