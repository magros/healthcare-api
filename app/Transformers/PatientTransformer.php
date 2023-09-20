<?php

namespace App\Transformers;

use Carbon\Carbon;
use OpenApi\Annotations as OA;

/**
 * @OA\Schema(
 *  type="object",
 *  schema="Patient",
 *  properties={
 *    @OA\Property(property="id", type="integer", description="The unique ID of this patient"),
 *    @OA\Property(property="user_id", type="integer", description="The unique user id associated"),
 *    @OA\Property(property="user", type="object", ref="#/components/schemas/User")
 *  }
 * )
 */
class PatientTransformer extends Transformer
{

    private $userTransformer;

    public function __construct(UserTransformer $userTransformer)
    {
        $this->userTransformer = $userTransformer;
    }

    public function transform($patient)
    {
        return [
            'id' => $patient['id'],
            'user_id' => $patient['user_id'],
            'user' => $this->userTransformer->transform($patient['user'])
        ];
    }

}
