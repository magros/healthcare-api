<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It is a breeze. Simply tell Lumen the URIs it should respond to
| and give it the Closure to call when that URI is requested.
|
*/

$router->get('/', function () use ($router) {
    return '¿Qué estás buscando?';
});

$router->get('migrate', function () use ($router) {
    \Illuminate\Support\Facades\Artisan::call('migrate', ['--force' => true]);
    return \Illuminate\Support\Facades\Artisan::output();
});
$router->post('/auth/login', 'AuthController@authenticate'); #API doc omitted
$router->post('/auth/register', 'AuthController@register');
$router->post('/auth/register-doctor', 'AuthController@registerDoctor');
$router->post('/auth/login-doctor', 'AuthController@authenticateDoctor');
$router->post('/auth/request-password-reset', 'AuthController@requestPasswordReset');
$router->post('/auth/password-reset', 'AuthController@passwordReset');

$router->post('/auth/{provider}', 'AuthController@authWithProvider'); #API doc omitted

$router->group([/*'middleware' => 'auth:api', */ 'prefix' => 'api'], function () use ($router) {

    $router->group(['prefix' => 'patients'], function () use ($router) {
        $router->get('/', 'PatientController@index');
        $router->get('{patient}', 'PatientController@show');
        $router->post('{patient}/photo', 'PatientController@updatePhoto');

        $router->group(['middleware' => 'auth:api'], function () use ($router) {
            $router->get('/{patientId}/appointments', 'AppointmentController@show');
            $router->post('/{patientId}/appointments', 'AppointmentController@create');
            $router->put('/{patientId}/update-profile', 'PatientController@updateProfile');
            $router->put('/{patientId}/invoice-update', 'PatientController@updateInvoiceData'); #API doc omitted
            $router->post('/{patientId}/toggle-doctor', 'PatientController@toggleDoctor'); #API doc omitted
            $router->get('/{patientId}/favorite-doctors', 'PatientController@favoriteDoctors');
            $router->post('/{patientId}/opinions', 'PatientOpinionController@store'); #API doc omitted
            $router->get('/{patientId}/opinions/{doctorId}/has-opinions', 'PatientOpinionController@hasOpinions'); #API doc omitted
        });
    });

    $router->group(['prefix' => 'users'], function () use ($router) {
        $router->get('{user}/cards', 'UserCardController@index');
        $router->post('{user}/cards', 'UserCardController@store');
        $router->delete('{user}/cards/{cardId}', 'UserCardController@delete'); #API doc omitted
        $router->get('{user}/payments', 'UserPaymentController@index');
        $router->post('{user}/payments', 'UserPaymentController@store');
    });

    $router->group(['prefix' => 'doctors'], function () use ($router) {
        $router->get('/', 'DoctorController@index');
        $router->get('{doctor}', 'DoctorController@show');
        $router->post('{doctor}', 'DoctorController@update');
        $router->post('{doctor}/photo', 'DoctorController@updatePhoto');

        $router->get('{doctor}/photos', 'DoctorPhotoController@index');
        $router->post('{doctor}/photos', 'DoctorPhotoController@store');
        $router->delete('{doctor}/photos/{photoId}', 'DoctorPhotoController@destroy');

        $router->get('{doctor}/services', 'DoctorServiceController@index'); #API doc omitted
        $router->get('{doctor}/services/{service}', 'DoctorServiceController@show'); #API doc omitted

        $router->post('{doctor}/insurers', 'DoctorInsurerController@store'); #API doc omitted
        #TODO: write tests
        $router->get('{doctor}/insurers', 'DoctorInsurerController@index'); #API doc omitted
        $router->get('{doctor}/offices', 'DoctorInsurerController@index'); #API doc omitted
        #end TODO
//        $router->post('{doctor}/sufferings', 'DoctorSufferingController@store');
        $router->post('{doctor}/specialities', 'DoctorSpecialityController@store');
    });
    $router->group(['prefix' => 'specialities'], function () use ($router) {
        $router->get('/', 'SpecialityController@index');
        $router->get('{specialityId}', 'SpecialityController@show');
    });
    $router->group(['prefix' => 'insurers'], function () use ($router) {
        $router->get('/', 'InsurerController@index');
        $router->get('{insurerId}', 'InsurerController@show');
    });
    $router->group(['prefix' => 'states'], function () use ($router) {
        $router->get('/', 'StateController@index');
        $router->get('{stateId}', 'StateController@show');
    });
    $router->group(['prefix' => 'hospitals'], function () use ($router) {
        $router->get('/', 'HospitalController@index');
        $router->get('{hospitalId}', 'HospitalController@show');
    });
    $router->group(['prefix' => 'offices'], function () use ($router) {
        $router->get('/', 'OfficeController@search');
        $router->get('{officeId}/schedule', 'OfficeController@schedule');
        $router->get('{officeId}', 'OfficeController@show');
        $router->post('{officeId}/schedule', 'OfficeController@storeSchedule');
        $router->post('/', 'OfficeController@store');
        $router->get('{officeId}/photos', 'OfficePhotoController@index');
        $router->post('{officeId}/photos', 'OfficePhotoController@store');
        $router->delete('{officeId}/photos/{photoId}', 'OfficePhotoController@destroy');
    });
});
