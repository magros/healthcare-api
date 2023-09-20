<?php

use Laravel\Lumen\Testing\DatabaseMigrations;
use Laravel\Lumen\Testing\DatabaseTransactions;

class StateTest extends TestCase
{
    use DatabaseMigrations;
    /**
     * @test
     */
    public function it_test_that_i_can_fetch_all_states()
    {
        $this->seedDatabase();

        $data = $this->authenticate()->makeGet('api/states');

        $this->assertEquals(33, count($data));
    }

    /**
     * @test
     */
    public function it_test_that_i_can_fetch_a_state_by_id()
    {
        $this->seedDatabase();

        $data = $this->authenticate()->makeGet('api/states/1');

        $this->assertNotNull($data);
        $this->assertEquals('Distrito Federal', $data->name);
    }
}
