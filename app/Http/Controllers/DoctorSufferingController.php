<?php

namespace App\Http\Controllers;

use App\Models\Doctor;
use App\Traits\ApiResponser;
use App\Transformers\DoctorTransformer;
use Illuminate\Http\Request;

class DoctorSufferingController extends Controller
{
    use ApiResponser;

    private $doctorTransformer;

    public function __construct(DoctorTransformer $doctorTransformer)
    {
        $this->doctorTransformer = $doctorTransformer;
    }

    public function index(Request $request)
    {
        $search = $request->get('search');
    }

    public function store(Request $request, $doctorId)
    {
        $this->validate($request, ['name' => 'required']);

        $doctor = Doctor::find($doctorId);

        $doctor->sufferings()->create($request->all());

        $doctor->load('offices.state', 'specialities', 'user', 'medicalServices', 'opinions.patient.user', 'sufferings');

        return $this->successResponse($this->doctorTransformer->transform($doctor->toArray()));
    }
}
