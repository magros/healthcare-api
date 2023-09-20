<?php

use App\Models\Patient;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;
use Laravel\Lumen\Testing\DatabaseMigrations;
use Laravel\Lumen\Testing\DatabaseTransactions;

class PatientTest extends TestCase
{
    use DatabaseMigrations;

    /**
     * @test
     */
    public function it_test_that_i_can_fetch_all_patients()
    {
        factory(Patient::class, 5)->create();

        $data = $this->authenticate()->makeGet('api/patients');

        $this->assertEquals(6, count($data));
    }

     /**
      * @test
      */
     public function it_test_that_i_can_save_an_photo_profile()
     {
         $user = $this->createUser();

         $res = $this->authenticate($user)->makePost("/api/patients/{$user->patient->id}/photo", [
             'avatar' => UploadedFile::fake()->image('avatar.jpg')
         ]);

        $this->assertContains('/storage/avatars/avatar-user-1',$res->url);
    }

    /**
     * @test
     */
    public function it_test_that_i_can_create_or_update_the_billing_info()
    {
        $user = $this->createUser();

        $res = $this->authenticate($user)->makePut("/api/patients/{$user->patient->id}/invoice-update", [
            'tax_id' => 'CORJ',
            'business_name' => 'JUAN SA',
            'address' => 'direccion',
            'postal_code' => '76115',
            'province' => 'provincia',
            'email' => 'juan@juan.com',
            'invoice_reason' => 'Gastos en general',
            'payment_method' => 'Tarjeta'
        ]);

        $this->assertEquals('Datos almacenados correctamente', $res);
    }

    /**
     * @test
     */
    public function it_test_that_an_patient_can_mark_a_doctor_as_favorite()
    {
        $user = $this->createUser();
        factory(\App\Models\Doctor::class)->create();

        $doctor = factory(\App\Models\Doctor::class)->create();

        $res = $this->authenticate($user)->makePost("/api/patients/{$user->patient->id}/toggle-doctor", [
            'doctorId' => $doctor->id
        ]);

        $this->assertEquals(count($res), 1);
        $this->assertEquals($doctor->id, $res[0]->id);
    }

    /**
     * @test
     */
    public function it_test_that_i_can_retrieve_favorite_doctor()
    {
        $user = $this->createUser();
        $doctor = factory(\App\Models\Doctor::class)->create();

        $user->patient->favorites()->attach($doctor->id);

        $res = $this->authenticate($user)->makeGet("/api/patients/{$user->patient->id}/favorite-doctors");

        $this->assertEquals(count($res), 1);
        $this->assertEquals($doctor->id, $res[0]->id);
    }
}
