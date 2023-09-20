<?php

namespace App\Docs;

use OpenApi\Annotations as OA;

/**
 * @OA\Get(
 *     path="/api/patients",
 *     summary="Lists all patients",
 *     tags={"Patients"},
 *     @OA\Response(
 *         response="200",
 *         description="successful operation",
 *         @OA\JsonContent(
 *             type="array",
 *             @OA\Items(ref="#/components/schemas/Patient")
 *         ),
 *     )
 * )
 * @OA\Get(
 *     path="/api/patients/{patientId}",
 *     summary="Show a given patient",
 *     tags={"Patients"},
 *     @OA\Response(
 *         response="200",
 *         description="successful operation",
 *         @OA\JsonContent(
 *             type="object",
 *             ref="#/components/schemas/Patient"
 *         ),
 *     )
 * )
 * @OA\Get(
 *     path="/api/patients/{patientId}/appointments",
 *     summary="Lists all appointments of a given patient",
 *     tags={"Patients"},
 *     @OA\Response(
 *         response="200",
 *         description="successful operation",
 *         @OA\JsonContent(
 *             type="array",
 *             @OA\Items(ref="#/components/schemas/Appointment")
 *         ),
 *     )
 * )
 * @OA\Post(
 *     path="/api/patients/{patiendId}/photo",
 *     summary="Update photo of a patient",
 *     tags={"Patients"},
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
 *             @OA\Items(ref="#/components/schemas/Patient")
 *         ),
 *     )
 * )
 * @OA\Post(
 *     path="/api/patients/{patiendId}/appointments",
 *     summary="Add a new appointment to a given patient",
 *     tags={"Patients"},
 *     @OA\RequestBody(
 *         @OA\JsonContent(
 *                 @OA\Property(
 *                     property="hour",
 *                     type="string",
 *                     example="12:20"
 *                 ),
 *                 @OA\Property(
 *                     property="date",
 *                     type="string",
 *                     example="12/12/2019"
 *                 ),
 *                 @OA\Property(
 *                     property="doctor_medical_service_id",
 *                     type="string",
 *                     example="1"
 *                 )
 *         )
 *     ),
 *     @OA\Response(
 *         response="200",
 *         description="successful operation",
 *         @OA\JsonContent(
 *             type="array",
 *             @OA\Items(ref="#/components/schemas/Appointment")
 *         ),
 *     )
 * )
 * @OA\Put(
 *     path="/api/patients/{patiendId}/update-profile",
 *     summary="Update a candidate profile",
 *     tags={"Patients"},
 *     @OA\RequestBody(
 *         @OA\JsonContent(
 *                 @OA\Property(
 *                     property="name",
 *                     type="string",
 *                     example="Juan Pérez"
 *                 ),
 *                 @OA\Property(
 *                     property="password",
 *                     type="string",
 *                     example="123456"
 *                 )
 *         )
 *     ),
 *     @OA\Response(
 *         response="200",
 *         description="successful operation",
 *         @OA\JsonContent(
 *             type="array",
 *             @OA\Items(ref="#/components/schemas/Patient")
 *         ),
 *     )
 * )
 * @OA\Get(
 *     path="/api/patients/{patientId}/favorite-doctors",
 *     summary="Show favorite doctor for a given patient",
 *     tags={"Patients"},
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
 *
 * @OA\Post(
 *     path="/auth/register",
 *     summary="Register a new patient",
 *     tags={"Patients"},
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
 *                 )
 *         )
 *     ),
 *     @OA\Response(
 *         response="200",
 *         description="successful operation",
 *         @OA\JsonContent(
 *              @OA\Items(ref="#/components/schemas/Patient")
 *         ),
 *     )
 * )
 */
