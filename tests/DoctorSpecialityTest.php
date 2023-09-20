<?php

use App\Models\Doctor;
use Laravel\Lumen\Testing\DatabaseMigrations;
use Laravel\Lumen\Testing\DatabaseTransactions;

class DoctorSpecialityTest extends TestCase
{
    use DatabaseMigrations;

    /**
     * @test
     */
    public function it_test_that_i_can_attach_multiple_specialities_for_an_existing_doctor()
    {
        $this->seedDatabase();
        $doctor = factory(Doctor::class)->create();

        $data = $this->authenticate()->makePost("/api/doctors/{$doctor->id}/specialities", [
            'specialities_ids' => '1,2,3,4',
        ]);

        $this->assertEquals(1, $data->specialities[0]->id);
        $this->assertEquals(2, $data->specialities[1]->id);
        $this->assertEquals(3, $data->specialities[2]->id);
        $this->assertEquals(4, $data->specialities[3]->id);
    }
}
