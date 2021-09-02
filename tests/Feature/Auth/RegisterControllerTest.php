<?php

namespace Tests\Feature\Auth;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Http\Response;
use Tests\TestCase;

class RegisterControllerTest extends TestCase
{
    use RefreshDatabase;

    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function test_register_validation_errors()
    {
        $user = User::factory()->make();
        $this->json('POST', 'api/register', ['email' => $user->email, 'password' => 'password'])
            ->assertStatus(Response::HTTP_UNPROCESSABLE_ENTITY)
            ->assertJson([
                'message' => "The given data was invalid.",
            ]);
    }

    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function test_register()
    {
        $user = User::factory()->make();
        $this->json('POST', 'api/register', [
            'name' => $user->name,
            'email' => $user->email,
            'password' => $user->password
        ])
            ->assertStatus(Response::HTTP_OK)
            ->assertJson([
                'success' => true
            ]);
    }
}
