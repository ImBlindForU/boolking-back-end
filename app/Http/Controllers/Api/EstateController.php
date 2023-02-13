<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Estate;
use App\Models\Service;
use Illuminate\Http\Request;

class EstateController extends Controller
{
    public function index(Request $request)
    {
        if($request->has('bed_number')){
            $bed = $request->bed_number;
        } else {
            $bed = 0;
        }

        if($request->has('room_number')){
            $room_number = $request->room_number;
        } else {
            $room_number = 0;
        }

        $services = [];
        
        if($request->has('services')){
            $services = $request->services;
        } else {
            $servs = Service::all()->toArray();
            foreach($servs as $serv){
                $services[] = $serv['id'];
            }
        }

        $estates = Estate::with('images', 'services', 'address', 'user')
                    ->where('is_visible', 1)
                    ->where('bed_number', '>=', $bed)
                    ->where('room_number', '>=', $room_number)
                    ->whereHas('services', function($q) use($services){
                        $q->whereIn('id', $services);
                    })
                    ->get();

        return response()->json([
            'success' => true,
            'results' => $estates,
        ]);
    }
}
