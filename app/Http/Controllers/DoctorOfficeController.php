<?php

namespace App\Http\Controllers;

use App\Models\Doctor;
use App\Traits\ApiResponser;
use Illuminate\Http\Request;

class DoctorOfficeController extends Controller
{
    use ApiResponser;

    public function index($doctorId)
    {
        $doctor = Doctor::findOrFail($doctorId);

        return $this->successResponse($doctor->offices);
    }
}
