<?php

namespace App\Http\Controllers;

use App\Models\Patient;
use App\Traits\ApiResponser;
use App\Transformers\AppointmentTransformer;
use Carbon\Carbon;
use Illuminate\Http\Request;

class AppointmentController extends Controller
{
    use ApiResponser;

    /**
     * @var AppointmentTransformer
     */
    private $appointmentTransformer;

    public function __construct(AppointmentTransformer $appointmentTransformer)
    {
        $this->appointmentTransformer = $appointmentTransformer;
    }

    public function create(Request $request, $patientId)
    {
        $this->validate($request, [
            'hour' => 'required',
            'date' => 'required',
            'doctor_medical_service_id' => 'required'
        ]);

        $patient = Patient::findOrFail($patientId);

        $appointment = $patient->appointments()->create(array_merge($request->all(), ['date' => (new Carbon($request->get('date')))->format('Y-m-d')]));

        $appointment->office->doctor->load('specialities');
        $appointment->office->append('avatar_url');
        $appointment->office->doctor->user->append('avatar_url');

        return $this->successResponse($this->appointmentTransformer->transform($appointment->toArray()));
    }

    public function show(Request $request, $patientId)
    {
        $patient = Patient::findOrFail($patientId);

        $patient->appointments->load('office.doctor.user');

        $patient->appointments->each(function ($appointment) {
            $appointment->office->doctor->load('specialities');
            $appointment->office->append('avatar_url');
            $appointment->office->doctor->user->append('avatar_url');
        });

        return $this->successResponse($this->appointmentTransformer->transformCollection($patient->appointments->toArray()));
    }
}
