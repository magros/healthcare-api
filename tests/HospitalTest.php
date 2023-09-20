<?php

use Laravel\Lumen\Testing\DatabaseMigrations;
use Laravel\Lumen\Testing\DatabaseTransactions;

class HospitalTest extends TestCase
{
    use DatabaseMigrations;

    /**
     * @test
     */
    public function it_test_that_i_can_fetch_all_hospitals()
    {
        $this->seedDatabase();

        $data = $this->authenticate()->makeGet('api/hospitals');

        $this->assertEquals(2, count($data));
    }

    /**
     * @test
     */
    public function it_test_that_i_can_fetch_a_hospital_by_id()
    {
        $this->seedDatabase();

        $data = $this->authenticate()->makeGet('api/hospitals/1');

        $this->assertEquals("STAR MEDICA", $data->name);
    }
}
