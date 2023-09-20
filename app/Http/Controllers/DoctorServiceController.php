<?php

namespace App\Http\Controllers;

use App\Models\Doctor;
use Illuminate\Http\Request;

class DoctorServiceController extends Controller
{
    public function index($id)
    {
        $doctor = Doctor::findOrFail($id);

        return $doctor->medicalServices;
    }

    public function show($doctorId, $doctorServiceId)
    {
        $doctor = Doctor::findOrFail($doctorId);

        return $doctor->medicalServices()->where('doctor_medical_service.id', $doctorServiceId)->first();
    }
    
}
