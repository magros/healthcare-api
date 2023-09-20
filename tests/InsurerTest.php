<?php

use App\Models\Patient;
use Laravel\Lumen\Testing\DatabaseMigrations;
use Laravel\Lumen\Testing\DatabaseTransactions;

class InsurerTest extends TestCase
{
    use DatabaseMigrations;

    /**
     * @test
     */
    public function it_test_that_i_can_fetch_all_insurers()
    {
        $this->seedDatabase();

        $data = $this->authenticate()->makeGet('api/insurers');

        $this->assertEquals(19, count($data));
    }

    /**
     * @test
     */
    public function it_test_that_i_can_fetch_an_insurer_by_id()
    {
        $this->seedDatabase();

        $data = $this->authenticate()->makeGet('api/insurers/1');

        $this->assertEquals("Zurich", $data->name);
    }
}
