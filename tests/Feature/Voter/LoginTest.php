<?php

namespace Tests\Feature\Voter;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;
use Tests\UsesVoters;

class LoginTest extends TestCase
{
    use RefreshDatabase;
    use UsesVoters;

    public function testLoginPageReachable(): void
    {
        $response = $this->get(route('voter.index'));

        $response->assertOk();
    }

    public function testLoginFailWithInvalidToken(): void
    {
        $token = 'someInvalidToken';

        $response = $this->post(route('voter.login'), [
            'token' => $token,
        ]);

        $response
            ->assertSessionHasErrors()
            ->assertRedirect(route('voter.login'));
    }

    public function testLoginSuccessWithValidToken(): void
    {
        $voter = $this->voter();

        $response = $this->post(route('voter.login'), [
            'token' => $voter->token,
        ]);

        $response
            ->assertSessionHasNoErrors()
            ->assertRedirect(route('proposition.index'));
    }
}
