<?php

namespace Database\Seeders;

use App\Models\Offer;
use App\Models\Vertical;
use Illuminate\Database\Seeder;

class OffersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Offer::factory()
            ->count(176)
            ->create();
    }
}