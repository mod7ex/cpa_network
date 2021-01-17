<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Jenssegers\Mongodb\Eloquent\Model;

class Offer extends Model
{
    use HasFactory;

    // protected $fillable = [];

    protected $guarded = [];

    public function scopePublic($query)
    {
        return $query->where('promotion.public', true);
    }

    public function scopePrivate($query)
    {
        return $query->where('promotion.public', false);
    }

    protected $hidden = [
        'updated_at',
        'created_at',
        'promotion'
    ];

    public function clicks()
    {
        return $this->hasMany(Click::class);
    }

    public function restrictions()
    {
        return $this->belongsToMany(Restriction::class, null, 'offer_ids', 'restriction_ids');
    }

    public function promotionmethods()
    {
        return $this->belongsToMany(PromotionMethod::class, null, 'offer_ids', 'promotion_method_ids');
    }

    public function niches()
    {
        return $this->belongsToMany(Niche::class, null, 'offer_ids', 'niche_ids');
    }

    public function payouttypes()
    {
        return $this->belongsToMany(PayoutType::class, null, 'offer_ids', 'payout_type_ids');
    }

    public function verticals()
    {
        return $this->belongsToMany(Vertical::class, null, 'offer_ids', 'vertical_ids');
    }

    public function devices()
    {
        return $this->belongsToMany(Device::class, null, 'offer_ids', 'device_ids');
    }

    public function oss()
    {
        return $this->belongsToMany(Os::class, null, 'offer_ids', 'os_ids');
    }

    public function browsers()
    {
        return $this->belongsToMany(Browser::class, null, 'offer_ids', 'browser_ids');
    }

    public function countries()
    {
        return $this->belongsToMany(Country::class, null, 'offer_ids', 'country_ids');
    }
}