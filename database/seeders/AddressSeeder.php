<?php

namespace Database\Seeders;

use App\Models\Address;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;



class AddressSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $addresses = [
            [
                'street' => 'Piazza Camillo Benso di Cavour',
                'long' => 13.515936336171842,
                'lat' => 43.61705464059095,
                'city' => 'Ancona',
                'street_code' => '1'
            ],
            [
                'street' => 'Via Cernaia',
                'long' => 7.676370722784902,
                'lat' => 45.070804689994624,
                'city' => 'Torino',
                'street_code' => '6'
            ],
            [
                'street' => 'Via Degli Avelli',
                'long' => 11.249823517848778,
                'lat' => 43.774819086256684,
                'city' => 'Firenze',
                'street_code' => '8R'
            ],
            [
                'street' => 'Corso Umberto',
                'long' => 15.283216651661789,
                'lat' => 37.85114263918421,
                'city' => 'Taormina',
                'street_code' => '213'
            ],
            [
                'street' => 'Via Cappella',
                'long' => 14.056592322201029,
                'lat' => 40.80265022351319,
                'city' => 'Campagna',
                'street_code' => '365'
            ],
            [
                'street' => 'Via Napoli',
                'long' => 16.855322354816003,
                'lat' => 41.1270335230832,
                'city' => 'Bari',
                'street_code' => '212'
            ],
            [
                'street' => 'Via Brindisi',
                'long' => 17.99087083553427,
                'lat' => 40.05377311680721,
                'city' => 'Gallipoli',
                'street_code' => '7'
            ],
            [
                'street' => 'Via Del Lavatore',
                'long' => 12.483783989669387,
                'lat' => 41.900835011307784,
                'city' => 'Roma',
                'street_code' => '50'
            ],
            [
                'street' => 'Via Bissula',
                'long' => 12.257410458923669,
                'lat' => 45.493640686452274,
                'city' => 'Venezia',
                'street_code' => '50'
            ],
            [
                'street' => 'Via Camillo Cavour',
                'long' => 11.036867435388482,
                'lat' => 45.88708661377215,
                'city' => 'Rovereto',
                'street_code' => '58'
            ],
        ]; 
        for($i = 0; $i < count($addresses); $i++){
            $new_address = new Address();
            $new_address->street = $addresses[$i]['street'];
            $new_address->long = $addresses[$i]['long'];
            $new_address->lat = $addresses[$i]['lat'];
            $new_address->city = $addresses[$i]['city'];
            $new_address->country = 'Italia';
            $new_address->street_code = $addresses[$i]['street_code'];
            $new_address->estate_id = $i + 1;
            $new_address->save();
        }
        
    }
}
