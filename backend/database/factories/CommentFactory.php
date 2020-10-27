<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Comment;
use App\Post;
use App\User;
use Faker\Generator as Faker;

$factory->define(Comment::class, function (Faker $faker) {
    return [
        'text' => $faker->text(100),
        'user_id' => function() {
            return factory(User::class);
        },
        'post_id' => function() {
            return factory(Post::class);
        }
    ];
});
