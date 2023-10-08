<?php

namespace Tests\Feature\Services\Auth;

use App\Data\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\ResponseStructure;
use Tests\TestCase;

class LoginFeatureTest extends TestCase
{
    use RefreshDatabase,
        ResponseStructure;

    private User $user;
    private string $userPassword = 'password';

    private function setUser(): void
    {
        $this->user = User::factory()->createOne([
            'email' => 'test@gmail.com',
            'password' => $this->userPassword,
        ]);
    }

    protected function setUp(): void
    {
        parent::setUp();
        $this->setUser();
    }

    public function testSuccessfulLoginUser(): void
    {

        $response = $this->postJson('api/v1/login', [
            'email' => $this->user->email,
            'password' => $this->userPassword,
        ]);


        $response->assertOk()
            ->assertJsonStructure($this->responseStructure)
            ->assertJsonStructure([
                'data' => [ 'token' ]
            ]);
    }

    public function testResponseUnprocessableIfPasswordWasWrong(): void
    {
        $response = $this->postJson('api/v1/login', [
            'email' => $this->user->email,
            'password' => 'wrong-password',
        ]);

        $response->assertUnprocessable()
            ->assertJsonFragment([
                'is_successful' => false,
            ]);
    }

}
