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
        for($i = 1; $i < 21 ; $i++){
            $new_address = new Address();
            $new_address->street = 'Piazza Casalmaggiore';
            $new_address->long = 12.517111537811857;
            $new_address->lat = 41.88352085177411;
            $new_address->city = 'Roma';
            $new_address->country = 'Italia';
            $new_address->street_code = '11';
            $new_address->estate_id = $i;
            $new_address->save();
        }
        
    }
}
