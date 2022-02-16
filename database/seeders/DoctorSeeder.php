<?php

namespace Database\Seeders;

use App\Models\Doctor;
use Illuminate\Database\Seeder;

class DoctorSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        foreach ($this->doctors() as $doctor){
            Doctor::create($doctor);
        }
    }

    public function doctors()
    {
        return [
            [
                'name' => 'Riscovoi Alina',
            ],
            [
                'name' => 'Vadim Rusu',
            ],
            [
                'name' => 'Ana Nemerenco',
            ],
        ];
    }

}
