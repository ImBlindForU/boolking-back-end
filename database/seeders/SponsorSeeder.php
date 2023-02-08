<?php

namespace Database\Seeders;

use App\Models\Sponsor;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class SponsorSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $sponsors = [
            [
                'type'=> 'Piano 24H',
                'description'=> 'Il seguente piano include una sponsorizzazione di 24 ore',
                'price'=> 2.99,
                'duration'=> 24
            ],
            [
                'type'=> 'Piano 72H',
                'description'=> 'Il seguente piano include una sponsorizzazione di 72 ore',
                'price'=> 5.99,
                'duration'=> 72
            ],
            [
                'type'=> 'Piano 144H',
                'description'=> 'Il seguente piano include una sponsorizzazione di 144 ore',
                'price'=> 9.99,
                'duration'=> 144
            ],
            
        ];

        foreach ($sponsors as $sponsor) {
            $new_sponsor = new Sponsor();
            $new_sponsor->type = $sponsor['type'];
            $new_sponsor->description = $sponsor['description'];
            $new_sponsor->price = $sponsor['price'];
            $new_sponsor->duration = $sponsor['duration'];
            $new_sponsor->save();
        }
    }
}
