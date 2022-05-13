<?php
declare(strict_types=1);

namespace Database\Seeders;

use App\Models\Appointment;
use App\Models\Doctor;
use App\Models\User;

class AppointmentSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $days = 720;

        for ($i = 1; $i <= $days * 8; $i++) {
            User::query()->create([
                'name'     => faker()->name,
                'email'    => faker()->email,
                'password' => bcrypt('123456789'),
            ]);
        }

        $users = User::all()->toArray();

        $doctors = Doctor::all();

        $holydays = ['2020-12-25'];

        for ($i = $days; $i > 0; $i--) {
            $date = now()->subDays($i);
            $formatedDate = $date->format('Y-m-d');
            $chance = in_array($formatedDate, $holydays) ? 3 : rand(1, 2);
            foreach ($doctors as $doctor) {
                for ($order = 1; $order <= 8; $order++) {
                    if ($this->isChance($chance)) {

                        Appointment::query()->create([
                            'appointment_date'  => $formatedDate,
                            'appointment_order' => $order,
                            'user_id'           => array_shift($users)->id,
                            'doctor_id'         => $doctor->id,
                        ]);
                    }
                }
            }
        }

    }

    private function isChance($chance = 1): bool
    {
        return (rand(1, 3) <= $chance);
    }

}
