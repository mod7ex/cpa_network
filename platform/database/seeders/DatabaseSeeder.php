<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $this->call(GlobalSeeder::class);
        $this->call(UsersTableSeeder::class);
        $this->call(OffersTableSeeder::class);
        $this->call(CLicksTableSeeder::class);
        $this->call(LastSeeder::class);
        $this->call(AdminsTableSeeder::class);
    }
}