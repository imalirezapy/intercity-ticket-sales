<?php

namespace Tests\Feature\Services\Auth;

use App\Data\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\ResponseStructure;
use Tests\TestCase;

class RegisterFeatureTest extends TestCase
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

    public function testResponseUnprocessableIfEmailAlreadyExists()
    {
        $response = $this->postJson('api/v1/register', [
            'email' => $this->user->email,
            'password' => $this->userPassword,
        ]);

        $response->assertUnprocessable();
    }

    public function testSuccessfulRegisterUser()
    {
        $response = $this->postJson('api/v1/register', [
            'email' => 'newUser@gmail.com',
            'password' => $this->userPassword,
        ]);

        $response->assertOk()
            ->assertJsonStructure($this->responseStructure)
            ->assertJsonStructure([
                'data' => [
                    'user',
                    'token'
                ]
            ])
            ->assertJson([
                'data' => [
                    'user' => [
                        'email' => 'newUser@gmail.com',
                    ]
                ]
            ]);
    }
}
