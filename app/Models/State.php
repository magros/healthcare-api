<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * @OA\Schema(
 *  type="object",
 *  schema="State",
 *  properties={
 *    @OA\Property(property="id", type="integer", description="The state ID"),
 *    @OA\Property(property="name", type="string", description="The state name"),
 *    @OA\Property(property="status", type="code", description="The state code"),
 *  }
 * )
 */
class State extends Model
{
    //
}
