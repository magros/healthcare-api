<?php

namespace App\Http\Controllers;

use App\Models\Doctor;
use App\Models\Speciality;
use App\Traits\ApiResponser;
use App\Transformers\DoctorTransformer;
use Illuminate\Http\Request;

class DoctorSpecialityController extends Controller
{
    use ApiResponser;

    private $doctorTransformer;

    public function __construct(DoctorTransformer $doctorTransformer)
    {
        $this->doctorTransformer = $doctorTransformer;
    }

    public function store(Request $request, $doctorId)
    {
        $this->validate($request, ['required' => 'specialities_ids']);
        $doctor = Doctor::find($doctorId);
        $specialities = explode(',', $request->get('specialities_ids'));
        $doctor->specialities()->attach($specialities);

        $doctor->load('offices.state', 'specialities', 'user', 'medicalServices', 'opinions.patient.user', 'sufferings');

        return $this->successResponse($this->doctorTransformer->transform($doctor->toArray()));
    }
}
