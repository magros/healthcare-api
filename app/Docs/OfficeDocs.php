<?php

namespace App\Docs;

use OpenApi\Annotations as OA;

/**
 * @OA\Get(
 *     path="/api/offices/",
 *     summary="Lists all offices",
 *     tags={"Offices"},
 *     @OA\Response(
 *         response="200",
 *         description="successful operation",
 *         @OA\JsonContent(
 *             type="array",
 *             @OA\Items(ref="#/components/schemas/Office")
 *         ),
 *     )
 * )
 *
 */

/**
 * @OA\Get(
 *     path="/api/offices/{officeId}/schedule",
 *     summary="Fetch specific office schedule",
 *     tags={"Offices"},
 *     @OA\Parameter(
 *         name="doctorMedicalServiceId",
 *         in="query",
 *         required=true,
 *         @OA\Schema(
 *             type="integer",
 *             format="int64"
 *         )
 *     ),
 *     @OA\Parameter(
 *         name="date",
 *         in="query",
 *         required=true,
 *         @OA\Schema(
 *             type="string"
 *         )
 *     ),
 *     @OA\Response(
 *         response="200",
 *         description="successful operation",
 *         @OA\JsonContent(
 *             type="array",
 *             @OA\Items(ref="#/components/schemas/OfficeSchedule")
 *         ),
 *     )
 * )
 *
 */

/**  @OA\Post(
 *     path="/api/offices/",
 *     summary="Creates a new office",
 *     tags={"Offices"},
 *     @OA\RequestBody(
 *        request="Office",
 *        required=true,
 *       @OA\JsonContent(ref="#/components/schemas/OfficeRequest")
 *     ),
 *     @OA\MediaType(
 *         mediaType="application/json",
 *         @OA\Schema(ref="#/components/schemas/OfficeRequest")
 *     ),  
 *     @OA\Response(
 *         response="200",
 *         description="successful operation",
 *         @OA\JsonContent(
 *             type="array",
 *             @OA\Items(ref="#/components/schemas/Office")
 *         ),
 *     )
 * )
 */

/**  @OA\Post(
 *     path="/api/offices/{officeId}/schedule/",
 *     summary="Creates a new office schedule",
 *     tags={"Offices"},
 *   @OA\Parameter(
 *         name="officeId",
 *         in="path",
 *         required=true,
 *         @OA\Schema(
 *             type="integer"
 *         )
 *     ),
 *     @OA\RequestBody(
 *        request="Office",
 *        required=true,
 *       @OA\JsonContent(ref="#/components/schemas/OfficeScheduleRequest")
 *     ),
 *     @OA\MediaType(
 *         mediaType="application/json",
 *         @OA\Schema(ref="#/components/schemas/OfficeScheduleRequest")
 *     ),  
 *     @OA\Response(
 *         response="200",
 *         description="successful operation",
 *         @OA\JsonContent(
 *              @OA\Property(property="message", type="string", description="Success message")
 *         ),
 *     )
 * )
 */

/** @OA\Get(
 *     path="/api/offices/{officeId}/photos",
 *     summary="Retrieve all office's photos",
 *     tags={"Offices"},
 *     @OA\Response(
 *         response="200",
 *         description="successful operation",
 *         @OA\JsonContent(
 *             type="array",
 *             @OA\Items(ref="#/components/schemas/OfficePhoto")
 *         ),
 *     )
 * )
 */

/** @OA\Post(
 *     path="/api/offices/{officeId}/photo",
 *     summary="Upload an office's photo",
 *     tags={"Offices"},
 *     @OA\RequestBody(
 *         @OA\JsonContent(
 *                 @OA\Property(
 *                     property="avatar",
 *                     type="string",
 *                     format="binary"
 *                 )
 *         )
 *     ),
 *     @OA\Response(
 *         response="200",
 *         description="successful operation",
 *         @OA\JsonContent(
 *            type="array",
 *            @OA\Items(ref="#/components/schemas/OfficePhoto")
 *         ),
 *     )
 * )
 */

/** @OA\Delete(
 *     path="/api/offices/{officeId}/photos/{photoId}",
 *     summary="Delete an office's photo",
 *     tags={"Offices"},
 *     @OA\Response(
 *         response="200",
 *         description="successful operation",
 *         @OA\JsonContent(
 *             type="array",
 *            @OA\Items(ref="#/components/schemas/OfficePhoto")
 *         ),
 *     )
 * )
 */
