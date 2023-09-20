<?php

namespace App\Http\Controllers;

use App\Filters\DoctorFilter;
use App\Models\Doctor;
use App\Traits\ApiResponser;
use App\Transformers\DoctorTransformer;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use Illuminate\Validation\ValidationException;
use OpenApi\Annotations as OA;

/**
 * @OA\Info(title="Health Manager API", version="1.0")
 */
class DoctorController extends Controller
{
    use ApiResponser;

    private $doctorTransformer;

    public function __construct(DoctorTransformer $doctorTransformer)
    {
        $this->doctorTransformer = $doctorTransformer;
    }

    public function show($id)
    {
        $doctor = Doctor::findOrFail($id);

        $doctor->load('offices.state', 'specialities', 'user', 'medicalServices', 'opinions.patient.user');

        return $this->successResponse($this->doctorTransformer->transform($doctor->toArray()));
    }

    public function index(Request $request)
    {
        $params = $request->all();

        $doctors = Doctor::filter(new DoctorFilter($params))->with('offices.state', 'specialities', 'user', 'medicalServices', 'opinions.patient.user')->get();

        return $this->successResponse($this->doctorTransformer->transformCollection($doctors->toArray()));
    }

    public function update(Request $request, $id)
    {
        $this->validate($request, [
            'name' => 'required',
            'priceGeneralConsulting' => 'required',
            'password' => 'confirmed'
        ]);
        $doctor = Doctor::findOrFail($id);

        if ($password = $request->get('password')) {
            $doctor->user->password = Hash::make($password);
        }
        $doctor->user->name = $request->get('name');

        $doctor->academic_info = $request->get('academic_info', '');
        $doctor->other_academic_info = $request->get('other_academic_info', '');
        $doctor->professional_activities = $request->get('professional_activities', '');
        $doctor->societies = $request->get('societies', '');
        $doctor->awards = $request->get('awards', '');
        $doctor->other_activities = $request->get('other_activities', '');

        $doctor->user->update();

        $doctor->medicalServices()->syncWithoutDetaching([1 => [
            'cost' => $request->get('priceGeneralConsulting'),
            'duration' => 60
        ]]);

        $doctor->load('offices.state', 'specialities', 'user', 'medicalServices', 'opinions.patient.user');

        $doctor->user->append('avatar_url');

        return $this->successResponse($this->doctorTransformer->transform($doctor->toArray()));
    }

    /**
     * @param Request $request
     * @return JsonResponse
     * @throws ValidationException
     */
    public function updatePhoto(Request $request)
    {
        $this->validate($request, ['avatar' => 'required|image']);
        $user = $request->user();
        $file = $request->avatar;

        $fileName = "avatar-user-{$request->user()->id}-" . Str::random(8) . '.' . $file->getClientOriginalExtension();
        Storage::put('avatars/' . $fileName, file_get_contents($file));
        $user->avatar = $fileName;
        $user->save();

        $doctor = $user->doctor;
        $doctor->load('offices.state', 'specialities', 'user', 'medicalServices', 'opinions.patient.user');

        return $this->successResponse($this->doctorTransformer->transform($doctor->toArray()));
    }

    public function attachSpecialities(Doctor $doctor, Request $request)
    {

        $specs = $request->specialities;
        $doctor->specialities()->attach();
    }
}
