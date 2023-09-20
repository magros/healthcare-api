<?php

namespace App\Transformers;

use Carbon\Carbon;

/**
 * @OA\Schema(
 *  type="object",
 *  schema="Payment",
 *  properties={
 *    @OA\Property(property="id", type="integer", description="The unique ID of this payment"),
 *    @OA\Property(property="user_id", type="integer"),
 *    @OA\Property(property="amount", type="string"),
 *    @OA\Property(property="concept", type="string"),
 *  }
 * )
 */
class PaymentTransformer extends Transformer
{

    public function transform($card)
    {
        return [
            'id' => $card['id'],
            'user_id' => $card['user_id'],
            'amount' => $card['amount'],
            'concept' => $card['concept'],
        ];
    }
}
