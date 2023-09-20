<?php

namespace App\Http\Controllers;

use App\Models\Office;
use Illuminate\Support\Str;
use App\Traits\ApiResponser;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class OfficePhotoController extends Controller
{
    use ApiResponser;

    public function index($officeId)
    {
        $office = Office::findOrFail($officeId);

        return $this->successResponse($office->photos);
    }

    public function store(Request $request, $officeId)
    {
        $office = Office::findOrFail($officeId);

        $this->validate($request, ['photo' => 'required|image']);
        $file = $request->photo;

        $fileName = "photo-{$office->id}-" . Str::random(8) . '.' . $file->getClientOriginalExtension();
        Storage::put('office-photos/' . $fileName, file_get_contents($file));
        $office->photos()->create(['name' => $fileName]);
        return $this->successResponse($office->photos);
    }

    public function destroy($officeId, $photoId)
    {
        $office = Office::findOrFail($officeId);
        if ($photo = $office->photos()->find($photoId)) {
            $photo->delete();
        }
        return $this->successResponse($office->photos);
    }
}
