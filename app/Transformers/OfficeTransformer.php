<?php

namespace App\Transformers;

use Carbon\Carbon;

class OfficeTransformer extends Transformer
{
    private $specialityTransformer;

    public function __construct(SpecialityTransformer $specialityTransformer)
    {
        $this->specialityTransformer = $specialityTransformer;
    }

    public function transform($office)
    {
        return [
            'id' => $office['id'],
            'longitude' => $office['longitude'],
            'latitude' => $office['latitude'],
            'description' => $office['description'],
            'address' => $office['address'],
            'postal_code' => $office['postal_code'],
            'suburb' => $office['suburb'],
            'city' => $office['city'],
            'avatar_url' => $office['avatar_url'],
            'doctor_id' => $office['doctor_id'],
            'state' => isset($office['state']) ? $office['state']['name'] : null,
        ];
    }
}
