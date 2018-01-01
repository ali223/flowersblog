<?php

namespace App\Policies;

use App\User;
use App\Post;
use Illuminate\Auth\Access\HandlesAuthorization;

class PostPolicy
{
    use HandlesAuthorization;

    /**
     * Determine whether the user can update the post.
     *
     * @param  \App\User  $user
     * @param  \App\Post  $post
     * @return mixed
     */
    public function update(User $user, Post $post)
    {
        return ($user->id == $post->user->id) ||
                $user->hasPermission('update-any-post');
    }

    /**
     * Determine whether the user can delete the post.
     *
     * @param  \App\User  $user
     * @param  \App\Post  $post
     * @return mixed
     */
    public function delete(User $user, Post $post)
    {
        return ($user->id == $post->user->id) ||
                $user->hasPermission('delete-any-post');
    }

    /**
     * Determine whether the user can view the post.
     *
     * @param  \App\User  $user
     * @param  \App\Post  $post
     * @return mixed
     */
    public function view(User $user, Post $post)
    {
        return $post->isPublished() || 
                ($user->id == $post->user->id) ||
                $user->hasPermission('view-any-post');
    }

    /**
     * Determine whether the user can view any post.
     *
     * @param  \App\User  $user     
     * @return mixed
     */
    public function viewAny(User $user)
    {
        return $user->hasPermission('view-any-post');
    }

    /**
     * Determine whether the user can publish any post.
     *
     * @param  \App\User  $user     
     * @param  \App\Post  $post     
     * @return mixed
     */
    public function publish(User $user)
    {
        return $user->hasPermission('publish-any-post');
    }

    /**
     * Determine whether the user can unpublish any post.
     *
     * @param  \App\User  $user     
     * @param  \App\Post  $post     
     * @return mixed
     */
    public function unpublish(User $user)
    {
        return $user->hasPermission('unpublish-any-post');
    }


}
