<?php

namespace App\Http\Controllers;

use App\Models\Appointment;
use App\Models\Doctor;
use App\Services\AppointmentService;
use Illuminate\Http\Request;

class AppointmentController extends Controller
{


    public function makeAppointment(Doctor $doctor, AppointmentService $service)
    {
        $startDate = now()->startOf('week')->startOf('day');
        $endDate = now()->endOf('week')->endOf('day');

        $weekAppointments = Appointment::whereBetween('appointment_date', [
            $startDate->format('Y-m-d'),
            $endDate->format('Y-m-d'),
        ])->where('doctor_id', $doctor->id)
            ->get();

        return view('create_appointment', [
            'week_appointments'  => $weekAppointments,
            'doctor'             => $doctor,
            'week_days'          => $service->getWeekDays(),
            'week_days_in_dates' => $service->getWeekDaysInDates(),
            'work_hours'         => $service->getWorkHours(),
        ]);
    }

    public function doctorsList()
    {
        $doctors = Doctor::all();

        return view('doctors_list', compact('doctors'));
    }

    public function createAppointment(Request $request
    ): \Illuminate\Routing\Redirector|\Illuminate\Contracts\Foundation\Application|\Illuminate\Http\RedirectResponse {
        $appointment = Appointment::create([
            'user_id'          => auth()->user()->id,
            'doctor_id'        => $request->doctor_id,
            'appointment_date' => $request->appointment_date,
            'order'            => $request->order,
        ]);


        return redirect('/home');
    }
}
