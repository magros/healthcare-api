<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * @OA\Schema(
 *  type="object",
 *  schema="Insurer",
 *  properties={
 *    @OA\Property(property="id", type="integer", description="The unique ID of this insurer"),
 *    @OA\Property(property="name", type="string", description="The company name"),
 *    @OA\Property(property="status", type="string", description="The company name"),
 *  }
 * )
 */
class Insurer extends Model
{
    //
}
