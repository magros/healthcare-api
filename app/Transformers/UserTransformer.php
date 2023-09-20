<?php

namespace App\Transformers;

use Carbon\Carbon;
use OpenApi\Annotations as OA;

/**
 * @OA\Schema(
 *  type="object",
 *  schema="User",
 *  properties={
 *    @OA\Property(property="id", type="integer", description="The unique ID of this user"),
 *    @OA\Property(property="email", type="string", description="The unique email of this user"),
 *    @OA\Property(property="name", type="string", description="The name of this user"),
 *    @OA\Property(property="avatar_url", type="string", description="The avatar photo of this user"),
 *  }
 * )
 */
class UserTransformer extends Transformer
{

    public function transform($user)
    {
        return [
            'id' => $user['id'],
            'email' => $user['id'],
            'name' => $user['name'],
            'avatar_url' => $user['avatar_url']
        ];
    }

}
