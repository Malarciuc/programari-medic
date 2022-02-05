<?php

namespace App\Services;


use Carbon\Carbon;

class AppointmentService
{
    public function getWeekDaysInDates()
    {
        $startOfWeek = now()->firstWeekDay;
        return [
            Carbon::parse($startOfWeek)->format('d.m.Y'),
            Carbon::parse($startOfWeek)->addDays(1)->format('d.m.Y'),
            Carbon::parse($startOfWeek)->addDays(2)->format('d.m.Y'),
            Carbon::parse($startOfWeek)->addDays(3)->format('d.m.Y'),
            Carbon::parse($startOfWeek)->addDays(4)->format('d.m.Y'),
            Carbon::parse($startOfWeek)->addDays(5)->format('d.m.Y'),
            Carbon::parse($startOfWeek)->addDays(6)->format('d.m.Y'),

        ];
    }

    public function getWeekDays()
    {
        return [
            'Luni',
            'Marti',
            'Miercuri',
            'Joi',
            'Vineri',
            'Simbata',
            'Duminica',
        ];
    }

    public function getWorkHours(): int
    {
        return 8;
    }
}