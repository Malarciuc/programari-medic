<?php
declare(strict_types=1);

namespace Database\Seeders;

use App\Models\Appointment;
use App\Models\Doctor;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;


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

        $passowrd = bcrypt('123456789');

        $usersToInsert = [];

        $now = now();

        for ($i = 1; $i <= (($days * 8 * 3) + 1000); $i++) {

            $usersToInsert[] = [
                'name'     => rand(1, 99999999). 'tesxt' . rand(1, 1000),
                'email'    =>  rand(1, 99999999). 'tesxt' . rand(1, 1000). '@gmail.com',
                'password' => $passowrd,
                'created_at' => $now,
                'updated_at' => $now
            ];

            if(count($usersToInsert) === 1000 || $i == ($days * 8 * 3) + 1000 ){

                DB::table('users')->insert($usersToInsert);
                $usersToInsert = [];
            }
           
        }

        $users = User::all()->toArray();

        $doctors = Doctor::all();

        $holydays = ['2020-12-25', '2021-05-09', '2022-04-11','2022-04-12','2022-04-13','2022-04-14','2022-04-15','2021-04-05','2021-04-06','2021-04-07','2021-04-08','2021-04-09','2021-04-10'];

        for ($i = $days; $i > 0; $i--) {
            $date = now()->subDays($i);
            $formatedDate = $date->format('Y-m-d');
            $chance = in_array($formatedDate, $holydays) ? 3 : rand(1, 2);
            foreach ($doctors as $doctor) {
                for ($order = 1; $order <= 8; $order++) {
                    if ($this->isChance($chance, $date)) {

                        Appointment::query()->create([
                            'appointment_date'  => $formatedDate,
                            'order' => $order,
                            'user_id'           => array_shift($users)['id'],
                            'doctor_id'         => $doctor->id,
                        ]);
                    }
                }
            }
        }

    }

    private function isChance($chance = 1, $date): bool
    {
        if($date->isWeekend()){
            $chance = 4;
        }
        
        return (rand(1, 3) <= $chance);
    }

}
