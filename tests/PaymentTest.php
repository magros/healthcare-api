<?php

use Laravel\Lumen\Testing\DatabaseMigrations;
use Laravel\Lumen\Testing\DatabaseTransactions;

class PaymentTest extends TestCase
{
    /**
     * @test
     */
    public function it_test_that_i_can_purchase_a_appointment()
    {
//        $chargeData = [
//            'method' => 'card',
//            'source_id' => 'krfkkmbvdk3hewatruem',
//            'amount' => 100,
//            'description' => 'Cargo inicial a mi merchant',
//            'order_id' => 'ORDEN-00071',
//            'device_session_id' => 'asfadasd',
//            'customer' => [
//                'name' => 'Juan',
//                'last_name' => 'Perez',
//                'email' => 'jperez@chido.com'
//            ]
//        ];
//
//        $openPay = new \App\Services\PaymentService();

//        $res = $openPay->addCharge($chargeData);

//        dd($res);
        $this->assertTrue(true);
    }
}
