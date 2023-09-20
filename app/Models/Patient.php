<?php

namespace App\Models;

use App\User;
use Illuminate\Database\Eloquent\Model;
class Patient extends Model
{
    public $timestamps = false;
    protected $fillable = ['status', 'user_id'];

    public function appointments()
    {
        return $this->hasMany(Appointment::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function favorites()
    {
        return $this->belongsToMany(Doctor::class, 'favorites');
    }

    public function opinions()
    {
        return $this->hasMany(Opinion::class);
    }
}
