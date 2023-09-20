<?php

namespace App\Transformers;

use Carbon\Carbon;
/**
 * @OA\Schema(
 *  type="object",
 *  schema="Opinion",
 *  properties={
 *    @OA\Property(property="id", type="integer", description="The unique ID of this opinion"),
 *    @OA\Property(property="commentaries", type="string", description="The commentaries of this opinion"),
 *    @OA\Property(property="rate", type="string", description="The rate of this opinion"),
 *    @OA\Property(property="commenter_name", type="string", description="The name of the user who comments"),
 *    @OA\Property(property="commenter_id", type="integer", description="The id of the user who comments"),
 *    @OA\Property(property="date", type="string", description="The date of the comment"),
 *  }
 * )
 */
class OpinionTransformer extends Transformer
{

    public function transform($comment)
    {
        return [
            'id' => $comment['id'],
            'commentaries' => $comment['commentaries'],
            'rate' => $comment['rate'],
            'commenter_name' => $comment['patient']['user']['name'],
            'commenter_id' => $comment['patient']['user']['id'],
            'date' => (new Carbon($comment['created_at']))->format('d/m/Y H:i')
        ];
    }
}
