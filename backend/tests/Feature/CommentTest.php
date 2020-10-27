<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use App\Comment;
use App\Post;
use App\User;

class CommentTest extends TestCase
{
    use RefreshDatabase;

    public function testCommentStore()
    {
        $comment = factory(Comment::class)->create();
        $user = User::find($comment->user_id);

        $response = $this->actingAs($user);

        $data = [
            'text' => $comment->text,
            'user_id' => $comment->user_id,
            'post_id' => $comment->post_id,
        ];
        $response->post('/comments/store', $data);
        $response->assertDatabaseHas('comments', $data);
    }

    // public function testCommentEdit()
    // {
    //     $comment = factory(Comment::class)->create();
    //     $user = User::find($comment->user_id);

    //     $response = $this->actingAs($user);

    //     $response = $this->get('comments/edit/'.$comment->id);

    //     $response->assertStatus(200)
    //         ->assertViewIs('comments.edit');
    // }

    public function testCommentUpdate()
    {

        $comment = factory(Comment::class)->create();
        $user = User::find($comment->user_id);

        $response = $this->actingAs($user);

        $data = [
            'text' => $comment->text,
            'user_id' => $comment->user_id,
            'post_id' => $comment->post_id,
        ];
        $response->post('comments/update', $data);
        $response->assertDatabaseHas('comments', $data);
    }

    public function testCommentDelete()
    {
        $comment = factory(Comment::class)->create();
        $user = User::find($comment->user_id);

        $response = $this->actingAs($user);

        $data = [
            'text' => $comment->text,
            'user_id' => $comment->user_id,
            'post_id' => $comment->post_id,
        ];
        Comment::where('id', $comment->id)->delete();
        $response->assertDatabaseMissing('comments', $data);
    }

}
