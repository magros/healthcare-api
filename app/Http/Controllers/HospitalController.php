<?php

namespace App\Http\Controllers;

use App\Models\Hospital;
use App\Traits\ApiResponser;
use Illuminate\Http\Request;

class HospitalController extends Controller
{
    use ApiResponser;

    public function index()
    {
        return $this->successResponse(Hospital::all());
    }

    public function show($hospitalId)
    {
        $hospital = Hospital::findOrFail($hospitalId);
        return $this->successResponse($hospital);
    }
}
