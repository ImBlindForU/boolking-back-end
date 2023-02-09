<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Estate extends Model
{
    use HasFactory;
    protected $fillable =['title','slug','description','type','room_number','bed_number','bathroom_number','detail','price','mq','cover_img','is_visible','user_id'];

    public function user(){
        return $this->belongsTo(User::class);
    }

    public function images(){
        return $this->hasMany(Image::class);
    }

    public function services(){
        return $this->belongsToMany(Service::class);
    }
    
    public function address(){
        return $this->hasOne(Address::class);
    }

    public function views(){
        return $this->hasMany(View::class);
    }

    public function sponsors(){
        return $this->belongsToMany(Sponsor::class)->withPivot('start_date','end_date');
    }

    // bho
}
