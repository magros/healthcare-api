<?php

namespace App\Http\Controllers;

use App\Auth\FacebookProvider;
use App\Auth\GoogleProvider;
use App\Auth\ProviderInterface;
use App\Models\Doctor;
use App\User;
use Firebase\JWT\JWT;
use App\Models\Patient;
use App\Traits\ApiResponser;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use \Illuminate\Support\Str;
use Illuminate\Hashing\BcryptHasher;

class AuthController extends Controller
{
    use ApiResponser;

    /**
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\JsonResponse
     * @throws \Illuminate\Validation\ValidationException
     */
    public function authenticate(Request $request)
    {
        $this->validate($request, [
            'email' => 'required',
            'password' => 'required'
        ]);
        $user = User::where('email', $request->input('email'))->first();
        if ($user && Hash::check($request->input('password'), $user->password)) {
            $user->update(['api_token' => base64_encode(Str::random(40))]);
            $user->append('avatar_url');
            return $this->successResponse(['api_token' => $user->api_token, 'user' => $user, 'patient_id' => $user->patient->id]);
        }

        return $this->errorResponse('Invalid credentials', 401);
    }

    /**
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\JsonResponse
     * @throws \Illuminate\Validation\ValidationException
     */
    public function authenticateDoctor(Request $request)
    {
        $this->validate($request, [
            'email' => 'required',
            'password' => 'required'
        ]);
        $user = User::where('email', $request->input('email'))->first();

        if ($user && Hash::check($request->input('password'), $user->password)) {
            $user->update(['api_token' => base64_encode(Str::random(40))]);
            $user->append('avatar_url');
            return $this->successResponse(['api_token' => $user->api_token, 'user' => $user, 'doctor_id' => $user->doctor->id]);
        }

        return $this->errorResponse('Invalid credentials', 401);
    }

    /**
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     * @throws \Illuminate\Validation\ValidationException
     */
    public function register(Request $request)
    {
        $user = $this->registerUser($request);

        Patient::create(['user_id' => $user->id]);

        return $this->successResponse(['api_token' => $user->api_token, 'user' => $user, 'patient_id' => $user->patient->id]);
    }

    /**
     * @param Request $request
     * @param $provider
     * @return \Illuminate\Http\JsonResponse
     * @throws \Illuminate\Validation\ValidationException
     */
    public function authWithProvider(Request $request, $provider)
    {
        $this->validate($request, [
            'token' => 'required'
        ]);

        $provider = $this->retrieveProvider($provider, $request->get('token'));

        $user = $provider->login();

        $user->append('avatar_url');
        $user->update(['api_token' => base64_encode(Str::random(40))]);

        return $this->successResponse([
            'api_token' => $user->api_token,
            'user' => $user,
            'patient_id' => $user->patient->id
        ]);
    }

    /**
     * @param $provider
     * @param $token
     * @return ProviderInterface
     * @throws \Exception
     */
    private function retrieveProvider($provider, $token): ProviderInterface
    {
        switch ($provider) {
            case 'facebook':
                return new FacebookProvider($token);
            case 'google':
                return new GoogleProvider($token);
            default:
                throw new \Exception('Invalid provider: ' . $provider);
        }
    }

    /**
     * @param Request $request
     * @return mixed
     * @throws \Illuminate\Validation\ValidationException
     */
    private function registerUser(Request $request)
    {
        $this->validate($request, [
            'name' => 'required',
            'email' => 'required|unique:users',
            'password' => 'required|confirmed|min:6',
        ]);
        return User::create(array_merge([
            'name' => $request->get('name'),
            'email' => $request->get('email'),
            'password' => Hash::make($request->get('password'))
        ], ['api_token' => base64_encode(Str::random(40))]));
    }

    /**
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     * @throws \Illuminate\Validation\ValidationException
     */
    public function registerDoctor(Request $request)
    {
        $user = $this->registerUser($request);

        Doctor::create([
            'user_id' => $user->id,
            'professional_license' => $request->get('professional_license', ''),
            'experience_summary' => $request->get('experience_summary', ''),
            'academic_info' => $request->get('academic_info', ''),
            'other_academic_info' => $request->get('other_academic_info', ''),
            'professional_activities' => $request->get('professional_activities', ''),
            'societies' => $request->get('societies', ''),
            'awards' => $request->get('awards', ''),
            'other_activities' => $request->get('other_activities', '')
        ]);

        return $this->successResponse(['api_token' => $user->api_token, 'user' => $user, 'doctor_id' => $user->doctor->id]);
    }

    public function requestPasswordReset(Request $request)
    {
        $this->validate($request, ['email' => 'required|exists:users']);
        $email = $request->get('email');
        $token = encrypt(json_encode(['email' => $email]));

        Mail::send(
            (new \App\Mail\PasswordReset($token))
                ->from('notifications@healthmanager.com.mx')
                ->subject('Solicitud para restablecer contraseña')
                ->to($email)
        );

        return $this->successResponse(['token' => $token]);
    }


    public function passwordReset(Request $request)
    {
        $this->validate($request, ['token' => 'required', 'password' => 'required']);
        $email = json_decode(decrypt($request->get('token')))->email;
        $user = User::whereEmail($email)->first();
        $user->password = Hash::make($request->get('password'));
        $user->update();

        return $this->successResponse(['message' => 'Contraseña restablecida.']);
    }
}
