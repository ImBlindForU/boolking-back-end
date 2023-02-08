<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Sponsor extends Model
{
    use HasFactory;
    protected $fillable =['type','description','price','duration'];

    public function estates(){
        return $this->belongsToMany(Estate::class)->withPivot('start_date','end_date');
    }
}
