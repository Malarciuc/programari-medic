<?php

namespace App\Services;


use Carbon\Carbon;

class AppointmentService
{
    public function getWeekDaysInDates(): array
    {
        $startOfWeek = now()->startOf('week');

        return [
            Carbon::parse($startOfWeek),
            Carbon::parse($startOfWeek)->addDays(1),
            Carbon::parse($startOfWeek)->addDays(2),
            Carbon::parse($startOfWeek)->addDays(3),
            Carbon::parse($startOfWeek)->addDays(4),
            Carbon::parse($startOfWeek)->addDays(5),
            Carbon::parse($startOfWeek)->addDays(6),

        ];
    }

    public function getWeekDays(): array
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