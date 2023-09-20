<?php

use App\Models\Doctor;
use App\Models\Office;
use Laravel\Lumen\Testing\DatabaseMigrations;
use Laravel\Lumen\Testing\DatabaseTransactions;

class OfficeTest extends TestCase
{
    use DatabaseMigrations;

    /**
     * @test
     */
    public function it_test_that_an_i_can_search_offices_from_a_given_region()
    {
        $this->seedDatabase();
        $patient = $this->createPatient();

        factory(\App\Models\Office::class, 3)->create();

        $data = $this->authenticate($patient->user)->makeGet('/api/offices');

        $this->assertCount(3, $data);
    }

    /**
     * @test
     */
    public function it_test_that_an_i_can_create_a_new_office()
    {
        $this->seedDatabase();
        $doctor = factory(Doctor::class)->create();

        $office = $this->makePost('/api/offices', [
            'stateId' => 1,
            'doctorId' => $doctor->id,
            'description' => 'Brief desc',
            'address' => 'Address 123',
            'postalCode' => '123456',
            'suburb' => 'Alamos',
            'addressReference' => 'Edificio azul',
            'city' => 'Queretaro',
            'contactPhone' => '4424342844',
            'latitude' => '-100.4324',
            'longitude' => '-100.3234',
            'officeType' => 'MATRIX',
            'hospitalId' => 1
        ]);

        $this->assertNotNull($office->id);
        $this->assertNotNull($office->city);
    }

    /**
     * @test
     */
    public function it_test_that_an_i_can_create_a_new_office_schedule()
    {
        $this->seedDatabase();
        $office = factory(Office::class)->create();

        $response = $this->makePost("/api/offices/{$office->id}/schedule", [
            'weekDay' => 1,
            'startHour' => '08:00',
            'endHour' => '15:00'
        ]);

        $this->assertNotNull($response);
        $this->assertEquals($response, 'Schedule stored');
    }
}
