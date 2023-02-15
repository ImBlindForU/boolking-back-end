<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Address extends Model
{
    use HasFactory;

    protected $fillable =['street','long','lat','city','cap' ,'country','street_code','estate_id'];

    public function estate(){
        return $this->belongsTo(Estate::class);
    }
}
