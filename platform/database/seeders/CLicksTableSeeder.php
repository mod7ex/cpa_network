<?php

namespace Database\Seeders;

use App\Models\Click;
use Illuminate\Database\Seeder;

class CLicksTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Click::factory()->count(300)->create();
    }
}