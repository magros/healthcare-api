<?php

namespace App\Transformers;

use App\Models\Doctor;
use App\Models\DoctorMedicalService;
use Carbon\Carbon;
use OpenApi\Annotations as OA;

/**
 * @OA\Schema(
 *  type="object",
 *  schema="Appointment",
 *  properties={
 *    @OA\Property(property="id", type="integer", description="The unique ID of this office"),
 *    @OA\Property(property="office", type="object", ref="#/components/schemas/Office"),
 *    @OA\Property(property="hour", type="string", description="The hour in 24 format", example="17:30"),
 *    @OA\Property(property="date", type="string", description="The date in dd/mm/yyyy format", example="06/06/2006"),
 *    @OA\Property(property="doctor_medical_service_id", type="integer", description="The medical service associated to the doctor"),
 *    @OA\Property(property="created_at", type="string"),
 *    @OA\Property(property="cost", type="string"),
 *    @OA\Property(property="duration", type="string"),
 *    @OA\Property(property="medical_service", type="object", ref="#/components/schemas/MedicalService"),
 *  }
 * )
 */
class AppointmentTransformer extends Transformer
{
    private $officeTransformer;
    private $medicalServiceTransformer;

    /**
     * AppointmentTransformer constructor.
     * @param OfficeTransformer $officeTransformer
     * @param MedicalServiceTransformer $medicalServiceTransformer
     */
    public function __construct(OfficeTransformer $officeTransformer,
                                MedicalServiceTransformer $medicalServiceTransformer)
    {
        $this->officeTransformer = $officeTransformer;
        $this->medicalServiceTransformer = $medicalServiceTransformer;
    }

    public function transform($appointment)
    {
        $medicalService = DoctorMedicalService::find($appointment['doctor_medical_service_id'])->medicalService;

        return [
            'id' => $appointment['id'],
            'office' => $this->officeTransformer->transform($appointment['office']),
            'hour' => $appointment['hour'],
            'date' => $appointment['date'],
//            'timestamp' => $appointment['timestamp'],
            'doctor_medical_service_id' => $appointment['doctor_medical_service_id'],
            'created_at' => $appointment['created_at'],
            'cost' => $medicalService['cost'],
            'duration' => $medicalService['duration'],
            'medical_service' => $this->medicalServiceTransformer->transform($medicalService),
            'doctor' => $appointment['office']['doctor']
        ];
    }
}
