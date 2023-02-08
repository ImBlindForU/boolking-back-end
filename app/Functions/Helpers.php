<?php

namespace App\Functions;
use Illuminate\Support\Str;

class Helpers{
    public static function generateSlug($name){
        return Str::slug($name,'-');
    }
}
    


?>