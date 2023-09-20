<?php

namespace App\Http\Controllers;

use App\Models\Speciality;
use App\Traits\ApiResponser;
use App\Transformers\SpecialityTransformer;
use Illuminate\Http\Request;

class SpecialityController extends Controller
{
    use ApiResponser;

    /**
     * @var SpecialityTransformer
     */
    private $specialityTransformer;

    public function __construct(SpecialityTransformer $specialityTransformer)
    {
        $this->specialityTransformer = $specialityTransformer;
    }

    public function index()
    {
        return $this->successResponse($this->specialityTransformer->transformCollection(Speciality::all()->toArray()));
    }

    public function show($specialityId)
    {
        $speciality = Speciality::findOrFail($specialityId);
        return $this->successResponse($this->specialityTransformer->transform($speciality));
    }
}
