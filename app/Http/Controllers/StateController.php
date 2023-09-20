<?php

namespace App\Http\Controllers;

use App\Models\State;
use App\Traits\ApiResponser;
use Illuminate\Http\Request;

class StateController extends Controller
{
    use ApiResponser;

    public function index()
    {
        return $this->successResponse(State::all());
    }

    public function show($stateId)
    {
        $state = State::findOrFail($stateId);
        return $this->successResponse($state);
    }
}
