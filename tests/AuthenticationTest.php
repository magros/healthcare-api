<?php

use Laravel\Lumen\Testing\DatabaseMigrations;
use Laravel\Lumen\Testing\DatabaseTransactions;

class AuthenticationTest extends TestCase
{
    use DatabaseMigrations;

    /**
     * @test
     */
    public function it_test_than_an_user_can_be_registered()
    {
        $data = $this->makePost('/auth/register', [
            'email' => 'test@test.com',
            'name' => 'Marco',
            'password' => 123456,
            'password_confirmation' => 123456
        ]);

        $this->assertEquals($data->user->email, 'test@test.com');
        $this->assertEquals($data->user->name, 'Marco');
    }


    /**
     * @test
     */
    public function it_test_that_an_user_can_login()
    {
        $user = $this->createUser();

        $data = $this->makePost('/auth/login', [
            'email' => $user->email,
            'password' => 'secret',
        ]);

        $this->assertEquals($data->user->email, $user->email);
        $this->assertEquals($data->user->name, $user->name);
        $this->assertNotNull($data->user->api_token);
    }

//    TODO: make mockery of callbacks
//    /**
//     * @test
//     */
//    public function it_test_that_i_can_login_using_facebook()
//    {
//        $data = $this->makePost('/auth/facebook', [
//           'token' => 'EAAiCZBVwXGskBAJEZC5TV22ItpPeQCoZCLWwceIaM06amnIQvyIclfnVZBqPnxLiP73fZByJ2ZB0kD3jZANIKh5frUZADiIjUnA0ZBCaerxakLfhXuoIPiGpiPGsrJXskZCzwcJlGV7ac9tQmIuS3h03umPa3OOjupEmLGA4mvUZAW8QgZDZD'
//        ]);
//
//        $this->assertEquals($data->user->email, 'iron-rocks@hotmail.com');
//    }
//
//    /**
//     * @test
//    */
//    public function it_test_that_i_can_login_using_google()
//    {
//        $data = $this->makePost('/auth/google', [
//            'token' => 'ya29.GltcB0_xVnlbJM-wqo1cDba35vTHrsBe1G9xhD3SOwJq_900_RGSi64HIq2UB2qYa0Mc7Q1urJsUAdiMmS9oKcaEDYzAqNHkL7_9qLCQv9AJuD6kmhXKCDOsUZKi'
//        ]);
//
//        $this->assertEquals($data->user->email, 'marco@empleosti.com.mx');
//    }
}
