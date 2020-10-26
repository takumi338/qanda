<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Post;
use App\User;
use Faker\Generator as Faker;

$factory->define(Post::class, function (Faker $faker) {
    return [
        'title' => $faker->text(50),
        'content' => $faker->text(500),
        'user_id' => function() {
            return factory(User::class);
        }
    ];
});
