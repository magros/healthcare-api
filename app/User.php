<?php

namespace App;

use App\Models\Billing;
use App\Models\Card;
use App\Models\Doctor;
use App\Models\Patient;
use App\Models\Payment;
use Illuminate\Auth\Authenticatable;
use Illuminate\Support\Facades\Storage;
use Laravel\Lumen\Auth\Authorizable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Contracts\Auth\Authenticatable as AuthenticatableContract;
use Illuminate\Contracts\Auth\Access\Authorizable as AuthorizableContract;

class User extends Model implements AuthenticatableContract, AuthorizableContract
{
    use Authenticatable, Authorizable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'api_token'
    ];

    /**
     * The attributes excluded from the model's JSON form.
     *
     * @var array
     */
    protected $hidden = [
        'password',
    ];

    protected $appends = ['avatar_url'];

    public function roles()
    {
        return $this->belongsToMany(Role::class);
    }

    public function inRole($role)
    {
        return $this->roles()->where('slug', $role)->count();
    }

    public function patient()
    {
        return $this->hasOne(Patient::class);
    }

    public function doctor()
    {
        return $this->hasOne(Doctor::class);
    }

    public function getAvatarUrlAttribute()
    {
        $avatar = $this->avatar ? $this->avatar : 'default.jpeg';

        return Storage::url('avatars/' . $avatar);
    }

    public function billingData()
    {
        return $this->hasOne(Billing::class);
    }

    public function cards()
    {
        return $this->hasMany(Card::class);
    }

    public function payments()
    {
        return $this->hasMany(Payment::class);
    }
}
