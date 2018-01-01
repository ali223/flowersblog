<?php

use App\Comment;
use App\Post;
use App\Role;
use App\User;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $member = factory(Role::class)->create();
        $admin = factory(Role::class)->states('admin')->create();

        factory(User::class, 5)->create()->each(function ($user) use ($member) {
            $user->roles()->save($member);

        	$post = factory(Post::class)->make();
        	$user->posts()->save($post);

        	$comment = factory(Comment::class)->make();
			$post->comments()->save($comment);
        });
    }
}
