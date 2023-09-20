<?php

namespace App\Filters;

use Illuminate\Database\Eloquent\Builder;

class DoctorFilter extends Filter
{
    protected $filters = ['stateId', 'specialityId', 'insurerId', 'hospitalId'];

    public function __construct($filters)
    {
        parent::__construct($filters);
    }

    protected function stateId($stateId)
    {
        if (!$stateId) return $this->builder;

        return $this->builder->whereHas('offices', function (Builder $builder) use ($stateId) {
            $builder->where('state_id', $stateId);
        });
    }

    protected function specialityId($specialityId)
    {
        if (!$specialityId) return $this->builder;

        return $this->builder->whereHas('specialities', function (Builder $builder) use ($specialityId) {
            $builder->where('speciality_id', $specialityId);
        });
    }

    protected function insurerId($insurerId)
    {
        if (!$insurerId) return $this->builder;

        return $this->builder->whereHas('insurers', function (Builder $builder) use ($insurerId) {
            $builder->where('insurer_id', $insurerId);
        });
    }

    protected function hospitalId($hospitalId)
    {
        if (!$hospitalId) return $this->builder;

        return $this->builder->whereHas('offices', function (Builder $builder) use ($hospitalId) {
            $builder->where('hospital_id', $hospitalId);
        });
    }
}
