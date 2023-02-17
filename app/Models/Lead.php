<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Lead extends Model
{
    use HasFactory;

    protected $fillable = ['email', 'name', 'message', 'estate_id'];

    public function estate()
    {
        return $this->belongsTo(Estate::class);
    }
}
