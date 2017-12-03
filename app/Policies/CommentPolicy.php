<?php

namespace App\Policies;

use App\User;
use App\Comment;
use App\Post;
use Illuminate\Auth\Access\HandlesAuthorization;

class CommentPolicy
{
    use HandlesAuthorization;

    /**
     * Determine whether the user can create comments.
     *
     * @param  \App\User  $user
     * @return mixed
     */
    public function create(User $user, Post $post)
    {
        return $user->id != $post->user->id;   
    }

}
