<?php

namespace App\Docs;

use OpenApi\Annotations as OA;

/**
 * @OA\Get(
 *     path="/api/doctors/{doctorId}",
 *     summary="Retrieve details by doctor",
 *     tags={"Doctors"},
 *     @OA\Response(
 *         response="200",
 *         description="successful operation",
 *         @OA\JsonContent(ref="#/components/schemas/Doctor")
 *     )
 * )
 *
 * @OA\Get(
 *     path="/api/doctors",
 *     summary="Retrieve all doctors",
 *     tags={"Doctors"},
 *     @OA\Parameter(
 *         name="hospitalId",
 *         in="path",
 *         required=false,
 *         @OA\Schema(
 *             type="integer",
 *             format="int64"
 *         )
 *     ),
 *     @OA\Parameter(
 *         name="stateId",
 *         in="path",
 *         required=false,
 *         @OA\Schema(
 *             type="integer",
 *             format="int64"
 *         )
 *     ),
 *     @OA\Parameter(
 *         name="specialityId",
 *         in="path",
 *         required=false,
 *         @OA\Schema(
 *             type="integer",
 *             format="int64"
 *         )
 *     ),
 *     @OA\Parameter(
 *         name="insurerId",
 *         in="path",
 *         required=false,
 *         @OA\Schema(
 *             type="integer",
 *             format="int64"
 *         )
 *     ),
 *     *     @OA\Response(
 *         response="200",
 *         description="successful operation",
 *         @OA\JsonContent(
 *             type="array",
 *             @OA\Items(ref="#/components/schemas/Doctor")
 *         ),
 *     )
 * )
 *
 * @OA\Post(
 *     path="/api/doctors/{doctorId}",
 *     summary="Update doctor",
 *     tags={"Doctors"},
 *     @OA\RequestBody(
 *         @OA\JsonContent(
 *                 @OA\Property(
 *                     property="name",
 *                     type="string",
 *                 ),
 *                 @OA\Property(
 *                     property="priceGeneralConsulting",
 *                     type="string",
 *                 ),
 *                 @OA\Property(
 *                     property="password",
 *                     type="string",
 *                 ),
 *                 @OA\Property(
 *                     property="password_confirmation",
 *                     type="string",
 *                 ),
 * @OA\Property(
 *                     property="academic_info",
 *                     type="string",
 *                 ),
 *                 @OA\Property(
 *                     property="other_academic_info",
 *                     type="string",
 *                 ),
 *                 @OA\Property(
 *                     property="professional_activities",
 *                     type="string",
 *                 ),
 *                 @OA\Property(
 *                     property="societies",
 *                     type="string",
 *                 ),
 *                 @OA\Property(
 *                     property="awards",
 *                     type="string",
 *                 ),
 *                 @OA\Property(
 *                     property="other_activities",
 *                     type="string",
 *                 ),
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
 * @OA\Post(
 *     path="/auth/register-doctor",
 *     summary="Register a new doctor",
 *     tags={"Doctors"},
 *     @OA\RequestBody(
 *         @OA\JsonContent(
 *                 @OA\Property(
 *                     property="name",
 *                     type="string",
 *                 ),
 *                 @OA\Property(
 *                     property="email",
 *                     type="string",
 *                 ),
 *                 @OA\Property(
 *                     property="password",
 *                     type="string",
 *                 ),
 *                 @OA\Property(
 *                     property="password_confirmation",
 *                     type="string",
 *                 ),
 *                 @OA\Property(
 *                     property="professional_license",
 *                     type="string",
 *                 ),
 *                 @OA\Property(
 *                     property="experience_summary",
 *                     type="string",
 *                 ),
 *                 @OA\Property(
 *                     property="academic_info",
 *                     type="string",
 *                 ),
 *                 @OA\Property(
 *                     property="other_academic_info",
 *                     type="string",
 *                 ),
 *                 @OA\Property(
 *                     property="professional_activities",
 *                     type="string",
 *                 ),
 *                 @OA\Property(
 *                     property="societies",
 *                     type="string",
 *                 ),
 *                 @OA\Property(
 *                     property="awards",
 *                     type="string",
 *                 ),
 *                 @OA\Property(
 *                     property="other_activities",
 *                     type="string",
 *                 ),
 *         )
 *     ),
 *     @OA\Response(
 *         response="200",
 *         description="successful operation",
 *         @OA\JsonContent(
 *              @OA\Property(
 *                     property="api_token",
 *                     type="string"
 *                 ),
 *              @OA\Property(
 *                     property="doctor_id",
 *                     type="integer"
 *                 ),
 *         ),
 *     )
 * )
 *
 *  * @OA\Post(
 *     path="/api/doctors/{doctorId}/photo",
 *     summary="Update photo of a doctor",
 *     tags={"Doctors"},
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
 *             type="array",
 *             @OA\Items(ref="#/components/schemas/Doctor")
 *         ),
 *     )
 * )
 *
 *  @OA\Post(
 *     path="/auth/login-doctor",
 *     summary="Login a doctor",
 *     tags={"Doctors"},
 *     @OA\RequestBody(
 *         @OA\JsonContent(
 *                 @OA\Property(
 *                     property="email",
 *                     type="string",
 *                 ),
 *                 @OA\Property(
 *                     property="password",
 *                     type="string",
 *                 ),
 *         )
 *     ),
 *     @OA\Response(
 *         response="200",
 *         description="successful operation",
 *         @OA\JsonContent(
 *              @OA\Property(
 *                     property="api_token",
 *                     type="string"
 *                 ),
 *              @OA\Property(
 *                     property="doctor_id",
 *                     type="integer"
 *                 ),
 *         ),
 *     )
 * )
 * @OA\Get(
 *     path="/api/doctors/{doctorId}/photos",
 *     summary="Retrieve all photo doctors",
 *     tags={"Doctors"},
 *     @OA\Response(
 *         response="200",
 *         description="successful operation",
 *         @OA\JsonContent(
 *             type="array",
 *             @OA\Items(ref="#/components/schemas/DoctorPhoto")
 *         ),
 *     )
 * )
 *  @OA\Post(
 *     path="/api/doctors/{doctorId}/photos",
 *     summary="Store a new photo",
 *     tags={"Doctors"},
 *     @OA\RequestBody(
 *         @OA\JsonContent(
 *                 @OA\Property(
 *                     property="photo",
 *                      type="string",
 *                     format="binary"
 *                 )
 *         )
 *     ),
 *     @OA\Response(
 *         response="200",
 *         description="successful operation",
 *         @OA\JsonContent(
 *             type="array",
 *             @OA\Items(ref="#/components/schemas/DoctorPhoto")
 *         ),
 *     )
 * )
 * @OA\Delete(
 *     path="/api/doctors/{doctorId}/photos/{photoId}",
 *     summary="Delete a photo",
 *     tags={"Doctors"},
 *     @OA\Response(
 *         response="200",
 *         description="successful operation",
 *         @OA\JsonContent(
 *             type="array",
 *             @OA\Items(ref="#/components/schemas/DoctorPhoto")
 *         ),
 *     )
 * )
 */
