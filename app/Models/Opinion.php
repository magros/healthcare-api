<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Opinion extends Model
{
    protected $fillable = ['doctor_id', 'patient_id', 'rate', 'commentaries'];

    public function patient()
    {
        return $this->belongsTo(Patient::class);
    }

}
