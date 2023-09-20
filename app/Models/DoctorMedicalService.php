<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class DoctorMedicalService extends Model
{
    protected $table = 'doctor_medical_service';

    public function medicalService()
    {
        return $this->belongsTo(MedicalService::class);
    }
}
