<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;

class Office extends Model
{
    protected $fillable = [
        'state_id',
        'doctor_id',
        'description',
        'address',
        'postal_code',
        'suburb',
        'address_reference',
        'city',
        'contact_phone',
        'latitude',
        'longitude',
        'office_type',
        'hospital_id'
    ];
    protected $appends = ['avatar_url'];

    public function schedule()
    {
        return $this->hasMany(OfficeSchedule::class);
    }
    public function doctor()
    {
        return $this->belongsTo(Doctor::class);
    }

    public function state()
    {
        return $this->belongsTo(State::class);
    }

    public function appointments()
    {
        return $this->hasMany(Appointment::class);
    }

    public function scheduleByWeekDay($day)
    {
        $schedule = $this->schedule()->where('weekday', $day)->get();

        return $schedule;
    }

    public function getAvatarUrlAttribute()
    {
        $avatar = $this->avatar ? $this->avatar : 'default.jpg';

        return Storage::url('offices/' . $avatar);
    }

    public function photos()
    {
        return $this->hasMany(OfficePhoto::class);
    }
}
