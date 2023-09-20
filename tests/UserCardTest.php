<?php

use Laravel\Lumen\Testing\DatabaseMigrations;
use Laravel\Lumen\Testing\DatabaseTransactions;

class UserCardTest extends TestCase
{
    use DatabaseMigrations;

    /**
     * @test
     */
    public function it_test_that_i_can_attach_a_new_card_to_an_user()
    {
        $user = $this->createUser();

        $res = $this->authenticate($user)->makePost('/api/users/' . $user->id . '/cards', [
            'number' => '0123456789',
            'expire_month' => '12',
            'expire_year' => '20',
            'cvv' => '123',
            'type' => 'MASTERCARD'
        ]);

        $this->assertEquals($user->id, $res->user_id);
        $this->assertEquals('6789', $res->number);
        $this->assertEquals('12', $res->expire_month);
        $this->assertEquals('20', $res->expire_year);
        $this->assertEquals('MASTERCARD', $res->type);
    }


    /**
     * @test
     */
    public function it_test_that_i_can_fetch_cards_from_a_given_user()
    {
        $user = $this->createUser();

        $user->cards()->create([
            'number' => '78921354',
            'expire_month' => '12',
            'expire_year' => '22',
            'cvv' => '134',
            'type' => 'MASTERCARD'
        ]);

        $res = $this->authenticate($user)->makeGet('/api/users/' . $user->id . '/cards');

        $this->assertEquals($user->id, $res[0]->user_id);
        $this->assertEquals('1354', $res[0]->number);
        $this->assertEquals('12', $res[0]->expire_month);
        $this->assertEquals('22', $res[0]->expire_year);
    }

    /**
     * @test
     */
    public function it_test_that_i_can_make_soft_delete_from_a_card()
    {
        $user = $this->createUser();

        $card = $user->cards()->create([
            'number' => '78921354',
            'expire_month' => '12',
            'expire_year' => '22',
            'cvv' => '134',
            'type' => 'MASTERCARD'
        ]);

        $res = $this->authenticate($user)->makeDelete('/api/users/' . $user->id . '/cards/' . $card->id);

        $this->assertEquals('Card deleted', $res);

        $this->assertNull($user->cards->first());
        $this->assertNotNull($user->cards()->withTrashed()->first());
    }
}
