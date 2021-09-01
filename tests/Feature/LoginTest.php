<?php

namespace Tests\Feature;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Http\Response;
use Tests\TestCase;

class LoginTest extends TestCase
{
    use RefreshDatabase;

    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function test_login()
    {
        $user = User::factory()->create();
        $this->json('POST', 'api/login', ['email' => $user->email, 'password' => 'password'])
            ->assertStatus(Response::HTTP_OK);
    }
}
