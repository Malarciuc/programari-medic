<?php

namespace App\Http\Controllers;

use App\Models\Appointment;
use App\Models\Doctor;
use App\Services\AppointmentService;

class AppointmentController extends Controller
{
    public function index()
    {
        $appointments = Appointment::where('user_id', auth()->user()->id)->get();

        return view('appintments_list');
    }

    public function makeAppointment(Doctor $doctor, AppointmentService $service)
    {


        return view('create_appointment', [
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
}
