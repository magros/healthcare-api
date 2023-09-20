<?php

namespace App\Transformers;

use Carbon\Carbon;
/**
 * @OA\Schema(
 *  type="object",
 *  schema="MedicalService",
 *  properties={
 *    @OA\Property(property="id", type="integer", description="The unique ID of this office"),
 *    @OA\Property(property="name", type="string"),
 *  }
 * )
 */
class MedicalServiceTransformer extends Transformer
{

    public function transform($service)
    {
        return [
            'id' => $service['id'],
            'name' => $service['name'],
        ];
    }
}
