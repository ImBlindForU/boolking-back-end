<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Address;
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

        if($request->has('street') || $request->has('city')){
            $street = $request->street;
            $city = $request->city;
            // Call TomTom API and get address Lat and Long
            $tomKey = env('MYTOMTOMKEY');
            $geocodeUrl = env('URLGEOCODE');
            $endpoint = $geocodeUrl . $street . "," . $city . "," . ".json?key=" . $tomKey;
            $client = new \GuzzleHttp\Client(["verify" => false]);
            $response = $client->request('GET', $endpoint,);
            $tom_result = json_decode($response->getBody(), true);
            
            //if Tom tom can not find any street: 
            if(count($tom_result['results']) === 0){
                return response()->json([
                    'success' => false,
                    'results' => 'La via inserita non ha prodotto risultati',
                ]);
            }

            $long =  $tom_result['results'][0]['position']['lon'];
            $lat =  $tom_result['results'][0]['position']['lat'];

            $distance = $request->distance;

            // Create the query calculating the radius
            $haversine = "(
                6371 * acos(
                    cos(radians(" .$lat. "))
                    * cos(radians(`lat`))
                    * cos(radians(`long`) - radians(" .$long. "))
                    + sin(radians(" .$lat. ")) * sin(radians(`lat`))
                )
            )";
            
            //Take all the address id in the given distance
            $addresses = Address::select("estate_id")
                ->selectRaw("round($haversine, 2) AS distance")
                    ->having("distance", "<=", $distance)
                    ->get()
                    ->toArray();
                
                
            $ids = [];

                foreach($addresses as $key => $address){
                    array_push($ids, $address['estate_id']);
                }


                $estates = Estate::with('images', 'address', 'user')
                ->where('is_visible', 1)
                ->where('bed_number', '>=', $bed)
                ->where('room_number', '>=', $room_number)
                ->whereHas('services', function ($q) use ($services) {
                    $q->whereIn('id', $services);
                }, "=", count($services))->with('services')
                ->whereIn('id', $ids)
                ->get();
        } else {
            $estates = Estate::with('images', 'address', 'user')
                    ->where('is_visible', 1)
                    ->where('bed_number', '>=', $bed)
                    ->where('room_number', '>=', $room_number)
                    ->whereHas('services', function ($q) use ($services) {
                        $q->whereIn('id', $services);
                    }, "=", count($services))->with('services')
                    ->get();
        }
        

        return response()->json([
            'success' => true,
            'results' => $estates,
        ]);
    }

    public function show($slug){
        $estate = Estate::with('images', 'services', 'address', 'user')->where('slug', $slug)->first();
        if($estate){
            return response()->json([
                'success' => true,
                'results' => $estate
            ]);
        } else {
            return response()->json([
                'success' => false,
                'error' => 'Nessun appartamento trovato'
            ]);
        }
    }
}
