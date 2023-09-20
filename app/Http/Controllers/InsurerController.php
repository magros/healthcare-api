<?php

namespace App\Http\Controllers;

use App\Models\Insurer;
use App\Traits\ApiResponser;
use Illuminate\Http\Request;

class InsurerController extends Controller
{
    use ApiResponser;

    public function index()
    {
        $insurers = Insurer::all();

        return $this->successResponse($insurers);
    }

    public function show($insurerId)
    {
        $insurer = Insurer::findOrFail($insurerId);
        return $this->successResponse($insurer);
    }
}
