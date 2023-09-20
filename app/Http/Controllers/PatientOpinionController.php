<?php

namespace App\Http\Controllers;

use App\Models\Patient;
use App\Traits\ApiResponser;
use Illuminate\Http\Request;

class PatientOpinionController extends Controller
{
    use ApiResponser;

    public function store(Request $request, $patientId)
    {
        $this->validate($request, [
            'doctor_id' => 'required|exists:doctors,id',
            'commentaries' => 'required',
            'rate' => 'required|integer'
        ]);

        $opinion = Patient::find($patientId)->opinions()->create($request->all());

        return $this->successResponse($opinion);
    }

    public function hasOpinions(Request $request, $patientId, $doctorId)
    {
        return $this->successResponse(['hasComment' => (Patient::find($patientId)->opinions()->where('doctor_id', $doctorId)->count() > 0)]);
    }
}
