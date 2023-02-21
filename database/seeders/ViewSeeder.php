<?php

namespace Database\Seeders;

use App\Models\View;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Faker\Generator as Faker;

class ViewSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run(Faker $faker)
    {
        for ($i=0; $i < 30; $i++) { 
            $new_view = new View();
            $new_view->date = $faker->dateTimeThisYear();
            $new_view->guest_ip = $faker->ipv4();
            $new_view->estate_id = $faker->numberBetween(1, 10);
            $new_view->save();
        }
    }
}
