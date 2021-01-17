<?php

namespace Database\Seeders;

use App\Models\Os;
use App\Models\Niche;
use App\Models\Device;
use App\Models\Browser;
use App\Models\Country;
use App\Models\Timezone;
use App\Models\Vertical;
use App\Models\PayoutType;
use App\Models\Restriction;
use App\Models\PaymentMethod;
use App\Models\PromotionMethod;
use Illuminate\Database\Seeder;

class GlobalSeeder extends Seeder
{
    function seedCountriesTable()
    {
        $countries = file_get_contents('https://restcountries.eu/rest/v2/all');

        $countries = collect(json_decode($countries));

        $countries->each(function ($country) {
            Country::create([
                'details' => [
                    'name' => $country->name,
                    'code' => $country->alpha3Code,
                    'calling_codes' => $country->callingCodes,
                ]
            ]);
        });
    }

    function seedTimeZonesTable()
    {
        $timezones = file_get_contents('http://worldtimeapi.org/api/timezone');

        $timezones = collect(json_decode($timezones));

        foreach ($timezones as $timezone) {
            Timezone::create([
                'name' => $timezone
            ]);
        }
    }

    function seedPaymentMethodsTable()
    {
        PaymentMethod::insert([
            [
                'name' => 'Paypal',
                'fees' => ['fix' => 2.5, 'relative' => 0],
                'min_payout' => [50, 100, 200]
            ],

            [
                'name' => 'Paxum',
                'fees' => ['fix' => 5, 'relative' => 0],
                'min_payout' => [100, 300, 600]
            ],
        ]);
    }

    function seedVerticalsTable()
    {
        $verticals = [
            'Gaming',
            'Adult Gaming',
            'Apps',
            'Dating',
            'Adult Dating',
            'Sweapstakes',
            'Survey',
            'Nutra',
            'Mainstream',
            'Other',
            'Gambling',
            'Ecommerce',
            'Crypto',
            'Male inhancement',
        ];

        foreach ($verticals as $vertical) {
            Vertical::create(['name' => $vertical]);
        };
    }

    function seedPayoutTypesTable()
    {
        $payout_types = [
            'CPI',
            'CPM',
            'DOI',
            'SOI',
            'Revshare',
            'Revshare lifetime',
            'PPS',
            'Multi CPA',
            'Call',
            'SMS',
            'PPConfirmation',
            'PPDelivrey',
        ];

        foreach ($payout_types as $payout_type) {
            PayoutType::create(['name' => $payout_type]);
        };
    }

    function seedDevicesTable()
    {
        $devices = [
            'Carrier',
            'Desktop / web',
            'Mobile',
            'Tablet',
            'Wi-Fi',
        ];

        foreach ($devices as $device) {
            Device::create(['name' => $device]);
        };
    }

    function seedNichesTable()
    {
        $niches = [];

        foreach ($niches as $niche) {
            Niche::create(['name' => $niche]);
        };
    }

    function seedPromotionMethodsTable()
    {
        $promotion_methods = [
            'Contextual',
            'Display',
            'Mailing',
            'Mobile App',
            'Search',
            'SMS',
            'Social Media',
            'Pop',
            'Push',
            'video',
        ];

        foreach ($promotion_methods as $promotion_method) {
            PromotionMethod::create(['name' => $promotion_method]);
        };
    }

    function seedRestrictionsTable()
    {
        $restrictions = [
            'No spam traffic',
            'No bot traffic',
            'No email traffic',
            'No social media traffic',
            'No sub-affiliation',
            'No proxy or vpn',
            'No brand bidding',
            'No incent traffic',
        ];

        foreach ($restrictions as $restriction) {
            Restriction::create(['name' => $restriction]);
        };
    }

    function seedOssTable()
    {
        $oss = [
            'Windows',
            'Linux',
            'Indroid',
            'Mac',
            'Ios',
        ];

        foreach ($oss as $os) {
            Os::create(['name' => $os]);
        };
    }

    function seedBrowsersTable()
    {
        $browsers = [
            'Chrome',
            'Opera',
            'IE',
            'Firefox',
            'Yandex',
            'Sumsung',
            'Facebook',
        ];

        foreach ($browsers as $browser) {
            Browser::create(['name' => $browser]);
        };
    }

    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $this->seedCountriesTable();
        $this->seedTimeZonesTable();
        $this->seedPaymentMethodsTable();
        $this->seedVerticalsTable();
        $this->seedPayoutTypesTable();
        $this->seedDevicesTable();
        $this->seedNichesTable();
        $this->seedPromotionMethodsTable();
        $this->seedRestrictionsTable();
        $this->seedOssTable();
        $this->seedBrowsersTable();
    }
}