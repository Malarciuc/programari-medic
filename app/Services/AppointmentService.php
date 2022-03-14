<?php

namespace App\Services;


use Carbon\Carbon;
use Illuminate\Support\Collection;

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

    public function getMostFreeDays(Collection $weekAppointments): string
    {
        $apCount = [];
        for ($i = 0; $i < 7; $i++) {
            if ($i <= (now()->get('dayOfWeek') - 1)) {
                continue;
            }
            $nd = now()->startOf('week')->addDays($i);
            $apCount[$i] = $weekAppointments->where('appointment_date', $nd->format('Y-m-d'))->count();
        }
        $min1 = $apCount[array_key_first($apCount)];
        $min1Key = array_key_first($apCount);
        $min2 = $apCount[array_key_first($apCount) + 1] ?? $apCount[array_key_first($apCount) + 1];
        $min2Key = isset($apCount[array_key_first($apCount) + 1]) ? array_key_first($apCount) + 1 : array_key_first($apCount);
        foreach ($apCount as $key => $count) {
            if ($count < $min1) {
                $min1 = $count;
                $min1Key = $key;
            }
        }

        unset($apCount[$min1Key]);

        foreach ($apCount as $key => $count) {
            if ($count < $min2 && $count > $min1) {
                $min2 = $count;
                $min2Key = $key;
            }
        }
        $results = [];
        $results[0] = $this->getWeekDays()[now()->startOf('week')->addDays($min1Key)->dayOfWeek - 1];
        $results[1] = $this->getWeekDays()[now()->startOf('week')->addDays($min2Key)->dayOfWeek - 1];
        $results = array_unique($results);

        return implode(' si ', $results);
    }
}