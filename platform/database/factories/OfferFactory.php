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
    public function getRandom($model)
    {
        return $model::raw(function ($collection) {
            return $collection->aggregate([
                [
                    '$project' => [
                        '_id' => 1
                    ]
                ],

                // [
                //     '$sample' => [
                //         'size' => $this->faker->numberBetween(0, $amount)
                //     ]
                // ]
            ]);
        })->map(function ($classInstance) {
            return $classInstance->id;
        })->toArray();
    }

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

        return [
            'restriction_ids' => $this->faker->randomElements($this->getRandom(Restriction::class)),
            'promotion_method_ids' => $this->faker->randomElements($this->getRandom(PromotionMethod::class)),
            'niche_ids' => [],
            // 'niche_ids' => $this->faker->randomElements($this->getRandom(Niche::class)),
            'payout_type_ids' => $this->faker->randomElements($this->getRandom(PayoutType::class)),
            'vertical_ids' => $this->faker->randomElements($this->getRandom(Vertical::class)),
            'device_ids' => $this->faker->randomElements($this->getRandom(Device::class)),
            'os_ids' =>  $this->faker->randomElements($this->getRandom(Os::class)),
            'browser_ids' =>  $this->faker->randomElements($this->getRandom(Browser::class)),
            'country_ids' =>  $this->faker->randomElements($this->getRandom(Country::class)),

            'name' => $this->faker->text(13),
            // 'Id' => $this->faker->numberBetween(999, 9999),
            'description' => $this->faker->text(),
            'payout' => $this->faker->numberBetween(10, 50000), # in cents not us$
            'landing_pages' => [
                $this->faker->url,
                $this->faker->url,
            ],
            'images' => [
                $this->faker->url,
                $this->faker->url,
            ],
            'promotion' => [
                'public' => $publicBool,
                'hidden' => $hiddenBool,
                'promoters' => !$publicBool ? $this->faker->randomElements($this->getRandom(User::class), 5) : [],
                'pending_promoters' => (!$publicBool && !$hiddenBool) ? $this->faker->randomElements($this->getRandom(User::class), 5) : [],
                'rejected_promoters' => (!$publicBool && !$hiddenBool) ? $this->faker->randomElements($this->getRandom(User::class), 5) : [],
            ]
        ];
    }
}