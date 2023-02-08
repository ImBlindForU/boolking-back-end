<?php

namespace Database\Seeders;

use App\Models\Estate;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Faker\Generator as Faker;
use App\Functions;
use App\Functions\Helpers;

class EstateSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run(Faker $faker)
    {   
            
        for($i = 0 ; $i < 20 ; $i++){
            $new_estate = new Estate();
            $new_estate->title = $faker->sentence();
            $new_estate->slug = Helpers::generateSlug($new_estate->title);
            $new_estate->description = $faker->paragraph();
            $new_estate->type = $faker->randomElement(['casa','appartamento','villa','attico', 'tenuta','mansarda','castello','stanza privata','masseria','baita']);
            $new_estate->room_number = $faker->randomDigitNotZero();
            $new_estate->bed_number = $faker->randomDigitNotZero();
            $new_estate->bathroom_number = $faker->randomDigitNotZero();
            $new_estate->detail = $faker->numerify('interno-#');
            $new_estate->price = $faker->numberBetween(50 , 3000);
            $new_estate->mq = strval($faker->numberBetween(10,900));
            $new_estate->cover_img = $faker->imageUrl(640 ,480,'houses');
            $new_estate->is_visible = 1;
            $new_estate->user_id = $faker->numberBetween(1,10);
            $new_estate->save();
        }
    }
}
