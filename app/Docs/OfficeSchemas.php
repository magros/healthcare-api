<?php

namespace App\Docs;

use OpenApi\Annotations as OA;

/**
 * @OA\Schema(
 *  type="object",
 *  schema="Office",
 *  properties={
 *    @OA\Property(property="id", type="integer", description="The unique ID of this office"),
 *    @OA\Property(property="longitude", type="string"),
 *    @OA\Property(property="latitude", type="string"),
 *    @OA\Property(property="description", type="string"),
 *    @OA\Property(property="address", type="string"),
 *    @OA\Property(property="postal_code", type="string"),
 *    @OA\Property(property="suburb", type="string"),
 *    @OA\Property(property="city", type="string"),
 *    @OA\Property(property="doctor_id", type="integer"),
 *    @OA\Property(property="state", type="integer"),
 *  }
 * )
 */

/**
 * @OA\Schema(
 *  type="object",
 *  schema="OfficeSchedule",
 *  properties={
 *    @OA\Property(property="date", type="string", description="The date for this schedule"),
 *    @OA\Property(property="day", type="integer", description="The day for the schedule"),
 *    @OA\Property(property="weekday", type="string", description="The weekday for the schedule"),
 *    @OA\Property(property="month", type="string", description="The month for the schedule"),
 *    @OA\Property(
 *          property="schedule", 
 *          type="array", 
 *          description="The avatar photo of this doctor",
 *          @OA\Items(
 *              @OA\Property(property="hour", type="string", description="The schedule specific hour"),
 *              @OA\Property(property="status", type="string", description="The availability status for the schedule"),
 *              @OA\Property(property="init", type="string", description="The init hour for the schedule"),
 *              @OA\Property(property="end", type="string", description="The end hour for the schedule")          
 *          )
 *    ),
 *  }
 * )
 */

/**
 * @OA\Schema(
 *  type="object",
 *  schema="OfficeRequest",
 *  properties={
 *    @OA\Property(property="stateId", type="integer", description="The state ID for the office"), 
 *    @OA\Property(property="doctorId", type="integer", description="The owner doctor ID"),
 *    @OA\Property(property="description", type="string", description="Brief description of the office"),
 *    @OA\Property(property="address", type="string", description="Office's address with street and number"),
 *    @OA\Property(property="postalCode", type="string", description="Office's postal code"),
 *    @OA\Property(property="suburb", type="string", description="Office's suburb"),
 *    @OA\Property(property="addressReference", type="string", description="Office's address reference, e.g. 'Entre calles A y B'"),
 *    @OA\Property(property="city", type="string", description="Office's city"),
 *    @OA\Property(property="contactPhone", type="string", description="Office's contact phone"),
 *    @OA\Property(property="latitude", type="string", description="Office's location latitude"),
 *    @OA\Property(property="longitude", type="string", description="Office's location longitude"),
 *    @OA\Property(property="officeType", type="string", description="Office type, can be MATRIX or BRANCH"),
 *    @OA\Property(property="hospitalId", type="integer", description="If the office is placed in hospital")
 *   }
 * )
 */

 /**
 * @OA\Schema(
 *  type="object",
 *  schema="OfficeScheduleRequest",
 *  properties={
 *    @OA\Property(property="weekDay", type="integer", description="Schedule's weekday"), 
 *    @OA\Property(property="startHour", type="string", description="Schedule's start hour"),
 *    @OA\Property(property="endHour", type="string", description="Schedule's end hour")
 *   }
 * )
 */