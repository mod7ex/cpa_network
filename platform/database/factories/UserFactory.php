<?php

namespace Database\Factories;

use App\Models\User;
use App\Models\Country;
use App\Models\PaymentMethod;
use App\Models\Timezone;
use Illuminate\Support\Str;
use Illuminate\Database\Eloquent\Factories\Factory;

class UserFactory extends Factory
{
    private function getRandomCountry()
    {
        return Country::raw(function ($collection) {
            return $collection->aggregate(
                [
                    [
                        '$sample' => [
                            'size' =>  1
                        ]
                    ],

                    [
                        '$project' => [
                            '_id' => 1
                        ]
                    ],
                ]
            );
        })->first();
    }

    private function getRandomTimezone()
    {
        return Timezone::raw(function ($collection) {
            return $collection->aggregate(
                [
                    [
                        '$sample' => [
                            'size' =>  1
                        ]
                    ]
                ]
            );
        })->first();
    }

    private function getRandomPaymentMethod()
    {
        return PaymentMethod::raw(function ($collection) {
            return $collection->aggregate(
                [
                    [
                        '$sample' => [
                            'size' =>  1
                        ]
                    ]
                ]
            );
        })->first();
    }

    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = User::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        $paymentMethod = $this->getRandomPaymentMethod();

        return [
            'contact_infos' => [
                'title' => $this->faker->randomElement(['Mr', 'Mrs', 'Miss']),
                'first_name' => $this->faker->firstName(),
                'last_name' => $this->faker->lastName(),
                'website' => $this->faker->domainName,
                'country_id' => $this->getRandomCountry()->id,
                'timezone_id' => $this->getRandomTimezone()->id,
                'street_address' => $this->faker->streetAddress,
                'city' => $this->faker->city,
                'region' => $this->faker->state,
                'zip_code' => $this->faker->postcode,
                'phone_number' => $this->faker->phoneNumber,
                'skype' => 'live:.cid.' . $this->faker->uuid,
                'telegram' => $this->faker->userName,
                'best_time_to_call' => $this->faker->randomElement(['PM', 'AM']),
            ],

            'billing_infos' => [
                'payment_method_id' => $paymentMethod->id,

                'min_payout' => $this->faker->randomElement($paymentMethod->min_payout),

                'billing_details' => [
                    'email' => $this->faker->email
                ]
            ],

            'balance' => $this->faker->numberBetween(0, 500) + (1 / $this->faker->numberBetween(1, 4)),
            'email' => $this->faker->unique()->safeEmail,
            'email_verified_at' => now(),
            'password' => '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', // password
            'remember_token' => Str::random(10),
        ];
    }
}