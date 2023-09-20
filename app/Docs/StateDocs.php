<?php

namespace App\Docs;

use OpenApi\Annotations as OA;

/**
 * @OA\Get(
 *     path="/api/states",
 *     summary="Lists all states",
 *     tags={"Catalogs"},
 *     @OA\Response(
 *         response="200",
 *         description="successful operation",
 *         @OA\JsonContent(
 *             type="array",
 *             @OA\Items(ref="#/components/schemas/State")
 *         ),
 *     )
 * )
 *
 */

/**
 * @OA\Get(
 *     path="/api/states/{stateId}",
 *     summary="Retrieve a state by id",
 *     tags={"Catalogs"},
 *     @OA\Parameter(
 *         name="stateId",
 *         in="path",
 *         required=true,
 *         @OA\Schema(
 *             type="integer"
 *         )
 *     ),
 *     @OA\Response(
 *         response="200",
 *         description="successful operation",
 *         @OA\JsonContent(
 *             type="array",
 *             @OA\Items(ref="#/components/schemas/State")
 *         ),
 *     )
 * )
 *
 */
