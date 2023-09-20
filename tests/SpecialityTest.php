<?php

use Laravel\Lumen\Testing\DatabaseMigrations;
use Laravel\Lumen\Testing\DatabaseTransactions;

class SpecialityTest extends TestCase
{
    use DatabaseMigrations;

    /**
     * @test
     */
    public function it_test_that_i_can_fetch_all_specialities()
    {
        $this->seedDatabase();

        $res = $this->authenticate()->makeGet('/api/specialities');

        $this->assertCount(84, $res);
    }


    /**
     * @test
     */
    public function it_test_that_i_can_fetch_a_speciaity_by_id()
    {
        $this->seedDatabase();

        $res = $this->authenticate()->makeGet('/api/specialities/1');

        $this->assertNotNull($res);
    }
}
