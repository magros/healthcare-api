<?php

namespace App\Transformers;

use Carbon\Carbon;

/**
 * @OA\Schema(
 *  type="object",
 *  schema="DoctorMedicalService",
 *  properties={
 *    @OA\Property(property="id", type="integer", description="The unique ID of this doctor"),
 *    @OA\Property(property="name", type="string", description="The name of this doctor"),
 *    @OA\Property(property="avatar_url", type="string", description="The avatar photo of this doctor"),
 *    @OA\Property(property="professional_license", type="string", description="The professional license of this doctor"),
 *    @OA\Property(property="specialities", type="array", @OA\Items(ref="#/components/schemas/Speciality") ),
 *    @OA\Property(property="offices", type="array", @OA\Items(ref="#/components/schemas/Office") ),
 *  }
 * )
 */
class DoctorMedicalServiceTransformer extends Transformer
{

    public function transform($service)
    {
        return [
            'id' => $service['id'],
            'name' => $service['name'],
            'doctorMedicalServiceId' => $service['pivot']['id'],
            'cost' => $service['pivot']['cost'],
            'duration' => $service['pivot']['duration'],
        ];
    }
}
