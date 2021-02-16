<?php

namespace Database\Factories;

use App\Models\Browser;
use App\Models\User;
use App\Models\Click;
use App\Models\Country;
use App\Models\Device;
use App\Models\Offer;
use App\Models\Os;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\Factory;

class ClickFactory extends Factory
{
    use FactoryHelper;

    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Click::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'converted' => $this->faker->boolean(10),
            // 'user_id' => $this->getRandom(User::class),
            'user_id' => $this->getRandom(User::class),
            'offer_id' => $this->getRandom(Offer::class),

            'cookie' => [
                'name' => $this->faker->uuid,
                'ttl' => 3600,
                'value' => hash('sha256', $this->faker->uuid),
            ],

            /*
            {
                name: string,
                ttl: time,
                ...
            }
            */

            'details' => [
                'os' => $this->getRandom(Os::class),
                'device' => $this->getRandom(Device::class),
                'country' => $this->getRandom(Country::class),
                'browser' => $this->getRandom(Browser::class),
                'ip' => $this->faker->ipv4,
            ],

            /*
            {
                os: ..,
                ip: ...,
                .
                ..
                ...
            }
            */

            'created_at' => Carbon::yesterday(),
        ];
    }
}
