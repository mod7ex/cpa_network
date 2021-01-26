<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Jenssegers\Mongodb\Eloquent\Model;

class PaymentMethod extends Model
{
    use HasFactory;

    public function users()
    {
        return $this->hasMany(User::class);
    }

    public function getFeesAttribute($fees)
    {
        if ($fees['fix'] === 0 && $fees['relative'] === 0) {
            return 0;
        } elseif ($fees['relative'] != 0) {
            return $fees['relative'];
        } else {
            return $fees['fix'];
        }
    }
}