<?php

namespace App\Transformers;

use OpenApi\Annotations as OA;
use Carbon\Carbon;

/**
 * @OA\Schema(
 *  type="object",
 *  schema="Doctor",
 *  properties={
 *    @OA\Property(property="id", type="integer", description="The unique ID of this doctor"),
 *    @OA\Property(property="name", type="string", description="The name of this doctor"),
 *    @OA\Property(property="avatar_url", type="string", description="The avatar photo of this doctor"),
 *    @OA\Property(property="professional_license", type="string", description="The professional license of this doctor"),
 *    @OA\Property(property="academic_info", type="string", description="The academic info of this doctor"),
 *    @OA\Property(property="other_academic_info", type="string", description="Other academic info of this doctor"),
 *    @OA\Property(property="professional_activities", type="string", description="The professional activities of this doctor"),
 *    @OA\Property(property="societies", type="string", description="The belong societies of this doctor"),
 *    @OA\Property(property="awards", type="string", description="The awards of this doctor"),
 *    @OA\Property(property="ohter_activities", type="string", description="Other activities of this doctor"),
 *    @OA\Property(property="specialities", type="array", @OA\Items(ref="#/components/schemas/Speciality") ),
 *    @OA\Property(property="offices", type="array", @OA\Items(ref="#/components/schemas/Office") ),
 *    @OA\Property(property="experience_summary", type="string"),
 *    @OA\Property(property="medical_services", type="array", @OA\Items(ref="#/components/schemas/DoctorMedicalService") ),
 *    @OA\Property(property="priceGeneralConsulting", type="string"),
 *    @OA\Property(property="opinions", type="array", @OA\Items(ref="#/components/schemas/Opinion") ),
 *    @OA\Property(property="rate", type="string"),
 *  }
 * )
 */
class DoctorTransformer extends Transformer
{

    private $specialityTransformer;
    private $officeTransformer;
    private $opinionTransformer;
    private $doctorMedicalServiceTransformer;

    public function __construct(
        SpecialityTransformer $specialityTransformer,
        OfficeTransformer $officeTransformer,
        OpinionTransformer $opinionTransformer,
        DoctorMedicalServiceTransformer $doctorMedicalServiceTransformer
    )
    {
        $this->specialityTransformer = $specialityTransformer;
        $this->officeTransformer = $officeTransformer;
        $this->opinionTransformer = $opinionTransformer;
        $this->doctorMedicalServiceTransformer = $doctorMedicalServiceTransformer;
    }

    public function transform($doctor)
    {
        $generalPrice = array_filter($doctor['medical_services'], function ($service) {
            return $service['id'] === 1;
        });
        $generalPrice = count($generalPrice) && isset($generalPrice[0]) ? $generalPrice[0] : null;

        return [
            'id' => $doctor['id'],
            'name' => $doctor['user']['name'],
            'avatar_url' => $doctor['user']['avatar_url'],
            'professional_license' => $doctor['professional_license'],
            'academic_info' => $doctor['academic_info'],
            'other_academic_info' => $doctor['other_academic_info'],
            'professional_activities' => $doctor['professional_activities'],
            'societies' => $doctor['societies'],
            'awards' => $doctor['awards'],
            'other_activities' => $doctor['other_activities'],
            'specialities' => $this->specialityTransformer->transformCollection($doctor['specialities']),
            'offices' => $this->officeTransformer->transformCollection($doctor['offices']),
            'experience_summary' => $doctor['experience_summary'],
            'medical_services' => $this->doctorMedicalServiceTransformer->transformCollection($doctor['medical_services']),
            'priceGeneralConsulting' => $generalPrice ? $generalPrice['pivot']['cost'] : 0,
            'opinions' => $this->opinionTransformer->transformCollection($doctor['opinions']),
            'rate' => $doctor['rate'],
//            'sufferings' => array_map(function ($suffering) {
//                return [
//                    'id' => $suffering['id'],
//                    'name' => $suffering['name'],
//                ];
//            }, $doctor['sufferings'])
        ];
    }
}
