<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use App\User;

class UserTest extends TestCase
{
    use RefreshDatabase;

    public function testDisplayUsers() 
    {   
        $user = factory(User::class)->create();

        $response = $this->actingAs($user);

        $response = $response->get('/users/{id}');

        $response->assertSeeText($user->name);
    }

    public function testEditUsers() 
    {   
        $user = factory(User::class)->create();

        $response = $this->actingAs($user);

        $response = $response->get('/users/edit'.$user->id);

        $response->assertSeeText($user->name);
    }

    public function testUpdateUser()
    {
        $user = factory(User::class)->create();

        $response = $this->actingAs($user);

        $data = [
            'name' => $user->name,
            'email' => $user->email,
            'password' => $user->password,
        ];

        $response->post('/users/edit'.$user->id,$data);
        $response->assertDatabaseHas('users', $data);
    }

    public function testDeleteUser()
    {
        $user = factory(User::class)->create();

        $response = $this->actingAs($user);

        $data = [
            'name' => $user->name,
            'email' => $user->email,
            'password' => $user->password,
        ];
        User::where('id', $user->id)->delete();
        $response->assertDatabaseMissing('users', [
            'id' => $user->id,
        ]);
    }

}
