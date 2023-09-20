<?php

namespace App\Docs;

use OpenApi\Annotations as OA;

/**
 * @OA\Get(
 *     path="/api/specialities",
 *     summary="Lists all specialities",
 *     tags={"Catalogs"},
 *     @OA\Response(
 *         response="200",
 *         description="successful operation",
 *         @OA\JsonContent(
 *             type="array",
 *             @OA\Items(ref="#/components/schemas/Speciality")
 *         ),
 *     )
 * )
 *
 */

/**
 * @OA\Get(
 *     path="/api/specialities/{specialityId}",
 *     summary="Retrieve a speciality by id",
 *     tags={"Catalogs"},
 *     @OA\Parameter(
 *         name="specialityId",
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
 *             @OA\Items(ref="#/components/schemas/Speciality")
 *         ),
 *     )
 * )
 *
 */
