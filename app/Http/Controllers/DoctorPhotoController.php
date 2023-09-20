<?php

namespace App\Http\Controllers;

use App\Models\Doctor;
use App\Traits\ApiResponser;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class DoctorPhotoController extends Controller
{
    use ApiResponser;

    public function index($doctorId)
    {
        $doctor = Doctor::findOrFail($doctorId);

        return $this->successResponse($doctor->photos);
    }

    public function store(Request $request, $doctorId)
    {
        $doctor = Doctor::findOrFail($doctorId);

        $this->validate($request, ['photo' => 'required|image']);
        $file = $request->photo;

        $fileName = "photo-{$doctor->id}-" . Str::random(8) . '.' . $file->getClientOriginalExtension();
        Storage::put('doctor-photos/' . $fileName, file_get_contents($file));
        $doctor->photos()->create(['name' => $fileName]);
        return $this->successResponse($doctor->photos);
    }

    public function destroy($doctorId, $photoId)
    {
        $doctor = Doctor::findOrFail($doctorId);
        if ($photo = $doctor->photos()->find($photoId)) {
            $photo->delete();
        }
        return $this->successResponse($doctor->photos);
    }
}
