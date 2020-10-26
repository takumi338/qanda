<?php

namespace Tests\Feature;

use App\Post;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class PostTest extends TestCase
{
    use RefreshDatabase;

    public function testIsLikedByNull()
    {
        $post = factory(Post::class)->create();

        $result = $post->is_liked_by_auth_user(null);

        $this->assertFalse($result);
    }
}
