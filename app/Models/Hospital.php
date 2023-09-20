<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * @OA\Schema(
 *  type="object",
 *  schema="Hospital",
 *  properties={
 *    @OA\Property(property="id", type="integer", description="The unique ID of this hospital"),
 *    @OA\Property(property="name", type="string", description="The name of hospital"),
 *  }
 * )
 */
class Hospital extends Model
{
    //
}
