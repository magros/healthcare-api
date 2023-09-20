<?php

namespace App\Transformers;
use OpenApi\Annotations as OA;
use Carbon\Carbon;

/**
 * @OA\Schema(
 *  type="object",
 *  schema="Card",
 *  properties={
 *    @OA\Property(property="id", type="integer", description="The unique ID of this card"),
 *    @OA\Property(property="user_id", type="integer"),
 *    @OA\Property(property="number", type="string", description="The last 4 digits of card", example="1234"),
 *    @OA\Property(property="expire_month", type="string", example="06"),
 *    @OA\Property(property="expire_year", type="string", example="19"),
 *    @OA\Property(property="type", type="string",description="Could be: VISA,MASTERCARD,AMERICAN_EXPRESS,OTHER", example="MASTERCARD"),
 *  }
 * )
 */
class CardTransformer extends Transformer
{
    public function transform($card)
    {
        return [
            'id' => $card['id'],
            'user_id' => $card['user_id'],
            'number' => substr($card['number'], -4),
            'expire_month' => $card['expire_month'],
            'expire_year' => $card['expire_year'],
            'type' => $card['type'],
        ];
    }
}
