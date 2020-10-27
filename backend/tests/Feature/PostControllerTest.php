<?php

namespace Tests\Feature;

use App\User;
use App\Post;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class PostControllerTest extends TestCase
{
    use RefreshDatabase;

    public function testIndex()
    {
        $response = $this->get(route('posts.index'));

        $response->assertStatus(200)
            ->assertViewIs('posts.index');
    }

    public function testShow()
    {
        $posts = factory(Post::class)->create();
        $post = Post::find($posts->id);
        $response = $this->get(route('posts.show',$post));

        $response->assertStatus(200)
            ->assertViewIs('posts.show');
    }

    // public function testGuestCreate()
    // {
    //     $response = $this->get(route('posts.create'));

    //     $response->assertRedirect(route('login'));
    // }  
    
    public function testPostCreate()
    {
        $user = factory(User::class)->create();

        $response = $this->actingAs($user)
            ->get(route('posts.create'));

        $response->assertStatus(200)
            ->assertViewIs('posts.create');
    }

    public function testPostStore()
    {
        $user = factory(User::class)->create();
        $post = factory(Post::class)->create();
        // $user = User::find($post->id);

        $response = $this->actingAs($user);

        $data = [
            'title' => $post->title,
            'content' => $post->content,
            'user_id' => $post->user_id,
        ];
        $response->post('/posts',$data);
        $response->assertDatabaseHas('posts', $data);
    }

    // public function testPostEdit()
    // {
    //     $posts = factory(Post::class)->create();
    //     $post = Post::find($posts->id);
    //     $response = $this->get(route('posts.edit'));

    //     $response->assertStatus(200)
    //         ->assertViewIs('posts.edit');
    // }

    public function testPostUpdate()
    {

        $post = factory(Post::class)->create();
        $user = User::find($post->user_id);

        $response = $this->actingAs($user);

        $data = [
            'title' => $post->title,
            'content' => $post->content,
            'user_id' => $post->user_id,
        ];
        $response->post('posts/'.$post->id,$data);
        $response->assertDatabaseHas('posts', $data);
    }

    public function testPostDelete()
    {

        $post = factory(Post::class)->create();
        $user = User::find($post->user_id);

        $response = $this->actingAs($user);

        $data = [
            'title' => $post->title,
            'content' => $post->content,
            'user_id' => $post->user_id,
        ];
        Post::where('id', $post->id)->delete();
        $response->assertDatabaseMissing('posts', [
            'id' => $post->id,
        ]);
        
    }

    
}
