<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;
/**
 * @OA\Schema(
 *  type="object",
 *  schema="DoctorPhoto",
 *  properties={
 *    @OA\Property(property="id", type="integer", description="The unique ID of this office"),
 *    @OA\Property(property="doctor_id", type="integer"),
 *    @OA\Property(property="url", type="string"),
 *  }
 * )
 */
class DoctorPhoto extends Model
{
    protected $fillable = ['name'];
    protected $appends = ['url'];

    public function getUrlAttribute()
    {
        return Storage::url('doctor-photos/'.$this->name);
    }

}
