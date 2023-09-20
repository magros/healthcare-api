<?php

namespace App\Http\Controllers;

use App\Models\Doctor;
use App\Models\Insurer;
use App\Traits\ApiResponser;
use App\Transformers\DoctorTransformer;
use Illuminate\Http\Request;

class DoctorInsurerController extends Controller
{
    use ApiResponser;

    /**
     * @var DoctorTransformer
     */
    private $doctorTransformer;

    /**
     * DoctorInsurerController constructor.
     * @param DoctorTransformer $doctorTransformer
     */
    public function __construct(DoctorTransformer $doctorTransformer)
    {
        $this->doctorTransformer = $doctorTransformer;
    }

    public function store(Request $request, $doctorId)
    {
        $this->validate($request, ['insurerId' => 'required|exists:insurers,id', 'cost' => 'required']);

        $doctor = Doctor::find($doctorId);

        $doctor->insurers()->syncWithoutDetaching([$request->get('insurerId') => [
            'cost' => $request->get('cost')
        ]]);

        $doctor->load('offices.state', 'specialities', 'user', 'medicalServices', 'opinions.patient.user');

        $doctor->user->append('avatar_url');

        return $this->successResponse($this->doctorTransformer->transform($doctor->toArray()));
    }

    public function index($doctorId)
    {
        $doctor = Doctor::findOrFail($doctorId);

        return $this->successResponse($doctor->insurers);
    }
}
