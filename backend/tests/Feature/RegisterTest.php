<?php

namespace Tests\Feature;

use App\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class RegisterTest extends TestCase
{
    use RefreshDatabase;

    public function testRegister()
    {
        $user = factory(User::class)->create();

        $response = [
            'name' => $user->name,
            'email' => $user->email,
            'password' =>  $user->password,
            'password_confirmation' =>  $user->password,
        ];

        $this->assertDatabaseHas('users', [
            'email' => $user->email,
        ]);

        $response->assertStatus(200);
    }
}
