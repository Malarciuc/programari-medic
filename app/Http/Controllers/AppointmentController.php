<?php

namespace App\Http\Controllers;

use App\Models\Appointment;
use App\Models\Doctor;
use App\Services\AppointmentService;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Routing\Redirector;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\DB;

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

        $mostFreeDays = $service->getMostFreeDays($weekAppointments);


        return view('create_appointment', [
            'week_appointments'  => $weekAppointments,
            'doctor'             => $doctor,
            'week_days'          => $service->getWeekDays(),
            'week_days_in_dates' => $service->getWeekDaysInDates(),
            'work_hours'         => $service->getWorkHours(),
            'most_free_days' =>$mostFreeDays
        ]);
    }

    public function revokeAppointment(Request $request): RedirectResponse
    {
        $userId = auth()->user()->id;
        $appointmentId =  $request->appointment_id ?? null;

        if(!$appointmentId){
            return response()->redirectToRoute('home');
        }

        Appointment::where('user_id', $userId)->where('id', $appointmentId)->delete();

        return response()->redirectToRoute('home');
    }
    public function doctorsList()
    {
        $doctors = Doctor::all();

        return view('doctors_list', compact('doctors'));
    }

    public function createAppointment(Request $request
    ): Redirector|Application|RedirectResponse {
        $appointment = Appointment::create([
            'user_id'          => auth()->user()->id,
            'doctor_id'        => $request->doctor_id,
            'appointment_date' => $request->appointment_date,
            'order'            => $request->order,
        ]);


        return redirect('/home');
    }

    public function statistics()
    {
        $appointments = Appointment::query()->select(DB::raw('appointment_date, count(id) as appointments'))
                   ->groupBy('appointment_date')
                   ->get();

        return view('statistics')->with(['appointments' => $appointments]);
    }
}
