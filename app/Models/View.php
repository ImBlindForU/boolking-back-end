<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class View extends Model
{
    use HasFactory;
    protected $fillable =['date','guest_ip','estate_id'];

    public function estate(){
        return $this->belongsTo(Estate::class);
    }
}
