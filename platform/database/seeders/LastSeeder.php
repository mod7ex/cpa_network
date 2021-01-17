<?php

namespace Database\Seeders;

use App\Models\Os;
use App\Models\Niche;
use App\Models\Offer;
use App\Models\Device;
use App\Models\Browser;
use App\Models\Country;
use App\Models\Vertical;
use App\Models\PayoutType;
use App\Models\Restriction;
use App\Models\PromotionMethod;
use Illuminate\Database\Seeder;

class LastSeeder extends Seeder
{
    private function foo($offer, $property,  $model)
    {
        $model::whereIn('_id', $offer->$property)->each(function ($elm) use ($offer) {
            $elm->offer_ids = array_merge($elm->offer_ids ? $elm->offer_ids : [], [$offer->id]);
            $elm->save();
        });
    }


    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Offer::all()->each(function ($offer) {
            $this->foo($offer, 'vertical_ids', Vertical::class);
            $this->foo($offer, 'restriction_ids', Restriction::class);
            $this->foo($offer, 'promotion_method_ids', PromotionMethod::class);
            $this->foo($offer, 'niche_ids', Niche::class);
            $this->foo($offer, 'payout_type_ids', PayoutType::class);
            $this->foo($offer, 'device_ids', Device::class);
            $this->foo($offer, 'os_ids', Os::class);
            $this->foo($offer, 'browser_ids', Browser::class);
            $this->foo($offer, 'country_ids', Country::class);
        });
    }
}