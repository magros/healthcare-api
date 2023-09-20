<?php

namespace App\Docs;

use OpenApi\Annotations as OA;

/**
 * @OA\Get(
 *     path="/api/insurers",
 *     summary="Lists all insurer companies",
 *     tags={"Catalogs"},
 *     @OA\Response(
 *         response="200",
 *         description="successful operation",
 *         @OA\JsonContent(
 *             type="array",
 *             @OA\Items(ref="#/components/schemas/Insurer")
 *         ),
 *     )
 * )
 *
 */

/**
 * @OA\Get(
 *     path="/api/insurers/{insurerId}",
 *     summary="Retrieve a insurer company by id",
 *     tags={"Catalogs"},
 *     @OA\Parameter(
 *         name="insurerId",
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
 *             @OA\Items(ref="#/components/schemas/Insurer")
 *         ),
 *     )
 * )
 *
 */

/** @OA\Post(
 *     path="/api/doctors/{doctorId}/insurers",
 *     summary="Attach an insurer to a doctor",
 *     tags={"Doctors"},
 * @OA\RequestBody(
 *         @OA\JsonContent(
 *                 @OA\Property(
 *                     property="insurerId",
 *                     type="integer",
 *                 ),
 *                 @OA\Property(
 *                     property="cost",
 *                     type="number",
 *                 )
 *         )
 *     ),
 *     @OA\Response(
 *         response="200",
 *         description="successful operation",
 *         @OA\JsonContent(
 *             type="array",
 *             @OA\Items(ref="#/components/schemas/Doctor")
 *         ),
 *     )
 * )
 */
