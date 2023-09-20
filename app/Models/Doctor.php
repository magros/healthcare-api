<?php

namespace App\Models;

use App\Filters\Filter;
use Illuminate\Database\Eloquent\Model;

class Doctor extends Model
{
    protected $appends = ['rate'];
    protected $fillable = [
        'status',
        'user_id',
        'professional_license',
        'experience_summary',
        'academic_info',
        'other_academic_info',
        'professional_activities',
        'societies',
        'awards',
        'other_activities',
    ];

    public function scopeFilter($query, Filter $filter)
    {
        return $filter->apply($query);
    }

    public function specialities()
    {
        return $this->belongsToMany(Speciality::class);
    }

    public function offices()
    {
        return $this->hasMany(Office::class, 'doctor_id', 'id');
    }

    public function insurers()
    {
        return $this->belongsToMany(Insurer::class)->withPivot('doctor_id', 'insurer_id', 'cost');
    }

    public function user()
    {
        return $this->belongsTo(\App\User::class);
    }

    public function medicalServices()
    {
        return $this->belongsToMany(MedicalService::class)->withPivot('id', 'medical_service_id', 'cost', 'duration', 'doctor_id');
    }

    public function opinions()
    {
        return $this->hasMany(Opinion::class);
    }

    public function getRateAttribute()
    {
        return $this->opinions->count() > 0 ? $this->opinions->sum('rate') / $this->opinions->count() : 0;
    }

    public function photos()
    {
        return $this->hasMany(DoctorPhoto::class);
    }

    public function sufferings()
    {
        return $this->hasMany(Suffering::class);
    }
}
