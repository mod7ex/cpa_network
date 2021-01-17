<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Jenssegers\Mongodb\Eloquent\Model;

class Restriction extends Model
{
    use HasFactory;

    public function offers()
    {
        return $this->hasMany(Offer::class, 'offer_ids', '_id');
    }
}