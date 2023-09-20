<?php

use Laravel\Lumen\Testing\DatabaseMigrations;
use Laravel\Lumen\Testing\DatabaseTransactions;

class UserPaymentTest extends TestCase
{
    use DatabaseMigrations;

    /**
     * @test
     *
     */
    public function it_test_that_i_can_create_a_new_payment()
    {
        $user = $this->createUser();

        $amount = 2.50;
        $concept = 'Unos petes del puchi';

        $res = $this->authenticate($user)->makePost(
            '/api/users/' . $user->id . '/payments',
            compact('amount', 'concept')
        );

        $this->assertEquals($amount, $res->amount);
        $this->assertEquals($concept, $res->concept);

    }


    /**
     * @test
     *
     */
    public function it_test_that_i_can_fetch_payments_from_an_user()
    {
        $user = $this->createUser();

        $amount = 2.50;
        $concept = 'Unos petes del puchi';

        $user->payments()->create(compact('amount', 'concept'));

        $res = $this->authenticate($user)->makeGet('/api/users/' . $user->id . '/payments');

        $this->assertEquals($amount, $res[0]->amount);
        $this->assertEquals($concept, $res[0]->concept);

    }
}
