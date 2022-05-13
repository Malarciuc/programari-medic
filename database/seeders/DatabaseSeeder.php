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
         app(DoctorSeeder::class)->run();
         app(AppointmentSeeder::class)->run();

    }
}
