<?php

namespace Database\Factories;

use App\Models\Browser;
use App\Models\Country;
use App\Models\Device;
use App\Models\Offer;
use App\Models\Os;
use App\Models\Vertical;
use App\Models\PayoutType;
use App\Models\Restriction;
use App\Models\PromotionMethod;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

class OfferFactory extends Factory
{
    use FactoryHelper;

    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Offer::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        $publicBool = $this->faker->boolean(40);
        $hiddenBool = $publicBool ? false : $this->faker->boolean(50);

        $promotion = array();
        if($publicBool){
            $promotion['public'] = true;
        }else{
            $promotion['public'] = false;
            $promotion['promoters'] = $this->getRandomIds(User::class, 3) ;
            if($hiddenBool){
                $promotion['hidden'] = true;
            } else {
                $promotion['hidden'] = false;
                $promotion['pending_promoters'] = $this->getRandomIds(User::class, 3);
                $promotion['rejected_promoters'] = $this->getRandomIds(User::class, 2);
            }
        }

        return [
            'restriction_ids' => $this->getRandomIds(Restriction::class, 3),
            'promotion_method_ids' => $this->getRandomIds(PromotionMethod::class, 3),
            'niche_ids' => [],
            // 'niche_ids' => $this->getRandomIds(Niche::class, 2),
            'payout_type_ids' => $this->getRandomIds(PayoutType::class, 1),
            'vertical_ids' => $this->getRandomIds(Vertical::class, 2),
            'device_ids' => $this->getRandomIds(Device::class, 3),
            'os_ids' =>  $this->getRandomIds(Os::class, 2),
            'browser_ids' =>  $this->getRandomIds(Browser::class, 3),
            'country_ids' =>  $this->getRandomIds(Country::class, 7),

            'name' => $this->faker->text(13),
            'description' => $this->faker->text(),
            'payout' => $this->faker->numberBetween(10, 50000), # in cents not us$ (0.1$ - 500$)
            'landing_pages' => [
                $this->faker->url,
                $this->faker->url,
            ],
            'images' => [
                $this->faker->url,
                $this->faker->url,
            ],
            'promotion' => $promotion
        ];
    }
}