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
        $estates = [
            [
                'title' => 'Bellissimo appartamento con tutto incluso',
                'type' => 'Appartamento',
                'cover_img' => 'http://appartamentimartina.it/wp/wp-content/uploads/2017/05/8_JAN_4736appartamento.jpg'
            ],
            [
                'title' => 'Castello Aragonese',
                'type' => 'Castello',
                'cover_img' => 'https://dynamic-media-cdn.tripadvisor.com/media/photo-o/0a/a7/8f/bd/castello-aragonese.jpg?w=1200&h=-1&s=1'
            ],
            [
                'title' => 'Casetta in campagna',
                'type' => 'Casa',
                'cover_img' => 'https://cf.bstatic.com/xdata/images/hotel/max1024x768/125635640.jpg?k=3505df48163fdc2555051b73fa838a5bd067b310f6ba32ee97326b82bdd3e267&o=&hp=1'
            ],
            [
                'title' => 'Attico con vista mare',
                'type' => 'Attico',
                'cover_img' => 'https://media-cdn.tripadvisor.com/media/vr-splice-j/06/ed/92/f6.jpg'
            ],
            [
                'title' => 'Masseria lontana dal rumore cittadino',
                'type' => 'Masseria',
                'cover_img' => 'https://static.charmingsardinia.com/hotels/396/static/files/masseria-salinola1.jpg'
            ],
            [
                'title' => 'Villa a due piani',
                'type' => 'Villa',
                'cover_img' => 'https://www.sardegna-villa.it/media/w1296x775/32087.jpg'
            ],
            [
                'title' => 'Appartamento nel centro cittadino',
                'type' => 'Appartamento',
                'cover_img' => 'https://www.fiorenzointeriordesign.com/images/galcms/850x635c50q80/galleryone/gallery-prodotto-test/zoom/img_6206_65721.jpg'
            ],
            [
                'title' => 'Casetta vicino al mare',
                'type' => 'Casa',
                'cover_img' => 'https://www.elbalink.it/wp-content/uploads/appartamenti-la-tua-casa-sul-mare-001.jpg'
            ],
            [
                'title' => 'Attico con vista sulla città',
                'type' => 'Attico',
                'cover_img' => 'https://www.morabitoimmobiliare.it/file/2022/04/attico-casa-agenzia-morabito-immobiliare-milano.jpg'
            ],
            [
                'title' => 'Stanza privata nel centro storico',
                'type' => 'Stanza privata',
                'cover_img' => 'https://cf.bstatic.com/xdata/images/hotel/max1024x768/240373976.jpg?k=2d3a0264ba9851605f19619eb9e0172d61899a6b09fda652a60f14fc31c839a2&o=&hp=1'
            ],
        ];

        for ($i=0; $i < count($estates); $i++) { 
            $estate = $estates[$i];
            $new_estate = new Estate();
            $new_estate->title = $estate['title'];
            $new_estate->slug = Helpers::generateSlug($new_estate->title);
            $new_estate->description = $faker->paragraph();
            $new_estate->type = $estate['type'];
            $new_estate->room_number = $faker->randomDigitNotZero();
            $new_estate->bed_number = $faker->randomDigitNotZero();
            $new_estate->bathroom_number = $faker->randomDigitNotZero();
            $new_estate->detail = $faker->numerify('interno-#');
            $new_estate->price = $faker->numberBetween(50 , 3000);
            $new_estate->mq = strval($faker->numberBetween(10,900));
            $new_estate->cover_img = $estate['cover_img'];
            $new_estate->is_visible = 1;
            $new_estate->user_id = $faker->numberBetween(1,10);
            $new_estate->save();
        }
    }
}
