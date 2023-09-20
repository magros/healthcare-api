<?php

namespace App\Docs;

use OpenApi\Annotations as OA;

/**
 * @OA\Get(
 *     path="/api/users/{userId}/cards",
 *     summary="Show credit cards for a given user",
 *     tags={"Users"},
 *     @OA\Response(
 *         response="200",
 *         description="successful operation",
 *         @OA\JsonContent(
 *             type="array",
 *             @OA\Items(ref="#/components/schemas/Card")
 *         ),
 *     )
 * )
 *
 * @OA\Post(
 *     path="/api/users/{userId}/cards",
 *     summary="Add a new card to a given user",
 *     tags={"Users"},
 *     @OA\RequestBody(
 *         @OA\JsonContent(
 *                 @OA\Property(
 *                     property="number",
 *                     type="string",
 *                     example="132456789"
 *                 ),
 *                 @OA\Property(
 *                     property="expire_month",
 *                     type="string",
 *                     example="19"
 *                 ),
 *                 @OA\Property(
 *                     property="expire_year",
 *                     type="string",
 *                     example="19"
 *                 ),
 *                 @OA\Property(
 *                     property="type",
 *                     type="string",
 *                     example="MASTERCARD",
 *                     description="Valid values: VISA,MASTERCARD,AMERICAN_EXPRESS,OTHER"
 *                 ),
 *                 @OA\Property(
 *                     property="cvv",
 *                     type="string",
 *                     example="123"
 *                 )
 *         )
 *     ),
 *     @OA\Response(
 *         response="200",
 *         description="successful operation",
 *         @OA\JsonContent(
 *             type="array",
 *             @OA\Items(ref="#/components/schemas/Card")
 *         ),
 *     )
 * )
 * @OA\Get(
 *     path="/api/users/{userId}/payments",
 *     summary="Show payments for a given user",
 *     tags={"Users"},
 *     @OA\Response(
 *         response="200",
 *         description="successful operation",
 *         @OA\JsonContent(
 *             type="array",
 *             @OA\Items(ref="#/components/schemas/Payment")
 *         ),
 *     )
 * )
 * @OA\Post(
 *     path="/api/users/{userId}/payments",
 *     summary="Add a new payment to a given user",
 *     tags={"Users"},
 *     @OA\RequestBody(
 *         @OA\JsonContent(
 *                 @OA\Property(
 *                     property="amount",
 *                     type="string"
 *                 ),
 *                 @OA\Property(
 *                     property="concept",
 *                     type="string",
 *                 ),
 *         )
 *     ),
 *     @OA\Response(
 *         response="200",
 *         description="successful operation",
 *         @OA\JsonContent(
 *             type="array",
 *             @OA\Items(ref="#/components/schemas/Payment")
 *         ),
 *     )
 * )
 */
