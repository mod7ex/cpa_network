<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Jenssegers\Mongodb\Eloquent\Model;

class Country extends Model
{
    use HasFactory;

    public function offers()
    {
        return $this->hasMany(Offer::class);
    }

    public function users()
    {
        return $this->hasMany(User::class);
    }
}