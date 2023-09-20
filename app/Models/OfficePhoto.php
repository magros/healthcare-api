<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;
/**
 * @OA\Schema(
 *  type="object",
 *  schema="OfficePhoto",
 *  properties={
 *    @OA\Property(property="id", type="integer", description="The unique ID of this office"),
 *    @OA\Property(property="office_id", type="integer"),
 *    @OA\Property(property="url", type="string"),
 *  }
 * )
 */
class OfficePhoto extends Model
{
    protected $fillable = ['name'];
    protected $appends = ['url'];

    public function getUrlAttribute()
    {
        return Storage::url('office-photos/'.$this->name);
    }
}
