<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Faker\Generator as Faker;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run(Faker $faker)
    {
       

        for($i = 0 ; $i < 10 ; $i++){
            $new_user = new User();
            $new_user->name = $faker->firstName();
            $new_user->surname = $faker->lastName();
            $new_user->email = $faker->email();
            $new_user->birthdate = $faker->date('Y_m_d');
            $new_user->password = Hash::make('password');
            $new_user->save();
        };
    }
}
