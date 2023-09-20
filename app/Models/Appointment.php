<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

use OpenApi\Annotations as OA;

class Appointment extends Model
{
    protected $fillable = ['office_id', 'hour', 'date', 'patient_id', 'doctor_medical_service_id'];

    public function office()
    {
        return $this->belongsTo(Office::class);
    }

    public function medicalService()
    {
        return $this->hasOneThrough(MedicalService::class, Doctor::class);
    }
}
