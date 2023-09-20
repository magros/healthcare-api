<?php

namespace App\Transformers;

use Carbon\Carbon;
/**
 * @OA\Schema(
 *  type="object",
 *  schema="Speciality",
 *  properties={
 *    @OA\Property(property="id", type="integer", description="The unique ID of this speciality"),
 *    @OA\Property(property="description", type="string", description="The description of this speciality"),
 *  }
 * )
 */
class SpecialityTransformer extends Transformer
{

    public function transform($speciality)
    {
        return [
            'id' => $speciality['id'],
            'description' => $speciality['description']
        ];
    }
}
