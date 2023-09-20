<?php

use Laravel\Lumen\Testing\DatabaseMigrations;
use Laravel\Lumen\Testing\DatabaseTransactions;

class PatientOpinionTest extends TestCase
{
    use DatabaseMigrations;

    /**
     * @test
     */
    public function it_test_that_a_patient_can_write_an_opinion_about_an_doctor()
    {
        $this->seedDatabase();
        $patient = $this->createPatient();
        $doctor = factory(\App\Models\Doctor::class)->create();

        $this->authenticate($patient->user)->makePost('/api/patients/'.$patient->id.'/opinions', [
            'doctor_id' => $doctor->id,
            'rate' => 4,
            'commentaries' => 'Está chido'
        ]);
        $opinion = $patient->opinions->first();

        $this->assertEquals('Está chido', $opinion->commentaries);
        $this->assertEquals(4, $opinion->rate);
        $this->assertEquals($doctor->id, $opinion->doctor_id);

    }
}
