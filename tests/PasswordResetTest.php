<?php

use App\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use Laravel\Lumen\Testing\DatabaseMigrations;
use Laravel\Lumen\Testing\DatabaseTransactions;

class PasswordResetTest extends TestCase
{
    use DatabaseMigrations;

    /**
     * @test
     */
    public function it_test_that_i_can_request_password_reset()
    {
        Mail::fake();

        $user = factory(User::class)->create();

        $res = $this->makePost('/auth/request-password-reset', ['email' => $user->email]);

        Mail::assertSent(\App\Mail\PasswordReset::class, function ($mail) use ($res, $user) {
            return $mail->token === $res->token && $mail->hasTo($user->email);
        });
    }

    /**
     * @test
     */
    public function it_test_tha_i_can_chance_a_password()
    {
        $user = factory(User::class)->create();
        $token = encrypt(json_encode(['email' => $user->email]));

        $this->makePost('/auth/password-reset', ['token' => $token, 'password' => 'secret']);

        $this->assertTrue(Hash::check('secret', User::find($user->id)->password));
    }
}
