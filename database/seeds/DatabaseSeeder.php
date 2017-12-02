<?php

use Illuminate\Database\Seeder;
use App\User;
use App\Post;
use App\Comment;

class DatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        factory(User::class, 5)->create()->each(function ($user) {
        	$post = factory(Post::class)->make();
        	$user->posts()->save($post);

        	$comment = factory(Comment::class)->make();
			$post->comments()->save($comment);
        });
    }
}
