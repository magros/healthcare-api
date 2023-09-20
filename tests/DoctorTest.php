<?php

use App\Models\Doctor;
use App\Models\Hospital;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Hash;
use Laravel\Lumen\Testing\DatabaseMigrations;
use Laravel\Lumen\Testing\DatabaseTransactions;

class DoctorTest extends TestCase
{
    use DatabaseMigrations;

    /**
     * @test
     */
    public function it_test_that_i_can_make_a_search_by_state()
    {
        $this->seedDatabase();

        factory(Doctor::class, 2)->create();

        $doctor = factory(Doctor::class)->create();

        $doctor->offices()->create(['state_id' => 1]);

        $data = $this->authenticate()->makeGet('/api/doctors', ['stateId' => 1]);

        $this->assertEquals(1, count($data));

        $this->assertEquals($doctor->professional_license, $data[0]->professional_license);
    }


    /**
     * @test
     */
    public function it_test_that_i_can_make_a_search_by_speciality()
    {
        $this->seedDatabase();

        $doctor = factory(Doctor::class)->create();

        $doctor->specialities()->attach(1);

        $data = $this->authenticate()->makeGet('/api/doctors', ['specialityId' => 1]);

        $this->assertEquals(1, count($data));

        $this->assertEquals($doctor->professional_license, $data[0]->professional_license);
    }

    /**
     * @test
     */
    public function it_test_that_i_can_make_a_search_by_insurer()
    {
        $this->seedDatabase();

        factory(Doctor::class, 2)->create();

        $doctor = factory(Doctor::class)->create();

        $doctor->insurers()->attach(1, ['cost' => 100]);

        $data = $this->authenticate()->makeGet('/api/doctors', ['insurerId' => 1]);

        $this->assertEquals(1, count($data));

        $this->assertEquals($doctor->professional_license, $data[0]->professional_license);
    }


    /**
     * @test
     */
    public function it_test_that_i_can_make_a_search_by_hospital()
    {
        $this->seedDatabase();

        factory(Doctor::class, 2)->create();

        $doctor = factory(Doctor::class)->create();

        $hospital = factory(Hospital::class)->create();

        $doctor->offices()->create(['hospital_id' => $hospital->id, 'state_id' => 1]);

        $data = $this->authenticate()->makeGet('/api/doctors', ['hospitalId' => $hospital->id]);

        $this->assertEquals(1, count($data));

        $this->assertEquals($doctor->professional_license, $data[0]->professional_license);
    }

    /**
     * @test
     */
    public function it_test_that_i_can_retrieve_a_doctor_details()
    {
        $this->seedDatabase();

        $doctor = factory(Doctor::class)->create();

        $patient = $this->createPatient();
        $doctor->medicalServices()->attach(1, ['cost' => 180, 'duration' => 30]);
        $doctor->opinions()->create(['patient_id' => $patient->id, 'commentaries' => 'Todo chido', 'rate' => 5]);

        $data = $this->authenticate($patient->user)->makeGet('/api/doctors/' . $doctor->id);

        $this->assertEquals($doctor->id, $data->id);
        $this->assertEquals($doctor->user->name, $data->name);
        $this->assertEquals($doctor->professional_license, $data->professional_license);
        $this->assertCount(1, $data->opinions);
    }

    /**
     * @test
     */
    public function it_test_that_i_can_update_a_doctor_details()
    {
        $this->seedDatabase();

        $doctor = factory(Doctor::class)->create();
        $doctor->medicalServices()->attach(1, ['cost' => 180, 'duration' => 30]);

        $data = $this->authenticate()->makePost('/api/doctors/' . $doctor->id, [
            'name' => 'Juan Pérez',
            'password' => 'chido',
            'password_confirmation' => 'chido',
            'priceGeneralConsulting' => 900.55,
            'awards' => 'Mérito a la medicina 2019'
        ]);

        $this->assertEquals($doctor->id, $data->id);
        $this->assertEquals('Juan Pérez', $data->name);
        $this->assertEquals('900.55', $data->priceGeneralConsulting);
        $this->assertEquals('Mérito a la medicina 2019', $data->awards);
    }

    /**
     * @test
     */
    public function it_test_that_an_doctor_can_be_attached_to_an_insurer()
    {
        $this->seedDatabase();
        $doctor = factory(Doctor::class)->create();

        $this->authenticate()->makePost('/api/doctors/' . $doctor->id . '/insurers', [
            'insurerId' => 1,
            'cost' => 800.0,
        ]);

        $insurer = $doctor->insurers->first();

        $this->assertEquals($insurer->id, 1);
        $this->assertEquals($insurer->pivot->cost, 800.0);
    }

    /**
     * @test
     */
    public function it_test_that_a_doctor_can_be_registered()
    {
        $this->seedDatabase();

        $doctor = $this->makePost('/auth/register-doctor', [
            'email' => 'foo@bar.biz',
            'name' => 'Elber Gonzalez',
            'password' => 'secret',
            'password_confirmation' => 'secret',
            'professional_license' => 'asdfklsdklslk',
            'experience_summary' => 'sksksksk',
            'awards' => 'Mérito a la medicina 2019'
        ]);

        $this->assertNotNull($doctor->api_token);
        $this->assertNotNull($doctor->doctor_id);

        $createdDoctor = Doctor::find($doctor->doctor_id);

        $this->assertNotNull($createdDoctor->awards);
    }

    /**
     * @test
     */
    public function it_test_that_an_doctor_can_login()
    {
        $doctor = factory(Doctor::class)->create();


        $data = $this->makePost('/auth/login-doctor', [
            'email' => $doctor->user->email,
            'password' => 'secret',
        ]);

        $this->assertEquals($data->user->email, $doctor->user->email);
        $this->assertEquals($data->user->name, $doctor->user->name);
        $this->assertNotNull($data->user->api_token);
    }

    /**
     * @test
     */
    public function it_test_that_a_doctor_can_update_his_avatar()
    {
        $doctor = factory(Doctor::class)->create();

        $res = $this->authenticate($doctor->user)->makePost("/api/doctors/{$doctor->id}/photo", [
            'avatar' => UploadedFile::fake()->image('avatar.jpg')
        ]);

        $this->assertContains('/storage/avatars/avatar-user-1', $res->avatar_url);
    }
}
