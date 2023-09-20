<?php

namespace App\Docs;

use OpenApi\Annotations as OA;

/**
 * @OA\Get(
 *     path="/api/hospitals",
 *     summary="Lists all hospitals",
 *     tags={"Catalogs"},
 *     @OA\Response(
 *         response="200",
 *         description="successful operation",
 *         @OA\JsonContent(
 *             type="array",
 *             @OA\Items(ref="#/components/schemas/Hospital")
 *         ),
 *     )
 * )
 *
 */

/**
 * @OA\Get(
 *     path="/api/hospitals/{hospitalId}",
 *     summary="Retrieve an hospital by id",
 *     tags={"Catalogs"},
 *     @OA\Parameter(
 *         name="hospitalId",
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
 *             @OA\Items(ref="#/components/schemas/Hospital")
 *         ),
 *     )
 * )
 *
 */
