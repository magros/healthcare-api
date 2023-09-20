<?php

namespace App\Http\Controllers;

use App\Models\Doctor;
use App\Models\Patient;
use App\Traits\ApiResponser;
use App\Transformers\DoctorTransformer;
use App\Transformers\PatientTransformer;
use App\User;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Hashing\BcryptHasher;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use Illuminate\Validation\ValidationException;
use OpenApi\Annotations as OA;
use App\Models\Billing;


class PatientController extends Controller
{
    use ApiResponser;

    private $transformer;
    private $doctorTransformer;

    /**
     * PatientController constructor.
     * @param PatientTransformer $transformer
     * @param DoctorTransformer $doctorTransformer
     */
    public function __construct(
        PatientTransformer $transformer,
        DoctorTransformer $doctorTransformer
    )
    {
        $this->transformer = $transformer;
        $this->doctorTransformer = $doctorTransformer;
    }

    /**
     * @return JsonResponse
     */
    public function index()
    {
        $patients = Patient::with('user')->get();

        $patients->each(function ($p) {
            $p->user->append('avatar_url');
        });

        return $this->successResponse($this->transformer->transformCollection($patients->toArray()));
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

        return $this->successResponse(['url' => $request->user()->avatar_url]);
    }

    public function updateProfile(Request $request)
    {
        $this->validate($request, ['name' => 'required']);

        $user = $request->user();
        $user->name = $request->get('name');
        if ($password = $request->get('password')) {
            $user->password = Hash::make($password);
        }
        $user->save();

        $patient = $user->patient;
        $patient->user->append('avatar_url');

        return $this->successResponse($this->transformer->transform($patient->toArray()));
    }

    public function updateInvoiceData(Request $request)
    {
        $this->validate($request, [
            'tax_id' => 'required',
            'business_name' => 'required',
            'address' => 'required',
            'postal_code' => 'required',
            'province' => 'required',
            'email' => 'required',
            'invoice_reason' => 'required',
            'payment_method' => 'required'
        ]);

        $user = $request->user();

        $user->billingData()->update($request->all());

        return $this->successResponse('Datos almacenados correctamente');
    }

    /**
     * @param Request $request
     * @return JsonResponse
     * @throws ValidationException
     */
    public function toggleDoctor(Request $request)
    {
        $this->validate($request, [
            'doctorId' => 'required|exists:doctors,id'
        ]);

        $patient = $request->user()->patient;

        $patient->favorites()->toggle($request->get('doctorId'));

        $doctors = $patient->favorites()->with(['medicalServices', 'user', 'specialities', 'offices', 'opinions.patient.user'])->get();

        $doctors->each(function ($doctor) {
            $doctor->user->append('avatar_url');
        });

        return $this->successResponse($this->doctorTransformer->transformCollection($doctors->toArray()));
    }


    /**
     * @param Request $request
     * @return JsonResponse
     */
    public function favoriteDoctors(Request $request)
    {
        $patient = $request->user()->patient;

        $doctors = $patient->favorites()->with(['medicalServices', 'user', 'specialities', 'offices', 'opinions.patient.user'])->get();

        $doctors->each(function ($doctor) {
            $doctor->user->append('avatar_url');
        });

        return $this->successResponse($this->doctorTransformer->transformCollection($doctors->toArray()));
    }


    public function show($patientId)
    {
        $patient = Patient::with('user')->find($patientId);

        $patient->user->append('avatar_url');

        return $this->successResponse($this->transformer->transform($patient->toArray()));
    }
}
